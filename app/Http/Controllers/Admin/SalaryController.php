<?php

namespace App\Http\Controllers\Admin;

use App\Actions\SalariesAction;
use App\Enums\SalaryStatusEnum;
use App\Http\Controllers\Controller;
use App\Models\Instructor;
use App\Models\MonthSalary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;

class SalaryController extends Controller
{
    public function __construct()
    {
        $route = Route::currentRouteName();
        $breadCrumb = explode('.', $route);
        $pageName = last($breadCrumb);
        View::share('pageName', ucfirst($pageName));
        View::share('breadCrumb', $breadCrumb);
    }

    public function index()
    {
        $month = date('n', strtotime("-1 month"));
        $year = date('Y');
        $month_salaries = MonthSalary::query()->with('instructor')->orderBy('updated_at')->paginate(15);
        $month_salaries->totalPage = ceil($month_salaries->total() / $month_salaries->perPage());
        return view('admin.salaries.index', [
            'month' => $month,
            'year' => $year,
            'month_salaries' => $month_salaries,
        ]);
    }

//    public function api()
//    {
//        return DataTables::of(MonthSalary::query()->with('instructor')
//            ->get())
//            ->editColumn('name', fn($object) => $object->instructor->name)
//            ->editColumn('month', fn($object) => date('m/Y', strtotime($object->month)))
//            ->editColumn('status', fn($object) => SalaryStatusEnum::from($object->status)->name)
//            ->editColumn('created_at', fn($object) => $object->created_at)
//            ->addColumn('show', fn($object) => $object->id)
//            ->addColumn('approve', fn($object) => $object->status !== SalaryStatusEnum::APPROVED->value
//                ? $object->id
//                : null)
//            ->make(true);
//    }


    public function calculate(Request $request)
    {

        DB::beginTransaction();

        $ins_ids = Instructor::with([
            'lessons' => function ($query) use ($request) {
                $query->select('ins_id')->whereMonth('date', $request->month)
                    ->whereYear('date', $request->year)
                    ->groupBy('ins_id');
            }
        ])->pluck('id');
        $month = date('Y/m/01', strtotime("{$request->year}/{$request->month}/01"));
        foreach ($ins_ids as $id) {
            // month column format Y/m/01
            $checkExist = MonthSalary::where('ins_id', $id)->where('month', $month)->first();
            if (!$checkExist) {
                $month_salaries = SalariesAction::calculate($request, $id);
                try {
                    if ($month_salaries) {
                        MonthSalary::query()->create([
                            'ins_id' => $month_salaries->ins_id,
                            'total_hours' => $month_salaries->total_hours,
                            'total_lessons' => $month_salaries->total_lessons,
                            'total_salaries' => $month_salaries->total_salaries,
                            'month' => $month,
                            'status' => SalaryStatusEnum::PENDING->value,
                        ]);
                        DB::commit();
                    }
                } catch (Throwable $e) {
                    report($e);
                    DB::rollBack();
                    return false;
                }

            }

        }
        return redirect()->route('admin.salaries.index');


    }

    public function show($id)
    {
        $info = SalariesAction::showSalary($id);
        return view('admin.salaries.show', [
            'ins' => $info->ins,
            'lessons' => $info->lessons,
            'month_salary' => $info->month_salary,
            'detail_salary' => $info->detail_salary,
        ]);
    }

    public function approve(Request $request, $id)
    {
        $month_salary = MonthSalary::where('id', $id);
        $month_salary->update([
            'status' => SalaryStatusEnum::APPROVED->value,
        ]);
        if ($request->base && $request->total) {
            $month_salary->update([
                'total_salaries' => $request->total,
            ]);
        }
        return redirect()->route('admin.salaries.index');

    }
}

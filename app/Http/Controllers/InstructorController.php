<?php

namespace App\Http\Controllers;

use App\Actions\SalariesAction;
use App\Enums\LessonStatusEnum;
use App\Enums\LevelEnum;
use App\Models\Instructor;
use App\Models\Lesson;
use App\Models\MonthSalary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\View;
use Yajra\DataTables\DataTables;

class InstructorController extends Controller
{
    public function __construct()
    {
        $this->guard = Auth::guard('instructor');
        $route = Route::currentRouteName();
        $breadCrumb = explode('.', $route);
        $pageName = last($breadCrumb);
        View::share('pageName', ucfirst($pageName));
        View::share('breadCrumb', $breadCrumb);
    }

    public function index()
    {
        $ins = $this->guard->user();
        return view('ins.index', [
            'ins' => $ins,
        ]);
    }

    public function salaries()
    {
        $salaries = MonthSalary::query()
            ->with('instructor')
            ->where('ins_id', $this->guard->user()->id)
            ->paginate(15);
        $salaries->totalPage = ceil($salaries->total() / $salaries->perPage());
        return view('ins.salaries', [
            'salaries' => $salaries,
        ]);
    }

//    public function api(Request $request)
//    {
//
//        return DataTables::of(MonthSalary::query()->with('instructor')
//            ->where('ins_id', $this->guard->user()->id)
//            ->get())
//            ->editColumn('status',
//                function ($object) {
//                    return $object->status == SalaryStatusEnum::PENDING->value ? 'Đang chờ duyệt' :
//                        ($object->status == SalaryStatusEnum::APPROVED->value ? 'Đã duyệt' : ' ');
//                })
//            ->editColumn('month', fn($object) => date_format(new \DateTime($object->month), 'm/Y'))
//            ->addColumn('show', fn($object) => $object->id)
//            ->make(true);
//    }

    public function show($id)
    {
        $info = SalariesAction::showSalary($id);
        return view('ins.show', [
            'lessons' => $info->lessons,
            'month_salary' => $info->month_salary,
            'detail_salary' => $info->detail_salary,
        ]);
    }

//    public function checkinAPI(Request $request)
//    {
//        return DataTables::of(Lesson::query()->where('ins_id', $this->guard->user()->id)
//            ->with('driver')
//            ->where('status', LessonStatusEnum::PENDING->value)
//            ->select('*', 'lessons.id as lesson_id')
//            ->get())
//            ->editColumn('name', fn($object) => $object->driver->name)
//            ->editColumn('phone_numbers', fn($object) => $object->driver->phone_numbers)
//            ->editColumn('email', fn($object) => $object->driver->email)
//            ->editColumn('date', fn($object) => date('d/m/Y', strtotime($object->date)))
//            ->editColumn('status', fn($object) => LessonStatusEnum::from($object->status)->name)
//            ->addColumn('checkin', fn($object) => $object->lesson_id)
//            ->make(true);
//    }

    public function checkin()
    {
        $lessons = Lesson::query()
            ->where('ins_id', $this->guard->user()->id)
            ->with('driver:id,name,email,phone_numbers')
            ->where('status', LessonStatusEnum::PENDING->value)
            ->paginate(15);
        $lessons->totalPage = ceil($lessons->total() / $lessons->perPage());

        return view('ins.checkin', [
            'lessons' => $lessons,
        ]);
    }

    public function updateStatus(Request $request, int $id)
    {
        $lesson = Lesson::query()->where('id', $id)->get()->first();
        $lesson->date=date("Y/m/d",strtotime($lesson->date));
        if ($lesson->date == date('Y/m/d') || $lesson->date < date('Y/m/d')) {
            Lesson::query()->where('id', $id)->update([
                'status' => LessonStatusEnum::HAPPENED->value,
            ]);
            return Redirect::back();
        } elseif ($lesson->date > date("Y/m/d")) {
            return Redirect::back()->withErrors([
                'message' => "Chưa đến ngày, chưa được checkin",
            ]);
        }


    }

    public function updateInfo(Request $request)
    {
        DB::beginTransaction();
        try {
            // Validate the value...
            $get = Instructor::query()->where('id', $this->guard->user()->id)
                ->where('level', LevelEnum::INSTRUCTOR->value);
            if (isset($request->avatar)) {
                $path = Storage::disk('public')->put('avatar', $request->avatar);
                $get->update([
                    'name' => $request->name,
                    'gender' => $request->gender,
                    'birthdate' => $request->birthdate,
                    'phone_numbers' => $request->phone_numbers,
                    'avatar' => $request->avatar,
                ]);
            } else {
                $get->update([
                    'name' => $request->name,
                    'gender' => $request->gender,
                    'birthdate' => $request->birthdate,
                    'phone_numbers' => $request->phone_numbers,
                ]);
            }
            DB::commit();
            return Redirect::back();
        } catch (Throwable $e) {
            DB::rollBack();
            report($e);

            return false;
        }

    }

    public function lessons()
    {
        $lessons = Lesson::query()->where('ins_id', $this->guard->user()->id)
            ->with('driver:id,name,email,phone_numbers')
            ->orderBy('date')
            ->orderBy('start_at')
            ->paginate(15);
        $lessons->totalPage = ceil($lessons->total() / $lessons->perPage());
        return view('ins.lessons', [
            'lessons' => $lessons,
        ]);
    }

    public function getLessons()
    {
        return DataTables::of()
            ->editColumn('name', fn($object) => $object->driver->name)
            ->editColumn('email', fn($object) => $object->driver->email)
            ->editColumn('phone_numbers', fn($object) => $object->driver->phone_numbers)
            ->editColumn('date', fn($object) => date('d/m/Y', strtotime($object->date)))
            ->editColumn('status', fn($object) => $object->status == LessonStatusEnum::PENDING->value ? "Chưa đến" :
                ($object->status == LessonStatusEnum::HAPPENED->value ? "Đã xong" :
                    ($object->status == LessonStatusEnum::CANCELED->value ? "Đã hủy" :
                        " ")))
            ->make(true);

    }


}

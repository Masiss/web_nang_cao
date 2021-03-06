@extends('layout.master')
@push('css')
    <link rel="stylesheet" type="text/css" href="{{asset('css/vertical-menu.min.css')}}">
@endpush
@section('content')


    <div class="content-body">
        <div class="row">
            <a href="{{route('admin.courses.create')}}">Thêm</a>
            <table id="table-data">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Số giờ còn lại</th>
                    <th>Giá nguyên khóa</th>
                    <th>Giá mỗi buổi</th>

                </tr>
                </thead>
            </table>
        </div>

    </div>

    @push('javascript')
        <script type="text/javascript"
                src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
        <script type="text/javascript"
                src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
        <script type="text/javascript"
                src="https://cdn.datatables.net/v/bs5/jszip-2.5.0/dt-1.12.1/af-2.4.0/b-2.2.3/b-colvis-2.2.3/b-html5-2.2.3/b-print-2.2.3/fh-3.2.3/datatables.min.js"></script>
        <script type="text/javascript">

            $(function () {
                $('#table-data').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: '{!! route('admin.courses.api') !!}',
                    columns: [
                        {data: 'id', name: 'id'},
                        {data: 'hours', name: 'hours'},
                        {data: 'price', name: 'price'},
                        {data: 'price_per_day', name: 'price_per_day'},

                    ]
                });
            })


        </script>
    @endpush
@endsection





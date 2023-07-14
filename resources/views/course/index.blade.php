@extends('layout.master')
@push('css')
    <link
        href="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.13.4/b-2.3.6/b-colvis-2.3.6/b-html5-2.3.6/b-print-2.3.6/date-1.4.1/fc-4.2.2/fh-3.3.2/r-2.4.1/sc-2.1.1/sb-1.4.2/sl-1.6.2/datatables.min.css"
        rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush
@section('content')
    {{-- code chay --}}
    {{-- <div class="col-md-12" style="min-height: 70vh">
        <a class="btn btn-primary" href="{{ route('courses.create') }}">
            <h4>Thêm lớp mới</h4>
        </a>

        <div class="card">
            <div class="card-header card-header-icon" data-background-color="rose">
                <i class="material-icons">assignment</i>

            </div>

            <div class="card-content">
                <h4 class="card-title">Lớp học</h4>
                <form class="text-center">
                    <label for="#">Searh: </label>
                    <input type="search" name="q" value="{{ $search }}"
                        style="border-color: #ddd; width: 20em;">

                </form>

                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <td>Name</td>
                                <td>Created At</td>
                                <th class="text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $each)
                                <tr>
                                    <td class="text-center">{{ $each->id }}</td>
                                    <td>{{ $each->name }}</td>
                                    <td>{{ $each->year_created_at }}</td>
                                    <td class="text-right">
                                        <i class="material-icons">
                                            <a class="btn btn-success"href="{{ route('courses.edit', $each) }}">Edit</a>
                                        </i>
                                        <i class="material-icons">
                                            <form action="{{ route('courses.destroy', $each) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button rel="tooltip" class="btn btn-danger">
                                                    Delete</button>
                                            </form>
                                        </i>

                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <ul class="pagination pagination-info" style="margin-bottom: 0px">
        {{ $data->links() }}
    </ul> --}}


    {{-- sử dụng datatable --}}

    <div class="col-md-12">

        <a class="btn btn-primary" href="{{ route('courses.create') }}">
            <h4>Thêm lớp mới</h4>
        </a>

        <div class="card">
            <div class="card-header card-header-icon" data-background-color="rose">
                <i class="material-icons">assignment</i>
            </div>
            <div class="card-content">
                <h4 class="card-title">{{ $title }}</h4>
                <div class="table-responsive">
                    <div class="w-100">
                        <select id="select-name" class="w-100" style="width: 100%"></select>
                    </div>
                    <br>
                    <table class="table table-striped" id="table-index">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Number Studen</th>
                                <th>Created At</th>
                                <th>Edit</th>
                                {{-- @if (CheckSupperAdmin())  đang lỗi [nên sử dụng] --}}
                                @if (session()->get('level') === 1)
                                    <th>Delete</th>
                                @endif
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
    <script
        src="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.13.4/b-2.3.6/b-colvis-2.3.6/b-html5-2.3.6/b-print-2.3.6/date-1.4.1/fc-4.2.2/fh-3.3.2/r-2.4.1/sc-2.1.1/sb-1.4.2/sl-1.6.2/datatables.min.js">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(function() {



            var buttonCommon = {
                exportOptions: {
                    columns: ':visible :not(.not-export)'
                }
            };
            let table = $('#table-index').DataTable({
                dom: 'Blrtip',
                select: true,
                buttons: [
                    $.extend(true, {}, buttonCommon, {
                        extend: 'copyHtml5'
                    }),
                    $.extend(true, {}, buttonCommon, {
                        extend: 'csvHtml5'
                    }),
                    $.extend(true, {}, buttonCommon, {
                        extend: 'excelHtml5'
                    }),
                    $.extend(true, {}, buttonCommon, {
                        extend: 'pdfHtml5'
                    }),
                    $.extend(true, {}, buttonCommon, {
                        extend: 'print'
                    }),
                    'colvis'
                ],
                lengthMenu: [3, 5, 10],
                processing: true,
                serverSide: true,
                ajax: '{!! route('courses.api') !!}',
                columnDefs: [{
                    className: "not-export",
                    "targets": [3]
                }],
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'students_count',
                        name: 'number_students'
                    },
                    {
                        data: 'created_at',
                        name: 'created_at'
                    },
                    {
                        data: 'edit',
                        targets: 3,
                        orderable: false,
                        searchable: false,
                        render: function(data, type, row, meta) {
                            return `<a class="btn btn-primary" href="${data}">
                                Edit
                            </a>`;
                        }
                    },
                    @if (session()->get('level') === 1)
                        {
                            data: 'destroy',
                            targets: 4,
                            orderable: false,
                            searchable: false,
                            render: function(data, type, row, meta) {
                                return `<form action="${data}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type='button' class="btn-delete btn btn-danger">Delete</button>
                            </form>`;
                            }
                        },
                    @endif
                ]
            });

            $('#select-name').change(function() {
                table.column(0).search(this.value).draw();
            });
            $(document).on('click', '.btn-delete', function() {
                let form = $(this).parents('form');
                $.ajax({
                    url: form.attr('action'),
                    type: 'POST',
                    dataType: 'json',
                    data: form.serialize(),
                    success: function() {
                        console.log("success");
                        table.draw();
                    },
                    error: function() {
                        console.log("error");
                    }
                });
            });
        });
    </script>
@endpush

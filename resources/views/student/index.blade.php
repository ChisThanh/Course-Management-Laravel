@extends('layout.master')
@push('css')
    <link
        href="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.13.4/b-2.3.6/b-colvis-2.3.6/b-html5-2.3.6/b-print-2.3.6/date-1.4.1/fc-4.2.2/fh-3.3.2/r-2.4.1/sc-2.1.1/sb-1.4.2/sl-1.6.2/datatables.min.css"
        rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush
@section('content')
    <div class="col-md-12">

        <a class="btn btn-primary" href="{{ route('students.create') }}">
            <h4>Thêm sinh viên mới</h4>
        </a>


        <div class="card">
            <div class="card-header card-header-icon" data-background-color="rose">
                <i class="material-icons">assignment</i>
            </div>
            <div class="card-content">
                <h4 class="card-title">{{ $title }}</h4>
                <div class="table-responsive">

                    <div class="form-group">
                        <select id="select-course-name"style="width: 100%"></select>
                    </div>
                    <div class="form-group">
                        <select id="select-status" style="width: 100%">
                            <option value="0">Tất cả</option>
                            @foreach ($arrEnum as $option => $value)
                                <option value="{{ $value }}">
                                    {{ $option }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <br>
                    <table class="table table-striped" id="table-index">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Gender</th>
                                <th>Birth Date</th>
                                <th>Course Name</th>
                                <th>Status</th>
                                <th>Edit</th>
                                <th>Delete</th>
                                <th>Avatar</th>

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
            $("#select-course-name").select2({
                ajax: {
                    url: "{{ route('courses.api.name') }}",
                    dataType: 'json',
                    data: function(params) {
                        return {
                            q: params.term
                        };
                    },
                    processResults: function(data, params) {
                        return {
                            results: $.map(data, function(item) {
                                return {
                                    text: item.name,
                                    id: item.id
                                }
                            })
                        };
                    }
                },
                placeholder: 'Search for a name',
                allowClear: true
            });
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
                // lengthMenu: [3, 5, 10],
                processing: true,
                serverSide: true,
                ajax: '{!! route('students.api') !!}',
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
                        data: 'gender',
                        name: 'gender'
                    },
                    {
                        data: 'age',
                        name: 'age'
                    },
                    {
                        data: 'course_name',
                        name: 'course_name'
                    },
                    {
                        data: 'status',
                        name: 'status'
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
                    {
                        data: 'destroy',
                        targets: 4,
                        orderable: false,
                        searchable: false,
                        render: function(data, type, row, meta) {
                            return `<form action="${data}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type='button' class="btn btn-danger">Delete</button>
                            </form>`;
                        }
                    },
                    {
                        data: 'avatar',
                        targets: 5,
                        orderable: false,
                        searchable: false,
                        render: function(data, type, row, meta) {
                            if (!data) {
                                return '';
                            }
                            return `<img src="{{ public_path() }}/${data}">`;
                        }
                    },
                ]
            });

            $('#select-course-name').change(function() {
                table.column(4).search($(this).val()).draw();
            });

            $('#select-status').change(function() {
                let value = $(this).val();
                table.column(5).search(value).draw();
                // if(value === '0'){
                //     table
                //         .column(4)
                //         .search( '' )
                //         .draw();
                // } else {
                //     table.column(4).search(value).draw();
                // } sử lý search forntend
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

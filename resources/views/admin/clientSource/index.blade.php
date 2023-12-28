@extends('admin.layouts.app')
@push('title')
    Client Source List
@endpush
@push('style')
@endpush
@section('content')
    <!-- Client Source Datatable -->
    <div class="ams-panel-wpr">
        <div class="ams-panel">
            <div class="panel-heading">
                <h5 class="panel-title">Client Source List</h5>
                @if (check_permission('Client Source Create'))
                    <a href="{{ route('admin.clientSource.create') }}" class="panel-item">+ Add Client Source</a>
                @endif
            </div>
            <div class="panel-body">
                <table id="datatable" class="display table table-bordered">
                    <thead>
                        <tr>
                            <th>SL</th>
                            <th>Name</th>
                            <th>Active</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- table data fetched by ajax datatables --}}
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
@push('script')
    <script>
        $(function() {
            $('#datatable').DataTable({
                responsive: true,
                scrollX: true,
                processing: true,
                serverSide: true,
                "lengthMenu": [5, 10, 25, 50, 75, 100, 200, 400, 500],
                "pageLength": 10,
                ajax: '{!! route('admin.clientSource.index') !!}',
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'status',
                        name: 'status'
                    },
                    {
                        data: 'action',
                        name: 'action'
                    },
                ],
                initComplete: function() {
                    this.api().columns().every(function() {
                        var column = this;
                        var input = document.createElement("input");
                        $(input).appendTo($(column.footer()).empty())
                            .on('change', function() {
                                column.search($(this).val(), false, false, true).draw();
                            });
                    });
                }
            });
        });
    </script>
@endpush

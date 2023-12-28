@extends('admin.layouts.app')
@push('title')
    Hotel List
@endpush
@push('style')
@endpush
@section('content')
    <!-- Hotel Datatable -->
    <div class="ams-panel-wpr">
        <div class="ams-panel">
            <div class="panel-heading">
                <h5 class="panel-title">Hotel List</h5>
                @if (check_permission('Hotel Create'))
                <a href="{{ route('admin.hotel.create') }}" class="panel-item">+ Add Hotel</a>
                @endif
            </div>
            <div class="panel-body">
                <form id="table-search-form" action="{{ route('admin.hotel.index') }}" method="GET"
                enctype="multipart/form-data">
                    @method('GET')
                    <div class="panel-search mb-5">
                        <div class="panel-search-box">
                            <div>
                                <fieldset class="ams-input input-verticle">
                                    <label for="package_type_id">Package Type :</label>
                                    <select class="unit-select-box form-select" name="package_type_id" id="package_type_id">
                                        <option value="">All</option>
                                        @foreach ($packageTypes->sortBy('name') as $packageType)
                                            <option value="{{ $packageType->id }}" @selected(request()->package_type_id == $packageType->id)>
                                                {{ ucwords($packageType->name) }} ({{ ucwords($packageType?->package?->name) }})
                                            </option>
                                        @endforeach
                                    </select>
                                </fieldset>
                                <fieldset class="ams-input input-verticle">
                                    <label for="location_id">Location :</label>
                                    <select class="unit-select-box form-select" name="location_id" id="location_id">
                                        <option value="">All</option>
                                        @foreach ($locations->sortBy('name') as $location)
                                            <option value="{{ $location->id }}" @selected(request()->location_id == $location->id)>
                                                {{ ucwords($location->name) }}
                                            </option>
                                        @endforeach
                                    </select>
                                </fieldset>
                                <div class="search-btns">
                                    <button type="submit" class="panel-srch-btn"><i class="fas fa-search"></i>
                                        Search</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>

                <table id="datatable" class="display table table-bordered">
                    <thead>
                        <tr>
                            <th>SL</th>
                            <th>Name</th>
                            <th>Package Type</th>
                            <th>Location</th>
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
            let package_type_id = $('#package_type_id').val();
            let location_id = $('#location_id').val();
            let url = `{!! route('admin.hotel.index', ['package_type_id' => 'package_type_value','location_id' => 'location_value']) !!}`;
            url = url.replace('package_type_value', package_type_id).replace('location_value', location_id);
 

            $('#datatable').DataTable({
                responsive: true,
                scrollX: true,
                processing: true,
                serverSide: true,
                "lengthMenu": [5, 10, 25, 50, 75, 100, 200, 400, 500],
                "pageLength": 10,
                ajax: url,
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
                        data: 'package_type',
                        name: 'package_type'
                    },
                    {
                        data: 'location',
                        name: 'location'
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

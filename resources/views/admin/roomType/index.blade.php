@extends('admin.layouts.app')
@push('title')
    Room Type List
@endpush
@push('style')
@endpush
@section('content')
    <!-- Room Type Datatable -->
    <div class="ams-panel-wpr">
        <div class="ams-panel">
            <div class="panel-heading">
                <h5 class="panel-title">Room Type List & Price</h5>
                <a href="{{ route('admin.roomType.create') }}" class="panel-item">+ Add Room Type</a>
            </div>
            <div class="panel-body">
                <form id="table-search-form" action="{{ route('admin.roomType.index') }}" method="GET"
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
                                <fieldset class="ams-input input-verticle">
                                    <label for="hotel_id">Hotel :</label>
                                    <select class="unit-select-box form-select" name="hotel_id" id="hotel_id">
                                        <option value="">All</option>
                                        @foreach ($hotels->sortBy('name') as $hotel)
                                            <option value="{{ $hotel->id }}" @selected(request()->hotel_id == $hotel->id)>
                                                {{ ucwords($hotel->name) }}
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
                            <th>Date Range</th>
                            <th>Name</th>
                            <th>Nos Of Traveler</th>
                            <th>Cost Per Day <small>(In package currency for all members)</small></th>
                            <th>Hotel</th>
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
            let hotel_id = $('#hotel_id').val();
            let url = `{!! route('admin.roomType.index', ['package_type_id' => 'package_type_value','location_id' => 'location_value','hotel_id' => 'hotel_value']) !!}`;
            url = url.replace('package_type_value', package_type_id).replace('location_value', location_id).replace('hotel_value', hotel_id);


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
                        data: null,
                        searchable: true,
                        render: function(data, type, row) {
                            var fromDate = moment(row.from_date).format('DD/MM/YYYY');
                            var toDate = moment(row.to_date).format('DD/MM/YYYY');
                            var concatenatedDate = fromDate + ' to ' + toDate;


                            return concatenatedDate;
                        }
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'nos_of_traveler',
                        name: 'nos_of_traveler'
                    },
                    {
                        data: 'cost_per_day',
                        name: 'cost_per_day'
                    },
                    {
                        data: 'hotel_name',
                        name: 'hotel_name'
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

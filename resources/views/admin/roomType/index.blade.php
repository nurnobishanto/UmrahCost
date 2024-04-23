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
{{--                <a href="{{ route('admin.roomType.create') }}" class="panel-item">+ Add Room Type</a>--}}
                <a type="button" class="panel-item" href="{{route('room_type.export')}}">Example Excel File</a>
                <form action="{{ route('room_type.import') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input class="panel-item"  type="file" name="file" accept=".xlsx, .xls">
                    <button type="submit" class="panel-item" >Upload Excel File</button>
                </form>
                <a type="button" class="panel-item" data-bs-toggle="modal" data-bs-target="#roomTypeModal">+ Add Room Type</a>

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

    <!-- Create Room Type Modal -->
    <div class="modal fade" id="roomTypeModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="roomTypeModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="POST" action="{{ route('admin.roomType.store') }}" enctype="multipart/form-data" class="ams-form">
                <div class="modal-header">
                    <h5 class="modal-title" id="roomTypeModalLabel">Add Room Type</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @csrf
                    <div class="row">
                        <div class="col-12">
                            <fieldset class="ams-input input-verticle">
                                <label for="name">Name<sup class="required">*</sup></label>
                                <input type="text" value="{{ old('name') }}" name="name" id="name" placeholder="Enter Name">
                                @error('name')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </fieldset>
                            <fieldset class="ams-input input-verticle">
                                <label for="hotel">Select Hotel<sup class="required">*</sup></label>
                                <select name="hotel" id="hotel" class="form-control" required >
                                    <option value="">Select One</option>
                                    @foreach ($hotels as $hotel)
                                        <option @if($hotel->id == old('hotel')) selected @endif value="{{ $hotel->id }}">{{ $hotel->name }} ({{ $hotel->packageType?->name }}) ({{ $hotel->location?->name }})</option>
                                    @endforeach
                                </select>
                                @error('hotel')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </fieldset>
                        </div>
                        <div class="col-md-6">
                            <fieldset class="ams-input input-verticle">
                                <label for="from_date">From Date<sup class="required">*</sup></label>
                                <input type="text" readonly value="{{ old('from_date') }}" name="from_date" id="from_date">
                                @error('from_date')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </fieldset>
                        </div>
                        <div class="col-md-6">
                            <fieldset class="ams-input input-verticle">
                                <label for="to_date">Between Date<sup class="required">*</sup></label>
                                <input type="text" readonly value="{{ old('to_date') }}" name="to_date" id="to_date">
                                @error('to_date')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </fieldset>
                        </div>
                        <div class="col-md-8">
                            <fieldset class="ams-input input-verticle">
                                <label for="cost_per_day">Cost Per Day <small>(In package currency for all members)</small><sup class="required">*</sup></label>
                                <input type="number" step="any" value="{{ old('cost_per_day') }}" name="cost_per_day" id="cost_per_day" placeholder="Enter Cost Per Day">
                                @error('cost_per_day')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </fieldset>
                        </div>
                        <div class="col-md-4">
                            <fieldset class="ams-input input-verticle">
                                <label for="nos_of_traveler">Nos Of Traveler<sup class="required">*</sup></label>
                                <select name="nos_of_traveler" id="nos_of_traveler" class="form-control" required >
                                    <option value="">Select One</option>
                                    @foreach (number_range_to_array(1,10) as $number)
                                        <option @if($number == old('nos_of_traveler')) selected @endif value="{{ $number }}">{{ $number }} </option>
                                    @endforeach
                                </select>
                                @error('nos_of_traveler')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </fieldset>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <a type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</a>
                    <button type="submit" class="submit-btn btn"><i class="far fa-save"></i> Save</button>
                </div>
            </form>
            </div>
        </div>
    </div>
@endsection
@push('script')
    <style>
        /* Custom CSS for disabled dates */

        .datepicker table tr td.disabled {
            color: #ebebeb; /* Change the color to your preferred disabled color */
            background-color: #515151; /* Change the background color to your preferred disabled background color */
        }
    </style>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#from_date').datepicker({
                format: 'dd/mm/yyyy', // Set your desired date format here
                autoclose: true,
            }).on('changeDate', function (selectedDate) {
                // Update maxDate of 'to_date' datepicker
                var travelDate = new Date(selectedDate.date.valueOf());
                travelDate.setDate(travelDate.getDate() + 30);
                $('#to_date').datepicker('setStartDate', selectedDate.date);
                $('#to_date').datepicker('setDate', travelDate);
            });
            $('#to_date').datepicker({
                format: 'dd/mm/yyyy', // Set your desired date format here
                autoclose: true,
            });
        });
    </script>
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

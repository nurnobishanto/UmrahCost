@extends('admin.layouts.app')
@push('title')
    Room Type
@endpush
@push('style')
    <link href="{{ asset('assets/backend/css/select2.min.css') }}" rel="stylesheet" />
@endpush
@section('content')
    <!--  New Room Type -->
    <div class="ams-panel-wpr panel-md">
        <div class="ams-panel">
            <div class="panel-heading">
                <h5 class="panel-title">Edit Room Type</h5>
                <div>
                    <a href="{{ route('admin.roomType.index') }}" class="btn add-btn"><i class="fas fa-list-ul"></i> Room Type List</a>
                </div>
            </div>
            <div class="panel-body">
                <div class="ams-customer-add-form">
                    <form method="POST" action="{{ route('admin.roomType.update', $roomType->id) }}" enctype="multipart/form-data" class="ams-form">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-12">
                                <fieldset class="ams-input input-verticle">
                                    <label for="name">Name<sup class="required">*</sup></label>
                                    <input type="text" value="{{ old('name',$roomType->name) }}" name="name" id="name" placeholder="Enter Name">
                                    @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </fieldset>
                                <fieldset class="ams-input input-verticle">
                                    <label for="hotel">Select Hotel<sup class="required">*</sup></label>
                                    <select name="hotel" id="hotel" class="form-control" required >
                                        <option value="">Select One</option>
                                        @foreach ($hotels as $hotel)
                                            <option @if($hotel->id == old('hotel', $roomType->hotel_id)) selected @endif value="{{ $hotel->id }}">{{ $hotel->name }} ({{ $hotel->packageType?->name }}) ({{ $hotel->location?->name }})</option>
                                        @endforeach
                                    </select>
                                    @error('hotel')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </fieldset>
                            </div>
                            <div class="col-md-6">
                                <fieldset class="ams-input input-verticle">
                                    <label for="from_date">From Date <sup class="required">*</sup></label>
                                    <input type="text" readonly value="{{ old('from_date',date('d/m/Y',strtotime($roomType->from_date))) }}" name="from_date" id="from_date" >
                                    @error('from_date')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </fieldset>
                            </div>
                            <div class="col-md-6">
                                <fieldset class="ams-input input-verticle">
                                    <label for="to_date">Between Date <sup class="required">*</sup></label>
                                    <input type="text" readonly value="{{ old('to_date',date('d/m/Y',strtotime($roomType->to_date))) }}" name="to_date" id="to_date" >
                                    @error('to_date')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </fieldset>
                            </div>
                            <div class="col-md-8">
                                <fieldset class="ams-input input-verticle">
                                    <label for="cost_per_day">Cost Per Day <small>(In package currency for all members)</small><sup class="required">*</sup></label>
                                    <input type="number" step="any" value="{{ old('cost_per_day',$roomType->cost_per_day) }}" name="cost_per_day" id="cost_per_day" placeholder="Enter Cost Per Day">
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
                                            <option @if($number == old('nos_of_traveler',$roomType->nos_of_traveler)) selected @endif value="{{ $number }}">{{ $number }} </option>
                                        @endforeach
                                    </select>
                                    @error('nos_of_traveler')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </fieldset>
                            </div>
                        </div>



                        <fieldset class="text-end">
                            <button type="submit" class="submit-btn btn"><i class="far fa-save"></i> Save</button>
                        </fieldset>
                    </form>
                </div>
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
            $('#to_date').datepicker({
                format: 'dd/mm/yyyy', // Set your desired date format here
                autoclose: true,
            });

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
        });
    </script>
@endpush

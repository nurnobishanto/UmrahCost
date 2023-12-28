@extends('admin.layouts.app')
@push('title')
    Add Room Type
@endpush
@push('style')
    <link href="{{ asset('assets/backend/css/select2.min.css') }}" rel="stylesheet" />
@endpush
@section('content')
    <!--  New Room Type -->
    <div class="ams-panel-wpr panel-md">
        <div class="ams-panel">
            <div class="panel-heading">
                <h5 class="panel-title">Add Room Type</h5>
                <div>
                    <a href="{{ route('admin.roomType.index') }}" class="btn add-btn"><i class="fas fa-list-ul"></i> Room Type List</a>
                </div>
            </div>
            <div class="panel-body">
                <div class="ams-customer-add-form">
                    <form method="POST" action="{{ route('admin.roomType.store') }}" enctype="multipart/form-data" class="ams-form">
                        @csrf
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
                                    <option @if($hotel->id == old('hotel')) selected @endif value="{{ $hotel->id }}">{{ $hotel->name }} ({{ $hotel->location?->name }})</option>
                                @endforeach
                            </select>
                            @error('hotel')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </fieldset>
                        <fieldset class="ams-input input-verticle">
                            <label for="cost_per_day">Cost Per Day (In package currency for all members)<sup class="required">*</sup></label>
                            <input type="number" step="any" value="{{ old('cost_per_day') }}" name="cost_per_day" id="cost_per_day" placeholder="Enter Cost Per Day">
                            @error('cost_per_day')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </fieldset>
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
    <script type="text/javascript">
        $(document).ready(function() {

        });
    </script>
@endpush

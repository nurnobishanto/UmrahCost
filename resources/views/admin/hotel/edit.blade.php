@extends('admin.layouts.app')
@push('title')
    Hotel
@endpush
@push('style')
    <link href="{{ asset('assets/backend/css/select2.min.css') }}" rel="stylesheet" />
@endpush
@section('content')
    <!--  New Hotel -->
    <div class="ams-panel-wpr panel-md">
        <div class="ams-panel">
            <div class="panel-heading">
                <h5 class="panel-title">Edit Hotel</h5>
                <div>
                    @if (check_permission('Hotel Edit'))
                        <a href="{{ route('admin.hotel.index') }}" class="btn add-btn"><i class="fas fa-list-ul"></i> Hotel List</a>
                    @endif
                </div>
            </div>
            <div class="panel-body">
                <div class="ams-customer-add-form">
                    <form method="POST" action="{{ route('admin.hotel.update', $hotel->id) }}" enctype="multipart/form-data" class="ams-form">
                        @csrf
                        @method('PUT')
                        <fieldset class="ams-input input-verticle">
                            <label for="name">Name<sup class="required">*</sup></label>
                            <input type="text" value="{{ old('name', $hotel->name) }}" name="name" id="name" placeholder="Enter Name" required >
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </fieldset>
                        <fieldset class="ams-input input-verticle">
                            <label for="package_type">Select Package Type<sup class="required">*</sup></label>
                            <select name="package_type" id="package_type" class="form-control" required >
                                <option value="">Select One</option>
                                @foreach ($packageTypes as $packageType)
                                    <option @if($packageType->id == old('package_type', $hotel->package_type_id)) selected @endif value="{{ $packageType->id }}">{{ $packageType->name }} ({{ $packageType->package?->name }})</option>
                                @endforeach
                            </select>
                            @error('package_type')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </fieldset>
                        <fieldset class="ams-input input-verticle">
                            <label for="location">Select Hotel<sup class="required">*</sup></label>
                            <select name="location" id="location" class="form-control" required >
                                <option value="">Select One</option>
                                @foreach ($locations as $location)
                                    <option @if($location->id == old('location', $hotel->location_id)) selected @endif value="{{ $location->id }}">{{ $location->name }} ({{ $location->package?->name }})</option>
                                @endforeach
                            </select>
                            @error('location')
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

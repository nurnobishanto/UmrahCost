@extends('admin.layouts.app')
@push('title')
    Sightseeing
@endpush
@push('style')
    <link href="{{ asset('assets/backend/css/select2.min.css') }}" rel="stylesheet" />
@endpush
@section('content')
    <!--  New Sightseeing -->
    <div class="ams-panel-wpr panel-md">
        <div class="ams-panel">
            <div class="panel-heading">
                <h5 class="panel-title">Edit Sightseeing</h5>
                <div>
                    @if (check_permission('Sightseeing List'))
                    <a href="{{ route('admin.sightseeing.index') }}" class="btn add-btn"><i class="fas fa-list-ul"></i> Sightseeing List</a>
                    @endif
                </div>
            </div>
            <div class="panel-body">
                <div class="ams-customer-add-form">
                    <form method="POST" action="{{ route('admin.sightseeing.update', $sightseeing->id) }}" enctype="multipart/form-data" class="ams-form">
                        @csrf
                        @method('PUT')
                        <fieldset class="ams-input input-verticle">
                            <label for="name">Name<sup class="required">*</sup></label>
                            <input type="text" value="{{ old('name', $sightseeing->name) }}" name="name" id="name" placeholder="Enter Name">
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </fieldset>
                        <fieldset class="ams-input input-verticle">
                            <label for="cost">Cost (In package currency)<sup class="required">*</sup></label>
                            <input type="number" step="any" value="{{ old('cost', $sightseeing->cost) }}" name="cost" id="cost" placeholder="Enter Cost">
                            @error('cost')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </fieldset>
                        <fieldset class="ams-input input-verticle">
                            <label for="location">Select Location<sup class="required">*</sup></label>
                            <select name="location" id="location" class="form-control">
                                @foreach ($locations as $location)
                                    <option @if($location->id == old('location', $sightseeing->location_id)) selected @endif value="{{ $location->id }}">{{ $location->name }} ({{ $location?->package?->name }})</option>
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

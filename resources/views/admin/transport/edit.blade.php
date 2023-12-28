@extends('admin.layouts.app')
@push('title')
    Transport
@endpush
@push('style')
    <link href="{{ asset('assets/backend/css/select2.min.css') }}" rel="stylesheet" />
@endpush
@section('content')
    <!--  New Transport -->
    <div class="ams-panel-wpr panel-md">
        <div class="ams-panel">
            <div class="panel-heading">
                <h5 class="panel-title">Edit Transport</h5>
                <div>
                    @if (check_permission('Transport List'))
                    <a href="{{ route('admin.transport.index') }}" class="btn add-btn"><i class="fas fa-list-ul"></i> Transport List</a>
                    @endif
                </div>
            </div>
            <div class="panel-body">
                <div class="ams-customer-add-form">
                    <form method="POST" action="{{ route('admin.transport.update', $transport->id) }}" enctype="multipart/form-data" class="ams-form">
                        @csrf
                        @method('PUT')
                        <fieldset class="ams-input input-verticle">
                            <label for="name">Name<sup class="required">*</sup></label>
                            <input type="text" value="{{ old('name', $transport->name) }}" name="name" id="name" placeholder="Enter Name">
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </fieldset>
                        <fieldset class="ams-input input-verticle">
                            <label for="cost">Cost (In package currency)<sup class="required">*</sup></label>
                            <input type="number" step="any" value="{{ old('cost', $transport->cost) }}" name="cost" id="cost" placeholder="Enter Cost">
                            @error('cost')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </fieldset>
                        <fieldset class="ams-input input-verticle">
                            <label for="package">Select Package<sup class="required">*</sup></label>
                            <select name="package" id="package" class="form-control">
                                <option value="">Select One</option>
                                @foreach ($packages as $package)
                                    <option @if($package->id == old('package', $transport->package_id)) selected @endif value="{{ $package->id }}">{{ $package->name }}</option>
                                @endforeach
                            </select>
                            @error('package')
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

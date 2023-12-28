@extends('admin.layouts.app')
@push('title')
    Add Status
@endpush
@push('style')
    <link href="{{ asset('assets/backend/css/select2.min.css') }}" rel="stylesheet" />
@endpush
@section('content')
    <!--  New Status -->
    <div class="ams-panel-wpr panel-md">
        <div class="ams-panel">
            <div class="panel-heading">
                <h5 class="panel-title">Add Status</h5>
                <div>
                    @if (check_permission('Status List'))
                    <a href="{{ route('admin.status.index') }}" class="btn add-btn"><i class="fas fa-list-ul"></i> Status List</a>
                    @endif
                </div>
            </div>
            <div class="panel-body">
                <div class="ams-customer-add-form">
                    <form method="POST" action="{{ route('admin.status.store') }}" enctype="multipart/form-data" class="ams-form">
                        @csrf
                        <fieldset class="ams-input input-verticle">
                            <label for="name">Name<sup class="required">*</sup></label>
                            <input type="text" value="{{ old('name') }}" name="name" id="name" placeholder="Enter Name">
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </fieldset>
                        
                        <fieldset class="ams-input input-verticle">
                            <label for="color">Color<sup class="required">*</sup></label>
                            <input type="text" value="{{ old('color') }}" name="color" id="color" placeholder="Enter Name">
                            @error('color')
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

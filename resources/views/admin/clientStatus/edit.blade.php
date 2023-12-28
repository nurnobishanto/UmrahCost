@extends('admin.layouts.app')
@push('title')
    Client Status
@endpush
@push('style')
    <link href="{{ asset('assets/backend/css/select2.min.css') }}" rel="stylesheet" />
@endpush
@section('content')
    <!--  New Client Status -->
    <div class="ams-panel-wpr panel-md">
        <div class="ams-panel">
            <div class="panel-heading">
                <h5 class="panel-title">Edit Client Status</h5>
                <div>
                    @if (check_permission('Client Status List'))
                        <a href="{{ route('admin.clientStatus.index') }}" class="btn add-btn"><i class="fas fa-list-ul"></i> Client Status List</a>
                    @endif
                </div>
            </div>
            <div class="panel-body">
                <div class="ams-customer-add-form">
                    <form method="POST" action="{{ route('admin.clientStatus.update', $clientStatus->id) }}" enctype="multipart/form-data" class="ams-form">
                        @csrf
                        @method('PUT')
                        <fieldset class="ams-input input-verticle">
                            <label for="name">Name<sup class="required">*</sup></label>
                            <input type="text" value="{{ old('name',$clientStatus->name) }}" name="name" id="name" placeholder="Enter Name">
                            @error('name')
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

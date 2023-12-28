@extends('admin.layouts.app')
@push('title')
    Information
@endpush
@push('style')
    <link href="{{ asset('assets/backend/css/select2.min.css') }}" rel="stylesheet" />
@endpush
@section('content')
    <!--  Information -->
    <div class="ams-panel-wpr panel-md">
        <div class="ams-panel">
            <div class="panel-heading">
                <h5 class="panel-title">Information</h5>
                <div>
                    {{-- <a href="#" class="btn add-btn"><i class="fas fa-list-ul"></i> Holiday List</a> --}}
                </div>
            </div>
            <div class="panel-body">
                <div class="ams-customer-add-form">
                    <form method="POST" action="{{ route('admin.setting.informationUpdate') }}" enctype="multipart/form-data" class="ams-form">
                        @csrf
                        <fieldset class="ams-input input-verticle">
                            <label for="company_name">Company name<sup class="required">*</sup></label>
                            <input type="text" value="{{ get_static_option('company_name') }}" name="company_name"
                                id="company_name" placeholder="Enter company name">
                            @error('company_name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </fieldset>
                        <fieldset class="ams-input input-verticle">
                            <label for="phone">Phone<sup class="required">*</sup></label>
                            <input type="number" value="{{ get_static_option('phone') }}" name="phone" id="phone"
                                placeholder="Enter phone">
                            @error('phone')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </fieldset>
                        <fieldset class="ams-input input-verticle">
                            <label for="email">Email<sup class="required">*</sup></label>
                            <input type="text" value="{{ get_static_option('email') }}" name="email" id="email"
                                placeholder="Enter email">
                            @error('email')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </fieldset>
                        <fieldset class="ams-input input-verticle">
                            <label for="address">Address<sup class="required">*</sup></label>
                            <input type="text" value="{{ get_static_option('address') }}" name="address" id="address"
                                placeholder="Enter address">
                            @error('address')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </fieldset>
                        <fieldset class="ams-input input-verticle">
                            <img src="{{ asset(get_static_option('logo') ?? 'assets/no_image.jpg') }}" id="logo_review"
                                alt="Preview Banner" width="150" height="150" />

                            <label for="logo">Logo<sup class="required">*</sup></label>
                            <input type="file" accept="image/png, image/jpeg, image/jpg" name="logo" id="logo"
                                onchange="document.getElementById('logo_review').src = window.URL.createObjectURL(this.files[0])">
                            @error('logo')
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

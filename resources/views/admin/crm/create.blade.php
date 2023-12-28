@extends('admin.layouts.app')
@push('title')
    Add CRM
@endpush
@push('style')
    <link href="{{ asset('assets/backend/css/select2.min.css') }}" rel="stylesheet" />
@endpush
@section('content')
    <!--  New CRM -->
    <div class="ams-panel-wpr panel-md">
        <div class="ams-panel">
            <div class="panel-heading">
                <h5 class="panel-title">Add CRM</h5>
                <div>
                    @if (check_permission('CRM List'))
                        <a href="{{ route('admin.crm.index') }}" class="btn add-btn"><i class="fas fa-list-ul"></i> CRM List</a>
                    @endif
                </div>
            </div>
            <div class="panel-body">
                <div class="ams-customer-add-form">
                    <form method="POST" action="{{ route('admin.crm.store') }}" enctype="multipart/form-data" class="ams-form">
                        @csrf
                        <fieldset class="ams-input input-verticle">
                            <label for="name">Name<sup class="required">*</sup></label>
                            <input type="text" value="{{ old('name') }}" name="name" id="name" placeholder="Enter Name">
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </fieldset>
                        <fieldset class="ams-input input-verticle">
                            <label for="email">Email<sup class="required">*</sup></label>
                            <input type="email" value="{{ old('email') }}" name="email" id="email" placeholder="Enter Email">
                            @error('email')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </fieldset>

                        <fieldset class="ams-input input-verticle">
                            <label for="phone">Phone<sup class="required">*</sup></label>
                            <input type="number" value="{{ old('phone') }}" name="phone" id="phone" placeholder="Enter Phone">
                            @error('phone')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </fieldset>
                        <fieldset class="ams-input input-verticle">
                            <label for="password">Password<sup class="required">*</sup></label>
                            <input type="password" value="{{ old('password') }}" name="password" id="password"
                            placeholder="Enter Password">
                            @error('password')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </fieldset>
                        <fieldset class="ams-input input-verticle">
                            <img src="{{ asset('assets/no_image.jpg') }}" id="avatar_review"
                                alt="Preview Avatar" width="150" height="150" />

                            <label for="avatar">Avatar</label>
                            <input type="file" accept="image/png, image/jpeg, image/jpg" name="avatar" id="avatar"
                                onchange="document.getElementById('avatar_review').src = window.URL.createObjectURL(this.files[0])">
                            @error('avatar')
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

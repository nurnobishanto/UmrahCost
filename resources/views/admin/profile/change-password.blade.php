@extends('admin.layouts.app')
@push('title')
    Change Password
@endpush
@push('style')
<link href="{{ asset('assets/backend/css/select2.min.css') }}" rel="stylesheet" />
@endpush
@section('content')
    <!--  New User -->
    <div class="ams-panel-wpr panel-md">
        <div class="ams-panel">
            <div class="panel-heading">
                <h5 class="panel-title">Change Password</h5>
            </div>
            <div class="panel-body">
                <div class="ams-customer-add-form">
                    <form method="POST" action="{{ route('admin.changePassword.update') }}" enctype="multipart/form-data" class="ams-form">
                        @csrf
                            <fieldset class="ams-input input-verticle">
                                <label for="name">Old Password<sup class="required">*</sup></label>
                                <input type="password" name="old_password" placeholder="Enter Old Password" required>
                                @error ('old_password')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </fieldset>
                            <fieldset class="ams-input input-verticle">
                                <label for="name">New Password<sup class="required">*</sup></label>
                                <input type="password" name="password" placeholder="Enter New Password" required>
                                @error ('password')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                                @if (session('samePassword'))
                                <span class="text-danger">{{ session('samePassword') }}</span>
                                @endif
                            </fieldset>
                            <fieldset class="ams-input input-verticle">
                                <label for="name">Confirm Password<sup class="required">*</sup></label>
                                <input type="password" name="password_confirmation" placeholder="Enter Confirm Password" required>
                                @error ('password_confirmation')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </fieldset>
                            <fieldset class="text-end">
                                <button type="submit" class="submit-btn btn"><i class="far fa-save"></i> Change</button>
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
        $('.client').hide();
        @error('client')
            $('.client').show();
        @enderror
        $('#role').change(function() {
            var roleID = $(this).val();

            if (roleID == 9) {
                $('.client').show();
            }else{
                $('.client').hide();
            }
        });


    });
</script>

@endpush

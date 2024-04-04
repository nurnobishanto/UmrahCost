@extends('frontend.layouts.app')
@push('title')
     Change Password
@endpush
@push('style')
@endpush
@section('content')
    <main class="trv-main-content" >
        <!-- Sign Modal -->
        <div class="container">
            <div class="row align-items-center">

                <div class="col-md-4">
                    <img class="img-fluid"  src="{{ asset('assets/frontend/images/login-photo.png') }}" alt="Booking">
                </div>
                <div class="col-md-8">
                    @if (session('status'))
                        <div class="mb-4 font-medium text-sm text-green-600">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="sign-modal-wpr">
                        <div class=" modal-content" >
                            <div class="modal-head">
                                <h4 class="mb-0">Create New Password</h4>
                                <!-- <span class="modal-close"><i class="icofont-close-line"></i></span> -->
                            </div>
                            <div class="modal-body">
                                <form class="info-form" action="{{ route('web.verify_otp_change_pass') }}" method="POST">
                                    @csrf
                                    <div class="row">

                                        <div class="col-sm-12">
                                            <fieldset class="input-grp">
                                                <label for="email_or_phone" class="required">Email Address / Phone Number</label>
                                                <div class="inputWithIcon">
                                                    <input type="text" readonly required value="{{$value}}" placeholder="Enter Email Or Phone" id="email_or_phone" name="email_or_phone">
                                                    <i class="icofont-envelope"></i>
                                                </div>
                                                @error('email_or_phone')
                                                <p class="text-danger alert-margin">{{ $message }}</p>
                                                @enderror
                                            </fieldset>
                                        </div>
                                        <div class="col-sm-12">
                                            <fieldset class="input-grp">
                                                <label for="otp" class="required">OTP</label>
                                                <div class="inputWithIcon">
                                                    <input type="text" placeholder="Enter OTP" id="otp" name="otp">
                                                    <i class="icofont-envelope"></i>
                                                </div>
                                                @error('otp')
                                                <p class="text-danger alert-margin">{{ $message }}</p>
                                                @enderror
                                            </fieldset>
                                        </div>
                                        <div class="col-sm-12">
                                            <fieldset class="input-grp">
                                                <label for="pass" class="required">Password</label>
                                                <div class="inputWithIcon">
                                                    <input type="password" placeholder="Enter Password" id="password" name="password">
                                                    <i class="icofont-ui-lock"></i>
                                                    <div class="pass-input">
                                                        <i class="icofont-eye-blocked"></i>
                                                    </div>
                                                </div>
                                                @error('password')
                                                <p class="text-danger alert-margin">{{ $message }}</p>
                                                @enderror
                                            </fieldset>
                                        </div>
                                        <div class="col-sm-12">
                                            <fieldset class="input-grp">
                                                <label for="password_confirmation" class="required">Password</label>
                                                <div class="inputWithIcon">
                                                    <input type="password" placeholder="Enter Confirm Password" id="password_confirmation" name="password_confirmation">
                                                    <i class="icofont-ui-lock"></i>
                                                    <div class="pass-input">
                                                        <i class="icofont-eye-blocked"></i>
                                                    </div>
                                                </div>
                                                @error('password_confirmation')
                                                <p class="text-danger alert-margin">{{ $message }}</p>
                                                @enderror
                                            </fieldset>
                                        </div>

                                    </div>
                                    <button class="trv-btn sign-btn">Update Password</button>
                                </form>
                                <p class="new-acc">Already have an account? <a href="{{route('web.login_view')}}" class="">Login</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </main>
@endsection
@push('script')
@endpush


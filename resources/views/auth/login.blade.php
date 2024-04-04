@extends('frontend.layouts.app')
@push('title')
    Login
@endpush
@push('style')
@endpush
@section('content')
    <main class="trv-main-content" >
        <!-- Sign Modal -->
        <div class="container">
            <div class="row align-items-center">

                <div class="col-md-6 ">
                    <img class="img-fluid"  src="{{ asset('assets/frontend/images/login-photo.png') }}" alt="Booking">
                </div>
                <div class="col-md-6">
                    @if (session('status'))
                        <div class="mb-4 font-medium text-sm text-green-600">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="sign-modal-wpr">
                        <div class="sign-in-content modal-content">

                            <div class="modal-head">

                                <h4 class="mb-0">Sign In</h4>
                                <!-- <span class="modal-close"><i class="icofont-close-line"></i></span> -->
                            </div>
                            <div class="modal-body">
                                <form class="info-form" action="{{ route('web.login') }}" method="POST">
                                    @csrf
                                    <fieldset class="input-grp">
                                        <label for="email_or_phone" class="required">Email Address / Phone Number</label>
                                        <div class="inputWithIcon">
                                            <input name="email_or_phone" type="text" placeholder="Enter Email Or Phone" id="email">
                                            <i class="icofont-envelope"></i>
                                        </div>
                                        @error('email_or_phone')
                                        <p class="text-danger alert-margin">{{ $message }}</p>
                                        @enderror
                                    </fieldset>
                                    <fieldset class="input-grp">
                                        <label for="password" class="required">Password</label>
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
                                    <div class="remember-pass">
                                        <label for="terms"><input type="checkbox" id="terms"> Remember me</label>
                                        <a href="{{route('web.resetPasswordView')}}" >Forget Password</a>
                                    </div>
                                    <button class="trv-btn sign-btn">Sign In</button>
                                </form>
                                <p class="new-acc">Don't have a Zamzam Account yet? <a href="{{route('web.register_view')}}"
                                                                                       class="sign-up-">Create an Account</a></p>
                            </div>
                        </div>

                        <div class="forget-content modal-content">

                            <div class="modal-head">

                                <h4 class="mb-0 ">Forget Password</h4>
                                <!-- <span class="modal-close"><i class="icofont-close-line"></i></span> -->
                            </div>
                            <div class="modal-body">
                                <form class="info-form" action="{{ route('web.resetPassword') }}" method="POST">
                                    @csrf
                                    <fieldset class="input-grp">
                                        <label for="email" class="required">Email Address</label>
                                        <div class="inputWithIcon">
                                            <input name="email" type="email" placeholder="Enter Email Address" id="email">
                                            <i class="icofont-envelope"></i>
                                        </div>
                                        @error('email')
                                        <p class="text-danger alert-margin">{{ $message }}</p>
                                        @enderror
                                    </fieldset>

                                    <button class="trv-btn sign-btn">{{ __('Email Password Reset Link') }}</button>
                                </form>
                                {{--                            <img src="{{ asset('assets/frontend/images/icons/sign-with.png') }}" alt="Sign With" class="w-100">--}}
                                {{--                            <div class="social-login">--}}
                                {{--                                <a href="#" class="social-link" target="_blank" aria-label="facebook">--}}
                                {{--                                    <img src="{{ asset('assets/frontend/images/icons/facebook.png') }}" alt="Facebook">--}}
                                {{--                                    <p>Facebook</p>--}}
                                {{--                                </a>--}}
                                {{--                                <a href="#" class="social-link" target="_blank" aria-label="google">--}}
                                {{--                                    <img src="{{ asset('assets/frontend/images/icons/google.png') }}" alt="Google">--}}
                                {{--                                    <p>Google</p>--}}
                                {{--                                </a>--}}
                                {{--                            </div>--}}
                                <p class="new-acc">Already have an account? <a href="#" class="sign-in-link">Login</a></p>
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


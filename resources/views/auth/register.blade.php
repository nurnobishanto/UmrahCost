@extends('frontend.layouts.app')
@push('title')
     Signup
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
                        <div class=" modal-content" style="max-width: 100%">
                            <div class="modal-head">
                                <h4 class="mb-0">Sign Up</h4>
                                <!-- <span class="modal-close"><i class="icofont-close-line"></i></span> -->
                            </div>
                            <div class="modal-body">
                                <form class="info-form" action="{{ route('web.register') }}" method="POST">
                                    @csrf
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <fieldset class="input-grp">
                                                <label for="first_name" class="required">First Name</label>
                                                <div class="inputWithIcon">
                                                    <input type="text" placeholder="Enter First Name" id="first_name" name="first_name">
                                                    <i class="icofont-envelope"></i>
                                                </div>
                                            </fieldset>
                                        </div>
                                        <div class="col-sm-6">
                                            <fieldset class="input-grp">
                                                <label for="last_name" class="required">Last Name</label>
                                                <div class="inputWithIcon">
                                                    <input type="text" placeholder="Enter Last Name" id="last_name" name="last_name">
                                                    <i class="icofont-envelope"></i>
                                                </div>
                                                @error('last_name')
                                                <p class="text-danger alert-margin">{{ $message }}</p>
                                                @enderror
                                            </fieldset>
                                        </div>
                                        <div class="col-sm-6">
                                            <fieldset class="input-grp">
                                                <label for="email" class="required">Email Address</label>
                                                <div class="inputWithIcon">
                                                    <input type="email" placeholder="Enter Email Address" id="email" name="email">
                                                    <i class="icofont-envelope"></i>
                                                </div>
                                                @error('email')
                                                <p class="text-danger alert-margin">{{ $message }}</p>
                                                @enderror
                                            </fieldset>
                                        </div>
                                        <div class="col-sm-6">

                                            <fieldset class="input-grp">
                                                <label for="phone" class="required">Contact Number</label>
                                                <input name="phone" type="number" placeholder="" id="phone" class="phone" wire:model.defer="phone">
                                                @error('phone')
                                                <p class="text-danger alert-margin">{{ $message }}</p>
                                                @enderror
                                            </fieldset>
                                        </div>

                                        <div class="col-sm-6">
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
                                        <div class="col-sm-6">
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
                                    <button class="trv-btn sign-btn">Sign Up</button>
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


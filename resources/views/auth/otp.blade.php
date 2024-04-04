@extends('frontend.layouts.app')
@push('title')
    OTP Verify
@endpush
@push('style')
@endpush
@section('content')
    <main class="trv-main-content" >
        <!-- Sign Modal -->
        <div class="container">
            <div class="row align-items-center">

                <div class="col-md-6">
                    <img class="img-fluid"  src="{{ asset('assets/frontend/images/login-photo.png') }}" alt="Booking">
                </div>
                <div class="col-md-6">
                    @if (session('status'))
                        <div class="mb-4 font-medium text-sm text-green-600">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="sign-modal-wpr">
                        <div class=" modal-content" >
                            <div class="modal-head">
                                <h4 class="mb-0">OTP Verify</h4>
                                <!-- <span class="modal-close"><i class="icofont-close-line"></i></span> -->
                            </div>
                            <div class="modal-body">
                                <form class="info-form" action="{{ route('web.verifyOtp') }}" method="POST">
                                    @csrf
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <fieldset class="input-grp">
                                                <label for="first_name" class="required">Enter OTP</label>
                                                <div class="inputWithIcon">
                                                    <input type="text" placeholder="Enter OTP" id="otp" name="otp">
                                                    <i class="icofont-envelope"></i>
                                                </div>
                                            </fieldset>
                                        </div>
                                        @error('otp')
                                        <p class="text-danger alert-margin">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <p>OTP Has been sent to <span class="text-primary ">{{$phone}}</span> | <a class="text-danger" href="{{route('web.register_view')}}">Wrong Number</a> </p>
                                    <button class="trv-btn sign-btn">Complete Signup</button>
                                </form>
                                <p class="new-acc">Didn't get otp yet ? <a href="{{route('web.resend_otp')}}" class="">Resend</a></p>
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


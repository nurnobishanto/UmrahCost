@extends('frontend.layouts.app')
@push('title')
    Forget Password
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

                        <div class="modal-content">

                            <div class="modal-head">

                                <h4 class="mb-0 ">Forget Password</h4>
                                <!-- <span class="modal-close"><i class="icofont-close-line"></i></span> -->
                            </div>
                            <div class="modal-body">
                                <form class="info-form" action="{{ route('web.resetPassword') }}" method="POST">
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
                                    <button class="trv-btn sign-btn">Forgot Password</button>
                                </form>
                                <p class="new-acc">Already have an account? <a href="{{route('web.login')}}" >Login</a></p>
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


<!DOCTYPE html>
<html lang="en">

<head>
	@push('title')
		Login
	@endpush
    @include('frontend.layouts.includes.head')
</head>
<body>
    <!-- Header -->
    <header class="trv-header header-static">
        <div class="header-wpr">
            <div class="container">
                <div class="main-header-container">
                    <div class="logo">
                        <a href="{{ route('frontend.index') }}"><img style="width: 100px;" src="{{ asset('assets/frontend/images/header-logo.png') }}" alt="Booking"></a>
                    </div>
                    <div class="toolbar-right">
                        <a href="{{ route('login') }}" class="login-btn">Login or Create Account</a>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <main class="trv-main-content" >
        <!-- Sign Modal -->
        <div class="sign-modal-wpr">
            <div class="sign-in-content modal-content">
                <div class="modal-head">
                    <h4 class="mb-0">Sign In</h4>
                    <!-- <span class="modal-close"><i class="icofont-close-line"></i></span> -->
                </div>
                <div class="modal-body">
					<form class="info-form" action="{{ route('login') }}" method="POST">
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
                            <a href="#">Forget Password</a>
                        </div>
                        <button class="trv-btn sign-btn">Sign In</button>
                    </form>
                    {{-- <img src="{{ asset('assets/frontend/images/icons/sign-with.png') }}" alt="Sign With" class="w-100">
                    <div class="social-login">
                        <a href="#" class="social-link" target="_blank" aria-label="facebook">
                            <img src="{{ asset('assets/frontend/images/icons/facebook.png') }}" alt="Facebook">
                            <p>Facebook</p>
                        </a>
                        <a href="#" class="social-link" target="_blank" aria-label="google">
                            <img src="{{ asset('assets/frontend/images/icons/google.png') }}" alt="Google">
                            <p>Google</p>
                        </a>
                    </div> --}}
                    <p class="new-acc">Don't have a Zamzam Account yet? <a href="#"
                            class="sign-up-link">Create an Account</a></p>
                </div>
            </div>
            <div class="sign-up-content modal-content">
                <div class="modal-head">
                    <h4 class="mb-0">Sign Up</h4>
                    <!-- <span class="modal-close"><i class="icofont-close-line"></i></span> -->
                </div>
                <div class="modal-body">
                	<form class="info-form" action="{{ route('register') }}" method="POST">
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
                                    <input name="phone" type="number" placeholder="" id="phone" class="phone">
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
                    <p class="new-acc">Already have an account? <a href="#" class="sign-in-link">Login</a></p>
                </div>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="footer bg-dark py-2 ">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <div class="social-links">
                        <a href="#" aria-label="facebook" target="_blank"><i class="icofont-facebook"></i></a>
                        <a href="#" aria-label="twitter" target="_blank"><i class="icofont-twitter"></i></a>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="copyright">
                        <p>&copy; 2023 <b>Zamzam Travels</b></p>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- Js files -->
   @include('frontend.layouts.includes.scripts')

</body>

</html>

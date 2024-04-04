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
    <div class="col-sm-6">
        @if (session()->has('message'))
            <div>{{ session('message') }}</div>
        @endif
        <div class="input-group ">
            <input name="otp" type="number" placeholder="Enter OTP" id="otp" class="" >
            <div class="input-group-append">
                <button class="btn btn-primary" type="button" wire:click="sendOTP">Get OTP</button>
            </div>
            @error('otp')
            <p class="text-danger alert-margin">{{ $message }}</p>
            @enderror
        </div>
    </div>
</div>

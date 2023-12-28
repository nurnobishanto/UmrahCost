@extends('layouts.auth')


@section('content')
<div class="register-box">
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <a  class="h1"><b>{{config('app.name')}}</b></a>
    </div>
    <div class="card-body">
      <p class="login-box-msg">Register a new membership</p>

      <form method="POST" action="{{ route('register') }}">
            @csrf

        <div class="input-group mb-3">
          <input type="text"  name="name" :value="old('name')" required autofocus class="form-control" placeholder="Full name">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
          <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>
        <div class="input-group mb-3">
          <input type="email" name="email" :value="old('email')" required  class="form-control" placeholder="Email">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
          <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>
        <div class="input-group mb-3">
          <input type="password" 
                                name="password"
                                required autocomplete="new-password" class="form-control" placeholder="Password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
          <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>
        <div class="input-group mb-3">
          <input type="password" name="password_confirmation" required  class="form-control" placeholder="Retype password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
          <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>
        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" id="agreeTerms" name="terms" value="agree">
              <label for="agreeTerms">
               I agree to the <a href="#">terms</a>
              </label>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">Register</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

   

      <a href="{{route('login')}}" class="text-center">Already registered?</a>
    </div>
    <!-- /.form-box -->
  </div><!-- /.card -->
</div>
      

@endsection        
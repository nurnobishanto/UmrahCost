@extends('layouts.auth')


@section('content')

<div class="login-box">
  <!-- /.login-logo -->
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <a  class="h1"><b>{{config('app.name')}}</b></a>
    </div>
    <div class="card-body">
      <p class="login-box-msg"></p>
      <x-auth-session-status class="mb-4" :status="session('status')" />

        <form method="POST" action="{{ route('login') }}">
            @csrf

        <div class="input-group mb-3">
          <input type="email" name="email" :value="old('email')" required autofocus class="form-control" placeholder="Email">
          <div class="input-group-append">
              <div class="input-group-text">
                  <span class="fas fa-envelope"></span>
                </div>
          </div>
          <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>
        <div class="input-group mb-3">
          <input type="password" name="password" required autocomplete="current-password" class="form-control" placeholder="Password">
          <div class="input-group-append">
              <div class="input-group-text">
                  <span class="fas fa-lock"></span>
                </div>
            </div>
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>
        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" name="remember" id="remember">
              <label for="remember">
                Remember Me
              </label>
              
            </div>
            @if (Route::has('password.request'))
                    <a class="btn btn-sm btn-primary" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      <!-- /.social-auth-links -->

    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</div>
 
@endsection

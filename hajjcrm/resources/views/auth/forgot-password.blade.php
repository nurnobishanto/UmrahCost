@extends('layouts.auth')


@section('content')
<div class="login-box">
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <a  class="h1"><b>{{config('app.name')}}</b></a>
    </div>
    <div class="card-body">
      <p class="login-box-msg">You forgot your password? Here you can easily retrieve a new password.</p>
      <form method="post" action="{{ route('password.email') }}">
            @csrf
        <div class="input-group mb-3">
          <input type="email" class="form-control" placeholder="Email" name="email" :value="old('email')" required autofocus />

          <div class="input-group-append">
              <div class="input-group-text">
                  <span class="fas fa-envelope"></span>
                </div>
            </div>
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>
        <div class="row">
          <div class="col-12">
            <button type="submit" class="btn btn-primary btn-block">Request new password</button>
          </div>
          <!-- /.col -->
        </div>
      </form>
      
    </div>
  </div>
</div>
        
@endsection  

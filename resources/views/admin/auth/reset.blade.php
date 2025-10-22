@extends('admin.auth.layout')

@section('content')
<div class="login-box">
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <a href="{{ url('/') }}" class="h1"><b>Admin</b> {{ config('app.name') }}</a>
    </div>
    <div class="card-body">
       @include('include.messages')
      <p class="login-box-msg">You are only one step a way from your new password, recover your password now.</p>
        <form action="{{ route('admin.reset.password.attempt') }}" method="POST">
        @csrf
        
        <input type="hidden" name="token" value="{{ $token }}">
        
        <div class="input-group mb-3">
        <input type="email" name="email" class="form-control" value="{{ old('email') }}" placeholder="Enter your email" required />
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        
        <div class="input-group mb-3">
          <input type="password" name="password" value="{{ old('password') }}" placeholder="New password" class="pass-input form-control" required />
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>

        <div class="input-group mb-3">
        <input type="password" name="password_confirmation" value="{{ old('password_confirmation') }}" placeholder="Confirm New Password" class="pass-input form-control" required />
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        
        <div class="row">
          <div class="col-12">
            <button type="submit" class="btn btn-primary btn-block">Change password</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      <p class="mt-3 mb-1">
        <a href="{{ route('admin.login') }}">Login</a>
      </p>
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
@endsection
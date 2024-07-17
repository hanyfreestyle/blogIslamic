@extends('admin.layouts.appLogin')

@section('content')
  <div class="login-box">
    <div class="card card-outline card-primary">
      <div class="card-header text-center">
        @if ( config('adminConfig.login_logo_img_view') == true)
          <img class="img-fluid login_logo" src=" {{ config('adminConfig.login_logo_img') }}">
        @endif
      </div>
      <div class="card-body">
        <form method="POST" action="{{ route('AdminLoginCheck') }}">
          @csrf
          <div class="input-group mb-3">
            <input id="email" type="email" placeholder="Email" class="form-control @error('email') is-invalid @enderror" name="email"
                   value="{{ old('email') }}" required autocomplete="email">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-envelope"></span>
              </div>
            </div>
            @error('email')
            <span class="invalid-feedback" role="alert">
                             <strong>{{ $message }}</strong>
                        </span>
            @enderror
          </div>
          <div class="input-group mb-3">
            <input id="password" type="password" placeholder="Password" class="form-control @error('password') is-invalid @enderror"
                   name="password" required autocomplete="current-password">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
            @error('password')
            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                        </span>
            @enderror

          </div>
          <div class="row">
            <div class="col-12">
              <button type="submit" class="btn btn-primary btn-block">Sign In</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
@endsection

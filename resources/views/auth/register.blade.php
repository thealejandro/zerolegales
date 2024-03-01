@extends('login.layouts.master')
@section('pageTitle',__('test.register'))
@section('content')
<div class="register-box">
  <div class="register-logo">
    <a href="#"><b>{{ __('test.sign-up') }}</b></a>
  </div>

  <div class="card">
    <div class="card-body register-card-body">
      <p class="login-box-msg">{{ __('test.register-new-membership')}}</p>

      <form method="POST" action="{{ route('register') }}">
                        @csrf
        <div class="input-group mb-3">
            <input id="name" type="text" placeholder="{{__('test.full-name')}}" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}"  autocomplete="name" autofocus>
            <div class="input-group-append">
                <div class="input-group-text">
                <span class="fas fa-user f_login"></span>
                </div>
            </div>
             @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="input-group mb-3">
            <input id="email" type="text"  placeholder="{{__('test.email')}}" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}"  autocomplete="email">
            <div class="input-group-append">
                <div class="input-group-text">
                <span class="fas fa-envelope f_login"></span>
                </div>
            </div>
            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="input-group mb-3">
            <input id="password" type="password" placeholder="{{__('test.password')}}" class="form-control @error('password') is-invalid @enderror" name="password"  autocomplete="new-password">
            <div class="input-group-append">
                <div class="input-group-text">
                <span class="fas fa-lock f_login"></span>
                </div>
            </div>

            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="input-group mb-3">
            <input id="password-confirm" type="password" placeholder="{{ __('test.retype-password')}}" class="form-control" name="password_confirmation"  autocomplete="new-password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock f_login"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <!-- /.col -->
          <div class="col-lg-12">
            <button type="submit" class="btn btn-primary btn-block">{{__('test.sign-up')}}</button>
          </div>
          <!-- /.col -->
        </div>
      </form>
      <div class="d-flex justify-content-between">    
      @if (Route::has('password.request'))
      <p>
        <a class="p_login" href="{{ route('password.request') }}">{{ __('test.forgot-password') }}</a>
      </p>
      @endif
      <p>
        <a class="p_login" href="{{ route('login') }}" class="text-center">{{ __('test.login') }}</a>
      </p>
      
      </div>
    </div>
    <!-- /.form-box -->
  </div><!-- /.card -->
</div>
@endsection

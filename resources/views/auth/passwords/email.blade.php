@extends('login.layouts.master')
@section('pageTitle',__('test.forgot-password'))
@section('content')
<div class="login-box">
  <div class="login-logo">
    <a href="#"><b>{{ __('test.forgot-password') }}</b></a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">{{ __('test.forgot-def') }}</p>

      <form method="POST" action="{{ route('password.email') }}">
                        @csrf
        <div class="input-group mb-3">
            <input id="email" type="text"  placeholder="{{ __('test.email') }}" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}"  autocomplete="email" autofocus>
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
        <div class="row">
          <div class="col-12">
            <button type="submit" class="btn btn-primary btn-block">{{ __('test.request-new-password')}}</button>
          </div>
          <!-- /.col -->
        </div>
      </form>
      <div class="pull-right">   
      <p>
        <a class="p_login" href="{{ route('login') }}">{{ __('test.login')}}</a>
      </p>
      </div>
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
@endsection

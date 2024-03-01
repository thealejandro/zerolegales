@extends('login.layouts.master')
@section('pageTitle',__('test.login'))
@section('content')
<div class="auth-content">
            <div class="card o-hidden">
                <div class="row">
                    <div class="col-md-6">
                        <div class="p-4">
                            <div class="auth-logo text-center mb-4">
                                <img src="{{asset('assets/images/logo_image.png')}}" alt="">
                            </div>
                            <h1 class="mb-3 text-18">{{ __('test.sign_in') }}</h1>
                            <form action="{{ route('admin_login') }}" method="post">
                              @csrf
                                <div class="form-group">
                                    <label for="email">{{__('test.email-address')}}</label>
                                    <input name="email" id="email" class="form-control form-control-rounded" type="email" value="{{ old('email') }}"  autocomplete="email" autofocus>
                                    @if($errors->has('email'))
                                    <span class="text-danger">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="password">{{ __('test.password') }}</label>
                                    <input id="password" name="password" class="form-control form-control-rounded" type="password" autocomplete="current-password">
                                    @if($errors->has('password'))
                                    <span class="text-danger">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <button type="submit" class="btn btn-rounded btn-primary btn-block mt-2">{{ __('test.sign_in') }}</button>

                            </form>

                            <!-- <div class="mt-3 text-center">
                            @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}" class="text-muted"><u>{{ __('test.forgot-password') }}</u></a>
                            @endif 
                            </div> -->
                        </div>
                    </div>
                    <!-- <div class="col-md-6 text-center" style="background-size: cover;background-image: url(./assets/images/photo-long-3.jpg)">
                        <div class="pr-3 auth-right">
                            <a class="btn btn-rounded btn-outline-primary btn-outline-email btn-block btn-icon-text" href="signup.html">
                                <i class="i-Mail-with-At-Sign"></i> Sign up with Email
                            </a>
                            <a class="btn btn-rounded btn-outline-primary btn-outline-google btn-block btn-icon-text">
                                <i class="i-Google-Plus"></i> Sign up with Google
                            </a>
                            <a class="btn btn-rounded btn-outline-primary btn-block btn-icon-text btn-outline-facebook">
                                <i class="i-Facebook-2"></i> Sign up with Facebook
                            </a>
                        </div>
                    </div> -->
                </div>
            </div>
        </div>
@endsection

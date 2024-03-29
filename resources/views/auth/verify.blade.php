@extends('login.layouts.master')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('test.Verify Your Email Address') }}</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('test.A fresh verification link has been sent to your email address') }}
                        </div>
                    @endif

                    {{ __('test.Before proceeding, please check your email for a verification link') }}
                    {{ __('test.If you did not receive the email') }},
                    <a onclick="event.preventDefault(); document.getElementById('email-form').submit();">{{ __('test.click here to request another') }}
                    </a>.

                    <form id="email-form" action="{{ route('verification.resend') }}" method="POST" style="display: none;">
                                        @csrf
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

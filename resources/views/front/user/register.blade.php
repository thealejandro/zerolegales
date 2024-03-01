<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="{{asset('front/assets/css/main.min.css')}}">
    <link rel="icon" href="{{asset('front/assets/img/favicon.ico')}}">
    <title>{{ config('app.name') }}  | {{__('test.register')}}</title>
</head>

<body class="register-wrap">
<header class="main-header-login">
</header>
    <main class="register-page">
        <section>
            <div class="container-fluid">
                <div class="row full-height">
                    <div class="col-lg-5 col-sm-12">
                        <div class="register-form-wrap">
                            <div class="logo-blue-wrap">
                                <img src="{{asset('front/assets/img/logo-blue.svg')}}" class="lazyload"/>
                            </div>
                            <!-- social login -->
                            <div class="social-connect">
                                <div class="BodySmall-2 text-center">
                                    Ingresar con:
                                </div>
                                <div class="social-bt-icon d-flex justify-content-center">

                                    <!-- <a href="{{ url('login/facebook')}}" class="btn btn-social bg-white btn-w-icon">
                                        <img src="{{asset('front/assets/img/icons-sociall-fb-logo.svg')}}" class="lazyload"/>
                                        Facebook</a> -->
                                    <a href="{{ url('login/google') }}" class="btn btn-social bg-white btn-w-icon">
                                        <img src="{{asset('front/assets/img/icons-social-google-logo.svg')}}" class="lazyload"/>
                                        Google</a>
                                </div>
                            </div>

                            <!-- registration form -->
                            <div class="reg-form">
                            @include('front.includes.flash-message')
                                <div class="BodySmall-2">
                                    Crear una cuenta con su correo:
                                </div>
                                <div class="form-reg">
                                    <form method="POST" id="userForm" action="{{ route('user.store') }}">
                                        @csrf
                                        <div class="form-group">
                                            <label class="Ttulo">Nombre(s):</label>
                                            <input type="text" class="form-control" name="first_name" id="first_name" placeholder="Escribir nombre(s)…" value="{{ old('first_name') }}" autocomplete="first_name" autofocus>
                                            @if($errors->has('first_name'))
                                                <label class="val-error">
                                                    {{ $errors->first('first_name') }}
                                                </label>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label class="Ttulo">Apellido(s):</label>
                                            <input type="text" class="form-control" name="surname" id="surname" placeholder="Escribir apellido(s)…" value="{{ old('surname') }}" autocomplete="surname">
                                            @if($errors->has('surname'))
                                                  <label class="val-error">
                                                    {{ $errors->first('surname') }}
                                                 </label>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label class="Ttulo">Correo electrónico:</label>
                                            <input type="email" class="form-control" placeholder="Escribir Correo…"  name="email" id="email" value="{{ old('email') }}" autocomplete="email">
                                            @if($errors->has('email'))
                                                <label class="val-error">
                                                    {{ $errors->first('email') }}
                                                </label>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label class="Ttulo">Contraseña:</label>
                                            <input type="password" class="form-control" placeholder="Escribir contraseña…" id="password" name="password" autocomplete="new-password" onCopy="return false" onDrag="return false" onDrop="return false" onPaste="return false">
                                            @if($errors->has('password'))
                                                  <label class="val-error">
                                                    {{ $errors->first('password') }}
                                                 </label>
                                            @endif
                                        </div>
                                        <div class="form-group confirm-val">
                                            <label class="Ttulo">Confirmar contraseña:</label>
                                            <input type="password" class="form-control" placeholder="Confirmar contraseña:" id="confirm_password" name="password_confirmation"  autocomplete="new-password" onCopy="return false" onDrag="return false" onDrop="return false" onPaste="return false">
                                            <span class="val-icon">
                                            <i class="icon-icons-checkmark-checkmark-1 icon-true"  style="display:none"></i>
                                            <!-- uncomment when error -->
                                                <i class="icon-icons-alert-circle1 icon-error" style="display:none"></i>
                                                  <!-- uncomment when error -->
                                             </label>
                                            @if($errors->has('password_confirm'))
                                                  <label class="val-error">
                                                    {{ $errors->first('password_confirm') }}
                                                 </label>
                                            @endif
                                            <span class="val-error"> </label>
                                        </div>
                                        <div class="form-group d-flex justify-content-center cst-agree-reg">
                                            <div class="custom-control cst-checkbox custom-checkbox">
                                                <input type="checkbox" name="terms_conditions" class="custom-control-input" id="customCheck1" value="1">
                                                <label class="custom-control-label ml-1" for="customCheck1">Aceptar terminos y condiciones.</label><br>
                                                <span id="error_msg1"> </label>
                                            </div>
                                            @if($errors->has('terms_conditions'))
                                              <label class="val-error">
                                                {{ $errors->first('terms_conditions') }}
                                             </label>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <button class="btn btn-comon btn-blue d-full" type="submit">Registrar</button>
                                            <!-- <a href="#" class="btn btn-comon btn-blue d-full" data-toggle="modal" data-target="#modalLoginError">Registrar</a> -->
                                        </div>
                                        <!-- extra links -->
                                        <div class="extra-links">
                                            <ul class="list-inline">
                                                <li class="list-inline-item">
                                                <a class="BodyBody-2" href="{{route('user.forgot.password')}}">Olvidé Contraseña</a>
                                                </li>
                                                <li class="list-inline-item">
                                                    <a class="BodyBody-2" href="{{route('login')}}">Iniciar Sesión</a>
                                                </li>
                                            </ul>
                                        </div>

                                        <!-- termscondition -->
                                        <div class="condition-link">
                                            <a class="BodySmall-Center-2" href="#" data-toggle="modal" data-target="#termsandcondition">Terminos y condiciones</a>
                                            <!-- <a class="BodySmall-Center-2" href="" data-toggle="modal" data-target="#modalDisableUser">Terminos y condiciones</a> -->
                                        </div>
                                    </form>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="col-md-7 bg-blue-draw">
                        <div class="people-img-wrap">
                            <img src="{{asset('front/assets/img/illustraction/people.png')}}" class="img-fluid lazyload" />
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
  <!-- Modal for Terms and Conditions-->
  <div class="modal fade terms_cond" id="termsandcondition" tabindex="-1" role="dialog" aria-labelledby="termsandconditionLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
        <button type="button" class="close mdl-cls" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="icon-icons-close-close-1"></i></span>
                </button>
            <div class="modal-body">
        <div class="row flx-vcenter">
        
            <div class="col-md-12">
                <div class="SignContentModal">
                <h2 class="HeadlineH3-2 text-left">Terminos y Condiciones</h2>
                <div class="mCustomScrollbar" >
                <!-- <p  class="" >
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.  Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                </p><p>
Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                </p> -->
                {!!$conditions->condition_text!!}
                </div>
                </div>
            </div>
            
        </div>
            </div>
        
        </div>
    </div>
</div>
<!-- Modal for Terms and Conditions-->
    @include('front.layouts.footer')
    @include('front.layouts.js_footer')
    <script src="{{ asset('front/assets/custom/js/user.js')}}"></script>
    <script>
    $('#password, #confirm_password').on('keyup', function () {
    if ($('#password').val() == $('#confirm_password').val()) {
        $('.icon-true').show();
        $('.icon-error').hide();

    }
    else {
        $('.icon-true').hide();
        $('.icon-error').show();

    }

});
</script>
</body>

</html>
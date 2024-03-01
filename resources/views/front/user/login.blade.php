<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="{{asset('front/assets/css/main.min.css')}}">
    <link rel="icon" href="{{asset('front/assets/img/favicon.ico')}}">
    <title>{{ config('app.name') }}  | {{__('test.login')}}</title>
</head>

<body class="register-wrap login-wrap">
<header class="main-header-login">
</header>
    <main class="login-page">
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

                                <div class="social-bt-icon d-flex justify-content-center">

                                    <!-- <a href="{{ url('login/facebook')}}" class="btn btn-social bg-white btn-w-icon">
                                        <img src="{{asset('front/assets/img/icons-sociall-fb-logo.svg')}}"  class="lazyload"/>
                                        Facebook</a> -->
                                    <a href="{{ url('login/google') }}" class="btn btn-social bg-white btn-w-icon">
                                        <img src="{{asset('front/assets/img/icons-social-google-logo.svg')}}" class="lazyload"/>
                                        Google</a>
                                </div>
                            </div>

                            <!-- login form -->
                            <div class="reg-form">

                                <div class="form-reg">
                                
                                    
                                    <form id="loginForm" action="{{ route('login') }}" method="post">
                                        @csrf
                                        <div class="form-group confirm-val">
                                            <label class="Ttulo">Correo electrónico:</label>
                                            <input type="email" class="form-control" placeholder="Escribir correo…" value="{{ old('email') }}" id="email" name="email" autocomplete="email" autofocus>
                                            <span class="val-icon">
                                               <!-- uncomment when true -->
                                                <i class="icon-icons-checkmark-checkmark-1 icon-true d-none"></i>
                                                <!-- uncomment when true -->
                                                @if($errors->has('email'))
                                                    <i class="icon-icons-alert-circle1 icon-error"></i>
                                                @else
                                                    <i class="icon-icons-alert-circle1 icon-error d-none"></i>
                                                @endif
                                            </span>
                                            @if($errors->has('email'))
                                                <label class="val-error">
                                                    {{ $errors->first('email') }}
                                                </label>
                                            @endif
                                            <!--  uncomment validation message -->
                                            <!-- <span class="val-error">No hay ninguna cuenta con este correo. Pruebe de nuevo.</span> -->
                                            <!--  uncomment validation message -->
                                        </div>
                                        <div class="form-group confirm-val">
                                            <label class="Ttulo">Contraseña:</label>
                                            <input type="password" class="form-control" placeholder="Escribir contraseña…" name="password" autocomplete="current-password" onCopy="return false" onDrag="return false" onDrop="return false" onPaste="return false">
                                            <span class="email val-icon">
                                                <!-- uncomment when true -->
                                                <!-- <i class="icon-icons-checkmark-checkmark-1 icon-true" style="display:none"></i> -->
                                                <!-- uncomment when true -->
                                                @if($errors->has('email'))
                                                    <i class="icon-icons-alert-circle1 icon-error"></i>
                                                @endif

                                            </span>
                                            @if($errors->has('password'))
                                                <label class="val-error">
                                                    {{ $errors->first('password') }}
                                                </label>
                                            @endif
                                            <!-- <span class="val-error">Las contraseñas no coinciden.</span> -->
                                        </div>
                                        <div class="form-group d-flex justify-content-center mb-0 agree_tp">
                                            <div class="custom-control cst-checkbox custom-checkbox">
                                                <input type="checkbox" name="remember" class="custom-control-input" checked id="rememberdata" {{ old('remember') ? 'checked' : '' }}>
                                                <label class="custom-control-label ml-1" for="rememberdata">Recordar mis datos</label>
                                            </div>

                                        </div>
                                        <div class="form-group log-mt-95">
                                            <!-- <a href="../documentlist.php" class="btn btn-comon btn-blue d-full">Ingresar</a> -->
                                            <button type="submit" class="btn btn-comon btn-blue d-full">Ingresar</button>

                                        </div>
                                        <!-- extra links -->
                                        <div class="extra-links">
                                            <ul class="list-inline">
                                                <li class="list-inline-item">
                                                    <a class="BodyBody-2" href="{{route('user.forgot.password')}}">Olvidé Contraseña</a>
                                                </li>
                                                <li class="list-inline-item">
                                                    <a class="BodyBody-2" href="{{route('user.create')}}">Registrarme</a>
                                                </li>
                                            </ul>
                                        </div>

                                        <!-- termscondition -->
                                        <div class="condition-link">

                                            <a class="BodySmall-Center-2" href="https://www.herramientaslegales.com/politica-de-privacidad">Política de Privacidad</a>
                                            <a class="BodySmall-Center-2" data-toggle="modal" data-target="#termsandcondition"  href="#">Terminos y condiciones</a>
                                        </div>
                                    </form>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="col-md-7 bg-blue-draw">
                        <div class="people-img-wrap">
                            <img src="{{asset('front/assets/img/illustraction/login-page.png')}}" class="img-fluid lazyload" />
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    @include('front.layouts.footer')
    @include('front.layouts.js_footer')

    <!-- Modal for Login Error-->
    <div class="modal fade modal-error" id="modalLoginError" tabindex="-1" role="dialog" aria-labelledby="modalLoginErrorLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
            <button type="button" class="close mdl-cls" data-dismiss="modal" aria-label="Close">
                        {{-- <span aria-hidden="true"><i class="icon-icons-close-close-1"></i></span> --}}
                    </button>
                <div class="modal-body">
            <div class="row flx-vcenter">
                <div class="col-md-5">
                    <div class="helloIllustraction">
                        <img src="{{asset('front/assets/img/illustraction/error.png')}}" class="img-fluid lazyload"/>
                    </div>
                </div>
                <div class="col-md-7">
                    <div class="SignContentModal">
                    <h2 class="HeadlineH2-2">¡Oh no!</h2>
                    <h4 class="HeadlineH4-2 ">{{ Session::get('modal_login_error') }}</h4>
                    <div class="reg-bt-choose">
                    <a href="{{route('login')}}" class="btn btn-comon btn-blue">Intentar de Nuevo</a>
            
                    </div>
                    </div>
                </div>
                
            </div>
                </div>
            
            </div>
        </div>
    </div>
    <div class="modal fade modal-error" id="modalVerifcationError" tabindex="-1" role="dialog" aria-labelledby="modalVerifcationErrorLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
            <button type="button" class="close mdl-cls" data-dismiss="modal" aria-label="Close">
                        {{-- <span aria-hidden="true"><i class="icon-icons-close-close-1"></i></span> --}}
                    </button>
                <div class="modal-body">
            <div class="row flx-vcenter">
                <div class="col-md-5">
                    <div class="helloIllustraction">
                        <img src="{{asset('front/assets/img/illustraction/error.png')}}" class="img-fluid lazyload"/>
                    </div>
                </div>
                <div class="col-md-7">
                    <div class="SignContentModal">
                    <h2 class="HeadlineH2-2">Verifique su correo electrónico</h2>
                    <h4 class="HeadlineH4-2 ">{{ Session::get('modal_verification_error') }}</h4>
                    <div class="reg-bt-choose">
                    <a href="{{route('login')}}" class="btn btn-comon btn-blue">Intentar de Nuevo</a>
            
                    </div>
                    </div>
                </div>
                
            </div>
                </div>
            
            </div>
        </div>
    </div>
    <!-- Modal for Login Error-->
     <!-- Modal for Disabled User Error-->
     <div class="modal fade modal-error" id="modalDisableUser" tabindex="-1" role="dialog" aria-labelledby="modalDisableUserLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
            <button type="button" class="close mdl-cls" data-dismiss="modal" aria-label="Close">
                        {{-- <span aria-hidden="true"><i class="icon-icons-close-close-1"></i></span> --}}
                    </button>
                <div class="modal-body">
               <div class="row flx-vcenter">
                   <div class="col-md-5">
                       <div class="helloIllustraction">
                           <img src="{{asset('front/assets/img/illustraction/error.png')}}" class="img-fluid"/>
                       </div>
                   </div>
                   <div class="col-md-7">
                       <div class="SignContentModal">
                       <h2 class="HeadlineH2-2">¡Oh no!</h2>
                       <h4 class="HeadlineH4-2 "> {{ Session::get('modal_message_error') }}</h4>
                       <div class="reg-bt-choose">
                        <a href="mailto:anjalykjoy@gmail.com" class="btn btn-comon btn-blue btn-w-icon"><i class="icon-icons-email"></i>Contactar a Soporte </a>
                       </div>
                    </div>
                   </div>
                   
               </div>
                </div>
              
            </div>
        </div>
    </div>
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
    @if(Session::get('modal_message_error'))
    <script type="text/javascript">
        $(document).ready(function() {
            $('#modalDisableUser').modal();
        });
    </script>
    @endif
    @if(Session::get('modal_login_error'))
    <script type="text/javascript">
        $(document).ready(function() {
            $('#modalLoginError').modal();
        });

    </script>
    @endif
    @if(Session::get('modal_verification_error'))
    <script type="text/javascript">
        $(document).ready(function() {
            $('#modalVerifcationError').modal();
        });

    </script>
    @endif
    <script src="{{ asset('front/assets/custom/js/login.js')}}"></script>
</body>

</html>
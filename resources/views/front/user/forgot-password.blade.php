<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="{{asset('front/assets/css/main.min.css')}}">
    <link rel="icon" href="{{asset('front/assets/img/favicon.ico')}}">
    <title>{{ config('app.name') }}  | {{__('test.Forgot password')}}</title>
</head>

<body class="register-wrap forgot-wrap">
<header class="main-header-login">
</header>
    <main class="forgot-page">
        <section>
            <div class="container-fluid">
                <div class="row full-height">
                    <div class="col-lg-5 col-sm-12">
                        <div class="register-form-wrap forgot_pass_wrp">
                            <div class="logo-blue-wrap">
                                <img src="{{asset('front/assets/img/logo-blue.svg')}}" class="lazyload"/>
                            </div>
                            <!-- forgotpass instruction -->
                            <div class="forgot-inst">
                                <h6 class="HeadlineH6-Blue-2 ">¿No recuerda su contraseña?</h6>
                                <p class="BodyBody-2">¡No hay problema! A todos nos pasa y por eso tenemos la solución. Solo tiene que indicar su correo electrónico que usa en su cuenta para que podamos enviarle la opción de restablecer su contraseña y así podrá ingresar de nuevo sin ningun problema.</p>
                            </div>

                            <!-- forgotpassword form -->
                            <div class="reg-form">

                                <div class="form-reg">
                                    <form id="forgotForm" method="POST">
                                        {{csrf_field()}}
                                        <div class="form-group confirm-val mb-0">
                                            <label class="Ttulo">Correo electrónico:</label>
                                            <input type="email" class="form-control" name="email" id="email" placeholder="Escribir correo…">
                                            <span class="val-icon">
                                                <i class="icon-icons-checkmark-checkmark-1 emailtrue icon-true d-none"></i>
                                                <!-- uncomment when error -->
                                                <i class="icon-icons-alert-circle1 emailerror icon-error d-none"></i>
                                                <!-- uncomment when error -->
                                            </span>
                                            <!--  uncomment validation message -->
                                            <span class="val-error">No hay ninguna cuenta con este correo. Pruebe de nuevo.</span>
                                            <!--  uncomment validation message -->
                                        </div>
                              
                                        <div class="form-group log-mt-95">
                                            <button type="submit" class="btn btn-comon btn-blue d-full submitForgot">Enviar Correo</a>
                                        </div>
                                        <!-- extra links -->
                                        <div class="extra-links">
                                            <ul class="list-inline">
                                                <li class="list-inline-item">
                                                    <a class="BodyBody-2" href="{{route('login')}}">Iniciar Sesión</a>
                                                </li>
                                                <li class="list-inline-item">
                                                    <a class="BodyBody-2" href="{{route('user.create')}}">Registrarme</a>
                                                </li>
                                            </ul>
                                        </div>

                                        <!-- termscondition -->
                                        <div class="condition-link">
                                            <a class="BodySmall-Center-2" href="#" data-toggle="modal" data-target="#termsandcondition">Terminos y condiciones</a>
                                        </div>
                                    </form>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="col-md-7 bg-blue-draw">
                        <div class="people-img-wrap">
                            <img src="{{asset('front/assets/img/illustraction/forgotpass.png')}}" class="img-fluid lazyload" />
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
    <script src="{{ asset('front/assets/custom/js/login.js')}}"></script>
</body>

</html>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="{{asset('front/assets/css/main.min.css')}}">
    <link rel="icon" href="{{asset('front/assets/img/favicon.ico')}}">
    <title>HerramientasLegales | Nueva contraseña</title>
    <!-- <title>{{ config('app.name') }}  | {{__('test.login')}}</title> -->
</head>

<body class="register-wrap newpassword-wrap">
<header class="main-header-login">
</header>
    <main class="newpassword-page">
        <section>
            <div class="container-fluid">
                <div class="row full-height">
                    <div class="col-lg-5 col-sm-12">
                        <div class="register-form-wrap">
                            <div class="logo-blue-wrap">
                                <img src="{{asset('front/assets/img/logo-blue.svg')}}" class="lazyload"/>
                            </div>


                            <!-- newpassword form -->
                            <div class="reg-form">
                                <div class="HeadlineH4-2 ">
                                    Cambiar Contraseña
                                </div>
                                <div class="form-reg">
                                    <form id="newPasswordForm" method="POST">
                                        {{csrf_field()}}
                                        <div class="form-group confirm-val">
                                            <label class="Ttulo">Nueva Contraseña:</label> 
                                            <input type="password" class="form-control" name="password" id="password" placeholder="Escribir contraseña…">
                                            <span class="val-icon">
                                                <!-- <i class="icon-icons-checkmark-checkmark-1 icon-true d-none"></i> -->
                                                <!-- uncomment when error -->
                                                <!-- <i class="icon-icons-alert-circle1 icon-error d-none"></i> -->
                                                <!-- uncomment when error -->
                                            </span>
                                            <!--  uncomment validation message -->
                                            <span class="val-error d-none">por favor ingrese una contraseña válida</span>
                                            <!--  uncomment validation message -->
                                        </div>
                                        <div class="form-group confirm-val mb-0">
                                            <label class="Ttulo">Repetir Contraseña:</label>
                                            <input type="password" class="form-control" name="confirm_password" id="confirm_password" placeholder="Escribir contraseña…">
                                            <span class="val-icon">
                                                <i class="icon-icons-checkmark-checkmark-1 icon-true d-none"></i>
                                                <!-- uncomment when error -->
                                                <i class="icon-icons-alert-circle1 icon-error d-none"></i>
                                                <!-- uncomment when error -->
                                            </span>
                                            <!--  uncomment validation message -->
                                            <span class="val-error d-none">por favor ingrese una contraseña válida</span>
                                            <!--  uncomment validation message -->
                                        </div>
                                        <input type="hidden" name="user_id" id="user_id" value="{{$id}}">

                                        <div class="form-group log-mt-65">
                                        <button type="submit" class="btn btn-comon btn-blue d-full newPasswordSubmit">Confirmar Contraseña</a>
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
                <p  class="" >
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.  Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                </p><p>
Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                </p>
        
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
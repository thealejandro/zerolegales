<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="{{asset('front/assets/css/main.min.css')}}">
    <link rel="icon" href="{{asset('front/assets/img/favicon.ico')}}">
    <title>{{ config('app.name') }}  | {{__('test.Registration Complete')}}</title>
</head>

<body class="register-wrap forgot-wrap messages-page">
<header class="main-header-login">
</header>
    <main class="forgot-page">
        <section>
            <div class="container-fluid">
                <div class="row full-height">
                    <div class="col-lg-5 col-sm-12">
                        <div class="register-form-wrap">
                            <div class="logo-blue-wrap">
                                <img src="{{asset('front/assets/img/logo-blue.svg')}}" class="lazyload"/>
                            </div>
                            <!-- forgotpass instruction -->
                            <div class="forgot-inst">
                                <h6 class="HeadlineH3-2 ">¡Cuenta creada!</h6>
                                <p class="HeadlineH4-2">Su cuenta ha sido creada exitosamente. Consulte su correo electrónico para verificar su cuenta.</p>
                            </div>

                            <!-- login form -->
                            <div class="reg-form">

                                <div class="form-reg">
                                    <form>

                              
                                        <div class="form-group log-mt-60">
                                            <a href="{{route('login')}}" class="btn btn-comon btn-blue d-full">Regresar a Login</a>
                                        </div>
                                    

                                     
                                    </form>
                                </div>
                            </div>
   <!-- termscondition -->
   <div class="condition-link">
                                            <a class="BodySmall-Center-2" href="#">Terminos y condiciones</a>
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
    @include('front.layouts.footer')
    @include('front.layouts.js_footer')
</body>

</html>
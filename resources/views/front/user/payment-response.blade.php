@extends('front.layouts.payment-master')
@section('pageTitle',__('test.Document List'))
@section('content')


<!-- <!doctype html>
<html lang="en"> -->





<header class="main-header">
    <div class="container-fluid h-100 p-0 d-flx flx-vcenter">
        <div class="logo hl-brand-bg">

            <a href="{{route('document.index')}}"><img src="{{asset('front/assets/img/logo-horizontal.svg')}}" alt="Herramientas Legales" title="Herramientas Legales"></a>

        </div>
        <div class="header-right  d-flx flx-vcenter">
            <!-- Menu Bar -->
            <nav class="main-nav">
                    @guest
                        <ul class="mr-auto">
                            <li><a href="">Inicio</a></li>
                            <li {{ request()->route()->getName() === 'document.index' ? 'class=active' : '' }}><a href="{{route('document.index')}}">Documentos</a></li>
                            <li {{ request()->route()->getName() === 'myfolder.list' ? 'class=active' : '' }}><a href="{{route('myfolder.list')}}">Mi Carpeta</a></li>
                            <li {{ request()->route()->getName() === 'price.index' ? 'class=active' : '' }}><a href="{{route('price.index')}}">Precios</a></li>
                        </ul>
                    @endguest
                    @if (Auth::check())
                        <ul class="mr-auto">
                            <li><a href="">Inicio</a></li>
                            <?php /*<li  {{ request()->route()->getName() === 'user.document' ? 'class=active' : '' 
                            || request()->route()->getName() === 'user.document.show' ? 'class=active' : '' 
                            || request()->route()->getName() === 'user.nosubscription.create.fill.buy' ? 'class=active' : ''
                             || request()->route()->getName() === 'user.nosubscription.show.buy.fill' ? 'class=active' : '' 
                             || request()->route()->getName() === 'user.document.purchase.after' ? 'class=active' : '' 
                             || request()->route()->getName() === 'user.document.filling.process' ? 'class=active' : '' 
                             || request()->route()->getName() === 'user.subscription.create.document.fill' ? 'class=active' : '' }}>
                             <a href="{{route('user.document')}}">Documentos</a></li>
                            */?>
                            <li    
                                @if(request()->route()->getName() == 'user.document')
                                'class=active'
                                @elseif(request()->route()->getName() == 'user.document.show')
                                'class=active'
                                @elseif(request()->route()->getName() == 'user.nosubscription.create.fill.buy')
                                'class=active'
                                @elseif(request()->route()->getName() == 'user.nosubscription.show.buy.fill')
                                'class=active'
                                @elseif(request()->route()->getName() == 'user.document.purchase.after')
                                'class=active'
                                @elseif(request()->route()->getName() == 'user.document.filling.process')
                                'class=active'
                                @elseif(request()->route()->getName() == 'user.subscription.create.document.fill')
                                'class=active'
                                @else
                                 ''
                                @endif
                               >



                              <a href="{{route('user.document')}}">Documentos</a></li> 
                            
                            <li {{ request()->route()->getName() === 'user.myfolder.index' ? 'class=active' : '' }}><a href="{{route('user.myfolder.index')}}">Mi Carpeta</a></li>
                            <li {{ request()->route()->getName() === 'user.price' ? 'class=active' : '' }}><a href="{{route('user.price')}}">Precios</a></li>
                        </ul>
                    @endif
               

                <div class="extra-menu-mobile">
                    <div class="border-separate"></div>
                    @guest
                    <!-- uncomment this code for login user -->
                    <div class="login-mobile-bt">
                    <!-- <a href="{{route('login')}}"><i class="icon-icons-power"></i>Iniciar Sesión</a> -->
                    </div>
                    @endguest
                    <!-- uncomment this code for login user -->
                    @if (Auth::check())
                        <div class="mb-profile-menu">
                            <div class="prfile-pic">
                                <!-- <img src="{{asset('front/assets/img/users/avatar.jpg')}}" class="rounded-circle"> -->
                            @if(Auth::user()->user_image)
                                @if(Auth::user()->image_type != 1)
                                    <img src="{{asset(Auth::user()->user_image) }}" class="rounded-circle">
                                @else
                                    <img src="{{asset('storage/'.Auth::user()->user_image) }}" alt="" title="" class="rounded-circle lazyload">
                                @endif

                            @else
                                <img src="{{asset('front/assets/img/users/user_image.jpg')}}" alt="" title="" class="rounded-circle lazyload">
                            @endif
                                <p class="FooterSubtitle-2">{{ Auth::user()->full_name }}</p>
                            </div>
                            <div class="list-profile-menu">
                                <ul>
                                    <li>
                                        <a class="FooterSubtitle-2" href="{{route('user.profile')}}">Mi Perfil
                                            <i class="icon-icons-arrow-chevron-right"></i>
                                        </a>

                                    </li>
                                    <li>
                                        <a class="FooterSubtitle-2" href="{{route('user.purchase.history')}}">Historial de Compras
                                            <i class="icon-icons-arrow-chevron-right"></i>
                                        </a>

                                    </li>                                 
                                    <li>
                                        <a class="FooterSubtitle-2" href="{{route('user.legalisation.state')}}">Estados de Legalización
                                            <i class="icon-icons-arrow-chevron-right"></i>
                                        </a>

                                    </li>
                                    <li>
                                        <a class="FooterSubtitle-2" href="{{route('user.document.progress')}}">Documentos en Progreso
                                            <i class="icon-icons-arrow-chevron-right"></i>
                                        </a>

                                    </li>
                                    <li>
                                        <a class="FooterSubtitle-2" href="{{route('user.logout')}}">Cerrar Sesión
                                            <i class="icon-icons-arrow-chevron-right"></i>
                                        </a>

                                    </li>
                                </ul>
                            </div>
                        </div>
                    @endif
                
                </div>

            </nav>
            <div class="menu-header-bottom">
                    <div class="menu-logo">
                        <a href="{{route('document.index')}}"><img src="{{asset('front/assets/img/logo-horizontal.svg')}}" class="lazyload" alt="Herramientas Legales" title="Herramientas Legales"></a>
                    </div>
            </div>
            <!-- Menu Bar -->
            <!-- User Profile -->
            <div class="login-bt">
                @guest
                <!-- Without Login -->
                <!-- <a href="{{route('login')}}">Iniciar Sesión <i class="icon-icons-power"></i></a> -->
                @endguest
                <!-- Without Login -->
                @if (Auth::check())
                    <!-- Logged User -->
                    <div class="dropdown d-inline-block">
                        <button type="button" data-display="static" class="btn header-item waves-effect" id="page-header-user-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="d-none d-xl-inline-block ml-1">{{ Auth::user()->full_name }}</span>
                            @if(Auth::user()->user_image)
                                @if(Auth::user()->image_type != 1)
                                    <img class="rounded-circle header-profile-user" src="{{asset(Auth::user()->user_image) }}" alt="userpic">
                                @else
                                    <img class="rounded-circle header-profile-user" src="{{asset('storage/'.Auth::user()->user_image) }}" alt="userpic">
                                @endif

                            @else
                            <img class="rounded-circle header-profile-user lazyload" src="{{asset('front/assets/img/users/user_image.jpg')}}" title="" alt="userpic">
                            @endif
                        </button>
                        <div class="dropdown-menu" aria-labelledby="page-header-user-dropdown">
                            <a class="dropdown-item BodyBody-2" href="{{route('user.profile')}}">Mi Perfil</a>
                            <a class="dropdown-item BodyBody-2" href="{{route('user.purchase.history')}}">Historial de Compras</a>                       
                            <a class="dropdown-item BodyBody-2" href="{{route('user.legalisation.state')}}">Estados de Legalización</a>
                            <a class="dropdown-item BodyBody-2" href="{{route('user.document.progress')}}">Documentos en Progreso</a>
                            <a class="dropdown-item BodyBody-2" href="{{route('user.logout')}}">Cerrar Sesión</a>
                        </div>

                    </div>
                    <!-- Logged User -->
                @endif
            </div>
            <!-- User Profile -->
        </div>
    </div>
    <div class="mob-btn">
        <i class="icon-icons-menu-menu-2-1"></i>
    </div>
    <div class="overlay"></div>
</header>
<div class="loader" id="loader">
    <div class="img-loader">
        <img src="{{asset('front/assets/img/loader.svg')}}" class="lazyload"/>
    </div>
   <div class="loading-text"><span>Cargando</span><span class = "dots">...</span></div>
  
</div>

















<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="assets/css/main.min.css">
    <link rel="icon" href="assets/img/favicon.ico">
    <title>HerramientasLegales | Payment Success</title>
</head>
<style>
.payment-success-wrap .reg-bt-choose {
    margin-top: 1.75rem;
}
 .HeadlineH2-2 {
    margin-bottom: 0.75rem;
}
@media (max-width:767px){
    .HeadlineH2-2{
        text-align: center;
    font-size: 1.5rem;
    }
    .HeadlineH4-2{
        text-align: center;
        font-size: 0.875rem;
    }
    .payment-success-wrap  .reg-bt-choose.payment-success-bt .btn-comon:first-child {
        margin-right: auto!important;
        margin-left:auto;
    }
    .payment-success-wrap  .reg-bt-choose.payment-success-bt .btn-comon{
        margin-right: auto;
        margin-left:auto;
        display: block;
    }
}
.payment-success-wrap  .reg-bt-choose.payment-success-bt .btn-comon:first-child {
    margin-bottom: 1.25rem;
    margin-right: 1.25rem;
}
.payment-success-wrap  .reg-bt-choose.payment-success-bt .btn-comon{
    max-width: 14.5rem;
    line-height: 1.125rem;
}
.helloIllustraction{

    max-width: 80%;
    margin: 0 auto;
}
.payment-success-wrap .subscribe-content{
    max-width: 27.5rem;
    margin-left: inherit!important;
    margin-right: inherit!important;
}

</style>
<body>

<main class="subscription-page subscribe-page payment-success-wrap">

        <section class="form-filling-wrap">
            <div class="container">
                <div class="row flx-vcenter">
                    <div class="col-lg-12">
                    <div class="pay-success">
                    <div class="row flx-vcenter">
                                            <div class="col-md-5">
                                                <div class="helloIllustraction">
                                                    <img src="{{asset('front/assets/img/illustraction/paymentsucces.png')}}" class="img-fluid lazyload" />
                                                </div>
                                            </div>
                                            <div class="col-md-7">
                                                <div class="SignContentModal subscribe-content">
                                                    <h2 class="HeadlineH2-2">¡Listo!</h2>
                                                    <h4 class="HeadlineH4-2 ">Su compra se ha realizado de manera exitosa. </h4>
                                                    <div class="reg-bt-choose payment-success-bt">
                                                        <a href="{{route('user.document')}}" class="btn btn-comon btn-blue btn-block">Ir a lista de documentos</a>
                                                        <a href="{{route('user.document.progress')}}" class="btn btn-comon btn-blue-outline">Ver documentos en proceso</a>
                                                        
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                    </div>
                   
                    </div>
                </div>

            </div>
        </section>


    </main>



    
  



</body>

</html>


 

@endsection
@push('js')
<!-- <script src="{{ asset('front/assets/custom/js/user.js')}}"></script> -->
<script src="//code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<!-- <script>
$(document).ready(function () {
$(".keepCredit").trigger( "click" );
});

$(".keepCredit").on('click', function (e) {
  e.preventDefault();
  var id  = $("#txn_uuid").val();
  var txn  = $("#txn_id").val();
  if(id != 1){
    console.log(id);
        $.ajax({
            type: "GET",
            url: "user/payment/update/"+id+"/"+txn,
            dataType: 'json',
            contentType: false,
            cache: false,
            processData: false,
            success: function (json) {
                if (json.status) {
                    // location.reload(true);
                    console.log(status);
                } 

            }
        });
  }
  
});
</script> -->

@endpush
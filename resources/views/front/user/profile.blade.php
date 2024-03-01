@extends('front.layouts.master')
@section('pageTitle',__('test.User Profile'))
@section('content')

<meta name="csrf-token" content="{{ csrf_token() }}">
    <main class="documentlist-page document-process-page my-profile">
        <section class="cat-list-wrap ">
            <div class="container">


                <div class="list-doc-wrap">
                    <div class="page-head-process">
                        <div class="row d-flex justify-content-between">
                            <div class="col-md-9 p-0 col-sm-12">
                                <div class="HeadlineH2-2">
                                    Bienvenido/a <span class="color-blue">{{$user_data['first_name']}} {{$user_data['last_name']}}</span>
                                </div>
                            </div>

                        </div>
                    </div> 

                    <!-- profile-tab-nav-links-start -->
                    <div class="profile-tab-link-wrap">
                        <ul class="nav nav-pills mb-3 row" id="profile-tab" role="tablist">
                            <li class="nav-item active2">
                                <a class="nav-link active HeadlineH6-2" id="profile-account-info-tab" data-toggle="pill" href="#profile-account-info" role="tab" aria-controls="profile-account-info" aria-selected="true">Información de la Cuenta</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link HeadlineH6-2 " id="profile-personal-tab" data-toggle="pill" href="#profile-personal" role="tab" aria-controls="profile-personal" aria-selected="false">Información Personal</a>
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link HeadlineH6-2 " id="profile-subscription-tab" data-toggle="pill" href="#profile-subscription" role="tab" aria-controls="profile-subscription" aria-selected="false">Suscripción</a>
                            </li>
                            <!-- <li class="nav-item  ">
                                <a class="nav-link HeadlineH6-2 " id="profile-payment-tab" data-toggle="pill" href="#profile-payment" role="tab" aria-controls="profile-payment" aria-selected="false">Información de Pago</a>
                            </li> -->
                        </ul>
                        <div class="tab-content profile-tab-wrap-content" id="profile-tabContent">
                            <!-- account-info-tab details -->
                            <div class="tab-pane fade show profile-tab-detais active" id="profile-account-info" role="tabpanel" aria-labelledby="profile-account-info-tab">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="profile-pic-wrap">
                                            <div class="profile_pic_im">
                                                <form method="POST" id="updateProfilePic" enctype="multipart/form-data">
                                                    {{csrf_field()}}
                                                    <div class="d-flex align-items-center">
                                                        <figure class="user-dp lg img-center user-image mb-0 mr-2">
                                                        @if($user_data['user_image'])
                                                            @if($user_data['image_type'] != 1)
                                                                <img class="img-responsive rounded-circle  lazyload blur-up profPic" data-src="{{asset($user_data['user_image']) }}" alt="" src="{{asset($user_data['user_image']) }}">
                                                            @else
                                                                <img class="img-responsive rounded-circle  lazyload blur-up profPic" data-src="{{asset('storage/'.$user_data['user_image']) }}" alt="" src="{{asset('storage/'. $user_data['user_image']) }}">
                                                            @endif
                                                            
                                                        @else
                                                            <img class="img-responsive rounded-circle  lazyload blur-up profPic" data-src="{{asset('front/assets/img/users/user_image.jpg')}}" alt="" src="{{asset('front/assets/img/users/user_image.jpg')}}">
                                                        @endif
                                                            <!-- <img class="img-responsive rounded-circle  lazyload blur-up" data-src="assets/img/users/profileimg.jpg" alt="" src="assets/img/users/profileimg.jpg"> -->
                                                        </figure>

                                                    </div>
                                                    <div class="profile-update-bt">
                                                        <a class="btn btn-comon btn-blue btn-w-icon">
                                                            <i class="icon-icons-image"></i>
                                                            Cambiar Imagen
                                                            <input type="file" class="item-img file center-block" id="profilePicUpload" name="profileimg" onchange="readURL(this);">
                                                            <!-- <div class="val-error error_profileimg"></div> -->
                                                        </a>
                                                        <div class="val-error error_profileimg"></div>
                                                    </div>
                                                   
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <form method="POST" id="saveAccountInfo" enctype="multipart/form-data">
                                            {{csrf_field()}}
                                            <div class="profile-input-wrap">
                                                <div class="form-group">
                                                    <label class="Ttulo">Nombre</label>
                                                    <input type="text" class="form-control" name="name" placeholder="Escribir..." value="{{$user_data['first_name']}}">
                                                    <div class="val-error error_name"></div>
                                                </div>
                                                <div class="form-group confirm-val">
                                                    <label class="Ttulo">Email</label>
                                                    <input type="email" class="form-control" name="email" placeholder="Escribir..." value="{{$user_data['email']}}">
                                                    <div class="val-error error_email"></div>
                                                    <!-- validation icon -->
                                                    <!-- <span class="val-icon"> -->
                                                    <!-- <i class="icon-icons-checkmark-checkmark-1"></i> -->
                                                    <!-- uncomment when error -->
                                                    <!-- <i class="icon-icons-alert-circle1 icon-error"></i> -->
                                                    <!-- uncomment when error -->
                                                    <!-- </span> -->
                                                    <!-- validation icon end-->
                                                </div>

                                                <div class="change-password-wrap">
                                                    <div class="change-pass-title BodySmall-2">
                                                        Contraseña:
                                                    </div>
                                                    <div class="form-group  confirm-val current_password_cls">
                                                        <label class="Ttulo">Contraseña Actual</label>
                                                        <input type="password" class="form-control" name="current_password" id="current_password" value="" placeholder="Escribir...">
                                                        <div class="val-error error_current_password"></div>
                                                        <span class="val-error invalidPword"></span>

                                                        <!-- validation icon -->
                                                        <span class="val-icon">
                                                            <i class="icon-icons-checkmark-checkmark-1 current_password_true d-none"></i>
                                                            <!-- uncomment when error -->
                                                            <!-- <i class="icon-icons-alert-circle1 icon-error"></i> -->
                                                            <!-- uncomment when error -->
                                                        </span>
                                                        <!-- <span class="val-error">No hay ninguna cuenta con este correo. Pruebe de nuevo.</span> -->
                                                        <!-- validation icon end-->
                                                    </div>
                                                    <div class="form-group  confirm-val new_password_cls ">
                                                        <label class="Ttulo">Nueva Contraseña</label>
                                                        <input type="password" class="form-control" name="new_password" id="new_password" value="" placeholder="Escribir...">
                                                        <div class="val-error error_new_password"></div>
                                                        <!-- validation icon -->
                                                        <span class="val-icon">
                                                            <!-- <i class="icon-icons-checkmark-checkmark-1 icon-true"></i> -->
                                                            <!-- uncomment when error -->
                                                            <!-- <i class="icon-icons-alert-circle1 icon-error"></i> -->
                                                            <!-- uncomment when error -->
                                                        </span>
                                                        <!-- validation icon end-->
                                                    </div>
                                                    <div class="form-group  confirm-val confirm_password_cls disable">
                                                        <label class="Ttulo">Confirmar Contraseña</label>
                                                        <input type="password" class="form-control mb-0" name="confirm_password" id="confirm_password" value="" placeholder="Escribir...">
                                                        <div class="val-error error_confirm_password"></div>
                                                        <!-- validation icon -->
                                                        <span class="val-icon">
                                                            <i class="icon-icons-checkmark-checkmark-1 icon-true" style="display:none"></i>
                                                            <!-- uncomment when error -->
                                                            <i class="icon-icons-alert-circle1 icon-error" style="display:none"></i>
                                                            <!-- uncomment when error -->
                                                        </span>
                                                        <!-- validation icon end-->
                                                    </div>
                                                </div>

                                                <!-- <div class="soical-connect">
                                                    <div class="social-fb">
                                                        <label>Vincular con:</label><a class="btn btn-social bg-white btn-w-icon">
                                                            <img src="assets/img/icons-sociall-fb-logo.svg">
                                                            Facebook</a>

                                                    </div>
                                                    <div class="social-google">
                                                        <label>Vincular con:</label><a class="btn btn-social bg-white btn-w-icon">
                                                            <img src="assets/img/icons-social-google-logo.svg">
                                                            Google</a>
                                                        <a class="remov-account">
                                                            <i class="icon-icons-close-close"></i><span>Eliminar Cuenta</span></a>

                                                    </div>
                                                    
                                                </div> -->
                                                
                                                <div class="save-profile">
                                                    <a href="#" class="btn btn-comon btn-blue submitAccountInfo disabled">Guardar</a>
                                                    <div class="val-success success"></div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>

                            </div>
                            <!-- account-info-tab details end -->

                            <!-- personal info tab details -->
                            <div class="tab-pane fade perosnal-tab-details" id="profile-personal" role="tabpanel" aria-labelledby="profile-personal-tab">
                                <div class="row ">
                                    <div class="col-md-12 col_md_12">

                                        @if(Auth::user()->user_type == 1 || Auth::user()->user_type == 3)
                                            <!-- except premium subscribers shows this -->
                                            <div class="subscription-page subscribe-page">
                                                <div class="form-filling-wrap p-0">
                                                    <div class="row flx-vcenter">
                                                        <div class="col-lg-6 col_lg_6">
                                                            <div class="illustra-img">
                                                                <img src="{{asset('front/assets/img/illustraction/people.png')}}" class="lazyload" />
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6 col_lg_6">
                                                            <div class="subscribe-content">
                                                                <h2 class="HeadlineH2-2">¡Hola! Al parecer no tienes acceso a esta función. </h2>
                                                                <p class="BodyBody-2">La opción de <span>Información Personal</span> solo está disponible para los suscriptores premium. Esta opción permite guardar datos personales para poder usarlos al llenar un documento, al igual que guardar documentos adicionales y poder enviarlos al legalizar los documentos con un abogado. </p>
                                                                <div class="purchase-bt">
                                                                    <a href="{{route('user.price')}}" class="btn btn-comon btn-blue">Adquirir Suscripción Premium</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- except premium subscribers shows end -->
                                        @else
                                            @if($subscription['subscriptionType']['id'] != 3)
                                                <!-- except premium subscribers shows this -->
                                                <div class="subscription-page subscribe-page">
                                                    <div class="form-filling-wrap p-0">
                                                        <div class="row flx-vcenter">
                                                            <div class="col-lg-6 col_lg_6">
                                                                <div class="illustra-img">
                                                                    <img src="{{asset('front/assets/img/illustraction/people.png')}}" class="lazyload" />
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6 col_lg_6">
                                                                <div class="subscribe-content">
                                                                    <h2 class="HeadlineH2-2">¡Hola! Al parecer no tienes acceso a esta función. </h2>
                                                                    <p class="BodyBody-2">La opción de <span>Información Personal</span> solo está disponible para los suscriptores premium. Esta opción permite guardar datos personales para poder usarlos al llenar un documento, al igual que guardar documentos adicionales y poder enviarlos al legalizar los documentos con un abogado. </p>
                                                                    <div class="purchase-bt">
                                                                        <a href="{{route('user.price')}}" class="btn btn-comon btn-blue">Adquirir Suscripción Premium</a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- except premium subscribers shows end -->
                                            @else
                                            

                                            <div class="form-personal-info-wrap">
                                                <form method="POST" id="updatePersonalInfo" enctype="multipart/form-data">
                                                {{csrf_field()}}
                                                    <div class="form-personal-info-inner">
                                                        <!-- single form-seciton start -->
                                                    
                                                        <div class="inner-form-section personal-div">
                                                            <div class="header-separate-form">
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <div class="d-flex ">
                                                                            <div class=" flex-grow-1 ">
                                                                                <div class="form-control">
                                                                                    Nombres
                                                                                </div>
                                                                            </div>
                                                                            <div class="btn-remove-details">
                                                                                <!-- <button class="btn btn-comon btn-blue btn-w-icon ">
                                                                                    <i class="icon-icons-save">

                                                                                    </i>Guardar
                                                                                </button> -->
                                                                                <!-- Payment Information filling or empty / uncomment below code -->
                                                                                <!-- <button class="btn btn-comon btn-blue btn-w-icon disabled">
                                                                        <i class="icon-icons-close-close">
                                                                        
                                                                        </i>Eliminar
                                                                    </button> -->
                                                                                <!-- Payment Information filling or empty end -->
                                                                            </div>

                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-personal-info-filling">
                                                                <div class="form-wrap-inner">
                                                                    <div class="d-flex">
                                                                        <!-- checkbox session -->
                                                                        <!-- <div class="form-group">
                                                                            <div class="custom-control cst-checkbox custom-checkbox">
                                                                                <input type="checkbox" class="custom-control-input" id="firstnamecheck">
                                                                                <label class="custom-control-label  ml-1" for="firstnamecheck"></label>
                                                                            </div>
                                                                        </div> -->
                                                                        <!-- checkbox session -->
                                                                        <!-- input first name -->
                                                                        <div class="flex-grow-1">
                                                                            @if($user_data['first_name'])
                                                                            <div class="form-group confirm-val first_name_cls">
                                                                            @else
                                                                            <div class="form-group confirm-val first_name_cls disable">
                                                                            @endif
                                                                            
                                                                                <label class="Ttulo">Primer Nombres</label>
                                                                                <input type="text" class="form-control" name="first_name" id="first_name" placeholder="Escribir..." value="{{$user_data['first_name']}}">
                                                                                <div class="val-error error_first_name"></div>
                                                                                <!-- validation icon -->
                                                                                <!-- <span class="val-icon">
                                                                            <i class="icon-icons-checkmark-checkmark-1"></i> -->
                                                                                <!-- uncomment when error -->
                                                                                <!-- <i class="icon-icons-alert-circle1 icon-error"></i> -->
                                                                                <!-- uncomment when error -->
                                                                                <!-- </span> -->
                                                                                <!-- <span class="val-error">No hay ninguna cuenta con este correo. Pruebe de nuevo.</span> -->
                                                                                <!-- validation icon end-->
                                                                            </div>

                                                                        </div>
                                                                        <!-- input first name -->
                                                                    </div>
                                                                </div>
                                                                <div class="form-wrap-inner">
                                                                    <div class="d-flex">
                                                                        <!-- checkbox session -->
                                                                        <!-- <div class="form-group">
                                                                            <div class="custom-control cst-checkbox custom-checkbox">
                                                                                <input type="checkbox" class="custom-control-input" id="secondnamecheck">
                                                                                <label class="custom-control-label  ml-1" for="secondnamecheck"></label>
                                                                            </div>
                                                                        </div> -->
                                                                        <!-- checkbox session -->
                                                                        <!-- input second name -->
                                                                        <div class="flex-grow-1">
                                                                            @if($user_data['second_name'])
                                                                            <div class="form-group confirm-val second_name_cls">
                                                                            @else
                                                                            <div class="form-group confirm-val second_name_cls disable">
                                                                            @endif
                                                                                <label class="Ttulo">Segundo Nombre</label>
                                                                                <input type="text" class="form-control" name="second_name" id="second_name" placeholder="Escribir..." value="{{$user_data['second_name']}}">
                                                                                <div class="val-error error_second_name"></div>
                                                                                <!-- validation icon -->
                                                                                <!-- <span class="val-icon">
                                                                            <i class="icon-icons-checkmark-checkmark-1"></i> -->
                                                                                <!-- uncomment when error -->
                                                                                <!-- <i class="icon-icons-alert-circle1 icon-error"></i> -->
                                                                                <!-- uncomment when error -->
                                                                                <!-- </span> -->
                                                                                <!-- <span class="val-error">No hay ninguna cuenta con este correo. Pruebe de nuevo.</span> -->
                                                                                <!-- validation icon end-->
                                                                            </div>

                                                                        </div>
                                                                        <!-- input second name -->
                                                                    </div>
                                                                </div>
                                                                <div class="form-wrap-inner">
                                                                    <div class="d-flex">
                                                                        <!-- checkbox session -->
                                                                        <!-- <div class="form-group">
                                                                            <div class="custom-control cst-checkbox custom-checkbox">
                                                                                <input type="checkbox" class="custom-control-input" id="surnamecheck">
                                                                                <label class="custom-control-label  ml-1" for="surnamecheck"></label>
                                                                            </div>
                                                                        </div> -->
                                                                        <!-- checkbox session -->
                                                                        <!-- input surname name -->
                                                                        <div class="flex-grow-1">
                                                                            @if($user_data['surname'])
                                                                            <div class="form-group confirm-val surname_cls">
                                                                            @else
                                                                            <div class="form-group confirm-val surname_cls disable">
                                                                            @endif
                                                                                <label class="Ttulo">Primer Apellido</label>
                                                                                <input type="text" class="form-control" name="surname" id="surname"  placeholder="Escribir..." value="{{$user_data['surname']}}">
                                                                                <div class="val-error error_surname"></div>
                                                                                <!-- validation icon -->
                                                                                <!-- <span class="val-icon">
                                                                            <i class="icon-icons-checkmark-checkmark-1"></i> -->
                                                                                <!-- uncomment when error -->
                                                                                <!-- <i class="icon-icons-alert-circle1 icon-error"></i> -->
                                                                                <!-- uncomment when error -->
                                                                                <!-- </span> -->
                                                                                <!-- <span class="val-error">No hay ninguna cuenta con este correo. Pruebe de nuevo.</span> -->
                                                                                <!-- validation icon end-->
                                                                            </div>

                                                                        </div>
                                                                        <!-- input surname name -->
                                                                    </div>
                                                                </div>
                                                                <div class="form-wrap-inner">
                                                                    <div class="d-flex">
                                                                        <!-- checkbox session -->
                                                                        <!-- <div class="form-group">
                                                                            <div class="custom-control cst-checkbox custom-checkbox">
                                                                                <input type="checkbox" class="custom-control-input" id="surname2check">
                                                                                <label class="custom-control-label  ml-1" for="surname2check"></label>
                                                                            </div>
                                                                        </div> -->
                                                                        <!-- checkbox session -->
                                                                        <!-- input surname name second -->
                                                                        <div class="flex-grow-1">
                                                                            @if($user_data['second_surname'])
                                                                            <div class="form-group confirm-val second_surname_cls">
                                                                            @else
                                                                            <div class="form-group confirm-val second_surname_cls disable">
                                                                            @endif
                                                                                <label class="Ttulo">Segundo Apellido</label>
                                                                                <input type="text" class="form-control" name="second_surname" id="second_surname" placeholder="Escribir..." value="{{$user_data['second_surname']}}">
                                                                                <div class="val-error error_second_surname"></div>
                                                                                <!-- validation icon -->
                                                                                <!-- <span class="val-icon">
                                                                            <i class="icon-icons-checkmark-checkmark-1"></i> -->
                                                                                <!-- uncomment when error -->
                                                                                <!-- <i class="icon-icons-alert-circle1 icon-error"></i> -->
                                                                                <!-- uncomment when error -->
                                                                                <!-- </span> -->
                                                                                <!-- <span class="val-error">No hay ninguna cuenta con este correo. Pruebe de nuevo.</span> -->
                                                                                <!-- validation icon end-->
                                                                            </div>

                                                                        </div>
                                                                        <!-- input surname name second -->
                                                                    </div>
                                                                </div>
                                                                <div class="form-wrap-inner">
                                                                    <div class="d-flex">
                                                                        <!-- checkbox session -->
                                                                        <!-- <div class="form-group">
                                                                            <div class="custom-control cst-checkbox custom-checkbox">
                                                                                <input type="checkbox" class="custom-control-input" id="marsurname">
                                                                                <label class="custom-control-label  ml-1" for="marsurname"></label>
                                                                            </div>
                                                                        </div> -->
                                                                        <!-- checkbox session -->
                                                                        <!-- input married surname name  -->
                                                                        <div class="flex-grow-1">
                                                                            @if($user_data['married_surname'])
                                                                            <div class="form-group confirm-val married_surname_cls">
                                                                            @else
                                                                            <div class="form-group confirm-val married_surname_cls disable">
                                                                            @endif
                                                                                <label class="Ttulo">Apellido de Casada</label>
                                                                                <input type="text" class="form-control" name="married_surname" id="married_surname" placeholder="Escribir..." value="{{$user_data['married_surname']}}">
                                                                                <div class="val-error error_married_surname"></div>
                                                                                <!-- validation icon -->
                                                                                <!-- <span class="val-icon">
                                                                            <i class="icon-icons-checkmark-checkmark-1"></i> -->
                                                                                <!-- uncomment when error -->
                                                                                <!-- <i class="icon-icons-alert-circle1 icon-error"></i> -->
                                                                                <!-- uncomment when error -->
                                                                                <!-- </span> -->
                                                                                <!-- <span class="val-error">No hay ninguna cuenta con este correo. Pruebe de nuevo.</span> -->
                                                                                <!-- validation icon end-->
                                                                            </div>

                                                                        </div>
                                                                        <!-- input married surname name  -->
                                                                    </div>
                                                                </div>
                                                                <!-- <div class="form-wrap-inner">
                                                                    <div class="d-flex"> -->
                                                                        <!-- checkbox session -->
                                                                        <!-- <div class="form-group">
                                                                            <div class="custom-control cst-checkbox custom-checkbox">
                                                                                <input type="checkbox" class="custom-control-input" id="marsurname">
                                                                                <label class="custom-control-label  ml-1" for="marsurname"></label>
                                                                            </div>
                                                                        </div> -->
                                                                        <!-- checkbox session -->
                                                                        <!-- input married surname name  -->
                                                                        <!-- <div class="flex-grow-1">
                                                                            <div class="form-group confirm-val">
                                                                                <label class="Ttulo">Apellido de Casada</label>
                                                                                <input type="text" class="form-control" placeholder="Escribir..."> -->
                                                                                <!-- validation icon -->
                                                                                <!-- <span class="val-icon">
                                                                            <i class="icon-icons-checkmark-checkmark-1"></i> -->
                                                                                <!-- uncomment when error -->
                                                                                <!-- <i class="icon-icons-alert-circle1 icon-error"></i> -->
                                                                                <!-- uncomment when error -->
                                                                                <!-- </span> -->
                                                                                <!-- <span class="val-error">No hay ninguna cuenta con este correo. Pruebe de nuevo.</span> -->
                                                                                <!-- validation icon end-->
                                                                            <!-- </div>

                                                                        </div> -->
                                                                        <!-- input married surname name  end-->
                                                                    <!-- </div>
                                                                </div> -->

                                                            </div>
                                                        </div>
                                                        <!-- single form-seciton start end-->
                                                        <!-- single form-seciton start -->
                                                        <div class="inner-form-section dpi_section personal-div">
                                                            <div class="header-separate-form">
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <div class="d-flex ">
                                                                            <div class=" flex-grow-1 ">
                                                                                <div class="form-control">
                                                                                    DPI
                                                                                </div>
                                                                            </div>
                                                                            <div class="btn-remove-details">
                                                                                <!-- <button class="btn btn-comon btn-blue btn-w-icon disabled">
                                                                                    <i class="icon-icons-save">

                                                                                    </i>Guardar
                                                                                </button> -->
                                                                                <!-- Payment Information filling or empty / uncomment below code -->
                                                                                <!-- <button class="btn btn-comon btn-blue btn-w-icon disabled">
                                                                        <i class="icon-icons-close-close">
                                                                        
                                                                        </i>Eliminar
                                                                    </button> -->
                                                                                <!-- Payment Information filling or empty end -->
                                                                            </div>

                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-personal-info-filling">
                                                                <div class="form-wrap-inner">
                                                                    <div class="d-flex">
                                                                        <!-- checkbox session -->
                                                                        <!-- <div class="form-group">
                                                                            <div class="custom-control cst-checkbox custom-checkbox">
                                                                                <input type="checkbox" class="custom-control-input" id="dpicheck">
                                                                                <label class="custom-control-label  ml-1" for="dpicheck"></label>
                                                                            </div>
                                                                        </div> -->
                                                                        <!-- checkbox session -->
                                                                        <!-- input dpi no -->
                                                                        <div class="flex-grow-1">
                                                                            <div class="form-group confirm-val">
                                                                                <label class="Ttulo">Número de DPI</label>
                                                                                <input type="text" class="form-control" name="dpi_number" id="dpi_number" placeholder="Escribir..." value="{{$user_data['dpi_number']}}">
                                                                                
                                                                                <div class="val-error error_dpi_number"></div>
                                                                                <!-- validation icon -->
                                                                                <!-- <span class="val-icon">
                                                                            <i class="icon-icons-checkmark-checkmark-1"></i> -->
                                                                                <!-- uncomment when error -->
                                                                                <!-- <i class="icon-icons-alert-circle1 icon-error"></i> -->
                                                                                <!-- uncomment when error -->
                                                                                <!-- </span> -->
                                                                                <!-- <span class="val-error">No hay ninguna cuenta con este correo. Pruebe de nuevo.</span> -->
                                                                                <!-- validation icon end-->
                                                                            </div>
                                                                            <div class="dpi-upload-wrap">
                                                                                <div class="dpi-up-inst BodySmall-2">
                                                                                    Subir su DPI en formato PDF. Asegurese de incluir ambos lados.
                                                                                </div>
                                                                                <div class="upload-doc-wrap d-flx align-items-center">
                                                                                    <a class="btn btn-comon btn-blue btn-w-icon file_up">
                                                                                        <i class="icon-icons-plus-circle1"></i>
                                                                                        Subir DPI
                                                                                        <input type="file" class="item-img file center-block" name="dpi_file" id="dpi_file">
                                                                                    </a>
                                                                                    <div class="dpiHidden">
                                                                                        <input type="hidden" class="item-img file center-block" name="dpi_file_already" id="dpi_file_already" value="{{$user_data['dpi_file_name']}}" >
                                                                                    </div>
                                                                                    
                                                                                    <!-- only show if file uploaded -->
                                                                                    <span class="file-uploaded-wrap">
                                                                                        <div class="file-name-ico BodyBody-2 dpi_file ">
                                                                                        </div>
                                                                                        @if($user_data['dpi_file'])
                                                                                        <div class="file-name-ico BodyBody-2 dpi_file_current">
                                                                                            <i class="icon-icons-close-close remove_dpi_file"></i>{{$user_data['dpi_file_name']}}
                                                                                        </div>
                                                                                        @endif
                                                                                    </span>
                                                                                    <!-- only show if file uploaded -->
                                                                                    
                                                                                </div>
                                                                                <div class="val-error error_dpi_file"></div>
                                                                            </div>
                                                                        </div>
                                                                        <!-- input dpi no end-->
                                                                    </div>

                                                                </div>



                                                            </div>
                                                        </div>
                                                        <!-- single form-seciton start end-->
                                                        <!-- single form-seciton start -->
                                                        <div class="inner-form-section age_section personal-div">
                                                            <div class="header-separate-form">
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <div class="d-flex ">
                                                                            <div class=" flex-grow-1 ">
                                                                                <div class="form-control">
                                                                                    Edad
                                                                                </div>
                                                                            </div>
                                                                            <div class="btn-remove-details">
                                                                                <!-- <button class="btn btn-comon btn-blue btn-w-icon disabled">
                                                                                    <i class="icon-icons-save">

                                                                                    </i>Guardar
                                                                                </button> -->
                                                                                <!-- Payment Information filling or empty / uncomment below code -->
                                                                                <!-- <button class="btn btn-comon btn-blue btn-w-icon disabled">
                                                                        <i class="icon-icons-close-close">
                                                                        
                                                                        </i>Eliminar
                                                                    </button> -->
                                                                                <!-- Payment Information filling or empty end -->
                                                                            </div>

                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-personal-info-filling">
                                                                <div class="form-wrap-inner">
                                                                    <div class="d-flex">
                                                                        <!-- checkbox session -->
                                                                        <!-- <div class="form-group">
                                                                            <div class="custom-control cst-checkbox custom-checkbox">
                                                                                <input type="checkbox" class="custom-control-input" id="agecheck">
                                                                                <label class="custom-control-label  ml-1" for="agecheck"></label>
                                                                            </div>
                                                                        </div> -->
                                                                        <!-- checkbox session -->
                                                                        <!-- input age section -->
                                                                        <div class="flex-grow-1">
                                                                            <div class="d-flx cal-wid-25">
                                                                                <div class="form-group ">
                                                                                    <label class="Ttulo">Edad</label>
                                                                                    <div class="input-group date chekDate" id="datetimepicker5" data-target-input="nearest">
                                                                                        @if($user_data['date_of_birth'])
                                                                                            <input type="text" class="form-control datetimepicker-input" data-target="#datetimepicker5" name="dob" id="dob" placeholder="{{$user_data['date_of_birth']}}" value="{{$user_data['date_of_birth']}}" />
                                                                                        @else
                                                                                            <input type="text" class="form-control datetimepicker-input" data-target="#datetimepicker5" name="dob" id="dob" placeholder="00/00/000" />
                                                                                        @endif
                                                                                        
                                                                                        <div class="input-group-append" data-target="#datetimepicker5" data-toggle="datetimepicker">
                                                                                            <div class="input-group-text">
                                                                                                <i class="icon-icons-calendar"></i>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="val-error error_dob"></div>


                                                                                </div>
                                                                                <span class="Tiene-0-aos-de-edad ">Tiene <span class="your-age">{{$user_data['age']}}</span> años de edad.</span>

                                                                            </div>


                                                                        </div>
                                                                        <!-- input age section end-->
                                                                    </div>

                                                                </div>



                                                            </div>
                                                        </div>
                                                        <!-- single form-seciton start end-->
                                                        <!-- single form-seciton start -->
                                                        <div class="inner-form-section nation_section personal-div">
                                                            <div class="header-separate-form">
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <div class="d-flex ">
                                                                            <div class=" flex-grow-1 ">
                                                                                <div class="form-control">
                                                                                    Nacionalidad
                                                                                </div>
                                                                            </div>
                                                                            <div class="btn-remove-details">
                                                                                <!-- <button class="btn btn-comon btn-blue btn-w-icon disabled">
                                                                                    <i class="icon-icons-save">

                                                                                    </i>Guardar
                                                                                </button> -->
                                                                                <!-- Payment Information filling or empty / uncomment below code -->
                                                                                <!-- <button class="btn btn-comon btn-blue btn-w-icon disabled">
                                                                        <i class="icon-icons-close-close">
                                                                        
                                                                        </i>Eliminar
                                                                    </button> -->
                                                                                <!-- Payment Information filling or empty end -->
                                                                            </div>

                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-personal-info-filling">
                                                                <div class="form-wrap-inner">
                                                                    <div class="d-flex">
                                                                        <!-- checkbox session -->
                                                                        <!-- <div class="form-group">
                                                                            <div class="custom-control cst-checkbox custom-checkbox">
                                                                                <input type="checkbox" class="custom-control-input" id="nationcheck">
                                                                                <label class="custom-control-label  ml-1" for="nationcheck"></label>
                                                                            </div>
                                                                        </div> -->
                                                                        <!-- checkbox session -->
                                                                        <!-- input Nacionalidad -->
                                                                        <div class="flex-grow-1">
                                                                            <div class="form-group confirm-val">
                                                                                <label class="Ttulo">Nacionalidad (Escriba como desea que aparesca en sus documentos).</label>
                                                                                <input type="text" class="form-control" name="nationality" id="nationality" placeholder="Escribir..." value="{{$user_data['nationality']}}">
                                                                                <div class="val-error error_nationality"></div>
                                                                                <!-- validation icon -->
                                                                                <!-- <span class="val-icon">
                                                                            <i class="icon-icons-checkmark-checkmark-1"></i> -->
                                                                                <!-- uncomment when error -->
                                                                                <!-- <i class="icon-icons-alert-circle1 icon-error"></i> -->
                                                                                <!-- uncomment when error -->
                                                                                <!-- </span> -->
                                                                                <!-- <span class="val-error">No hay ninguna cuenta con este correo. Pruebe de nuevo.</span> -->
                                                                                <!-- validation icon end-->
                                                                            </div>
                                                                            
                                                                            <div class="switch-nation-wrap">
                                                                                <div class="custom-control custom-switch custom-switch-normal">
                                                                                    <input type="checkbox" class="custom-control-input" id="foreigncheck" name="foreigncheck" <?php if($user_data['passport_number']){?> checked <?php } ?> >
                                                                                    <label class="custom-control-label" for="foreigncheck">Soy extranjero/a</label>
                                                                                </div>
                                                                            </div>
                                                                            @if($user_data['passport_number'])
                                                                            <div class="opt-doc-sect">
                                                                            @else
                                                                            <div class="opt-doc-sect disabled opact-2">
                                                                            @endif
                                                                                <div class="form-group confirm-val">
                                                                                    <label class="Ttulo">Número de pasaporte</label>
                                                                                    <input type="text" class="form-control <?php if($user_data['passport_number']){?> disabled <?php } ?>" name="passport_number" id="passport_number" placeholder="Escribir..." value="{{$user_data['passport_number']}}">
                                                                                    <div class="val-error error_passport_number"></div>
                                                                                    <!-- validation icon -->
                                                                                    <!-- <span class="val-icon">
                                                                                    <i class="icon-icons-checkmark-checkmark-1"></i> -->
                                                                                    <!-- uncomment when error -->
                                                                                    <!-- <i class="icon-icons-alert-circle1 icon-error"></i> -->
                                                                                    <!-- uncomment when error -->
                                                                                    <!-- </span> -->
                                                                                    <!-- <span class="val-error">No hay ninguna cuenta con este correo. Pruebe de nuevo.</span> -->
                                                                                    <!-- validation icon end-->
                                                                                </div>
                                                                                <div class="dpi-upload-wrap">
                                                                                    <div class="dpi-up-inst BodySmall-2">
                                                                                        Subir su pasaporte en formato PDF. Asegurese de incluir todo el documento.
                                                                                    </div>
                                                                                    <div class="upload-doc-wrap d-flx align-items-center ">
                                                                                        <a class="btn btn-comon btn-blue btn-w-icon file_up">
                                                                                            <i class="icon-icons-plus-circle1"></i>
                                                                                            Subir Pasaporte
                                                                                            <input type="file" class="item-img file center-block" name="passport_file" id="passport_file">
                                                                                        </a>
                                                                                        <div class="val-error error_passport_file"></div>
                                                                                        <!-- only show if file uploaded -->
                                                                                        <span class="file-uploaded-wrap">
                                                                                            <div class="file-name-ico BodyBody-2 passport_file ">
                                                                                            </div>
                                                                                            @if($user_data['passport_file'])
                                                                                            <div class="file-name-ico BodyBody-2 passport_file_current">
                                                                                                <i class="icon-icons-close-close remove_passport_file"></i>{{$user_data['passport_file_name']}}</a>
                                                                                            </div>
                                                                                            @endif
                                                                                        </span>
                                                                                        <!-- only show if file uploaded -->
                                                                                        </span>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <!-- input Nacionalidad end -->
                                                                    </div>


                                                                </div>



                                                            </div>
                                                        </div>
                                                        <!-- single form-seciton start end-->
                                                        <!-- single form-seciton start -->
                                                        <div class="inner-form-section personal-div">
                                                            <div class="header-separate-form">
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <div class="d-flex ">
                                                                            <div class=" flex-grow-1 ">
                                                                                <div class="form-control">
                                                                                    Profesión
                                                                                </div>
                                                                            </div>
                                                                            <div class="btn-remove-details">
                                                                                <!-- <button class="btn btn-comon btn-blue btn-w-icon disabled">
                                                                                    <i class="icon-icons-save">

                                                                                    </i>Guardar
                                                                                </button> -->
                                                                                <!-- Payment Information filling or empty / uncomment below code -->
                                                                                <!-- <button class="btn btn-comon btn-blue btn-w-icon disabled">
                                                                        <i class="icon-icons-close-close">
                                                                        
                                                                        </i>Eliminar
                                                                    </button> -->
                                                                                <!-- Payment Information filling or empty end -->
                                                                            </div>

                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-personal-info-filling">
                                                                <div class="form-wrap-inner">
                                                                    <div class="d-flex">
                                                                        <!-- checkbox session -->
                                                                        <!-- <div class="form-group">
                                                                            <div class="custom-control cst-checkbox custom-checkbox">
                                                                                <input type="checkbox" class="custom-control-input" id="profesioncheck">
                                                                                <label class="custom-control-label  ml-1" for="profesioncheck"></label>
                                                                            </div>
                                                                        </div> -->
                                                                        <!-- checkbox session -->
                                                                        <!-- input Profesión -->
                                                                        <div class="flex-grow-1">
                                                                            <div class="form-group confirm-val">
                                                                                <label class="Ttulo">Profesión</label>
                                                                                <input type="text" class="form-control" name="profession" id="profession" placeholder="Escribir..." value="{{$user_data['profession']}}">
                                                                                <div class="val-error error_profession"></div>
                                                                                <!-- validation icon -->
                                                                                <!-- <span class="val-icon">
                                                                            <i class="icon-icons-checkmark-checkmark-1"></i> -->
                                                                                <!-- uncomment when error -->
                                                                                <!-- <i class="icon-icons-alert-circle1 icon-error"></i> -->
                                                                                <!-- uncomment when error -->
                                                                                <!-- </span> -->
                                                                                <!-- <span class="val-error">No hay ninguna cuenta con este correo. Pruebe de nuevo.</span> -->
                                                                                <!-- validation icon end-->
                                                                            </div>



                                                                        </div>
                                                                        <!-- input Profesión end -->
                                                                    </div>


                                                                </div>



                                                            </div>
                                                        </div>
                                                        <!-- single form-seciton start end-->
                                                        <!-- single form-seciton start -->
                                                        <div class="inner-form-section personal-div">
                                                            <div class="header-separate-form">
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <div class="d-flex ">
                                                                            <div class=" flex-grow-1 ">
                                                                                <div class="form-control">
                                                                                    Dirección
                                                                                </div>
                                                                            </div>
                                                                            <div class="btn-remove-details">
                                                                                <!-- <button class="btn btn-comon btn-blue btn-w-icon disabled">
                                                                                    <i class="icon-icons-save">

                                                                                    </i>Guardar
                                                                                </button> -->
                                                                                <!-- Payment Information filling or empty / uncomment below code -->
                                                                                <!-- <button class="btn btn-comon btn-blue btn-w-icon disabled">
                                                                        <i class="icon-icons-close-close">
                                                                        
                                                                        </i>Eliminar
                                                                    </button> -->
                                                                                <!-- Payment Information filling or empty end -->
                                                                            </div>

                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-personal-info-filling">
                                                                <div class="form-wrap-inner">
                                                                    <div class="d-flex">
                                                                        <!-- checkbox session -->
                                                                        <!-- <div class="form-group">
                                                                            <div class="custom-control cst-checkbox custom-checkbox">
                                                                                <input type="checkbox" class="custom-control-input" id="addrescheck">
                                                                                <label class="custom-control-label  ml-1" for="addrescheck"></label>
                                                                            </div>
                                                                        </div> -->
                                                                        <!-- checkbox session -->
                                                                        <!-- input Dirección -->
                                                                        <div class="flex-grow-1">
                                                                            <div class="form-group confirm-val">
                                                                                <label class="Ttulo">Dirección</label>
                                                                                <textarea class="form-control" name="direction" id="direction" placeholder="Escribir..." value="{{$user_data['direction']}}">{{$user_data['direction']}}</textarea>
                                                                                <div class="val-error error_direction"></div>
                                                                                <!-- validation icon -->
                                                                                <!-- <span class="val-icon">
                                                                            <i class="icon-icons-checkmark-checkmark-1"></i> -->
                                                                                <!-- uncomment when error -->
                                                                                <!-- <i class="icon-icons-alert-circle1 icon-error"></i> -->
                                                                                <!-- uncomment when error -->
                                                                                <!-- </span> -->
                                                                                <!-- <span class="val-error">No hay ninguna cuenta con este correo. Pruebe de nuevo.</span> -->
                                                                                <!-- validation icon end-->
                                                                            </div>



                                                                        </div>
                                                                        <!-- input Dirección end -->
                                                                    </div>


                                                                </div>



                                                            </div>
                                                        </div>
                                                        <!-- single form-seciton start end-->
                                                        <!-- single form-seciton start -->
                                                        <div class="inner-form-section document_section personal-div">
                                                            <div class="header-separate-form">
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <div class="d-flex ">
                                                                            <div class=" flex-grow-1 ">
                                                                                <div class="form-control">
                                                                                    Documentos Legales
                                                                                </div>
                                                                            </div>
                                                                            <div class="btn-remove-details">
                                                                                <!-- <button class="btn btn-comon btn-blue btn-w-icon disabled">
                                                                                    <i class="icon-icons-save">

                                                                                    </i>Guardar
                                                                                </button> -->
                                                                                <!-- Payment Information filling or empty / uncomment below code -->
                                                                                <!-- <button class="btn btn-comon btn-blue btn-w-icon disabled">
                                                                        <i class="icon-icons-close-close">
                                                                        
                                                                        </i>Eliminar
                                                                    </button> -->
                                                                                <!-- Payment Information filling or empty end -->
                                                                            </div>

                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-personal-info-filling upload_div">
                                                            @if($user_data['rtu'])
                                                                <div class="form-wrap-inner rtu_main file-presnt">
                                                            @else
                                                                <div class="form-wrap-inner rtu_main ">
                                                            @endif
                                                                    <div class="d-flex">
                                                                        <!-- checkbox session -->
                                                                        <div class="icon-downlad">
                                                                        @if($user_data['rtu'])
                                                                            <a href ="{{asset('storage/'.Auth::user()->rtu) }}" download="{{$user_data['rtu']}}" style="color:black">
                                                                                <i class="icon-icons-arrow-circle-down"></i>
                                                                            </a>
                                                                        @else
                                                                            <i class="icon-icons-arrow-circle-down disabled"></i>
                                                                        @endif
                                                                        
                                                                        </div>
                                                                        <!-- checkbox session -->
                                                                        <!-- input RTU -->
                                                                        <div class="flex-grow-1">
                                                                            <div class="form-group confirm-val">
                                                                                <label class="Ttulo">RTU</label>
                                                                                <div class="form-down-bt">
                                                                                    <div class="upload-doc-wrap d-flx align-items-center ">
                                                                                        <a class="btn btn-comon btn-blue btn-w-icon file_up">
                                                                                            <i class="icon-icons-plus-circle1"></i>
                                                                                            Subir 
                                                                                            <input type="file" name="rtu" id="rtu" class="item-img file center-block">
                                                                                        </a>
                                                                                        <!-- only show if file uploaded -->
                                                                                        <span class="file-uploaded-wrap">
                                                                                            <div class="file-name-ico BodyBody-2 rtu ">
                                                                                            
                                                                                            </div>
                                                                                                @if($user_data['rtu'])
                                                                                                <div class="file-name-ico BodyBody-2 rtu_current">
                                                                                                    <i class="icon-icons-close-close remove_rtu"></i>{{$user_data['rtu_file_name']}}
                                                                                                </div>
                                                                                                @endif
                                                                                        </span>
                                                                                        <!-- only show if file uploaded -->
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                        </div>
                                                                        <!-- input RTU end -->
                                                                    </div>
                                                                </div>
                                                                @if($user_data['appointment_file_name'])
                                                                    <div class="form-wrap-inner appoinment_main file-presnt">
                                                                @else
                                                                    <div class="form-wrap-inner appoinment_main ">
                                                                @endif
                                                                    <div class="d-flex">
                                                                        <!-- checkbox session -->
                                                                        <div class="icon-downlad">
                                                                        @if($user_data['appointment_file_name'])
                                                                        <a href ="{{asset('storage/'.Auth::user()->appointment) }}" download="{{$user_data['appointment_file_name']}}" style="color:black">
                                                                            <i class="icon-icons-arrow-circle-down"></i>
                                                                        </a>
                                                                        @else
                                                                            <i class="icon-icons-arrow-circle-down disabled"></i>
                                                                        @endif
                                                                        
                                                                        </div>
                                                                        <!-- checkbox session -->
                                                                        <!-- input Nombramiento -->
                                                                        <div class="flex-grow-1">
                                                                            <div class="form-group confirm-val">
                                                                                <label class="Ttulo">Nombramiento</label>
                                                                                <div class="form-down-bt">
                                                                                    <div class="upload-doc-wrap d-flx align-items-center ">
                                                                                        <a class="btn btn-comon btn-blue btn-w-icon file_up">
                                                                                            <i class="icon-icons-plus-circle1"></i>
                                                                                            Subir
                                                                                            <input type="file" class="item-img file center-block" name="appointment" id="appoinment">
                                                                                        </a>
                                                                                        <!-- only show if file uploaded -->
                                                                                        <span class="file-uploaded-wrap">
                                                                                            <div class="file-name-ico BodyBody-2 appoinment">
                                                                                                
                                                                                            </div>
                                                                                            @if($user_data['appointment'])
                                                                                            <div class="file-name-ico BodyBody-2 appoinment_current">
                                                                                                    <i class="icon-icons-close-close remove_appoinment"></i>{{$user_data['appointment_file_name']}}
                                                                                            </div>
                                                                                            @endif
                                                                                        </span>
                                                                                        <!-- only show if file uploaded -->
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                        </div>
                                                                        <!-- input Nombramiento end -->
                                                                    </div>
                                                                </div>
                                                                @if($user_data['company_trade_patent_file_name'])
                                                                    <div class="form-wrap-inner company_main file-presnt">
                                                                @else
                                                                    <div class="form-wrap-inner company_main ">
                                                                @endif
                                                                    <!-- add "file-present" class if file uploaded-->
                                                                    <div class="d-flex">
                                                                        <!-- checkbox session -->
                                                                        <div class="icon-downlad">
                                                                        @if($user_data['company_trade_patent_file_name'])
                                                                            <a href ="{{asset('storage/'.Auth::user()->company_trade_patent) }}" download="{{$user_data['company_trade_patent_file_name']}}" style="color:black">
                                                                                <i class="icon-icons-arrow-circle-down"></i>
                                                                            </a>
                                                                        @else
                                                                            <i class="icon-icons-arrow-circle-down disabled"></i>
                                                                        @endif
                                                                            
                                                                        </div>
                                                                        <!-- checkbox session -->
                                                                        <!-- input Patente de Comercio de Empresa -->
                                                                        <div class="flex-grow-1">
                                                                            <div class="form-group confirm-val">
                                                                                <label class="Ttulo">Patente de Comercio de Empresa</label>
                                                                                <div class="form-down-bt">
                                                                                    <div class="upload-doc-wrap d-flx align-items-center ">
                                                                                        <a class="btn btn-comon btn-blue btn-w-icon file_up">
                                                                                            <i class="icon-icons-plus-circle1"></i>
                                                                                            Subir
                                                                                            <input type="file" class="item-img file center-block" name="company_trade_patent" id="company_trade_patent">
                                                                                        </a>
                                                                                        <!-- only show if file uploaded -->
                                                                                        <span class="file-uploaded-wrap">
                                                                                            <div class="file-name-ico BodyBody-2 patente ">
                                                                                            </div>
                                                                                            @if($user_data['company_trade_patent'])
                                                                                                <div class="file-name-ico BodyBody-2 patente_current">
                                                                                                <i class="icon-icons-close-close remove_patente"></i>{{$user_data['company_trade_patent_file_name']}}
                                                                                                </div>
                                                                                            @endif
                                                                                        </span>
                                                                                        <!-- only show if file uploaded -->
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                        </div>
                                                                        <!-- input Patente de Comercio de Empresa end -->
                                                                    </div>
                                                                </div>
                                                                @if($user_data['society_trade_patent_file_name'])
                                                                    <div class="form-wrap-inner society_main file-presnt">
                                                                @else
                                                                    <div class="form-wrap-inner society_main ">
                                                                @endif
                                                                 <div class="d-flex">
                                                                        <!-- checkbox session -->
                                                                        <div class="icon-downlad">
                                                                        @if($user_data['society_trade_patent_file_name'])
                                                                            <a href ="{{asset('storage/'.Auth::user()->society_trade_patent) }}" download="{{$user_data['society_trade_patent_file_name']}}" style="color:black">
                                                                                <i class="icon-icons-arrow-circle-down"></i>
                                                                            </a>
                                                                        @else
                                                                            <i class="icon-icons-arrow-circle-down disabled"></i>
                                                                        @endif
                                                                            
                                                                        </div>
                                                                        <!-- checkbox session -->
                                                                        <!-- input Patente de Comercio de Sociedad -->
                                                                        <div class="flex-grow-1">
                                                                            <div class="form-group confirm-val">
                                                                                <label class="Ttulo">Patente de Comercio de Sociedad</label>

                                                                                <div class="form-down-bt">
                                                                                <div class="upload-doc-wrap d-flx align-items-center ">
                                                                                    <a class="btn btn-comon btn-blue btn-w-icon file_up">
                                                                                        <i class="icon-icons-plus-circle1"></i>
                                                                                        Subir
                                                                                        <input type="file" class="item-img file center-block" name="society_trade_patent" id="society_trade_patent" >
                                                                                    </a>
                                                                                    <!-- only show if file uploaded -->
                                                                                    <span class="file-uploaded-wrap">
                                                                                            <div class="file-name-ico BodyBody-2 Patente_Sociedad ">
                                                                                            </div>
                                                                                            @if($user_data['society_trade_patent'])
                                                                                            <div class="file-name-ico BodyBody-2 Patente_Sociedad_current">
                                                                                            <i class="icon-icons-close-close remove_Patente_Sociedad"></i>{{$user_data['society_trade_patent_file_name']}}
                                                                                            </div>
                                                                                            @endif
                                                                                    </span>
                                                                                    <!-- only show if file uploaded -->
                                                                                </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <!-- input Patente de Comercio de Sociedad end -->
                                                                        
                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </div>
                                                        <!-- single form-seciton start end-->
                                                        <!-- single form-seciton start -->
                                                        <div class="inner-form-section save-frm">

                                                            <div class="form-personal-info-filling">
                                                                <div class="form-wrap-inner">
                                                                    <div class="1">
                                                                        <div class="save-profile">
                                                                            <!-- remove 'disabled' class once form fill -->
                                                                            <a class="btn btn-comon btn-blue btn-w-icon savePersonalInfo disabled" style="max-width: 14rem"><i class="icon-icons-save"></i><span style="padding-left:25px;">Guardar Todo</span></a>
                                                                            
                                                                            <!-- remove 'disabled' class once form fill -->
                                                                        </div>
                                                                    </div>


                                                                </div>



                                                            </div>
                                                        </div>
                                                        <!-- single form-seciton start end-->

                                                    </div>
                                                </form>
                                            </div>
                                            @endif
                                        @endif

                                    </div>
                                </div>
                            </div>
                            <!-- personal info tab details end -->

                            <!-- personal info tab subscription -->
                            <div class="tab-pane  profile-subscripiton-wrap fade" id="profile-subscription" role="tabpanel" aria-labelledby="profile-subscription-tab">
                                <div class="row">
                                    <div class="col-md-12 ">
                                        @if(Auth::user()->user_type == 1||Auth::user()->user_type == 3)
                                            <!-- shows only no subscribe yet -->
                                            <div class="subscription-page subscribe-page">
                                                <div class="form-filling-wrap p-0">
                                                    <div class="row flx-vcenter">
                                                        <div class="col-lg-5">
                                                            <div class="illustra-img">
                                                                <img src="{{asset('front/assets/img/illustraction/payment.png')}}" class="lazyload" />
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-7">
                                                            <div class="subscribe-content">
                                                                <h2 class="HeadlineH2-2">¡Hola! Al parecer aún no está subscrito. </h2>
                                                                <p class="BodyBody-2">Tener una suscripcipon proporciona varios beneficios. Desde la opción de poder guardar documentos, hasta la opción de guardar información personal. Verifique nuestras distintas suscripciones parar adquirir la que le beneficie. </p>
                                                                <div class="purchase-bt">
                                                                    <a href="{{route('user.price')}}" class="btn btn-comon btn-blue">Subscribirse</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <!-- shows only no subscribe end yet -->
                                        @else
                                            <div class="pricing-page pricing-actual-page">
                                                <div class="price-list-wrap">
                                                    <div class="pricing-listing-wrap">
                                                        <div class="multi-price-wrap">
                                                            <div class="multi-head ">
                                                                <div class="d-flex justify-content-around">
                                                                    <div class="HeadlineH4-2">
                                                                        Periodo de Compra:
                                                                    </div>
                                                                    <div class="radio">
                                                                        @if($subscription['priceMatrice']['payment_type'] == "Monthly")
                                                                            <div class="custom-control cst-radio custom-radio mb-0 custom-control-inline">
                                                                                <input type="radio" id="mensual" name="priceplan" value="monthly" class="custom-control-input pricepln" checked>
                                                                                <label class="custom-control-label ml-1 " for="mensual">Mensual </label>
                                                                            </div>
                                                                            <div class="custom-control cst-radio custom-radio mb-0 custom-control-inline">
                                                                                <input type="radio" id="anual" name="priceplan" value="anual" class="custom-control-input pricepln">
                                                                                <label class="custom-control-label ml-1 " for="anual">Anual</label>
                                                                            </div>
                                                                        @else
                                                                            <div class="custom-control cst-radio custom-radio mb-0 custom-control-inline">
                                                                                <input type="radio" id="mensual" name="priceplan" value="monthly" class="custom-control-input pricepln">
                                                                                <label class="custom-control-label ml-1 " for="mensual">Mensual </label>
                                                                            </div>
                                                                            <div class="custom-control cst-radio custom-radio mb-0 custom-control-inline">
                                                                                <input type="radio" id="anual" name="priceplan" value="anual" class="custom-control-input pricepln" checked>
                                                                                <label class="custom-control-label ml-1 " for="anual">Anual</label>
                                                                            </div>
                                                                        @endif
                                                                    </div>
                                                                </div>

                                                            </div>

                                                            <div class="row">
                                                                @if($subscription['priceMatrice']['payment_type'] == "Monthly")
                                                                <div class="col-md-6 monthlyStandard">
                                                                @else
                                                                <div class="col-md-6 monthlyStandard d-none">
                                                                @endif
                                                                    <div class="card">
                                                                        <div class="price-head">

                                                                            <div class="price-head-title HeadlineH3-2">
                                                                                Suscripción Estándar
                                                                            </div>
                                                                        </div>
                                                                        <div class="price-features">
                                                                            <div class="features-title HeadlineH4-2">
                                                                                ¿Qué permite?
                                                                            </div>
                                                                            <div class="features-list">
                                                                                <ul>
                                                                                    <li>
                                                                                        Completar e imprimir los documento seleccionados.
                                                                                    </li>
                                                                                    <li>
                                                                                        Guardar el progreso hasta por 30 días.
                                                                                    </li>
                                                                                    <li>
                                                                                        Opción de enviar el documento a un abogado para su autenticación a un costo adicional.
                                                                                    </li>
                                                                                    <li>
                                                                                        Completar e imprimir documentos del nivel seleccionado.
                                                                                    </li>
                                                                                    <li>
                                                                                        Acceso a "Mi Carpeta" para guardar documentos en la nube.
                                                                                    </li>
                                                                                    <li class="disabled">
                                                                                        Acceso a "Mi información personal", en el que el usuario podrá guardar documentos e información para uso recurrente en todos los documentos.
                                                                                    </li>
                                                                                    <li class="disabled">
                                                                                        Recordatorios sobre las fechas de vencimiento de los documentos.
                                                                                    </li>
                                                                                </ul>
                                                                            </div>
                                                                            <div class="price-choose-bt">
                                                                                <div class="saving-title">
                                                                                    <div class="save-title-inner" style="display: none;">
                                                                                        Usted ahorra un 11.39 %
                                                                                    </div>
                                                                                </div>
                                                                                
                                                                                @if($subscription['subscriptionType']['id'] == 2 && $subscription['priceMatrice']['payment_type'] == "Monthly")
                                                                                    <div class="price-info">
                                                                                        <i class="icon-icons-checkmark-circle"></i>Q {{$subscription['priceMatrice']['price']}} 
                                                                                    </div> 
                                                                                    <a href="#" class="btn btn-comon btn-blue-outline d-full disabled">Cambiar a Suscripción Anual</a>
                                                                                    <div class="info-detail color-red" data-toggle="modal" data-target="#modalPlancancel"><a href="#" class="color-red">Cancelar Suscripción</a></div>
                                                                                @else
                                                                                    <div class="price-info">
                                                                                        Q 397.00
                                                                                        <!-- shows only monthly pay end -->
                                                                                    </div> 
                                                                                    @if($subscription['priceMatrice']['payment_type'] == "Monthly") 
                                                                                        <a href="#" class="btn btn-comon btn-blue d-full" data-toggle="modal" data-target="#modalPlanchange">cambiar a esta suscripción</a>
                                                                                        <div class="info-detail color-red"></div>
                                                                                    @else
                                                                                        <a href="#" class="btn btn-comon btn-blue d-full disabled" data-toggle="modal" data-target="#modalPlanchange">cambiar a esta suscripción</a>
                                                                                        <div class="info-detail color-red"></div>
                                                                                    @endif
                                                                                @endif
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                @if($subscription['priceMatrice']['payment_type'] == "Monthly")
                                                                <div class="col-md-6 monthlyPremium">
                                                                @else
                                                                <div class="col-md-6 monthlyPremium d-none">
                                                                @endif
                                                                    <div class="card">
                                                                        <div class="price-head">

                                                                            <div class="price-head-title HeadlineH3-2">
                                                                                Suscripción Premium
                                                                            </div>
                                                                        </div>
                                                                        <div class="price-features">
                                                                            <div class="features-title HeadlineH4-2">
                                                                                ¿Qué permite?
                                                                            </div>
                                                                            <div class="features-list">
                                                                                <ul>
                                                                                    <li>
                                                                                        Completar e imprimir los documento seleccionados.
                                                                                    </li>
                                                                                    <li>
                                                                                        Guardar el progreso hasta por 30 días.
                                                                                    </li>
                                                                                    <li>
                                                                                        Opción de enviar el documento a un abogado para su autenticación a un costo adicional.
                                                                                    </li>
                                                                                    <li>
                                                                                        Completar e imprimir documentos del nivel seleccionado.
                                                                                    </li>
                                                                                    <li>
                                                                                        Acceso a "Mi Carpeta" para guardar documentos en la nube.
                                                                                    </li>
                                                                                    <li>
                                                                                        Acceso a "Mi información personal", en el que el usuario podrá guardar documentos e información para uso recurrente en todos los documentos.
                                                                                    </li>
                                                                                    <li>
                                                                                        Recordatorios sobre las fechas de vencimiento de los documentos.
                                                                                    </li>
                                                                                </ul>
                                                                            </div>
                                                                            <div class="price-choose-bt">
                                                                                <div class="saving-title">
                                                                                    <div class="save-title-inner" style="display: none;">
                                                                                        Usted ahorra un 17.67 %
                                                                                    </div>
                                                                                </div>
                                                                                <!-- shows only monthly pay -->
                                                                                <!-- <div class="price-info">
                                                                            Q 4,970.00
                                                                                </div> -->
                                                                                <!-- shows only monthly pay end -->
                                                                                
                                                                                @if($subscription['subscriptionType']['id'] == 3 && $subscription['priceMatrice']['payment_type'] == "Monthly")
                                                                                    <div class="price-info">
                                                                                            <i class="icon-icons-checkmark-circle"></i>Q {{$subscription['priceMatrice']['price']}} 
                                                                                    </div>
                                                                                    <a href="#" class="btn btn-comon btn-blue-outline d-full disabled">Cambiar a Suscripción Anual</a>
                                                                                    <div class="info-detail color-red" data-toggle="modal" data-target="#modalPlancancel"><a href="#" class="color-red">Cancelar Suscripción</a></div>
                                                                                @else
                                                                                    <div class="price-info">
                                                                                        <!-- shows only monthly pay -->
                                                                                        Q 497.00
                                                                                        <!-- shows only monthly pay end -->
                                                                                        
                                                                                    </div>
                                                                                    @if($subscription['priceMatrice']['payment_type'] == "Monthly") 
                                                                                        <a href="#" class="btn btn-comon btn-blue d-full" data-toggle="modal" data-target="#modalPlanchange">cambiar a esta suscripción</a>
                                                                                        <div class="info-detail color-red"></div>
                                                                                    @else
                                                                                        <a href="#" class="btn btn-comon btn-blue d-full disabled" data-toggle="modal" data-target="#modalPlanchange">cambiar a esta suscripción</a>
                                                                                        <div class="info-detail color-red"></div>
                                                                                    @endif
                                                                                @endif
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <!--Monthly End-->


                                                                <!--Annual-->
                                                                <!-- <div class="annual"> -->
                                                                @if($subscription['priceMatrice']['payment_type'] == "Monthly")
                                                                <div class="col-md-6 annualStandard d-none">
                                                                @else
                                                                <div class="col-md-6 annualStandard">
                                                                @endif
                                                                    <div class="card">
                                                                        <div class="price-head">

                                                                            <div class="price-head-title HeadlineH3-2">
                                                                                Suscripción Estándar
                                                                            </div>
                                                                        </div>
                                                                        <div class="price-features">
                                                                            <div class="features-title HeadlineH4-2">
                                                                                ¿Qué permite?
                                                                            </div>
                                                                            <div class="features-list">
                                                                                <ul>
                                                                                    <li>
                                                                                        Completar e imprimir los documento seleccionados.
                                                                                    </li>
                                                                                    <li>
                                                                                        Guardar el progreso hasta por 30 días.
                                                                                    </li>
                                                                                    <li>
                                                                                        Opción de enviar el documento a un abogado para su autenticación a un costo adicional.
                                                                                    </li>
                                                                                    <li>
                                                                                        Completar e imprimir documentos del nivel seleccionado.
                                                                                    </li>
                                                                                    <li>
                                                                                        Acceso a "Mi Carpeta" para guardar documentos en la nube.
                                                                                    </li>
                                                                                    <li class="disabled">
                                                                                        Acceso a "Mi información personal", en el que el usuario podrá guardar documentos e información para uso recurrente en todos los documentos.
                                                                                    </li>
                                                                                    <li class="disabled">
                                                                                        Recordatorios sobre las fechas de vencimiento de los documentos.
                                                                                    </li>
                                                                                </ul>
                                                                            </div>
                                                                            <div class="price-choose-bt">
                                                                                <div class="saving-title">
                                                                                    <div class="save-title-inner" style="display: none;">
                                                                                        Usted ahorra un 11.39 %
                                                                                    </div>
                                                                                </div>
                                                                                
                                                                                @if($subscription['subscriptionType']['id'] == 2 && $subscription['priceMatrice']['payment_type'] != "Monthly")
                                                                                    <div class="price-info">
                                                                                        <i class="icon-icons-checkmark-circle"></i>Q {{$subscription['priceMatrice']['price']}} 
                                                                                    </div> 
                                                                                    <a href="#" class="btn btn-comon btn-blue-outline d-full disabled">Cambiar a Suscripción Mensual</a>
                                                                                    <div class="info-detail color-red" data-toggle="modal" data-target="#modalPlancancel"><a href="#" class="color-red">Cancelar Suscripción</a></div>
                                                                                @else
                                                                                    <div class="price-info">
                                                                                    
                                                                                        Q 3,970.00
                                                                                    </div>  
                                                                                    @if($subscription['priceMatrice']['payment_type'] != "Monthly")
                                                                                        <a href="#" class="btn btn-comon btn-blue d-full" data-toggle="modal" data-target="#modalPlanchange">cambiar a esta suscripción</a>
                                                                                        <div class="info-detail color-red"></div>
                                                                                    @else
                                                                                        <a href="#" class="btn btn-comon btn-blue d-full disabled" data-toggle="modal" data-target="#modalPlanchange">cambiar a esta suscripción</a>
                                                                                        <div class="info-detail color-red"></div>
                                                                                    @endif
                                                                                @endif
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                @if($subscription['priceMatrice']['payment_type'] == "Monthly")
                                                                <div class="col-md-6 annualPremium d-none">
                                                                @else
                                                                <div class="col-md-6 annualStandard">
                                                                @endif
                                                                    <div class="card">
                                                                        <div class="price-head">

                                                                            <div class="price-head-title HeadlineH3-2">
                                                                                Suscripción Premium
                                                                            </div>
                                                                        </div>
                                                                        <div class="price-features">
                                                                            <div class="features-title HeadlineH4-2">
                                                                                ¿Qué permite?
                                                                            </div>
                                                                            <div class="features-list">
                                                                                <ul>
                                                                                    <li>
                                                                                        Completar e imprimir los documento seleccionados.
                                                                                    </li>
                                                                                    <li>
                                                                                        Guardar el progreso hasta por 30 días.
                                                                                    </li>
                                                                                    <li>
                                                                                        Opción de enviar el documento a un abogado para su autenticación a un costo adicional.
                                                                                    </li>
                                                                                    <li>
                                                                                        Completar e imprimir documentos del nivel seleccionado.
                                                                                    </li>
                                                                                    <li>
                                                                                        Acceso a "Mi Carpeta" para guardar documentos en la nube.
                                                                                    </li>
                                                                                    <li>
                                                                                        Acceso a "Mi información personal", en el que el usuario podrá guardar documentos e información para uso recurrente en todos los documentos.
                                                                                    </li>
                                                                                    <li>
                                                                                        Recordatorios sobre las fechas de vencimiento de los documentos.
                                                                                    </li>
                                                                                </ul>
                                                                            </div>
                                                                            <div class="price-choose-bt">
                                                                                <div class="saving-title">
                                                                                    <div class="save-title-inner" style="display: none;">
                                                                                        Usted ahorra un 17.67 %
                                                                                    </div>
                                                                                </div>
                                                                                <!-- shows only monthly pay -->
                                                                                <!-- <div class="price-info">
                                                                            Q 4,970.00
                                                                                </div> -->
                                                                                <!-- shows only monthly pay end -->
                                                                                
                                                                                @if($subscription['subscriptionType']['id'] == 3 && $subscription['priceMatrice']['payment_type'] != "Monthly")
                                                                                    <div class="price-info">
                                                                                            <i class="icon-icons-checkmark-circle"></i>Q {{$subscription['priceMatrice']['price']}} 
                                                                                    </div>
                                                                                    <a href="#" class="btn btn-comon btn-blue-outline d-full disabled">Cambiar a Suscripción Mensual</a>
                                                                                    <div class="info-detail color-red" data-toggle="modal" data-target="#modalPlancancel"><a href="#" class="color-red">Cancelar Suscripción</a></div>
                                                                                @else
                                                                                    <div class="price-info">
                                                                                       
                                                                                            Q 4,970.00
                                                                                    </div>
                                                                                    @if($subscription['priceMatrice']['payment_type'] != "Monthly")
                                                                                        <a href="#" class="btn btn-comon btn-blue d-full" data-toggle="modal" data-target="#modalPlanchange">cambiar a esta suscripción</a>
                                                                                        <div class="info-detail color-red"></div>
                                                                                    @else
                                                                                        <a href="#" class="btn btn-comon btn-blue d-full disabled" data-toggle="modal" data-target="#modalPlanchange">cambiar a esta suscripción</a>
                                                                                        <div class="info-detail color-red"></div>
                                                                                    @endif
                                                                                @endif
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <!--End Annual-->
                                                            </div>
                                                        
                                                        </div>
                                                        <div class="plan-change-info">
                                                            <div class="plan-info-inner">
                                                                <p class="BodyBody-2"> Los cambios en su suscripción se llevarán a cabo una vez que finalice la suscripción actual. </p>
                                                                <p  class="BodyBody-2">
                                                                    Su suscripción se renueva los <span class="fn-bold">4</span> de cada mes.</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        @endif
                                    </div>
                                </div>

                            </div>
                            <!-- personal info tab subscription end -->
                            <!-- personal info tab payment  -->
                            <div class="tab-pane profile-tab-detais profile-tab-saved-card-wrap fade" id="profile-payment" role="tabpanel" aria-labelledby="profile-payment-tab">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="helloIllustraction">
                                            <img src="{{asset('front/assets/img/illustraction/subscribepay.png')}}" class="img-fluid lazyload" />
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="profile-input-wrap">
                                            <div class="SignContentModal">
                                                <div class="save-card-title">
                                                    <div class="d-flex ">
                                                        <div class=" flex-grow-1 ">
                                                            <div class="form-control">
                                                                Información de Tarjeta
                                                            </div>
                                                        </div>
                                                        <div class="btn-remove-details">
                                                            <button class="btn btn-comon btn-blue btn-w-icon ">
                                                                <i class="icon-icons-close-close">

                                                                </i>Eliminar
                                                            </button>
                                                            <!-- Payment Information filling or empty / uncomment below code -->
                                                            <!-- <button class="btn btn-comon btn-blue btn-w-icon disabled">
                                                                <i class="icon-icons-close-close">
                                                                
                                                                </i>Eliminar
                                                            </button> -->
                                                            <!-- Payment Information filling or empty end -->
                                                        </div>

                                                    </div>
                                                </div>
                                                <div class="modal-doument-form">
                                                    <form>
                                                        <div class="form-group">
                                                            <label class="Ttulo">Nombre</label>
                                                            <input type="text" class="form-control" placeholder="Escribir...">
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="Ttulo">Número de tarjeta</label>
                                                            <input type="text" class="form-control" placeholder="Escribir..." id="cardnumber">
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group  confirm-val">
                                                                    <label class="Ttulo">Fecha de Expiración</label>
                                                                    <input type="text" id="expdate" class="form-control mb-0" placeholder="Escribir...">


                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group mb-0">
                                                                    <label class="Ttulo">CVV</label>
                                                                    <input type="text" class="form-control mb-0 " placeholder="Escribir..." id="cvv">
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </form>
                                                </div>
                                                <div class="reg-bt-choose">
                                                    <a class="btn btn-comon btn-blue disabled">Guardar</a>

                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <!-- personal info tab subscription end -->
                        </div>
                    </div>
                    <!-- profile-tab-nav-links-end -->
                </div>
            </div>
        </section>



    </main>

<!-- modal for subscription message -->
<div class="modal modal_changeplan fade" id="modalPlanchange" tabindex="-1" role="dialog" aria-labelledby="modalPlanchangeLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <button type="button" class="close mdl-cls" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="icon-icons-close-close-1"></i></span>
                </button>
                <div class="modal-body">
                    <div class="row flx-vcenter">
                        <div class="col-md-5">
                            <div class="helloIllustraction">
                                <img src="{{asset('front/assets/img/illustraction/changeplan.png')}}" class="img-fluid lazyload" />
                            </div>
                        </div>
                        <div class="col-md-7">
                            <div class="SignContentModal">
                                <h2 class="HeadlineH2-2">¿Quiere cambiar  su suscripción?</h2>
                                <h4 class="HeadlineH4-2 ">Al cambiar de suscripción también cambiaran sus funcionalides. 
¿Esta seguro/a?</h4>
                                <div class="reg-bt-choose">




                                








                                    
                                    <a href="{{route('user.getSubscriptionData')}}" class="btn btn-comon btn-blue">Sí, cambiar</a>
                                    <a href="#" class="btn btn-comon btn-blue "data-dismiss="modal">No, cancelar</a>
                                    
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
<!-- modal for subscription message end -->
<!-- modal for subscription message -->
<div class="modal modal_cance_sub fade" id="modalPlancancel" tabindex="-1" role="dialog" aria-labelledby="modalPlancancelLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <button type="button" class="close mdl-cls" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="icon-icons-close-close-1"></i></span>
                </button>
                <div class="modal-body">
                    <div class="row flx-vcenter">
                        <div class="col-md-5">
                            <div class="helloIllustraction">
                                <img src="{{asset('front/assets/img/illustraction/error.png')}}" class="img-fluid lazyload" />
                            </div>
                        </div>
                        <div class="col-md-7">
                            <div class="SignContentModal">
                                <h2 class="HeadlineH2-2">¿Quiere cancelar su suscripción?</h2>
                                <h4 class="HeadlineH4-2 ">Al cancelar dejará de tener las funcionalides de su actual suscripción. ¿Esta seguro/a?</h4>
                                <div class="reg-bt-choose">
                                    
                                    <a href="#" class="btn btn-comon btn-red keepCredit">Cancelar</a>
                                    <a href="#" class="btn btn-comon btn-blue" data-dismiss="modal">Conservar</a>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
<!-- modal for subscription message end -->

<!-- modal for subscription message -->
<div class="modal modal_cance_sub fade" id="modalPlancancelKeepCredit" tabindex="-1" role="dialog" aria-labelledby="modalPlancancelLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <button type="button" class="close mdl-cls" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="icon-icons-close-close-1"></i></span>
                </button>
                <div class="modal-body">
                    <div class="row flx-vcenter">
                        <div class="col-md-5">
                            <div class="helloIllustraction">
                                <img src="{{asset('front/assets/img/illustraction/error.png')}}" class="img-fluid lazyload" />
                            </div>
                        </div>
                        <div class="col-md-7">
                            <div class="SignContentModal">
                                <h2 class="HeadlineH2-2">¿Mantener crédito?</h2>
                                <h4 class="HeadlineH4-2 ">
                                    ¿Quiere conservar el crédito? Si no, no puede tener la funcionalidad de la suscripción actual
                                </h4>
                                <div class="reg-bt-choose">
                                    <a href="#" class="btn btn-comon btn-red withoutCredit">No necesita</a>
                                    <a href="#" class="btn btn-comon btn-blue keepCredit">Mantener el crédito</a>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
<!-- modal for subscription message end -->

@endsection
@push('js')
<script src="{{ asset('front/assets/custom/js/user.js')}}"></script>

<script>
   function readURL(input) {
      if (input.files && input.files[0]) {
         var reader = new FileReader();
         reader.onload = function(e) {
            $('.profPic').attr('src', e.target.result);
         };
         reader.readAsDataURL(input.files[0]);
      }
   }
</script>
@endpush
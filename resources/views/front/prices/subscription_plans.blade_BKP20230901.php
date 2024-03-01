@extends('front.layouts.price_master')
@section('pageTitle',__('test.Pricing Options'))
@section('content')
    <main class="pricing-page">
        <section class="price-list-wrap">

            <div class="container">

                <div class="row">
                    <div class="col-md-12">
                        <div class="text-center HeadlineH2-2">
                            Nuestros Precios
                        </div>
                    </div>
                </div>
                <!-- pricing listing -->
                <div class="row pricing-listing-wrap">

                    <div class="col-md-4">
                        <div class="single-price-wrap">
                            <div class="singl-head HeadlineH4-2">
                                Compra Única
                            </div>
                            <div class="card">
                                <div class="price-head">

                                    <div class="price-head-title HeadlineH3-2">
                                        Documentos y Listados
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
                                            <li class="disabled">
                                                Completar e imprimir documentos del nivel seleccionado.
                                            </li>
                                            <li class="disabled">
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
                                    <!-- for payment error call option -->
                                        <!-- <a href="#" class="btn btn-comon btn-dark d-full" data-toggle="modal" data-target="#modalPaymentError">Selecionar Documento</a> -->
                                            <!-- for payment error call option -->
                                        <!-- <a href="#" class="btn btn-comon btn-dark d-full" data-toggle="modal" data-target="#modalPaymentError">Selecionar Documento</a> -->
                                        @guest
                                        <a href="{{route('document.index')}}" class="btn btn-comon btn-dark d-full">Selecionar Documento</a>
                                        @endguest

                                        @if((Auth::check()))
                                        <a href="{{route('user.document')}}" class="btn btn-comon btn-dark d-full">Selecionar Documento</a>
                                        @endif
                                        <div class="info-detail">comprar solo una vez</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="multi-price-wrap">
                            <div class="multi-head ">
                                <div class="d-flex justify-content-around">
                                    <div class="HeadlineH4-2">
                                        Periodo de Compra:
                                    </div>
                                    @guest
                                    <div class="radio">
                                        <!-- div class="custom-control cst-radio custom-radio mb-0 custom-control-inline">
                                            <input type="radio" id="mensual" name="price" value="Monthly" class="custom-control-input pricepln" checked>
                                            <label class="custom-control-label ml-1" for="mensual">Mensual </label>
                                        </div -->
                                        <div class="custom-control cst-radio custom-radio mb-0 custom-control-inline">
                                            <input type="radio" id="anual" name="price" value="Annual" class="custom-control-input pricepln" checked>
                                            <label class="custom-control-label ml-1" for="anual">Anual</label>
                                        </div>
                                    </div>
                                    @endguest
                                    @if((Auth::check()))
                                    <div class="radio">
                                        <!-- div class="custom-control cst-radio custom-radio mb-0 custom-control-inline">
                                            <input type="radio" id="mensual" name="priceplan" value="Monthly" class="custom-control-input pricepln" checked>
                                            <label class="custom-control-label ml-1" for="mensual">Mensual </label>
                                        </div -->
                                        <div class="custom-control cst-radio custom-radio mb-0 custom-control-inline">
                                            <input type="radio" id="anual" name="priceplan" value="Annual" class="custom-control-input pricepln checked">
                                            <label class="custom-control-label ml-1" for="anual">Anual</label>
                                        </div>
                                    </div>
                                    @endif
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-md-6 monthlyStandard d-none">
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
                                                <div class="price-info price-standard">
                                                    @foreach($subscriptions as $subscription)
                                                        @if($subscription['subscription_id'] == 2 && $subscription['payment_type'] == "Monthly")
                                                        <span>Q {{$subscription['price']}}</span>
                                                        <?php
                                                        $price_standard = $subscription['price'];
                                                        ?>
                                                        @endif
                                                    @endforeach
                                                </div>

                                                @guest
                                                <a href="#" class="btn btn-comon btn-blue d-full month-bt" data-toggle="modal" data-target="#modalStandardPurchaseSignIn">Comprar</a>
                                                @endguest
                                                @if((Auth::check()))
                                                    @if(!$purchased || $purchased['priceMatrice']['price'] != $price_standard)
                                                        <a href="{{route('purchase',$price_standard)}}" class="btn btn-comon btn-blue d-full month-bt">Comprar</a>
                                                    @else
                                                        <a href="#" class="btn btn-comon btn-blue d-full month-bt disabled">Suscripción Actual</a>
                                                    @endif
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 monthlyPremium d-none">
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
                                                <div class="price-info price-premium">
                                                    @foreach($subscriptions as $subscription)
                                                        @if($subscription['subscription_id'] == 3 && $subscription['payment_type'] == "Monthly")
                                                        <span>Q {{$subscription['price']}}</span>
                                                        <?php
                                                        $price_standard = $subscription['price'];
                                                        ?>
                                                        @endif
                                                    @endforeach
                                                </div>

                                                @guest
                                                <a href="#" class="btn btn-comon btn-blue d-full month-bt1" data-toggle="modal" data-target="#modalPremiumPurchaseSignIn">Comprar</a>
                                                @endguest
                                                @if((Auth::check()))
                                                    <!-- <a href="#" class="btn btn-comon btn-blue d-full"  data-toggle="modal" data-target="#modalPaymentSuccess">Comprar</a> -->
                                                    @if(!$purchased || $purchased['priceMatrice']['price'] != $price_standard)
                                                        <a href="{{route('purchase',$price_standard)}}" class="btn btn-comon btn-blue d-full month-bt">Comprar</a>
                                                    @else
                                                        <a href="#" class="btn btn-comon btn-blue d-full month-bt disabled">Suscripción Actual</a>
                                                    @endif
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
				
				<div class="col-md-3">
				</div>
                                <div class="col-md-6 annualStandard ">
                                    <div class="card">
                                        <div class="price-head">

                                            <div class="price-head-title HeadlineH3-2">
                                                Suscripción Estándar <!--Inscríbase al Seminario-->
                                            </div>
                                        </div>
                                        <div class="price-features">
                                           <div class="features-title HeadlineH4-2">
					   	¿Qué incluye?
					   </div>
                        <!--<div class="features-list"><ul><li>Entrada al seminario virtual</li><li>Acceso a la plataforma Herramientas Legales y a todos sus documentos por 1 año</li><li>Después de este año se cobrará el costo de suscripción anual vigente</li><li>Usted puede cancelar su suscripción en cualquier momento</li></ul></div>-->
                        <div class="features-list">
                            <ul>
                                <li>Acceso a todos los documentos</li>
                                <li>Generación Ilimitada de documentos</li>
                                <li>Habilidad de guardar documentos finalizados en la plataforma</li>
                                <li>Usted puede cancelar su suscripción en cualquier momento</li>
                            </ul>
                        </div>
					   <!-- div class="features-title HeadlineH4-2">
                                                ¿Qué permite?
                                            </div -->
                                            <!-- div class="features-list">
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
                                            </div-->
                                            <div class="price-choose-bt">
                                                <div class="saving-title">
                                                    <div class="save-title-inner" style="display: none;">
                                                        Usted ahorra un 11.39 %
                                                    </div>
                                                </div>
                                                <div class="price-info price-standard">
                                                    @foreach($subscriptions as $subscription)
                                                        @if($subscription['subscription_id'] == 2 && $subscription['payment_type'] == "Annual")
                                                        <span>Q {{$subscription['price']}}</span>
                                                        <?php
                                                        $price_standard = $subscription['price'];
                                                        ?>
                                                        @endif
                                                    @endforeach
                                                </div>

                                                @guest
                                                <a href="#" class="btn btn-comon btn-blue d-full month-bt" data-toggle="modal" data-target="#modalStandardPurchaseSignIn">Comprar</a>
                                                @endguest
                                                @if((Auth::check()))
                                                @if(!$purchased || $purchased['priceMatrice']['price'] != $price_standard)
                                                        <a href="{{route('purchase',$price_standard)}}" class="btn btn-comon btn-blue d-full month-bt">Comprar</a>
                                                    @else
                                                        <a href="#" class="btn btn-comon btn-blue d-full month-bt disabled">Suscripción Actual</a>
                                                    @endif
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>



                                <div class="col-md-6 annualPremium d-none">
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
                                                <div class="price-info price-premium">
                                                    @foreach($subscriptions as $subscription)
                                                        @if($subscription['subscription_id'] == 3 && $subscription['payment_type'] == "Annual")
                                                        <span>Q {{$subscription['price']}}</span>
                                                        <?php
                                                        $price_standard = $subscription['price'];
                                                        ?>
                                                        @endif
                                                    @endforeach
                                                </div>

                                                @guest
                                                <a href="#" class="btn btn-comon btn-blue d-full month-bt1" data-toggle="modal" data-target="#modalPremiumPurchaseSignIn">Comprar</a>
                                                @endguest
                                                @if((Auth::check()))
                                                    <!-- <a href="#" class="btn btn-comon btn-blue d-full"  data-toggle="modal" data-target="#modalPaymentSuccess">Comprar</a> -->
                                                    @if(!$purchased || $purchased['priceMatrice']['price'] != $price_standard)
                                                        <a href="{{route('purchase',$price_standard)}}" class="btn btn-comon btn-blue d-full month-bt">Comprar</a>
                                                    @else
                                                        <a href="#" class="btn btn-comon btn-blue d-full month-bt disabled">Suscripción Actual</a>
                                                    @endif
                                                @endif
                                            </div>
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

<!-- NOTE -->
<!---------------------------------------------------------------------------------->
<!-- login modal will be use if user is not login. Its available in document list page -->
<!----------------------------------------------------------------------------------->
<!-- NOTE -->
<!-- Modal for document subscription onetime payment -->

    <div class="modal fade modal-document-purchase" id="modalDocumentOnetimePurchase" tabindex="-1" role="dialog" aria-labelledby="modalDocumentOnetimePurchase" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg modal-extra-large" role="document">
            <div class="modal-content">
                <button type="button" class="close mdl-cls" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="icon-icons-close-close-1"></i></span>
                </button>
                <div class="modal-body">
                    <div class="row align-items-center">
                        <div class="col-md-5">
                            <div class="helloIllustraction">
                                <img src="{{asset('front/assets/img/illustraction/DocumentPurchase.png')}}" class="img-fluid" />
                            </div>
                        </div>
                        <div class="col-md-7">
                            <div class="SignContentModal">
                                <h2 class="HeadlineH2-2">Compra de Documento</h2>
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="HeadlineH4-2">
                                            Nombre de Documento
                                        </div>
                                        <p class="BodyBody-2 mb-0">
                                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                                        </p>
                                    </div>
                                    <div class="col-md-4">
                                        <h4 class="price-info mb-0 color-blue">Q XXX.XX</h4>

                                    </div>
                                </div>
                                <div class="separate"></div>
                                       <!-- saved-card. Only available if user already save the card info-->
                            <div class="saved-card-info">
                                <div class="custom-control cst-radio cst-saved-card custom-radio ">
                                    <input type="radio" id="savedcard" name="cardsaved" class="custom-control-input">
                                    <label class="custom-control-label ml-1" for="savedcard">Usar *** *** **** 1351</label>
                                </div>
                                <div class="custom-control cst-radio cst-saved-card custom-radio ">
                                    <input type="radio" id="newcard" name="cardsaved" class="custom-control-input">
                                    <label class="custom-control-label ml-1" for="newcard">Usar nueva tarjeta</label>
                                </div>
                            </div>
                            <!-- saved-card end -->
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
                                                <div class="form-group ">
                                                    <label class="Ttulo">Fecha de Expiración</label>
                                                    <input type="text" id="expdate" class="form-control mb-0" placeholder="Escribir..." >
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group mb-0">
                                                    <label class="Ttulo">CVV</label>
                                                    <input type="text" class="form-control mb-0" placeholder="Escribir..." id="cvv">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group d-flex  mb-0">
                                            <div class="custom-control cst-checkbox custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" checked id="rememberdata">
                                                <label class="custom-control-label ml-1" for="rememberdata">Guardar esta tarjeta para futuras compras.</label>
                                            </div>

                                        </div>
                                    </form>
                                </div>
                                <div class="reg-bt-choose">
                                    <a href="javascript::"   class="btn btn-comon btn-blue">Pagar y Descargar</a>

                                </div>
                              
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
    
    <!-- Modal for document subscription onetime payment  -->
        <!-- Modal for payment Error-->
        <div class="modal fade modal-error no-bg" id="modalPaymentError" tabindex="-1" role="dialog" aria-labelledby="modalPaymentErrorLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
            <button type="button" class="close mdl-cls" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="icon-icons-close-close-1"></i></span>
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
                       <h4 class="HeadlineH4-2 ">Al parecer hubo un error al ingresar.
Puede intentar ingresar nuevamente para solucionar el error. </h4>
                       <div class="reg-bt-choose">
                       <a href="user/login.php" class="btn btn-comon btn-blue">Intentar de Nuevo</a>
              
                       </div>
                    </div>
                   </div>
                   
               </div>
                </div>
              
            </div>
        </div>
    </div>
       <!-- Modal for payment Error-->
               <!-- Modal for payment Success-->
               <div class="modal fade pay-success" id="modalPaymentSuccess" tabindex="-1" role="dialog" aria-labelledby="modalPaymentSuccessLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
            <button type="button" class="close mdl-cls" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="icon-icons-close-close-1"></i></span>
                    </button>
                <div class="modal-body">
               <div class="row flx-vcenter">
                   <div class="col-md-5">
                       <div class="helloIllustraction">
                           <img src="{{asset('front/assets/img/illustraction/paymentsucces.png')}}" class="img-fluid"/>
                       </div>
                   </div>
                   <div class="col-md-7">
                       <div class="SignContentModal">
                       <h2 class="HeadlineH2-2">¡Listo!</h2>
                       <h4 class="HeadlineH4-2 ">Su compra se ha realizado de manera exitosa. Ya puede llenar documentos. </h4>
                       <div class="reg-bt-choose payment-success-bt">
                       <a href="user/login.php" class="btn btn-comon btn-blue btn-block">Ir a lista de documentos</a>
                       <a href="user/login.php" class="btn btn-comon btn-blue-outline">Ver documentos en proceso</a>
                       </div>
                    </div>
                   </div>
                   
               </div>
                </div>
              
            </div>
        </div>
    </div>
       <!-- Modal for payment Success-->
<!-- Modal for subscription plan  -->
<div class="modal fade modal-document-purchase pricing-modal" id="modalStandardPurchase" tabindex="-1" role="dialog" aria-labelledby="modalStandardLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg modal-extra-large" role="document">
        <div class="modal-content">
            <button type="button" class="close mdl-cls" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true"><i class="icon-icons-close-close-1"></i></span>
            </button>
            <div class="modal-body">
                <div class="row align-items-center">
                    <div class="col-md-5">
                        <div class="helloIllustraction">
                            <img src="{{asset('front/assets/img/illustraction/subscribepay.png')}}" class="img-fluid" />
                        </div>
                    </div>
                    <div class="col-md-7">
                        <div class="SignContentModal">
                            <h2 class="HeadlineH2-2">Pago de Subscripción</h2>
                            <div class="row subscripe-typ">
                                <div class="col-md-8">

                                    <div class="HeadlineH4-2">
                                        Suscripción Estándar   
                                    </div>

                                    <div class="custom-control cst-radio cst-radio-sm custom-radio  custom-control-inline">
                                        <input type="radio" id="customRadio3" name="customRadio" class="custom-control-input">
                                        <label class="custom-control-label ml-1" for="customRadio3">Mensual</label>
                                    </div>
                                    <div class="custom-control cst-radio cst-radio-sm custom-radio custom-control-inline">
                                        <input type="radio" id="customRadio4" name="customRadio" class="custom-control-input">
                                        <label class="custom-control-label ml-1" for="customRadio4">Anual</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <h4 class="price-info mb-0 color-blue modal-standard"><span>Q {{$price_standard}}</span></h4>
                                    <div class="more-legal-price">
                                        <div class="more-legal-title  text-right" style="display: none;">
                                            Usted ahorra un <span class="font-weight-bold">11.39%</span>
                                        </div>

                                    </div>

                                </div>
                            </div>
                            <div class="separate"></div>
                            <!-- saved-card. Only available if user already save the card info-->
                            <div class="saved-card-info" style="display:none;">
                                <div class="custom-control cst-radio cst-saved-card custom-radio ">
                                    <input type="radio" id="savedcard-2" name="cardsaved" class="custom-control-input">
                                    <label class="custom-control-label ml-1" for="savedcard-2">Usar *** *** **** 1351</label>
                                </div>
                                <div class="custom-control cst-radio cst-saved-card custom-radio ">
                                    <input type="radio" id="newcard-2" name="cardsaved" class="custom-control-input">
                                    <label class="custom-control-label ml-1" for="newcard-2">Usar nueva tarjeta</label>
                                </div>
                            </div>
                            <!-- saved-card end -->
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
                                            <div class="form-group ">
                                                <label class="Ttulo">Fecha de Expiración</label>
                                                <input type="text" id="expdate" class="form-control mb-0" placeholder="Escribir...">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group mb-0">
                                                <label class="Ttulo">CVV</label>
                                                <input type="text" class="form-control mb-0" placeholder="Escribir..." id="cvv">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group d-flex  mb-0">
                                        <div class="custom-control cst-checkbox custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" checked id="rememberdata">
                                            <label class="custom-control-label ml-1" for="rememberdata">Guardar esta tarjeta para futuras compras.</label>
                                        </div>

                                    </div>
                                </form>
                            </div>
                            <div class="reg-bt-choose">
                                <a class="btn btn-comon btn-blue disabled">Pagar</a>

                            </div>

                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>
<!-- Modal for subscription plan  -->
<!-- Modal for subscription plan  -->
<div class="modal fade modal-document-purchase pricing-modal" id="modalPremiumPurchase" tabindex="-1" role="dialog" aria-labelledby="modalPremiumLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg modal-extra-large" role="document">
        <div class="modal-content">
            <button type="button" class="close mdl-cls" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true"><i class="icon-icons-close-close-1"></i></span>
            </button>
            <div class="modal-body">
                <div class="row align-items-center">
                    <div class="col-md-5">
                        <div class="helloIllustraction">
                            <img src="{{asset('front/assets/img/illustraction/subscribepay.png')}}" class="img-fluid" />
                        </div>
                    </div>
                    <div class="col-md-7">
                        <div class="SignContentModal">
                            <h2 class="HeadlineH2-2">Pago de Subscripción</h2>
                            <div class="row subscripe-typ">
                                <div class="col-md-8">

                                    <div class="HeadlineH4-2">
                                        Subscripción Premium
                                    </div>

                                    <div class="custom-control cst-radio cst-radio-sm custom-radio  custom-control-inline"> 
                                        <input type="radio" id="customRadio5" name="customRadio" class="custom-control-input">
                                        <label class="custom-control-label ml-1" for="customRadio5">Mensual </label>
                                    </div>
                                    <div class="custom-control cst-radio cst-radio-sm custom-radio custom-control-inline">
                                        <input type="radio" id="customRadio6" name="customRadio" class="custom-control-input">
                                        <label class="custom-control-label ml-1" for="customRadio6">Anual</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <h4 class="price-info mb-0 color-blue modal-premium">Q {{$price_premium}}</h4>
                                    <div class="more-legal-price">
                                        <div class="more-legal-title text-right" style="display: none;">
                                            Usted ahorra un <span class="font-weight-bold">17.67%</span>
                                        </div>

                                    </div>

                                </div>
                            </div>
                            <div class="separate"></div>
                            <!-- saved-card. Only available if user already save the card info-->
                            <div class="saved-card-info" style="display:none;">
                                <div class="custom-control cst-radio cst-saved-card custom-radio ">
                                    <input type="radio" id="savedcard-2" name="cardsaved" class="custom-control-input">
                                    <label class="custom-control-label ml-1" for="savedcard-2">Usar *** *** **** 1351</label>
                                </div>
                                <div class="custom-control cst-radio cst-saved-card custom-radio ">
                                    <input type="radio" id="newcard-2" name="cardsaved" class="custom-control-input">
                                    <label class="custom-control-label ml-1" for="newcard-2">Usar nueva tarjeta</label>
                                </div>
                            </div>
                            <!-- saved-card end -->
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
                                            <div class="form-group ">
                                                <label class="Ttulo">Fecha de Expiración</label>
                                                <input type="text" id="expdate" class="form-control mb-0" placeholder="Escribir...">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group mb-0">
                                                <label class="Ttulo">CVV</label>
                                                <input type="text" class="form-control mb-0" placeholder="Escribir..." id="cvv">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group d-flex  mb-0">
                                        <div class="custom-control cst-checkbox custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" checked id="rememberdata">
                                            <label class="custom-control-label ml-1" for="rememberdata">Guardar esta tarjeta para futuras compras.</label>
                                        </div>

                                    </div>
                                </form>
                            </div>
                            <div class="reg-bt-choose">
                                <a class="btn btn-comon btn-blue disabled">Pagar</a>
                            </div>

                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>
<div class="modal fade" id="modalStandardPurchaseSignIn" tabindex="-1" role="dialog" aria-labelledby="modalSignInLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
            <button type="button" class="close mdl-cls" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="icon-icons-close-close-1"></i></span>
                    </button>
                <div class="modal-body">
               <div class="row flx-vcenter">
                   <div class="col-md-5">
                       <div class="helloIllustraction">
                           <img src="{{asset('front/assets/img/illustraction/hello.png')}}" class="img-fluid"/>
                       </div>
                   </div>
                   <div class="col-md-7">
                       <div class="SignContentModal">
                       <h2 class="HeadlineH2-2">¡Al parecer no ha iniciado sesión!</h2>
                       <h4 class="HeadlineH4-2 ">Inicie sesión o cree una cuenta para poder adquirir una suscripción y tener acceso a sus distintos beneficios.</h4>
                       <div class="reg-bt-choose">
                       <a href="{{route('login')}}" class="btn btn-comon btn-blue">Iniciar Sesión</a>
                       <a href="{{route('user.create')}}" class="btn btn-comon btn-blue-outline">Registrarse</a>
                       </div>
                    </div>
                   </div>
                   
               </div>
                </div>
              
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalPremiumPurchaseSignIn" tabindex="-1" role="dialog" aria-labelledby="modalSignInLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
            <button type="button" class="close mdl-cls" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="icon-icons-close-close-1"></i></span>
                    </button>
                <div class="modal-body">
               <div class="row flx-vcenter">
                   <div class="col-md-5">
                       <div class="helloIllustraction">
                           <img src="{{asset('front/assets/img/illustraction/hello.png')}}" class="img-fluid"/>
                       </div>
                   </div>
                   <div class="col-md-7">
                       <div class="SignContentModal">
                       <h2 class="HeadlineH2-2">¡Al parecer no ha iniciado sesión!</h2>
                       <h4 class="HeadlineH4-2 ">Inicie sesión o cree una cuenta para poder adquirir una suscripción y tener acceso a sus distintos beneficios.</h4>
                       <div class="reg-bt-choose">
                       <a href="{{route('login')}}" class="btn btn-comon btn-blue">Iniciar Sesión</a>
                       <a href="{{route('user.create')}}" class="btn btn-comon btn-blue-outline">Registrarse</a>
                       </div>
                    </div>
                   </div>
                   
               </div>
                </div>
              
            </div>
        </div>
    </div>
@endsection
@push('js')
<script>
$(document).ready(function() {
    $("input[name=priceplan]").on('change', function () {
        if($(this).is(':checked')) {
            var payment_type = $(this).val();
            console.log(payment_type);
            $.ajax({
                type: 'POST',
                url: 'prices-list',
                data: { "_token": "{{ csrf_token() }}", 'payment_type': payment_type},
               
        }).done(function (data) {
            if(data.payment_type == 'Annual'){
                $('.save-title-inner').show();
                $('#modalStandardPurchase .more-legal-title').show();
                $('#modalPremiumPurchase .more-legal-title').show(); 
            }
            $(".price-standard").html('<span>Q '+data.price_standard+'</span>');
            $(".price-premium").html('<span>Q '+data.price_premium+'</span>');
            $('#modalStandardPurchase .modal-standard').html('<span>Q '+ data.price_standard +'</span>');
            $('#modalPremiumPurchase .modal-premium').html('<span>Q '+ data.price_premium +'</span>');
            
          
    });
    }
    });

    // $(".standardClass").on('click', function () {
    //     if($("input[name=priceplan]").is(':checked')) {
    //         var payment_type = $(this).val();
    //         console.log(payment_type);
    //         $.ajax({
    //             type: 'POST',
    //             url: 'purchase-standard',
    //             data: { "_token": "{{ csrf_token() }}", 'payment_type': payment_type},
               
    //         }).done(function (data) {
    //             if(data.payment_type == 'Annual'){
    //                 $('.save-title-inner').show();
    //                 $('#modalStandardPurchase .more-legal-title').show();
    //                 $('#modalPremiumPurchase .more-legal-title').show(); 
    //             }
    //             $(".price-standard").html('<span>Q '+data.price_standard+'</span>');
    //             $(".price-premium").html('<span>Q '+data.price_premium+'</span>');
    //             $('#modalStandardPurchase .modal-standard').html('<span>Q '+ data.price_standard +'</span>');
    //             $('#modalPremiumPurchase .modal-premium').html('<span>Q '+ data.price_premium +'</span>');
                
            
            
    //         });
    //     }

    // });
});

$(document).ready(function() {
    $("input[name=price]").on('change', function () {
        if($(this).is(':checked')) {
            var payment_type = $(this).val();
            console.log(payment_type);
            $.ajax({
                type: 'POST',
                url: 'price-index-list',
                data: { "_token": "{{ csrf_token() }}", 'payment_type': payment_type},
               
        }).done(function (data) {
            if(data.payment_type == 'Annual'){
                $('.save-title-inner').show();
                $('#modalStandardPurchase .more-legal-title').show();
                $('#modalPremiumPurchase .more-legal-title').show(); 
            }
            $(".price-standard").html('<span>Q '+data.price_standard+'</span>');
            $(".price-premium").html('<span>Q '+data.price_premium+'</span>');
            $('#modalStandardPurchaseSignIn .modal-standard').html('<span>Q '+ data.price_standard +'</span>');
            $('#modalPremiumPurchaseSignIn .modal-premium').html('<span>Q '+ data.price_premium +'</span>');
          
    });
    }
    });
});

$("#mensual").on('change', function (e) {
    e.preventDefault();
       $('.annualStandard').addClass('d-none');
       $('.annualPremium').addClass('d-none');
       $('.monthlyStandard').removeClass('d-none');
       $('.monthlyPremium').removeClass('d-none');
       
});

$("#anual").on('change', function (e) {
    e.preventDefault();
       $('.annualStandard').removeClass('d-none');
       $('.annualPremium').removeClass('d-none');
       $('.monthlyStandard').addClass('d-none');
       $('.monthlyPremium').addClass('d-none');
       
});

</script>
@endpush

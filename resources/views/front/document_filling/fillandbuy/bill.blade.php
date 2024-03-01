@extends('front.layouts.master')
@section('pageTitle',__('test.Bill|Form'))
@section('content')
    <main class="subscription-page bill-page">
        <section class="form-filling-wrap">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="illustra-img">
                            <img src="assets/img/documentlist/con_3.png" />
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <div class="subscribe-form-wrap">
                            <div class="form-section-start">
                                <div class="form-head d-flx justify-content-between align-items-center">
                                    <div class="bill_form_header w-100">
                                        <h2 class="HeadlineH2-2  w-100">Factura</h2>
                                        <div class="row subscripe-typ">
                                            <div class="col-md-12">
                                                <div class="HeadlineH4-2">
                                                    Datos para factura
                                                </div>
                                                <div class="bill_radio_wrap">
                                                    <div
                                                        class="custom-control cst-radio cst-radio-sm custom-radio mb-2 custom-control-inline">
                                                        <input type="radio" id="customRadio3" name="billinfo"
                                                            class="custom-control-input">
                                                        <label class="custom-control-label ml-1" for="customRadio3">NIT
                                                        </label>
                                                    </div>
                                                    <div
                                                        class="custom-control cst-radio cst-radio-sm custom-radio mb-2 custom-control-inline">
                                                        <input type="radio" id="customRadio4" name="billinfo"
                                                            class="custom-control-input">
                                                        <label class="custom-control-label ml-1"
                                                            for="customRadio4">C/F</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-desc w-100 ">
                                        <form class="">
                                            <!--add "opacity_4" to form if C/F select also add disabled attribute to the input -->
                                            <div class="form-group">
                                                <label class="Ttulo">NIT</label>
                                                <input type="text" class="form-control" placeholder="Escribir...">
                                            </div>
                                            <div class="form-group">
                                                <label class="Ttulo">Razón Social</label>
                                                <input type="text" class="form-control" placeholder="Escribir...">
                                            </div>
                                            <div class="form-group">
                                                <label class="Ttulo">Dirección</label>
                                                <input type="text" class="form-control" placeholder="Escribir...">
                                            </div>


                                        </form>
                                        <div class="form-reg-bt">
                                            <a href="#" class="btn btn-comon btn-blue disabled">Siguiente</a>
                                            <!--Remove disable class from button if form filled-->

                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <!-- Modal for document purchase payment  -->
            <div class="modal fade modal-document-purchase" id="modalDocumentPurchase" tabindex="-1" role="dialog"
                aria-labelledby="modalDocumentPurchaseLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg modal-extra-large" role="document">
                    <div class="modal-content">
                        <button type="button" class="close mdl-cls" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true"><i class="icon-icons-close-close-1"></i></span>
                        </button>
                        <div class="modal-body">
                            <div class="row align-items-center">
                                <div class="col-md-5">
                                    <div class="helloIllustraction">
                                        <img src="assets/img/illustraction/DocumentPurchase.png" class="img-fluid" />
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
                                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod
                                                    tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                                                    quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                                                    consequat.
                                                </p>
                                            </div>
                                            <div class="col-md-4">
                                                <h4 class="price-info mb-0 color-blue">Q XXX.XX</h4>
                                                <!-- more leagal price -->
                                                <!-- <div class="more-legal-price">
                                                    <div class="more-legal-title">
                                                    más legalización
                                                    </div>
                                                    <div class="more-legal-price-detail">
                                                    Q 297.00
                                                    </div>
                                                </div> -->
                                            </div>
                                        </div>
                                        <div class="separate"></div>
                                        <div class="modal-doument-form">
                                            <form>
                                                <div class="form-group">
                                                    <label class="Ttulo">Nombre</label>
                                                    <input type="text" class="form-control" placeholder="Escribir...">
                                                </div>
                                                <div class="form-group">
                                                    <label class="Ttulo">Número de tarjeta</label>
                                                    <input type="text" class="form-control" placeholder="Escribir..."
                                                        id="cardnumber">
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group ">
                                                            <label class="Ttulo">Fecha de Expiración</label>
                                                            <input type="text" id="expdate" class="form-control mb-0"
                                                                placeholder="Escribir...">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group mb-0">
                                                            <label class="Ttulo">CVV</label>
                                                            <input type="text" class="form-control mb-0"
                                                                placeholder="Escribir..." id="cvv">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group d-flex  mb-0">
                                                    <div class="custom-control cst-checkbox custom-checkbox">
                                                        <input type="checkbox" class="custom-control-input" checked
                                                            id="rememberdata">
                                                        <label class="custom-control-label ml-1" for="rememberdata">Guardar esta
                                                            tarjeta para futuras compras.</label>
                                                    </div>

                                                </div>
                                            </form>
                                        </div>
                                        <div class="reg-bt-choose">
                                            <a class="btn btn-comon btn-blue">Pagar</a>

                                        </div>

                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <!-- Modal for document purchase payment -->
        </section>
    </main>
@endsection
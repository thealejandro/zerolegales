@extends('front.layouts.master')
@section('pageTitle',__('test.Bill|Form'))
@section('content')
<!-- <meta name="csrf-token" content="{{ csrf_token() }}"> -->
    <main class="subscription-page bill-page">
        <section class="form-filling-wrap">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="illustra-img">
                            <img src="{{asset('front/assets/img/documentlist/con_3.png')}}" />
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
                                                        <input type="radio" id="customRadio3" name="billinfo" value="nit"
                                                            class="custom-control-input">
                                                        <label class="custom-control-label ml-1" for="customRadio3">NIT
                                                        </label>
                                                    </div>
                                                    <div
                                                        class="custom-control cst-radio cst-radio-sm custom-radio mb-2 custom-control-inline">
                                                        <input type="radio" id="customRadio4" name="billinfo" value="cf"
                                                            class="custom-control-input">
                                                        <label class="custom-control-label ml-1"
                                                            for="customRadio4">C/F</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-desc w-100 ">
                                        <form method="POST" class="submitInvoiceData" id="submitInvoiceData" enctype="multipart/form-data"> 
                                        {{csrf_field()}}
                                            <!--add "opacity_4" to form if C/F select also add disabled attribute to the input -->
                                            <div class="form-group">
                                                <label class="Ttulo">NIT</label>
                                                <input type="text" class="form-control" name="nit_data" id="nit_data" placeholder="Escribir...">
                                                <div class="val-error error_nit"></div>
                                            </div>
                                            <div class="form-group">
                                                <label class="Ttulo">Razón Social</label>
                                                <input type="text" class="form-control" name="customer_name" id="customer_name" placeholder="Escribir...">
                                                <div class="val-error error_name"></div>
                                            </div>
                                            <div class="form-group">
                                                <label class="Ttulo">Dirección</label>
                                                <input type="text" class="form-control" name="customer_address" id="customer_address" placeholder="Escribir...">
                                                <div class="val-error error_address"></div>
                                            </div>
                                            <input type="hidden" name="txn_uuid" id="txn_uuid" value="{{$data['req_transaction_uuid']}}">
                                            <input type="hidden" name="txn_id" id="txn_id" value="{{$data['transaction_id']}}">
                                            
                                            <a href="#" class="btn btn-comon btn-blue btn-block keepCredit d-none">Ir a lista de documentos</a>

                                        
                                        
                                        
                                        
                                        </form>

                                        <div class="form-reg-bt">
                                            <a href="#" class="btn btn-comon btn-blue saveInvoiceData disabled">Siguiente</a>
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
            
            <!-- Modal for document purchase payment -->
        </section>
        <a href="" data-toggle="modal" data-target="#modalDocumentPurchase"></a>
    </main>

    <div class="modal modal-invoice-data fade" id="modalInvoiceData" tabindex="-1" role="dialog"
                aria-labelledby="modalDocumentPurchaseLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                    <div class="modal-content col-lg-12">
                        <!-- <button type="button" class="close mdl-cls" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true"><i class="icon-icons-close-close-1"></i></span>
                        </button> -->
                        <div class="modal-body">
                            <div class="row align-items-center">
                                <div class="col-md-5">
                                    <div class="helloIllustraction">
                                    <img src="{{asset('front/assets/img/illustraction/paymentsucces.png')}}" class="img-fluid lazyload" />
                                    </div>
                                </div> 
                                <div class="col-md-7">
                                    <div class="SignContentModal">
                                        <h2 class="HeadlineH2-2">¡Listo!</h2>
                                        <div class="row">
                                            <div class="col-md-12">
                                                
                                            <h4 class="HeadlineH4-2 ">
                                                    Sus datos para la factura han sido<br>
                                                    recaudados exitosamente. Ya puede<br> 
                                                    continuar.
                                                </h4>
                                            </div>
                                            
                                        </div>
                                        
                                        <div class="reg-bt-choose payment-success-bt">
                                            <!-- <a href="{{route('user.cybersource.payment.response')}}" class="btn btn-comon btn-blue">Continuar</a> -->
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
@endsection
@push('js')
<script src="{{ asset('front/assets/custom/js/data_invoice.js')}}"></script>


@endpush
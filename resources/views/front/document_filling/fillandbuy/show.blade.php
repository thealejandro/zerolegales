@extends('front.layouts.master')
@section('pageTitle',__('test.Document No Subscription | Preview'))
@section('content')
<style>
    @font-face {
        font-family: Roboto-Regular;
        src: url('../../../../front/assets/font/Roboto/Roboto-Regular.ttf');
    }
    /* .cert-preview{
        
        background: #fff;  

    }
    .cert-preview p {
            
            font-size: 14px;
            font-weight: normal;
            line-height: normal;
            letter-spacing: normal;
            color: #323232;
            font-family: 'Roboto', sans-serif;
            
    }       */
    .cert-preview p,li{
            
            font-size: 15px;
            color: #323232;
            font-family: 'Roboto', sans-serif;
            
    }
    .cert-body p{
            
            font-size: 15px;
            color: #323232;
            font-family: 'Roboto', sans-serif;
            
    }
    ul li { 
    list-style-type: none; 
    }

    ul li::before {
    content: '• '; 
    }
    .zoom.mCS_img_loaded {
        margin: inherit;
    }    
    .magnify > .magnify-lens {
  /* width: 300px!important;
  height: 300px!important;
  border-radius: inherit!important;
  box-shadow: inherit!important; */
}               
</style>
<link rel="stylesheet" href="{{asset('front/assets/css/magnify.css')}}"/>
<main class="subscription-preview-page no-subscribe-preview">
        <section class="subscription-preview-wrap">
            <div class="container">
                <div class="row">
                    <div class="col-md-7">
                        <!-- mobile only -->
                        <div class="cert-prev-right-content mobile-content-only">
                            <div class="mobile-head-view">
                                <div class="HeadlineH2-2">Vista Previa</div>
                                <div class="cert-body-content">
                                    En vista previa puede visualizar su documento detalladamente y decidir editar algún campo si es necesario. También tiene la opción de legalizar su documento con uno de nuestros abogados a un costo adicional.
                                </div>
                            </div>
                        </div>
                        <!-- mobile only -->
                        <div class="shadow-bottom"></div>
                        <div class="cert-wrap-inner  " id="cert-wrap-inner" >
                            <div class="cert-preview" id="preview-content" style="border:inherit">
                               
                                    <div class="small cert-content">
                                      
                                        
                                            <div class="cert-body">
                                            {!! $template->text_body !!}   
                                            
                                            </div>                             
                                        
                                    </div>
                                
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5">      
                    
                        <div class="cert-prev-right-content">
                            <div class="desktop-only">
                                <div class="HeadlineH2-2">Vista Previa</div>
                                <div class="cert-body-content">
                                    En vista previa puede visualizar su documento detalladamente y decidir editar algún campo si es necesario. También tiene la opción de legalizar su documento con uno de nuestros abogados a un costo adicional.
                                </div>
                            </div>
                            <div class="edit-cert">
                                <div class="edit-cert-content HeadlineH4-2">
                                    ¿Ve cosas que quiere cambiar?
                                </div>
                                <div class="cert-bt-edit">
                                    @if($document_filling['download_status'] == '1')
                                        <a href="{{route('user.nosubscription.fill.buy.edit',[$document_id,$id])}}" class="btn btn-comon btn-blue-outline disabled">Editar</a>

                                    @else

                                        <a href="{{route('user.nosubscription.fill.buy.edit',[$document_id,$id])}}" class="btn btn-comon btn-blue-outline">Editar</a>

                                    @endif 
                                </div>
                            </div>
                            <div class="separate"></div>
                            <div class="cert-process-card" id="before_purchase">
                                    <div class="cert-process-title HeadlineH4-2">
                                        ¿Desea continuar con el proceso?
                                    </div>                                 
                                    <div class="card-process-cert">
                                        @if($template->document_authentication == 'yes')
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="row align-items-center">
                                                    <div class="col-md-6 ">
                                                        <div class="add-legal-cert HeadlineH4-2">
                                                            Agregar legalización a este documento
                                                        </div>

                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="option-enable-cert">
                                                            <div class="d-flex justify-content-around option-inner-val">
                                                                <div class="q-value">
                                                                    Q 297.00
                                                                </div>
                                                                <div class="custom-control custom-switch">
                                                                    <input type="checkbox" class="custom-control-input" id="checklegalizatin" checked>
                                                                    <label class="custom-control-label" for="checklegalizatin"></label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="BodyBody-2 proces-con">
                                                    Seleccione uno de nuestros abogados certificados para enviar su documento. Asegurese de selecionar un abogado cuya ubicación le quede conveniente para coordinar la firma física de su documento.
                                                </div>
                                                <div class="content-show">                                               
                                                        <div class="form-group">
                                                            <div class="dropdown custom_dropdown_menu custom-dropdown-normal" id="chooselegaloc">
                                                                <a class="btn btn-secondary dropdown-toggle " href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                    <p class="mb-0 dropdown-select-2">Seleccionar departamento</p>
                                                                    <i class="icon-icons-arrow-chevron-down"></i>
                                                                </a>
                                                                <div class="dropdown-menu mCustomScrollbar dropdcst" id="dropdcst-2" aria-labelledby="dropdownMenuLink">
                                                                    @foreach($departments as $department)
                                                                        <a class="dropdown-item d-flex justify-content-between " href="javascript:">                                                                           
                                                                            <h6 data-id="{{ $department->id}}">{{ $department->department}}</h6>
                                                                            <span class="check-marked-normal icon-icons-checkmark-checkmark-1"></span>
                                                                        </a>
                                                                    @endforeach                                                                                                                                                                              
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="dropdown custom_dropdown_menu" id="chooselegaladvs">                                                                                                         
                                                            </div>
                                                        </div>
                                                
                                                    <div class="cert-prev-inst">
                                                        (Se adjuntarán los documentos legales necesarios que ya haya subido a su perfil, en la sección de información personal. Esta función solo esta disponible para usuarios con <span>Suscripción Premium</span>).
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endif
                                        @if($template->document_authentication == 'no')
                                            <div class="card">
                                                <div class="card-body">
                                                    <div class="row align-items-center">
                                                        <div class="col-md-6 ">
                                                            <div class="add-legal-cert HeadlineH4-2">
                                                                Agregar legalización a este documento
                                                            </div>

                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="option-enable-cert">
                                                                <div class="d-flex justify-content-around option-inner-val">
                                                                    <div class="q-value">
                                                                        Q 297.00
                                                                    </div>
                                                                    <div class="custom-control custom-switch">
                                                                        <input type="checkbox" class="custom-control-input" id="checklegalizatin" disabled>
                                                                        <label class="custom-control-label" for="checklegalizatin"></label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="BodyBody-2 proces-con">
                                                        Seleccione uno de nuestros abogados certificados para enviar su documento. Asegurese de selecionar un abogado cuya ubicación le quede conveniente para coordinar la firma física de su documento.
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    </div> 
                                   
                                    <input type="hidden" name="legalization_id" id="legalization_id">         
                                    <input type="hidden" name="directory_id" id="directory_id">         
                                    <input type="hidden" name="document_id" id="document_id" value="{{$document_id}}">
                                    <input type="hidden" name="user_id" id="user_id" value="{{\Auth::user()->id}}">
                                    <input type="hidden" name="document_template_id" id="document_template_id" value="{{$id}}">
                                    <input type="hidden" name="legalization_price" id="legalization_price" class="priceValue" value="297.00">
                                    @if($purchases)
                                    <input type="hidden" name="document_price" id="document_price" value="">
                                    @endif
                                    @if($purchases == null)       
                                    <input type="hidden" name="document_price" id="document_price" class="priceValue" value="{{$price['price']}}">
                               
                                    @endif                                    
                                    <input type="hidden" name="total_price" id="total_price">
                                    @if($template->document_authentication == 'no')
                                        <div class="val-error-wrap">
                                        &nbsp;&nbsp;<span class="val-error"><i class="icon-icons-alert-circle1 icon-error"></i>&nbsp;&nbsp;Este documento no tiene la legalización disponible.</span>
                                        </div>
                                    @endif
                                    <div class="doc-authentication">
                                        @if($purchases)
                                            <div class="qnumber">Q XXX.XX</div>
                                        @endif
                                        @if($purchases == null)  
                                            <div class="qnumber">Q {{$total_price}}</div>
                                        @endif
                                        <div class="doc-authentication-title">Documento con autenticación</div>
                                    </div>
                                    <div class="form-preview-sub">
                                        <!-- add class 'disabled' for buttton disabling -->
                                        @if($purchases)
                                        <a href="{{route('user.buy.fill.legalisation.invoice',[$template->id,$id])}}" class="btn btn-comon btn-blue legalization disabled">Comprar</a>
                                        <a href="{{route('user.document.purchase.after',[$document_id,$id])}}" class="btn btn-comon btn-blue comprar" style="display:none;">Comprar</a>
                                        @endif
                                        @if($purchases == null)   
                                        <a href="{{route('user.fill.buy.purchase.invoice',[$template->id,$id])}}" class="btn btn-comon btn-blue legalization disabled">Comprar</a>
                                        <a href="{{route('user.fill.buy.document.purchase.invoice',[$template->id,$id])}}" class="btn btn-comon btn-blue comprar" style="display:none;">Comprar</a>
                                        @endif
                                    </div>
                                  
                                  
                            </div> 
                        </div>
                        
                    </div>
                </div>

            </div>
        </section>


    </main>
@endsection
@push('js')
<script>
    var legalisation = "{{route('user.legalisation')}}";
    var legaldocument_change = "{{ route('user.legaldocument.change') }}";
    var labels = "{{route('user.labels')}}";
</script>
<script src="{{asset('front/assets/js/vendors/jquery.magnify.js')}}" ></script>
<script src="{{asset('front/assets/js/vendors/jquery.magnify-mobile.js')}}"></script>
<script src="{{ asset('front/assets/custom/js/legalization.js')}}"></script>


@endpush
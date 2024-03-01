@extends('front.layouts.master')
@section('pageTitle',__('test.Document Info Empty'))
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
            
    }   */
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
    <main class="subscription-preview-page no-subscribe-preview document-info-empty-page">
        <section class="subscription-preview-wrap">
            <div class="container">
                <div class="row">
                    <div class="col-md-7">
                        <!-- mobile only -->
                        <div class="cert-prev-right-content mobile-content-only">
                            <div class="mobile-head-view">
                                <div class="HeadlineH2-2">{{$folder->document_name}}</div>
                                <div class="cert-body-content">
                                {{$folder->document_description}}
                                </div>
                            </div>
                        </div>
                        <!-- mobile only -->
                        <div class="shadow-bottom"></div>
                        <div class="cert-wrap-inner " id="cert-wrap-inner">
                            <div class="cert-preview" id="preview-content" style="border:inherit">                
                                    
                                    
                                    <div class="small cert-content" >
                                        
                                            <div class="cert-body">
                                            {!! $folder->text_body !!}   
                                            </div>                             
                                        
                                    </div>
                                
                                <input type="hidden" name="document_id" id="document_id" value="{{$document_id}}">
                                <input type="hidden" name="document_template_id" id="document_template_id" value={{$id}}>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="cert-prev-right-content">
                            <div class="desktop-only">
                            <div class="HeadlineH2-2">{{$folder->document_name}}</div>
                                <div class="cert-body-content">
                                {{$folder->document_description}}
                                </div>
                            </div>
                            <div class="edit-cert">
                                <div class="cert-bt-edit">
                                        <div id="cert-preview-content" style="display:none;">                
                                        
                                        
                                        <div class="small cert-content" >
                                            
                                                <div class="cert-body">
                                                {!! $folder->text_body !!}   
                                                </div>                             
                                            
                                        </div>
                                    
                                    <input type="hidden" name="document_id" id="document_id" value="{{$document_id}}">
                                    <input type="hidden" name="document_template_id" id="document_template_id" value={{$id}}>
                                    </div>
                                    <a onclick="getDownloadPDF()" class="btn btn-comon btn-blue">Descargar</a>
                                </div>
                            </div>
                            @if($document->legalization_id == null)
                            <div class="separate"></div>
                           
                            <div class="cert-process-card">
                                <div class="cert-process-title HeadlineH4-2">
                                Legalización:
                                </div>
                                <div class="card-process-cert">
                                    @if($folder->document_authentication == 'yes')
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="row align-items-center">
                                                <div class="col-lg-6 col-sm-12 ">
                                                    <div class="add-legal-cert HeadlineH4-2">
                                                        Agregar legalización a este documento
                                                    </div>

                                                </div>
                                                <div class="col-lg-6 col-sm-12">
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
                                    @if($folder->document_authentication == 'no')
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
                                    <input type="hidden" name="document_template_id" id="document_template_id" value="{{$id}}">
                                    <input type="hidden" name="user_id" id="user_id" value="{{\Auth::user()->id}}">
                                    <input type="hidden" name="document_price" id="document_price" value="">
                                    <input type="hidden" name="legalization_price" id="legalization_price" class="priceValue" value="297.00">
                                    <input type="hidden" name="total_price" id="total_price">
                                    @if($folder->document_authentication == 'no')
                                        <div class="val-error-wrap">
                                        &nbsp;&nbsp;<span class="val-error"><i class="icon-icons-alert-circle1 icon-error"></i>&nbsp;&nbsp;Este documento no tiene la legalización disponible.</span>
                                        </div>
                                    @endif
                                    
                                    @if(Auth::user()->user_type != 2)
                                        <div class="doc-authentication">
                                            <div class="qnumber">Q XX.XX</div>
                                            <div class="doc-authentication-title">Documento con autenticación</div>
                                        </div>
                                    @endif
                                    <div class="form-preview-sub">
                                            <!-- add class 'disabled' for buttton disabling -->
                                            <a id="legalisation" href="{{route('user.myfolder.legalisation.invoice',[$document_id,$id])}}" class="btn btn-comon btn-blue legalization disabled">Comprar Legalización</a>
                                            <!-- <a href="#" class="btn btn-comon btn-blue">Comprar Legalización</a> -->
                                    </div>
                                    
                            </div>
                            @endif
                        </div>
                    </div>
                </div>

            </div>
        </section>
    </main>
@endsection
@push('js')
<script>
    var labels = "{{route('user.labels')}}";
    var myfolder_legalisation = "{{route('user.myfolder.legalisation')}}";
    var legaldocument_change = "{{ route('user.legaldocument.change')}}";
</script>
<script src="{{asset('front/assets/js/vendors/jquery.magnify.js')}}" ></script>
<script src="{{asset('front/assets/js/vendors/jquery.magnify-mobile.js')}}"></script>
<script src="{{ asset('front/assets/custom/js/document_info.js')}}"></script>
@endpush
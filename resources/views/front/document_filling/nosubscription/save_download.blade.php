@extends('front.layouts.master')
@section('pageTitle',__('test.Document No Subscription | Save and Download'))
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
            
    }      */
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

    <main class="subscription-preview-page save-download-page no-subscription-save">

        <section class="subscription-preview-wrap">
            <div class="container">
                <div class="row">
                    <div class="col-md-7">
                        <!-- mobile only -->
                        <div class="cert-prev-right-content mobile-content-only">
                            <div class="mobile-head-view">
                                <div class="HeadlineH2-2">Pagaré</div>
                                <div class="cert-body-content">
                                    Su documento ya está listo para descargar. Por favor acepte los terminos y condiciones para poder descargarlo.
                                </div>
                            </div>
                        </div>
                        <!-- mobile only -->
                        <div class="shadow-bottom"></div>
                        <div class="cert-wrap-inner " id="cert-wrap-inner">           
                            <div class="cert-preview" id="preview-content" style="border:inherit">                
                                
                                
                                    <div class="small cert-content" >
                                        
                                            <div class="cert-body">
                                            {!! $template->text_body !!}   
                                            </div>                             
                                        
                                    </div>
                                
                                <input type="hidden" name="document_id" id="document_id" value="{{$document_id}}">
                                <input type="hidden" name="document_template_id" id="document_template_id" value={{$id}}>
                            </div>
                        </div>
                    </div>
                    @if(Auth::user()->user_type != 2)
                    <div class="col-md-5">
                        <div class="cert-prev-right-content">
                            <div class="desktop-only">
                                <div class="HeadlineH2-2">Pagaré</div>
                                <div class="cert-body-content">
                                    Su documento ya está listo para descargar. Por favor acepte los terminos y condiciones para poder descargarlo.
                                </div>
                            </div>



                            <div class="cert-process-card">
                                <div class="subscribe-plan card-with-image-small">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-lg-6 col-sm-12 order-sm-12">
                                                    <h5 class="mt-0 mb-1 text-truncate HeadlineH4-2 mb-0">Sabía usted que...</h5>
                                                    <div class="BodyBody-2">
                                                        al adquirir una suscripción, puede tener acceso a guardar sus documentos por más de 30 días.
                                                    </div>
                                                    <div class="subscribe-link">
                                                        <a href="{{route('user.price')}}" class="btn btn-comon btn-blue ">Ver Subscripciones</a></span>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-sm-12 order-sm-1">
                                                    <div class="card-img-small">
                                                        <img class="ml-3 lazyload" src="{{asset('front/assets/img/illustraction/hello.png')}}" alt="subscription plan">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="pay-form">
                                    <div class="form-group d-flex agree-top  mb-0">
                                        <div class="custom-control cst-checkbox custom-checkbox mb-0">
                                            <input type="checkbox" class="custom-control-input" id="rememberdata">
                                            <label class="custom-control-label ml-1" for="rememberdata">Aceptar </label><a data-toggle="modal" data-target="#termsandcondition" class="terms_under_cond"> terminos y condiciones</a>
                                        </div>

                                    </div>
                                </div>
                                <div class="form-preview-sub">
                                    <!-- add class 'disabled' for buttton disabling -->
                                    <div class="once-download-msg">Solo se permite descargar una vez.</div>
                                    <!-- add disable attr to button empty form -->
                                    <!-- <a href="#" class="btn btn-comon btn-blue disabled">Descargar</a> -->
                                    <!-- add disable attr empty form -->
                                    <!-- <a href="{{route('user.document.download',[$document_id,$id])}}"  data-document="{{$document_id}}"  data-id="{{$id}}" id="download" onclick="downloadDocument(this.getAttribute('data-document'),this.getAttribute('data-id'))" class="btn btn-comon btn-blue disabled">Descargar</a> -->
                                    <div id="cert-preview-content" style="display:none;">                
                                
                                
                                                <div class="small cert-content" >
                                                    
                                                        <div class="cert-body">
                                                        {!! $template->text_body !!}   
                                                        </div>                             
                                                    
                                                </div>
                                            
                                            <input type="hidden" name="document_id" id="document_id" value="{{$document_id}}">
                                            <input type="hidden" name="document_template_id" id="document_template_id" value={{$id}}>
                                        </div>
                                    <a onclick="getDownloadPDF()" id="download" class="btn btn-comon btn-blue disabled" 
                                    data-document-id="{{$document_id}}" data-document-template-id="{{$id}}">Descargar</a>

                                    <span><i class="icon-icons-checkmark-circle download-icon pdf-success d-none"></i></span>
                                    <!-- uncomment save and download finished -->
                                    <div class="redir-document">
                                        <a href="{{route('user.document')}}" class="btn btn-comon btn-blue  redirect-button pdf-success-redirect d-none">Regresar a Lista de Documentos</a>
                                    </div>
                                    <!-- uncomment save and download finished -->

                                </div>
                            </div>
                        </div>
                    </div>
                    @else
                    <div class="col-md-5">
                        <div class="cert-prev-right-content">
                            <div class="desktop-only">
                                <div class="HeadlineH2-2">Pagaré</div>
                                <div class="cert-body-content">
                                    Su documento ya está listo para descargar. Por favor acepte los terminos y condiciones para poder descargarlo. También recuerde que puede guardar su documento para que le aparezca en My Folder.
                                </div>
                            </div>
                            <div class="cert-process-card">
                                <div class="custom-control custom-switch custom-switch-normal">
                                    <input type="checkbox" class="custom-control-input" id="savedoc" checked>
                                    <label class="custom-control-label" for="savedoc">Guardar documento</label>
                                </div>
                                {{ Form::open(['route' => 'user.myfolder.store', 'class' => 'kt-form', 'id'=>'myfolder_form','role' => 'form', 
                                        'method' => 'post']) }}
                                    <div class="pay-form">
                                        <div class="form-inner-required">
                                            <div class="form-group">
                                                <label class="Ttulo">Nombre del Documento</label>
                                                <input type="text" name="document_name" id="document_name" class="form-control field_class" placeholder="Escribir..." autocomplete="off">
                                                @if($errors->has('document_name'))
                                                    <label class="val-error">
                                                       {{ $errors->first('document_name') }}
                                                    </label>
                                                @endif
                                            </div>
                                            <div class="form-group">
                                                <label class="Ttulo">Descripción del Documento (150 caracteres)</label>
                                                <textarea class="form-control field_class" id="document_description" name="document_description" placeholder="Escribir…" maxlength="150"></textarea>
                                                @if($errors->has('document_description'))
                                                    <label class="val-error">
                                                        {{ $errors->first('document_description') }}
                                                    </label>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group d-flex agree-top  mb-0">
                                            <div class="custom-control cst-checkbox custom-checkbox mb-0">
                                                <input type="checkbox" class="custom-control-input" id="rememberdata">
                                                <label class="custom-control-label ml-1" for="rememberdata">Aceptar </label><a data-toggle="modal" data-target="#termsandcondition" class="terms_under_cond"> terminos y condiciones</a>
                                            </div>

                                        </div>  
                                        <input type="hidden" name="document_id" id="document_id" value="{{$document_id}}">
                                        <input type="hidden" name="id" id="id" value={{$id}}>    
                                    </div>
                                    <div class="form-preview-sub">
                                        <button id="savedownload" type="button" class="btn btn-comon btn-blue disabled">Guardar y Descargar</button>
                                        <div id="cert-preview-content" style="display:none;">                
                                
                                
                                                <div class="small cert-content" >
                                                    
                                                        <div class="cert-body">
                                                        {!! $template->text_body !!}   
                                                        </div>                             
                                                    
                                                </div>
                                            
                                            <input type="hidden" name="document_id" id="document_id" value="{{$document_id}}">
                                            <input type="hidden" name="document_template_id" id="document_template_id" value={{$id}}>
                                        </div>
                                        <a onclick="getDownloadPDF()" id="download" class="btn btn-comon btn-blue disabled d-none">Descargar</a>
                                        <span><i class="icon-icons-checkmark-circle download-icon pdf-success d-none"></i></span>
                                        <div class="redir-document">
                                            <a href="{{route('user.document')}}" class="btn btn-comon btn-blue  redirect-button pdf-success-redirect d-none">Regresar a Lista de Documentos</a>
                                        </div>
                                    </div>
                                {{ Form::close() }}
                            </div>
                        </div>
                    </div>
                    @endif
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
@endsection
@push('js')
<script>
 var labels = "{{route('user.labels')}}";
 var download_status = "{{route('user.download.status.update')}}";
</script>
 
<script src="{{asset('front/assets/js/vendors/jquery.magnify.js')}}" ></script>
<script src="{{asset('front/assets/js/vendors/jquery.magnify-mobile.js')}}"></script>
<script src="{{ asset('front/assets/custom/js/savedownload.js')}}"></script>
@endpush
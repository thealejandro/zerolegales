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
            
    }          */
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
<link rel="stylesheet" href="{{asset('front/assets/css/magnify.css')}}"/><main class="subscription-preview-page no-subs-previ-bought">
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
                            <a href="{{route('user.after.purchase.edit',[$document_id,$id])}}" class="btn btn-comon btn-blue-outline disabled">Editar</a>

                         @else

                            <a  href="{{route('user.after.purchase.edit',[$document_id,$id])}}" class="btn btn-comon btn-blue-outline">Editar</a>

                         @endif   
                        </div>
                    </div>
                    <div class="separate"></div>

                    <div class="cert-process-card">
                        <div class="cert-process-title HeadlineH4-2">
                            ¿Desea continuar con el proceso?
                        </div>
                        @if(\Auth::user()->user_type != 2)         
                            <div class="form-preview-sub">
                                <!-- add class 'disabled' for buttton disabling -->
                                <a href="{{route('user.document.filling.process',[$document_id,$id])}}" class="btn btn-comon btn-blue">Confirmar y Continuar</a>
                                
                            </div>
                            <!-- <div class="inst-edit-msg">
                                Tiene 30 días para editar y guardar su documento. 
                            </div> -->
                        @endif
                        @if(\Auth::user()->user_type == 2)         
                            <div class="form-preview-sub">
                                <!-- add class 'disabled' for buttton disabling -->
                                <a href="{{route('user.document.filling.process',[$document_id,$id])}}" class="btn btn-comon btn-blue">Continuar</a>                             
                            </div>                   
                        @endif
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
     var labels = "{{route('user.labels')}}";
</script>
<script src="{{asset('front/assets/js/vendors/jquery.magnify.js')}}" ></script>
<script src="{{asset('front/assets/js/vendors/jquery.magnify-mobile.js')}}"></script>
<script src="{{ asset('front/assets/custom/js/afterpurchase.js')}}"></script>
@endpush
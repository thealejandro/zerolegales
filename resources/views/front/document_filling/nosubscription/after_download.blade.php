@extends('front.layouts.master')
@section('pageTitle',__('test.Document No Subscription | Save and Download'))
@section('content')
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
                        <div class="cert-wrap-inner mCustomScrollbar" id="cert-wrap-inner">
                        <div class="cert-preview">
                            <div class="zoom-view">
                                <button class="btn btn-blue btn-circle">
                                <i class="icon-icons-maximize"></i>
                                </button>
                            </div>

                            <div class="cert-content">
                            {!! $template->text_body !!}      
                            </div>
                            <input type="hidden" name="document_id" id="document_id" value="{{$document_id}}">
                            <input type="hidden" name="document_template_id" id="document_template_id" value={{$id}}>


                        </div>
                        </div>
                    </div>
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
                                                        <a href="#" class="btn btn-comon btn-blue ">Ver Subscripciones</a></span>
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
                                            <input type="checkbox" class="custom-control-input" id="rememberdata" checked>
                                            <label class="custom-control-label ml-1" for="rememberdata">Aceptar terminos y condiciones</label>
                                        </div>

                                    </div>
                                </div>

                                <div class="form-preview-sub">
                                    <!-- add class 'disabled' for buttton disabling -->
                                    <div class="once-download-msg">Solo se permite descargar una vez.</div>
                                    <!-- add disable attr to button empty form -->
                                    <!-- <a href="#" class="btn btn-comon btn-blue disabled">Descargar</a> -->
                                    <!-- add disable attr empty form -->
                                    <a href="{{route('user.document.download',[$document_id,$id])}}" id="download" class="btn btn-comon btn-blue disabled">Descargar</a>
                                    <span><i class="icon-icons-checkmark-circle download-icon"></i></span>
                                    <!-- uncomment save and download finished -->
                                    <div class="redir-document">
                                        <a href="{{route('user.document')}}" class="btn btn-comon btn-blue redirect-button">Regresar a Lista de Documentos</a>
                                    </div>
                                    <!-- uncomment save and download finished -->

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
    $(document).ready(function(){
        $("#rememberdata").change(function() {
            if(this.checked) {
                $('#download').removeClass('disabled');
                $('.download-icon').css("display", "none");
                $('.redirect-button').css("display", "none");
            }
            else{

                $('#download').addClass('disabled');
                $('.download-icon').css("display", "none");
                $('.redirect-button').css("display", "none");
            }
        });
    });

    $(document).ready(function(){
            var document_id = $('#document_id').val();
            var id = $('#document_template_id').val();
            $.ajax({
            url:"../../../../labels",
            method:'POST',
            dataType:'json',
            data: { "id": id,"document_id":document_id, _token: '{{ csrf_token() }}' },
            success:function(response){
                 var labels = response.labels;
                 var names = response.label_names;
                 var label_count = labels.label;
                 var fields = [];
                 for(var i=0;i<label_count.length;i++){
                    fields[i] = 'field_'+i;
                }
                $.each(fields, function() {
                   $.each(this, function(k, v) {
                    // if(labels.label[k].label_type == 'date'){
                    //     const dateTime = names[fields[k]];
                    //     const parts = dateTime.split(/[- :]/);
                    //     const wanted = `${parts[2]}/${parts[1]}/${parts[0]}`;
                    //     $('.cert-content .'+fields[k]).html(wanted);
                    //     $('.cert-content .'+fields[k]).css("color","var(--dark-2)");
                    // }
                    // else{
                        $('.cert-content .'+fields[v]).html(names[fields[v]]);
                        $('.cert-content .'+fields[v]).css("color","var(--dark-2)");
                    // }  
                        
                    });
                });
            },
            error:function(err){
                console.log(err);
            }
            
        });
 
 
    });
</script>
@endpush
@extends('front.layouts.master')
@section('pageTitle',__('test.Document Subscription Information | Form'))
@section('content')
    <main class="subscription-page formfill-page">
        <section class="form-filling-wrap subscription-form">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="illustra-img">
                            <img src="{{ asset('storage/'.$template->document_image)}}" class="lazyload"/>
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <div class="subscribe-form-wrap">
                            <div class="breadcrumb-wrap">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item HeadlineH5-2"><a href="{{route('user.document')}}">Documentos</a></li>     
                                        @php $category = strtolower($template->category->category_name); @endphp                       
                                        <li class="breadcrumb-item HeadlineH5-2"><a href="{{route('user.document')}}#filtrar=.{{$category}}">{{$template->category->category_name}}</a></li>                                      
                                        <li class="breadcrumb-item HeadlineH5-2 active" aria-current="page">{{$template->document_name}}</li>
                                    </ol>
                                </nav>
                            </div>

                            <div class="form-section-start">
                                <div class="form-head d-flx justify-content-between align-items-center">
                                    <h2 class="HeadlineH2-2 mb-0">Campos Necesarios</h2>                               
                                </div>
                                <div class="form-desc">
                                    <form id="no_subscription_buy_fill_form" method="post">
                                        <div class="form-group d-flex  mb-0">
                                            @if(\Auth::user()->user_type ==2)
                                            @if($subscription['subscriptionType']['id'] != 3)
                                            <div class="custom-control cst-checkbox custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" disabled="disabled" id="rememberdata">
                                                <label class="custom-control-label ml-1" for="rememberdata">Usar datos de mi perfil. (Membresía Premium)</label>
                                            </div>
                                            @else
                                            <div class="custom-control cst-checkbox custom-checkbox">
                                                <input type="checkbox" class="custom-control-input input-field" id="rememberdata">
                                                <label class="custom-control-label ml-1" for="rememberdata">Usar datos de mi perfil. (Membresía Premium)</label>
                                            </div>
                                            @endif
                                            @endif
                                        </div>
                                        <input type="hidden" name="document_id" id="document_id" value="{{$id}}">
                                        <input type="hidden" name="user_id" id="user_id" value="{{\Auth::user()->id}}">
                                        <input type="hidden" name="col_count" id="col_count" value="{{ $col_count }}">

                                        @foreach($labels as $key=>$variable)
                                            @if(\Auth::user()->user_type == 2)                       
                                                @if($variable->user_relation == 1) 
                                                    @if($subscription['subscriptionType']['id'] == 3)     
                                                        @if($variable->label_type !='date')  
                                                            <div class="form-group confirm-val">
                                                                <label class="Ttulo">{{$variable->label_name}}</label>
                                                                <input type="hidden" name="field_label" value="{{$variable->label_name}}">
                                                                <input type="text" data-label-type="{{$variable->label_type}}" name="field_{{$key}}" id="field_{{$key}}" class="form-control field_class input-field" placeholder="Escribir..."   autocomplete="off">
                                                               
                                                                <span class="val-error"></span>
                                                               
                                                            </div>
                                                        @endif
                                                        @if($variable->label_type =='date')    
                                                            @if($variable->label_name =='Fecha de nacimiento')
                                                                <div class="d-flx cal-wid-25">                                                                
                                                                    <div class="form-group confirm-val notranslate">         
                                                                        <label class="Ttulo">{{$variable->label_name}}</label>
                                                                        <div class="input-group date" id="datetimepicker_{{$key}}" data-target-input="nearest">
                                                                            <input type="text" data-label-type="{{$variable->label_type}}" name="field_{{$key}}" id="field_{{$key}}" class="form-control datetimepicker-input dob field_class input-field" data-target="#datetimepicker_{{$key}}" placeholder="Indicar fecha…"   autocomplete="off"/>
                                                                            <div class="input-group-append" data-target="#datetimepicker_{{$key}}" data-toggle="datetimepicker">
                                                                                <div class="input-group-text">
                                                                                    <i class="icon-icons-calendar"></i>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div id="error_msg3"></div>
                                                                       
                                                                            <span class="val-error"></span>
                                                                        
                                                                    </div>                                                                 
                                                                    <span class="Tiene-0-aos-de-edad" id="field_{{$key}}">Tiene años de edad.</span>
                                                                </div>
                                                            @else
                                                            <div class="d-flx cal-wid-25">                               
                                                                <div class="form-group confirm-val notranslate">  
                                                                    <label class="Ttulo">{{$variable->label_name}}</label>                                         
                                                                    <div class="input-group date" id="datetimepicker_{{$key}}" data-target-input="nearest">
                                                                        <input type="text" data-label-type="{{$variable->label_type}}" name="field_{{$key}}" id="field_{{$key}}" class="form-control datetimepicker-input not_dob field_class input-field" data-target="#datetimepicker_{{$key}}" placeholder="Indicar fecha…"   autocomplete="off"/>
                                                                        <div class="input-group-append" data-target="#datetimepicker_{{$key}}" data-toggle="datetimepicker">
                                                                            <div class="input-group-text">
                                                                                <i class="icon-icons-calendar"></i>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div id="error_msg1"></div>
                                                                   
                                                                        <span class="val-error"></span>
                                                                    
                                                                </div>
                                                            </div>
                                                            @endif
                                                        @endif
                                                    @else
                                                    @if($variable->label_type !='date')  
                                                    <div class="form-group confirm-val">
                                                        <label class="Ttulo">{{$variable->label_name}}</label>
                                                        <input type="hidden" name="field_label" value="{{$variable->label_name}}">
                                                        <input type="text" data-label-type="{{$variable->label_type}}" name="field_{{$key}}" id="field_{{$key}}" class="form-control field_class input-field" placeholder="Escribir..."  autocomplete="off">
                                                       
                                                            <span class="val-error"></span>
                                                        
                                                    </div>
                                                @endif
                                                @if($variable->label_type =='date')    
                                                    @if($variable->label_name =='Fecha de nacimiento')
                                                        <div class="d-flx cal-wid-25">
                                                            <div class="form-group confirm-val notranslate">                              
                                                                    <label class="Ttulo">{{$variable->label_name}}</label>
                                                                    <div class="input-group date" id="datetimepicker_{{$key}}" data-target-input="nearest">
                                                                        <input type="text" data-label-type="{{$variable->label_type}}" name="field_{{$key}}" id="field_{{$key}}" class="form-control datetimepicker-input dob field_class input-field" data-target="#datetimepicker_{{$key}}" placeholder="Indicar fecha…"  autocomplete="off"/>
                                                                        <div class="input-group-append" data-target="#datetimepicker_{{$key}}" data-toggle="datetimepicker">
                                                                            <div class="input-group-text">
                                                                                <i class="icon-icons-calendar"></i>
                                                                            </div>
                                                                        </div>
                                                                    </div>                                                  
                                                                    <div id="error_msg3"></div>
                                                                   
                                                                        <span class="val-error"></span>
                                                                    
                                                            </div>
                                                            <!-- <span class="Tiene-0-aos-de-edad" id="field_{{$key}}">Tiene 0 años de edad.</span> -->
                                                        </div>
                                                    @else
                                                        <div class="d-flx cal-wid-25">                               
                                                            <div class="form-group confirm-val notranslate">  
                                                                <label class="Ttulo">{{$variable->label_name}}</label>                                         
                                                                <div class="input-group date" id="datetimepicker_{{$key}}" data-target-input="nearest">
                                                                    <input type="text" data-label-type="{{$variable->label_type}}" name="field_{{$key}}" id="field_{{$key}}" class="form-control datetimepicker-input not_dob field_class input-field" data-target="#datetimepicker_{{$key}}" placeholder="Indicar fecha…"  autocomplete="off"/>
                                                                    <div class="input-group-append" data-target="#datetimepicker_{{$key}}" data-toggle="datetimepicker">
                                                                        <div class="input-group-text">
                                                                            <i class="icon-icons-calendar"></i>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div id="error_msg1"></div>
                                                               
                                                                    <span class="val-error"></span>
                                                                
                                                            </div>
                                                        </div>
                                                    @endif
                                                @endif
                                                    @endif
                                                @else
                                                    @if($variable->label_type !='date')  
                                                        <div class="form-group confirm-val">
                                                            <label class="Ttulo">{{$variable->label_name}}</label>
                                                            <input type="hidden" name="field_label" value="{{$variable->label_name}}">
                                                            <input type="text" data-label-type="{{$variable->label_type}}" name="field_{{$key}}" id="field_{{$key}}" class="form-control field_class input-field" placeholder="Escribir..."  autocomplete="off">
                                                           
                                                                <span class="val-error"></span>
                                                           
                                                        </div>
                                                    @endif
                                                    @if($variable->label_type =='date')    
                                                        @if($variable->label_name =='Fecha de nacimiento')
                                                            <div class="d-flx cal-wid-25">
                                                                <div class="form-group confirm-val notranslate">                                                                     
                                                                    <label class="Ttulo">{{$variable->label_name}}</label>
                                                                    <div class="input-group date" id="datetimepicker_{{$key}}" data-target-input="nearest">
                                                                        <input type="text" data-label-type="{{$variable->label_type}}" name="field_{{$key}}" id="field_{{$key}}" class="form-control datetimepicker-input dob field_class input-field" data-target="#datetimepicker_{{$key}}" placeholder="Indicar fecha…"  autocomplete="off"/>
                                                                        <div class="input-group-append" data-target="#datetimepicker_{{$key}}" data-toggle="datetimepicker">
                                                                            <div class="input-group-text">
                                                                                <i class="icon-icons-calendar"></i>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                                                                       
                                                                    <div id="error_msg3"></div>
                                                               
                                                                    <span class="val-error"></span>
                                                                
                                                                </div>
                                                                <span class="Tiene-0-aos-de-edad" id="field_{{$key}}">Tiene 0 años de edad.</span>
                                                            </div>
                                                        @else
                                                            <div class="d-flx cal-wid-25">                               
                                                                <div class="form-group confirm-val notranslate">  
                                                                    <label class="Ttulo">{{$variable->label_name}}</label>                                         
                                                                    <div class="input-group date" id="datetimepicker_{{$key}}" data-target-input="nearest">
                                                                        <input type="text" data-label-type="{{$variable->label_type}}" name="field_{{$key}}" id="field_{{$key}}" class="form-control datetimepicker-input not_dob field_class input-field" data-target="#datetimepicker_{{$key}}" placeholder="Indicar fecha…"  autocomplete="off"/>
                                                                        <div class="input-group-append" data-target="#datetimepicker_{{$key}}" data-toggle="datetimepicker">
                                                                            <div class="input-group-text">
                                                                                <i class="icon-icons-calendar"></i>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div id="error_msg1"></div>
                                                                   
                                                                        <span class="val-error"></span>
                                                                   
                                                                </div>
                                                            </div>
                                                        @endif
                                                    @endif
                                                @endif                         
                                            @endif
                                        @endforeach   
                                        @if(\Auth::user()->user_type ==2) 
                                            @if($subscription['subscriptionType']['id'] != 3)                                                                       
                                                <div class="fetch-info ">
                                                    <div class="trans_data_wrap opacity_4">
                                                        <div class="HeadlineH6-Blue-2 ">
                                                        Fecha de Caducidad de este Documento
                                                        </div>
                                                        <div class="BodyBody-2 ">
                                                        Para suscriptores premium, esta fecha se usará para recordarle cuando su documento esté apunto de vencer.
                                                        </div>
                                                        <div class="d-flx cal-wid-25 notranslate">
                                                            <div class="form-group ">  
                                                                <div class="input-group date" id="datetimepicker4" data-target-input="nearest">
                                                                    <input type="text" class="form-control datetimepicker-input" data-target="#datetimepicker4" placeholder="Indicar fecha…"  disabled/>
                                                                    <div class="input-group-append" data-target="#datetimepicker4" data-toggle="datetimepicker">
                                                                        <div class="input-group-text">
                                                                            <i class="icon-icons-calendar"></i>
                                                                        </div>
                                                                    </div>
                                                                </div>                                            
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @else
                                                <div class="fetch-info">
                                                    <div class="trans_data_wrap">
                                                        <div class="HeadlineH6-Blue-2 ">
                                                        Fecha de Caducidad de este Documento
                                                        </div>
                                                        <div class="BodyBody-2 ">
                                                        Para suscriptores premium, esta fecha se usará para recordarle cuando su documento esté apunto de vencer.
                                                        </div>
                                                        <div class="d-flx cal-wid-25 notranslate">
                                                            <div class="form-group confirm-val">  
                                                                <div class="form-group ">                                              
                                                                    <div class="input-group date" id="datetimepicker4" data-target-input="nearest">
                                                                        <input type="text" name="expiry_date"  class="form-control datetimepicker-input expiry_date input-field" data-target="#datetimepicker4" placeholder="Indicar fecha…"  autocomplete="off"//>
                                                                        <div class="input-group-append" data-target="#datetimepicker4" data-toggle="datetimepicker">
                                                                            <div class="input-group-text">
                                                                                <i class="icon-icons-calendar"></i>
                                                                            </div>
                                                                        </div>
                                                                    </div>                                             
                                                                </div>
                                                            </div>      
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        @endif
                                        <div class="agree-text align-items-md-center align-items-sm-start d-flex color-blue mt-34">
                                            <i class="icon-icons-info"></i><span class="LinkActive-2">Siempre revise su información y asegúrese de que sea precisa</span>
                                        </div>
                                        <input type="hidden" name="document_template_id" id="document_template_id">
                                        <div class="form-reg-bt">
                                                <!-- remove disabled once form filled -->
                                            <!-- <a href="#" class="btn btn-comon btn-blue disabled">Vista Previa</a> -->
                                            <!-- <a href="documentfilling_nosubscription_preview.php" class="btn btn-comon btn-blue">Vista Previa</a> -->
                                            <input type="button" class="btn btn-comon btn-blue disabled" value="Vista Previa">
                                                <!-- remove disabled once form filled -->
                                        </div>
                                    </form>
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
    var save_buy_fill = "{{route('user.nosubscription.buy.fill.store')}}";
    var fetch_user_data ="{{route('user.fetch_user_data')}}";

</script>
<script src="{{ asset('front/assets/custom/js/nosubscription.js')}}"></script>
<script>
@foreach($labels as $key=>$variable)
    @if($variable->label_type =='date')    
        @if($variable->label_name =='Fecha de nacimiento')
        $("#datetimepicker_{{$key}}").on("change.datetimepicker", ({date, oldDate}) => {              
            var tempDate = new Date(date);
            var currentTime = new Date();
            var month = currentTime.getMonth();
            var day = currentTime.getDate();
            var year = currentTime.getFullYear();

            var temp_month = tempDate.getMonth();

            var temp_day = tempDate.getDate();

            var temp_year = tempDate.getFullYear();


            var age = year - temp_year;


            if (month < temp_month) {
                age = age - 1;
            } else if (month == temp_month && day < temp_day) {
                age = age - 1;
            }
            $('.Tiene-0-aos-de-edad').html('Tiene '+ age + ' años de edad.');
            });

            $("#datetimepicker_{{$key}}").datetimepicker({
                format: "DD/MM/YYYY",
                useCurrent: false,
                viewDate: moment().subtract(18, 'years'),
                // maxDate: moment().millisecond(999).second(59).minute(59).hour(23),
                maxDate: moment().subtract(18, 'years'),
                widgetPositioning: {
                horizontal: "right",
                vertical: "bottom",
                },
                weekdaysShort: ["U", "Feb", "Mar", "Apr", "May", "Jun", "Jul"],
                icons: {
                previous: "icon-icons-arrow-chevron-left",
                next: "icon-icons-arrow-chevron-right",
                },
            });
        @else
        $("#datetimepicker_{{$key}}").datetimepicker({
                format: "DD/MM/YYYY",
                // debug: true,
                minDate: new Date().setHours(0,0,0,0),
                widgetPositioning: {
                horizontal: "right",
                vertical: "bottom",
                },

                weekdaysShort: ["U", "Feb", "Mar", "Apr", "May", "Jun", "Jul"],
                icons: {
                previous: "icon-icons-arrow-chevron-left",
                next: "icon-icons-arrow-chevron-right",
                },
            });
        @endif
    @endif
@endforeach
</script>
@endpush



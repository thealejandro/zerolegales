@extends('admin.layouts.master')
@section('pageTitle',__('test.create-legal-document-template'))
@section('content') 
    <div class="breadcrumb">
        <h1>{{__('test.create-legal-document-template')}}</h1>
        <ul>
            <li>{{__('test.home')}}</li>
            <li><a href="{{route('admin.template.index')}}">{{__('test.create-legal-document-template')}}</a></li>
        </ul>
    </div>
    <div class="separator-breadcrumb border-top"></div>
    <div class="row">
        <div class="col-md-12">
            <div class="card mb-4">
                <div class="card-body">
                    <div class="card-title mb-3">{{__('test.create-legal-document-template')}}</div>
                    <ul class="nav nav-pills" id="myPillTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="home-icon-pill" data-toggle="pill" href="#step1" role="tab" aria-controls="homePIll" aria-selected="true">Step #1</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="profile-icon-pill" data-toggle="pill" href="#step2" role="tab" aria-controls="profilePIll" aria-selected="false">Step #2</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="contact-icon-pill" data-toggle="pill" href="#step3" role="tab" aria-controls="contactPIll" aria-selected="false">Step #3</a>
                        </li>
                    </ul>
                        <div class="tab-content" id="myPillTabContent">
                                <div class="tab-pane fade show active" id="step1" role="tabpanel" aria-labelledby="home-icon-pill">
                                    <form id="template_form" method="post">
                                        <div class="row">
                                            <div class="col-md-6 form-group mb-3">
                                                    <label>{{__('test.template-type')}}<span class="required">&#42;</span></label><br>
                                                    <div class="form-check form-check-inline">
                                                        @foreach($document_types as $types)
                                                            <label class="radio radio-primary">
                                                                <input type="radio" name="template_type" id="template_type" value="{{$types->id}}"><span>{{$types->type_name}}</span><span class="checkmark"></span>
                                                            </label>&nbsp;
                                                        @endforeach
                                                    </div>
                                                    <div id="error_msg1"></div>
                                                    <div class="clearix"></div>
                                                    <span class="text-danger"></span>
                                            </div>
                                            <div class="col-md-6 form-group mb-3">
                                                <label>{{__('test.document-name')}}<span class="required">&#42;</span></label>
                                                <input type="text" name="document_name" id="document_name" placeholder="{{__('test.document-name')}}" class="form-control" value="{{ old('document_name') }}" autocomplete="off">
                                                <span class="text-danger"></span>
                                            </div>
                                            <div class="col-md-6 form-group mb-3" id="doc_category">
                                                <label>{{__('test.document-category')}}<span class="required">&#42;</span></label>
                                                <select name="category_id" class="form-control">
                                                    <option value="" disabled selected hidden>{{__('test.select-document-category')}}</option>
                                                    @foreach($categories as $category)
                                                    <option value="{{$category->id}}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{$category->category_name}}</option>
                                                    @endforeach
                                                </select>
                                                <div id="error_msg3"></div>
                                                <div class="clearix"></div>
                                                <span class="text-danger"></span>
                                            </div>
                                            <div class="col-md-6 form-group mb-3">
                                                <label>{{__('test.document-description')}}<span class="required">&#42;</span></label>
                                                <textarea type="text" name="document_description" id="document_description" placeholder="{{__('test.document-description')}}" class="form-control">{{ old('document_description') }}</textarea>
                                                <span class="text-danger"></span>
                                            </div>
                                            <div class="col-md-6 form-group mb-3">
                                                <label>{{__('test.information-document')}}<span class="required">&#42;</span></label>
                                                <textarea type="text" name="information_document" id="information_document" placeholder="{{__('test.information-document')}}" class="form-control">{{ old('information_document') }}</textarea>
                                                <span class="text-danger"></span>
                                            </div>
                                            <div class="col-md-6 form-group mb-3" id="subscription_category">
                                                <label class="w-100" >{{__('test.select-subscription-category')}}<span class="required">&#42;</span></label><br>
                                                    <div class="form-check-inline">
                                                        <label class="checkbox checkbox-primary">
                                                            <input type="checkbox" id="check1" name="subscription_category[]" value="1"><span>One Time</span><span class="checkmark"></span>
                                                        </label>
                                                    </div>
                                                    <div class="form-check-inline">
                                                    <label class="checkbox checkbox-primary">
                                                            <input type="checkbox" id="check2" name="subscription_category[]" value="2"><span>Standard</span><span class="checkmark"></span>
                                                        </label>
                                                    </div>
                                                    <div class="form-check-inline">
                                                        <label class="checkbox checkbox-primary">
                                                            <input type="checkbox" id="check3" name="subscription_category[]" value="3"><span>Premium</span><span class="checkmark"></span>
                                                        </label>
                                                    </div>
                                                    <div id="error_msg6"></div>
                                                    <div class="clearix"></div>
                                                    <span class="text-danger"></span>
                                            </div>
                                            <div class="col-md-6 form-group mb-3" id="doc_authentication">
                                                <label>{{__('test.Does it apply for document authentication')}}<span class="required">&#42;</span></label><br>
                                                    <div class="form-check form-check-inline">
                                                        <label class="radio radio-primary">
                                                            <input type="radio" name="document_authentication" value="yes"><span>{{__('test.yes')}}</span><span class="checkmark"></span>
                                                        </label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <label class="radio radio-primary">
                                                            <input type="radio" name="document_authentication" value="no"><span>{{__('test.no')}}</span><span class="checkmark"></span>
                                                        </label>
                                                    </div>
                                                    <div id="error_msg2"></div>
                                                    <div class="clearix"></div>
                                                    <span class="text-danger"></span>
                                            </div>
                                            <div class="col-md-6 form-group mb-3" id="doc_required">
                                                <label>{{__('test.Select documents required for authentication')}}<span class="required">&#42;</span></label><br>
                                                <div class="form-check-inline">
                                                    <label class="checkbox checkbox-primary">
                                                        <input type="checkbox" id="check1" name="document_required[]" value="dpi_file"><span>{{__('test.DPI-Passport')}}</span><span class="checkmark"></span>
                                                    </label>
                                                </div>
                                                <div class="form-check-inline">
                                                    <label class="checkbox checkbox-primary">
                                                        <input type="checkbox" id="check2" name="document_required[]" value="company_trade_patent"><span>{{__('test.Company patent')}}</span><span class="checkmark"></span>
                                                    </label>
                                                </div>
                                                <div class="form-check-inline">
                                                    <label class="checkbox checkbox-primary">
                                                        <input type="checkbox" id="check3" name="document_required[]" value="appointment"><span>{{__('test.Appointment')}}</span><span class="checkmark"></span>
                                                    </label>
                                                </div>
                                                <div class="form-check-inline">
                                                    <label class="checkbox checkbox-primary">
                                                        <input type="checkbox" id="check4" name="document_required[]" value="rtu"><span>RTU</span><span class="checkmark"></span>
                                                    </label>
                                                </div>
                                                <div class="form-check-inline">
                                                    <label class="checkbox checkbox-primary">
                                                        <input type="checkbox" id="check5" name="document_required[]" value="society_trade_patent"><span>{{__('test.Commercial patent')}}</span><span class="checkmark"></span>
                                                    </label>
                                                </div>
                                                <div id="error_msg4"></div>
                                                <div class="clearix"></div>
                                                <span class="text-danger"></span>

                                            </div>
                                            <div class="col-md-6 form-group mb-3">
                                                <label>{{__('test.document-image')}}<span class="required">*</span></label>
                                                <div id="preview">
                                                    <img width="100px" height="auto" src="{{ asset('assets/images/no-image.png')}}" id="thumb"/>
                                                </div>
                                                <div class="custom-file">
                                                <input type="file" name="document_image" class="custom-file-input" accept="image/png" id="customFileLang" onchange="readURL(this);">
                                                <label class="custom-file-label" for="customFileLang" data-browse="{{__('test.browse')}}">{{__('test.upload')}}</label>
                                                
                                                </div>
                                                <span class="text-danger"></span>                
                                            </div>
                                            <div class="col-md-6 form-group mb-3">
                                                <label>{{__('test.price')}}<span class="required">&#42;</span></label>
                                                <input type="text" name="price" id="price" placeholder="En Quetzales" class="form-control" autocomplete="off">
                                                <span class="text-danger"></span> 
                                            </div>
                                            <div class="col-md-12 form-group mb-3">
                                                <button type="submit" class="btn btn-success subButton" id="subButton" href="#step2">{{__('test.continue')}}</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                                <div class="tab-pane fade" id="step2" role="tabpanel" aria-labelledby="profile-icon-pill">
                                    <form id="template_step2_form" method="post">
                                        <div class="row">
                                            <div class="col-md-6 form-group" id="inputVariable">  
                                                <input type="hidden" name="document_id" id="document_id" value=""> 
                                                <select name="variable_id" class="form-control select2 input-variables" id="variable_id" style="width: 100%">
                                                    <option value="" disabled selected hidden>{{__('test.select personal information variable')}}</option> 
                                                    @foreach($variables as $variable)
                                                        <option value="{{$variable->id}}">{{$variable->variable_name}}</option>
                                                    @endforeach                                         
                                                </select>
                                                @if($errors->has('variable_id'))
                                                <span class="text-danger">
                                                    <strong>{{ $errors->first('variable_id') }}</strong>
                                                </span>
                                                @endif
                                            </div> 
                                            <div class="col-md-6 form-group ">
                                                <img src="{{asset('assets/images/icons-plus.png')}}" id="saveVariable" class="img-responsive">
                                            </div>

                                            <div class="col-md-6 form-group "> 
                                                <div class="table-responsive">
                                                    <table class="table table-bordered" id="inputVariableTable">
                                                        <thead>
                                                            <tr>
                                                                <th>{{__('test.name')}}</th>
                                                                <th>{{__('test.type')}}</th>
                                                                <th data-orderable="false">{{__('test.action')}}</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody id="variableBody"></tbody>
                                                    </table>
                                                </div>  
                                            </div>

                                            <div class="col-md-12 form-group mb-5">
                                                <a href="#" id="addNewVariable" data-toggle="modal" data-target="#newVariableModal">{{__('test.add-new-variable')}}</a>

                                                <!-- <a class="text-secondary" data-toggle="modal" id="mediumButton" data-target="#mediumModal"
                                                    data-attr="">
                                                    <i class="fas fa-edit text-gray-300"></i>
                                                </a> -->
                                            </div>

                                            <div class="col-md-12 form-group ">
                                                
                                                <button type="button" class="btn btn-success" id="variableButton" href="#step3">{{__('test.continue')}}</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="tab-pane fade" id="step3" role="tabpanel" aria-labelledby="contact-icon-pill">
                                    <form id="body_form" method="post">
                                        <h3>{{__('test.text-body')}}</h3>
                                        <input type="hidden" name="document_id" id="document" value=""> 
                                        <input type="hidden" name="template_type" id="type_template" value=""> 
                                        <div class="row">                                              
                                            <div class="col-md-6 form-group mb-3">                                        
                                                <textarea id="text_body" name="text_body"></textarea>
                                                <div id="error_msg5"></div>
                                                <div class="clearix"></div>
                                                <span class="text-danger"></span>
                                                <br>
                                                <button type="submit" class="btn btn-success bodyButton" id="bodyButton">{{__('test.save')}}</button>
                                            </div>
                                            <div class="col-md-3 form-group mb-3">
                                                <table class="table table-bordered bodyVariableTable" id="bodyVariableTable">
                                                <tbody></tbody>
                                                </table>
                                            </div>                                        
                                            <!-- <div class="col-md-6 form-group mb-3">
                                                <button type="submit" class="btn btn-success bodyButton" id="bodyButton">{{__('test.save')}}</button>
                                            </div> -->
                                        </div>
                                        </div>
                                    </form>
                                </div>
                    </div>

                    <!-- Input variable edit modal -->
                    <!-- <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="verifyModalContent" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="verifyModalContent_title"></h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form id="editDocumentForm" method="post" action="#">
                                <div class="modal-body">
                                        

                                        <div class="row">
                                            <div class="col-md-6 form-group mb-3">
                                                <input type="hidden" name="edit_variable_id" id="edit_variable_id">
                                                <input type="hidden" name="edit_variable_template_id" id="edit_variable_template_id">
                                                <label>{{__('test.variable-name')}}<span class="required">&#42;</span></label>
                                                <input type="text" name="edit_variable_name" id="edit_variable_name" placeholder="{{__('test.variable-name')}}" class="form-control" value="" autocomplete="off">
                                                @if($errors->has('edit_variable_name'))
                                                <span class="text-danger">
                                                    <strong>{{ $errors->first('edit_variable_name') }}</strong>
                                                </span>
                                                @endif
                                            </div>
                                            <div class="col-md-6 form-group mb-3">
                                                <label>{{__('test.variable-type')}}<span class="required">&#42;</span></label>
                                                <select name="edit_variable_type" class="form-control" id="edit_variable_type">
                                                    <option value="" disabled selected hidden>{{__('test.select-variable-type')}}</option> 
                                                    @foreach($input_variable_types as $input_variable_type)
                                                        <option value="{{ $input_variable_type->id }}">{{$input_variable_type->variable_type}}({{$input_variable_type->description}})</option>
                                                    @endforeach                                         
                                                </select>
                                                @if($errors->has('edit_variable_type'))
                                                <span class="text-danger">
                                                    <strong>{{ $errors->first('edit_variable_type') }}</strong>
                                                </span>
                                                @endif
                                            </div>
                                            
                                        </div>

                                </div>
                                <div class="modal-footer">
                                    <a class="btn btn-primary" id="variableModalCancel" href="#" >{{__('test.cancel')}}</a>
                                    <input type="submit" class="btn btn-success" value="{{__('test.save')}}">
                                </div>
                                </form>
                            </div>
                        </div>
                    </div> -->

                    <!-- Input variable edit modal -->
                    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="verifyModalContent" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="verifyModalContent_title"></h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form id="editDocumentForm" method="post" action="#">
                                <div class="modal-body">
                                        

                                        <div class="row">
                                            <div class="col-md-6 form-group mb-3">
                                                <input type="hidden" name="edit_variable_template_id" id="edit_variable_template_id">
                                               
                                                <select name="variable_id2" class="form-control select2" id="variable_id2" style="width: 100%">
                                                  
                                                </select>
                                            </div>                                            
                                        </div>
                                </div>
                                <div class="modal-footer">
                                    <a class="btn btn-primary" id="variableModalCancel" href="#" >{{__('test.cancel')}}</a>
                                    <input type="submit" class="btn btn-success" value="{{__('test.save')}}">
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- new Input Variable adding modal -->
    <div class="modal fade" id="newVariableModal" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <div class="card-title mb-3">{{__('test.add-input-variable')}}</div>
                    <button type="button" class="close" id="variableModalclose" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="mediumBody">
                <!-- <div class="card-title mb-3">{{__('test.add-input-variable')}}</div> -->
                    {{ Form::open(['route' => 'admin.input.variable.store', 'class' => 'kt-form', 'id'=>'variable_form','role' => 'form', 'method' => 'post']) }}
                        <div class="row">
                            <div class="col-md-6 form-group mb-3">
                                <label>{{__('test.variable-name')}}<span class="required">&#42;</span></label>
                                <input type="text" name="variable_name" id="variable_name" placeholder="{{__('test.variable-name')}}" class="form-control" value="{{ old('variable_name') }}" autocomplete="off">
                                @if($errors->has('variable_name'))
                                <span class="text-danger">
                                    <strong>{{ $errors->first('variable_name') }}</strong>
                                </span>
                                @endif
                            </div>
                            <div class="col-md-6 form-group mb-3">
                                <label>{{__('test.variable-type')}}<span class="required">&#42;</span></label>
                                <select name="variable_type" class="form-control" id="variable_type">
                                    <option value="" disabled selected hidden>{{__('test.select-variable-type')}}</option> 
                                    @foreach($input_variable_types as $input_variable_type)
                                    <option value="{{ $input_variable_type->id }}">{{$input_variable_type->variable_type}}({{$input_variable_type->description}})</option>
                                    @endforeach                                         
                                </select>
                                @if($errors->has('variable_type'))
                                <span class="text-danger">
                                    <strong>{{ $errors->first('variable_type') }}</strong>
                                </span>
                                @endif
                            </div>
                            <div class="col-md-12">
                                <a class="btn btn-primary" id="variableModalCancel" href="#" >{{__('test.cancel')}}</a>
                                <input type="submit" class="btn btn-success" value="{{__('test.save')}}">
                            </div>
                        </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
<script>
    // CKEDITOR.replace('text_body', {
    //     extraAllowedContent: 'span(*){*}[*]'        
    // });  


    // function insertContent(html) {
    //     console.log(html);
    //     for (var i in CKEDITOR.instances) {
    //         CKEDITOR.instances[i].insertHtml(html);
    //     }
    //     return true;
    // }

      var editor =  CKEDITOR.replace('text_body', {
            extraAllowedContent: 'span(*){*}[*]',            
        });  
        editor.on('afterCommandExec', function (e) {
            if (e.data.name == 'enter') {
                var el = e.editor.getSelection().getStartElement();
                console.log(el);
                el.remove('span', '');
            }
        });

        function insertContent(html) {
            //console.log(html);
                CKEDITOR.instances['text_body'].insertHtml(html);
            
            return true;
        }
    $(document).on('click', '.btn_button', function () {
        var text_include = $(this).closest('td').prev('.variable_name').text();
        var field_name = $(this).closest('td').prev('.variable_name').attr('data-field');
       // console.log('<span class='+'"'+text_include+'"'+'>'+text_include+'</span>');
        insertContent('<span style="color:var(--blue-normal-2);" class='+'"'+field_name+'"'+'>'+text_include+'</span>')
    });

    $('.select2').select2({
        placeholder: 'Seleccionar variable de información personal',
        width: 'resolve',
        language: "es"
    });

    $(function () {
        $('.select2').on('change', function () {
            $(this).valid();
        });
    });

    $("#variable_id2").select2();
    $('#variable_id2').select2({
        dropdownParent: $('#myModal')
    });
</script>
<script src="{{ asset('assets/custom/js/admin/template.js')}}"></script>
@endpush

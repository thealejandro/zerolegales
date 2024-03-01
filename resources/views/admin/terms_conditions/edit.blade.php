@extends('admin.layouts.master')
@section('pageTitle',__('test.terms-conditions'))
@section('content')
    <div class="breadcrumb">
        <h1>{{__('test.edit-terms-conditions')}}</h1>
        <ul>
            <li>{{__('test.home')}}</li>
            <li><a href="{{route('admin.terms-conditions.index')}}">{{__('test.terms-conditions')}}</a></li>
        </ul>
    </div>
    <div class="separator-breadcrumb border-top"></div>
    <div class="row">
        <div class="col-md-12">
            <div class="card mb-4">
                <div class="card-body">
                    <div class="card-title mb-3">{{__('test.edit-terms-conditions')}}</div>
                    {!! Form::model($condition,['route' => ['admin.terms-conditions.update',$id], 'method' => 'POST','class' => 'kt-form','id'=>'edit_terms_conditions_form',
                            'role' => 'form','novalidate']) !!}
                            <div class="col-md-6 form-group mb-3">
                                <label>{{__('test.terms-conditions')}}<span class="required">&#42;</span></label>
                                <input type="text" name="condition_name" id="condition_name" placeholder="{{__('test.terms-conditions')}}" class="form-control" value="{{ $condition->condition_name }}" readonly>
                                @if($errors->has('condition_name'))
                                <span class="text-danger">
                                    <strong>{{ $errors->first('condition_name') }}</strong>
                                </span>
                                @endif
                            </div>
                            <div class="col-md-6 form-group mb-3">                                        
                                <textarea id="condition_text" name="condition_text">{{ $condition->condition_text }}</textarea>
                                <div id="error_msg5"></div>
                                <div class="clearix"></div>
                                @if($errors->has('condition_text'))
                                <span class="text-danger">
                                    <strong>{{ $errors->first('condition_text') }}</strong>
                                </span>
                                @endif
                            </div>
                            <div class="col-md-12">
                                <a class="btn btn-primary" href="{{route('admin.terms-conditions.index')}}">{{__('test.cancel')}}</a>
                                    <input type="submit" class="btn btn-success" value="{{__('test.save')}}">
                            </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
<script>
        CKEDITOR.replace( 'condition_text' );
    function insertContent(html) {
        for (var i in CKEDITOR.instances) {
            CKEDITOR.instances[i].insertHtml(html);
        }
        return true;
    }
</script>
<script src="{{ asset('assets/custom/js/admin/terms_conditions.js')}}"></script>
@endpush

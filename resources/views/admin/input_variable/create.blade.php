@extends('admin.layouts.master')
@section('pageTitle',__('test.add-input-variable'))
@section('content')
    <div class="breadcrumb">
        <h1>{{__('test.add-input-variable')}}</h1>
        <ul>
            <li>{{__('test.home')}}</li>
            <li><a href="{{route('admin.input.variable.index')}}">{{__('test.input-variable')}}</a></li>
        </ul>
    </div>
    <div class="separator-breadcrumb border-top"></div>
    <div class="row">
        <div class="col-md-12">
            <div class="card mb-4">
                <div class="card-body">
                    <div class="card-title mb-3">{{__('test.add-input-variable')}}</div>
                    {{ Form::open(['route' => 'admin.input.variable.store', 'class' => 'kt-form', 'id'=>'variable_form','role' => 'form', 
                                        'method' => 'post']) }}
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
                                    @foreach($types as $type)
                                    <option value="{{$type->id}}">{{$type->variable_type}}({{$type->description}})</option>
                                    @endforeach                                         
                                </select>
                                @if($errors->has('variable_type'))
                                <span class="text-danger">
                                    <strong>{{ $errors->first('variable_type') }}</strong>
                                </span>
                                @endif
                            </div>
                            <div class="col-md-12">
                                    <a class="btn btn-primary" href="{{route('admin.input.variable.index')}}">{{__('test.cancel')}}</a>
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
<script src="{{ asset('assets/custom/js/admin/variable.js')}}"></script>
@endpush

@extends('admin.layouts.master')
@section('pageTitle',__('test.edit-lawyers-directory'))
@section('content')
    <div class="breadcrumb">
        <h1>{{__('test.edit-lawyers-directory')}}</h1>
        <ul>
            <li>{{__('test.home')}}</li>
            <li><a href="{{route('admin.lawyers.directory.index')}}">{{__('test.lawyers-directory')}}</a></li>
        </ul>
    </div>
    <div class="separator-breadcrumb border-top"></div>
    <div class="row">
        <div class="col-md-12">
            <div class="card mb-4">
                <div class="card-body">
                    <div class="card-title mb-3">{{__('test.edit-lawyers-directory')}}</div>
                    {!! Form::model($directory,['route' => ['admin.lawyers.directory.update',$id], 'method' => 'POST','class' => 'kt-form','id'=>'edit_directory_form',
                        'role' => 'form','novalidate']) !!}
                        <div class="row">
                            <div class="col-md-6 form-group mb-3">
                                <label>{{__('test.lawyer-name')}}<span class="required">&#42;</span></label>
                                <input type="text" name="lawyer_name" id="lawyer_name" placeholder="{{__('test.lawyer-name')}}" class="form-control" value="{{ $directory->lawyer_name }}" autocomplete="off">
                                @if($errors->has('lawyer_name'))
                                <span class="text-danger">
                                    <strong>{{ $errors->first('lawyer_name') }}</strong>
                                </span>
                                @endif
                            </div>
                            <div class="col-md-6 form-group mb-3">
                                <label>{{__('test.lawyer-address')}}<span class="required">&#42;</span></label>
                                <input type="text" name="lawyer_address" id="lawyer_address" placeholder="{{__('test.lawyer-address')}}" class="form-control" value="{{ $directory->lawyer_address }}" autocomplete="off">
                                @if($errors->has('lawyer_address'))
                                <span class="text-danger">
                                    <strong>{{ $errors->first('lawyer_address') }}</strong>
                                </span>
                                @endif
                            </div>
                            <div class="col-md-6 form-group mb-3">
                                <label>{{__('test.zone')}}<span class="required">&#42;</span></label>
                                <input type="text" name="zone" id="zone" placeholder="{{__('test.zone')}}" class="form-control" value="{{ $directory->zone }}" autocomplete="off">
                                @if ($errors->has('zone'))
                                <span class="text-danger">
                                    <strong>{{ $errors->first('zone') }}</strong>
                                </span>
                                @endif
                            </div>
                            <div class="col-md-6 form-group mb-3">
                                <label>{{__('test.township')}}<span class="required">&#42;</span></label>
                                <input type="text" name="township" class="form-control" placeholder="{{__('test.township')}}" autocomplete="off" value="{{ $directory->township }}" />
                                @if ($errors->has('township'))
                                <span class="text-danger">
                                    <strong>{{ $errors->first('township') }}</strong>
                                </span>
                                @endif
                            </div>
                            <div class="col-md-6 form-group mb-3">
                                <label>{{__('test.department or state')}}<span class="required">&#42;</span></label>
                                <input type="text" name="department" class="form-control" placeholder="{{__('test.department or state')}}" autocomplete="off" value="{{ $directory->department }}" />
                                @if ($errors->has('department'))
                                <span class="text-danger">
                                    <strong>{{ $errors->first('department') }}</strong>
                                </span>
                                @endif
                            </div>
                            <div class="col-md-6 form-group mb-3">
                                <label>{{__('test.mobile-phone')}}<span class="required">&#42;</span></label>
                                <input type="text" name="phone" class="form-control" placeholder="{{__('test.mobile-phone')}}" autocomplete="off" value="{{ $directory->phone }}" />
                                @if ($errors->has('phone'))
                                <span class="text-danger">
                                    <strong>{{ $errors->first('phone') }}</strong>
                                </span>
                                @endif
                            </div>
                            <div class="col-md-6 form-group mb-3">
                                <label>{{__('test.email')}}<span class="required">&#42;</span></label>
                                <input type="text" name="email" id="email" placeholder="{{__('test.email')}}" class="form-control" value="{{ $directory->email }}" autocomplete="off">
                                @if ($errors->has('email'))
                                <span class="text-danger">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                                @endif
                            </div>
                            <div class="col-md-12">
                                <a class="btn btn-primary" href="{{route('admin.lawyers.directory.index')}}">{{__('test.cancel')}}</a>
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
<script src="{{ asset('assets/custom/js/admin/lawyers_directory.js')}}"></script>
@endpush

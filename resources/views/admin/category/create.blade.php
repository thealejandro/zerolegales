@extends('admin.layouts.master')
@section('pageTitle',__('test.add-category'))
@section('content')
    <div class="breadcrumb">
        <h1>{{__('test.add-category')}}</h1>
        <ul>
            <li>{{__('test.home')}}</li>
            <li><a href="{{route('admin.category.index')}}">{{__('test.category')}}</a></li>
        </ul>
    </div>
    <div class="separator-breadcrumb border-top"></div>
    <div class="row">
        <div class="col-md-12">
            <div class="card mb-4">
                <div class="card-body">
                    <div class="card-title mb-3">{{__('test.add-category')}}</div>
                    {{ Form::open(['route' => 'admin.category.store', 'class' => 'kt-form', 'id'=>'category_form','role' => 'form', 
                                        'method' => 'post']) }}
                        <div class="row">
                            <div class="col-md-6 form-group mb-3">
                                <label>{{__('test.category-name')}}<span class="required">&#42;</span></label>
                                <input type="text" name="category_name" id="category_name" placeholder="{{__('test.category-name')}}" class="form-control" value="{{ old('category_name') }}" autocomplete="off">
                                @if($errors->has('category_name'))
                                <span class="text-danger">
                                    <strong>{{ $errors->first('category_name') }}</strong>
                                </span>
                                @endif
                            </div>
                            <div class="col-md-12">
                                    <a class="btn btn-primary" href="{{route('admin.category.index')}}">{{__('test.cancel')}}</a>
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
<script src="{{ asset('assets/custom/js/admin/category.js')}}"></script>
@endpush

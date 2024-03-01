@extends('admin.layouts.master')
@section('pageTitle',__('test.edit-category'))
@section('content')
    <div class="breadcrumb">
        <h1>{{__('test.edit-category')}}</h1>
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
                    <div class="card-title mb-3">{{__('test.edit-category')}}</div>
                    {!! Form::model($category,['route' => ['admin.category.update',$id], 'method' => 'POST','class' => 'kt-form','id'=>'edit_category_form',
                            'role' => 'form','novalidate']) !!}
                        <div class="row">
                            <div class="col-md-6 form-group mb-3">
                                <label>{{__('test.category-name')}}<span class="required">&#42;</span></label>
                                <input type="text" name="category_name" id="category_name" placeholder="{{__('test.category-name')}}" class="form-control" value="{{ $category->category_name }}" autocomplete="off">
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

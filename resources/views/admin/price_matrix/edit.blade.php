@extends('admin.layouts.master')
@section('pageTitle',__('test.edit-price'))
@section('content')
    <div class="breadcrumb">
        <h1>{{__('test.edit-price')}}</h1>
        <ul>
            <li>{{__('test.home')}}</li>
            <li><a href="{{route('admin.price.matrix.index')}}">{{__('test.price-matrix')}}</a></li>
        </ul>
    </div>
    <div class="separator-breadcrumb border-top"></div>
    <div class="row">
        <div class="col-md-12">
            <div class="card mb-4">
                <div class="card-body">
                    <div class="card-title mb-3">{{__('test.edit-price')}}</div>
                        {!! Form::model($price,['route' => ['admin.price.matrix.update',$id], 'method' => 'POST','class' => 'kt-form','id'=>'edit_price_matrix_form',
                            'role' => 'form','novalidate']) !!}
                        <div class="row">
                            <input type="hidden" name="id" value="{{$id}}">
                            <div class="col-md-6 form-group mb-3">
                                <label>{{__('test.subscription-type')}}<span class="required">&#42;</span></label>
                                <select name="subscription_id" class="form-control" id="subscription_id">
                                    <option value="" disabled selected hidden>{{__('test.select-subscription-type')}}</option> 
                                    @foreach($subscriptions as $subscription)
                                    <option value="{{$subscription->id}}" {{ $price->subscription_id == $subscription->id ? 'selected' : '' }}>{{$subscription->subscription_name}}</option>
                                    @endforeach                                         
                                </select>
                                @if($errors->has('subscription_id'))
                                <span class="text-danger">
                                    <strong>{{ $errors->first('subscription_id') }}</strong>
                                </span>
                                @endif
                            </div>
                            @if($price->subscription_id == 2 || $price->subscription_id == 3)
                            <div class="col-md-6 form-group mb-3 other_subscription" id="other_subscription">
                                <label>{{__('test.payment_type')}}<span class="required">&#42;</span></label>
                                <select name="payment_type" class="form-control" id="payment_type">
                                        <option value="" disabled selected hidden>{{__('test.select-payment-type')}}</option> 
                                        <option value="Monthly" {{ $price->payment_type == "Monthly" ? 'selected' : '' }}>Monthly</option>
                                        <option value="Annual" {{ $price->payment_type == "Annual" ? 'selected' : '' }}>Annual</option>
                                    </select>
                                    @if($errors->has('payment_type'))
                                    <span class="text-danger">
                                        <strong>{{ $errors->first('payment_type') }}</strong>
                                    </span>
                                    @endif
                            </div>
                            @else
                            <div class="col-md-6 form-group mb-3 other_subscription" id="other_subscription" style="display:none;">
                                <label>{{__('test.payment_type')}}<span class="required">&#42;</span></label>
                                <select name="payment_type" class="form-control" id="payment_type">
                                        <option value="" disabled selected hidden>{{__('test.select-payment-type')}}</option> 
                                        <option value="Monthly">Monthly</option>
                                        <option value="Annual">Annual</option>
                                    </select>
                                    @if($errors->has('payment_type'))
                                    <span class="text-danger">
                                        <strong>{{ $errors->first('payment_type') }}</strong>
                                    </span>
                                    @endif
                            </div>
                            @endif
                            <div class="col-md-6 form-group mb-3">
                                    <label>{{__('test.price')}}<span class="required">&#42;</span></label>
                                    <input type="text" name="price" id="price" placeholder="En Quetzales" class="form-control" autocomplete="off" value="{{$price->price}}">
                                    @if($errors->has('price'))
                                    <span class="text-danger">
                                        <strong>{{ $errors->first('price') }}</strong>
                                    </span>
                                    @endif
                            </div>
                            <div class="col-md-12">
                                    <a class="btn btn-primary" href="{{route('admin.price.matrix.index')}}">{{__('test.cancel')}}</a>
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
<script src="{{ asset('assets/custom/js/admin/price_matrix.js')}}"></script>
@endpush

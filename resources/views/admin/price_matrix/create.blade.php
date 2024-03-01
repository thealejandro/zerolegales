@extends('admin.layouts.master')
@section('pageTitle',__('test.add-price'))
@section('content')
    <div class="breadcrumb">
        <h1>{{__('test.add-price')}}</h1>
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
                    <div class="card-title mb-3">{{__('test.add-price')}}</div>
                        {{ Form::open(['route' => 'admin.price.matrix.store', 'class' => 'kt-form', 'id'=>'price_matrix_form','role' => 'form', 
                                    'method' => 'post']) }}
                        <div class="row">
                            <div class="col-md-6 form-group mb-3">
                                <label>{{__('test.subscription-type')}}<span class="required">&#42;</span></label>
                                <select name="subscription_id" class="form-control" id="subscription_id">
                                    <option value="" disabled selected hidden>{{__('test.select-subscription-type')}}</option> 
                                    @foreach($subscriptions as $subscription)
                                    <option value="{{$subscription->id}}">{{$subscription->subscription_name}}</option>
                                    @endforeach                                         
                                </select>
                                @if($errors->has('subscription_id'))
                                <span class="text-danger">
                                    <strong>{{ $errors->first('subscription_id') }}</strong>
                                </span>
                                @endif
                            </div>
                            <div class="col-md-6 form-group mb-3" id="one_time" style="display:none">
                                <label>{{__('test.legal-document-template')}}<span class="required">&#42;</span></label>
                                <select name="document_id" class="form-control" id="document_id">
                                    <option value="" disabled selected hidden>{{__('test.select-legal-document-template')}}</option> 
                                    @foreach($documents as $document)
                                    <option value="{{$document->id}}">{{$document->document_name}}</option>
                                    @endforeach                                         
                                </select>
                                @if($errors->has('document_id'))
                                <span class="text-danger">
                                    <strong>{{ $errors->first('document_id') }}</strong>
                                </span>
                                @endif
                            </div>
                            <div class="col-md-6 form-group mb-3 other_subscription" id="other_subscription" style="display:none">
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
                            <div class="col-md-6 form-group mb-3">
                                    <label>{{__('test.price')}}<span class="required">&#42;</span></label>
                                    <input type="text" name="price" id="price" placeholder="En Quetzales" class="form-control" autocomplete="off">
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

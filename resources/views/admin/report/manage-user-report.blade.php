
@extends('admin.layouts.master')
@section('content')
                                               
<div class="breadcrumb">
        <h1>{{__('test.price-matrix')}}</h1>
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
                    @include('admin.includes.flash-message')
                    <div class="card-title mb-3">{{__('test.price-matrix')}}</div>
                    <!-- <div class="px-2 ml-auto">
                        <a href="{{route('admin.price.matrix.create')}}" class="btn btn-raised btn-raised-primary btn-lg btn-rounded m-1 float-right">
                            {{__('test.add-price')}}
                        </a>
                    </div> -->


                <div class="row mx-0 payment_filter">
                   
                    <div class="col-lg-3">
                        <div class="form-group">
                            <label for="picker2">From</label>
                            <input id="picker4" class="form-control picker__input picker4" placeholder="yyyy-mm-dd" name="from_date" readonly="" aria-haspopup="true" aria-expanded="false" aria-readonly="false" aria-owns="picker2_root">
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group">
                            <label for="picker3">To</label>
                            <input id="picker5" class="form-control picker__input picker5" placeholder="yyyy-mm-dd" name="to_date" readonly="" aria-haspopup="true" aria-expanded="false" aria-readonly="false" aria-owns="picker2_root">
                        </div>
                    </div>

                    
                </div>

                <div class="table-responsive">
                    <table id="user_report_datatable" class="display table table-striped table-bordered" style="width:100%">
                        <thead>
                        <tr>
                            <!-- <th>id</th> -->
                            <th>Nombre completo</th>
                            <th>Email</th>
                            <th>Fecha de registro</th>
                            <th>Suscripción</th>
                            <th>Caducidad de la suscripción</th>
                        </tr>
                        </thead>
                        <tbody id="payment_tbody_p1">
                 
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>   
</div>

@endsection
@push('js')
<script>
    $('div.alert').not('.alert-important').delay(3000).fadeOut(350);

    $(document).ready(function () {

        $('#picker3').pickadate(
        {
            maxDate: new Date()
        });
    });

</script>
<script src="{{ asset('assets/custom/js/admin/report.js')}}"></script>

@endpush
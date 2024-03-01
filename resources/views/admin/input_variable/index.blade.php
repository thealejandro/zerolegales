@extends('admin.layouts.master')
@section('pageTitle',__('test.input-variable'))
@section('content')
    <div class="breadcrumb">
        <h1>{{__('test.input-variable')}}</h1>
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
                    @include('admin.includes.flash-message')
                    <div class="card-title mb-3">{{__('test.input-variable')}}</div>
                    <div class="px-2 ml-auto">
                        <a href="{{route('admin.input.variable.create')}}" class="btn btn-raised btn-raised-primary btn-lg btn-rounded m-1 float-right">
                            {{__('test.add-input-variable')}}
                        </a>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered" id="variableTable">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>{{__('test.variable-name')}}</th>
                                    <th>{{__('test.variable-type')}}</th>
                                    <th>{{__('test.created-at')}}</th>
                                    <th data-orderable="false">{{__('test.action')}}</th>

                                </tr>
                            </thead>
                            <tbody>
                                @if($variables->count())
                                    @foreach ($variables as $key=>$dat)
                                    <tr>
                                        <td>{{ ++$key }}</td>
                                        <td>{{$dat->variable_name}}</td>
                                        <td>{{$dat->variableType->variable_type}}</td>
                                        <td>{{$dat->created_at}}</td>
                                        <td>
                                            <a href="{{route('admin.input.variable.edit',$dat->id)}}" title="{{__('test.edit')}}" class="btn btn-primary btn-rounded m-1" ><i style="font-size: 1.3rem;" class="i-File-Edit"></i></a>
                                            <a href="javascript:void(0)" class="btn btn-danger btn-rounded m-1 deleteVariable" data-id="{{ $dat->id }}" data-auth="{{\Auth::guard('admin')->user()->id}}" title="{{__('test.delete')}}"><i style="font-size: 1.3rem;" class="i-Delete-File"></i></a>
                                        </td>
                                        @endforeach
                                @endif
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
    $('div.alert').not('.alert-important').delay(5000).fadeOut(350);
</script>
<script src="{{ asset('assets/custom/js/admin/variable.js')}}"></script>
@endpush
@extends('admin.layouts.master')
@section('pageTitle',__('test.terms-conditions'))
@section('content')
    <div class="breadcrumb">
        <h1>{{__('test.terms-conditions')}}</h1>
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
                    @include('admin.includes.flash-message')
                    <div class="card-title mb-3">{{__('test.terms-conditions')}}</div>
                    <div class="px-2 ml-auto">
                        <!-- <a href="{{route('admin.terms-conditions.create')}}" class="btn btn-raised btn-raised-primary btn-lg btn-rounded m-1 float-right">
                            {{__('test.add-terms-conditions')}}
                        </a> -->
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered" id="termsTable">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>{{__('test.terms-conditions')}}</th>
                                    <th>{{__('test.created-at')}}</th>
                                    <th data-orderable="false">{{__('test.action')}}</th>

                                </tr>
                            </thead>
                            <tbody>
                                @if($terms->count())
                                    @foreach ($terms as $key=>$dat)
                                    <tr>
                                        <td>{{ ++$key }}</td>
                                        <td>{{$dat->condition_name}}</td>
                                        <td>{{$dat->created_at}}</td>
                                        <td>
                                            <a href="{{route('admin.terms-conditions.edit',$dat->id)}}" title="{{__('test.edit')}}" class="btn btn-primary btn-rounded m-1" ><i style="font-size: 1.3rem;" class="i-File-Edit"></i></a>
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
<script src="{{ asset('assets/custom/js/admin/terms_conditions.js')}}"></script>
@endpush
@extends('admin.layouts.master')
@section('pageTitle',__('test.legal-document-template'))
@section('content')
    <div class="breadcrumb">
        <h1>{{__('test.legal-document-template')}}</h1>
        <ul>
            <li>{{__('test.home')}}</li>
            <li><a href="{{route('admin.template.index')}}">{{__('test.legal-document-template')}}</a></li>
        </ul>
    </div>
    <div class="separator-breadcrumb border-top"></div>
    <div class="row">
        <div class="col-md-12">
            <div class="card mb-4">
                <div class="card-body">
                    @include('admin.includes.flash-message')
                    <div class="card-title mb-3">{{__('test.legal-document-template')}}</div>
                    <div class="px-2 ml-auto">
                        <a href="{{route('admin.template.create')}}" class="btn btn-raised btn-raised-primary btn-lg btn-rounded m-1 float-right">
                        {{__('test.create-legal-document-template')}}
                        </a>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered" id="templateTable">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>{{__('test.template-type')}}</th>
                                    <th>{{__('test.document-category')}}</th>
                                    <th>{{__('test.document-name')}}</th>
                                    <th>{{__('test.price')}}</th>
                                    <th>{{__('test.created-at')}}</th>
                                    <th data-orderable="false">{{__('test.status')}}</th>
                                    <th data-orderable="false">{{__('test.action')}}</th>

                                </tr>
                            </thead>
                            <tbody>
                            @if($templates->count())
                                @foreach ($templates as $key=>$dat)
                                <tr>
                                    <td>{{ ++$key }}</td>
                                    <td>{{$dat->documentType->type_name}}</td>
                                    <td>{{$dat->category->category_name}}</td>
                                    <td>{{$dat->document_name}}</td>
                                    <td>{{$dat->price}}</td>
                                    <td>{{$dat->created_at}}</td>
                                    <td>
                                        <input data-id="{{$dat->id}}" type="checkbox" id="toggle-two_{{$key}}" class="toggle-class-status" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="{{__('test.active')}}" data-off="{{__('test.inactive')}}" {{ $dat->is_active ? 'checked' : '' }}></input>
                                    </td>
                                    <td>
                                        <a href="{{route('admin.template.edit',$dat->id)}}" title="{{__('test.edit')}}" data-id="{{$dat->id}}" class="btn btn-primary btn-rounded m-1" ><i style="font-size: 1.3rem;" class="i-File-Edit"></i></a>
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
</section>
@endsection
@push('js')
<script>
    $('div.alert').not('.alert-important').delay(5000).fadeOut(350);
</script>
<script src="{{ asset('assets/custom/js/admin/template.js')}}"></script>
@endpush
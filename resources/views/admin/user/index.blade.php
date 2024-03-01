@extends('admin.layouts.master')
@section('pageTitle',__('test.users'))
@section('content')
    <div class="breadcrumb">
        <h1>{{__('test.users')}}</h1>
        <ul>
            <li>{{__('test.home')}}</li>
            <li><a href="{{route('admin.users.index')}}">{{__('test.users')}}</a></li>
        </ul>
    </div>
    <div class="separator-breadcrumb border-top"></div>
    <div class="row">
        <div class="col-md-12">
            <div class="card mb-4">
                <div class="card-body">
                    @include('admin.includes.flash-message')
                    <div class="card-title mb-3">{{__('test.users')}}</div>
                    <div class="table-responsive">
                        <table class="table table-bordered" id="userTable">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>{{__('test.first-name')}}</th>
                                    <th>{{__('test.last-name')}}</th>
                                    <th>{{__('test.email')}}</th>
                                    <th>{{__('test.created-at')}}</th>
                                    <th data-orderable="false">{{__('test.status')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($users->count())
                                    @foreach ($users as $key=>$dat)
                                    <tr>
                                        <td>{{ ++$key }}</td>
                                        <td>{{$dat->first_name}}</td>
                                        <td>{{$dat->surname}}</td>
                                        <td>{{$dat->email}}</td>
                                        <td>{{$dat->created_at}}</td>
                                        <td><input data-id="{{$dat->id}}" type="checkbox" id="toggle-two_{{$key}}" class="toggle-class-status" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="{{__('test.active')}}" data-off="{{__('test.inactive')}}" {{ $dat->is_active ? 'checked' : '' }}></input></td>
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
<script src="{{ asset('assets/custom/js/admin/users.js')}}"></script>
@endpush
@extends('admin.layouts.master')
@section('pageTitle',__('test.lawyers-directory'))
@section('content')
    <div class="breadcrumb">
        <h1>{{__('test.lawyers-directory')}}</h1>
        <ul>
            <li>{{__('test.home')}}</li>
            <li><a href="{{route('admin.category.index')}}">{{__('test.lawyers-directory')}}</a></li>
        </ul>
    </div>
    <div class="separator-breadcrumb border-top"></div>
    <div class="row">
        <div class="col-md-12">
            <div class="card mb-4">
                <div class="card-body">
                    @include('admin.includes.flash-message')
                    <div class="card-title mb-3">{{__('test.lawyers-directory')}}</div>
                    <div class="px-2 ml-auto">
                        <a href="{{route('admin.lawyers.directory.create')}}" class="btn btn-raised btn-raised-primary btn-lg btn-rounded m-1 float-right">
                        {{__('test.add-lawyers-directory')}}
                        </a>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered" id="directoryTable">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>{{__('test.lawyer-name')}}</th>
                                    <th>{{__('test.lawyer-address')}}</th>
                                    <th>{{__('test.zone')}}</th>
                                    <th>{{__('test.township')}}</th>
                                    <th>{{__('test.department or state')}}</th>
                                    <th>{{__('test.mobile-phone')}}</th>
                                    <th>{{__('test.email')}}</th>
                                    <th>{{__('test.created-at')}}</th>
                                    <th data-orderable="false">{{__('test.status')}}</th>
                                    <th data-orderable="false">{{__('test.action')}}</th>

                                </tr>
                            </thead>
                            <tbody>

                                @if($directories->count())
                                @foreach ($directories as $key=>$dat)
                                <tr>
                                    <td>{{ ++$key }}</td>
                                    <td>{{$dat->lawyer_name}}</td>
                                    <td>{{$dat->lawyer_address}}</td>
                                    <td>{{$dat->zone}}</td>
                                    <td>{{$dat->township}}</td>
                                    <td>{{$dat->department}}</td>
                                    <td>{{$dat->phone}}</td>
                                    <td>{{$dat->email}}</td>
                                    <td>{{$dat->created_at}}</td>
                                    <td>
                                        <input data-id="{{$dat->id}}" type="checkbox" id="toggle-two_{{$key}}" class="toggle-class-status" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="{{__('test.active')}}" data-off="{{__('test.inactive')}}" {{ $dat->is_active ? 'checked' : '' }}></input>
                                    
                                    </td>
                                    <td>
                                        <a href="{{route('admin.lawyers.directory.edit',$dat->id)}}" title="{{__('test.edit')}}" class="btn btn-primary btn-rounded m-1" ><i style="font-size: 1.3rem;" class="i-File-Edit"></i></a>
                                        <!-- <a href="javascript:void(0)" data-toggle="modal" data-id="{{$dat->id}}" id="editPriceForm" title="{{__('test.assign-price')}}" class="btn btn-primary btn-rounded m-1"><i style="font-size: 1.3rem;" class="i-Add-File"></i></a> -->
                                        <a href="javascript:void(0)" class="btn btn-danger btn-rounded m-1 deleteDirectory" data-id="{{ $dat->id }}" data-auth="{{\Auth::guard('admin')->user()->id}}" title="{{__('test.delete')}}">
                                        <i style="font-size: 1.3rem;" class="i-Delete-File"></i></a>
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
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="verifyModalContent" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{__('test.assign-price')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="priceForm" method="post" action="#">
                <div class="modal-body">
                    <div class="col-md-12 form-group mb-3">
                        <input type="hidden" name="id" id="directory_id">
                        <label>{{__('test.price')}}<span class="required">&#42;</span></label>
                        <input type="text" name="price" id="price" placeholder="En Quetzales" class="form-control" autocomplete="off">
                        <span class="text-danger"></span>

                    </div>
                </div>
                <div class="modal-footer">
                    <input type="submit" class="btn btn-primary save" value="{{__('test.save')}}">
                </div>
            </form>
        </div>
    </div>
</div>
</section>
@endsection
@push('js')
<script>
    $('div.alert').not('.alert-important').delay(5000).fadeOut(350);
</script>
<script src="{{ asset('assets/custom/js/admin/lawyers_directory.js')}}"></script>
@endpush
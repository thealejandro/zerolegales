@extends('admin.layouts.master')

@section('content')
   <div class="breadcrumb">
      <h1 class="mr-2">{{__('test.home')}}</h1>
      <ul>
          <li><a href="">{{__('test.home')}}</a></li>
          <li>{{__('test.home')}}</li>
      </ul>
  </div>
  <div class="separator-breadcrumb border-top"></div>
  <div class="row">
        <div class="col-md-12">
            <div class="card mb-4">
                <div class="card-body">{{__('test.Hi-Admin')}}</div>
            </div>
        </div>
    </div>
@endsection

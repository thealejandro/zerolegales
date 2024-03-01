@extends('front.layouts.master')
@section('pageTitle',__('test.Document In Progress'))
@section('content')
    <main class="documentlist-page document-process-page">
    <section class="cat-list-wrap">
                <div class="container" >
                    <div class="list-doc-wrap">
                        <div class="page-head-process">
                            <div class="row d-flex justify-content-between align-items-center">
                                <div class="col-md-9 p-0 col-sm-12">
                                    <div class="HeadlineH2-2">
                                    Documentos en Progreso
                                    </div>
                                </div>
                                <div class="col-md-3 p-0 col-sm-12 contact-center">
                                    <a href="mailto:anjalykjoy@gmail.com" class="btn btn-comon btn-blue btn-w-icon " ><i class="icon-icons-email"></i>Contactar a Soporte </a>
                                </div>
                            </div>
                        </div>
                        @if($documents->count()==0)
                            <div class="row empty-doc">
                                <div class="col-md-6">
                                    <div class="d-flex">
                                        <figure>
                                        <img class="mr-3 img-fluid lazyload" src="{{asset('front/assets/img/documentlist/con_1.png')}}"  alt="empty-doc">
                                        </figure>
                                        <div class=" align-self-center">
                                            <h5 class="mt-0  HeadlineH4-2">Aún no tiene documentos en progreso.</h5>
                                            <p class="BodyBody-2 mb-0">En esta sección aparecerán sus documentos en progreso, los cuales podrá completar en el futuro.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                        <div class="row">
                            @foreach($documents as $progress)                              
                                <div class="col-lg-3">
                                    @if($progress->legalization_id)
                                        <div class="card card-common">
                                            <a href="{{route('user.document.purchase.after',[$progress['document_id'],$progress['document_template_id']])}}" class="link_new_window">  </a>
                                            <div class="card-img-cen">
                                                <img class="card-img-top" src="{{ asset('storage/'.$progress->document_image)}}" alt="Contract 1">
                                            </div>
                                            <div class="card-body">
                                                <h5 class="card-title">{{$progress->document_name}}</h5>
                                                <h6 class="card-subtitle">{{$progress->category_name}}</h6>
                                                <p class="card-text">  {{ str_limit(strip_tags($progress->document_description),100)}}
                                                @if (strlen(strip_tags($progress->document_description)) > 100)
                                                ... <a href="{{route('user.document.purchase.after',[$progress['document_id'],$progress['document_template_id']])}}">{{__('test.MORE')}} </a>
                                                @endif</p>
                                                @if(Auth::user()->user_type==1||Auth::user()->user_type==3)

                                                <div class="exp-date">
                                                @php $date = $progress->created_at->addDays(30)->toDateString(); $exp_date = date("d/m/Y", strtotime($date));@endphp
                                                Expira: {{$exp_date}}
                                                </div>                                              
                                                @endif
                                            
                                            </div>
                                            
                                        </div>
                                  
                                    @else
                                 
                                     <div class="card card-common" >
                                     <a href="{{route('user.nosubscription.show.buy.fill',[$progress['document_id'],$progress['document_template_id']])}}" class="link_new_window"></a>
                                        <div class="card-img-cen">
                                            <img class="card-img-top" src="{{ asset('storage/'.$progress->document_image)}}" alt="Contract 1">
                                        </div>
                                        <div class="card-body">
                                            <h5 class="card-title">{{$progress->document_name}}</h5>
                                            <h6 class="card-subtitle">{{$progress->category_name}}</h6>
                                            <p class="card-text">  {{ str_limit(strip_tags($progress->document_description),100)}}
                                                @if (strlen(strip_tags($progress->document_description)) > 100)
                                                ... <a href="{{route('user.nosubscription.show.buy.fill',[$progress['document_id'],$progress['document_template_id']])}}}">{{__('test.MORE')}} </a>
                                                @endif</p>
                                                @if(Auth::user()->user_type==1||Auth::user()->user_type==3)
                                                <div class="exp-date">
                                                @php $date = $progress->created_at->addDays(30)->toDateString();$exp_date = date("d/m/Y", strtotime($date)); @endphp
                                                Expira: {{$exp_date}}
                                                </div>                                              
                                                @endif
                                        
                                        </div>
                                        
                                    </div>
                                
                                    @endif
                                   
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
        </section>
    </main>
@endsection
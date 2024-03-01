@extends('front.layouts.main')
@section('pageTitle',__('test.Document List'))
@section('content')
<main class="documentlist-page">
    <section class="search-wrap">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="max_search_center">
                        <div class="input-group">
                            @guest
                            <input type="search" class="form-control search-doc" name="search" placeholder="Buscar" id="search-input">
                            <div class="input-group-append">
                                <button class="btn" type="button" id="search-btn">
                                    <i class="icon-icons-search"></i>
                                </button>
                            </div>
                            @endguest
                            @if (Auth::check())
                            <input type="search" class="form-control search-doc" name="search" placeholder="Buscar" id="search-input">
                            <div class="input-group-append">
                                <button class="btn" type="button" id="search-btn">
                                    <i class="icon-icons-search"></i>
                                </button>
                            </div>
                            @endif
                           
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="cat-list-wrap">
            <div class="container">
                <div class="cat-list">
                    <div class="list-cat">
                        <div class="cat-title">
                            Categorías:
                        </div>
                        <!-- mobile category filter -->
                        <div class="cat-mobile-sel">

                            <div class="dropdown custom_dropdown_menu custom-dropdown-normal" id="filtermobileselect">
                                <a class="btn btn-secondary dropdown-toggle " href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <p class="mb-0 dropdown-select-2">Elegir la categoría</p>
                                    <i class="icon-icons-arrow-chevron-down"></i>
                                </a>
                                <div class="dropdown-menu mCustomScrollbar dropdcst button-group-mb filters-button-group drop-down-sort" aria-labelledby="dropdownMenuLink">
                                    <li class="" data-filter="*">
                                        <a class="dropdown-item d-flex justify-content-between active" href="javascript:">
                                            <h6>Todas</h6>
                                            <span class="check-marked-normal icon-icons-checkmark-checkmark-1"></span>
                                        </a>
                                    </li>
                                    @foreach($categories as $category)
                                    <li data-filter=".{{strtolower($category->category_name)}}">
                                        <a class="dropdown-item d-flex justify-content-between ">
                                            <h6>{{$category->category_name}}</h6>
                                            <span class="check-marked-normal icon-icons-checkmark-checkmark-1"></span>
                                        </a>
                                    </li>
                                    @endforeach
                                    <!-- <li data-filter=".testamentos">
                                        <a class="dropdown-item d-flex justify-content-between">
                                            <h6>Testamentos</h6>
                                            <span class="check-marked-normal icon-icons-checkmark-checkmark-1"></span>
                                        </a>
                                    </li>
                                    <li data-filter=".pagarés">
                                        <a class="dropdown-item d-flex justify-content-between">
                                            <h6>Pagarés</h6>
                                            <span class="check-marked-normal icon-icons-checkmark-checkmark-1"></span>
                                        </a>
                                    </li>
                                    <li data-filter=".listados">
                                        <a class="dropdown-item d-flex justify-content-between">
                                            <h6>Listados</h6>
                                            <span class="check-marked-normal icon-icons-checkmark-checkmark-1"></span>
                                        </a>
                                    </li> -->



                                </div>
                            </div>

                        </div>
                        <!-- mobile category filter end-->

                        <!-- <ul class=" button-group desk-cat-view list-inline filter-button-group">
                        <li class="list-inline-item b is-checked" data-filter="*"> <a href="#">Todas</a></li>
                        <li class="list-inline-item b" data-filter=".contratos"> <a href="#">Contratos</a></li>
                        <li class="list-inline-item b" data-filter=".testamentos"> <a href="#">Testamentos</a></li>
                        <li class="list-inline-item b" data-filter=".pagarés"><a>alkali and alkaline-earth</a></li>
                        <li class="list-inline-item b" data-filter=".listados"><a>snot transition</a></li>

                        </ul> -->
                        <ul class="list-inline desk-cat-view button-group filters-button-group">
                            <li class="list-inline-item active is-checked" data-filter="*">
                                <a >Todas</a>
                            </li>
                            @foreach($categories as $category)
                            <li class="list-inline-item" data-filter=".{{strtolower($category->category_name)}}">
                                <a >{{$category->category_name}}</a>
                            </li>
                            @endforeach
                            <!-- <li class="list-inline-item" data-filter=".testamentos">
                                <a >Testamentos</a>
                            </li>
                            <li class="list-inline-item" data-filter=".pagarés">
                                <a >Pagarés</a>
                            </li>
                            <li class="list-inline-item" data-filter=".listados">
                                <a >Listados</a>
                            </li> -->

                        </ul>
                    </div>
                </div>

            <div class="list-doc-wrap">
                <div class="row grid">
                    @if(isset($templates) && !empty($templates))
                    @foreach ($templates as $key => $template_list)
                        @foreach($template_list as $template)
                            <div class="col-lg-3 element-item {{strtolower($key)}}" data-category="{{strtolower($key)}}">
                                @guest
                                    <div class="card card-common" data-toggle="modal" data-target="#modalSignIn">
                                        <div class="card-img-cen">                                       
                                            <img class="card-img-top lazyload" src="{{ asset('storage/'.$template->document_image)}}" alt="Contract 1">
                                    
                                        </div>
                                        <div class="card-body">
                                            <h5 class="card-title">{{$template->document_name}}</h5>
                                            <h6 class="card-subtitle">{{$template->category->category_name}}</h6>                
                                            <p class="card-text">  {{ str_limit(strip_tags($template->document_description),100)}}
                                            @if (strlen(strip_tags($template->document_description)) > 100)
                                            ... <a data-toggle="modal" data-target="#modalSignIn">{{__('test.MORE')}}</a>
                                            @endif</p>
                                        </div>
                                        <div class="extra-price-bt">
                                            <h4 class="price-show">Q.{{$template->price}}</h4>
                                        </div>
                                    </div>
                                @endguest

                                @if((Auth::check()))                            
                                    <div class="card card-common">
                                        <a href="{{route('user.document.show',$template->id)}}" class="link_new_window"></a>
                                        <div class="card-img-cen">                                       
                                                <img class="card-img-top lazyload" src="{{ asset('storage/'.$template->document_image)}}" alt="Contract 1">                                    
                                        </div>
                                        <div class="card-body">
                                            <h5 class="card-title">{{$template->document_name}}</h5>
                                            <h6 class="card-subtitle">{{$template->category->category_name}}</h6>
                                            <p class="card-text">  {{ str_limit(strip_tags($template->document_description),100)}}
                                            @if (strlen(strip_tags($template->document_description)) > 100)
                                            ... <a href="{{route('user.document.show',$template->id)}}">{{__('test.MORE')}} </a>
                                            @endif</p>
                                        </div>
                                        @if(\Auth::user()->user_type !=2)
                                            <a href="{{route('user.document.show',$template->id)}}">
                                                <div class="extra-price-bt">
                                                    <h4 class="price-show">Q.{{$template->price}}</h4>
                                                </div>
                                            </a>
                                        @endif                                      
                                    </div>                                                          
                                @endif
                            </div>
                        @endforeach
                    @endforeach
                    @endif
                </div>
            </div>
        </div>
    </section>

    <section class="view-sub">
        <div class=" d-block d-md-none ">
            <div class="pen-foot">
                <img src="{{asset('front/assets/img/penfoot.png')}}" class="img-fluid lazyload" />
            </div>
        </div>
        <div class="container-fluid">
            <div class="row flx-vcenter">
                <div class="col-lg-3">
                    <div class="left_foot_img">
                        <img class="img-fluid lazyload" src="{{asset('front/assets/img/documentlist/foot_con.png')}}" />
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="center-content">
                        <h6 class="HeadlineH4-2 ">Estos son los documentos a los que tiene acceso.</h6>
                        <h3 class="HeadlineH2-2 ">Mire nuestras suscripciones.</h3>
                        <a href="{{route('user.price')}}" class="btn btn-comon btn-blue">Ver Suscripciones</a>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="right_foot_img">
                        <img class="img-fluid lazyload" src="{{asset('front/assets/img/documentlist/trans_book.png')}}" />
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
    <!-- modal -->
    @guest
    <!-- Modal for Registration-->
    <div class="modal fade" id="modalSignIn" tabindex="-1" role="dialog" aria-labelledby="modalSignInLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
            <button type="button" class="close mdl-cls" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="icon-icons-close-close-1"></i></span>
                    </button>
                <div class="modal-body">
               <div class="row flx-vcenter">
                   <div class="col-md-5">
                       <div class="helloIllustraction">
                           <img src="{{asset('front/assets/img/illustraction/hello.png')}}" class="img-fluid lazyload"/>
                       </div>
                   </div>
                   <div class="col-md-7">
                       <div class="SignContentModal">
                       <h2 class="HeadlineH2-2">¡Al parecer no ha iniciado sesión!</h2>
                       <h4 class="HeadlineH4-2 ">Inicie sesión para poder ingresar a los documentos. O también puede registrar una nueva cuenta para tener acceso a ellos. </h4>
                       <div class="reg-bt-choose">
                       <a href="{{route('login')}}" class="btn btn-comon btn-blue">Iniciar Sesión</a>
                       <a href="{{route('user.create')}}" class="btn btn-comon btn-blue-outline">Registrarse</a>
                       </div>
                    </div>
                   </div>
                   
               </div>
                </div>
              
            </div>
        </div>
    </div>
   <!-- Modal for Registration-->
   @endguest
    <!-- modal end -->
@endsection
@push('js')
<script>
    var document_search = "{{route('document.search')}}";
    var search_document ="{{route('user.document.search')}}";
</script>
<script src="{{ asset('front/assets/custom/js/document_list.js')}}"></script>

@endpush
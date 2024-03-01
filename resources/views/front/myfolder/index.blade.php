@extends('front.layouts.master')
@section('pageTitle',__('test.My folder'))
@section('content')
    @guest  
        <main class="subscription-page subscribe-page">
            <section class="form-filling-wrap">
                <div class="container">
                    <div class="row flx-vcenter">
                        <div class="col-lg-6">
                            <div class="illustra-img">
                                <img src="{{asset('front/assets/img/illustraction/people.png')}}"  class="lazyload"/>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="subscribe-content">
                                <h2 class="HeadlineH2-2">¡Hola! Al parecer no tiene acceso a esta función. </h2>
                                <p class="BodyBody-2">La opción de <span>Mi Carpeta</span> solo está disponible para los suscriptores premium. Mi carpeta permite guardar los documentos que desee para poder descargarlos más de una vez y poder asignarles un nombre único a cada uno. </p>
                                <div class="purchase-bt">
                                <a href="{{route('price.index')}}" class="btn btn-comon btn-blue">Adquirir Suscripción Premium</a>                           
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </main>
    @endguest
    @if(Auth::check())
    @if(Auth::user()->user_type !=2)  
    <main class="subscription-page subscribe-page">
        <section class="form-filling-wrap">
            <div class="container">
                <div class="row flx-vcenter">
                    <div class="col-lg-6">
                        <div class="illustra-img">
                            <img src="{{asset('front/assets/img/illustraction/people.png')}}"  class="lazyload"/>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="subscribe-content">
                            <h2 class="HeadlineH2-2">¡Hola! Al parecer no tiene acceso a esta función. </h2>
                            <p class="BodyBody-2">La opción de <span>Mi Carpeta</span> solo está disponible para los suscriptores premium. Mi carpeta permite guardar los documentos que desee para poder descargarlos más de una vez y poder asignarles un nombre único a cada uno. </p>
                            <div class="purchase-bt">
                            @guest
                            <a href="{{route('price.index')}}" class="btn btn-comon btn-blue">Adquirir Suscripción Premium</a>
                            @endguest
                            @if (Auth::check())
                            <a href="{{route('user.price')}}" class="btn btn-comon btn-blue">Adquirir Suscripción Premium</a>
                            @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
   @else
        <main class="documentlist-page subscribe-list-page">
            <section class="search-wrap">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="max_search_center">
                                <div class="input-group">
                                    <input type="search" class="form-control search-doc" name="search" placeholder="Buscar" id="search-input">
                                    <div class="input-group-append">
                                        <button class="btn " type="button" id="search-btn">
                                            <i class="icon-icons-search"></i>
                                        </button>
                                    </div>
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
                                            <a class="dropdown-item d-flex justify-content-between " href="javascript::">
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
                                        <!-- <li data-filter=".contratos">
                                            <a class="dropdown-item d-flex justify-content-between">
                                                <h6>Contratos</h6>
                                                <span class="check-marked-normal icon-icons-checkmark-checkmark-1"></span>
                                            </a>
                                        </li>
                                        <li data-filter=".testamentos">
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
                            <!-- desktop category filter -->
                            <ul class="list-inline desk-cat-view button-group filters-button-group">
                                <li class="list-inline-item active is-checked" data-filter="*">
                                    <a >Todas</a>
                                </li>
                                @foreach($categories as $category)
                                <li class="list-inline-item" data-filter=".{{strtolower($category->category_name)}}">
                                    <a >{{$category->category_name}}</a>
                                </li>
                                @endforeach
                                <!-- <li class="list-inline-item" data-filter=".contratos">
                                    <a href="#">Contratos</a>
                                </li>
                                <li class="list-inline-item" data-filter=".testamentos">
                                    <a href="#">Testamentos</a>
                                </li>
                                <li class="list-inline-item" data-filter=".pagarés">
                                    <a href="#">Pagarés</a>
                                </li>
                                <li class="list-inline-item" data-filter=".listados">
                                    <a href="#">Listados</a>
                                </li> -->

                            </ul>
                                        <!-- desktop category filter end -->

                            <!-- sort filter -->

                            <!-- <div class="filter-sort-wrap">
                                <label>
                                    Ordenar por:
                                </label>
                                <div class="dropdown custom_dropdown_menu custom-dropdown-normal" id="filtersort"> -->
                                    <!-- add "disabled" class to a tag when there no documents -->
                                    <!-- <a class="btn btn-secondary dropdown-toggle disabled" href="#" role="button" id="dropdownSort" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <p class="mb-0 dropdown-select-2">
                                            Ordenar por</p>
                                        <i class="icon-icons-arrow-chevron-down"></i>
                                    </a>
                                    <div class="dropdown-menu mCustomScrollbar dropdcst " aria-labelledby="dropdownSort">
                                        <li class="">
                                            <a class="dropdown-item d-flex justify-content-between  " href="javascript::">
                                                <h6>Más reciente</h6>
                                                <span class="check-marked-normal icon-icons-checkmark-checkmark-1"></span>
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item d-flex justify-content-between">
                                                <h6>
                                                    Ordenar por precio</h6>
                                                <span class="check-marked-normal icon-icons-checkmark-checkmark-1"></span>
                                            </a>
                                        </li>



                                    </div>
                                </div>

                            </div> -->
                            <!-- sort filter end-->
                        </div>
                    </div>

                    <div class="list-doc-wrap">
                        @if($folders->count()==0)
                            <div class="row empty-doc">
                          
                                <div class="col-md-6">
                                    <div class="d-flex">
                                        <figure>
                                            <img class="mr-3 img-fluid" src="{{asset('front/assets/img/documentlist/con_1.png')}}" alt="empty-doc">
                                        </figure>
                                        <div class=" align-self-center">
                                            <h5 class="mt-0  HeadlineH4-2">Aún no tiene documentos guardados.</h5>
                                            <p class="BodyBody-2 mb-0">Con su suscripción ahora tiene acesso a guardar sus documentos en su carpeta. </p>
                                        </div>
                                    </div>
                                </div>
                              
                            </div>
                            @else
                            @if(isset($folders) && !empty($folders))
                                <div class="row grid">                          
                                    @foreach ($folders as $key => $folder_list)
                                        @foreach($folder_list as $folder)
                                            <div class="col-lg-3 element-item {{strtolower($key)}}" data-category="{{strtolower($key)}}">
                                                <div class="card card-common" >
                                                    <a href="{{route('user.myfolder.show',$folder->id)}}" class="link_new_window"></a>
                                                    <div class="card-img-cen">
                                                        <img class="card-img-top" src="{{ asset('storage/'.$folder->document_image)}}" alt="Contract 1">
                                                    </div>
                                                    <div class="card-body">
                                                        <h5 class="card-title">{{$folder->document_name}}</h5>
                                                        <h6 class="card-subtitle">{{$folder->category_name}}</h6>
                                                        <p class="card-text">  {{ str_limit(strip_tags($folder->document_description),100)}}
                                                            @if (strlen(strip_tags($folder->document_description)) > 100)
                                                            ... <a href="{{route('user.myfolder.show',$folder->id)}}">{{__('test.MORE')}}</a>
                                                            @endif
                                                        </p>
                                                    </div>
                                                </div>                                            
                                            </div>
                                        @endforeach
                                    @endforeach                                                    
                                </div>
                            @endif  
                        @endif               
                    </div>
                </div>
            </section>
        </main>
    @endif
    @endif
@endsection
@push('js')
<script>
    var folder_search ="{{route('user.folder.search')}}";
</script>
<script src="{{ asset('front/assets/custom/js/myfolder.js')}}"></script>
@endpush
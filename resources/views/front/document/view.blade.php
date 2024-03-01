@extends('front.layouts.master')
@section('pageTitle',__('test.Document No Subscription Information')) 
@section('content')
    <main class="subscription-page">
        <section class="form-filling-wrap">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="illustra-img">
                            <img src="{{ asset('storage/'.$template->document_image)}}" />
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <div class="subscribe-form-wrap">
                            <div class="breadcrumb-wrap">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item HeadlineH5-2"><a href="{{route('user.document')}}">Documentos</a></li>     
                                        @php $category = strtolower($template->category->category_name); @endphp                       
                                        <li class="breadcrumb-item HeadlineH5-2"><a href="{{route('user.document')}}#filtrar=.{{$category}}">{{$template->category->category_name}}</a></li>                                      
                                        <li class="breadcrumb-item HeadlineH5-2 active" aria-current="page">{{$template->document_name}}</li>
                                    </ol>
                                </nav>
                            </div>

                            <div class="form-section-start">
                                <div class="form-head d-flx justify-content-between align-items-center">
                                    <h2 class="HeadlineH2-2 mb-0">{{$template->document_name}}</h2>
                                    @if(\Auth::user()->user_type != 2)
                                        <h4 class="price-info mb-0">Q {{$template->price}}</h4>
                                    @endif
                                </div>
                                <div class="form-desc">
                                    <h4 class="HeadlineH4-2 ">
                                        Descripción:
                                    </h4>
                                    <p class="BodyBody-2">{{$template->document_description}}</p>
                                    <h4 class="HeadlineH4-2 m-t-24">
                                        ¿Qué información se necesita?
                                    </h4>
                                    <p class="BodyBody-2">{{$template->information_document}}</p>
                                    @if(\Auth::user()->user_type != 2)
                                        @if($template->template_type != 2)
                                        <div class="agree-text align-items-md-center align-items-sm-start d-flex color-blue mt-34">
                                            <i class="icon-icons-info"></i><span class="LinkActive-2">Para completar el proceso debe comprar el documento.</span>
                                        </div>
                                        @endif
                                    @endif
                                    @if($template->template_type != 2)
                                        <input type="hidden" name="legalization_id" id="legalization_id">         
                                        <input type="hidden" name="document_id" id="document_id" value="{{$document_id}}">
                                        <input type="hidden" name="user_id" id="user_id" value="{{\Auth::user()->id}}">
                                        <input type="hidden" name="legalization_price" id="legalization_price" class="priceValue" value="297.00">
                                        <input type="hidden" name="document_price" id="document_price" class="priceValue" value="{{$price['price']}}">
                                        <input type="hidden" name="total_price" id="total_price">
                                    @else
                                        <input type="hidden" name="document_id" id="document_id" value="{{$document_id}}">
                                        <input type="hidden" name="user_id" id="user_id" value="{{\Auth::user()->id}}">
                                        <input type="hidden" name="document_price" id="document_price" class="priceValue" value="{{$price['price']}}">
                                    @endif
                                    <div class="form-reg-bt text-center">
                                        @if(\Auth::user()->user_type != 2)
                                            @if($template->template_type == 2)
                                                <a href="{{route('user.checklist.invoice',$template->id)}}" class="btn btn-comon btn-blue">Comprar y Descargar</a>
                                            @else
                                                <a href="{{route('user.nosubscription.create.fill.buy',$template->id)}}" class="btn btn-comon btn-blue">Llenar y comprar</a>
                                                <!-- <a href="{{route('user.buy.fill.document.purchase.invoice',$template->id)}}" class="btn btn-comon btn-blue">Solo comprar</a> -->
                                            @endif
                                        @else
                                            @if($template->template_type == 2)
                                                <a href="{{route('user.checklist.download',$template->id)}}" class="btn btn-comon btn-blue">Descargar</a> 
                                            @else
                                                <a href="{{route('user.subscription.create.document.fill',$template->id)}}" class="btn btn-comon btn-blue">Llenar y comprar</a>
                                            @endif
                                        @endif
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
@push('js')
<script>
    var legalisation = "{{route('user.legalisation')}}";
    var legaldocument_change = "{{ route('user.legaldocument.change') }}";
</script>
<script src="{{ asset('front/assets/custom/js/document_view.js')}}"></script>
@endpush
<div class="row grid">
    @foreach ($templates as $template)
        @if(isset($template->category->category_name))
            <div class="col-lg-3 element-item {{strtolower($template->category->category_name)}}" data-category="{{strtolower($template->category->category_name)}}">
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
                            <h4>Q.{{$template->price}}</h4>
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
                                    <h4>Q.{{$template->price}}</h4>
                                </div>
                            </a>
                        @endif                                      
                    </div>   
                @endif
            </div>
        @endif
    @endforeach
</div>
@if($folders->count()==0)
    <div class="row empty-doc">
    
        <div class="col-md-6">
            <div class="d-flex">
                <figure>
                    <img class="mr-3 img-fluid lazyload" src="{{asset('front/assets/img/documentlist/con_1.png')}}" alt="empty-doc">
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
                            <a href="{{route('user.myfolder.show',[$folder->document_id,$folder->document_template_id])}}" class="link_new_window"></a>
                            <div class="card-img-cen">
                                <img class="card-img-top" src="{{ asset('storage/'.$folder->document_image)}}" alt="Contract 1">
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">{{$folder->document_name}}</h5>
                                <h6 class="card-subtitle">{{$folder->category_name}}</h6>
                                <p class="card-text">  {{ str_limit(strip_tags($folder->document_description),100)}}
                                    @if (strlen(strip_tags($folder->document_description)) > 100)
                                    ... <a href="{{route('user.myfolder.show',[$folder->document_id,$folder->document_template_id])}}">{{__('test.MORE')}}</a>
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
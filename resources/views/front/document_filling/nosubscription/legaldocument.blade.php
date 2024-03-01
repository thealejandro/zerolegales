<a class="btn btn-secondary dropdown-toggle " href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <p class="mb-0 dropdown-select">Seleccionar abogado</p>
        <i class="icon-icons-arrow-chevron-down"></i>
    </a>
    <div class="dropdown-menu mCustomScrollbar dropdcst" id="dropdcst" aria-labelledby="dropdownMenuLink">
        @foreach($directories as  $directory)
            <a class="dropdown-item" href="javascript:">                 
                <div class="list-group list-group-flush">
                    <span  class="list-group-item list-group-item-action flex-column align-items-start " data-id="{{ $directory->id}}">
                        <div class="wrap-loc-adr">
                            <div class="d-flex w-100 justify-content-between">
                                <h6>Lic. {{$directory->lawyer_name}}</h6>
                                <span class="check-marked icon-icons-checkmark-checkmark-1"></span>
                            </div>
                            <div class="adv-loc">
                                <ul>
                                    <li>
                                    {{$directory->lawyer_address}}
                                    </li>
                                    <li>
                                    {{$directory->zone}}
                                    </li>
                                    <li>
                                    {{$directory->department}}
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </span>
               </div>
            </a>
        @endforeach
    </div>
    <script type="text/javascript" src="{{asset('front/assets/js/main.js')}}"></script>

   <script>
     
        $(document).ready(function(){
            $("#chooselegaladvs #dropdcst a").on('click', function () {
                var directory_id =  $(this).find('.active').attr('data-id');
                $('#directory_id').val(directory_id);
                var sum = 0;
                $(".priceValue").each(function(){
                    sum += +$(this).val();
                });
                $("#total_price").val(sum);
                $('.color-blue').replaceWith('<h4 class="price-info mb-0 color-blue" id="total" >Q '+sum+'</h4>');
                $('.qnumber').replaceWith( "<div class='qnumber'>Q "+sum+"</div>" );  
                var document_id = $('#document_id').val();
                var user_id = $('#user_id').val();
                var legalization_price = $('#legalization_price').val();
                var document_price = $('#document_price').val();
                var total_price = $('#total_price').val();
                var document_template_id = $('#document_template_id').val();
                var token = $('meta[name="csrf-token"]').attr('content');
                $.ajax({
                    url: "../../../../../../legaldocument/store",
                    method: "POST",
                    data: { 'directory_id': directory_id, 'document_id': document_id, 'user_id': user_id,'document_template_id':document_template_id, 'legalization_price': legalization_price, 'document_price': document_price, 'total_price': total_price, "_token": token },
                }).done(function (data) {
                        console.log(data);
                        $('.btn-blue').removeClass('disabled');
                        $("#legalization_id").val(data.id);
                        $("#modalDocumentLegalization #legalization_id").val(data.id);
                });
                   
            });
        });

   </script>
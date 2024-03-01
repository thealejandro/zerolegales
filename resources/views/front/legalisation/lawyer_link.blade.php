<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="{{asset('front/assets/css/main.min.css')}}">
    <link rel="icon" href="{{asset('front/assets/img/favicon.ico')}}">
    <title>HerramientasLegales | Estados de legalización | Enlace para abogado</title>
</head>

<body >
<header class="main-header">
    <div class="container-fluid h-100 p-0 d-flx flx-vcenter">
        <div class="logo hl-brand-bg">

            <a href="{{route('document.index')}}"><img src="{{asset('front/assets/img/logo-horizontal.svg')}}" class="lazyload"></a>

        </div>
        <div class="header-right  d-flx flx-vcenter">
         
        </div>
    </div>
  
</header>
<div class="loader" id="loader">
    <div class="img-loader">
        <img src="{{asset('front/assets/img/loader.svg')}}"/>
    </div>
   <div class="loading-text"><span>Cargando…</span><span class = "dots">...</span></div>
  
</div>
    <main class="documentlist-page document-process-page">
        <section class="cat-list-wrap legalization-states-page">
            <div class="container">


                <div class="list-doc-wrap">
                    <div class="page-head-process">
                        <div class="row d-flex justify-content-between align-items-center">
                            <div class="col-md-9 p-0 col-sm-12">
                                <div class="HeadlineH2-2">
                                    Estado de Legalización
                                </div>
                            </div>
                            <div class="col-md-3 p-0 col-sm-12 contact-center">
                                <a href="mailto:anjalykjoy@gmail.com" class="btn btn-comon btn-blue btn-w-icon "><i class="icon-icons-email"></i>Contactar a Soporte </a>
                            </div>
                        </div>
                    </div>
                    <div class="row legal_doc">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="legalization-img">
                                        <img class="img-fluid" src="{{ asset('storage/'.$template->document_image)}}" alt="empty-doc">
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="document-data-information">
                                        <h4>
                                            Datos del Documento
                                        </h4>
                                    </div>
                                    <div class="document-data-list">

                                        <table class="legal-info-wrap">
                                            <tbody>
                                                <tr class=" row">
                                                    <td class="  col-md-5">
                                                        <div class="user-head-wi-ico">
                                                            <i class="icon-icons-person-person"></i> Usuario
                                                        </div>
                                                    </td>
                                                    <td class=" col-md-7">
                                                        <ul class="user-legal-info">
                                                            <li class="BodyBody-2">
                                                                {{$user->full_name}}
                                                            </li>
                                                            <li class="BodyBody-2">{{$user->email}}</li>
                                                        </ul>
                                                    </td>
                                                </tr>
                                                <tr class=" row">
                                                    <td class="  col-md-5">
                                                        <div class="user-head-wi-ico">
                                                            <i class="icon-icons-file-file"></i> Tipo
                                                        </div>
                                                    </td>
                                                    <td class=" col-md-7">
                                                        <ul class="user-legal-info">
                                                            <li class="BodyBody-2">
                                                               {{$template->category->category_name}}
                                                            </li>

                                                        </ul>
                                                    </td>
                                                </tr>
                                                <tr class=" row">
                                                    <td class="  col-md-5">
                                                        <div class="user-head-wi-ico">
                                                            <i class="icon-icons-calendar"></i> Fecha de Solicitud
                                                        </div>
                                                    </td>
                                                    <td class=" col-md-7">
                                                        <ul class="user-legal-info">
                                                            <li class="BodyBody-2">
                                                            @if(isset($document->updated_at))
                                                            {{date('d/m/Y',strtotime($document->updated_at))}}
                                                            @endif
                                                            </li>

                                                        </ul>
                                                    </td>
                                                </tr>
                                                <tr class=" row">
                                                    <td class="  col-md-5">
                                                        <div class="user-head-wi-ico">
                                                            <i class="icon-icons-person-person"></i> Abogado
                                                        </div>
                                                    </td>
                                                    <td class=" col-md-7">
                                                        <ul class="user-legal-info">
                                                            <li class="BodyBody-2">
                                                                {{$lawyer->lawyer_name}}
                                                            </li>
                                                            <li class="BodyBody-2">
                                                                {{$lawyer->phone}}
                                                            </li>
                                                            <li class="BodyBody-2">
                                                               {{$lawyer->email}}
                                                            </li>

                                                        </ul>
                                                    </td>
                                                </tr>

                                            </tbody>
                                        </table>

                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="legal-operation">
                                    <div class="document-data-information">
                                        <h4>
                                            Estado de la Legalización
                                        </h4>
                                    </div>
                                    <form id="legal_status_form" method="post">
                                        <div class="document-legal-choose">
                                            <div class="dropdown custom_dropdown_menu custom-dropdown-normal" id="legalstatus">
                                                <a class="btn btn-secondary dropdown-toggle " href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <p class="mb-0 dropdown-select-2">Seleccione un estado</p>
                                                    <i class="icon-icons-arrow-chevron-down"></i>
                                                </a>
                                                <div class="dropdown-menu mCustomScrollbar dropdcst" id="dropdcst-2" aria-labelledby="dropdownMenuLink">

                                                    @foreach($statuses as $status)
                                                        <a class="dropdown-item d-flex justify-content-between " href="javascript:">                                                                           
                                                            <h6 data-id="{{ $status->id}}">{{ $status->legalisation_status}}</h6>
                                                            <span class="check-marked-normal icon-icons-checkmark-checkmark-1"></span>
                                                        </a>
                                                    @endforeach                                               
                                                </div>
                                            </div>
                                        </div>
                                        <input type="hidden" name="user_id" id="user_id" value="{{$user_id}}">
                                        <input type="hidden" name="legalization_id" id="legalization_id" value="{{$id}}">
                                        <input type="hidden" name="legalisation_status" id="legalisation_status">
                                        <div class="sub-legal-states">
                                        <button type="button" class="btn btn-comon btn-blue btn-w-icon disabled" id="btn_status"><i class="icon-icons-save"></i>Guardar Estado</button>
                                        </div>
                                    </form>
                                </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>



    </main>
    <footer class="footer">

<div class="footer-wrap">
    <div class="footer-content">
        <div class="container-fluid">
            <div class="row align-items-end">
                <div class="col-lg-4">
                    <div class="widget">
                        <div class="foot-company-logo">
                            <div class="foot-logo-wrap">
                                <img src="{{asset('front/assets/img/logo-vertical.svg')}}" class="lazyload"/>
                            </div>
                          
                        </div>


                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="footer-links">
                    <div class="footer-copy-right d-none d-md-block mt-0">
                                <p class="FooterCopyright-2 mb-0 text-right">Copyright <a href="#">Herramientas Legales</a>, {{ now()->year }}. Todos los derechos reservados.</p>
                            </div>
                    </div>
                </div>
                <div class="footer-copy-right d-block d-md-none d-sm-block d-lg-none">
                    <p class="FooterCopyright-2">Copyright <a href="#">Herramientas Legales</a>, {{ now()->year }}. Todos los derechos reservados.</p>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="//code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<script src="//cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="//stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
<script src="//ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
<!-- bootstrap select -->
<script src="{{asset('front/assets/js/vendors/bootstrap-select.min.js')}}"></script>
<!-- isotope -->
<script src="{{asset('front/assets/js/vendors/isotope.pkgd.min.js')}}"></script>
<!-- data-table -->
<script src="{{asset('front/assets/js/vendors/datatables.min.js')}}"></script>
<!-- Lazyload -->

<script src="{{asset('front/assets/js/vendors/ls.parent-fit.min.js')}}" async=""></script>
<script src="{{asset('front/assets/js/vendors/ls.bgset.min.js')}}" async=""></script>
<script src="{{asset('front/assets/js/vendors/lazysizes.min.js')}}" async=""></script>
<!-- input mask -->
<script src="{{asset('front/assets/js/vendors/inputmask/jquery.inputmask.min.js')}}"></script>
<!-- custom scrollbar -->
<script src="{{asset('front/assets/js/vendors/jquery.mCustomScrollbar.concat.min.js')}}"></script>


<!-- <script src="assets/js/vendors/slick.min.js"></script> -->

<!-- tweenmax animation -->
<!-- <script type="text/javascript" src="assets/js/TweenMax.min.js"></script>
<script type="text/javascript" src="assets/js/ScrollMagic.js"></script>
<script type="text/javascript" src="assets/js/animation.gsap.min.js"></script>
<script type="text/javascript" src="assets/js/animation.js"></script> -->

<!-- datepicker -->
<script src="{{asset('front/assets/js/vendors/moment.min.js')}}" type="text/javascript"></script>
<script src="{{asset('front/assets/js/vendors/moment_local_es.min.js')}}" type="text/javascript"></script>
<script src="{{asset('front/assets/js/vendors/tempusdominus-bootstrap-4.js')}}" type="text/javascript"></script>
<script type="text/javascript" src="{{asset('front/assets/js/main.js')}}"></script>

<script>
    function loadJS(u) {
        var r = document.getElementsByTagName("script")[0],
            s = document.createElement("script");
        s.src = u;
        r.parentNode.insertBefore(s, r);
    }
    if (!window.HTMLPictureElement || document.msElementsFromPoint) {
        loadJS("//afarkas.github.io/lazysizes/plugins/respimg/ls.respimg.min.js");
    }


   
</script>
<script>
    $(document).ready(function(){
         $("#legalstatus #dropdcst-2 a").on('click', function () {
            var status =  $(this).find('h6').attr('data-id');
            $('#legalisation_status').val(status);
            var id = $('#legalization_id').val();
            $('.btn-w-icon').removeClass('disabled');
        });
    });

    $(document).on('click', '#btn_status', function(e){
            var id = $('#legalization_id').val();
            var user_id = $('#user_id').val();
            var status =$('#legalisation_status').val();
            $.ajax({
                type: "GET",
                dataType: "json",
                url: "{{ route('lawyer.link.status') }}",
                data: { 'status': status, 'id': id,'user_id':user_id, _token: '{{csrf_token()}}' },
                success: function (output) {
                    if (output.status == "success") {
                         console.log(output.message);
                         location.reload(true);

                    }

                },
                error: function (error) {
                    toastr.error("Algo salió mal. Por favor, vuelva a intentarlo");
                }
        });  
    });
   </script>

</footer>



</body>

</html>
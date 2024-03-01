@extends('front.layouts.master')
@section('pageTitle',__('test.Document List'))
@section('content')


<!-- <!doctype html>
<html lang="en"> -->

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="assets/css/main.min.css">
    <link rel="icon" href="assets/img/favicon.ico">
    <title>HerramientasLegales | Payment Success</title>
</head>
<style>
.payment-success-wrap .reg-bt-choose {
    margin-top: 1.75rem;
}
 .HeadlineH2-2 {
    margin-bottom: 0.75rem;
}
@media (max-width:767px){
    .HeadlineH2-2{
        text-align: center;
    font-size: 1.5rem;
    }
    .HeadlineH4-2{
        text-align: center;
        font-size: 0.875rem;
    }
    .payment-success-wrap  .reg-bt-choose.payment-success-bt .btn-comon:first-child {
        margin-right: auto!important;
        margin-left:auto;
    }
    .payment-success-wrap  .reg-bt-choose.payment-success-bt .btn-comon{
        margin-right: auto;
        margin-left:auto;
        display: block;
    }
}
.payment-success-wrap  .reg-bt-choose.payment-success-bt .btn-comon:first-child {
    margin-bottom: 1.25rem;
    margin-right: 1.25rem;
}
.payment-success-wrap  .reg-bt-choose.payment-success-bt .btn-comon{
    max-width: 14.5rem;
    line-height: 1.125rem;
}
.helloIllustraction{

    max-width: 80%;
    margin: 0 auto;
}
.payment-success-wrap .subscribe-content{
    max-width: 27.5rem;
    margin-left: inherit!important;
    margin-right: inherit!important;
}

</style>
<body>

<main class="subscription-page subscribe-page payment-success-wrap">

        <section class="form-filling-wrap">
            <div class="container">
                <div class="row flx-vcenter">
                    <div class="col-lg-12">
                    <div class="pay-success">
                    <div class="row flx-vcenter">
                                            <div class="col-md-5">
                                                <div class="helloIllustraction">
                                                    <img src="{{asset('front/assets/img/illustraction/paymentsucces.png')}}" class="img-fluid lazyload" />
                                                </div>
                                            </div>
                                            <div class="col-md-7">
                                                <div class="SignContentModal subscribe-content">
                                                    <h2 class="HeadlineH2-2">¡Listo!</h2>
                                                    <h4 class="HeadlineH4-2 ">Su compra se ha realizado de manera exitosa. </h4>
                                                    <div class="reg-bt-choose payment-success-bt">
                                                        <a href="#" class="btn btn-comon btn-blue btn-block redirect">Continuar</a>
                                                        <!-- <a href="user/login.php" class="btn btn-comon btn-blue-outline">Ver documentos en proceso</a> -->
                                                        <input type="hidden" name="txn_uuid" id="txn_uuid" value="{{$data['req_transaction_uuid']}}">
                                                        <input type="hidden" name="txn_id" id="txn_id" value="{{$data['transaction_id']}}">
                                                        <!-- <a href="#" class="btn btn-comon btn-blue btn-block keepCredit d-none">Ir a lista de documentos</a> -->
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                    </div>
                   
                    </div>
                </div>

            </div>
        </section>


    </main>



    
  



</body>

</html>


 

@endsection
@push('js')
<!-- <script src="{{ asset('front/assets/custom/js/user.js')}}"></script> -->
<script src="//code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<script>
$(document).ready(function () {
$(".keepCredit").trigger( "click" );
});

$(".keepCredit").on('click', function (e) {
  e.preventDefault();
  var id  = $("#txn_uuid").val();
  var txn  = $("#txn_id").val();
  console.log(id);
        $.ajax({
            type: "GET",
            url: "user/payment/update/Checklist/"+id+"/"+txn,
            dataType: 'json',
            contentType: false,
            cache: false,
            processData: false,
            success: function (json) {
                if (json.status) {
                    // location.reload(true);
                    console.log(status);
                } 

            }
        });
});

$(".redirect").on('click', function (e) {
  e.preventDefault();
  var id  = $("#txn_uuid").val();
  var txn  = $("#txn_id").val();
  console.log(id);
        $.ajax({
            type: "GET",
            url: "user/payment/update/Checklist/redirect/"+id+"/"+txn,
            dataType: 'json',
            contentType: false,
            cache: false,
            processData: false,
            success: function (result) {
                if (result.status) {
                     var element = result.template.text_body;
                     var opt = {
                        margin: [25.4, 25.4, 25.4, 25.4],
                        filename: 'document.pdf',
                        image: { type: 'jpeg', quality: 0.98 },
                        html2canvas: { scale: 2 },
                        jsPDF: { unit: 'mm', format: 'a4', orientation: 'portrait' },
                        pagebreak: { mode: ['avoid-all', 'css', 'legacy'] }
                    };
                
                    string = html2pdf().from(element).set(opt).toPdf().get('pdf').then(function (pdf) {
                
                    }).save();
                } 
            }
        });
});
</script>

@endpush
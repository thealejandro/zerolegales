<!@extends('front.layouts.verification_master')
@section('pageTitle',__('test.Mail Verification'))
@section('content')
    <main class="mailverify-page">
        <section >
            <div class="container">
                <div class="row flx-vcenter">
                    <div class="col-md-6">
                            <div class="illus-verify">
                                <img src="{{asset('front/assets/img/illustraction/hello_reverse.png')}}" class="img-fluid lazyload"/>
                            </div>
                    </div>
                    <div class="col-md-6">
                        <div class="verify-content">
                            <h2 class="HeadlineH2-2">¡Su correo ha sido verificado! </h2>
                            <p class="BodyBody-2">Gracias por verificar su correo. Puede continuar disfrutando de nuestros servicios. </p>

                            <a href="{{route('user.document')}}" class="btn btn-comon btn-blue">Explorar Documentos</a>
                        </div>
                    </div>
                </div>
     
            </div>
        </section>  
    </main>
@endsection

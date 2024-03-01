@extends('front.layouts.master')
@section('pageTitle',__('test.Legalization States'))
@section('content')
    <main class="documentlist-page document-process-page ">
        <section class="cat-list-wrap legalization-states-page">
            <div class="container profile-legalize-wrap">


                <div class="list-doc-wrap">
                    <div class="page-head-process">
                        <div class="row d-flex justify-content-between align-items-center">
                            <div class="col-md-9 p-0 col-sm-12">
                                <div class="HeadlineH2-2">
                                    Estados de Legalización
                                </div>
                            </div>
                            <div class="col-md-3 p-0 col-sm-12 contact-center">
                                <a href="mailto:anjalykjoy@gmail.com" class="btn btn-comon btn-blue btn-w-icon "><i class="icon-icons-email"></i>Contactar a Soporte </a>
                            </div>
                        </div>
                    </div>
                    <div class="row legal_doc">
                        <div class="col-md-12">
                            <div class="hl-table" id="stateslegal">
                                <table id="profile_legalize_table" class="table table-striped tableexpand " style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Tipo de Documento</th>
                                            <th>Nombre de Documento</th>
                                            <th>Fecha</th>
                                            <th>Estado</th>
                                           

                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($legal_details as $detail)
                                        @if(isset($detail->legalisation_status))
                                            <tr data-id="{{$detail->id}}" data-document="{{$detail->document_template_id}}">
                                                <td>{{$detail->type_name}}</td>
                                                <td>{{$detail->document_name}}</td>
                                                <td>{{date('d/m/Y',strtotime($detail->created_at))}}</td>
                                                <td>
                                                    @if($detail->legalisation_status =='1')
                                                    <a class="btn btn-comon btn-disable">Enviada al Abogado</a></td>
                                                    @elseif($detail->legalisation_status =='2')
                                                        <a class="btn btn-comon btn-blue">Lista para Firmar</a>
                                                    @elseif($detail->legalisation_status =='3')
                                                        <a class="btn btn-comon btn-gray">Entregada</a>
                                                    @endif
                                                </td>
                                            </tr>  
                                        @endif                                  
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>
    </main>
@endsection
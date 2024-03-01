@extends('front.layouts.master')
@section('pageTitle',__('test.Purchase History'))
@section('content')
    <main class="documentlist-page document-process-page ">
        <section class="cat-list-wrap legalization-states-page">
            <div class="container profile-legalize-wrap">
                <div class="list-doc-wrap">
                    <div class="page-head-process">
                        <div class="row d-flex justify-content-between align-items-center">
                            <div class="col-md-9 p-0 col-sm-12">
                                <div class="HeadlineH2-2">
                                Historial de Compras
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
                                <table id="purchase_history" class="table table-striped table_history tableexpand" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Transacción</th>
                                            <th>Fecha</th>
                                            <th>Pago</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($invoiceDocument as $invoiceData)
                                    <!-- @if($invoiceData) -->
                                    <tr>
                                            <td>{{$invoiceData['transaction_id']}}</td>
                                            <td>{{$invoiceData['type']}}</td>
                                            <td>{{$invoiceData['created_at']->format('d/m/Y')}}</td>
                                            <td><b>Q.{{$invoiceData['amount']}}</b></td>
                                    </tr>
                                    <!-- @endif -->
                                    @endforeach
                                    @foreach($invoice as $invoiceData)
                                    <!-- @if($invoiceData) -->
                                    <tr>
                                            <td>{{$invoiceData['transaction_id']}}</td>
                                            <td>{{$invoiceData['transaction_type']}}</td>
                                            <td>{{$invoiceData['created_at']->format('d/m/Y')}}</td>
                                            <td><b>Q.{{$invoiceData['price']}}</b></td>
                                    </tr>
                                    <!-- @endif -->
                                    @endforeach
                                       <!-- when there is no purchase history comment tbody value -->
                                       
                                                            <!-- when there is no purchase history comment tbody value -->
                                    </tbody>

                                </table>
                                <div class="no-transaction">
                                  
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>
    </main>
@endsection
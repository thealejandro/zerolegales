@extends('admin.layouts.master')
@section('pageTitle',__('test.Invoice Data'))
@section('content')
    <div class="breadcrumb">
        <h1>{{ __('test.Invoice Data') }}</h1>
    </div>
    <div class="separator-breadcrumb border-top"></div>
    <div class="row mb-4">
        <div class="col-md-12 mb-4">
            <div class="card text-left">
                <div class="card-body">
                <div class="d-flex align-items-center">
                    <h4 class="card-title mb-3">{{ __('test.Invoice Data') }}</h4>
                </div>
                <div class="row pb-3">
                    <div class="col-md-3 col-sm-6">
                        <label>{{ __('test.start-date') }} -{{ __('test.end-date') }}</label>
                        <input type="text" id="date-range" name="range" placeholder="{{ __('test.start-date') }} -{{ __('test.end-date') }}" class="form-control date-range-filter"
                            autocomplete="off" />
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <label>{{ __('test.purchase-type') }}</label>
                        <select class="form-control select2" name="purchase_type" id="purchase-type">
                            <option value="" disabled selected hidden></option>
                            <option value="Documentos">Documentos</option>
                            <option value="Suscripción">Suscripción</option>
                            <option value="Legalización">Legalización</option>
                        </select>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <label>{{ __('test.full-name') }}</label>
                        <input type="text" name="full_name" id="full-name" placeholder="{{  __('test.full-name')  }}" class="form-control">
                    </div>

                    <div class="col-md-3 col-sm-6">
                        <label>{{ __('test.email') }}</label>
                        <input type="text" name="email" id="email" placeholder="{{  __('test.email')  }}" class="form-control">
                    </div>

                    <div class="col-md-3 col-sm-6">
                        <label>{{ __('test.nit') }}</label>
                        <input type="text" name="nit" id="nit" placeholder="{{  __('test.nit')  }}" class="form-control">
                    </div>

                    <div class="col-md-3 col-sm-6">
                        <label>{{ __('test.customer-name') }}</label>
                        <input type="text" name="customer_name" id="customer-name" placeholder="{{  __('test.customer-name')  }}" class="form-control">
                    </div>

                    <div class="col-md-3 col-sm-6">
                        <label>{{ __('test.customer-address') }}</label>
                        <input type="text" name="customer_address" id="customer-address" placeholder="{{  __('test.customer-address')  }}" class="form-control">
                    </div>

                    <div class="col-md-3 col-sm-6">
                        <label>{{ __('test.amount-purchase') }}</label>
                        <input type="text" name="price" id="amount-purchase" placeholder="{{  __('test.amount-purchase')  }}" class="form-control">
                    </div>
                </div>   
                                
                <div class="table-responsive">
                    <table id="invoice_data_table" class="display table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>{{ __('test.full-name') }}</th>
                                <th>{{ __('test.purchase-date') }}</th>
                                <th>{{ __('test.purchase-type') }}</th>
                                <th>{{ __('test.amount-purchase') }}</th>
                                <th>{{ __('test.email') }}</th>
                                <th>{{ __('test.nit') }}</th>
                                <th>{{ __('test.customer-name') }}</th>
                                <th>{{ __('test.customer-address') }}</th>
                            </tr>
                        </thead>
                        <tbody>                                      
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>{{ __('test.full-name') }}</th>
                                <th>{{ __('test.purchase-date') }}</th>
                                <th>{{ __('test.purchase-type') }}</th>
                                <th>{{ __('test.amount-purchase') }}</th>
                                <th>{{ __('test.email') }}</th>
                                <th>{{ __('test.nit') }}</th>
                                <th>{{ __('test.customer-name') }}</th>
                                <th>{{ __('test.customer-address') }}</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>    
@endsection
@push('js')
    <script>
        $(function() {
            let table = null;
            // Datatable ajax response
            let response = {};

            let datepicker = $('#date-range').daterangepicker({
                showDropdowns: true,
                alwaysShowCalendars: true,
                autoUpdateInput: false,
                linkedCalendars: false,
                "locale": {
                    "format": "MM/DD/YYYY",
                    "separator": " - ",
                    "applyLabel": '@lang("Apply")',
                    "cancelLabel": '@lang("Cancel")',
                    "fromLabel": '@lang("From")',
                    "toLabel": '@lang("To")',
                    "customRangeLabel": '@lang("Custom")',
                    "weekLabel": "W",
                    "daysOfWeek": ["Dom", "Lun", "Mar", "Mié", "Jue", "Vie", "Sáb"],
                    "monthNames": ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto",
                        "Septiembre", "Octubre", "Noviembre", "Diciembre"
                    ],
                    "firstDay": 0
                },
            });

            $('#date-range').on('apply.daterangepicker', function(ev, picker) {
                $(this).val(picker.startDate.format('DD/MM/YYYY') + ' - ' + picker.endDate.format(
                    'DD/MM/YYYY'));
                table.draw();
            });

            $('#date-range').on('cancel.daterangepicker', function(ev, picker) {
                $(this).val('');
                table.draw();
            });
    
            
            let columns = [{
                    data: "full_name"
                },
                {
                    data: "purchase_date"
                },
                {
                    data: "purchase_type"
                },
                {
                    data: "price",
                },
                {
                    data: "email"
                },
                {
                    data: "nit",
                    
                },
                {
                    data: "customer_name",
                    
                },
                {
                    data: "customer_address",
                    
                },

            ];

            var initComplete = function() {
                this.api().columns([2]).every(function() {
                    var column = this;
                    $('#purchase-type')
                        .on('change', function() {
                            column.search($(this).val(), false, false, true).draw();
                        });
                });

                this.api().columns([0]).every(function() {
                    var column = this;
                    $('#full-name')
                        .on('keyup', function() {
                            column.search($(this).val(), false, false, true).draw();
                        });
                });

                this.api().columns([4]).every(function() {
                    var column = this;
                    $('#email')
                        .on('keyup', function() {
                            column.search($(this).val(), false, false, true).draw();
                        });
                });

                this.api().columns([5]).every(function() {
                    var column = this;
                    $('#nit')
                        .on('keyup', function() {
                            column.search($(this).val(), false, false, true).draw();
                        });
                });

                this.api().columns([6]).every(function() {
                    var column = this;
                    $('#customer-name')
                        .on('keyup', function() {
                            column.search($(this).val(), false, false, true).draw();
                        });
                });

                this.api().columns([7]).every(function() {
                    var column = this;
                    $('#customer-address')
                        .on('keyup', function() {
                            column.search($(this).val(), false, false, true).draw();
                        });
                });

                this.api().columns([3]).every(function() {
                    var column = this;
                    $('#amount-purchase')
                        .on('keyup', function() {
                            column.search($(this).val(), false, false, true).draw();
                        });
                });

            }
            table = $('#invoice_data_table').DataTable({
                "bProcessing": true,
                "serverSide": true,
                dom: 'lBfrtip',
                "pageLength": 20,
                "paging": true,
                "bSort": true,
                "autowidth": true,
                responsive: true,
                "order": [
                    [1, "desc"]
                ],
                buttons: [
                    {
                        extend: 'excel',
                        className: 'datatableButton'
                    },
                ],
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json",
                    buttons: {
                        excel: 'Excel',
                    }
                },
                "scrollX": true,
               
                "ajax": {
                    url: "{{ route('admin.invoice-data.datatable') }}",                
                    type: "post", 
                    datatype: 'json',
                    data: function(d) {
                        let picker = datepicker.data('daterangepicker');
                        let value = datepicker.val();
                        let range = null;
                        if (value) {
                            startDate = picker.startDate.format('YYYY-MM-DD');
                            endDate = picker.endDate.format('YYYY-MM-DD');
                            range = {
                                startDate: startDate,
                                endDate: endDate
                            };
                        };
                        d.range = range;
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    error: function() { // error handling code
                        $("#reports_visitors_processing").css("display", "none");
                        //                        $('#basic_report_loader').hide();

                    },
                },

                columns: columns,
                "lengthMenu": [
                    [10, 25, 50, 100, -1],
                    [10, 25, 50, 100, 'All']
                ],
                "pageLength": 10,
                dom: "<'row'<'col-sm-6 text-left'B><'col-sm-6 text-right'f>>\n\t\t\t<'row'<'col-sm-12'tr>>\n\t\t\t<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7 dataTables_pager pt-2'lp>>",
                initComplete: initComplete,
                drawCallback: function(settings) {
                    // ajax response
                    response = settings.json;

                },

            });

            $('.date-range-filter').change(function() {
                table.draw();
            });


        });


        $('#purchase-type').select2({
            placeholder: 'Seleccionar Tipo de compra',
            width: 'resolve',
            language: "es"
        });

    

    </script>
@endpush
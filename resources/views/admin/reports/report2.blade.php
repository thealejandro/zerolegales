@extends('admin.layouts.master')
@section('content')
    <div class="breadcrumb">
        <h1>{{ __('test.Report2') }}</h1>
        <!-- <ul>
            <li>{{ __('test.Report') }}</li>
            <li>{{ __('test.Report2') }}</li>
           

        </ul> -->
    </div>
    <div class="separator-breadcrumb border-top"></div>
    <div class="row mb-4">
        <div class="col-md-12 mb-4">
            <div class="card text-left">
                <div class="card-body">
                <div class="d-flex align-items-center">
                    <h4 class="card-title mb-3">{{ __('test.All legal documents') }}</h4>
                </div>
                <div class="row pb-3">
                    <div class="col-md-3 col-sm-6">
                        <label>{{ __('test.start-date') }} -{{ __('test.end-date') }}</label>
                        <input type="text" id="date-range" name="range" class="form-control date-range-filter"
                            autocomplete="off" />
                    </div>
                    <!--  -->
                </div>                     
                <div class="table-responsive">
                    <table id="report2_table" class="display table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>No de usuarias</th>
                                <th>Precio total</th>
                                <th>No de documentos</th>
                            </tr>
                        </thead>
                        <tbody>                                      
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Nombre</th>
                                <th>No de usuarias</th>
                                <th>Precio total</th>
                                <th>No de documentos</th>
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

            // let ranges = {};
            // ranges[__('Today')] = [moment(), moment()];
            // ranges[__('Yesterday')] = [moment().subtract(1, 'days'), moment().subtract(1, 'days')];
            // ranges[__('Last 7 Days')] = [moment().subtract(6, 'days'), moment()];
            // ranges[__('Last 30 Days')] = [moment().subtract(29, 'days'), moment()];
            // ranges[__('This Month')] = [moment().startOf('month'), moment().endOf('month')];
            // ranges[__('Last Month')] = [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')];
            let datepicker = $('#date-range').daterangepicker({
                showDropdowns: true,
                alwaysShowCalendars: true,
                autoUpdateInput: false,
                linkedCalendars: false,
                // ranges: ranges,
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
                    data: "Name"
                },
                {
                    data: "users"
                },
                {
                    data: "price"
                },
                {
                    data: "document",
                },
                // {
                //     data: "DateOfExpire"
                // },
                // {
                //     data: "LegalisationStatus",
                //     orderable: false,
                //     searchable: false
                // },

            ];

            var initComplete = function() {
                this.api().columns([1]).every(function() {
                    var column = this;
                    $('#document_status')
                        .on('change', function() {
                            column.search($(this).val(), false, false, true).draw();
                        });
                });

            }

            table = $('#report2_table').DataTable({
                "bProcessing": true,
                "serverSide": true,
                dom: 'lBfrtip',
                "pageLength": 20,
                "paging": true,
                "bSort": true,
                "autowidth": true,
                responsive: true,
                "order": [
                    [0, "desc"]
                ],
                buttons: [
                    // {
                    //     extend: 'copy',
                    //     className: 'datatableButton',
                    // },
                    {
                        extend: 'excel',
                        className: 'datatableButton'
                    },
                    {
                        extend: 'pdf',
                        className: 'datatableButton',
                        download: 'open',
                        exportOptions: {
                            //  stripHtml: false,
                            //  stripNewlines: false,
                        },
                        customize: function(pdf, button, api) {
                            //
                        },
                        messageTop: function() {
                            let text = '';
                            text += 'Filtrado: ' + response.recordsFiltered;
                            text += '\n';
                            text += 'Total: ' + response.recordsTotal;
                            return text;
                        },
                    },
                    {
                        extend: 'print',
                        className: 'datatableButton'
                    },
                ],
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json",
                    buttons: {
                        // copy: 'Copiar',
                        excel: 'Excel',
                        pdf: 'Pdf',
                        print: 'Imprimir',
                    }
                },
                "scrollX": true,
                "ajax": {
                    url: "{{ route('admin.reports.report2.datatable') }}",
                    type: "post", // type of method  , by default would be get
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

    </script>
@endpush
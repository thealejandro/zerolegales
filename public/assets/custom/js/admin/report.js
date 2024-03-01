$(document).ready(function () {

    // var url = $('#siteurl').val();


    if($('#user_report_datatable').length > 0)
    {
        $('#user_report_datatable').DataTable({
            processing: true,
            serverSide: true,
            order: [[ 1, "asc" ]],
            lengthMenu: [[10, 25, 50, 100], [10, 25, 50, 100]],
            dom: "<'row'<'col-sm-3'l><'col-sm-3'f><'col-sm-6'p>>" +
                 "<'row'<'col-sm-12'tr>>" +
                 "<'row'<'col-sm-5'i><'col-sm-7'p>>",
            ajax: 'admin/get-user-report-list',
            columns: [
                // { 
                //     data: "null",
                //     width: '50',
                //     render : function(data,type,full) {
                //         return full.id;
                //     }
                // },
                { 
                    data: "null",
                    width: '300',
                    render : function(data,type,full) {
                        return full.first_name+' '+full.last_name;
                    }
                },
                { 
                    data: "null",
                    width: '200',
                    render : function(data,type,full) {
                        return full.email;
                    }
                },
                { 
                    data: "null",
                    width: '200',
                    render : function(data,type,full) {
                        return full.created_at;
                    }
                },
                
                { 
                    data: "null",
                    width: '300',
                    render : function(data,type,full) {

                        if(full.subscription_id == 1)
                        
                        {
                            return 'Compra única';
                        }
                        else if(full.subscription_id == 2)
                        {
                            return 'Suscripción estándar';

                        }else if(full.subscription_id == 3)
                        {
                            return 'Suscripción Premium';
                        } 
                        else
                        {
                            return '';
                        }

                    }
                }, 
                { 
                    data: "null",
                    width: '300',
                    render : function(data,type,full) {
                        return full.expire_date;
                    }
                },

            ],
        });
    }




    $('.payment_filter').change(function (e) {

        // alert("The text has been changed.");
        e.preventDefault(); 
        // var status = $('#status-select2').val();
        var from = $('#picker4').val();    
        var to = $('#picker5').val();         
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "POST",
            url: url + "/admin/filter-user",
            dataType: 'JSON',
            data : {from:from,to:to},
            beforeSend: function(){
                $(".error").html('');
            },
            success: function(result){
                if(result.status == 1){
                    console.log(result.payment);
                    if(result.payment !="") {
                        var html = "";
                        var status = "";
                        $.each( result.payment, function( key ,value ) {
                            if(value.is_pay == 1) {
                                status = '<a href="javascript:void(0);"><span class="peer"><span class="badge badge-pill badge-success lh-0 p-10">Paid</span></span></a>';
                            } else {
                                status = '<a href="javascript:void(0);"><span class="peer"><span class="badge badge-pill badge-danger lh-0 p-10">Not Paid</span></span></a>';

                            }
                            html +=  '<tr><td>'+value.id+'</td><td>'+value.updated_at+'</td><td>'+value.invoice_code+'</td><td>'+value.user.name+'</td><td>'+value.address+'</td><td>'+value.user.mobile+'</td><td>'+value.coupon_code+'</td><td>'+value.quote_items_count+'</td><td>'+value.taxable_value+'</td><td>'+value.cgst+'</td><td>'+value.sgst+'</td><td>'+value.fs+'</td><td>'+value.total_amount+'</td><td>'+value.currency+'</td><td>'+value.is_payed+'</td><td>'+status+'</td><td><a href="'+url+'/admin/view-payment/'+value.id+'" class="btn btn-primary btn-rounded m-1"title="Edit"><i style="font-size: 1.3rem;" class="i-File-Edit"></i></a></td></tr>';
                           
                        });
                        $(".table-responsive #payment_tbody_p1").html(html);
                    } else {
                        $(".table-responsive #payment_tbody_p1").html('<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>');
                    }
               
                }else{
                   
                }

            }
        });

    }); 





    if($('#subscription_report_datatable').length > 0)
    {
        console.log('mnv');
        $('#subscription_report_datatable').DataTable({
            processing: true,
            serverSide: true,
            order: [[ 1, "asc" ]],
            lengthMenu: [[10, 25, 50, 100], [10, 25, 50, 100]],
            dom: "<'row'<'col-sm-3'l><'col-sm-3'f><'col-sm-6'p>>" +
                 "<'row'<'col-sm-12'tr>>" +
                 "<'row'<'col-sm-5'i><'col-sm-7'p>>",
            ajax: 'admin/get-subscription-report-list',
            columns: [
                // { 
                //     data: "null",
                //     width: '50',
                //     render : function(data,type,full) {
                //         return full.id;
                //     }
                // },
                { 
                    data: "null",
                    width: '300',
                    render : function(data,type,full) {
                        if(full.subscription_id == 2 && full.payment_type == "Monthly")
                        {
                            return 'Suscripción estándar mensual';
                        }
                        else if(full.subscription_id == 2 && full.payment_type == "Annual")
                        {
                            return 'Suscripción estándar anual';

                        }else if(full.subscription_id == 3 && full.payment_type == "Monthly")
                        {
                            return 'Suscripción Premium Mensual';
                        }else if(full.subscription_id == 3 && full.payment_type == "Annual")
                        {
                            return 'Suscripción Premium Anual';
                        }
                        else
                        {
                            return 'Compra única';
                        }

                    }
                },
                { 
                    data: "null",
                    width: '200',
                    render : function(data,type,full) {
                        return full.id;
                    }
                },
                
                
                { 
                    data: "null",
                    width: '300',
                    render : function(data,type,full) {

                        return full.id;

                    }
                }, 
                { 
                    data: "null",
                    width: '300',
                    render : function(data,type,full) {
                        return full.id;
                    }
                },

            ],
        });
    }


   
   
  

});



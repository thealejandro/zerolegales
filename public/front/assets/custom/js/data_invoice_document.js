$(document).ready(function() {

    // $(".keepCredit").trigger( "click" );
    // $(".BuyFillDocument").trigger( "click" );
    // $(".Checklist").trigger( "click" );
    // $(".FillBuyDocument").trigger( "click" );
    // $(".FillBuyPurchase").trigger( "click" );
    // $(".LegalisationPurchase").trigger( "click" );

    $("input[name=billinfo]").on('change', function () {
        if($(this).is(':checked')) {
            var payment_type = $(this).val();
            
           if(payment_type == "nit"){
                document.getElementById('nit_data').disabled = false;
                document.getElementById('customer_name').disabled = false;
                document.getElementById('customer_address').disabled = false;
                $('.submitInvoiceData').removeClass('opacity_4');
               $('.saveInvoiceData').removeClass('disabled');
           }else if(payment_type == "cf"){
                document.getElementById('nit_data').disabled = true;
                document.getElementById('customer_name').disabled = true;
                document.getElementById('customer_address').disabled = true;
                $('.submitInvoiceData').addClass('opacity_4');
                $('.saveInvoiceData').removeClass('disabled');
           }else{
            console.log("null");
           }
    }
    });

});


// $(".keepCredit").on('click', function (e) {
//     e.preventDefault();
//     console.log('vakayil');
//     var id  = $("#txn_uuid").val();
//     var txn  = $("#txn_id").val();
//     if(id != 1){
//       console.log(id);
//           $.ajax({
//               type: "GET",
//               url: "user/payment/update/"+id+"/"+txn,
//               dataType: 'json',
//               contentType: false,
//               cache: false,
//               processData: false,
//               success: function (json) {
//                   if (json.status) {
//                       // location.reload(true);
//                       console.log(status);
//                   } 
  
//               }
//           });
//     }


        
        
        $(".BuyFillDocument").on('click', function (e) {
          e.preventDefault();
          var id  = $("#txn_uuid").val();
          var txn  = $("#txn_id").val();
          console.log(id);
                $.ajax({
                    type: "GET",
                    url: "user/payment/update/BuyFillDocument/redirect/"+id+"/"+txn,
                    dataType: 'json',
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function (json) {
                        if (json.status) {
                            window.location.replace(json.redirect);
                            console.log(status);
                        } 
        
                    }
                });
        });


            
            
            $(".Checklist").on('click', function (e) {
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
                        success: function (json) {
                            if (json.status) {
                                var element = json.template.text_body;
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


                
                
                $(".FillBuyDocument").on('click', function (e) {
                  e.preventDefault();
                  var id  = $("#txn_uuid").val();
                  var txn  = $("#txn_id").val();
                  console.log(id);
                        $.ajax({
                            type: "GET",
                            url: "user/payment/update/FillBuyDocument/redirect/"+id+"/"+txn,
                            dataType: 'json',
                            contentType: false,
                            cache: false,
                            processData: false,
                            success: function (json) {
                                if (json.status) {
                                    window.location.replace(json.redirect);
                                    console.log(status);
                                } 
                
                            }
                        });
                });


                    
                    
                    
                    $(".FillBuyPurchase").on('click', function (e) {
                      e.preventDefault();
                      var id  = $("#txn_uuid").val();
                      var txn  = $("#txn_id").val();
                      console.log(id);
                            $.ajax({
                                type: "GET",
                                url: "user/payment/update/FillBuyPurchase/redirect/"+id+"/"+txn,
                                dataType: 'json',
                                contentType: false,
                                cache: false,
                                processData: false,
                                success: function (json) {
                                    if (json.status) {
                                        window.location.replace(json.redirect);
                                        console.log(status);
                                    } 
                    
                                }
                            });
                    });

                    
                        $(".LegalisationPurchase").on('click', function (e) {
                        e.preventDefault();
                        var id  = $("#txn_uuid").val();
                        var txn  = $("#txn_id").val();
                        console.log(id);
                                $.ajax({
                                    type: "GET",
                                    url: "user/payment/update/LegalisationPurchase/redirect/"+id+"/"+txn,
                                    dataType: 'json',
                                    contentType: false,
                                    cache: false,
                                    processData: false,
                                    success: function (json) {
                                        if (json.status) {
                                            window.location.replace(json.redirect);
                                            console.log(status);
                                        } 

                                    }
                                });
                        });




    $(".saveInvoiceData").on('click', function (e) {
        e.preventDefault();
        // var form_data = new FormData($('#submitInvoiceData')[0]);
        var id  = $("#txn_uuid").val();
        var txn  = $("#txn_id").val();
        var nit  = $("#nit_data").val();
        var name  = $("#customer_name").val();
        var address  = $("#customer_address").val();
        var isCheck = $("input[type='radio'][name='billinfo']:checked").val();
        
        console.log(isCheck);
        $.ajax({
            url: "user/save-invoice-data-document/"+id+"/"+isCheck+"/"+nit+"/"+name+"/"+address,
            type: "GET",
            contentType: false,
            cache: false,
            processData: false,
            success: function (result) {
                if (result.status) {
                    console.log('mnv niyas');
                    $('#modalInvoiceData').modal('show');
                } else {
                    if (result.error) {
                        $.each(result.message, function (key, value) {
                            if (value[0])
                                $("#submitInvoiceData .error_" + key).html(value[0]);
                        });
                    } else {
    
                        // if(result.message = 'Invalid password') {
                        //     console.log(result.message);
                        //     $("#saveAccountInfo .error_current_password").html(result.message);
                        // } else {
                        $.each(result.message, function (key, value) {
                            if (value[0])
                                $("#submitInvoiceData .error_" + key).html(value[0]);
                        });
                        // }
    
                    }
                }
    
            }
        });
    });
    
  

    






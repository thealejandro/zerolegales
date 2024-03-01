$(document).ready(function() {

    $(".keepCredit").trigger( "click" );



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


$(".keepCredit").on('click', function (e) {
    e.preventDefault();
    var id  = $("#txn_uuid").val();
    var txn  = $("#txn_id").val();
    if(id != 1){
      console.log(id);
          $.ajax({
              type: "GET",
              url: "user/payment/update/"+id+"/"+txn,
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
    }


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
            url: "user/save-invoice-data/"+id+"/"+isCheck+"/"+nit+"/"+name+"/"+address,
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
    
  });

    






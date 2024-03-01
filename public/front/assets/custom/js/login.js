$(function () {

    $("#loginForm").validate({
        rules: {
            email: {
                required: true,
                email: true
            },
            password: {
                required: true 
            }
        },
        messages: {
            email: {
                required: "Por favor ingrese correo electrónico",
                email: "Por favor, introduce una dirección de correo electrónico válida "
            },
            password: {
                required: 'Introduce la contraseña',

            }
        },
        errorElement: 'label',
        errorClass: "val-error",
        highlight: function (element) {
            return false;
        },
        unhighlight: function (element) {
            return false;
        },
    });

});
$(document).ready(function(){
    $("#forgotForm .val-error").addClass('d-none');
    $("#newPasswordForm .val-error").addClass('d-none');
    $('.emailtrue').addClass('d-none');
    $('.emailerror').addClass('d-none');

    $('#email').on('keyup', function () {
        var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        var email = $('#email').val()
        if(!regex.test(email)) {
            $('.emailtrue').addClass('d-none');
            $('.emailerror').removeClass('d-none');
        }else{
            $('.emailtrue').removeClass('d-none');
            $('.emailerror').addClass('d-none');
        }

    });


    $("#forgotForm").on('submit',function(e){
        e.preventDefault();
        console.log('mnv');
        var form_data = new FormData($('#forgotForm')[0]);
        $.ajax({
            type: "POST",
            url: "forgot-password/send-mail",
            dataType: 'JSON',
            data : form_data,
            cache: false,
            contentType: false,
            processData: false,
            beforeSend: function(response){
                $(".error").html('');
                $(".success_message").html('');
            },
            success: function(response){
                if(response.status){
                    window.location.href = '/forgot-mail-send-success';
                
                }else{

                    $("#forgotForm .val-error").removeClass('d-none');
                }
            },
            error: function(error){
                $("#forgotForm .val-error").removeClass('d-none');
            }
        })
    });



    $("#newPasswordForm").on('submit',function(e){
        e.preventDefault();
        console.log('mnv');
        var form_data = new FormData($('#newPasswordForm')[0]);
        $.ajax({
            type: "POST",
            url: "confirm-new-password",
            dataType: 'JSON',
            data : form_data,
            cache: false,
            contentType: false,
            processData: false,
            beforeSend: function(response){
                $(".error").html('');
                $(".success_message").html('');
            },
            success: function(response){
                if(response.status){
                    $("#newPasswordForm .val-error").addClass('d-none');
                    window.location.href = '/new-password-success';
                
                }else{

                    $("#newPasswordForm .val-error").removeClass('d-none');
                }
            },
            error: function(error){
                $('#error_sign_up').html('Error !! Technical error');
            }
        })
    });

    $('#password, #confirm_password').on('keyup', function () {
        if ($('#password').val() == $('#confirm_password').val()) {
            $('.icon-true').removeClass('d-none');
            $('.icon-error').addClass('d-none');
    
        }
        else {
            $('.icon-true').addClass('d-none');
            $('.icon-error').removeClass('d-none');
    
        }
    
    });
});
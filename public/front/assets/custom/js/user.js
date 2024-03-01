
$(function () {

    $("#updatePersonalInfo").validate({
        rules: {
            first_name: {
                required: true,
            },
            surname: {
                required: true
            }
        },
        messages: {
            first_name: {
                required: "Por favor, introduzca su nombre de pila",
            },
            surname: {
                required: 'Ingrese su primer apellido',

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


$('#current_password').on('keyup', function (e) {
    e.preventDefault();
    var pword = $('#current_password').val();
    $.ajax({
        url: "user/profile-image/current/"+pword,
        type: "GET",
        contentType: false,
        cache: false,
        processData: false,
        beforeSend: function () {
           
        },
        success: function (result) {
            if (result.status) {
                console.log('success');
                $('.current_password_cls').removeClass('disable');
                $('.current_password_true').removeClass('d-none');
            } else {
                console.log('mnv');
                $('.current_password_true').addClass('d-none');
                
            }
        }
    });
    
});
$('#new_password').on('change', function (e) {
    $('.new_password_cls').removeClass('disable');
});
$('#confirm_password').on('change', function (e) {
    $('.confirm_password_cls').removeClass('disable');
});
$('#new_password, #confirm_password').on('keyup', function () {
    if ($('#new_password').val() == $('#confirm_password').val()) {
        // $('.icon-true').show();
        $('.icon-error').hide();
        $('.submitAccountInfo').removeClass('disabled');
    } else {
        $('.icon-true').hide();
        $('.icon-error').show();
        $('.submitAccountInfo').addClass('disabled');

    }

});

$('#first_name').on('keyup', function (e) {
    $('.first_name_cls').removeClass('disable');
});

$('#second_name').on('keyup', function (e) {
    $('.second_name_cls').removeClass('disable');
});

$('#surname').on('keyup', function (e) {
    $('.surname_cls').removeClass('disable');
});

$('#second_surname').on('keyup', function (e) {
    $('.second_surname_cls').removeClass('disable');
});

$('#married_surname').on('keyup', function (e) {
    $('.married_surname_cls').removeClass('disable');
});

$("#dpi_file").on('change', function (e) {
    var a = $('#dpi_file').val();
    let x = a.replace('C:\\fakepath\\', '');
    $(".dpi_file").html(x);
    $(".dpi_file_current").addClass('d-none');


});

$("#passport_file").on('change', function (e) {
    var a = $('#passport_file').val();
    let x = a.replace('C:\\fakepath\\', '');
    $(".passport_file").html(x);
    $(".passport_file_current").addClass('d-none');
});

$("#rtu").on('change', function () {
    var a = $('#rtu').val();
    let x = a.replace('C:\\fakepath\\', '');
    $(".rtu").html(x);
    $(".rtu_current").addClass('d-none');
    $(".rtu_main").addClass('file-presnt');
});

$("#appoinment").on('change', function (e) {
    var a = $('#appoinment').val();
    let x = a.replace('C:\\fakepath\\', '');
    $(".appoinment").html(x);
    $(".appoinment_current").addClass('d-none');
    $(".appoinment_main").addClass('file-presnt');
});

$("#company_trade_patent").on('change', function (e) {
    var a = $('#company_trade_patent').val();
    let x = a.replace('C:\\fakepath\\', '');
    $(".patente").html(x);
    $(".patente_current").addClass('d-none');
    $(".company_main").addClass('file-presnt');
});

$("#society_trade_patent").on('change', function (e) {
    var a = $('#society_trade_patent').val();
    let x = a.replace('C:\\fakepath\\', '');
    $(".Patente_Sociedad").html(x);
    $(".Patente_Sociedad_current").addClass('d-none');
    $(".society_main").addClass('file-presnt');
});
jQuery.validator.addMethod("lettersonly", function (value, element) {
    return this.optional(element) || /^[a-z]+$/i.test(value);
}, "Solo cartas por favor");
$(function () {
    $('#userForm').validate({
        rules: {
            first_name: {
                required: true,
            },
            surname: {
                required: true,
            },
            email: {
                required: true,
                email: true
            },
            password: {
                required: true,
                minlength: 8
            },
            password_confirmation: {
                required: true,
                equalTo: "#password"
            },
            terms_conditions: {
                required: true,

            }
        },
        messages: {
            first_name: {
                required: "Por favor ingrese su nombre",
            },
            surname: {
                required: "Por favor ingrese su apellido",
            },
            email: {
                required: "Por favor ingrese correo electrónico",
                email: "Por favor, introduce una dirección de correo electrónico válida "
            },
            password: {
                required: 'Introduce la contraseña',
                minlength: 'Ingrese al menos 8 caracteres.'
            },
            password_confirmation: {
                required: 'Ingrese la contraseña de confirmación',
                minlength: 'Ingrese al menos 8 caracteres.',
                equalTo: 'Las contraseñas no coinciden.'
            },
            terms_conditions: {
                required: 'Seleccione los términos y condiciones.'
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
        errorPlacement: function (error, element) {
            if (element.attr("name") == "terms_conditions") error.appendTo("#error_msg1");
            else error.insertAfter(element);
        }
    });
});

$("#profilePicUpload").on('change', function (e) {
    e.preventDefault();
    // var url = $('#siteurl').val();
    var form_data = new FormData($('#updateProfilePic')[0]);
    $.ajax({
        url: "user/profile-image",
        type: "POST",
        data: form_data,
        contentType: false,
        cache: false,
        processData: false,
        beforeSend: function () {
            $(".profilePic .error").html('');
            $(".profilePic .sucess").html('');
        },
        success: function (result) {
            if (result.status) {
                console.log('success');
                $(".profilePic .sucess").html(result.message);
            } else {
                console.log('mnv');
                if (result['message']['profileimg'][0])
                    $("#updateProfilePic .error_profileimg").html(result['message']['profileimg'][0]);
                else
                    $("#updateProfilePic .error_profileimg").html(result.message);
            }
        }
    });
});

$(".submitAccountInfo").on('click', function (e) {
    e.preventDefault();
    var form_data = new FormData($('#saveAccountInfo')[0]);
    $.ajax({
        url: "user/account-data",
        type: "POST",
        data: form_data,
        contentType: false,
        cache: false,
        processData: false,
        success: function (result) {
            if (result.status) {
                // $("#saveAccountInfo .success").html(result.message);
                $('.submitAccountInfo').addClass('disabled');
            } else {
                if (result.error) {
                    $("#saveAccountInfo .messageBox .error").html(result.message);
                } else {

                    // if(result.message = 'Invalid password') {
                    //     console.log(result.message);
                    //     $("#saveAccountInfo .error_current_password").html(result.message);
                    // } else {
                    $.each(result.message, function (key, value) {
                        if (value[0])
                            $("#saveAccountInfo .error_" + key).html(value[0]);
                    });
                    // }

                }
            }

        }
    });
});

$(".savePersonalInfo").on('click', function (e) {
    e.preventDefault();

    // $('a[data-toggle="pill"]').on('click', function(e) {
    window.localStorage.setItem('activeTab', $(e.target).attr('href'));
    // $.session.set('activeTab', $(e.target).attr('href'));
    // });
    var activeTab = window.localStorage.getItem('activeTab');
    // var activeTab = $.session.get('activeTab');
    if (activeTab) {
        $('#profile-tab a[href="' + activeTab + '"]').tab('show');
        // window.localStorage.removeItem("activeTab");
        // $.session.remove('activeTab');
    }

    // setCookie('test','1','1'); 
    var form_data = new FormData($('#updatePersonalInfo')[0]);
    $.ajax({
        url: "user/personal-data",
        type: "POST",
        data: form_data,
        contentType: false,
        cache: false,
        processData: false,
        success: function (result) {
            if (result.status) {
                $("#updatePersonalInfo .success").html(result.message);
                $("#updatePersonalInfo .savePersonalInfo").addClass('disabled');
                // $("#profile-personal").load("#profile-personal");
                // $("#upload_div").load();
                location.reload(true);

            } else {
                if (result.error) {
                    $("#updatePersonalInfo .messageBox .error").html(result.message);
                } else {

                    // if(result.message = 'Invalid password') {
                    //     console.log(result.message);
                    //     $("#saveAccountInfo .error_current_password").html(result.message);
                    // } else {
                    $.each(result.message, function (key, value) {
                        if (value[0])
                            $("#updatePersonalInfo .error_" + key).html(value[0]);
                    });
                    // }

                }
            }

        }
    });
});

$(".personal-div").on('change', function (e) {
    e.preventDefault();
    $("#updatePersonalInfo .savePersonalInfo").removeClass('disabled');
});

$(document).ready(function () {
    $("#datetimepicker5").on('click', function (e) {
        e.preventDefault();
        setTimeout(function () {
            // var tempDate = $('#dob').val();
            // for(var i=0;i<5;i++)
            var tempDate = $('#dob').val();
            var tempDate = new Date(tempDate);
            var currentTime = new Date();
            // returns the month (from 0 to 11)
            var month = currentTime.getMonth() + 1;
            // returns the day of the month (from 1 to 31)
            var day = currentTime.getDate();
            // returns the year (four digits)
            var year = currentTime.getFullYear();
            var temp_year = tempDate.getFullYear();
            var age = year - temp_year;
            console.log(age);
            $('.your-age').html(age);
            $("#updatePersonalInfo .savePersonalInfo").removeClass('disabled');
            // }


        }, 20000);

    });
});
$('#confirm_password').on('change', function (e) {
    e.preventDefault();
    $(".submitAccountInfo").removeClass('disabled');
});

$(".remove_rtu").on('click', function (e) {
    e.preventDefault();
    $.ajax({
        type: "GET",
        url: "user/remove-upload-file/1",
        dataType: 'json',
        contentType: false,
        cache: false,
        processData: false,
        success: function (json) {
            if (json.status) {
                $('.rtu_current').html('');
                $(".rtu_main").removeClass('file-presnt');
                $(".rtu_main .icon-downlad").html('<i class="icon-icons-arrow-circle-down"></i>');
            } else {

            }

        }
    });
});

$(".remove_appoinment").on('click', function (e) {
    e.preventDefault();
    $.ajax({
        type: "GET",
        url: "user/remove-upload-file/2",
        dataType: 'json',
        contentType: false,
        cache: false,
        processData: false,
        success: function (json) {
            if (json.status) {
                $('.appoinment_current').html('');
                $(".appoinment_main").removeClass('file-presnt');
                $(".appoinment_main .icon-downlad").html('<i class="icon-icons-arrow-circle-down"></i>');
            } else {

            }

        }
    });
});

$(".remove_patente").on('click', function (e) {
    e.preventDefault();
    $.ajax({
        type: "GET",
        url: "user/remove-upload-file/3",
        dataType: 'json',
        contentType: false,
        cache: false,
        processData: false,
        success: function (json) {
            if (json.status) {
                $('.patente_current').html('');
                $(".company_main").removeClass('file-presnt');
                $(".company_main .icon-downlad").html('<i class="icon-icons-arrow-circle-down"></i>');
            } else {

            }

        }
    });
});

$(".remove_Patente_Sociedad").on('click', function (e) {
    e.preventDefault();
    $.ajax({
        type: "GET",
        url: "user/remove-upload-file/4",
        dataType: 'json',
        contentType: false,
        cache: false,
        processData: false,
        success: function (json) {
            if (json.status) {
                $('.Patente_Sociedad_current').html('');
                $(".society_main").removeClass('file-presnt');
                $(".society_main .icon-downlad").html('<i class="icon-icons-arrow-circle-down"></i>');
            } else {

            }

        }
    });
});

$(".remove_dpi_file").on('click', function (e) {
    e.preventDefault();
    $.ajax({
        type: "GET",
        url: "user/remove-upload-file/5",
        dataType: 'json',
        contentType: false,
        cache: false,
        processData: false,
        success: function (json) {
            if (json.status) {
                $('.dpi_file_current').html('');
                $('.dpiHidden').html('');
            } else {

            }

        }
    });
});

$(".remove_passport_file").on('click', function (e) {
    e.preventDefault();
    $.ajax({
        type: "GET",
        url: "user/remove-upload-file/6",
        dataType: 'json',
        contentType: false,
        cache: false,
        processData: false,
        success: function (json) {
            if (json.status) {
                $('.passport_file_current').html('');
            } else {

            }

        }
    });
});

$(".withoutCredit").on('click', function (e) {
    e.preventDefault();
    $.ajax({
        type: "GET",
        url: "user/cancel-without-credit",
        dataType: 'json',
        contentType: false,
        cache: false,
        processData: false,
        success: function (json) {
            if (json.status) {
                location.reload(true);
            } else {

            }

        }
    });
});

$(".keepCredit").on('click', function (e) {
    e.preventDefault();
    $.ajax({
        type: "GET",
        url: "user/cancel-keep-credit",
        dataType: 'json',
        contentType: false,
        cache: false,
        processData: false,
        success: function (json) {
            if (json.status) {
                console.log('logout');
                location.reload(true);
            } else {

            }

        }
    });
});

$("#mensual").on('change', function (e) {
    e.preventDefault();
    $('.annualStandard').addClass('d-none');
    $('.annualPremium').addClass('d-none');
    $('.monthlyStandard').removeClass('d-none');
    $('.monthlyPremium').removeClass('d-none');

});

$("#anual").on('change', function (e) {
    e.preventDefault();
    $('.annualStandard').removeClass('d-none');
    $('.annualPremium').removeClass('d-none');
    $('.monthlyStandard').addClass('d-none');
    $('.monthlyPremium').addClass('d-none');

});


$('div.alert').not('.alert-important').delay(5000).fadeOut(350);
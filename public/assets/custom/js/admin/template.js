
if($('#legalDocumentEdit').val() != 'edit') {
    $(document).ready(function () {
        $('.nav-link').not('.active').addClass('disabled');
        $('.nav-link').not('.active').find('a').removeAttr("data-toggle");
    
        if($('#legalDocumentEdit').val() == 'edit') {
            $('.nav-link').not('.active').removeClass('disabled');
        }
    });
}


$.validator.addMethod('decimal', function (value, element) {
    return this.optional(element) || /^[0-9]{1,3}(,[0-9]{3})*\.[0-9]+$/.test(value);
}, "Please enter a correct number, format 0.00");

$(function () {
    $('#templateTable').DataTable({
        "language": {
            "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
        },
    });
    $('#template_form').validate({
        rules: {
            template_type: {
                required: true
            },
            document_name: {
                required: true,
                maxlength: 60,
                lettersonly: true
            },
            category_id: {
                required: true
            },
            document_description: {
                required: true
            },
            information_document: {
                required: true
            },
            document_authentication: {
                required: true
            },
            document_image: {
                required: true,
                accept: "image/png"
            },
            "subscription_category[]": {
                required: true
            },
            "document_required[]": {
                required: true
            },
            price: {
                required: true,
                decimal: true
            },

        },
        messages: {
            template_type: {
                required: "Ingrese el tipo de plantilla",
            },
            document_name: {
                required: "Ingrese el nombre del documento",
                maxlength: "No ingrese más de 60 caracteres"
            },
            category_id: {
                required: 'Ingrese categoría'
            },
            document_description: {
                required: 'Ingrese la descripción del documento'
            },
            information_document: {
                required: 'Ingresar documento de información'
            },
            document_authentication: {
                required: 'Ingrese la autenticación del documento'
            },
            document_image: {
                required: 'Seleccionar imagen de documento',
                accept: 'Sube el archivo solo en este formato (png).'
            },
            "subscription_category[]": {
                required: 'Ingrese la categoría de suscripción'
            },
            "document_required[]": {
                required: 'Ingrese el documento requerido'
            },
            price: {
                required: "Ingrese el precio",
                decimal: 'Ingrese un valor decimal'
            }
        },
        errorElement: 'label',
        errorClass: "text-danger",
        highlight: function (element) {
            return false;
        },
        unhighlight: function (element) {
            return false;
        },
        errorPlacement: function (error, element) {
            if (element.attr("name") == "template_type") error.appendTo("#error_msg1");
            else if (element.attr("name") == "document_authentication") error.appendTo("#error_msg2");
            else if (element.attr("name") == "category_id") error.appendTo("#error_msg3");
            else if (element.attr("name") == "document_required[]") error.appendTo("#error_msg4");
            else if (element.attr("name") == "subscription_category[]") error.appendTo("#error_msg6");
            else error.insertAfter(element);
        }
    });

    jQuery.validator.addMethod("lettersonly", function (value, element) {
        return this.optional(element) || /^[a-z0-9a-zñáéíóúü\s]+$/i.test(value);
    }, "Solo caracteres alfabéticos");
    $('#edit_template_form').validate({
        ignore: [],
        debug: false,
        rules: {
            template_type: {
                required: true
            },
            document_name: {
                required: true,
                maxlength: 60,
                lettersonly: true
            },
            category_id: {
                required: true
            },
            document_description: {
                required: true
            },
            information_document: {
                required: true
            },
            document_authentication: {
                required: true
            },
            "subscription_category[]": {
                required: true
            },
            "document_required[]": {
                required: true
            },
            document_image: {
                accept: "image/png"
            },
            text_body: {
                required: function () {
                    CKEDITOR.instances.text_body.updateElement();
                }
            },
            price: {
                required: true,
                decimal: true
            },


        },
        messages: {
            template_type: {
                required: "Ingrese el tipo de plantilla",
            },
            document_name: {
                required: "Ingrese el nombre del documento",
            },
            category_id: {
                required: 'Ingrese categoría'
            },
            document_description: {
                required: 'Ingrese la descripción del documento'
            },
            information_document: {
                required: 'Ingresar documento de información'
            },
            document_authentication: {
                required: 'Ingrese la autenticación del documento'
            },
            "subscription_category[]": {
                required: 'Ingrese la categoría de suscripción'
            },
            "document_required[]": {
                required: 'Ingrese el documento requerido'
            },
            document_image: {
                accept: 'Sube el archivo solo en este formato (png).'
            },
            text_body: {
                required: 'Ingrese el cuerpo del texto'
            },
            price: {
                required: "Ingrese el precio",
                decimal: 'Ingrese un valor decimal'
            }

        },
        errorElement: 'label',
        errorClass: "text-danger",
        highlight: function (element) {
            return false;
        },
        unhighlight: function (element) {
            return false;
        },
        errorPlacement: function (error, element) {
            if (element.attr("name") == "template_type") error.appendTo("#error_msg1");
            else if (element.attr("name") == "document_authentication") error.appendTo("#error_msg2");
            else if (element.attr("name") == "category_id") error.appendTo("#error_msg3");
            else if (element.attr("name") == "document_required[]") error.appendTo("#error_msg4");
            else if (element.attr("name") == "subscription_category[]") error.appendTo("#error_msg6");
            else if (element.attr("name") == "text_body") error.appendTo("#error_msg5");
            else error.insertAfter(element);
        }
    });
    $('#body_form').validate({
        ignore: [],
        debug: false,
        rules: {
            text_body: {
                required: function () {
                    CKEDITOR.instances.text_body.updateElement();
                }
            }
        },
        messages: {
            text_body: {
                required: 'Ingrese el cuerpo del texto'
            }

        },
        errorElement: 'label',
        errorClass: "text-danger",
        highlight: function (element) {
            return false;
        },
        unhighlight: function (element) {
            return false;
        },
        errorPlacement: function (error, element) {
            if (element.attr("name") == "text_body") error.appendTo("#error_msg5");
            else error.insertAfter(element);
        }
    });

    function noTableRow() {

        return $('a.deleteDocumentVariable').length == 0;
    }

    $('#template_step2_form').validate({
        rules: {
            variable_id: { required: noTableRow }
        },
        messages: {
            variable_id: {
                required: 'Seleccionar variable'
            }

        },
        errorElement: 'label',
        errorClass: "text-danger",
        highlight: function (element) {
            return false;
        },
        unhighlight: function (element) {
            return false;
        },
        errorPlacement: function (error, element) {
            if (element.hasClass('select2')) {
                error.insertAfter(element.next('span'));
            } else {
                error.insertAfter(element);
            }
        }
    });

});

$('#variableButton').on('click', function () {

    if($('#legalDocumentEdit').val() == 'edit') {
        console.log($('a.deleteDocumentVariable').length, '=============');
        // console.log($('#template_step2_form').valid());
        if($('a.deleteDocumentVariable').length == 0) {
            toastr.error('Seleccionar variable');
            return;
        }
        $('a[href="#step3"]').removeClass('disabled');
        $('a[href="#step3"]').trigger('click');

    } else {

        var tbody = $("#variableBody");
        $('#template_step2_form').valid();

        if ($('#template_step2_form').valid()) {

            if (tbody.children().length != 0) {

                $('a[href="#step3"]').removeClass('disabled');
                $('a[href="#step3"]').trigger('click');
                $('.nav-link').not('.active').addClass('disabled');
                $('a[href="#step2"]').removeClass('disabled');
                $('a[href="#step1"]').removeClass('disabled');

            }
        }

    }
});
$(document).on('click', '.btnNext', function () {
    $('.nav-pills .active').parent().next('li').find('a').removeClass('disabled');
    $('.nav-pills .active').parent().next('li').find('a').trigger('click');
    $('.nav-link').not('.active').addClass('disabled');

});

$(document).on('click', '#saveVariable', function () {
    var document_id = $('#document_id').val();
    var variable_id = $('#variable_id').val();
    var token = $('meta[name="csrf-token"]').attr('content');
    if (!$.trim($('#variable_id').val())) {
        alert("Por favor seleccione variable de información personal");
    }
    console.log(variable_id);
    $.ajax({
        url: "../../template/document-variable/store",
        method: "POST",
        data: { 'variable_id': variable_id, 'document_id': document_id, "_token": token },
    }).done(function (data) {
        console.log(data);
        populateInputVariableOptions();
        $('#inputVariableTable').find('tbody:last').html(data.view_1);
        $('#bodyVariableTable').find('tbody:last').html(data.view_2);
    });
});


$(document).on('click', '.deleteDocumentVariable', function () {
    var parenttr = $(this).closest("tr");
    var document_id = $('#document_id').val();
    var id = $(this).data("id");
    var auth_id = $(this).data("auth");
    console.log('document_id : ', document_id,'  id : ', id, '  authid : ', auth_id);
    var token = $("meta[name='csrf-token']").attr("content");
    swal({
        title: 'Estas seguro?',
        text: "¡No podrás revertir esto!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#0CC27E',
        cancelButtonColor: '#FF586B',
        confirmButtonText: '¡Sí, bórralo!',
        cancelButtonText: '¡No, cancelar!',
        confirmButtonClass: 'btn btn-success mr-5',
        cancelButtonClass: 'btn btn-danger',
        buttonsStyling: false
    }).then(function () {
        $.ajax(
            {
                url: "../../template/document-variable/delete/" + id,
                type: 'POST',
                data: {
                    "id": id,
                    "_token": token,
                    "auth_id": auth_id,
                    "document_id": document_id
                },
                success: function (output) {
                    if (output.status == "success") {
                        toastr.success(output.message);
                        parenttr.remove();

                    }
                    if (output.status == "error") {

                        toastr.error(output.message);



                    }
                },
                error: function (error) {
                    toastr.error("Algo salió mal. Por favor, vuelva a intentarlo");
                }
            }).done(function (data) {
                console.log(data);
                populateInputVariableOptions();
                $('#inputVariableTable').find('tbody:last').html(data.view_1);
                $('#bodyVariableTable').find('tbody:last').html(data.view_2);
            });
    }, function (dismiss) {

        if (dismiss === 'cancel') {
            swal(
                'Cancelado',
                'Tu archivo está seguro:)',
                'error'
            )
        }

    })

});

$(document).on("click", "#editDocumentVariable", function () {
    var id = $(this).attr("data-id");
    $(".modal-title ").text("Editar variable de información personal");
    var params = {};
    params['id'] = id;
    variableId = $(this).attr("data-variable-id");
    $.ajax({
        type: "POST",
        url: '../../template/document-variable/edit',
        data: params,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function (output) {
            // $('#myModal').modal('toggle');
            $('#myModal').modal('show');
            $('#edit_variable_template_id').val(id);
            $('#variable_id2').append($('<option disabled selected ></option>').val('').text("Seleccionar variable de información personal"));
            $('#variable_id2').empty();
            output.inputVariables.forEach(function(e, i) {

                // if(jQuery.inArray(e.id, output.documentVariables) != -1) {

                //     if(e.id == variableId) {
                //         $('#variable_id2').append($('<option disabled selected></option>').val(e.id).text(e.variable_name)); 
                //     } else {
                //         $('#variable_id2').append($('<option disabled></option>').val(e.id).text(e.variable_name)); 
                //     }
                    

                // } else {

                $('#variable_id2').append($('<option></option>').val(e.id).text(e.variable_name + '(' + e.variable_type_name + ')'));

                // } 

            });

            $('#variable_id2').val(variableId).change();
        },
        error: function (error) {
            toastr.error("Algo salió mal. Por favor, vuelva a intentarlo");
        }
    });
});

// $(document).on("click", "#editDocumentVariable", function () {
//     // var id = $(this).attr("data-id");
//     $(".modal-title ").text("Editar variable de información personal");
//     $('#myModal').modal('toggle');
//     $('#edit_variable_template_id').val($(this).attr("data-id"));
//     $('#edit_variable_id').val($(this).attr("data-variable-id"));
//     $('#edit_variable_name').val($(this).attr("data-name"));
//     $('#edit_variable_type').val($(this).attr("data-type-id")).attr("selected", "selected");
// });

$(document).on('submit', '#editDocumentForm', function (e) {
    e.preventDefault();
    var form = $('#editDocumentForm')[0];
    var params = new FormData(form);

    $.ajax({
        type: "POST",
        processData: false,
        contentType: false,
        cache: false,
        url: '../../template/document-variable/update',
        data: params,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    }).done(function (data) {

        if(data.status) {
            toastr.success(data.message);
            $('#myModal').modal('toggle');
            $('#inputVariableTable').find('tbody:last').html(data.view_1);
            $('#bodyVariableTable').find('tbody:last').html(data.view_2);
            populateInputVariableOptions();
        } else {
            toastr.error(data.message);
        }
    });
});


$(document).on('change', '.toggle-class-status', function () {
    var status = $(this).prop('checked') == true ? 1 : 0;
    var id = $(this).data('id');
    console.log(status);
    $.ajax({
        type: "GET",
        dataType: "json",
        url: '../../template/changeStatus',
        data: { 'status': status, 'id': id, _token: '{{csrf_token()}}' },
        success: function (output) {
            if (output.status == "success") {
                toastr.success(output.message);

            }
            if (output.status == "error") {

                toastr.error(output.message);



            }

        },
        error: function (error) {
            toastr.error("Algo salió mal. Por favor, vuelva a intentarlo");
        }
    });
});


$(document).on('change', '#template_type', function () {
    //console.log($(this).val());
    if ($(this).val() == 2) {
        $('#doc_authentication').hide();
        $('#doc_required').hide();
        $('#profile-icon-pill').hide();
        $("#contact-icon-pill").text("Step #2");

    }
    if ($(this).val() == 1) {
        $('#doc_category').show();
        $('#subscription_category').show();
        $('#doc_authentication').show();
        $('#doc_required').show();
        $('#profile-icon-pill').show();
        $("#contact-icon-pill").text("Step #3");
    }
});

$(document).on('submit', '#template_form', function (event) {
    event.preventDefault();
    $('span.text-danger').html('');
    var formData = new FormData(this);
    formData.append('document_id', $("#document_id").val());

    $.ajax({
        type: "post",
        url: "store",
        processData: false,
        data: formData,
        cache: false,
        contentType: false,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function (output) {
            console.log(output);
            if (output.status == "success") {
                $("#document_id").val(output.id);
                $("#document").val(output.id);
                $('#type_template').val(output.template_type);
                if (output.template_type == 2) {
                    $('a[href="#step3"]').removeClass('disabled');
                    $('a[href="#step3"]').trigger('click');
                    $('.nav-link').not('.active').addClass('disabled');
                }
                else {
                    $('a[href="#step2"]').removeClass('disabled');
                    $('a[href="#step2"]').trigger('click');
                    $('.nav-link').not('.active').addClass('disabled');
                    populateInputVariableOptions();
                }
                $('a[href="#step1"]').removeClass('disabled');
            }
            if (output.status == "error") {

                toastr.error(output.message);


            }
        },
        error: function (output) {
            var response = output.responseJSON;
            toastr.error(response.message);
            if (response.errors) {
                var i = 0;
                $.each(response.errors, function (index, obj) {
                    if (i == 0) {
                        $('input[name="' + index + '"]').focus();
                    }
                    $('[name="' + index + '"]').parents('div.form-group').find('span.text-danger').html(obj[0]);
                    i++;
                });
            }
        }

    });
});
$(document).on('click', '.subButton', function () {
    $('span.text-danger').html('');
});


$(document).on('submit', '#body_form', function (event) {
    event.preventDefault();
    $('span.text-danger').html('');
    var formData = new FormData(this);

    $.ajax({
        type: "post",
        url: "../../template/body/store",
        processData: false,
        data: formData,
        cache: false,
        contentType: false,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function (output) {
            console.log(output);
            if (output.status == "success") {
                toastr.success(output.message);
                setTimeout(function () {
                    window.location.href = output.redirect;
                }, 3000)
            }
            if (output.status == "error") {

                toastr.error(output.message);
            }
        },
        error: function (output) {
            var response = output.responseJSON;
            toastr.error(response.message);
            if (response.errors) {
                var i = 0;
                $.each(response.errors, function (index, obj) {
                    if (i == 0) {
                        $('input[name="' + index + '"]').focus();
                    }
                    $('[name="' + index + '"]').parents('div.form-group').find('span.text-danger').html(obj[0]);
                    i++;
                });
            }
        }
    });
});


/*********************** */

$('#variable_form').validate({

    normalizer: function( value ) {
        return $.trim( value );
    },

    rules: {
            variable_name: {
                required: true
            },
            variable_type: {
                required: true
            }
        },
    messages: {
        variable_name: {
            required: "Ingrese el nombre de la variable",
        },
        variable_type: {
            required: "Ingrese el tipo de variable",
        }
    },

    errorElement: 'label',
    errorClass: "text-danger",
    highlight: function (element) {
        return false;
    },
    unhighlight: function (element) {
        return false;
    },

    submitHandler : function (form, event) {
        event.preventDefault();

        var document_id = $("#document_id").val();

        var formData = new FormData($(form)[0]);

        formData.append('document_id', document_id);

        $.ajax({
            type: "post",
            url: "../../input-variable/store",
            processData: false,
            data: formData,
            cache: false,
            contentType: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (output) {
                console.log(output);
                if (output.status) {
                    toastr.success(output.message);
                    $("#newVariableModal").modal('hide');
                    $("#variable_type").val('');
                    $("#variable_name").val('');

                    populateInputVariableOptions();

                } else {
                    toastr.error(output.message);
                }
            },
            error: function (output) {
                var response = output.responseJSON;
                toastr.error(response.message);
                if (response.errors) {
                    var i = 0;
                    $.each(response.errors, function (index, obj) {
                        if (i == 0) {
                            $('input[name="' + index + '"]').focus();
                        }
                        $('[name="' + index + '"]').parents('div.form-group').find('span.text-danger').html(obj[0]);
                        i++;
                    });
                }
            }
        });
    }
});

function populateInputVariableOptions() {
    // ;input-variables
    $('.input-variables').empty();
    var document_id = $("#document_id").val();
    console.log(document_id);
    $.ajax({
        type: "GET",
        url: '../../template/get-all-variables',
        data: {'document_id': document_id},
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    }).done(function (data) {
        if(data.status) {
            // $('.input-variables').append($('<option disabled selected ></option>').val('').text("{{__('test.select personal information variable')}}"));
            $('.input-variables').append($('<option disabled selected ></option>').val('').text("Seleccionar variable de información personal"));
            data.data.forEach(function(e, i){
                $('.input-variables').append($('<option></option>').val(e.id).text(e.variable_name)); 
            });
        }
    });
}

/*********************** */
$(document).on('click', '.bodyButton', function () {
    $('span.text-danger').html('');
});

$("#variableModalCancel, .close").click(function () {        
    $("#newVariableModal").modal('hide');
    $("#myModal").modal('hide');
    $("#variable_type").val('');
    $("#variable_name").val('');
});

$(document).on('submit', '#edit_template_form', function (event) {
    event.preventDefault();
    $('span.text-danger').html('');
    var formData = new FormData(this);
    var url = $(this).attr('action');
    $.ajax({
        type: "post",
        url: url,
        processData: false,
        data: formData,
        cache: false,
        contentType: false,
        success: function (output) {
            console.log(output);
            if (output.status == "success") {
                if (output.template_type == 2) {
                    $('a[href="#step3"]').removeClass('disabled');
                    $('a[href="#step3"]').trigger('click');
                    $('.nav-link').not('.active').addClass('disabled');
                }
                toastr.success(output.message);
                setTimeout(function () {
                    window.location.href = output.redirect;
                }, 1000)

            }
        },
        error: function (output) {
            var response = output.responseJSON;
            toastr.error(response.message);
            if (response.errors) {
                var i = 0;
                $.each(response.errors, function (index, obj) {
                    if (i == 0) {
                        $('input[name="' + index + '"]').focus();
                    }
                    $('[name="' + index + '"]').parents('div.form-group').find('span.text-danger').html(obj[0]);
                    i++;
                });
            }
        },
    })
});
function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#thumb').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
}

$("#Ephoto").change(function () {
    readURL(this);
});

$('#customFileLang').on('change', function () {
    var fileName = $(this).val();
    fileName = fileName.replace("C:\\fakepath\\", "");
    $('.custom-file-label').html(fileName);
})
$('#Ephoto').on('change', function () {
    var fileName = $(this).val();
    fileName = fileName.replace("C:\\fakepath\\", "");
    $('.custom-file-label').html(fileName);
})

$('#contact-icon-pill').on('click', function (e) {
    e.preventDefault();

    var document_id = $('#document_id').val();

    if($('#legalDocumentEdit').val() == 'edit') {
        $.ajax({
            type: "GET",
            url: '../../template/edit-iput-variables',
            data: { 'document_id': document_id },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        }).done(function (data) {
            if(data.status) {
                $('#inputVariableTable').find('tbody:last').html(data.view_1);

                // if(!data.editable) {
                    
                //     $("#inputVariableTable > tbody > tr > td:last-child > a").addClass('disabled');
                // }
            } // else {
                // toastr.error(data.message);

            // }
        });
    }
});

// $('#variable_form').validate({
//     rules: {
//         variable_name: {
//             required: true
//         },
//         variable_type: {
//             required: true
//         }
//     },
//     messages: {
//         variable_name: {
//             required: "Ingrese el nombre de la variable",
//         },
//         variable_type: {
//             required: "Ingrese el tipo de variable",
//         }

//     },
//     errorElement: 'label',
//     errorClass: "text-danger",
//     highlight: function (element) {
//         return false;
//     },
//     unhighlight: function (element) {
//         return false;
//     }
// });

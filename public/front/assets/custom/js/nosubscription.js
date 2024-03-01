$.validator.addMethod('decimal', function (value, element) {
    return this.optional(element) || /^[0-9]{1,3}(,[0-9]{3})*\.[0-9]+$/.test(value);
}, "Ingrese un número correcto, formato 0.00");
$(function () {
    $('.field_class').each(function () {
        if ($(this).attr('data-label-type') == 'string') {
            $(this).rules("add", { required: true, messages: { required: 'este campo es requerido' } })
        }
        if ($(this).attr('data-label-type') == 'date') {

            $(this).rules("add", { required: true, messages: { required: 'este campo es requerido' } })
        }
        if ($(this).attr('data-label-type') == 'decimal') {
            $(this).rules("add", { required: true, decimal: true, messages: { required: 'este campo es requerido', decimal: 'por favor ingrese un número valido' } })
        }
        if ($(this).attr('data-label-type') == 'integer') {
            $(this).rules("add", { required: true, number: true, maxlength: 10, messages: { required: 'este campo es requerido', number: 'Por favor solo inserte numeros', maxlength: 'El valor no puede ser mayor que 10' } })
        }
        if ($(this).attr('data-label-type') == 'year') {
            $(this).rules("add", { required: true, messages: { required: 'este campo es requerido' } })
        }
    });


    $('.input-field').bind('keyup blur', function () {
        if ($("#no_subscription_buy_fill_form").valid()) {
            $(".btn-blue").removeClass('disabled');
            $('.btn-blue').attr('type', 'submit');
        } else {
            $('.btn-blue').attr('type', 'button');
            $(".btn-blue").addClass('disabled');
        }
    });

    $('.fill-field').bind('keyup blur', function () {
        if ($("#no_subscription_fill_buy_form").valid()) {
            $(".btn-blue").removeClass('disabled');
            $('.btn-blue').attr('type', 'submit');
        } else {
            $('.btn-blue').attr('type', 'button');
            $(".btn-blue").addClass('disabled');
        }
    });


    $('.edit-input-field').bind("keyup blur", function () {
        if ($("#edit_no_subscription_buy_fill_form").valid()) {
            $(".btn-blue").removeClass('disabled');
            $('.btn-blue').attr('type', 'submit');
        } else {
            $('.btn-blue').attr('type', 'button');
            $(".btn-blue").addClass('disabled');
        }
    });

    $('.edit-fill-field').bind('keyup blur', function () {
        if ($("#edit_no_subscription_fill_buy_form").valid()) {
            $(".btn-blue").removeClass('disabled');
            $('.btn-blue').attr('type', 'submit');
        } else {
            $('.btn-blue').attr('type', 'button');
            $(".btn-blue").addClass('disabled');
        }
    });


    $('.edit-after-field').bind('keyup blur', function () {
        if ($("#edit_after_purchase_form").valid()) {
            $(".btn-blue").removeClass('disabled');
            $('.btn-blue').attr('type', 'submit');
        } else {
            $('.btn-blue').attr('type', 'button');
            $(".btn-blue").addClass('disabled');
        }
    });

});

var validator = $("#no_subscription_buy_fill_form").validate({
    errorElement: 'label',
    errorClass: "val-error",
    highlight: function (element) {
        return false;
    },
    unhighlight: function (element) {
        return false;
    },
    errorPlacement: function (error, element) {
        if (element.attr("class") == "form-control datetimepicker-input not_dob field_class input-field") error.appendTo(element.parents('.confirm-val').last());
        else if (element.attr("class") == "form-control datetimepicker-input dob field_class input-field") error.appendTo(element.parents('.confirm-val').last());

        else error.insertAfter(element);
    }
});

var validator = $("#edit_no_subscription_buy_fill_form").validate({
    errorElement: 'label',
    errorClass: "val-error",
    highlight: function (element) {
        return false;
    },
    unhighlight: function (element) {
        return false;
    },
    errorPlacement: function (error, element) {
        if (element.attr("class") == "form-control datetimepicker-input not_dob field_class edit-input-field") error.appendTo(element.parents('.confirm-val').last());
        else if (element.attr("class") == "form-control datetimepicker-input dob field_class edit-input-field") error.appendTo(element.parents('.confirm-val').last());
        else error.insertAfter(element);
    }
});

var validator = $("#no_subscription_fill_buy_form").validate({
    errorElement: 'label',
    errorClass: "val-error",
    highlight: function (element) {
        return false;
    },
    unhighlight: function (element) {
        return false;
    },
    errorPlacement: function (error, element) {
        if (element.attr("class") == "form-control datetimepicker-input not_dob field_class fill-field") error.appendTo(element.parents('.confirm-val').last());
        else if (element.attr("class") == "form-control datetimepicker-input dob field_class fill-field") error.appendTo(element.parents('.confirm-val').last());
        else error.appendTo(element.next());
    }
});

var validator = $("#edit_no_subscription_fill_buy_form").validate({
    errorElement: 'label',
    errorClass: "val-error",
    highlight: function (element) {
        return false;
    },
    unhighlight: function (element) {
        return false;
    },
    errorPlacement: function (error, element) {
        if (element.attr("class") == "form-control datetimepicker-input not_dob field_class edit-fill-field") error.appendTo(element.parents('.confirm-val').last());
        else if (element.attr("class") == "form-control datetimepicker-input dob field_class edit-fill-field") error.appendTo(element.parents('.confirm-val').last());
        else error.insertAfter(element);
    }
});
var validator = $("#edit_after_purchase_form").validate({
    errorElement: 'label',
    errorClass: "val-error",
    highlight: function (element) {
        return false;
    },
    unhighlight: function (element) {
        return false;
    },
    errorPlacement: function (error, element) {
        if (element.attr("class") == "form-control datetimepicker-input not_dob field_class edit-after-field") error.appendTo(element.parents('.confirm-val').last());
        else if (element.attr("class") == "form-control datetimepicker-input dob field_class edit-after-field") error.appendTo(element.parents('.confirm-val').last());
        else error.insertAfter(element);
    }
});


$(document).on('submit', '#no_subscription_fill_buy_form', function (event) {
    if ($("#no_subscription_fill_buy_form").valid()) {
        $(".btn-blue").removeClass('disabled');
    } else {
        $(".btn-blue").addClass('disabled');
    }
    event.preventDefault();
    $('label.val-error').html('');
    var formData = new FormData(this);
    $.ajax({
        type: "post",
        url: save_fill_buy,
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
                window.location.href = output.redirect;
                $('#document_template_id').val(output.id);
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
                    $('[name="' + index + '"]').parents('div.form-group').find('span.val-error').html(obj[0]);
                    i++;
                });
            }
        }
    });
});

$(document).on('submit', '#no_subscription_buy_fill_form', function (event) {
    if ($("#no_subscription_buy_fill_form").valid()) {
        $(".btn-blue").removeClass('disabled');
    } else {
        $(".btn-blue").addClass('disabled');
    }
    event.preventDefault();
    $('label.val-error').html('');
    var formData = new FormData(this);
    $.ajax({
        type: "post",
        url: save_buy_fill,
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
                window.location.href = output.redirect;
                $('#document_template_id').val(output.id);
            }
        },
        error: function (output) {
            var response = output.responseJSON;
            if (response.errors) {
                var i = 0;
                $.each(response.errors, function (index, obj) {
                    if (i == 0) {
                        $('input[name="' + index + '"]').focus();
                    }
                    $('[name="' + index + '"]').parents('div.form-group').find('span.val-error').html(obj[0]);
                    i++;
                });
            }
        }
    });
});

$(document).on('submit', '#edit_no_subscription_fill_buy_form', function (event) {
    if ($("#edit_no_subscription_fill_buy_form").valid()) {
        $(".btn-blue").removeClass('disabled');
    } else {
        $(".btn-blue").addClass('disabled');
    }
    event.preventDefault();
    $('label.val-error').html('');
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
                window.location.href = output.redirect;
                $('#document_template_id').val(output.id);
            }
        },
        error: function (output) {
            var response = output.responseJSON;
            if (response.errors) {
                var i = 0;
                $.each(response.errors, function (index, obj) {
                    if (i == 0) {
                        $('input[name="' + index + '"]').focus();
                    }
                    $('[name="' + index + '"]').parents('div.form-group').find('span.val-error').html(obj[0]);
                    i++;
                });
            }
        },
    })
});
$(document).on('submit', '#edit_no_subscription_buy_fill_form', function (event) {
    if ($("#edit_no_subscription_buy_fill_form").valid()) {
        $(".btn-blue").removeClass('disabled');
    } else {
        $(".btn-blue").addClass('disabled');
    }
    event.preventDefault();
    $('label.val-error').html('');
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
                window.location.href = output.redirect;
                $('#document_template_id').val(output.id);
            }
        },
        error: function (output) {
            var response = output.responseJSON;
            if (response.errors) {
                var i = 0;
                $.each(response.errors, function (index, obj) {
                    if (i == 0) {
                        $('input[name="' + index + '"]').focus();
                    }
                    $('[name="' + index + '"]').parents('div.form-group').find('span.val-error').html(obj[0]);
                    i++;
                });
            }
        }
    });

});

$(document).on('submit', '#edit_after_purchase_form', function (event) {
    if ($("#edit_after_purchase_form").valid()) {
        $(".btn-blue").removeClass('disabled');
    } else {
        $(".btn-blue").addClass('disabled');
    }
    event.preventDefault();
    $('label.val-error').html('');
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
                window.location.href = output.redirect;
            }
        },
        error: function (output) {
            var response = output.responseJSON;
            if (response.errors) {
                var i = 0;
                $.each(response.errors, function (index, obj) {
                    if (i == 0) {
                        $('input[name="' + index + '"]').focus();
                    }
                    $('[name="' + index + '"]').parents('div.form-group').find('span.val-error').html(obj[0]);
                    i++;
                });

            }
        }
    });
});

$(document).ready(function () {

    $('#rememberdata').change(function () {
        var document_id = $('#document_id').val();
        var id = $('#user_id').val();
        var token = $("meta[name='csrf-token']").attr("content");
        if (this.checked) {
            $.ajax({
                url: fetch_user_data,
                method: 'POST',
                dataType: 'json',
                data: { "id": id, "document_id": document_id, "_token": token },
                success: function (response) {
                    var labels = response.labels;
                    var users = response.user;
                    var label_count = labels.label
                    var fields = [];
                    var name = [];
                    for (var i = 0; i < label_count.length; i++) {
                        fields[i] = 'field_' + i;
                        name[i] = label_count[i].label_name;
                    }
                    $.each([fields, name], function () {
                        $.each(this, function (k, v) {
                            if (name[k] == 'Primer Nombres') {
                                $('#' + fields[k]).val(users.first_name);
                            }
                            if (name[k] == 'Primer Apellido') {
                                $('#' + fields[k]).val(users.surname);
                            }
                            if (name[k] == 'Fecha de nacimiento') {
                                const dateTime = users.date_of_birth;
                                const parts = dateTime.split(/[- :]/);
                                const wanted = `${parts[2]}/${parts[1]}/${parts[0]}`;
                                $('#' + fields[k]).val(wanted);
                                $('.Tiene-0-aos-de-edad').html('Tiene ' + users.age + ' años de edad.');
                            }
                            if (name[k] == 'Dirección') {
                                $('#' + fields[k]).val(users.direction);
                            }
                        });
                    });

                    if ($("#no_subscription_buy_fill_form").valid()) {
                        $(".btn-blue").removeClass('disabled');
                        $('.btn-blue').attr('type', 'submit');
                    } else {
                        $('.btn-blue').attr('type', 'button');
                        $(".btn-blue").addClass('disabled');
                    }
                },
                error: function (err) {
                    console.log(err);
                }

            });
        }
    });
});
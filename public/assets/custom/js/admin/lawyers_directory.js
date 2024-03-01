$(function () {
    $('#directoryTable').DataTable({
        "language": {
            "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
        },
    });
    $('#directory_form').validate({
        rules: {
            lawyer_name: {
                required: true
            },
            lawyer_address: {
                required: true
            },
            zone: {
                required: true
            },
            township: {
                required: true
            },
            department: {
                required: true
            },
            email: {
                required: true,
                email: true
            },
            phone: {
                required: true,
                number: true,
                minlength: 8
            },

        },
        messages: {
            lawyer_name: {
                required: "Ingrese el nombre del abogado",
            },
            lawyer_address: {
                required: "Ingrese la dirección del abogado",
            },
            zone: {
                required: "Ingrese la zona",
            },
            township: {
                required: "Ingrese municipio",
            },
            department: {
                required: "Ingrese departamento / estado",
            },
            email: {
                required: "Por favor ingrese su correo electrónico",
                email: "Por favor, introduce una dirección de correo electrónico válida "
            },
            phone: {
                required: "Ingrese el número de teléfono",
                number: "Por favor ingrese un número valido",
                minlength: "Ingrese al menos 8 caracteres"
            },
        },
        errorElement: 'label',
        errorClass: "text-danger",
        highlight: function (element) {
            return false;
        },
        unhighlight: function (element) {
            return false;
        }
    });


    $('#edit_directory_form').validate({
        rules: {
            lawyer_name: {
                required: true
            },
            lawyer_address: {
                required: true
            },
            zone: {
                required: true
            },
            township: {
                required: true
            },
            department: {
                required: true
            },
            email: {
                required: true,
                email: true
            },
            phone: {
                required: true,
                number: true,
                minlength: 8
            },

        },
        messages: {
            lawyer_name: {
                required: "Ingrese el nombre del abogado",
            },
            lawyer_address: {
                required: "Ingrese la dirección del abogado",
            },
            zone: {
                required: "Ingrese la zona",
            },
            township: {
                required: "Ingrese municipio",
            },
            department: {
                required: "Ingrese departamento / estado",
            },
            email: {
                required: "Por favor ingrese su correo electrónico",
                email: "Por favor, introduce una dirección de correo electrónico válida "
            },
            phone: {
                required: "Ingrese el número de teléfono",
                number: "Por favor ingrese un número valido",
                minlength: "Ingrese al menos 8 caracteres"
            },
        },
        errorElement: 'label',
        errorClass: "text-danger",
        highlight: function (element) {
            return false;
        },
        unhighlight: function (element) {
            return false;
        }
    });


    $('#priceForm').validate({
        rules: {
            price: {
                required: true
            },
        },
        messages: {
            price: {
                required: "Ingrese precio",
            },
        }
    });
});
$('.toggle-class-status').change(function () {
    var status = $(this).prop('checked') == true ? 1 : 0;
    var id = $(this).data('id');
    console.log(status);
    $.ajax({
        type: "GET",
        dataType: "json",
        url: 'lawyers-directory/changeStatus',
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

$('.deleteDirectory').on('click', function () {
    var $button = $(this);
    var id = $(this).data("id");
    var auth_id = $(this).data("auth");
    var table = $('#directoryTable').DataTable();
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
                url: "lawyers-directory/delete/" + id,
                type: 'POST',
                data: {
                    "id": id,
                    "_token": token,
                    "auth_id": auth_id
                },
                success: function (output) {
                    if (output.status == "success") {
                        toastr.success(output.message);
                        table.row($button.parents('tr')).remove().draw();

                    }
                    if (output.status == "error") {

                        toastr.error(output.messages[0]);


                    }
                },
                error: function (error) {
                    toastr.error("Algo salió mal. Por favor, vuelva a intentarlo");
                }
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

$(document).on("click", "#editPriceForm", function () {
    var id = $(this).attr("data-id");
    $(".modal-title ").text("Asignar precio");
    var params = {};
    params['id'] = id;
    $.ajax({
        type: "POST",
        url: 'assign/price',
        data: params,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function (output) {
            $('#myModal').modal('toggle');
            $('#directory_id').val(output.id);
            $('#price').val(output.price);
        },
        error: function (error) {
            toastr.error("Algo salió mal. Por favor, vuelva a intentarlo");
        }
    });

});
$(document).on('submit', '#priceForm', function (e) {
    e.preventDefault();

    var form = $('#priceForm')[0];

    var params = new FormData(form);


    $.ajax({
        type: "POST",
        processData: false,
        contentType: false,
        cache: false,
        url: 'price/update',
        data: params,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function (output) {
            if (output.status == "success") {
                $('#myModal').modal('toggle');
                toastr.success(output.message);
                $("#priceForm").trigger("reset");
                setTimeout(function () {
                    location.reload()
                }, 1000);

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
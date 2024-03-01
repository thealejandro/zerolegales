$(function () {
    $('#priceMatrixTable').DataTable({
        "language": {
            "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
        },
    });

    $('#price_matrix_form').validate({
        rules: {
            subscription_id: {
                required: true
            },
            document_id: {
                required: true
            },
            payment_type: {
                required: true
            },
            price: {
                required: true
            }
        },
        messages: {
            subscription_id: {
                required: "Seleccione el tipo de suscripción",
            },
            document_id: {
                required: "Seleccionar plantilla de documento legal",
            },
            payment_type: {
                required: "Ingrese el tipo de pago",
            },
            price: {
                required: "Ingrese precio",
            }
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
    $('#edit_price_matrix_form').validate({
        rules: {
            subscription_id: {
                required: true
            },
            document_id: {
                required: true
            },
            payment_type: {
                required: true
            },
            price: {
                required: true
            }
        },
        messages: {
            subscription_id: {
                required: "Seleccione el tipo de suscripción",
            },
            document_id: {
                required: "Seleccionar plantilla de documento legal",
            },
            payment_type: {
                required: "Ingrese el tipo de pago",
            },
            price: {
                required: "Ingrese precio",
            }
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
});

$('#subscription_id').on('change', function (e) {
    var optionSelected = $("option:selected", this);
    var subscription_id = this.value;
    console.log(subscription_id);
    if (subscription_id == '1') {
        $('#one_time').show();
        $('#other_subscription').hide();
    }
    if (subscription_id == '2' || subscription_id == '3') {
        $('#other_subscription').show();
        $('#one_time').hide();
    }
});

$('.deleteMatrix').on('click', function () {
    var $button = $(this);
    var id = $(this).data("id");
    var auth_id = $(this).data("auth");
    var table = $('#priceMatrixTable').DataTable();
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
                url: "price-matrix/delete/" + id,
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

                        toastr.error(output.message);



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

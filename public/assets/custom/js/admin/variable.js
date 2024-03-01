
$(function () {
    $('#variableTable').DataTable({
        "language": {
            "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
        },
    });
    $('#variable_form').validate({
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
        }
    });
    $('#edit_variable_form').validate({
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
        }
    });
});
$('.deleteVariable').on('click', function () {
    var $button = $(this);
    var id = $(this).data("id");
    var auth_id = $(this).data("auth");
    var table = $('#variableTable').DataTable();
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
                url: "input-variable/delete/" + id,
                type: 'DELETE',
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

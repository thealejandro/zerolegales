$(function () {
    $('#userTable').DataTable({
        "language": {
            "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
        },
    });
});

$('.toggle-class-status').change(function () {
    var status = $(this).prop('checked') == true ? 1 : 0;
    var id = $(this).data('id');
    console.log(status);
    $.ajax({
        type: "GET",
        dataType: "json",
        url: 'users/changeStatus',
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

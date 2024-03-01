$(document).on('submit', '#document_purchase_form', function (event) {
    event.preventDefault();
    $('span.text-danger').html('');
    var formData = new FormData(this);
    $.ajax({
        type: "post",
        url: legalisation,
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
                    $('[name="' + index + '"]').parents('div.form-group').find('span.text-danger').html(obj[0]);
                    i++;
                });
            }
        }

    })
});

$(document).on('click', '#chooselegaloc .dropdown-menu .dropdown-item', function(e){
    $("#dropdcst").mCustomScrollbar();
    var department = $(this).find('h6').text();
    $('.dropdown-select-2').text(department);
    var token = $("meta[name='csrf-token']").attr("content");

    $.ajax({
        type: 'POST',
        url: legaldocument_change,
        data: { department: department,  "_token": token },
        dataType: "json",
        success: function (data) {
            $("#dropdcst").mCustomScrollbar("destroy");
            $("#chooselegaladvs").html(data.html);
        },
        complete: function () {
            $("#dropdcst").mCustomScrollbar({
                autoHideScrollbar: true
            })
        }
    });
}); 

$(".search1").on('keyup', function () {
    var search = $(this).val();
    $.ajax({
        type: 'get',
        url: document_search,
        data: { 'search': search },
        success: function (output) {
            // console.log(output);
            if (output.status == "error") {

                toastr.error(output.message); 
            }
        }

    }).done(function (data) {
        $(".list-doc-wrap").html(data);
    });
});

$(".search2").on('keyup', function () {
    search = $(this).val();
    $.ajax({
        type: 'get',
        url: search_document,
        data: { 'search': search },
        success: function (output) {
            // console.log(output);
            if (output.status == "error") {

                toastr.error(output.message);
            }
        }

    }).done(function (data) { 
        console.log(data);
        $(".list-doc-wrap").html(data);
    });
});

// $("#search2").on('click', function () {
    


$(document).ready(function () {
    $(".clearvalue").click(function () {
        console.log('mnv');
        $('.search2').val() = NULL;
        
    });
});

$(document).ready(function () {
    $('#search-input').focus();
});
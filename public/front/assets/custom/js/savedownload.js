$(document).ready(function () {
    $("#rememberdata").change(function () {
        if (this.checked) {
            $('#download').removeClass('disabled');
            $('.pdf-success-redirect').addClass('d-none');
            $('.pdf-success').addClass('d-none');
        }
        else {

            $('#download').addClass('disabled');
            $('.pdf-success-redirect').addClass('d-none');
            $('.pdf-success').addClass('d-none');
        }
    });

    $("#download").click(function () {
        $('.pdf-success-redirect').removeClass('d-none');
        $('.pdf-success').removeClass('d-none');
        $('#download').addClass('disabled');
        $('#rememberdata').attr('disabled', true).prop("checked", false);
        $('.terms_under_cond').removeAttr('data-target');
        if ($(this).hasClass('disabled')) {
            var document_id = $(this).attr('data-document-id');
            var id = $(this).attr('data-document-template-id');
            var token = $("meta[name='csrf-token']").attr("content");
            var status = 1;
            $.ajax({
                url: download_status,
                type: 'post',
                data: { "id": id, "document_id": document_id, "status": status, "_token": token },
                dataType: 'json',
                success: function () {
                    console.log('value has been updated');
                }
            });
        }
        else {
            var document_id = $(this).attr('data-document-id');
            var id = $(this).attr('data-document-template-id');
            var token = $("meta[name='csrf-token']").attr("content");
            var status = 2;
            $.ajax({
                url: download_status,
                type: 'post',
                data: { "id": id, "document_id": document_id, "status": status, "_token": token },
                dataType: 'json',
                success: function () {
                    console.log('value has been updated');
                }
            });
        }
    });
});
// function downloadDocument(document_id, id) {
//     setTimeout(function () {
//         document.location.pathname = "document/after-download/" + document_id + "/" + id;
//     }, 1000);
// }
function getDownloadPDF() {
    var element = window.document.getElementById("cert-preview-content").innerHTML;
    var opt = {
        margin: [25.4, 25.4, 25.4, 25.4],
        filename: 'document.pdf',
        image: { type: 'jpeg', quality: 0.98 },
        html2canvas: { scale: 2 },
        jsPDF: { unit: 'mm', format: 'a4', orientation: 'portrait' },
        pagebreak: { mode: ['avoid-all', 'css', 'legacy'] }
    };

    string = html2pdf().from(element).set(opt).toPdf().get('pdf').then(function (pdf) {

    }).save();
}
function numberWithCommas(number) {
    var parts = number.toString().split(".");
    parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    return parts.join(".");
}
$(document).ready(function () {
    var document_id = $('#document_id').val();
    var id = $('#document_template_id').val();
    var token = $("meta[name='csrf-token']").attr("content");
    $.ajax({
        url: labels,
        method: 'POST',
        dataType: 'json',
        data: { "id": id, "document_id": document_id, "_token": token },
        success: function (response) {
            var labels = response.labels;
            var names = response.label_names;
            var label_count = labels.label;
            var fields = [];
            var name = [];
            for (var i = 0; i < label_count.length; i++) {
                fields[i] = 'field_' + i;
                name[i] = label_count[i].label_type;
            }
            $.each([fields, name], function () {
                $.each(this, function (k, v) {
                    if (name[k] == 'date') {
                        const dateTime = names[fields[k]];
                        const parts = dateTime.split(/[- :]/);
                        const wanted = `${parts[2]}/${parts[1]}/${parts[0]}`;
                        $('.cert-content .' + fields[k]).html(wanted);
                        $('.cert-content .' + fields[k]).css("color", "var(--dark-2)");

                    }
                    else {
                        if (name[k] == 'decimal') {
                            nameString = numberWithCommas(names[fields[k]]);
                            $('.cert-content .' + fields[k]).html(nameString);
                            $('.cert-content .' + fields[k]).css("color", "var(--dark-2)");

                        }
                        else {
                            $('.cert-content .' + fields[k]).html(names[fields[k]]);
                            $('.cert-content .' + fields[k]).css("color", "var(--dark-2)");

                        }


                    }
                });
            });
            getPDF();
        },
        error: function (err) {
            console.log(err);
        }

    });


});

$(document).ready(function () {
    $("#savedoc").change(function () {
        if (this.checked) {
            $('#download').addClass('d-none');
            $('#savedownload').removeClass('d-none');
            $('#savedownload').addClass('disabled');
            $('.pdf-success-redirect').addClass('d-none');
            $('.pdf-success').addClass('d-none');
            $('#savedownload').attr('type', 'button');
            $('.terms_under_cond').attr('data-target', '#termsandcondition');
            $('#rememberdata').attr('disabled', false).prop("checked", false);
            $("#rememberdata").change(function () {
                if (this.checked) {
                    $('#savedownload').removeClass('disabled');
                }
                else {

                    $('#savedownload').addClass('disabled');
                }
            });
            $("#savedownload").click(function () {
                $('.pdf-success-redirect').addClass('d-none');
                $('.pdf-success').addClass('d-none');
                $('#savedownload').addClass('disabled');
                $('#savedownload').attr('disabled', true);
                $('#rememberdata').attr('disabled', false).prop("checked", false);

            });
        }
        else {
            $("#myfolder_form").trigger('reset'); 
            $('#download').removeClass('d-none');
            $('#download').addClass('disabled');
            $('#savedownload').addClass('d-none');
            $('.pdf-success-redirect').addClass('d-none');
            $('.pdf-success').addClass('d-none');
            $('.terms_under_cond').attr('data-target', '#termsandcondition');
            $('#rememberdata').attr('disabled', false).prop("checked", false);
            $("#rememberdata").change(function () {
                if (this.checked) {
                    $('#download').removeClass('disabled');
                }
                else {
                    $('#download').addClass('disabled');
                }
            });
        }
    });

});
$('.field_class').bind('keyup blur', function () {
    if ($("#myfolder_form").valid()) {
        if ($('#rememberdata').prop("checked", true)) {
            $("#savedownload").removeClass('disabled');
            $('#savedownload').attr('type', 'button');
            $("#savedownload").click(function () {
                $('.pdf-success-redirect').removeClass('d-none');
                $('.pdf-success').removeClass('d-none');
                $('#savedownload').addClass('disabled');
                $('#rememberdata').attr('disabled', true).prop("checked", true);
                $('.terms_under_cond').removeAttr('data-target');
                if ($("#savedownload").hasClass('disabled')) {
                    $('#savedownload').attr('disabled', true);
                    $('#myfolder_form').submit();
                }

            });
        }
        else {
            $('#savedownload').attr('type', 'button');
            $("#savedownload").addClass('disabled');
            $('.pdf-success-redirect').addClass('d-none');
            $('.pdf-success').addClass('d-none');
            $('.terms_under_cond').attr('data-target', true);
            $('#savedownload').attr('disabled', false);
        }
        $("#rememberdata").change(function () {
            if (this.checked) {
                $("#savedownload").removeClass('disabled');
                $('#savedownload').attr('type', 'submit');
                $('#savedownload').attr('disabled', false);
                $("#savedownload").click(function () {
                    $('.pdf-success-redirect').removeClass('d-none');
                    $('.pdf-success').removeClass('d-none');
                    $('#savedownload').addClass('disabled');
                    $('#rememberdata').attr('disabled', true).prop("checked", true);
                    $('.terms_under_cond').removeAttr('data-target');
                    if ($("#savedownload").hasClass('disabled')) {
                        $('#savedownload').attr('disabled', true);
                        $('#myfolder_form').submit();
                    }

                    // $('.btn-blue').attr('type', 'button');                  
                });
            }
            if (!this.checked) {
                $('#savedownload').attr('type', 'button');
                $('#savedownload').addClass('disabled');
                $('.terms_under_cond').attr('data-target', '#termsandcondition');
                $('#savedownload').attr('disabled', true);
                $("#savedownload").click(function () {
                    $('.pdf-success-redirect').addClass('d-none');
                    $('.pdf-success').addClass('d-none');
                    $('#savedownload').addClass('disabled');
                    $('#savedownload').attr('disabled', true);
                    $('#rememberdata').attr('disabled', false).prop("checked", false);

                });
            }
        });

    } else {
        $('#savedownload').attr('type', 'button');
        $("#savedownload").addClass('disabled');
        $('.pdf-success-redirect').addClass('d-none');
        $('.pdf-success').addClass('d-none');
        $('.terms_under_cond').attr('data-target', '#termsandcondition');
        $('#savedownload').attr('disabled', false);
    }
});
$('#myfolder_form').validate({
    rules: {
        document_name: {
            required: true
        },
        document_description: {
            required: true
        }
    },
    messages: {
        document_name: {
            required: "Ingrese el nombre del documento",
        },
        document_description: {
            required: "Ingrese la descripción del documento",
        }
    },
    errorElement: 'label',
    errorClass: "val-error",
    highlight: function (element) {
        return false;
    },
    unhighlight: function (element) {
        return false;
    }
});
function getPDF() {

    // var doc = new jsPDF('p', 'mm', [700, 1200]);

    // // source can be HTML-formatted string, or a reference
    // // to an actual DOM element from which the text will be scraped.
    // source = $('.cert-preview')[0];


    // // all coords and widths are in jsPDF instance's declared units
    // // 'inches' in this case
    // doc.addHTML(
    //     source,
    //     0, 0,// HTML string or DOM elem ref.
    //     { pagesplit: true, margin: { top: 60, right: 0, bottom: 0, left: 0, useFor: 'page' } },

    //     function (dispose) {
    //         // dispose: object with X, Y of the last line add to the PDF 
    //         //          this allow the insertion of new lines after html
    //         addWaterMark(doc);
    //         var string = doc.output('datauristring');
    //         pdfToCanvas(string);
    //         // doc.save("Test.pdf");

    //     },
    // );

    var element = window.document.getElementById("preview-content").innerHTML;
    var opt = {
        margin: [25.4, 25.4, 25.4, 25.4],
        filename: 'myfile.pdf',
        image: { type: 'jpeg', quality: 0.98 },
        html2canvas: { scale: 2 },
        jsPDF: { unit: 'mm', format: 'a4', orientation: 'portrait' },
        pagebreak: { mode: ['avoid-all', 'css', 'legacy'] }
    };

    string = html2pdf().from(element).set(opt).toPdf().output('datauristring').then(function (string) {

        pdfToCanvas(string);
    })
    // .save();
}

function pdfToCanvas(string) {

    var base64result = string.substr(string.indexOf(',') + 1);
    $(".cert-preview").replaceWith('<div id="view-pdf">');
    var pdfData = atob(base64result);
    var pdfjsLib = window['pdfjs-dist/build/pdf'];
    pdfjsLib.GlobalWorkerOptions.workerSrc = '//mozilla.github.io/pdf.js/build/pdf.worker.js';
    function renderPage(num, pdf) {
        pdf.getPage(num).then(function (page) {
            var imgId = 'pdf-view-' + num;
            var canvas = document.createElement('canvas');
            var desiredWidth = 1000;
            var viewport = page.getViewport({ scale: 1.3 });
            var scale = desiredWidth / viewport.width;
            var scaledViewport = page.getViewport({ scale: scale, });
            var context = canvas.getContext('2d');
            canvas.height = scaledViewport.height;
            canvas.width = scaledViewport.width;
            var renderContext = {
                canvasContext: context,
                viewport: viewport
            };
            var renderTask = page.render(renderContext);
            renderTask.promise.then(function () {
                var link = document.createElement("img");
                link.href = canvas.toDataURL("image/png");
                $("#view-pdf").append('<div class="cert-preview"><div class="zoom-view" id="zoom-view-' + num + '" style="z-index: 3;"><button class="btn btn-blue btn-circle"><i class="icon-icons-maximize"></i></button></div><img class="img-fluid zoom drift-demo-trigger lazyload" draggable="false" id="' + imgId + '" src="' + link.href + '" data-zoom="' + link.href + '" alt=""></div>');

                // var status = "enable";
                // $("#zoom-view-" + num).click(function () {

                //     $(this).toggleClass('zoomwrp');

                //     $(this).find("button").toggleClass('zoom-active');

                //     if (status == "enable") {
                //         status = "disable";

                //         $zoom = $('#' + imgId).magnify({
                //             // magnifiedWidth : 900,
                //             // magnifiedHeight : 1200
                //             finalWidth: 700
                //         });
                //     }
                //     else {
                //         status = "enable";
                //         $zoom.destroy();
                //     }
                // })

                var status = "disable";
                var drift = new Drift(document.querySelector('#' + imgId), {
                    inlinePane: true,
                    zoomFactor: 1.5,
                });;
                drift.disable();
                $("#zoom-view-" + num).click(function () {
                    $(this).toggleClass('zoomwrp');
                    $(this).find("button").toggleClass('zoom-active');


                    if (status == "enable") {
                        status = "disable";
                        drift.disable();
                    }
                    else {
                        status = "enable";
                        drift.enable();
                    }
                })

            });
        });
    }
    function renderAllPages(pdf) {
        for (var i = 1; i <= pdf.numPages; i++) {
            renderPage(i, pdf);
        }
    }
    // Asynchronous download of PDF
    var loadingTask = pdfjsLib.getDocument({ data: pdfData });
    loadingTask.promise.then(function (pdf) {
        // Fetch the first page
        renderAllPages(pdf);
    }, function (reason) {
        // PDF loading error
        //console.error(reason);
    });
}


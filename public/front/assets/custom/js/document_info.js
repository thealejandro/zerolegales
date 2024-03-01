
$(document).on('submit', '#legalisation_form', function (event) {
    event.preventDefault();
    $('span.text-danger').html('');
    var formData = new FormData(this);
    $.ajax({
        type: "post",
        url: myfolder_legalisation,
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


$(document).on('click', '#chooselegaloc .dropdown-menu .dropdown-item', function (e) {
    $("#dropdcst").mCustomScrollbar();
    var department = $(this).find('h6').text();
    $('.dropdown-select-2').text(department);
    var token = $("meta[name='csrf-token']").attr("content");
    $.ajax({
        type: 'POST',
        url: legaldocument_change,
        data: { department: department, "_token": token },
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

$('#checklegalizatin').on('change', function (event) {
    $('.content-show').toggleClass("active");
    if ($('.content-show').hasClass("active")) {
        $('.content-show').hide();
    }
    else {
        // $(this).text("Show");
        $('.content-show').show();

    }
    $('.more-legal-price').toggle();
    if (!$(this).is(':checked')) {
        $('.doc-authentication').hide();
        $('.legalization').hide();
    }
    else {
        $('.doc-authentication').show();
        $('.legalization').show();

    }

});
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


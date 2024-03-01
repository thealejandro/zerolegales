$(function () {
    $('#edit_terms_conditions_form').validate({
        ignore: [],
        debug: false,
        rules: {
            condition_text: {
                required: function () {
                    CKEDITOR.instances.condition_text.updateElement();
                }
            }
        },
        messages: {
            condition_text: {
                required: "Ingrese términos y condiciones",
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
            if (element.attr("name") == "condition_text") error.appendTo("#error_msg5");
            else error.insertAfter(element);
        }
    });
});

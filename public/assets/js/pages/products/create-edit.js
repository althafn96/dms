"use strict";

// Class definition
var ProductAdd = (function () {
    // Base elements
    var formEl;
    var validator;
    var wizard;
    var avatar;

    // Private functions
    var initWizard = function () {
        // Initialize form wizard
        wizard = new KTWizard("add_supplier_product_wizard", {
            startStep: 1, // initial active step number
            clickableSteps: true, // allow step clicking
        });

        // Validation before going to next page
        // wizard.on("beforeNext", function (wizardObj) {
        //     if (validator.form() !== true) {
        //         wizardObj.stop(); // don't go to the next step
        //     }
        // });

        // Change event
        // wizard.on("change", function (wizard) {
        //     KTUtil.scrollTop();
        // });
    };

    var initValidation = function () {
        validator = formEl.validate({
            // Validate only visible fields
            ignore: ":hidden",

            // Validation rules
            rules: {
                title: {
                    required: true,
                },
                price: {
                    required: true,
                    number: true,
                },
                supplier: {
                    required: true,
                },
            },

            // Display error
            invalidHandler: function (event, validator) {
                KTUtil.scrollTop();

                notify_toast(
                    "la la-warning",
                    "Error",
                    "danger",
                    "please fill all required fields"
                );
            },

            // Submit valid form
            submitHandler: function (form) {},
        });
    };

    return {
        // public functions
        init: function () {
            formEl = $("#kt_product_add_form");

            initWizard();
            initValidation();
        },
    };
})();

$("#category").select2({
    ajax: {
        url: $("#category_field").data("url"),
        dataType: "json",
        data: function (params) {
            var query = {
                search: params.term,
                product: $("#product_id").val(),
            };

            return query;
        },

        processResults: function (data) {
            // Transforms the top-level key of the response object from 'items' to 'results'
            return {
                results: $.map(data, function (item) {
                    return {
                        text: item.title,
                        id: item.id,
                    };
                }),
            };
        },
    },
    width: "100%",
});

$("#category").change(function () {
    if ($("#category").val() == "-1") {
        $("#add_product_category_form").modal({
            backdrop: "static",
            keyboard: false,
        });

        var c_id = $("#product_id").data("category");
        if (c_id == undefined) {
            $("#category").val("").trigger("change");
        } else {
            $("#category").val(c_id).trigger("change");
        }
    }
});

$("#supplier").select2({
    ajax: {
        url: $("#supplier_field").data("url"),
        dataType: "json",
        data: function (params) {
            var query = {
                search: params.term,
                product: $("#product_id").val(),
            };

            return query;
        },

        processResults: function (data) {
            // Transforms the top-level key of the response object from 'items' to 'results'
            return {
                results: $.map(data, function (item) {
                    return {
                        text: item.fname,
                        id: item.id,
                    };
                }),
            };
        },
    },
    width: "100%",
});

$("#add_product_category_form").on("hidden.bs.modal", function (e) {
    $("#category").select2("open");
});

$("#store-product-category-btn").click(function () {
    var btn = $(this);
    var url = btn.data("url");

    var data = {
        category_title: $("#category_title").val(),
    };

    saveItemNoForm(data, url, btn, "POST", "none")
        .then((data) => {
            if (data.type == "Success") {
                setTimeout(() => {
                    $("#add_product_category_form").modal("hide");
                }, 1000);
            }
        })
        .catch((error) => {});
});
// var KTproductUpdate = (function () {
//     // Base elements
//     var wizardEl;
//     var formEl;
//     var validator;
//     var wizard;
//     var avatar;

//     // Private functions
//     var initWizard = function () {
//         // Initialize form wizard
//         wizard = new KTWizard("update_supplier_product_wizard", {
//             startStep: 1, // initial active step number
//             clickableSteps: true, // allow step clicking
//         });

//         // Validation before going to next page
//         wizard.on("beforeNext", function (wizardObj) {
//             if (validator.form() !== true) {
//                 wizardObj.stop(); // don't go to the next step
//             }
//         });

//         // Change event
//         wizard.on("change", function (wizard) {
//             KTUtil.scrollTop();
//         });
//     };

//     var initValidation = function () {
//         validator = formEl.validate({
//             // Validate only visible fields
//             ignore: ":hidden",

//             // Validation rules
//             rules: {
//                 name: {
//                     required: true,
//                 },
//                 street_name: {
//                     required: true,
//                 },
//                 city: {
//                     required: true,
//                 },
//                 province: {
//                     required: true,
//                 },
//                 mobile_1: {
//                     required: true,
//                 },
//                 email: {
//                     required: true,
//                     email: true,
//                 },
//             },

//             // Display error
//             invalidHandler: function (event, validator) {
//                 KTUtil.scrollTop();

//                 notify_toast(
//                     "la la-warning",
//                     "Error",
//                     "danger",
//                     "please fill all required fields"
//                 );
//             },

//             // Submit valid form
//             submitHandler: function (form) {},
//         });
//     };

//     var initproductForm = function () {
//         avatar = new KTAvatar("kt_product_add_avatar");
//     };

//     return {
//         // public functions
//         init: function () {
//             formEl = $("#kt_product_update_form");

//             initWizard();
//             initValidation();
//             initproductForm();
//         },
//     };
// })();

$("#store-product-btn").click(function () {
    var btn = $(this);
    var url = btn.data("url");
    var form = $("#kt_product_add_form");
    var loadUrl = $(".back-btn").attr("href");

    form.validate({
        rules: {
            title: {
                required: true,
            },
            price: {
                required: true,
                number: true,
            },
            supplier: {
                required: true,
            },
        },
    });

    if (!form.valid()) {
        return;
    }

    submitFormNoImage(form, url, btn, "POST", loadUrl);
});

$("#update-product-btn").click(function () {
    var btn = $(this);
    var url = btn.data("url");
    var form = $("#kt_product_update_form");
    var loadUrl = $(".back-btn").attr("href");

    form.validate({
        rules: {
            title: {
                required: true,
            },
            price: {
                required: true,
                number: true,
            },
            supplier: {
                required: true,
            },
        },
    });

    if (!form.valid()) {
        return;
    }

    submitFormNoImage(form, url, btn, "PUT", loadUrl);
});

jQuery(document).ready(function () {
    ProductAdd.init();
});

"use strict";

// Class definition
var KTUserAdd = (function () {
    // Base elements
    var wizardEl;
    var formEl;
    var validator;
    var wizard;
    var avatar;

    // Private functions
    var initWizard = function () {
        // Initialize form wizard
        wizard = new KTWizard("add_supplier_user_wizard", {
            startStep: 1, // initial active step number
            clickableSteps: true, // allow step clicking
        });

        // Validation before going to next page
        wizard.on("beforeNext", function (wizardObj) {
            if (validator.form() !== true) {
                wizardObj.stop(); // don't go to the next step
            }
        });

        // Change event
        wizard.on("change", function (wizard) {
            KTUtil.scrollTop();
        });
    };

    var initValidation = function () {
        validator = formEl.validate({
            // Validate only visible fields
            ignore: ":hidden",

            // Validation rules
            rules: {
                name: {
                    required: true,
                },
                street_name: {
                    required: true,
                },
                city: {
                    required: true,
                },
                province: {
                    required: true,
                },
                mobile_1: {
                    required: true,
                },
                email: {
                    required: true,
                    email: true,
                },
                password: {
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

    var initUserForm = function () {
        avatar = new KTAvatar("kt_user_add_avatar");
    };

    return {
        // public functions
        init: function () {
            formEl = $("#kt_user_add_form");

            initWizard();
            initValidation();
            initUserForm();
        },
    };
})();

var KTUserUpdate = (function () {
    // Base elements
    var wizardEl;
    var formEl;
    var validator;
    var wizard;
    var avatar;

    // Private functions
    var initWizard = function () {
        // Initialize form wizard
        wizard = new KTWizard("update_supplier_user_wizard", {
            startStep: 1, // initial active step number
            clickableSteps: true, // allow step clicking
        });

        // Validation before going to next page
        wizard.on("beforeNext", function (wizardObj) {
            if (validator.form() !== true) {
                wizardObj.stop(); // don't go to the next step
            }
        });

        // Change event
        wizard.on("change", function (wizard) {
            KTUtil.scrollTop();
        });
    };

    var initValidation = function () {
        validator = formEl.validate({
            // Validate only visible fields
            ignore: ":hidden",

            // Validation rules
            rules: {
                name: {
                    required: true,
                },
                street_name: {
                    required: true,
                },
                city: {
                    required: true,
                },
                province: {
                    required: true,
                },
                mobile_1: {
                    required: true,
                },
                email: {
                    required: true,
                    email: true,
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

    var initUserForm = function () {
        avatar = new KTAvatar("kt_user_add_avatar");
    };

    return {
        // public functions
        init: function () {
            formEl = $("#kt_user_update_form");

            initWizard();
            initValidation();
            initUserForm();
        },
    };
})();

$("#store-supplier-btn").click(function () {
    var btn = $(this);
    var url = btn.data("url");
    var form = $("#kt_user_add_form");
    var loadUrl = $(".back-btn").attr("href");

    form.validate({
        rules: {
            name: {
                required: true,
            },
            street_name: {
                required: true,
            },
            city: {
                required: true,
            },
            province: {
                required: true,
            },
            mobile_1: {
                required: true,
            },
            email: {
                required: true,
                email: true,
            },
            password: {
                required: true,
            },
        },
    });

    if (!form.valid()) {
        return;
    }

    submitFormNoImage(form, url, btn, "POST", loadUrl);
});

$("#update-supplier-btn").click(function () {
    var btn = $(this);
    var url = btn.data("url");
    var form = $("#kt_user_update_form");
    var loadUrl = $(".back-btn").attr("href");

    form.validate({
        rules: {
            name: {
                required: true,
            },
            street_name: {
                required: true,
            },
            city: {
                required: true,
            },
            province: {
                required: true,
            },
            mobile_1: {
                required: true,
            },
            email: {
                required: true,
                email: true,
            },
        },
    });

    if (!form.valid()) {
        return;
    }

    submitFormNoImage(form, url, btn, "PUT", loadUrl);
});

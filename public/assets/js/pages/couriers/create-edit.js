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
        wizard = new KTWizard("add_courier_user_wizard", {
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

var KTFormRepeater = (function () {
    // Private functions
    var formRepeater = function () {
        $("#kt_repeater_1").repeater({
            initEmpty: false,

            defaultValues: {
                "text-input": "foo",
            },

            show: function () {
                $(this).slideDown();
            },

            hide: function (deleteElement) {
                $(this).slideUp(deleteElement);
            },
        });
    };
    return {
        // public functions
        init: function () {
            formRepeater();
        },
    };
})();

var KTBootstrapSelect = (function () {
    // Private functions
    var btSelect = function () {
        // minimum setup
        $(".kt-selectpicker").selectpicker();
    };

    return {
        // public functions
        init: function () {
            btSelect();
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
        wizard = new KTWizard("update_courier_user_wizard", {
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

$("#store-courier-btn").click(function () {
    var btn = $(this);
    var url = btn.data("url");
    var form = $("#kt_user_add_form");
    var loadUrl = $(".back-btn").attr("href");

    form.validate({
        rules: {
            name: {
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

$("#update-courier-btn").click(function () {
    var btn = $(this);
    var url = btn.data("url");
    var form = $("#kt_user_update_form");
    var loadUrl = $(".back-btn").attr("href");

    form.validate({
        rules: {
            name: {
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

$("#add_driver_to_courier").click(function () {
    var btn = $(this);
    var url = btn.data("url");
    var edit_url = btn.data("edit");
    var remove_url = btn.data("remove");
    var data = {
        driver_name: $("#driver_name").val(),
        vehicle: $("#vehicle").val(),
        vehicle_num: $("#vehicle_num").val(),
        nic: $("#nic").val(),
        courier_id: $("#courier_id").val(),
    };

    saveItemNoForm(data, url, btn, "POST", "none")
        .then((response) => {
            if (response.type == "Success") {
                var vehicle = $("#vehicle").val();
                var driver_name = $("#driver_name").val();
                var vehicle_num = $("#vehicle_num").val();

                var icon = "";

                if (vehicle == "Motor Bike") {
                    icon = "fa fa-motorcycle";
                } else if (vehicle == "Tuk") {
                    icon = "fa fa-caravan";
                } else if (vehicle == "Car") {
                    icon = "fa fa-car-side";
                } else if (vehicle == "Van") {
                    icon = "fa fa-shuttle-van";
                }

                var el =
                    `
                <div id="driver_list_item_` +
                    response.id +
                    `" data-id="{{ $question->id }}" class="kt-widget2__item kt-widget2__item--brand question-item-{{ $question->id }}">
                    <div style="margin-left: 2rem; margin-right: 1rem" class="` +
                    icon +
                    `">
                    
                    </div>
                    <div style="width: 100%" class="kt-widget2__info">
                        <a href="#" onclick="return false;" class="kt-widget2__title">
                        ` +
                    driver_name +
                    `
                        </a>
                        
                        Vehicle No: 
                        ` +
                    vehicle_num +
                    `
                        
                    </div>
                    <div class="kt-widget2__actions">
                        <a href="#" class="btn btn-clean btn-sm btn-icon btn-icon-md" data-toggle="dropdown">
                            <i class="flaticon-more-1"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-fit dropdown-menu-right">
                            <ul class="kt-nav">
                                <li class="kt-nav__item">
                                    <a data-id="` +
                    response.id +
                    `" data-url="` +
                    edit_url +
                    `" class="kt-nav__link edit-courier-item">
                                        <i class="kt-nav__link-icon flaticon2-gear"></i>
                                        <span class="kt-nav__link-text">Edit</span>
                                    </a>
                                </li>
                                <li class="kt-nav__item">
                                    <a data-id="` +
                    response.id +
                    `" data-url="` +
                    remove_url +
                    `" class="kt-nav__link remove-courier-item">
                                        <i class="kt-nav__link-icon flaticon2-trash"></i>
                                        <span class="kt-nav__link-text">Remove</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                `;

                $("#drivers_section").removeAttr("style");
                $("#drivers_list").append(el);

                $("#driver_name").val("");
                $("#vehicle_num").val("");
                $("#nic").val("");
            }
        })
        .catch((error) => {});
});

$("#drivers_list").on("click", ".edit-courier-item", function () {
    var id = $(this).data("id");
    var url = $(this).data("url") + "/" + id;

    console.log(url);

    editOrDeleteItem(url, "GET")
        .then((response) => {
            if (response.type == "Success") {
                $("#edit_driver_name").val(response.temp_driver.driver_name);
                $("#edit_vehicle").val(response.temp_driver.vehicle);
                $("#edit_vehicle_num").val(response.temp_driver.vehicle_num);
                $("#edit_nic").val(response.temp_driver.nic);

                $("#update_courier_temp_driver").data(
                    "id",
                    response.temp_driver.id
                );
                $("#edit_vehicle").selectpicker("refresh");
                $("#temp_courier_driver_edit").modal("show");
            }
        })
        .catch((error) => {});
});

$("#update_courier_temp_driver").click(function () {
    var btn = $(this);
    var url = btn.data("url") + "/" + btn.data("id");
    var edit_url = btn.data("edit");
    var remove_url = btn.data("remove");

    var data = {
        driver_name: $("#edit_driver_name").val(),
        vehicle: $("#edit_vehicle").val(),
        vehicle_num: $("#edit_vehicle_num").val(),
        nic: $("#edit_nic").val(),
    };

    saveItemNoForm(data, url, btn, "PUT", "none")
        .then((response) => {
            if (response.type == "Success") {
                var vehicle = $("#edit_vehicle").val();
                var driver_name = $("#edit_driver_name").val();
                var vehicle_num = $("#edit_vehicle_num").val();

                var icon = "";

                if (vehicle == "Motor Bike") {
                    icon = "fa fa-motorcycle";
                } else if (vehicle == "Tuk") {
                    icon = "fa fa-caravan";
                } else if (vehicle == "Car") {
                    icon = "fa fa-car-side";
                } else if (vehicle == "Van") {
                    icon = "fa fa-shuttle-van";
                }

                var el =
                    `
                <div style="margin-left: 2rem; margin-right: 1rem" class="` +
                    icon +
                    `">
                
                </div>
                <div style="width: 100%" class="kt-widget2__info">
                    <a href="#" onclick="return false;" class="kt-widget2__title">
                    ` +
                    driver_name +
                    `
                    </a>
                    
                    Vehicle No: 
                    ` +
                    vehicle_num +
                    `
                    
                </div>
                <div class="kt-widget2__actions">
                    <a href="#" class="btn btn-clean btn-sm btn-icon btn-icon-md" data-toggle="dropdown">
                        <i class="flaticon-more-1"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-fit dropdown-menu-right">
                        <ul class="kt-nav">
                            <li class="kt-nav__item">
                                <a data-id="` +
                    response.id +
                    `" data-url="` +
                    edit_url +
                    `" class="kt-nav__link edit-courier-item">
                                    <i class="kt-nav__link-icon flaticon2-gear"></i>
                                    <span class="kt-nav__link-text">Edit</span>
                                </a>
                            </li>
                            <li class="kt-nav__item">
                                <a data-id="` +
                    response.id +
                    `" data-url="` +
                    remove_url +
                    `" class="kt-nav__link remove-courier-item">
                                    <i class="kt-nav__link-icon flaticon2-trash"></i>
                                    <span class="kt-nav__link-text">Remove</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            `;

                $("#driver_list_item_" + response.id).html(el);

                $("#edit_driver_name").val("");
                $("#edit_vehicle").val("Motor Bike");
                $("#edit_vehicle_num").val("");
                $("#edit_nic").val("");

                $("#edit_vehicle").selectpicker("refresh");
                $("#update_courier_temp_driver").data("id", "");
                $("#temp_courier_driver_edit").modal("hide");
            }
        })
        .catch((error) => {});
});

$("#drivers_list").on("click", ".remove-courier-item", function () {
    var id = $(this).data("id");
    var url = "../" + $(this).data("url") + "/" + id;

    editOrDeleteItem(url, "DELETE")
        .then((response) => {
            if (response.type == "Success") {
                notify_toast(
                    "la la-check-circle",
                    response.type,
                    "success",
                    response.text
                );

                $("#driver_list_item_" + id).remove();
                if (response.count == "0") {
                    $("#drivers_section").css("display", "none");
                }
            }
        })
        .catch((error) => {});
});

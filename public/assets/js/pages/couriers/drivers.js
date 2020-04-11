jQuery(document).ready(function () {
    KTBootstrapSelect.init();
});

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

$("#add_driver_form").submit(function (e) {
    e.preventDefault();

    var btn = $("#add_driver_to_courier");
    var url = btn.data("url");

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
                $("#nic").val("");
                $("#driver_name").val("");
                $("#vehicle_num").val("");

                dtTable.ajax.reload();
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
                $("#courier_driver_edit").modal("show");
            }
        })
        .catch((error) => {});
});

function editDtItem(id, url) {
    editOrDeleteItem(url, "GET")
        .then((response) => {
            if (response.type == "Success") {
                $("#edit_driver_name").val(response.courier_driver.driver_name);
                $("#edit_vehicle").val(response.courier_driver.vehicle);
                $("#edit_vehicle_num").val(response.courier_driver.vehicle_num);
                $("#edit_nic").val(response.courier_driver.nic);

                $("#update_courier_driver").attr(
                    "data-id",
                    response.courier_driver.id
                );
                $("#edit_vehicle").selectpicker("refresh");
                $("#courier_driver_edit").modal("show");
            }
        })
        .catch((error) => {});
}

$("#update_driver_form").submit(function (e) {
    e.preventDefault();
    var btn = $("#update_courier_driver");
    var url = btn.data("url") + "/" + btn.data("id");

    var data = {
        driver_name: $("#edit_driver_name").val(),
        vehicle: $("#edit_vehicle").val(),
        vehicle_num: $("#edit_vehicle_num").val(),
        nic: $("#edit_nic").val(),
    };

    saveItemNoForm(data, url, btn, "PUT", "none")
        .then((response) => {
            if (response.type == "Success") {
                dtTable.ajax.reload();
            }
        })
        .catch((error) => {});
});

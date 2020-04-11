function notify_toast(
    icon,
    title,
    type,
    message,
    from = "bottom",
    align = "left",
    enter = "animated slideInLeft",
    exit = "animated slideOutLeft"
) {
    $.notify(
        {
            // options
            icon: icon,
            message: message,
            title: title,
        },
        {
            type: type,
            placement: {
                from: from,
                align: align,
            },
            animate: {
                enter: enter,
                exit: exit,
            },
            icon_type: "class",
            template:
                '<div data-notify="container" class="col-xs-11 col-sm-3 alert alert-{0}" role="alert">' +
                '<button type="button" aria-hidden="true" class="close" data-notify="dismiss"></button>' +
                '<div class="row">' +
                '<div class="col-md-1"><span data-notify="icon"></span></div>' +
                '<div class="col-md-11"><span data-notify="title">{1}</span></div>' +
                '<div class="col-md-11"><span data-notify="message">{2}</span></div>' +
                "</div></div>",
        }
    );
}

$(".create-btn, .back-btn").click(function () {
    $(this)
        .addClass(
            "kt-spinner kt-spinner--left kt-spinner--sm kt-spinner--light"
        )
        .html("&nbsp;Loading");
});

function removeDtItem(id, url) {
    $.ajax({
        type: "DELETE",
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        url: url,
        success: function (response, status, xhr, $form) {
            if (response.type === "Success") {
                dtTable.ajax.reload();
                notify_toast(
                    "la la-check-circle",
                    response.type,
                    "success",
                    response.text
                );
            } else {
                notify_toast(
                    "la la-warning",
                    "Error",
                    "warning",
                    "unknown error occurred. please try again later"
                );
            }
        },
        error: function (response) {
            if (response.status == "401") {
                notify_toast(
                    "la la-warning",
                    "Warning",
                    "warning-type",
                    "session expired. please login to continue"
                );

                setTimeout(() => {
                    location.reload();
                }, 1000);
            } else {
                notify_toast(
                    "la la-warning",
                    "Error",
                    "warning",
                    "unknown error occurred. please try again later"
                );
            }

            btn.removeClass(
                "kt-spinner kt-spinner--right kt-spinner--sm kt-spinner--light"
            ).removeAttr("disabled");
        },
    });
}

function change_status(changeTo, id, url, rowCount) {
    data = {
        id: id,
        changeTo: changeTo,
    };
    $.ajax({
        type: "POST",
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        data: data,
        url: url,
        success: function (response, status, xhr, $form) {
            if (response.type === "Success") {
                // dtTable.ajax.reload();
                child_el = $(".child ul li").html();
                console.log(child_el);

                if (child_el == undefined) {
                    el =
                        `
                        <div class="kt-badge ` +
                        response.class +
                        ` kt-badge--inline kt-badge--pill">
                            <a class="dropdown-toggle" style="color: white" data-toggle="dropdown" href="#">` +
                        response.title +
                        `</a>
                            <div class="dropdown-menu">
                                <button class="dropdown-item" onclick="change_status('` +
                        response.change +
                        `', '` +
                        id +
                        `', '` +
                        url +
                        `', '` +
                        rowCount +
                        `')">` +
                        response.action +
                        `</button>
                            </div>
                        </div>
                    `;
                    dtTable.cell(rowCount, -2).data(el);
                } else {
                    var data_dtr_index = -2;
                    var data_dt_row = rowCount;
                    var data_dt_column = -2;

                    console.log(
                        $(".child [data-dt-row=" + data_dt_row + "]")
                            .filter(
                                ".child [data-dt-column=" + data_dt_column + "]"
                            )
                            .html()
                    );

                    var el =
                        `<span class="dtr-title">Total Received</span>
                                <span class="dtr-data">` +
                        response.val +
                        `</span>`;
                    $(".child [data-dt-row=" + data_dt_row + "]")
                        .filter(
                            ".child [data-dt-column=" + data_dt_column + "]"
                        )
                        .html("csc");
                }
                notify_toast(
                    "la la-check-circle",
                    response.type,
                    "success",
                    response.text
                );
            } else {
                notify_toast(
                    "la la-warning",
                    "Error",
                    "warning",
                    "unknown error occurred. please try again later"
                );
            }
        },
        error: function (response) {
            if (response.status == "401") {
                notify_toast(
                    "la la-warning",
                    "Warning",
                    "warning-type",
                    "session expired. please login to continue"
                );

                setTimeout(() => {
                    location.reload();
                }, 1000);
            } else {
                notify_toast(
                    "la la-warning",
                    "Error",
                    "warning",
                    "unknown error occurred. please try again later"
                );
            }
        },
    });
}

function saveItemNoForm(data, url, btn, type, loadUrl = null) {
    btn.addClass(
        "kt-spinner kt-spinner--right kt-spinner--sm kt-spinner--light"
    ).attr("disabled", true);

    return new Promise((resolve, reject) => {
        $.ajax({
            type: type,
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            data: data,
            url: url,
            success: function (response, status, xhr, $form) {
                if (response.type === "Error") {
                    notify_toast(
                        "la la-warning",
                        response.type,
                        "danger",
                        response.text
                    );

                    btn.removeClass(
                        "kt-spinner kt-spinner--right kt-spinner--sm kt-spinner--light"
                    ).removeAttr("disabled");
                } else if (response.type === "Success") {
                    notify_toast(
                        "la la-check-circle",
                        response.type,
                        "success",
                        response.text
                    );

                    if (loadUrl == null) {
                        setTimeout(() => {
                            location.reload();
                        }, 1000);
                    } else if (loadUrl == "none") {
                        btn.removeClass(
                            "kt-spinner kt-spinner--right kt-spinner--sm kt-spinner--light"
                        ).removeAttr("disabled");
                    } else {
                        setTimeout(() => {
                            window.location.href = loadUrl;
                        }, 1000);
                    }
                } else {
                    notify_toast(
                        "la la-warning",
                        "Error",
                        "warning",
                        "unknown error occurred. please try again later"
                    );

                    btn.removeClass(
                        "kt-spinner kt-spinner--right kt-spinner--sm kt-spinner--light"
                    ).removeAttr("disabled");
                }

                resolve(response);
            },
            error: function (response) {
                if (response.status == "401") {
                    notify_toast(
                        "la la-warning",
                        "Warning",
                        "warning-type",
                        "session expired. please login to continue"
                    );

                    setTimeout(() => {
                        location.reload();
                    }, 1000);
                } else {
                    notify_toast(
                        "la la-warning",
                        "Error",
                        "warning",
                        "unknown error occurred. please try again later"
                    );
                }

                btn.removeClass(
                    "kt-spinner kt-spinner--right kt-spinner--sm kt-spinner--light"
                ).removeAttr("disabled");

                reject(response);
            },
        });
    });
}

function editOrDeleteItem(url, type) {
    return new Promise((resolve, reject) => {
        $.ajax({
            type: type,
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            url: url,
            success: function (response, status, xhr, $form) {
                if (response.type === "Success") {
                } else {
                    notify_toast(
                        "la la-warning",
                        "Error",
                        "warning",
                        "unknown error occurred. please try again later"
                    );
                }

                resolve(response);
            },
            error: function (response) {
                if (response.status == "401") {
                    notify_toast(
                        "la la-warning",
                        "Warning",
                        "warning-type",
                        "session expired. please login to continue"
                    );

                    setTimeout(() => {
                        location.reload();
                    }, 1000);
                } else {
                    notify_toast(
                        "la la-warning",
                        "Error",
                        "warning",
                        "unknown error occurred. please try again later"
                    );
                }

                reject(response);
            },
        });
    });
}

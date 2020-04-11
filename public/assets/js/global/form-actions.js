function submitFormNoImage(form, url, btn, type, loadUrl = null) {
    btn.addClass(
        "kt-spinner kt-spinner--right kt-spinner--sm kt-spinner--light"
    ).attr("disabled", true);

    form.ajaxSubmit({
        type: type,
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
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
                    dtTable.ajax.reload();
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

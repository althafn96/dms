$(".store-stock-btn").click(function () {
    var btn = $(this);
    var url = btn.data("url");
    var type = btn.data("type");

    if (type == "url") {
        type =
            "products" +
            "/" +
            $("#product_id").attr("data-id") +
            "/" +
            "stock-in-hand";
    }

    var data = {
        stock_qty: $("#stock_qty").val(),
        product_id: $("#product_id").attr("data-id"),
    };

    console.log(type);

    saveItemNoForm(data, url, btn, "POST", type)
        .then((data) => {
            if (data.type == "Success") {
                if (type == "none") {
                    dtTable.ajax.reload();
                    setTimeout(() => {
                        $("#add_stock_modal").modal("hide");
                    }, 1000);
                }
            }
        })
        .catch((error) => {});
});

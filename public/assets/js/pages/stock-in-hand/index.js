dtTable = $("#stock_table").DataTable({
    responsive: true,
    searchDelay: 500,
    processing: true,
    serverSide: true,
    ordering: false,
    ajax: window.location.href,
    columns: [
        { data: "added_on", name: "added_on" },
        { data: "added_by", name: "added_by" },
        { data: "stock_qty", name: "stock_qty" },
    ],
});

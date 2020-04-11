dtTable = $("#suppliers_table").DataTable({
    responsive: true,
    searchDelay: 500,
    processing: true,
    serverSide: true,
    ajax: "suppliers",
    columns: [
        { data: "fname", name: "fname" },
        { data: "email", name: "email" },
        { data: "address", name: "address" },
        { data: "mobile", name: "mobile" },
        { data: "status", name: "status" },
        { data: "actions", responsivePriority: -1 },
    ],
    columnDefs: [
        {
            targets: -1,
            width: "100px",
            title: "Actions",
            orderable: false,
            className: "text-center",
            render: function (data, type, full, meta) {
                return (
                    `
                        <div class="dropdown">								
                        <a href="javascript:;" class="btn btn-sm btn-clean btn-icon btn-icon-md" data-toggle="dropdown">									
                        <i class="flaticon-more-1"></i>								
                        </a>								
                        <div class="dropdown-menu dropdown-menu-right">									
                        <ul class="kt-nav">										
                        <li class="kt-nav__item">											
                        <a href="#" class="kt-nav__link">												
                        <i class="kt-nav__link-icon flaticon2-expand"></i>												
                        <span class="kt-nav__link-text">View</span>											
                        </a>										
                        </li>										
                        <li class="kt-nav__item">											
                        <a href="suppliers/` +
                    full.id +
                    `/edit" class="kt-nav__link" title="Edit Supplier">							
                                <i class="kt-nav__link-icon flaticon2-gear"></i>											
                                <span class="kt-nav__link-text">Edit</span>									
                        </a>										
                        </li>										
                        <li class="kt-nav__item">											
                        <a  onclick="removeDtItem('` +
                    full.id +
                    `','suppliers/` +
                    full.id +
                    `')" class="kt-nav__link" title="Remove Supplier">							
                            <i class="kt-nav__link-icon  flaticon2-rubbish-bin"></i>										
                            <span class="kt-nav__link-text">Remove</span>								
                        </a>										
                        </li>									
                        </ul>								
                        </div>							
                        </div>
                    `
                );
            },
        },
        {
            targets: -2,
            render: function (data, type, full, meta) {
                var status = {
                    0: {
                        title: "Disabled",
                        class: "kt-badge--danger",
                        action: "Enable",
                        change: "1",
                    },
                    1: {
                        title: "Enabled",
                        class: " kt-badge--success",
                        action: "Disable",
                        change: "0",
                    },
                };
                if (typeof status[data] === "undefined") {
                    return data;
                }
                return (
                    `
                            <div class="kt-badge ` +
                    status[data].class +
                    ` kt-badge--inline kt-badge--pill">
                                <a class="dropdown-toggle" style="color: white" data-toggle="dropdown" href="#">` +
                    status[data].title +
                    `</a>
                                <div class="dropdown-menu">
                                    <button class="dropdown-item" onclick="change_status('` +
                    status[data].change +
                    `', '` +
                    full.id +
                    `', 'users/change-user-status', '` +
                    meta.row +
                    `')">` +
                    status[data].action +
                    `</button>
                                </div>
                            </div>
                        `
                );
            },
        },
    ],
    order: [[0, "desc"]],
    stateSave: true,
});

@extends('layouts.app')

@section('page_styles')

<link href="{{ asset('assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css" />

@endsection


@section('content')
	<div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">

		<div class="kt-subheader  kt-grid__item" id="kt_subheader">
			<div class="kt-container  kt-container--fluid ">
				<div class="kt-subheader__main">
					<h3 class="kt-subheader__title">Drivers of {{ $courier_user->fname }}</h3>
                    <span class="kt-subheader__separator kt-subheader__separator--v"></span>
                    <span class="kt-subheader__desc">Add, Edit, Remove &amp; Manage Courier Drivers</span>
                </div>
                <div class="kt-subheader__toolbar">
                    <div class="kt-subheader__wrapper">
                        <a href="{{ route('couriers.index') }}" class="btn kt-subheader__btn-primary back-btn">
                            Back
    
                            <!--<i class="flaticon2-calendar-1"></i>-->
                        </a>
                    </div>
                </div>
			</div>
        </div>
        
		<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
			<div class="kt-portlet kt-portlet--mobile">
				<div class="kt-portlet__body">
                    <form id="add_driver_form">
                        <div class="form-group row">
                            <div class="col-md-6">
                                <div class="kt-form__group--inline">
                                    <div class="kt-form__label">
                                        <label>Name</label>
                                    </div>
                                    <div class="kt-form__control">
                                        <input id="driver_name" name="driver_name" type="text" class="form-control" placeholder="Enter full name">
                                        <input id="courier_id" value="{{ $courier_user->id }}" name="courier_id" type="hidden">
                                    </div>
                                </div>
                                <div class="d-md-none kt-margin-b-10"></div>
                            </div>
                            <div class="col-md-6">
                                <div class="kt-form__group--inline">
                                    <div class="kt-form__label">
                                        <label>Vehicle</label>
                                    </div>
                                    <div class="kt-form__control">
                                        <select id="vehicle" name="vehicle" class="form-control kt-selectpicker">
                                            <option value="Motor Bike" data-icon="fa fa-motorcycle"> Motor Bike</option>
                                            <option value="Tuk" data-icon="fa fa-caravan"> Tuk</option>
                                            <option value="Car" data-icon="fa fa-car-side"> Car</option>
                                            <option value="Van" data-icon="fa fa-shuttle-van"> Van</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="d-md-none kt-margin-b-10"></div>
                            </div>
                            <div class="col-md-6 mt-3">
                                <div class="kt-form__group--inline">
                                    <div class="kt-form__label">
                                        <label class="kt-label m-label--single">Vehicle Number</label>
                                    </div>
                                    <div class="kt-form__control">
                                        <input id="vehicle_num" name="vehicle_num" type="text" class="form-control" placeholder="Enter vehicle number">
                                    </div>
                                    <span class="form-text text-muted">username for driver login</span>
                                </div>
                                <div class="d-md-none kt-margin-b-10"></div>
                            </div>
                            <div class="col-md-6 mt-3">
                                <div class="kt-form__group--inline">
                                    <div class="kt-form__label">
                                        <label class="kt-label m-label--single">NIC</label>
                                    </div>
                                    <div class="kt-form__control">
                                        <input id="nic" name="nic" type="text" class="form-control" placeholder="Enter NIC">
                                    </div>
                                    <span class="form-text text-muted">password for driver login</span>
                                </div>
                                <div class="d-md-none kt-margin-b-10"></div>
                            </div>
                            <div class="col-lg-12">
                                <div class="col-lg-3 float-right mt-3 pr-0">
                                    <button data-url="{{ url('courier-drivers/add-courier-driver') }}" class="form-control btn btn-brand btn-md" type="submit" id="add_driver_to_courier">Add Driver</button>
                                </div>
                            </div>
                        </div>
                    </form>

					<!--begin: Datatable -->
					<table class="table table-striped- table-hover table-checkable" id="courier_drivers_table">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Vehicle</th>
                                <th>Vehicle No</th>
                                <th>NIC</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                    </table>

					<!--end: Datatable -->
				</div>
			</div>
		</div>

	</div>
    
    <div class="modal fade" id="courier_driver_edit" tabindex="-1" role="dialog" aria-labelledby="courier_driver_editLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="courier_driver_editLabel">Edit Driver</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <div class="modal-body">
                    <form id="update_driver_form">
                        <div class="form-group row">
                            <div class="col-md-6">
                                <div class="kt-form__group--inline">
                                    <div class="kt-form__label">
                                        <label>Name</label>
                                    </div>
                                    <div class="kt-form__control">
                                        <input id="edit_driver_name" name="driver_name" type="text" class="form-control" placeholder="Enter full name">
                                    </div>
                                </div>
                                <div class="d-md-none kt-margin-b-10"></div>
                            </div>
                            <div class="col-md-6">
                                <div class="kt-form__group--inline">
                                    <div class="kt-form__label">
                                        <label>Vehicle</label>
                                    </div>
                                    <div class="kt-form__control">
                                        <select id="edit_vehicle" name="vehicle" class="form-control kt-selectpicker">
                                            <option value="Motor Bike" data-icon="fa fa-motorcycle"> Motor Bike</option>
                                            <option value="Tuk" data-icon="fa fa-caravan"> Tuk</option>
                                            <option value="Car" data-icon="fa fa-car-side"> Car</option>
                                            <option value="Van" data-icon="fa fa-shuttle-van"> Van</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="d-md-none kt-margin-b-10"></div>
                            </div>
                            <div class="col-md-6 mt-3">
                                <div class="kt-form__group--inline">
                                    <div class="kt-form__label">
                                        <label class="kt-label m-label--single">Vehicle Number</label>
                                    </div>
                                    <div class="kt-form__control">
                                        <input id="edit_vehicle_num" name="vehicle_num" type="text" class="form-control" placeholder="Enter vehicle number">
                                    </div>
                                    <span class="form-text text-muted">username for driver login</span>
                                </div>
                                <div class="d-md-none kt-margin-b-10"></div>
                            </div>
                            <div class="col-md-6 mt-3">
                                <div class="kt-form__group--inline">
                                    <div class="kt-form__label">
                                        <label class="kt-label m-label--single">NIC</label>
                                    </div>
                                    <div class="kt-form__control">
                                        <input id="edit_nic" name="nic" type="text" class="form-control" placeholder="Enter NIC">
                                    </div>
                                    <span class="form-text text-muted">password for driver login</span>
                                </div>
                                <div class="d-md-none kt-margin-b-10"></div>
                            </div>
                            <div class="col-lg-12">
                                <div class="col-lg-3 float-right mt-3 pr-0">
                                    <button data-id='' data-url="{{ url('courier-drivers') }}/update-courier-driver" class="form-control btn btn-brand btn-md" type="submit" id="update_courier_driver">Update Driver</button>
                                </div>
                                <div class="col-lg-2 float-right mt-3 pr-0">
                                    <button type="button" class="btn btn-secondary float-right" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('page_scripts')

<script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js') }}" type="text/javascript"></script>
<script>
    dtTable = $("#courier_drivers_table").DataTable({
        responsive: true,
        searchDelay: 500,
        processing: true,
        serverSide: true,
        ajax: {
            url: "{{ $courier_user->id }}",
        },
        columns: [
            { data: "driver_name", driver: "driver_name" },
            { data: "vehicle", name: "vehicle" },
            { data: "vehicle_num", name: "vehicle_num" },
            { data: "nic", name: "nic" },
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
                            <a onclick="editDtItem('` +
                        full.id +
                        `','edit-courier-driver/` +
                        full.id +
                        `')" class="kt-nav__link" title="Edit Courier Driver">							
                                    <i class="kt-nav__link-icon flaticon2-gear"></i>											
                                    <span class="kt-nav__link-text">Edit</span>									
                            </a>										
                            </li>										
                            <li class="kt-nav__item">											
                            <a  onclick="removeDtItem('` +
                        full.id +
                        `','remove-courier-driver/` +
                        full.id +
                        `')" class="kt-nav__link" title="Remove Courier Driver">							
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
                        `', '../users/change-user-status', '` +
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

</script>
<script src="{{ asset('assets/js/global/form-actions.js')}}" type="text/javascript"></script>
<script src="{{ asset('assets/js/pages/couriers/drivers.js') }}" type="text/javascript"></script>

@endsection

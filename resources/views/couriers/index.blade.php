@extends('layouts.app')

@section('page_styles')

<link href="{{ asset('assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css" />

@endsection


@section('content')
	<div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">

		<div class="kt-subheader  kt-grid__item" id="kt_subheader">
			<div class="kt-container  kt-container--fluid ">
				<div class="kt-subheader__main">
					<h3 class="kt-subheader__title">Couriers</h3>
                    <span class="kt-subheader__separator kt-subheader__separator--v"></span>
                    <span class="kt-subheader__desc">Add, Edit, Remove &amp; Manage couriers</span>
                </div>
			</div>
        </div>
        
		<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
			<div class="kt-portlet kt-portlet--mobile">
				<div class="kt-portlet__head kt-portlet__head--lg">
					<div class="kt-portlet__head-label">
					</div>
					<div class="kt-portlet__head-toolbar">
						<div class="kt-portlet__head-wrapper">
							<div class="kt-portlet__head-actions">
								<a href="{{ route('couriers.create') }}" class="btn btn-brand btn-elevate btn-icon-sm create-btn">
									<i class="la la-plus"></i>
									New Courier
								</a>
							</div>
						</div>
					</div>
				</div>

				<div class="kt-portlet__body">
					

					<!--begin: Datatable -->
					<table class="table table-striped- table-hover table-checkable" id="couriers_table">
						<thead>
							<tr>
								<th>Name</th>
								<th>Email</th>
								<th>Address</th>
								<th>Mobile</th>
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

	<div class="modal fade" id="" tabindex="-1" role="dialog" aria-labelledby="courier_drivers_modalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="courier_drivers_modalLabel">Drivers</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <div class="modal-body">
					<div class="kt-portlet__body">

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
    </div>
@endsection

@section('page_scripts')

<script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/js/pages/couriers/index.js') }}" type="text/javascript"></script>

@endsection

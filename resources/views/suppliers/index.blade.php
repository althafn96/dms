@extends('layouts.app')

@section('page_styles')

<link href="{{ asset('assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css" />

@endsection


@section('content')
	<div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">

		<div class="kt-subheader  kt-grid__item" id="kt_subheader">
			<div class="kt-container  kt-container--fluid ">
				<div class="kt-subheader__main">
					<h3 class="kt-subheader__title">Suppliers</h3>
                    <span class="kt-subheader__separator kt-subheader__separator--v"></span>
                    <span class="kt-subheader__desc">Add, Edit, Remove &amp; Manage Suppliers</span>
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
								<a href="{{ route('suppliers.create') }}" class="btn btn-brand btn-elevate btn-icon-sm create-btn">
									<i class="la la-plus"></i>
									New Supplier
								</a>
							</div>
						</div>
					</div>
				</div>
				<div class="kt-portlet__body">

					<!--begin: Datatable -->
					<table class="table table-striped- table-hover table-checkable" id="suppliers_table">
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
@endsection

@section('page_scripts')

<script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/js/pages/suppliers/index.js') }}" type="text/javascript"></script>

@endsection

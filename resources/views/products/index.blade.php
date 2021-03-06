@extends('layouts.app')

@section('page_styles')

<link href="{{ asset('assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css" />

@endsection


@section('content')
	<div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">

		<div class="kt-subheader  kt-grid__item" id="kt_subheader">
			<div class="kt-container  kt-container--fluid ">
				<div class="kt-subheader__main">
					<h3 class="kt-subheader__title">Products</h3>
                    <span class="kt-subheader__separator kt-subheader__separator--v"></span>
                    <span class="kt-subheader__desc">Add, Edit, Remove &amp; Manage Products</span>
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
								<a href="{{ route('products.create') }}" class="btn btn-brand btn-elevate btn-icon-sm create-btn">
									<i class="la la-plus"></i>
									New Product
								</a>
							</div>
						</div>
					</div>
				</div>
				<div class="kt-portlet__body">

					<!--begin: Datatable -->
					<table class="table table-striped- table-hover table-checkable" id="products_table">
						<thead>
							<tr>
								<th>Product</th>
								<th>Category</th>
								<th>Supplier</th>
								<th>Price</th>
								<th>Availability</th>
								<th>Last Stock Update</th>
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
    

    <div class="modal fade" id="add_stock_modal" tabindex="-1" role="dialog" aria-labelledby="addStockLabel" aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title" id="addStockLabel">Add Product Category</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <div class="modal-body">
                    <form class="kt-form" id="kt_stock_add_form">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Stock Quantity *</label>
                                    <input type="number" class="form-control" name="stock_qty" id="stock_qty" placeholder="Enter Stock Quantity">
                                    <input data-id='' type="hidden" class="form-control" name="product_id" id="product_id" >
                                </div>
                            </div>
                            <div class="col-md-12">
                                <button type="button" data-type='url' class="btn btn-brand store-stock-btn float-right m-2" data-url="{{url('stock-in-hand')}}">
                                    Submit and Go to Stock
                                </button>
                                <button type="button" data-type='none' type='submit' class="btn btn-brand store-stock-btn float-right m-2" data-url="{{url('stock-in-hand')}}">
                                    Submit and Close
                                </button>
                                <button type="button" class="btn btn-secondary float-right m-2" data-dismiss="modal">
                                    Cancel 
                                </button>
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
<script src="{{ asset('assets/js/pages/products/index.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/js/pages/stock-in-hand/create-edit.js') }}" type="text/javascript"></script>

@endsection

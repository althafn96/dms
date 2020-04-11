@extends('layouts.app')

@section('page_styles')

<link href="{{asset('assets/css/pages/wizard/wizard-4.css')}}" rel="stylesheet" type="text/css" />

@endsection


@section('content')
	<div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">

		<div class="kt-subheader  kt-grid__item" id="kt_subheader">
			<div class="kt-container  kt-container--fluid ">
				<div class="kt-subheader__main">
					<h3 class="kt-subheader__title">Create Courier</h3>
					<span class="kt-subheader__separator kt-subheader__separator--v"></span>
					<span class="kt-subheader__desc">enter courier details and submit</span>
				</div>
                <div class="kt-subheader__toolbar">
                    <div class="kt-subheader__wrapper">
                        <a href="{{ route('couriers.index') }}" class="btn kt-subheader__btn-primary back-btn">
                            Back

                            <!--<i class="flaticon2-calendar-1"></i>-->
                        </a>
                        <div class="btn-group">
                            <button type="button" class="btn btn-brand btn-bold store-courier-btn" data-url="{{url('couriers')}}" id="store-courier-btn">
                                Submit 
                            </button>
                            <button type="button" class="btn btn-brand btn-bold dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            </button>
                            <div class="dropdown-menu dropdown-menu-right">
                                <ul class="kt-nav">
                                    <li class="kt-nav__item">
                                        <a href="#" class="kt-nav__link">
                                            <i class="kt-nav__link-icon flaticon2-writing"></i>
                                            <span class="kt-nav__link-text">Save &amp; create Survey</span>
                                        </a>
                                    </li>
                                    <li class="kt-nav__item">
                                        <a href="#" class="kt-nav__link">
                                            <i class="kt-nav__link-icon flaticon2-medical-records"></i>
                                            <span class="kt-nav__link-text">Save &amp; add new</span>
                                        </a>
                                    </li>
                                    <li class="kt-nav__item">
                                        <a href="#" class="kt-nav__link">
                                            <i class="kt-nav__link-icon flaticon2-copy"></i>
                                            <span class="kt-nav__link-text">Save &amp; duplicate</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
			</div>
        </div>
        <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
            <div class="kt-wizard-v4" id="add_courier_user_wizard" data-ktwizard-state="step-first">

                <!--begin: Form Wizard Nav -->
                <div class="kt-wizard-v4__nav">
                    <div class="kt-wizard-v4__nav-items nav">

                        <!--doc: Replace A tag with SPAN tag to disable the step link click -->
                        <div class="kt-wizard-v4__nav-item nav-item" data-ktwizard-type="step" data-ktwizard-state="current">
                            <div class="kt-wizard-v4__nav-body">
                                <div class="kt-wizard-v4__nav-number">
                                    1
                                </div>
                                <div class="kt-wizard-v4__nav-label">
                                    <div class="kt-wizard-v4__nav-label-title">
                                        Profile
                                    </div>
                                    <div class="kt-wizard-v4__nav-label-desc">
                                        Courier Details
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="kt-wizard-v4__nav-item nav-item" data-ktwizard-type="step">
                            <div class="kt-wizard-v4__nav-body">
                                <div class="kt-wizard-v4__nav-number">
                                    2
                                </div>
                                <div class="kt-wizard-v4__nav-label">
                                    <div class="kt-wizard-v4__nav-label-title">
                                        Credentials
                                    </div>
                                    <div class="kt-wizard-v4__nav-label-desc">
                                        Courier Credentials
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="kt-wizard-v4__nav-item nav-item" data-ktwizard-type="step">
                            <div class="kt-wizard-v4__nav-body">
                                <div class="kt-wizard-v4__nav-number">
                                    3
                                </div>
                                <div class="kt-wizard-v4__nav-label">
                                    <div class="kt-wizard-v4__nav-label-title">
                                        Drivers
                                    </div>
                                    <div class="kt-wizard-v4__nav-label-desc">
                                        Courier Drivers
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!--end: Form Wizard Nav -->
                <div class="kt-portlet">
                    <div class="kt-portlet__body kt-portlet__body--fit">
                        <div class="kt-grid">
                            <div class="kt-grid__item kt-grid__item--fluid kt-wizard-v4__wrapper">

                                <!--begin: Form Wizard Form-->
                                <form class="kt-form" id="kt_user_add_form">

                                    <div class="kt-wizard-v4__content" data-ktwizard-type="step-content" data-ktwizard-state="current">
                                        <div class="kt-heading kt-heading--md">Courier Details:</div>
                                        <div class="kt-section kt-section--first">
                                            <div class="kt-wizard-v4__form">
                                                <div class="row">
                                                    <div class="col-xl-12">
                                                        <div class="kt-section__body">
                                                            <div class="form-group">
                                                                <label>Name</label> *
                                                                <input type="text" class="form-control" name="name" placeholder="Name">
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label>Address 1</label>
                                                                        <input type="text" class="form-control" name="residency_no" placeholder="Apt/Flat No, Building Name">
                                                                        
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label>Address 2</label> 
                                                                        <input type="text" class="form-control" name="street_name" placeholder="Street Name">
                                                                        
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label>City</label> 
                                                                        <input type="text" class="form-control" name="city" placeholder="City">
                                                                        
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label>Province</label> 
                                                                        <input type="text" class="form-control" name="province" placeholder="Province">
                                                                        
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label>Contact Mobile 1</label> *
                                                                        <input type="text" class="form-control" name="mobile_1" placeholder="Contact Mobile 1">
                                                                        
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label>Contact Mobile 2</label>
                                                                        <input type="text" class="form-control" name="mobile_2" placeholder="Contact Mobile 2">
                                                                        
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="kt-wizard-v4__content" data-ktwizard-type="step-content">
                                        <div class="kt-heading kt-heading--md">Setup Courier Login</div>
                                        <div class="kt-form__section kt-form__section--first">
                                            <div class="kt-wizard-v4__form">
                                                <div class="form-group">
                                                    <label>Email Address</label> *
                                                    <div class="input-group">
                                                        <div class="input-group-prepend"><span class="input-group-text"><i class="la la-at"></i></span></div>
                                                        <input name="email" type="text" class="form-control" placeholder="Email" aria-describedby="basic-addon1">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label>Password</label> *
                                                    <div class="input-group">
                                                        <div class="input-group-prepend"><span class="input-group-text"><i class="la la-lock"></i></span></div>
                                                        <input name="password" type="password" class="form-control" placeholder="Password" aria-describedby="basic-addon1">
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="kt-wizard-v4__content" data-ktwizard-type="step-content">
                                        <div class="kt-heading kt-heading--md">Courier Drivers Details and Login</div>

                                        
                                        <div class="form-group row">
                                            <div class="col-md-6">
                                                <div class="kt-form__group--inline">
                                                    <div class="kt-form__label">
                                                        <label>Name</label>
                                                    </div>
                                                    <div class="kt-form__control">
                                                        <input id="driver_name" name="driver_name" type="text" class="form-control" placeholder="Enter full name">
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
                                                    <button data-remove="{{ url('courier-drivers/remove-courier-driver-temp') }}" data-edit="{{ url('courier-drivers/edit-courier-driver-temp') }}" data-url="{{ url('courier-drivers/add-courier-driver-temp') }}" class="form-control btn btn-brand btn-md" type="button" id="add_driver_to_courier">Add Driver</button>
                                                </div>
                                            </div>
                                        </div>
                                        <div id="drivers_section" style="display: none" class="kt-portlet kt-portlet--tabs kt-portlet--height-fluid">
                                            <div style="padding-bottom: 0 !important" class="kt-portlet__body">
                                                <div id="drivers_list" class="kt-widget2">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--begin: Form Actions -->
                                    <div class="kt-form__actions">
                                        <div class="btn btn-secondary btn-md btn-tall btn-wide kt-font-bold kt-font-transform-u" data-ktwizard-type="action-prev">
                                            Previous
                                        </div>
                                        <div class="btn btn-brand btn-md btn-tall btn-wide kt-font-bold kt-font-transform-u" data-ktwizard-type="action-next">
                                            Next Step
                                        </div>
                                    </div>

                                    <!--end: Form Actions -->
                                </form>

                                <!--end: Form Wizard Form-->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
    
    <div class="modal fade" id="temp_courier_driver_edit" tabindex="-1" role="dialog" aria-labelledby="temp_courier_driver_editLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="temp_courier_driver_editLabel">Edit Driver</h5>
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
                                    <button data-remove="{{ url('courier-drivers/remove-courier-driver-temp') }}" data-edit="{{ url('courier-drivers/edit-courier-driver-temp') }}" data-id='' data-url="{{ url('courier-drivers') }}/update-courier-driver-temp" class="form-control btn btn-brand btn-md" type="button" id="update_courier_temp_driver">Update Driver</button>
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

<script src="{{ asset('assets/js/global/general-scripts.js')}}" type="text/javascript"></script>
<script src="{{ asset('assets/js/global/form-actions.js')}}" type="text/javascript"></script>
<script src="{{ asset('assets/js/pages/couriers/create-edit.js') }}" type="text/javascript"></script>
<script>
    jQuery(document).ready(function () {
        KTUserAdd.init();
        KTFormRepeater.init();
        KTBootstrapSelect.init();
    });
</script>

@endsection

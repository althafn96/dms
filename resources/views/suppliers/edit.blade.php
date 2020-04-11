@extends('layouts.app')

@section('page_styles')

<link href="{{asset('assets/css/pages/wizard/wizard-4.css')}}" rel="stylesheet" type="text/css" />

@endsection


@section('content')
	<div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">

		<div class="kt-subheader  kt-grid__item" id="kt_subheader">
			<div class="kt-container  kt-container--fluid ">
				<div class="kt-subheader__main">
					<h3 class="kt-subheader__title">Edit {{ $supplier_user->fname }}</h3>
					<span class="kt-subheader__separator kt-subheader__separator--v"></span>
					<span class="kt-subheader__desc">update supplier details</span>
				</div>
                <div class="kt-subheader__toolbar">
                    <div class="kt-subheader__wrapper">
                        <a href="{{ route('suppliers.index') }}" class="btn kt-subheader__btn-primary back-btn">
                            Back

                            <!--<i class="flaticon2-calendar-1"></i>-->
                        </a>
                        <div class="btn-group">
                            <button type="button" class="btn btn-brand btn-bold update-supplier-btn" data-url="{{url('suppliers')}}/{{ $supplier_user->id }}" id="update-supplier-btn">
                                Update 
                            </button>
                        </div>
                    </div>
                </div>
			</div>
        </div>
        <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
            <div class="kt-wizard-v4" id="update_supplier_user_wizard" data-ktwizard-state="step-first">

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
                                        Supplier Details
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
                                        Supplier Credentials
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
                                <form class="kt-form" id="kt_user_update_form">

                                    <div class="kt-wizard-v4__content" data-ktwizard-type="step-content" data-ktwizard-state="current">
                                        <div class="kt-heading kt-heading--md">Supplier Details:</div>
                                        <div class="kt-section kt-section--first">
                                            <div class="kt-wizard-v4__form">
                                                <div class="row">
                                                    <div class="col-xl-12">
                                                        <div class="kt-section__body">
                                                            <div class="form-group">
                                                                <label>Name</label> *
                                                                <input value="{{ $supplier_user->fname }}" type="text" class="form-control" name="name" placeholder="Name">
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label>Address 1</label>
                                                                        <input value="{{ $supplier_user->residency_no }}" type="text" class="form-control" name="residency_no" placeholder="Apt/Flat No, Building Name">
                                                                        
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label>Address 2</label> *
                                                                        <input value="{{ $supplier_user->street }}" type="text" class="form-control" name="street_name" placeholder="Street Name">
                                                                        
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label>City</label> *
                                                                        <input value="{{ $supplier_user->city }}" type="text" class="form-control" name="city" placeholder="City">
                                                                        
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label>Province</label> *
                                                                        <input value="{{ $supplier_user->province }}" type="text" class="form-control" name="province" placeholder="Province">
                                                                        
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label>Contact Mobile 1</label> *
                                                                        <input value="{{ $supplier_user->mobile }}" type="text" class="form-control" name="mobile_1" placeholder="Contact Mobile 1">
                                                                        
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label>Contact Mobile 2</label>
                                                                        <input value="{{ $supplier_user->mobile_2 }}" type="text" class="form-control" name="mobile_2" placeholder="Contact Mobile 2">
                                                                        
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
                                        <div class="kt-heading kt-heading--md">Supplier Login</div>
                                        <div class="kt-form__section kt-form__section--first">
                                            <div class="kt-wizard-v4__form">
                                                <div class="form-group">
                                                    <label>Email Address</label> *
                                                    <div class="input-group">
                                                        <div class="input-group-prepend"><span class="input-group-text"><i class="la la-at"></i></span></div>
                                                        <input value="{{ $supplier_user->loginCredentials->email }}" name="email" type="text" class="form-control" placeholder="johndoe@gmail.com" placeholder="Email" aria-describedby="basic-addon1">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label>Change Password</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend"><span class="input-group-text"><i class="la la-lock"></i></span></div>
                                                        <input name="password" type="password" class="form-control" placeholder="Password" aria-describedby="basic-addon1">
                                                        
                                                    </div>
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
@endsection

@section('page_scripts')

<script src="{{ asset('assets/js/global/general-scripts.js')}}" type="text/javascript"></script>
<script src="{{ asset('assets/js/global/form-actions.js')}}" type="text/javascript"></script>
<script src="{{ asset('assets/js/pages/suppliers/create-edit.js') }}" type="text/javascript"></script>

<script>
    jQuery(document).ready(function () {
        KTUserUpdate.init();
    });
</script>
@endsection

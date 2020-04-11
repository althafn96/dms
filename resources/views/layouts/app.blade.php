<!DOCTYPE html>
<html lang="en">

	<head>
		<base href="">
		<meta name="csrf-token" content="{{ csrf_token() }}">
		<meta charset="utf-8" />
		<title>{{ $title['page'] }} | {{ config('app.name') }}</title>

		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700|Roboto:300,400,500,600,700">		

		@include('includes.header_styles')

        @yield('page_styles')
		<link rel="shortcut icon" href="{{ asset('assets/media/logos/pulse-icon.png') }}" />
    </head>
    
	<body class="kt-quick-panel--right kt-demo-panel--right kt-offcanvas-panel--right kt-header--fixed kt-header-mobile--fixed kt-subheader--enabled kt-subheader--fixed kt-subheader--solid kt-aside--enabled kt-aside--fixed kt-page--loading">
	@include('layouts.mobile_header')

	<div class="kt-grid kt-grid--hor kt-grid--root">
		<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--ver kt-page">

			@include('layouts.sidebar')

			@include('layouts.header')

				@yield('content')
				
			@include('layouts.footer')

		</div>
	</div>

	@include('layouts.quickpanel')

	<div id="kt_scrolltop" class="kt-scrolltop">
		<i class="fa fa-arrow-up"></i>
	</div>

	@include('layouts.toolbar')

    @include('includes.footer_scripts')

	@yield('page_scripts')
	</body>

</html>
    
    
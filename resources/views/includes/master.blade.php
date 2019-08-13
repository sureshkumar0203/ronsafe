<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>@yield('title')</title>
<meta name="keywords" content="@yield('keywords')">
<meta name="description" content="@yield('description')">
<link rel="shortcut icon" type="image/x-icon" href="imafes/favicon.ico">
<link rel="stylesheet" href="{{ asset('public/css/style.css') }}">
<link rel="stylesheet" href="{{ asset('public/css/responsive.css') }}"> 
<link rel="stylesheet" href="{{ asset('public/css/theme.css') }}"> 

<script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
<script src="{{ asset('public/js/jquery.scrollwith.js') }}"></script>
@yield('page-script')
</head>
<body>
@include('includes.header')
	@yield('content')
@include('includes.footer')
<div class="scroll-to-top scroll-to-target" data-target="html">
	<span class="fa fa-angle-double-up"></span>
</div>
<script src="{{ asset('public/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('public/js/owl.carousel.min.js') }}"></script>
<script src="{{ asset('public/js/custom.js') }}"></script>
<script src="{{ asset('public/js/ronsafe-validation.js') }}"></script>
@stack('script')
<script>
$.ajaxSetup({
	headers: {
		'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	}
});
</script>
</body>
</html>
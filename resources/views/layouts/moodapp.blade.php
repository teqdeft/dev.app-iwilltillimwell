<!DOCTYPE html>
<html lang="en">
<head>
	@include('includes.dashboard.head')
	<script type="text/javascript">
		const SITE_URL = "{{URL::to('/')}}";
		const STRIPE_KEY = "{{ ENV('STRIPE_KEY') }}";
		const USER_PAYMENT_STATUS = "{{ Auth::user()->payment_status }}";
	</script>
	<link rel="stylesheet" href="{{ asset('emoji-css') }}/emojione-sprite-{{ config('emojione.spriteSize') }}.min.css"/>
</head>
<body>
	<header>
		@include('includes.dashboard.header')
    </header>
	<div class="container-fluid page-body-wrapper">
		@yield('content')
		
	
		
		@include('includes.dashboard.scripts')
	</body>
	</html>
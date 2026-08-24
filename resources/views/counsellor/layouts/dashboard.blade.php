<!DOCTYPE html>
<html lang="en">
<head>
	@include('includes.dashboard.head')
	<script type="text/javascript">
		const SITE_URL = "{{URL::to('/')}}";
		const STRIPE_KEY = "{{ ENV('STRIPE_KEY') }}";
		const USER_PAYMENT_STATUS = "{{ Auth::user()->payment_status }}";
	</script>
</head>
<body>
	<header>
		@include('includes.dashboard.header')
	</header>
	<div class="container-fluid page-body-wrapper">
		@include('includes.dashboard.counsellor.sidebar')
		@yield('content')
		
		@include('includes.dashboard.footer')
		
		@include('includes.dashboard.scripts')
	</body>
	</html>
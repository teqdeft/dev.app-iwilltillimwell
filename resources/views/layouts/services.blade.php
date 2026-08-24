<!DOCTYPE html>
<html lang="en">
<head>
	@include('includes.services.head')
	<script type="text/javascript">
		const SITE_URL = "{{URL::to('/')}}";
		const STRIPE_KEY = "{{ ENV('STRIPE_KEY') }}";
		const USER_PAYMENT_STATUS = "";
	</script>
</head>

<body>
@yield('content')
@include('includes.services.footer')

@include('includes.scripts')

</body>

</html>

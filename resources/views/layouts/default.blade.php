<!DOCTYPE html>
<html lang="en">

<head>
	@include('includes.head')
	<script type="text/javascript">
		const SITE_URL = "{{URL::to('/')}}";
		const STRIPE_KEY = "{{ ENV('STRIPE_KEY') }}";
		const USER_PAYMENT_STATUS = "";
	</script>
	
	<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
            new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
            j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
            'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
            })(window,document,'script','dataLayer','GTM-5KWPMSFC');</script>
</head>

<body>
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-5KWPMSFC"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
	<?php
	$intakeClass = "";
	$getSegment = Request::segment(1);
	$checkUrls = ['medical-care-consent', 'counseling-consent'];
	if (in_array($getSegment, $checkUrls)) {
		$intakeClass = "intakepage-footer";
	}
	?>
	@if(!isset($noHeader))
	<header>
		@include('includes.header')
	</header>
	@endif
	@yield('content')

	@if(!isset($noFooter))
	<footer class="<?= $intakeClass ?>">
		@include('includes.footer')
	</footer>
	@endif


	@include('includes.scripts')
	<script>
		$(document).ready(function(){
			$.ajax({
				url:`{{ url('setTimeZone') }}`,
				method:'POST',
				data:{"_token":"{{ csrf_token() }}","DefineUserTimeZone":Intl.DateTimeFormat().resolvedOptions().timeZone},
				error:(error) => console.log( error )
        	});
		})

	</script>

    @if ( finalStepComplete() && checkAppComplete() )
    <x-congratulation-popup />
        <script>
            $('#congratulation-popup').modal('show')
        </script>
    @endif

    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>

<script>
$(window).on('resize', function() {
	function isMobile() {
        return ($(window).width() <= 768 || /iPhone|iPad|iPod|Android|BlackBerry|Windows Phone|Opera Mini|IEMobile/i.test(navigator.userAgent));
    }
	if (isMobile()) {
		location.reload();
	}
});
</script>
</body>

</html>

<!DOCTYPE html>
<html lang="en">
<head>
<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-NGFWMV3B');</script>
<!-- End Google Tag Manager -->
	@include('includes.dashboard.head')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    @yield('moduleStyle')
<link rel="preconnect" href="https://fonts.googleapis.com" rel="preload">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin rel="preload">
<link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap" rel="stylesheet" rel="preload">
		
	
<link rel="stylesheet" href="{{ asset('assets/dashboard/htmlv/assets/css/owl.carousel.min.css') }}" />
<link rel="stylesheet" href="{{ asset('assets/dashboard/htmlv/assets/css/owl.theme.default.min.css') }}" />
<link rel="stylesheet" href="{{ asset('assets/dashboard/htmlv/assets/css/fonts.css') }}"  rel="preload">

<link rel="stylesheet" href="{{ asset('assets/assets/css/admin-style.css') }}">	
<link rel="stylesheet" href="{{ asset('assets/dashboard/htmlv/assets/css/style.css') }}">
<link rel="stylesheet" href="{{ asset('assets/assets/css/responsive.css') }}">


<script type="text/javascript">
		const SITE_URL = "{{URL::to('/')}}";
		const STRIPE_KEY = "{{ ENV('STRIPE_KEY') }}";
		const USER_PAYMENT_STATUS = "{{ Auth::user()->payment_status }}";
	</script>
</head>
</head>

<body>
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-NGFWMV3B"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->

 
	<div class="container-fluid page-body-wrapper med-con-v1 vj-sharing-v5">
		<div class="main-panel main-panel-for-modal-page as">
		<header class="share-header">
			<div class="container-fluid">
				
				<div class="share-row">
					<div class="logo">
						<a href="{{url('/')}}">
							<img 
								src="{{ url('/assets/assets/images/sg-iwilltilimwell-h-headerbar-logomark.png')}}"
								alt="logo" 
							/>
						</a>	
					</div>
					<div class="share-right">
						<div class="logo24">
							<img src="{{ url('/assets/services/images/support-line-img.png') }}" alt="logo" />
						</div>
						<div class="email">
							<a href="mailto:support@iwilltilimwell.com" class="btn btn-primary">support@iwilltilimwell.com</a>
						</div>
					</div>
					
					
						<ul class="dropdown-v1">
						  <li data-lang="en"></li>
						  <li data-lang="es"></li>
						</ul>
					  
					
				</div>
				
				
			</div>
		</header>
		
		
		@yield('content')
		
		<footer class="share-footer">
			<div class="container-fluid">
				<div class="footer-email">
					<a href="mailto:support@iwilltilimwell.com">support@iwilltilimwell.com</a>
				</div>
				<div class="bottom-footer">
					<p>Copyright © 2025. All rights reserved.</p>
				</div>
			</div>
		</footer>
		@include('includes.dashboard.scripts')
		
		@yield('moduleScript')
		@stack('scripts')
		
		
</body>
</html>


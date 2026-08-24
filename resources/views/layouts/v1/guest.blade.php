<!DOCTYPE html>
<html lang="en">
<head>
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


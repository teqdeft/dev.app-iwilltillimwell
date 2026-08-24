<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="csrf-token" id="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('Dashboard')</title>
    
	<link rel="preconnect" href="https://fonts.googleapis.com" rel="preload">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin rel="preload">
	<link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap" rel="stylesheet" rel="preload">

	<link rel="stylesheet" href="{{ asset('assets/assets/css/vertical-layout-light/style.css') }}">
	<link rel="stylesheet" href="{{ asset('assets/assets/vendors/ti-icons/css/themify-icons.css') }}">
	<link rel="stylesheet" href="{{ asset('assets/assets/vendors/css/vendor.bundle.base.css') }}">
	
	<link rel="stylesheet" href="{{ asset('assets/assets/css/admin-style.css') }}">	
	<link rel="stylesheet" href="{{ asset('assets/dashboard/htmlv/assets/css/style.css') }}">
	<link rel="stylesheet" href="{{ asset('assets/assets/css/responsive.css') }}">
	<link rel="stylesheet" href="{{ asset('assets/assets/fontawesome/css/all.min.css') }}">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
	

	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
	
    @stack('styles')
	
	<style>
	.required-ico{color:red}#loader-wrapper{position:fixed;top:0;left:0;width:100%;height:100%;background:#00000080;display:flex;justify-content:center;align-items:center;z-index:9999}.loader{border:6px solid #f3f3f3;border-top:6px solid #604377;border-radius:50%;width:50px;height:50px;animation:spin 1s linear infinite}@keyframes spin{0%{transform:rotate(0deg)}100%{transform:rotate(360deg)}}#content{display:none1}
	
	</style>
	<script type="text/javascript">
		const SITE_URL = "{{URL::to('/')}}";
		const STRIPE_KEY = "{{ ENV('STRIPE_KEY') }}";
		const USER_PAYMENT_STATUS = "{{ Auth::user()->payment_status }}";
	</script>

<!-- Hotjar Tracking Code for https://join.iwilltilimwell.com -->
<script>
    (function(h,o,t,j,a,r){
        h.hj=h.hj||function(){(h.hj.q=h.hj.q||[]).push(arguments)};
        h._hjSettings={hjid:3908104,hjsv:6};
        a=o.getElementsByTagName('head')[0];
        r=o.createElement('script');r.async=1;
        r.src=t+h._hjSettings.hjid+j+h._hjSettings.hjsv;
        a.appendChild(r);
    })(window,document,'https://static.hotjar.com/c/hotjar-','.js?sv=');
</script>

</head>
<body>
	<div id="loader-wrapper"><div class="loader"></div></div>
	<header>
		@include('includes.dashboard.header')
	</header>
	<div class="container-fluid page-body-wrapper med-con-v1">
		@include('includes.dashboard.sidebar')
			<div class="main-panel main-panel-for-modal-page as">
				@yield('content')
				
				
				
    
	
<script>
window.addEventListener("load", function () {
	  hideLoader();
});

function hideLoader() {
    var loader = document.getElementById("loader-wrapper");
    loader.style.transition = "opacity 0.5s ease";
    loader.style.opacity = 0;
    setTimeout(function () {
      loader.style.display = "none";
    }, 500);
}
function showLoaderPageLoad(action) {
	if(action=="show") {
		$("#loader-wrapper").css({"opacity": "1","display": "flex"});
	} else {
		$("#loader-wrapper").css({"opacity": "0","display": "none"});
	}
	
}
function LengthValidation(input,max_number) {
    let value = input.value.replace(/\D/g, '');
    if (value.length > max_number) {
        value = value.substring(0, max_number); 
    }
    input.value = value; 
}
</script>
@stack('scripts')
<script src="{{ asset('assets/assets/vendors/js/vendor.bundle.base.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/jquery.validate.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/additional-methods.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/validation-2.js') }}"></script>
<script>
@if(Session::has('success'))
    toastr.success("{{ session('success') }}")
@php Session::forget('success') @endphp
@elseif(Session::has('error'))
    toastr.error("{{ session('error') }}")
    @php Session::forget('error') @endphp
@elseif(Session::has('warning'))
    toastr.warning("{{ session('warning') }}")
    @php Session::forget('warning') @endphp
@elseif(Session::has('info'))
    toastr.info("{{ session('info') }}")
    @php Session::forget('info') @endphp
@endif
</script>
</body>
</html>
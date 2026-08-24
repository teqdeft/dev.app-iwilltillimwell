<!DOCTYPE html>
<html lang="en">
<head>

	@include('includes.dashboard.head')

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    @yield('moduleStyle')

	<script type="text/javascript">

		const SITE_URL = "{{URL::to('/')}}";

		const STRIPE_KEY = "{{ ENV('STRIPE_KEY') }}";

		const USER_PAYMENT_STATUS = "{{ Auth::user()->payment_status }}";

	</script>

	

	<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':

new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],

j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=

'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);

})(window,document,'script','dataLayer','GTM-5KWPMSFC');</script>



<link rel="preconnect" href="https://fonts.googleapis.com" rel="preload">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin rel="preload">
<link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap" rel="stylesheet" rel="preload">
		
	
<link rel="stylesheet" href="{{ asset('assets/dashboard/htmlv/assets/css/owl.carousel.min.css') }}" />
<link rel="stylesheet" href="{{ asset('assets/dashboard/htmlv/assets/css/owl.theme.default.min.css') }}" />
<link rel="stylesheet" href="{{ asset('assets/dashboard/htmlv/assets/css/fonts.css') }}"  rel="preload">

<link rel="stylesheet" href="{{ asset('assets/assets/css/admin-style.css') }}">	
<link rel="stylesheet" href="{{ asset('assets/dashboard/htmlv/assets/css/style.css') }}">
<link rel="stylesheet" href="{{ asset('assets/assets/css/responsive.css') }}">


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

<iframe id="myIframe" allow="microphone" src="https://sdk.exei.ai/sdk/689c53c8c3b6d733bae9d3cb?mic=true&channelType=WEBSITE&API_KEY=0505d61bb1a441f884510105bf30401d" style="position: fixed; bottom: 85px; right: 20px; width: 400px; height: 70%; border: none; z-index: 9999;" title="Exei SDK">
    <p>Your browser does not support iframes.</p>
</iframe>
<script src="https://iframe-cdn.exei.ai/script-prod-minified.js"></script>
  
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-5KWPMSFC"

height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>

	<header>

		@include('includes.group-organizations.header')

	</header>

	<div class="container-fluid page-body-wrapper med-con-v1">

		@include('includes.group-organizations.sidebar')
		
		<div class="main-panel main-panel-for-modal-page as">
		@yield('content')



		@include('includes.dashboard.footer')



		@include('includes.dashboard.scripts')



       
@yield('moduleScript')
@stack('scripts')


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


function prescriptionsearchmodal() {
	$(".medication_detail_table").hide();
	$('#medicationTableBody').html("");
	$('#searchMedication').val("");
}
</script>

</body>
</html>


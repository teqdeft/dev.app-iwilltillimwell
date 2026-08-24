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
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap"
        rel="stylesheet" rel="preload">
		
	
<link rel="stylesheet" href="{{ asset('assets/dashboard/htmlv/assets/css/owl.carousel.min.css') }}" />
<link rel="stylesheet" href="{{ asset('assets/dashboard/htmlv/assets/css/owl.theme.default.min.css') }}" />
<link rel="stylesheet" href="{{ asset('assets/dashboard/htmlv/assets/css/fonts.css') }}"  rel="preload">

<link rel="stylesheet" href="{{ asset('assets/assets/css/admin-style.css') }}">	
<link rel="stylesheet" href="{{ asset('assets/dashboard/htmlv/assets/css/style.css') }}">
<link rel="stylesheet" href="{{ asset('assets/assets/css/responsive.css') }}">

</head>

<body>

	<div id="loader-wrapper"><div class="loader"></div></div>
  
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-5KWPMSFC"

height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>

	<header>

		@include('includes.dashboard.header')

	</header>

	<div class="container-fluid page-body-wrapper med-con-v1">

		@include('includes.dashboard.sidebar')
		
		<div class="main-panel main-panel-for-modal-page as">
		@yield('content')



		@include('includes.dashboard.footer')



		@include('includes.dashboard.scripts')



         @switch(Auth::user()->doctor_step)

                @case(0)

                    @if( getSegment(1) == 'personal-record' )

                    <x-interval-complete-health-step />

                    @endif

                    @break

                @case(1)

                    @if( getSegment(1) == 'medications' )

                        <x-interval-complete-health-step />

                    @endif

                    @break

                @case(2)

                    @if( getSegment(1) == 'medication-allergies' )

                        <x-interval-complete-health-step />

                    @endif

                    @break

                @case(3)

                    @if( getSegment(1) == 'medical-history' )

                        <x-interval-complete-health-step />

                    @endif

                    @break

                @case(4)

                    @if( getSegment(1) == 'document-manager' )

                        <x-interval-complete-health-step />

                    @endif

                    @break

                @default



            @endswitch

            <script>

                $(document).ready(function() {

                    $("#intervalCompleteHealthStep").modal('show');

                });

            </script>





  <script>

  $( function() {

    

  } );







    if (USER_PAYMENT_STATUS && USER_PAYMENT_STATUS != 1) {

        $("#dashboard-popup").modal({ backdrop: "static", keyboard: true });

    }





  </script>

   @yield('moduleScript')

   <script>

    $(window).on('resize', function() {

        function isMobile() {

            return (

                $(window).width() <= 768 || 

                /iPhone|iPad|iPod|Android|BlackBerry|Windows Phone|Opera Mini|IEMobile/i.test(navigator.userAgent)

            );

        }

        if (isMobile()) {

            location.reload();

        }

    });

    

    </script>



@if(Request::is('dashboard') && auth()->check() && auth()->user()->payment_status == "0")

    <script>

        setTimeout(function(){ 

            tab_section(1);

        }, 1000);

        function tab_section(id) {

            $(".plan-info-"+id).trigger("click");

        }

    </script>

@endif

@if(empty(Session::get('member_auth')) && auth()->user()->payment_status == "1")

   <script>

      function CallAjaxToken(){

         $.post("{{ url('member-update-token-number') }}", {action: 'token-update', _token: "{{ csrf_token() }}"}, function(response) {

         });

   }

    setTimeout(function(){ CallAjaxToken(); },500);

   </script>

   @endif
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
</script>

	</body>

	</html>


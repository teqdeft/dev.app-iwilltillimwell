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





<link rel="stylesheet" href="{{ asset('assets/assets/css/admin-style.css') }}">

<link rel="stylesheet" href="{{ asset('assets/assets/css/responsive.css') }}">

<style>

    /* Loader Wrapper */

    #loader-wrapper {

      position: fixed;

      top: 0;

      left: 0;

      width: 100%;

      height: 100%;

      background: #00000080;

      display: flex;

      justify-content: center;

      align-items: center;

      z-index: 9999999999999;

    }



    /* Loader Spinner */

    .loader {

      border: 6px solid #f3f3f3;

      border-top: 6px solid #604377;

      border-radius: 50%;

      width: 50px;

      height: 50px;

      animation: spin 1s linear infinite;

    }



    /* Spin Animation */

    @keyframes spin {

      0% { transform: rotate(0deg); }

      100% { transform: rotate(360deg); }

    }



    /* Hide content initially */

    #content {

      display: none;

    }

  </style>

<script>

function nameValidationTextOnly(input) {

    input.value = input.value.replace(/[^a-zA-Z\s]/g, '');

}

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

<link rel="stylesheet" href="{{ asset('assets/dashboard/htmlv/assets/css/style.css') }}">
<link rel="stylesheet" href="{{ asset('assets/dashboard/htmlv/assets/css/menu.css') }}"> 

</head>

<body>

	<div id="loader-wrapper">

    <div class="loader"></div>

  </div>

  

  <iframe id="myIframe" allow="microphone" src="https://sdk.exei.ai/sdk/689c53c8c3b6d733bae9d3cb?mic=true&channelType=WEBSITE&API_KEY=0505d61bb1a441f884510105bf30401d" style="position: fixed; bottom: 85px; right: 20px; width: 400px; height: 70%; border: none; z-index: 9999;" title="Exei SDK">

    <p>Your browser does not support iframes.</p>

</iframe>

<script src="https://iframe-cdn.exei.ai/script-prod-minified.js"></script>





    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-5KWPMSFC"

height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>

	<header>

		@include('includes.dashboard.header')

	</header>

	<div class="container-fluid page-body-wrapper med-con-v1">

		@include('includes.dashboard.sidebar')

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

                    @if( getSegment(1) == 'surgical-conditions' )

                        <x-interval-complete-health-step />

                    @endif

                    @break

                @case(5) 
                
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

    $.post("/general-information/lyric-create-token-number", {action: 'token-update', _token: "{{ csrf_token() }}"}, function(response) {});

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

$(document).on("click", ".showLoaderPageLoad", function () {

    showLoaderPageLoad('show');

});

function LengthValidation(input,max_number) {

    let value = input.value.replace(/\D/g, ''); // Remove any non-digit characters

    if (value.length > max_number) {

        value = value.substring(0, max_number); // Ensure the length doesn't exceed 10 digits

    }

    input.value = value; // Set the value back to the input

}

</script>  

<script>

const slider = document.querySelector('.drag-scroll');

if(slider) {

	  let isDown = false;

	  let startX;

	  let scrollLeft;

	  slider.addEventListener('mousedown', (e) => {

		isDown = true;

		slider.classList.add('active');

		startX = e.pageX - slider.offsetLeft;

		scrollLeft = slider.scrollLeft;

	  });

	  slider.addEventListener('mouseleave', () => {

		isDown = false;

		slider.classList.remove('active');

	  });

	  slider.addEventListener('mouseup', () => {

		isDown = false;

		slider.classList.remove('active');

	  });

	  slider.addEventListener('mousemove', (e) => {

		if(!isDown) return;

		e.preventDefault();

		const x = e.pageX - slider.offsetLeft;

		const walk = (x - startX) * 2; // scroll speed

		slider.scrollLeft = scrollLeft - walk;

	  });

}



function prescriptionsearchmodal() {

	$(".medication_detail_table").hide();

	$('#medicationTableBody').html("");

	$('#searchMedication').val("");

} 

$(document).ready(function() {

		$('.menu-toggle').on('click', function () {

			$('.submenu').not($(this).next()).collapse('hide');

		});

});

</script> 

@include('layouts.v1.pre-search-dash-model')

</body>

</html>


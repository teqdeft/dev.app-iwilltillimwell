<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">

    <title>{{config('app.name')}}</title>

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- fonts -->

    <link rel="preconnect" href="https://fonts.googleapis.com"  rel="preload">

    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin  rel="preload">

    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap" rel="stylesheet" rel="preload">

    <!-- stylesheet -->

    <link rel="shortcut icon" href="{{ asset(env('APP_FAV_ICO')) }}" />

    <link rel="stylesheet" href="{{ asset('assets/dashboard/assets/css/fonts.css')}}" type="text/css" />

    <link rel="stylesheet" href="{{ asset('assets/dashboard/assets/css/owl.carousel.min.css')}}" />

    <link rel="stylesheet" href="{{ asset('assets/dashboard/assets/css/owl.theme.default.min.css')}}" />

      
    <link rel="stylesheet" href="{{ asset('assets/dashboard/assets/css/style.css')}}" />

    

    <link rel="stylesheet" href="{{ asset('assets/css/mobile/toastr.min.css')}}" />

    <script type="text/javascript"  src="{{ asset('assets/dashboard/assets/js/jquery-3.7.1.js')}}"></script>

<style>

.error , .error-title {color:red !important;}

.required-ico { color:red; }

.alert-danger {color: #ff0000;background-color: rgba(255, 71, 71, 0.2);border-color: #eb4141;margin: 0 auto;}

.alert {

    font-size: 0.875rem;

    position: relative;

    padding: 0.75rem 1.25rem;

    margin-bottom: 1rem;

    border: 1px solid transparent;

    border-radius: 0.25rem;

}

</style>

<script type="text/javascript">

const SITE_URL = "{{URL::to('/')}}";

function close_consemt_popup(id) {

        $("#"+id).removeClass("show");

}

function close_popup(id) {

        $("#"+id).removeClass("show");

}

function show_popup(id) {

        $("#"+id).removeAttr("style");

        $("#"+id).addClass("show");

}

function lengthValidation(input,max_number) {

    let value = input.value.replace(/\D/g, ''); 

    if (value.length > max_number) {

        value = value.substring(0, max_number);

    }

    input.value = value;

} 

function logoutAccount(){

    localStorage.clear(); 

    window.location.href="{{route('logout')}}";

}

function showLoaderPageLoad(action) {

	if(action=="show") {

		$("#loader-wrapper").css({"opacity": "1","display": "flex"});

	} else {

		$("#loader-wrapper").css({"opacity": "0","display": "none"});

	}

}



</script>

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

	

.custom-select {

  padding: 8px 12px;

  border-radius: 8px;

  border: 1px solid #ccc;

  background: #fff;

  font-size: 14px;

  cursor: pointer;

}

.custom-select option {

  padding: 6px;

}

  </style>

  

<script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>

<script type="text/javascript">

  function googleTranslateElementInit() {

    new google.translate.TranslateElement({

      pageLanguage: 'en',

      includedLanguages: 'en,es',

      autoDisplay: false

    }, 'google_translate_element');

  }



  document.addEventListener("DOMContentLoaded", function () {

    const langItems = document.querySelectorAll(".custom-lang li");



    langItems.forEach(item => {

      item.addEventListener("click", function () {

        const lang = this.getAttribute("data-lang");

        const googleSelect = document.querySelector("select.goog-te-combo");

        if (googleSelect) {

          googleSelect.value = lang;

          googleSelect.dispatchEvent(new Event("change"));

        }

      });

    });

  });

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



  <div id="loader-wrapper">

    <div class="loader"></div>

  </div>

  

   <iframe id="myIframe" allow="microphone" src="https://sdk.exei.ai/sdk/689c53c8c3b6d733bae9d3cb?mic=true&channelType=WEBSITE&API_KEY=0505d61bb1a441f884510105bf30401d" style="position: fixed; bottom: 185px; right: 20px; width: 400px; height: 70%; border: none; z-index: 9999;" title="Exei SDK">

    <p>Your browser does not support iframes.</p>

</iframe>

<script src="https://iframe-cdn.exei.ai/script-prod-minified.js"></script>

    

<section class="home-screen dashboard-top-section">

        <div class="cust-container-md">

            <div class="profile">

                

                <div class="app-logo">

                    <a href="{{ url('mobile-dashboard')}}">

                        <img class="logo"  src="{{ asset(env('MOBILE_DASHBOARD_LOGO')) }}" alt="web logo">

                    </a>

                </div>

				 

				

					<div class="google-translate">

					  <div id="google_translate_element" style="display:none;"></div>

					  <div class="custom-lang" id="langDropdown">

						<div id="selectedLang" data-lang="en" class="selected">

						  <span class="flag-ico en"></span> English

						</div>

						<ul class="dropdown-v1">

						  <li data-lang="en"><span class="flag-ico en"></span> English</li>

						  <li data-lang="es"><span class="flag-ico spn"></span> Spanish</li>

						</ul>

					  </div>

					</div>



				

				

                <div class="notification">

					<?php /*

                    <div class="not">

                         <img src="{{ asset('assets/dashboard/assets/images/notification-icon.png')}}" alt="image">

                    </div>

                    <div class="npt-number">

                        <p>0</p>

                    </div>

					*/ ?>

                </div>

            </div>

        </div>

    </section>

    

    @yield('content')

  

  

  <script type="text/javascript"  src="{{ asset('assets/js/mobile/toastr.min.js') }}"></script>

  <?php /*

  <script type="text/javascript"  src="{{ asset('assets/dashboard/assets/js/owl.carousel.min.js')}}"></script>

  */ ?>

  <script src="https://cdn.jsdelivr.net/npm/owl.carousel@2.3.4/dist/owl.carousel.min.js"></script>

  <script type="text/javascript"  src="{{ asset('assets/js/jquery.validate.min.js') }}"></script>

  <script type="text/javascript"  src="{{ asset('assets/js/mobile/validation-2.js') }}"></script>

  <script type="text/javascript"  src="{{ asset('assets/dashboard/assets/js/custome.js')}}"></script>

  <script type="text/javascript">

      @if(Session::has('success'))

        toastr.success("{{ session('success') }}")

        {{ Session::forget('success') }}

      @elseif(Session::has('error'))

        toastr.error("{{ session('error') }}")

        {{ Session::forget('error') }}

      @elseif(Session::has('warning'))

        toastr.warning("{{ session('warning') }}")

        {{ Session::forget('warning') }}

      @elseif(Session::has('info'))

        toastr.info("{{ session('info') }}")

        {{ Session::forget('info') }}

      @endif

    </script>



@if(empty(Session::get('member_auth')) && auth()->user()->payment_status == "1")

   <script>

      function CallAjaxToken(){

         $.post("{{ url('member-update-token-number') }}", {action: 'token-update', _token: "{{ csrf_token() }}"}, function(response) {

         });

   }

    setTimeout(function(){ CallAjaxToken(); },500);

   </script>

   @endif



<div class="popup" id="logout-popup-confirmation">

    <div class="popup-content">

      <span class="popup-close-icon" onclick="close_consemt_popup('logout-popup-confirmation')">&times;</span>

  

      <div class="popu-content delete-pup">

          <div class="delete-alert" >

              <img src="{{ asset('assets/dashboard/assets/images/alert-icon.png') }}" />

          </div>

          <div class="complete-form">

             <h2 class="text-center">Are you sure ? </h2>

             <p class="text-center" style="padding: 10px 0 0 0;">You really want to log out?</p>

          </div>

          <div class="popup-cta">

              <a class="primary-button confirm_btn" onclick="logoutAccount()" href="javascript:void(0)">Yes</a>

              <a class="outline-button" href="javascript:void(0)" onclick="close_consemt_popup('logout-popup-confirmation')">No</a>

          </div>

      </div>

    </div>

</div>  

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

$(document).on('click', '.app-logo', function() {

    showLoaderPageLoad('show');

})

$(document).on("click", ".showLoaderPageLoad", function () {

    showLoaderPageLoad('show');

});

window.addEventListener("load", function () {

      var loader = document.getElementById("loader-wrapper");

      loader.style.transition = "opacity 0.5s ease";

      loader.style.opacity = 0;

      setTimeout(function () {

        loader.style.display = "none";

      }, 500);

});

</script>



<script>

const dropdownItems = langDropdown.querySelectorAll(".dropdown-v1 li");

document.addEventListener("DOMContentLoaded", function () {

  const langDropdown = document.getElementById("langDropdown");

  const selectedLang = document.getElementById("selectedLang");

 



  // Load saved language from localStorage

  const savedLang = localStorage.getItem("selectedLang");

  if (savedLang) {

    const savedItem = [...dropdownItems].find(li => li.getAttribute("data-lang") === savedLang);

    if (savedItem) {

      selectedLang.innerHTML = savedItem.innerHTML;

      selectedLang.setAttribute("data-lang", savedLang);



      // Apply Google Translate on load

      const select = document.querySelector(".goog-te-combo");

      if (select) {

        select.value = savedLang;

        select.dispatchEvent(new Event("change"));

      }

    }

  }



  // Toggle dropdown

  selectedLang.addEventListener("click", () => {

    langDropdown.classList.toggle("open");

  });



  // Select language

  dropdownItems.forEach(item => {

    item.addEventListener("click", () => {

      const lang = item.getAttribute("data-lang");



      selectedLang.innerHTML = item.innerHTML;

      selectedLang.setAttribute("data-lang", lang);

      langDropdown.classList.remove("open");



      // Save language to localStorage

      localStorage.setItem("selectedLang", lang);



      // Trigger Google Translate

      const select = document.querySelector(".goog-te-combo");

      if (select) {

        select.value = lang;

        select.dispatchEvent(new Event("change"));

      }

    });

  });



  // Close dropdown if clicked outside

  document.addEventListener("click", (e) => {

    if (!langDropdown.contains(e.target)) {

      langDropdown.classList.remove("open");

    }

  });

});

const savedLang = localStorage.getItem("selectedLang");

if (savedLang) {

  const savedItem = [...dropdownItems].find(li => li.getAttribute("data-lang") === savedLang);

  if (savedItem) {

    selectedLang.innerHTML = savedItem.innerHTML;

    selectedLang.setAttribute("data-lang", savedLang);



    // Wait until Google Translate select is ready

    const interval = setInterval(() => {

      const select = document.querySelector(".goog-te-combo");

      if (select) {

        select.value = savedLang;

        select.dispatchEvent(new Event("change"));

        clearInterval(interval);

      }

    }, 500);

  }

}

</script>

</body>

</html>
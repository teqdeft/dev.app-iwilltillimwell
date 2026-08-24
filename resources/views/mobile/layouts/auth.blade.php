<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <title>{{config('app.name')}}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('assets/css/mobile/style.css')}}">
	<link rel="stylesheet" href="{{ asset('assets/css/mobile/toastr.min.css') }}">
	<script type="text/javascript"  src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    @stack('styles')
	<script type="text/javascript">
	  const SITE_URL = "{{URL::to('/')}}";
	  const STRIPE_KEY = "{{ ENV('STRIPE_KEY') }}";
	  const USER_PAYMENT_STATUS = "";
	</script>
	<style>
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
      z-index: 9999;
    }

 
    .loader {
      border: 6px solid #f3f3f3;
      border-top: 6px solid #604377;
      border-radius: 50%;
      width: 50px;
      height: 50px;
      animation: spin 1s linear infinite;
    }

    @keyframes spin {
      0% { transform: rotate(0deg); }
      100% { transform: rotate(360deg); }
    }

    #content {
      display: none;
    }
	.error {color:red;}
  </style>
</head>
<body>
	<div id="loader-wrapper"><div class="loader"></div></div>
    @yield('content')
	
	<script type="text/javascript"  src="{{ asset('assets/js/jquery.validate.min.js') }}"></script>
	<script type="text/javascript"  src="{{ asset('assets/js/mobile/validation-2.js') }}"></script>	
	<script type="text/javascript"  src="{{ asset('assets/js/mobile/toastr.min.js') }}"></script>
    @stack('scripts')

<script>
window.addEventListener("load", function () {
      var loader = document.getElementById("loader-wrapper");
      loader.style.transition = "opacity 0.5s ease";
      loader.style.opacity = 0;
      setTimeout(function () {
        loader.style.display = "none";
      }, 500);
});
function showLoaderPageLoad(action) {
	if(action=="show") {
		$("#loader-wrapper").css({"opacity": "1","display": "flex"});
	} else {
		$("#loader-wrapper").css({"opacity": "0","display": "none"});
	}
}
function lengthValidation(input,max_number) {
    let value = input.value.replace(/\D/g, ''); 
    if (value.length > max_number) {
        value = value.substring(0, max_number);
    }
    input.value = value;
} 
</script>


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
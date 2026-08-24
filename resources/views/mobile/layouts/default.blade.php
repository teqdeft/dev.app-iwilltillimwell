<!DOCTYPE html>
<html lang="en">
<head>
	@include('mobile.includes.head')
	
<style>
 .error { color: red !important;  }
</style>
<script>
function lengthValidation(input,max_number) {
    let value = input.value.replace(/\D/g, ''); // Remove any non-digit characters
    if (value.length > max_number) {
        value = value.substring(0, max_number); // Ensure the length doesn't exceed 10 digits
    }
    input.value = value; // Set the value back to the input
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
      z-index: 9999;
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
  
</head>
<body class="">
	<div id="loader-wrapper"><div class="loader"></div></div>
	<?php /*
	<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-5KWPMSFC"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
	*/ ?>
	
	@yield('content')

	@include('mobile.includes.footer')
	@include('mobile.includes.scripts')
	
	<script>
		$(window).on('resize', function() {
			if ($(window).width() >= 768) {
				location.reload();
			}
		});
	</script>


@stack('scripts')
<script>
    window.addEventListener("load", function () {
      var loader = document.getElementById("loader-wrapper");
      loader.style.transition = "opacity 0.5s ease";
      loader.style.opacity = 0;
      setTimeout(function () {
        loader.style.display = "none";
        //document.getElementById("content").style.display = "block";
      }, 500);
    });
	
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
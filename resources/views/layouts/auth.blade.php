<!DOCTYPE html>
<html lang="en">
<head>
	<title>{{config('app.name')}}</title>
    <meta charset="UTF-8">
	<link rel="shortcut icon" href="{{ asset(env('APP_FAV_ICO')) }}" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="google-site-verification" content="dKpkh3uetv3mXFGnJ0Z8d2zrTyq8dJFW4UQJHglFDF4" />
	<meta name='robots' content='noindex, nofollow' />
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

<link rel="stylesheet" href="{{asset('assets/frontend/assets/css/new-login-style.css')}}"  />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript" src="{{ asset('assets/js/jquery.validate.min.js') }} "></script>
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.13.1/additional-methods.js"></script>
<script type="text/javascript" src="{{ asset('assets/js/validation-2.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

<style>
.error { color:red;}
span.invalid-feedback {color: red;}
.alert {
    position: relative;
    margin-bottom: 1rem;
    padding: 0.75rem 1.25rem;
    border-width: 1px;
    border-style: solid;
    border-color: transparent;
    border-image: initial;
    border-radius: 0.25rem;
}
.alert-success {
    color: #155724;
    background-color: #d4edda;
    border-color: #c3e6cb;
}
</style>
<script>
function TogglePassword(inputId,buttonId){

    var input = $("#" + inputId);
    var type = input.attr("type") === "password" ? "text" : "password";
    input.attr("type", type);

    var imgSrc = type === "password" 
                    ? '{{ asset("assets/frontend/assets/images/eye-open.svg") }}' 
                    : '{{ asset("assets/frontend/assets/images/eye-close.svg") }}';
                $("#"+buttonId+" img").attr("src", imgSrc);
}
function lengthValidation(input,max_number) {
    let value = input.value.replace(/\D/g, ''); // Remove any non-digit characters
    if (value.length > max_number) {
        value = value.substring(0, max_number); // Ensure the length doesn't exceed 10 digits
    }
    input.value = value; // Set the value back to the input
} 
</script>
</head>
<body>
@yield('content')


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
</body>
</html>

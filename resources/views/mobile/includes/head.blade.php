<!-- Dynamic Meta Tags -->
@include('includes.metaTags')
<!-- End of Dynamic Meta Tags -->
<link rel="icon" href="{{ asset('assets/images/imwell-favi.png') }}" type="image/x-icon">



<!-- from head.blade.php file -->
<script src="https://js.braintreegateway.com/web/dropin/1.32.0/js/dropin.min.js"></script>
<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-0LGB6Y5WKS"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());
  gtag('config', 'G-0LGB6Y5WKS');
</script>
<!-- End of from head.blade.php file -->

<link rel="stylesheet" href="{{ asset('assets/css/mobile/style.css')}}">

<!-- get from default.blade.php layout -->
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
<!-- end get from default.blade.php layout -->

<script type="text/javascript" src="{{ asset('assets/js/mobile/jquery-3.7.1.js') }}"></script>
<link rel="stylesheet" href="{{ asset('assets/css/mobile/toastr.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/mobile/bootstrap-datepicker.min.css')}}">
<link rel="stylesheet" href="{{ asset('assets/assets/fontawesome/css/all.min.css')}}">
<style>
.dropdown-menu {position: absolute;top: 100%;left: 0;z-index: 1000;display: none;float: left;min-width: 10rem;padding: 0.5rem 0;margin: 0.125rem 0 0;font-size: 1rem;color: #212529;text-align: left;list-style: none;background-color: #fff;background-clip: padding-box;border: 1px solid #CED4DA;border-radius: 0.25rem;}
tbody, td, tfoot, th, thead, tr {border-color: inherit;border-style: solid;border-width: 0;}
.datepicker table tr td.new, .datepicker table tr td.old {color: #999;}
.datepicker td, .datepicker th {text-align: center;width: 20px;height: 20px;-webkit-border-radius: 4px;-moz-border-radius: 4px;border-radius: 4px;border: none;}
.datepicker td, .datepicker th {padding: 5px 10px !important;}
</style>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="csrf-token" id="csrf-token" content="{{ csrf_token() }}">
<meta name="google-site-verification" content="dKpkh3uetv3mXFGnJ0Z8d2zrTyq8dJFW4UQJHglFDF4" />
<meta name='robots' content='noindex, nofollow' />
<title>{{config('app.name')}}</title>
<link rel="stylesheet" href="{{ asset('assets/assets/vendors/feather/feather.css') }}">
<link rel="stylesheet" href="{{ asset('assets/assets/vendors/ti-icons/css/themify-icons.css') }}">
<link rel="stylesheet" href="{{ asset('assets/assets/vendors/css/vendor.bundle.base.css') }}">
<link rel="stylesheet" href="{{ asset('assets/assets/vendors/datatables.net-bs4/dataTables.bootstrap4.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<link rel="stylesheet" href="{{ asset('assets/assets/vendors/ti-icons/css/themify-icons.css') }}">
<!-- <link rel="stylesheet" type="assets/text/css" href="js/select.dataTables.min.css') }}"> -->
<link rel="stylesheet" href="{{ asset('assets/assets/css/vertical-layout-light/style.css') }}">

<?php /*
<link rel="stylesheet" href="{{ asset('assets/assets/css/admin-style.css') }}">
<link rel="stylesheet" href="{{ asset('assets/assets/css/responsive.css') }}">
*/ ?>
<link rel="stylesheet" href="{{ asset('assets/assets/fontawesome/css/all.min.css') }}">
<link rel="shortcut icon" href="{{ asset(env('APP_FAV_ICO')) }}" />


<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/css/bootstrap-datepicker.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css" integrity="sha512-aEe/ZxePawj0+G2R+AaIxgrQuKT68I28qh+wgLrcAJOz3rxCP+TwrK5SPN+E5I+1IQjNtcfvb96HDagwrKRdBw==" crossorigin="anonymous" />
<!-- <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap-glyphicons.css"> -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
<link rel="stylesheet" href="//cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
<script src="https://js.braintreegateway.com/web/dropin/1.32.0/js/dropin.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<link rel="stylesheet" href="{{ asset('timepicker/mdtimepicker.css') }}">
<link rel="stylesheet" href="{{ asset('css/nestable.css') }}">

<link href="https://unpkg.com/dropzone@6.0.0-beta.1/dist/dropzone.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="{{ asset('emoji-css') }}/emojione-sprite-{{ config('emojione.spriteSize') }}.min.css"/>
<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-0LGB6Y5WKS"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());
  gtag('config', 'G-0LGB6Y5WKS');
</script>
<style>
.required-ico { color:red; }
    
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
      display: none1;
    }
  </style>
  
  
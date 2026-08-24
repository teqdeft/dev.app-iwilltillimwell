@if(Route::has('MobileUserPlans'))
<?php /*
<script type="text/javascript"  src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
*/ ?>
@endif
<script type="text/javascript"  src="{{ asset('assets/js/mobile/popper.min.js') }}"></script>
<script type="text/javascript"  src="{{ asset('assets/js/mobile/bootstrap.min.js') }}"></script>
<script type="text/javascript"  src="{{ asset('assets/js/jquery.validate.min.js') }}"></script>
<script type="text/javascript"  src="{{ asset('assets/js/mobile/additional-methods.js') }}"></script>
<script type="text/javascript"  src="{{ asset('assets/js/mobile/validation-2.js') }}"></script>
<script type="text/javascript"  src="{{ asset('assets/js/mobile/additional-methods.min.js') }}"></script>
<script type="text/javascript"  src="{{ asset('assets/js/mobile/toastr.min.js') }}"></script>
<script type="text/javascript"  src="{{ asset('assets/js/mobile/moment.min.js') }}"></script>

<?php /*
@if(Route::has('MobileUserPlans'))
<script type="text/javascript"  src="{{ asset('assets/js/mobile/bootstrap-datepicker.min.js') }}"></script>
@endif
*/ ?>
<script type="text/javascript"  src="{{ asset('assets/js/mobile/wow.js') }}"></script>
<script type="text/javascript"  src="{{ asset('assets/js/mobile/slick.js') }}"></script>
<script type="text/javascript"  src="{{ asset('assets/js/mobile/select2.min.js') }}"></script>
<script type="text/javascript"  src="{{ asset('assets/js/daypilot/daypilot-all.min.js') }}"></script>

<?php /*
@if(Route::has('MobileUserPlans'))
<script type="text/javascript"  src="{{ asset('assets/js/mobile/bootstrap-datetimepicker.min.js') }}"></script>
@endif

@if(Route::has('MobileUserPlans'))
  <script type="text/javascript"  src="{{ asset('assets/js/mobile/datepickers.js') }}"></script>
@endif
*/ ?>



<script type="text/javascript"  src="{{ asset('assets/js/mobile/script.js') }}"></script>
@if (!empty(Session::all()))
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
  @endif

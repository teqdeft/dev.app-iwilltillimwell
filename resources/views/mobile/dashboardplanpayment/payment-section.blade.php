@if(request()->get('paymentmethodselection') == 'true')

   
   @if(request()->get('paymode') === 'paypal')

        @include('mobile.dashboardplanpayment.payment-method.paypal')

    @elseif(request()->get('paymode') === 'authorize')

       @include('mobile.dashboardplanpayment.payment-method.authorize')

    @endif


@endif


<script src="https://www.google.com/recaptcha/api.js" async defer></script>


    


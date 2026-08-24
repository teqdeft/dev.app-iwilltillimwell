<div class="tabs choose-plan">
        <div class="choose-plan-nav mt-0 mb-0">
            <div class="plan-nav-text">
			<button type="button" class="primary-button" onclick="backToScreenPackage('payment')"><i class="fa fa-chevron-left fa-arrow-icon fa-arrow-icon-back"></i> Back</button>
                <div class="title">
                    <h2>Checkout</h2>
                </div>
                <div class="text">
                    <p>Personalized health plans for every step of your journey.</p>
					
                </div>
            </div>
        </div>
    </div>


<script src="https://www.google.com/recaptcha/api.js?onload=initCaptcha&render=explicit" async defer></script>
<script>
let captchaWidgetId;
function initCaptcha() {
    captchaWidgetId = grecaptcha.render('global-recaptcha', {
        sitekey: "{{ env('RECAPTCHA_SITE_KEY') }}"
    });
}

function getCaptchaToken() {
    let token = grecaptcha.getResponse(captchaWidgetId);

    if (!token) {
        document.getElementById('captcha-error').innerText = "⚠️ Please verify reCAPTCHA";
        return null;
    }

    document.getElementById('captcha-error').innerText = "";
    return token;
}


function continuePaymentSelected() {

    let selectedMethod = $("input[name='payment_method']:checked").val();
    let errorDiv = document.getElementById('payment-error');
    if (!selectedMethod) {

        errorDiv.style.display = 'block';
        return false;
        
    } else  {
        
        errorDiv.style.display = 'none';
        if(selectedMethod=="paypal") {
            //$(".g-recaptcha-display").append($(".google-captch"));
        } else {
            //$(".g-recaptcha-adisplay").append($(".google-captch"));
        }
        $("#asking-payment-method").modal("hide");

    }
}
function backToScreenPackage() {
     window.location.href = "{{ url('dashboard') }}?action=change-plan";
}
</script>





@if(request()->get('paymentmethodselection') == 'true')

   
   @if(request()->get('paymode') === 'paypal')

        @include('user.package.payment-method.paypal')

    @elseif(request()->get('paymode') === 'authorize')

        @include('user.package.payment-method.authorize')

    @endif


@endif

	





	

<?php /*

<button type="button" 
        class="btn btn-primary"
        data-bs-toggle="modal" 
        data-bs-target="#asking-payment-method">
    Payment Method Confirmation
</button>	



<button type="button" 
        class="btn btn-primary"
        data-bs-toggle="modal" 
        data-bs-target="#asking-google-captch">
    Google Captch
</button>	

*/ ?>

@push('scripts')
@if(config('constants.trial_days') > 0)
	@include('user.package.free-trial-modal-payment')
@endif
@include('user.package.payment-mode-confirm-popup')
@endpush
	
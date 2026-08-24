@php
    // Map of plan_id => amount, for the JS to pick the right total to display.
    $__paypalPlanAmountMap = \App\Models\Plan::select('id','amount')
        ->get()
        ->mapWithKeys(fn($p) => [(int) $p->id => (float) $p->amount]);
@endphp

<form method="POST" action="{{ route('paypal.payment') }}" class="invoice-card-main paypal-credit-payment">
    @csrf
    <input type="hidden" name="g-recaptcha-response" id="paypal-recaptcha-input" value="">
    <input type="hidden" name="plan_id" id="paypal-plan-id" value="{{ Auth::user()->plan ?? '' }}">

    <div class="invoice-pay-with">
        <div class="right" style="width:100%;">
            <div class="total-paying">

             

                <div class="paypal-redirect-note text-center mt-3 mb-3">
                  
                    <p class="text-muted small mt-2">
                        You will be securely redirected to <strong>PayPal</strong> to complete your payment.
                    </p>
                </div>

                <div class="not-roobt mt-4 mb-4 text-center">
                    <div class="google-captch">
                        <div id="global-recaptcha"></div>
                        <div id="captcha-error" class="text-danger"></div>
                    </div>
                </div>

                <div class="pay-securely">
                    <p>
                        <span class="icon"><img src="{{ asset('assets/dashboard/htmlv/assets/images/pay-securely.svg') }}" alt="icon"></span>
                        <span class="secur">Pay Securely</span>
                    </p>
                </div>

                <div class="cta">
                    <button type="submit" id="pay-btn" class="btn btn-primary btn-pay primary-button">
                        <span id="btn-text">Continue to PayPal</span>
                        <span id="btn-loader" class="spinner-border spinner-border-sm d-none"></span>
                    </button>
                </div>

                @if($errors->any())
                    <div class="alert alert-danger mt-3">
                        @foreach($errors->all() as $error)
                            <div>{{ $error }}</div>
                        @endforeach
                    </div>
                @endif

                <div class="paying-bottom-icon">
                    <img src="{{ asset('assets/dashboard/htmlv/assets/images/PCI.png') }}" alt="icon">
                    <img src="{{ asset('assets/dashboard/htmlv/assets/images/Norton.png') }}" alt="icon">
                </div>
            </div>
        </div>
    </div>
</form>

@push('scripts')
<script>
(function () {
    var planAmountMap = @json($__paypalPlanAmountMap);

    document.addEventListener('DOMContentLoaded', function () {
       
        //    and use it for both the display and the form submission.
        var pkgInfo = {};
        try { pkgInfo = JSON.parse(localStorage.getItem("package_payment_info") || "{}"); } catch (e) {}

        var chosenPlanId = (pkgInfo && pkgInfo.package_id) ? String(pkgInfo.package_id) : null;

        if (chosenPlanId) {
            // Set the form's plan_id so the server creates the order for the right plan.
            var planInput = document.getElementById('paypal-plan-id');
            if (planInput) planInput.value = chosenPlanId;

            // Update the displayed total to match.
            var amt = planAmountMap[chosenPlanId];
            if (amt != null) {
                var $el = document.querySelector('.paypal-credit-payment .total-paying-amount');
                if ($el) $el.textContent = '$' + parseFloat(amt).toFixed(2);
            }
        }

     
        var form = document.querySelector('.paypal-credit-payment');
        if (!form) return;

        form.addEventListener('submit', function (e) {
            var token = (typeof grecaptcha !== 'undefined') ? grecaptcha.getResponse() : '';
            if (!token) {
                e.preventDefault();
                var err = document.getElementById('captcha-error');
                if (err) err.innerText = '⚠️ Please verify reCAPTCHA';
                return false;
            }
            document.getElementById('paypal-recaptcha-input').value = token;

            var btn    = document.getElementById('pay-btn');
            var btnTxt = document.getElementById('btn-text');
            var btnLdr = document.getElementById('btn-loader');
            if (btn)    btn.disabled = true;
            if (btnTxt) btnTxt.innerText = 'Redirecting to PayPal...';
            if (btnLdr) btnLdr.classList.remove('d-none');
        });
    });
})();
</script>
@endpush
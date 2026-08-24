<div id="pharmacy-tab" class="tab-content payment-confirm-consultation"> 
	<div class="patient-tab-content pharmacy-detail">



<style>
.braintree-field {
    border: 1px solid #ccc;
    padding: 10px;
    margin-bottom: 12px;
    height: 40px;
}
</style>
@php
	$pay_amount = '10';
@endphp
<script src="https://js.braintreegateway.com/web/3.96.0/js/client.min.js"></script>
<script src="https://js.braintreegateway.com/web/3.96.0/js/hosted-fields.min.js"></script>

<script>
braintree.client.create({
    authorization: "{{ $clientToken }}"
}, function (clientErr, clientInstance) {
    if (clientErr) {
        console.error(clientErr);
        toastr.error('Braintree client init failed.');
        return;
    }

    braintree.hostedFields.create({
        client: clientInstance,
        styles: {
            'input': { 'font-size': '16px', 'color': '#333' },
            ':focus': { 'color': '#000' },
            '.invalid': { 'color': 'red' },
            '.valid': { 'color': 'green' }
        },
        fields: {
            number: { selector: '#card-number', placeholder: '4111 1111 1111 1111' },
            cvv: { selector: '#cvv', placeholder: '123' },
            expirationDate: { selector: '#expiration-date', placeholder: 'MM/YY' }
        }
    }, function (hostedFieldsErr, hostedFieldsInstance) {
        if (hostedFieldsErr) {
            console.error(hostedFieldsErr);
            toastr.error('Payment field init failed.');
            return;
        }

        document.getElementById('payment-form').addEventListener('submit', function (event) {
            event.preventDefault();

            hostedFieldsInstance.tokenize(function (tokenizeErr, payload) {
                if (tokenizeErr) {
                    console.error(tokenizeErr);
                    toastr.error('Invalid payment info.');
                    return;
                }

                // Show loader
                showLoaderPageLoad('show');

                // Send AJAX request to Laravel
                fetch("/braintree/pay", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": document.querySelector('input[name="_token"]').value
                    },
                    body: JSON.stringify({
                        payment_method_nonce: payload.nonce,
                        amount: "{{ $pay_amount }}"
                    })
                })
                .then(response => response.json())
                .then(data => {
                    showLoaderPageLoad('hide');
                    if (data.success) {
						
                        toastr.success('Payment successful!');
						CallAjaxNow('');
						
                        // Optional: Redirect to success page
                        //window.location.href = data.redirect_url ?? "/";
                    } else {
                        toastr.error(data.message || 'Payment failed.');
                    }
                })
                .catch(error => {
                    showLoaderPageLoad('hide');
                    console.error(error);
                    toastr.error('Something went wrong. Please try again.');
                });
            });
        });
    });
});
</script>



		<div class="pat-title">
            <p>Confirm and Pay</p>
            <small>ENTER PAYMENT INFORMATION</small>
        </div>
		
			<form id="payment-form" method="POST" action="prescriptions-payment">
					@csrf
				<div class="mb-3">
					<label>Card Number<span class="required-ico">*</span></label>
					<div id="card-number" class="braintree-field"></div>
				</div>
					<label>Expiration Date<span class="required-ico">*</span></label>
					<div id="expiration-date" class="braintree-field"></div>

					<label>CVV<span class="required-ico">*</span></label>
					<div id="cvv" class="braintree-field"></div>

					<input type="hidden" name="payment_method_nonce" id="nonce">
					<button type="submit" class="btn primary-button consultancy-fees-btn">Loading...</button>
			</form>
			

<script>
$(function(){
	scheduleConsultation_data = JSON.parse(localStorage.getItem("scheduleConsultation"));
	if(scheduleConsultation_data.price) {
		$(".consultancy-fees").val(scheduleConsultation_data.price);
		$(".consultancy-fees-btn").html("Secure Pay $"+scheduleConsultation_data.price);
	} else {
		//window.location.href="{{ route('mobile-dashboard')}}";
	}
})
</script>

	</div>
</div>
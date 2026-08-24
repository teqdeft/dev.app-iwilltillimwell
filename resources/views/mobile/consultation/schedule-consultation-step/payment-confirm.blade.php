<div id="pharmacy-tab" class="tab-content"> 
	<div class="patient-tab-content pharmacy-detail">
		<div class="pat-title"><p>Confirm and Pay</p><small>ENTER PAYMENT INFORMATION</small></div>
			
			<div class="cust-form total-pay">
                <label class="pay">Consult Fee:</label>
                <div class="input-group ">
                    <input class="form-control type" placeholder="$" disabled>
                    <input class="form-control consultancy-fees" type="text" name="phone" id="" value="0" disabled>
                </div>
            </div>
							
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
	
		<?php /*
		

                            
                            
                            <div class="payment-section">
                                <div class="payment-box">
                                    <h3>Enter Card Details</h3>
                                    
                            <form id="payment-form">
												<div class="mb-3">
													<div id="card-number"></div>
												</div>
												<div class="mb-3">
													<div id="expiration-date"></div>
												</div>
												<div class="mb-3">
													<div id="cvv"></div>
												</div>
												<button type="submit" class="btn btn-primary w-100 consultancy-fees-btn">Secure Pay $10.00</button>
						</form>
						<div id="result" class="mt-3 text-center fw-bold"></div>
							
				</div>
			</div>
    <style>
        #card-number, #expiration-date, #cvv {
            border: 1px solid #ced4da;
			background-color: #fff;
			height: 38px;
			border-radius:5px;
			padding:10px;
			margin-bottom:15px;	
        }
	
    </style>
	 
	 
	
    <script src="https://js.braintreegateway.com/web/3.96.0/js/client.min.js"></script>
    <script src="https://js.braintreegateway.com/web/3.96.0/js/hosted-fields.min.js"></script>

<script>
var scheduleConsultation_data = "";



        fetch('/braintree/token')
            .then(response => response.json())
            .then(data => {
                braintree.client.create({
                    authorization: data.token
                }, function (clientErr, clientInstance) {
                    braintree.hostedFields.create({
                        client: clientInstance,
                        styles: {
							input: { 
								'width': '100%', 
								'padding': '10px', 
								'margin-bottom': '15px', 
								'border': '1px solid #ccc', 
								'border-radius': '5px' 
							}
						},
                        fields: {
                            number: { selector: '#card-number', placeholder: 'Card Number'},
                            expirationDate: { selector: '#expiration-date', placeholder: 'MM/YY'},
                            cvv: { selector: '#cvv', placeholder: 'CVV' }
                        }
                    }, function (hostedFieldsErr, hostedFieldsInstance) {
                        document.getElementById('payment-form').addEventListener('submit', function (e) {
                            e.preventDefault();

                            hostedFieldsInstance.tokenize(function (tokenizeErr, payload) {
                                if (tokenizeErr) {
                                    document.getElementById('result').innerText = tokenizeErr.message;
                                    return;
                                }
								
								toastr.info('Please wait...', 'Processing', {
											timeOut: 0,
											extendedTimeOut: 0,
								});
	
								scheduleConsultation.nonce = payload.nonce;
								localStorage.setItem("scheduleConsultation", JSON.stringify(scheduleConsultation));
	
                                fetch('/braintree/pay', {
                                    method: 'POST',
                                    headers: {
                                        'Content-Type': 'application/json',
                                      
                                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                                    },
                                    body: JSON.stringify({ nonce: payload.nonce,scheduleConsultation:scheduleConsultation_data })
                                })
                                .then(res => res.json())
                                .then(res => {
									toastr.clear();
                                    if (res.success) {
										toastr.success("Payment Successful");	
										CallAjaxNow('')
                                        
                                    } else {
										toastr.error(res.message);
                                        
                                    }
                                });
                            });
                        });
                    });
                });
});

</script>
		*/?>

<script>
$(function(){
	scheduleConsultation_data = JSON.parse(localStorage.getItem("scheduleConsultation"));
	if(scheduleConsultation_data.price) {
		$(".consultancy-fees").val(scheduleConsultation_data.price);
		$(".consultancy-fees-btn").html("Secure Pay $"+scheduleConsultation_data.price);
	} else {
		window.location.href="{{ route('mobile-dashboard')}}";
	}
})
</script>
	</div>
</div>
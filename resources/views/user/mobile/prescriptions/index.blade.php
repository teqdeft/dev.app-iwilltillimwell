@extends("mobile.layouts.dashboard")
@section("content")

<?php  
	$mypackageservicelist = GetMyPackageServiceList();
	$prescription_a = checkServiceEnabled($mypackageservicelist, 17);
	$prescription_b = checkServiceEnabled($mypackageservicelist, 18);
	$prescription_c = checkServiceEnabled($mypackageservicelist, 20);
	$plan_info = getMyCurrentPlanRecords(Auth::user()->id);
?>
	
<style>
.braintree-field {
    border: 1px solid #ccc;
    padding: 10px;
    margin-bottom: 12px;
    height: 40px;
}
</style>

<script src="https://js.braintreegateway.com/web/3.96.0/js/client.min.js"></script>
<script src="https://js.braintreegateway.com/web/3.96.0/js/hosted-fields.min.js"></script>

<script>
    braintree.client.create({
        authorization: "{{ $clientToken }}"
    }, function (clientErr, clientInstance) {
        if (clientErr) {
            console.error(clientErr);
            return;
        }

        braintree.hostedFields.create({
            client: clientInstance,
            styles: {
                'input': {
                    'font-size': '16px',
                    'color': '#333'
                },
                ':focus': {
                    'color': '#000'
                },
                '.invalid': {
                    'color': 'red'
                },
                '.valid': {
                    'color': 'green'
                }
            },
            fields: {
                number: {
                    selector: '#card-number',
                    placeholder: '4111 1111 1111 1111'
                },
                cvv: {
                    selector: '#cvv',
                    placeholder: '123'
                },
                expirationDate: {
                    selector: '#expiration-date',
                    placeholder: 'MM/YY'
                }
            }
        }, function (hostedFieldsErr, hostedFieldsInstance) {
            if (hostedFieldsErr) {
                console.error(hostedFieldsErr);
                return;
            }

            const form = document.getElementById('payment-form');

            form.addEventListener('submit', function (event) {
                event.preventDefault();

                hostedFieldsInstance.tokenize(function (tokenizeErr, payload) {
                    if (tokenizeErr) {
                        console.error(tokenizeErr);
                        toastr.error('Invalid payment info.');
                        return;
                    }

                    // Add the nonce to a hidden field and submit
                    document.getElementById('nonce').value = payload.nonce;
                    form.submit();
					showLoaderPageLoad('show');
                });
            });
        });
    });
</script>

@php
    $pay_amount = '0';
@endphp

@if (request()->is('prescriptions-a-type'))
	
	@php
		$pay_amount = '10';
		if($plan_info && in_array($plan_info->plan_id, Config::get('constants.family_plan'))) {
			
		}
	@endphp
			
		@include('user.mobile.prescriptions.prescriptions-b')
		
@elseif (request()->is('prescriptions-c-type'))

	@php
			$pay_amount = '20';
			if($plan_info && in_array($plan_info->plan_id, Config::get('constants.family_plan'))) {
				
			}
	@endphp
	@include('user.mobile.prescriptions.prescriptions-c')

@elseif (request()->is('prescriptions-b-type'))
	
		@php
			$pay_amount = '15';
			if($plan_info && in_array($plan_info->plan_id, Config::get('constants.family_plan'))) {
				
			}
		@endphp
		@include('user.mobile.prescriptions.prescriptions-a')
		
			
@endif
	



<div id="payment-screen" class="modal psychology">
    <div class="modal-content">
			
            <span class="close-modal" onclick="closePaymentScreen('payment-screen');">&times;</span>
			<div class="cust-modal-body">
				<h5>Prescriptions Payment</h5>
				<form id="payment-form" method="POST" action="prescriptions-payment">
					@csrf
					<div class="form-row">
						<div class="col-100 form-group">
							<label>Card Number<span class="required-ico">*</span></label>
							<div id="card-number" class="braintree-field form-control"></div>
						</div>
						<div class="col-100 form-group">
							<label>Expiration Date<span class="required-ico">*</span></label>
							<div id="expiration-date" class="braintree-field form-control"></div>
						</div>
						<div class="col-100 form-group">
							<label>CVV<span class="required-ico">*</span></label>
							<div id="cvv" class="braintree-field form-control"></div>
						</div>
						<div class="col-100 cta">
							<input type="hidden" name="payment_method_nonce" id="nonce">
							<button type="submit" class="btn primary-button">Pay ${{$pay_amount}}</button>
						</div>
						
					</div>	
				</form>
			
			</div>
    </div>
</div>


<script>
function closePaymentScreen(type) {
	$("#"+type).removeAttr("style");
}
function showPaymentScreen(type) {
	$("#"+type).css("display","flex");
}
</script>
<?php /*
<div id="prescriptions-modal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        
        <h4 class="modal-title">Prescriptions Payment</h4>
		<button type="button" class="close" data-dismiss="modal">&times;</button>
		
      </div>
      <div class="modal-body">
        
			<form id="payment-form" method="POST" action="prescriptions-payment">
				@csrf

				<label>Card Number</label>
				<div id="card-number" class="braintree-field"></div>

				<label>Expiration Date</label>
				<div id="expiration-date" class="braintree-field"></div>

				<label>CVV</label>
				<div id="cvv" class="braintree-field"></div>

				<input type="hidden" name="payment_method_nonce" id="nonce">
				<button type="submit" class="btn btn-primary">Pay Now</button>
			</form>
		
		
      </div>
      
    </div>

  </div>
</div>
*/ ?>

	
@include('mobile.includes.foooter-tab')
@endsection
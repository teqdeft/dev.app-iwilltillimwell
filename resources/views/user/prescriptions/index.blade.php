@extends('layouts.v1.dashboard')
@section('content')
<div class="content-wrapper">
	<section class="prescription-main">
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
						toastr.error('Invalid payment information.');
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
			@include('user.prescriptions.prescriptions-b')
		
		@elseif (request()->is('prescriptions-b-type'))
		
			@php
				$pay_amount = '15';
				if($plan_info && in_array($plan_info->plan_id, Config::get('constants.family_plan'))) {
					
				}
			@endphp	
			@include('user.prescriptions.prescriptions-a')
		
		
		@elseif (request()->is('prescriptions-c-type'))
			
			@php
				$pay_amount = '20';
				if($plan_info && in_array($plan_info->plan_id, Config::get('constants.family_plan'))) {
					
				}
			@endphp	
			@include('user.prescriptions.prescriptions-c')	
			
			
		@endif
        



<div id="prescriptions-modal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Prescriptions Payment</h4>
		<button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
	  
      <div class="modal-body">
			@if($clientToken)
				<form id="payment-form" method="POST" action="prescriptions-payment">
					@csrf

					<label>Card Number<span class="required-ico">*</span></label>
					<div id="card-number" class="braintree-field"></div>

					<label>Expiration Date<span class="required-ico">*</span></label>
					<div id="expiration-date" class="braintree-field"></div>

					<label>CVV<span class="required-ico">*</span></label>
					<div id="cvv" class="braintree-field"></div>

					<input type="hidden" name="payment_method_nonce" id="nonce">
					<input type="hidden" name="pay_amount" id="pay_amount" value="{{$pay_amount}}">
					<button type="submit" class="btn primary-button">Pay ${{$pay_amount}}</button>
				</form>
			@else 
				
				
				<div class="alert alert-danger">
					<strong>Oops!</strong> 
					The payment service is temporarily unavailable. Please refresh the page or try again later.
				</div>
			
			@endif
		
      </div>
      
    </div>

  </div>
</div>

    </section>
</div>
@endsection
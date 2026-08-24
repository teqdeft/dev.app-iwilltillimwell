@extends("mobile.layouts.auth")

@section("content")

<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script> 

var promo_data=""; 

</script>


@php
    $showPayment = request()->boolean('paymentmethodselection'); 
@endphp

    <div class="dashboard-steps step-package-dasboard"  style="display: none;">
        @include('mobile.dashboardplanpayment.package-list')
    </div>     

    <div class="dashboard-steps step-invoice-dasboard" style="display: none;">
         @include('mobile.dashboardplanpayment.invoice-section')
    </div> 

    <div class="dashboard-steps step-payment-dasboard" style="display: {{ $showPayment ? 'block' : 'none' }};">    
        @include('mobile.dashboardplanpayment.payment-section')
    </div>

  

   

<script>

$(function(){

    let currentRoute = @json(Route::currentRouteName());

    if(currentRoute=="MobileUserChangePlans") {

        var step_position = 2;

        $(".plan-name-show").html("Change Plan");

    } else {

       // var step_position = @json(Auth::user()->step_position);

        var step_position = 2;

        $(".plan-name-show").html("Choose Plan");

    }

    

    show_tabs(step_position)

    console.log(step_position);

});

function show_tabs(step_position){

        $(".dashboard-steps").hide();

        if(step_position==2){

            $(".step-package-dasboard").show();

        } else if(step_position==3){

            $(".step-invoice-dasboard").show();

        } else if(step_position==4){

            $(".step-payment-dasboard").show();

        }

        <?php if($showPayment) {?> 

               $(".step-package-dasboard").hide(); 
               $(".step-payment-dasboard").show();

        <?php } ?>



}

@if(session('utm_source') && session('utm_medium') && session('utm_campaign'))

    document.getElementById('inputPromoCode').value = '{{ config("constants.signup-promo") }}';

    setTimeout(function(){  $(".promo-code-apply-btn").trigger("click"); }, 2000);

@endif





function validateCreditCard(input,max_number) {

    let value = input.value.replace(/\D/g, ''); // Remove any non-digit characters

    if (value.length > max_number) {

        value = value.substring(0, max_number); // Ensure the length doesn't exceed 10 digits

    }

    input.value = value; // Set the value back to the input

} 

$('#inputPromoCode').on('keydown', function(event) {

    const maxLength = 15;

    if (event.key === "Enter") {

        event.preventDefault();

        $('.promo-code-apply-btn').click();

    }

    if ($(this).val().length >= maxLength && event.key.length === 1 && !event.ctrlKey && !event.metaKey) {

        event.preventDefault();

        $(".promo-error").html('Maximum 15 characters allowed.').show();

    }

});

</script>





@endsection



@push('scripts')

    

    <script type="text/javascript" src="{{ asset('assets/js/mobile/bootstrap-datepicker.min.js') }}"></script>

    <script type="text/javascript" src="{{ asset('assets/js/mobile/bootstrap-datetimepicker.min.js') }}"></script>

    <script type="text/javascript" src="{{ asset('assets/js/mobile/datepickers.js') }}"></script>

	

<script>

$(document).on('submit','#invoice-form',function(e){

    e.preventDefault();

	showLoaderPageLoad('show');

    var formId = $("#invoice-form");

    $.ajax({

        method: "POST",

        url: formId.attr("action"),

        data: $(this).serialize(),

        dataType: "json",

        success: function(data) {

			showLoaderPageLoad('hide');

            if (data.original.status) {

                $("#package-free-trial-option").css("display","flex");

                //show_tabs(4);

                $(".user_final_amount").html("$"+data.original.user_final_amount+"/mo");

                let res = data.original.data;

                //setPaymentFields(res);

              $("#asking_payment_confirmation").css("display","flex");

            } else {



                $("#res-msg").append(

                    '<div class="alert alert-danger" role="alert">' +

                    data.original.message +

                    "</div>"

                );

                $(".alert-danger").fadeOut(5000, function() {

                    $(this).remove();

                });

            }

        },

    });

});

function closepackagetermconditionmodal(action) {

    if(action==1) {
        $("#agree_terms1").prop('checked', false);
	    $("#agree_terms1").prop('disabled', false);
         $("#packagetermconditionmodal").removeAttr("style");   
          return false;

    } else {
	 
            if ($(".agree_term_condition_checkbox").is(':checked')) {

                $("#agree_terms1").prop('checked', true);
	            $("#agree_terms1").prop('disabled', true);
                $("#packagetermconditionmodal").removeAttr("style");
            } else {
                toastr.error("Please accept the Terms & Conditions and Privacy Policy.");
                
            }

    }
   /*
	$("#packagetermconditionmodal").removeAttr("style");
	$("#agree_terms1").prop('checked', false);
	$("#agree_terms1").prop('disabled', false);
    */ 
	

}

$(document).on('change', '#agree_terms1', function () {

	$("#packagetermconditionmodal").css("display","flex");

});

$(document).on('change', '#agree_term_condition_checkbox', function () {

	
    if ($(this).is(':checked')) {
        
        $("#agree_terms1").prop('checked', true);
	    $("#agree_terms1").prop('disabled', true);

        $(".term_condition_accepted").removeAttr('disabled');

        
    } else {

        $("#agree_terms1").prop('checked', false);
	    $("#agree_terms1").prop('disabled', false);
        $(".term_condition_accepted").attr('disabled', true);

    }
});
function asking_payment_confirmation(action){
    if(action==1) {
        $("#asking_payment_confirmation").css("display","flex");
    } else {
        $("#asking_payment_confirmation").css("display","none");
    }
}
</script>	



<style>

.step-payment-dasboard .custom-checkbox_new.mt-4 {

    display: none;

}

</style>


<div id="packagetermconditionmodal" class="modal journal-modal package_term_condition_modal">
        <div class="modal-content">
            <span class="close-modal" onclick="closepackagetermconditionmodal(1);">
                <img src="{{ asset('assets/dashboard/assets/images/close.svg') }}" alt="Close Icon">
            </span>
            <div class="modal-body">
				@include('user.package.refund_policy_content',['page'=>'refund_policy'])	
				<div class="cta">
                    <button class="primary-button  term_condition_accepted" onclick="closepackagetermconditionmodal(2)" disabled >Accept</button> 
                </div>
            </div>
        </div>
</div>


<div id="asking_payment_confirmation" class="modal journal-modal asking_payment_confirmation">
    <div class="modal-content">
        <span class="close-modal" onclick="asking_payment_confirmation(2);">
                <img src="{{ asset('assets/dashboard/assets/images/close.svg') }}" alt="Close Icon">
        </span>
        <div class="modal-body">
                    <ul class="list-unstyled mb-4">
                        @if(config('services.payment_mode.paypal_status')=="enable")
                            <li class="mb-3">
                                <a href="?action=change-plan&active-tab=payment&paymentmethodselection=true&paymode=paypal"
                                class="text-decoration-none">

                                    <div class="payment_card_main paypal_method">

                                        <div class="paypal_img_icon">
                                            <img src="{{url('/assets/images/paypal.jpg')}}" height="24" alt="PayPal">
                                        </div>
                                       
                                        <div class="gatway_auther_detail">
                                            <div class="text_v1">
                                                <p>PayPal</p>
                                            </div>
                                            <div class="text_v2">
                                                <p class="text-muted d-block">Credit / Debit Card</p>
                                            </div>
                                        </div>

                                    </div>
                                </a>
                            </li>
                        @endif
                        @if(config('services.payment_mode.authorize_status')=="enable")
                            <li>
                                <a href="?action=change-plan&active-tab=payment&paymentmethodselection=true&paymode=authorize"
                                class="text-decoration-none">

                                    <div class="payment_card_main authorize_method">

                                        <div class="paypal_img_icon">
                                            <img src="{{url('/assets/images/authorize.jpg')}}" height="24" alt="Authorize">
                                        </div>
                                       
                                        <div class="gatway_auther_detail">
                                            <div class="text_v1">
                                                <p>Authorize.Net</p>
                                            </div>
                                            <div class="text_v2">
                                                <p class="text-muted d-block">Credit / Debit Card</p>
                                            </div>
                                        </div>

                                    </div>
                                </a>
                            </li>
                        @endif
                </ul>
				
        </div>
    </div>
</div> 

@if(config('constants.trial_days') > 0)

	@include('user.package.free-trial-modal-payment')

@endif



@endpush
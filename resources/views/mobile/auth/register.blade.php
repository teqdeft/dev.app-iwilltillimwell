@extends("mobile.layouts.auth")
@section("content")
<style>
body_backup { background:#6E5890}
</style>
<div id="auth-screen" class="app-main started-main-v1 mobile_register_v1">

    @include('mobile.auth.register.step2')
    @include('mobile.auth.register.verification-step3')
    @include('mobile.auth.register.term-condition-step4')
    @include('mobile.auth.register.profile-step-5')
    @include('mobile.auth.register.thank-you-step-6')
	
</div>


@include('mobile.auth.register.script')

<script>
function closepackagetermconditionmodal() {
	$("#packagetermconditionmodal").removeAttr("style");
	$("#termsCheckbox").prop('checked', false);
	$("#agree_terms1").prop('checked', false);
	$("#agree_terms1").prop('disabled', false);
	
}
function user_agree_term_condition() {
	$("#packagetermconditionmodal").css("display", "flex");
}

$(document).on('change', '#agree_term_condition_checkbox', function () { 
	$("#packagetermconditionmodal").css("display", "none");
	$('.user_agree_term_condition').prop('checked', true);
	$(".user_agree_term_condition").prop('disabled', true);
});
</script>

<div id="packagetermconditionmodal" class="modal journal-modal">
        <div class="modal-content">
            <span class="close-modal" onclick="closepackagetermconditionmodal();">
                <img src="{{ asset('assets/dashboard/assets/images/close.svg') }}" alt="Close Icon">
            </span>
            <div class="modal-body">
				
	
				@include('user.package.refund_policy_content',['page'=>'term_condition'])	
				
				
            </div>
        </div>
</div>
@endsection

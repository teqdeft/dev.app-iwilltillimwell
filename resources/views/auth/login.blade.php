@extends('layouts.auth')
@section('content')
<section class="new-login-web @if(request()->query('action') === 'iframe-login') no-bg @endif">
        <div class="new-login-container">

            <div class="background-image">
				<a href="{{ url('/')}}">
					<img src="{{ asset('assets/frontend/assets/images/login-image-updated.png')}}" alt="background image">
				</a>	
            </div>

            <div class="login-form-web">

                <div class="lotin-card-web">

                    <div class="card">
                        
                        <div class="top-section">
                            <div class="logo">
								<a href="{{ url('/')}}">
									<img class="logo"  src="{{ asset(env('APP_LOGIN_MOBILE_BLACK')) }}" alt="web logo">	
								</a>	
                            </div>
                            <div class="title">
                                <h1 class="web-t">{{ config('app.login_message') }}</h1>
                            </div>
                        </div>
    
                        <form class="web-login cust-form with-email-id" method="POST" action="{{ route('custom-login') }}" id="user-login-form">
                        @csrf
                            <div class="form-row">
                                <div class="col-100 form-group">
                                    <input class="form-control" type="text" name="email" placeholder="Email">
                                </div>
                                
                                <div class="col-100 form-group">
                                    <input class="form-control" type="password" name="password" id="password" placeholder="Password">
                                    <button id="togglePassword" type="button" class="eye-icon">
                                            <img src="{{ asset('assets/frontend/assets/images/eye-open.svg') }}" alt="eye icon"> 
                                    </button>
                                </div>
                                
                                <div class="col-100 form-group">
                                    <a href="{{ url('password/reset') }}" class="forget-pwd">Forgot Your Password?</a>
                                </div>
								
								
								@if(session('error'))
									<div class="col-100 form-group error-feedback">
										<span class="invalid-feedback error" role="alert">
											{{ session('error') }}
										</span>
									</div>
								@endif
								
                                <div class="col-100 form-group cta">
                                    <button type="submit" class="custom-cta">Sign In</button>
                                </div>
								
								<div class="col-100 form-group login-mob">
                                    <div class="or-m">
                                        <p>Or</p>
                                    </div>
                                    <div class="or-cta">
                                        <button onclick="loginCheck(1)" type="button" class="custom-cta outline">Sign In with Phone Number</button>
                                    </div>
                                </div>
								
                            </div>
							<div class="dont-account">
								<p>Don’t have an account? <span><a href="{{ route('register')}}" class="dont">Sign Up</a></span></p>
							</div>
                        </form>

                        
						
						
						<form id="login-otp-form" class="web-login cust-form with-phone-number" style="display:none;">
							@csrf
                            <div class="form-row">
                                <div class="col-100 form-group">
                                    <input class="form-control" type="text" name="phone_number" id="phone_number_app" placeholder="Phone Number" oninput="lengthValidation(this,'10')">
                                </div>
                                
								<div class="col-100 form-group error-feedback error-msg" style="display:none;">
									
								</div>
									
                                <div class="col-100 form-group cta">
                                    <button type="button" class="custom-cta" id="button-step2">Continue</button>
                                </div>

                                <div class="col-100 form-group login-mob">
                                    <div class="or-m">
                                        <p>Or</p>
                                    </div>
                                    <div class="or-cta">
                                        <button onclick="loginCheck(2)" type="button" class="custom-cta outline">Sign In with Email</button>
                                    </div>
                                </div>
                            </div>
                        </form>
						
						
						<form id="login-otp-verification-form" class="web-login cust-form with-otp-form" style="display:none;">
							@csrf
                            <div class="form-row">
                                <div class="col-100 form-group">
                                    <div class="get-started">
                                        <h3 class="heading-h3">OTP Verification</h3>
                                        <div class="con-detail">
                                            <p>Enter your OTP code here to log in.</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="code-input-container">
                                    <input type="text" id="digit1" name="digit1" maxlength="1" class="code-input">
                                    <input type="text" id="digit2" name="digit2" maxlength="1" class="code-input">
                                    <input type="text" id="digit3" name="digit3" maxlength="1" class="code-input">
                                    <input type="text" id="digit4" name="digit4" maxlength="1" class="code-input">
                                </div>
                                
                                <div class="col-100 form-group cta">
																		<p id="seconds-interval">If you don't receive the code within <span id="countdown">30</span> seconds, tap below to resend it.</p>
                                    <button type="button" id="button-step3-resend" class="custom-cta" style="display:none;">Re-send</button>
                                </div>

                                <div class="col-100 form-group login-mob">
                                    <div class="or-m">
                                        <p></p>
                                    </div>
                                    <div class="or-cta">
                                        <button id="button-step3" type="button" class="custom-cta outline">Continue</button>
                                    </div>
                                </div>
								
								<div class="col-100 form-group login-mob">
                                    <div class="or-m">
                                        <p>Or</p>
                                    </div>
                                    <div class="or-cta">
                                        <button onclick="loginCheck(2)" type="button" class="custom-cta outline">Sign In with Email</button>
                                    </div>
                                </div>
								
                            </div>
                        </form>
						

                    </div>
                    
                </div>

            </div>

        </div>
    </section>

<script>      
function loginCheck(action){
	$(".cust-form").hide();
	if(action==1) {
		$(".with-phone-number").show();
	} else {
		$(".with-email-id").show();
	}
}
function getOTPReset() {
    
    $("#digit1").val(null);
    $("#digit2").val(null);
    $("#digit3").val(null);
    $("#digit4").val(null);

} 
function showOTPOnInputBox(otp) {
    if(otp) {
        let otpString = otp.toString(); 
        console.log("otpString"+otpString);
        console.log(otpString.charAt(0));
        $('#digit1').val(otpString.charAt(0));  // Set first digit
        $('#digit2').val(otpString.charAt(1));  // Set second digit
        $('#digit3').val(otpString.charAt(2));  // Set third digit
        $('#digit4').val(otpString.charAt(3));  // Set fourth digit
    }
}

let counterInterval;
function counterIntervalFun () {
	
	if(counterInterval) {
        clearInterval(counterInterval);
        console.log("Previous interval cleared");
    }
	
	
    counterInterval = setInterval( () => {
        let counter = ($("#countdown").text()) ? $("#countdown").text() :  30;
        if (counter > 0) {
            $("#countdown").text(parseInt(counter) - 1);
        } else {
            $("#button-step3-resend").show();
            $("#seconds-interval").hide();
            clearInterval(counterInterval);
            console.log("interval cleared");
        }
    }, 1000);
}

$(document).ready(function(){
            $("#togglePassword").click(function(){
                TogglePassword('password','togglePassword');
            });
        
		
$('#button-step2').click(function(event) {
        
        event.preventDefault();
        let form = $("#login-otp-form");
        if (form.valid()) {
            toastr.info('Please wait...', 'Processing', {
               timeOut: 0,
               extendedTimeOut: 0,
           });
            var formData = form.serialize();
            $("#showPhoneNumber").text($("#phone").val());
            $.ajax({
                url: `${SITE_URL}/loginSendPhoneOtp`,
                type: 'POST',
                data: formData,
                dataType: 'json',
                success: function(res) {
                    toastr.clear();
                    if (res.success === true) {
                        showOTPOnInputBox(res.login_otp); 
                        $(".login-main").removeClass("filter").removeAttr("style");
                        $("#seconds-interval").show();
                        $("#button-step3-resend").hide();
                        $(".with-phone-number").hide();
                        $(".with-otp-form").show();
                        $("#countdown").text(30);
                        counterIntervalFun();

                    } else {
						
						/**/
						$(".error-msg").html('<span class="invalid-feedback error error-msg" role="alert">'+res.message+'</span>').show()
                        
						 toastr.warning(res.message); 
						
                    }
                },
                error: function(xhr, status, error) {
                    toastr.clear();
                    if (xhr.responseJSON && xhr.responseJSON.errors && xhr.responseJSON.errors.phone_number) {
						toastr.error(xhr.responseJSON.errors.phone_number[0]);
					} else if (xhr.responseJSON && xhr.responseJSON.message) {
						toastr.error(xhr.responseJSON.message);
					} else {
						toastr.error("Please try again.");
					}
                    
                }
            });
        }
    });
	
$('#button-step3-resend').click(function(event) {
        event.preventDefault();

        getOTPReset();
		
		let phone_number_app = $("#phone_number_app").val();
		
		toastr.info('Please wait...', 'Processing', {
               timeOut: 0,
               extendedTimeOut: 0,
           });
		   
		   
		
        // If the form is valid, submit via AJAX
        $("#login-otp-verification-form .code-input-container input").removeClass("error");
            $.ajax({
                url: `${SITE_URL}/resendOtp`,
                type: 'POST',
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                data: 'phone_number_app='+phone_number_app+'&resend='+true ,
                dataType: 'json',
                success: function(res) {
					toastr.clear();
                    if (res.success === true) {
						toastr.success(res.message);
                        showOTPOnInputBox(res.otp); 
                        $("#countdown").text(30);
                        $("#seconds-interval").show();
                        $("#button-step3-resend").hide();
                        counterIntervalFun();
                    } else {
                        toastr.warning(res.message);
                         
                    }
                },
                error: function(xhr, status, error) {
					toastr.clear();
                    toastr.warning(xhr.responseJSON.message);
                    //alert('Error submitting form: ' + xhr.responseJSON.message);
                }
            });
        
    });	
	
	$('#button-step3').click(function(event) {
        event.preventDefault();
        // If the form is valid, submit via AJAX
        let form = $("#login-otp-verification-form");
        console.log(form.valid());

        if (form.valid()) {

            toastr.info('Please wait...', 'Processing', {
               timeOut: 0,
               extendedTimeOut: 0,
           });
           
            var formData = form.serialize();
            getOTPReset();
            $.ajax({
                url: `${SITE_URL}/loginValidateOtpCode`,
                type: 'POST',
                data: formData,
                dataType: 'json',
                success: function(res) {
                    toastr.clear();
                    if (res.success === true) {
                        location.href = `${SITE_URL}/dashboard`;
                    } else {
                        toastr.error(res.message);
                    }
                },
                error: function(xhr, status, error) {
                    toastr.clear();
                    toastr.error(xhr.responseJSON.message);
                    
                    
                }
            });
            
        }
});
	
});	

$('#password').on('keydown', function(event) {
    const maxLength = 20;
    if ($(this).val().length >= maxLength && event.key.length === 1 && !event.ctrlKey && !event.metaKey) {
        event.preventDefault();
        toastr.error("Maximum 20 characters allowed.");
    }
});
localStorage.clear();
</script>
@endsection   



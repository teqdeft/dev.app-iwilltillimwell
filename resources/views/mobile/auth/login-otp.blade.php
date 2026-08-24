
@extends("mobile.layouts.default")
@section("content")

<div class="app-main login-main">
    <section class="sign-in-min login-otp-phone-section">
        <div class="cust-container">
            <div class="sign-content">
                <div class="logo-main">
                    <a href="{{ url('/')}}">
                        <img src="{{ asset(env('APP_LOGIN_MOBILE')) }}" alt="web logo">
                    </a>
                </div>
                <div class="sign-detail">
                    <div class="form-detail">
                        <form action="" id="login-otp-form" method="post">
                            @csrf
                            <div class="cust-form">
                                <input 
                                oninput="lengthValidation(this,'10')"
                                type="number" class="form-control" id="phone_number" placeholder="Phone Number" aria-label="Phone number" name="phone_number">
                            </div>
                            <!--<div class="cust-form">-->
                            <!--    <input type="password" class="form-control" placeholder="Password" aria-label="Password">-->
                            <!--</div>-->
                            <div class="cta">
                                <a href="javascript:void(0);" class="primary-button" id="button-step2">Continue</a>
                            </div>
                            <!-- new -->
                            <div class="full-w">
                                <div class="or">
                                    <p>Or</p>
                                </div>
                                <div class="cta-with-phone">
                                    <a href="{{ route('login')}}" class="outline-button" >Sign In with Email</a>
                                </div>
                            </div>
                            <!-- end new -->
                        </form>
                    </div>
                    <div class="bottom-detail">
                        <p>Need an account? <span><a href="{{ url('register')}}">Sign up</a></span></p>
                        <p>Need help with your password ? <span><a href="{{ url('password/reset') }}">Reset it.</a></span></p>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section class="started passcode login-otp-otp-section" style="display:none">
        <div class="cust-container">
          <div class="back-btn">
            <a onclick="backtoLoginOTP()" href="javascript:void(0)" class="back-main"><img src="{{ asset('mobile-images/back-arrow-for-darktheme.svg') }}" alt="back" /></a>
          </div>
          <div class="get-started">
            <h5 class="heading-h5">OTP Verification</h5>
          </div>

          <div class="form-started">
            <form action="" id="login-otp-verification-form" >
                @csrf
                <div class="cust-form">
                    <label>Enter your OTP code here. Used for logging in.</label>
                    <div class="code-input-container">
                        <input type="text" id="digit1" name="digit1" maxlength="1" class="code-input">
                        <input type="text" id="digit2" name="digit2" maxlength="1" class="code-input">
                        <input type="text" id="digit3" name="digit3" maxlength="1" class="code-input">
                        <input type="text" id="digit4" name="digit4" maxlength="1" class="code-input">
                    </div>
                </div>
                <div class="enter-code-bottom">
                    <p id="seconds-interval">If you don’t receive the code in <span id="countdown">30</span> seconds tap below to resend it</p>
                    <button type="submit" class="primary-button step-button-next" id="button-step3-resend" style="display:none">
                        Re-send
                    </button>
                </div>
                <div class="cta">
                    <div id="errorMessages"></div>
                   
                    <button type="submit" class="primary-button step-button-next" id="button-step3" value="3">Continue</button>
                </div>
            </form>
        </div>

        </div>
    </section>



</div>

<script>
var login_action_button = true;
function backtoLoginOTP() {
    $(".login-main").addClass("filter").attr("style","background-image: url({{ asset('mobile-images/login-new-image.png') }}) !important;");  
    $(".login-otp-phone-section").show();
    $(".login-otp-otp-section").hide();
}    
$(function(){  
    backtoLoginOTP();

    $("form#login-otp-form").on("keydown", function(event) {
        if (event.key === "Enter") {
            event.preventDefault(); 
            $("#button-step2").trigger("click");
        }
    });


     $('#button-step2').click(function(event) {
		 
		 if(login_action_button) {
				login_action_button = false;
				event.preventDefault();
				let form = $("#login-otp-form");
				if (form.valid()) {
					toastr.info('Please wait...', 'Processing', {
					   timeOut: 0,
					   extendedTimeOut: 0,
				   });
					var formData = form.serialize();
					$("#showPhoneNumber").text($("#phone").val());
					$(".login-form-msg").html("<p class='error'>Please Wait....</p>");
					$("#errorMessages").html("");
					$.ajax({
						url: `${SITE_URL}/loginSendPhoneOtp`,
						type: 'POST',
						data: formData,
						dataType: 'json',
						success: function(res) {
							login_action_button = true;
							toastr.clear();
							if (res.success === true) {
								showOTPOnInputBox(res.login_otp); 
								$(".login-main").removeClass("filter").removeAttr("style");
								$("#button-step3-resend").hide();
								$("#seconds-interval").show();
								$(".login-otp-phone-section").hide();
								$(".login-otp-otp-section").show();
								
								$("#countdown").text(30);
								counterIntervalFunUpdateApp();

							} else {
								login_action_button = true;
								toastr.warning(res.message);
							}
						},
						error: function(xhr, status, error) {
							login_action_button = true;
							toastr.clear();
							if(xhr.responseJSON.errors.phone_number){
								toastr.warning(xhr.responseJSON.errors.phone_number[0]);
							} else {
								toastr.warning("Please Try Again..");
							}
							
						}
					});
				}
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
					let message = 'Something went wrong.';
					if(xhr.responseJSON && xhr.responseJSON.message) {
						message = xhr.responseJSON.message;
						
                    }
                    toastr.error(message);
                }
            });
            
        }
});
$('#button-step3-resend').click(function(event) {
        event.preventDefault();

        getOTPReset();
        // If the form is valid, submit via AJAX
        $("#login-otp-verification-form .code-input-container input").removeClass("error");
		
			let phone_number_app = $("#phone_number").val();
            $.ajax({
                url: `${SITE_URL}/resendOtp`,
                type: 'POST',
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                data: 'phone_number_app='+phone_number_app+'&resend='+true ,
                dataType: 'json',
                success: function(res) {
                    if (res.success === true) {
                        showOTPOnInputBox(res.otp); 
                        $("#countdown").text(30);
                        $("#seconds-interval").show();
                        $("#button-step3-resend").hide();
                        counterIntervalFunUpdateApp();
                    } else {
                        toastr.warning(res.message);
                         
                    }
                },
                error: function(xhr, status, error) {
                    toastr.warning(xhr.responseJSON.message);
                    //alert('Error submitting form: ' + xhr.responseJSON.message);
                }
            });
        
    });

const inputs = document.querySelectorAll('.code-input');
    inputs.forEach((input, index) => {
        input.addEventListener('input', () => {
            if (input.value.length === 1 && index < inputs.length - 1) {
                inputs[index + 1].focus();
            }
        });
        input.addEventListener('keydown', (e) => {
            if (e.key === 'Backspace' && input.value === '' && index > 0) {
                inputs[index - 1].focus();
            }
        });
});

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
        $('#digit1').val(otpString.charAt(0)); 
        $('#digit2').val(otpString.charAt(1)); 
        $('#digit3').val(otpString.charAt(2)); 
        $('#digit4').val(otpString.charAt(3)); 
    }
    
}
let counterInterval;

function counterIntervalFunUpdateApp () {
	console.log("counterIntervalFunUpdateApp");
	
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
localStorage.clear();
</script>

@endsection


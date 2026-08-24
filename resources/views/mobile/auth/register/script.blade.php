 
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css">
<script>
     // JavaScript to move focus to the next input field automatically
    const inputs = document.querySelectorAll('.code-input');

    inputs.forEach((input, index) => {
        input.addEventListener('input', () => {
            if (input.value.length === 1 && index < inputs.length - 1) {
                inputs[index + 1].focus();
            }
        });

        // Allow backspacing to focus the previous input
        input.addEventListener('keydown', (e) => {
            if (e.key === 'Backspace' && input.value === '' && index > 0) {
                inputs[index - 1].focus();
            }
        });
    });

    $('#phone').on('blur keyup', function() {
        $("#step2-form").valid();
    });

    $('#button-step2').click(function(event) {
        event.preventDefault();
        getOTPReset(); 
        let form = $("#step2-form");
        if (form.valid()) {
			showLoaderPageLoad('show');
            var formData = form.serialize();
            $("#showPhoneNumber").text($("#phone").val());
            $.ajax({
                url: `${SITE_URL}/sendPhoneOtp`,
                type: 'POST',
                data: formData,
                dataType: 'json',
                success: function(res) {
                    showLoaderPageLoad('hide');
                    if (res.success === true) {
						getBackgroundChange('apply_remove');
						$("#seconds-interval").show();
						$("#button-step3-resend").hide();
						
						toastr.success(res.message);
                        showOTPOnInputBox(res.otp); 
                        $("#step-2").hide();
                        $("#step-3").show();
                        $("#countdown").text(30);
                        counterIntervalFunUpdated();
                    } else {
                        toastr.warning(res.message);    
                    }
                },
                error: function(xhr, status, error) {
					showLoaderPageLoad('hide');
                    toastr.warning(error);    
                }
            });
        }
    });

   

    $('#button-step3').click(function(event) {
        event.preventDefault();
       
        let form = $("#step3-form");
        if (form.valid()) {
            
            showLoaderPageLoad('show');

            var formData = form.serialize();
            $.ajax({
                url: `${SITE_URL}/validateOtpCode`,
                type: 'POST',
                data: formData,
                dataType: 'json',
                success: function(res) {
                    showLoaderPageLoad('hide');
                    if (res.success === true) {
                        $("#errorMessages").html("");
                        $("#step-3").hide();
                        $("#step-5").show();
                    } else {
                        toastr.error(res.message); 
                    }
                },
                error: function(xhr, status, error) {
                   showLoaderPageLoad('hide');
                    toastr.error(xhr.responseJSON.message);
                    //$("#errorMessages").html('<label  class="error" for="digit4">'+xhr.responseJSON.message+'</label>');
                    //$("#errorMessages").html(xhr.responseJSON.message);
                    //alert('Error submitting form: ' + xhr.responseJSON.message);
                }
            });
            
        }
    });

    $('#button-step4').click(function(event) {
        event.preventDefault();
        // If the form is valid, submit via AJAX
        $.ajax({
            url: `${SITE_URL}/acceptTermsAndStore`,
            type: 'POST',
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            data: 'terms='+true,
            dataType: 'json',
            success: function(res) {
                if (res.success === true) {
                    $("#step-4").hide();
                    $("#step-5").show();
                } else {
                    toastr.warning(res.message);    
                }
            },
            error: function(xhr, status, error) {
                toastr.warning(xhr.responseJSON.message);  
            }
        });
    });

    $('#button-step5').click(function(event) {
        event.preventDefault();
        let form = $("#step5-form");
        $(".submit-error").html("");
        
        if (form.valid()) {
            var formData = form.serialize();
            $.ajax({
                url: `${SITE_URL}/submitRegisterFinal`,
                type: 'POST',
                data: formData,
                dataType: 'json',			
                success: function(res) {
                    if (res.success === true) {						
					let url = `${SITE_URL}/mobile-onboard`;						
                        setTimeout( function() { 							
						console.log(res);							
						if(res.token==0) {								
							//location.href = url; 							
						} else {								
						location.href = `${SITE_URL}/mobile-plan?token=${res.token}`;							
						}	 
                            
                        }, 3000);
                        $("#step-5").hide();
                        $("#step-6").show();
                        $("#show_phone_number").html($("#phone").val());
                    } else {
                        $(".submit-error").html(res.message).show();
                        //alert(res.message);    
                    }
                },
                error: function(xhr, status, error) {
                    $(".submit-error").html(xhr.responseJSON.message).show();
                    //alert('Error submitting form: ' + xhr.responseJSON.message);
                }
            });
        }
    });

    // resend code button-step3-resend

    $('#button-step3-resend').click(function(event) {
        event.preventDefault();
        let form = $("#step5-form");
        getOTPReset(); 
        // If the form is valid, submit via AJAX
        if (form.valid()) {
            showLoaderPageLoad('show');
			let phone = $("#phone").val();
            var formData = form.serialize();
            $.ajax({
                url: `${SITE_URL}/resendOtpSignUp`,
                type: 'POST',
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                data: 'phone='+phone+'&resend='+true ,
                dataType: 'json',
                success: function(res) {
					showLoaderPageLoad('hide');
                     toastr.clear();
                    if (res.success === true) {
                        showOTPOnInputBox(res.otp); 
                        $("#countdown").text(30);
                        $("#seconds-interval").show();
                        $("#button-step3-resend").hide();
                        counterIntervalFunUpdated();
                    } else {
                        toastr.warning(res.message);
                    }
                },
                error: function(xhr, status, error) {
					showLoaderPageLoad('hide');
                    toastr.clear();
                    toastr.warning(xhr.responseJSON.message);
                }
            });
        }
    });

function getOTPReset() {

    $("#digit1").val(null);
    $("#digit2").val(null);
    $("#digit3").val(null);
    $("#digit4").val(null);

} 
function validatePhoneNumber(input) {
    let value = input.value.replace(/\D/g, ''); // Remove any non-digit characters
    if (value.length > 10) {
        value = value.substring(0, 10); // Ensure the length doesn't exceed 10 digits
    }
    input.value = value; // Set the value back to the input
}   

function showOTPOnInputBox(otp) {
    let otpString = otp.toString(); 
    console.log("otpString"+otpString);
    console.log(otpString.charAt(0));
    $('#digit1').val(otpString.charAt(0));  // Set first digit
    $('#digit2').val(otpString.charAt(1));  // Set second digit
    $('#digit3').val(otpString.charAt(2));  // Set third digit
    $('#digit4').val(otpString.charAt(3));  // Set fourth digit
}

$(document).ready(function() {

    let today = new Date();
    let eighteenYearsAgo = new Date();
    eighteenYearsAgo.setFullYear(today.getFullYear() - <?php echo config('constants.age_limit') ?>); 

        $("#dob").datepicker({
            dateFormat: "mm-dd-yy",  // Date format
            changeYear: true,
            changeMonth: true,
            yearRange: "-90:",  // Allow birth dates from 70 years ago to 18 years ago
            maxDate: eighteenYearsAgo // Ensures only 18+ users can select their DOB
        });
});

$(window).on('load', function() {
	  setTimeout(function() {
		  
		let logo = $('<img>', {src: "{{ asset(env('APP_LOGIN_MOBILE_BLACK')) }}",alt: 'logo img'});
		
		
		$('.thank-you-page-logo').append(logo);
		
		let successfullyadded = $('<img>', {src: "{{ asset('mobile-images/successfully-added.svg') }}",alt: 'logo img'});
		$('.successfully-added-ico').append(successfullyadded);
		
		
	}, 8000);  
});


let counterInterval; // Declare outside the function

function counterIntervalFunUpdated () {
    // Clear any previous interval
    if (counterInterval) {
        clearInterval(counterInterval);
        console.log("previous interval cleared");
    }

    // Start new interval
    counterInterval = setInterval(() => {
        let counter = ($("#countdown").text()) ? $("#countdown").text() : 30;
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
function GoToDashboard() {
	window.location.href='{{url("mobile-dashboard")}}';
}
function BackToLogin() {
	showLoaderPageLoad('show');
	window.location.href='{{url("login")}}';
}
function getBackgroundChange(action){
	if(action=="apply") {
		$("#auth-screen").addClass("mobile_register_v1");
		$("body").css("background","#6E5890");
	} else {
		$("#auth-screen").removeClass("mobile_register_v1");
		$("body").css("background","");
	}
}
getBackgroundChange('apply');
</script>


<style>
.fname, .lname {
    text-transform: capitalize;
}
#step-5 .input-container.gend label {
    top: 28% !important;
}

.create-profile-form .input-container select {
    width: 100%;
    height: 46px;
    padding: 0px 5px;
    border: 1px solid #ccc;
    border-radius: 4px;
    outline: none;
    font-size: 16px;
    font-family: var(--karla-font);
    padding-top: 0px;
}

#step-5 .d-none {
    display: none !important;
}
.eye-icon {
    position: absolute;
    right: 15px;
    top: 14px;
    padding: 0;
    border: 0;
    background: transparent;
    cursor: pointer;
}
.spinner-border {
    display: inline-block;
    width: max-content;
    height: max-content;
    vertical-align: text-bottom;
    border-right-color: transparent;
    border-radius: 50%;
    -webkit-animation: spinner-border .75s linear infinite;
    animation: spinner-border .75s linear infinite;
}


.ui-datepicker .ui-datepicker-header {
    background: #6e599091;
}

.ui-datepicker {
    width: 90% !important;
}


@keyframes spinner-border {
  to { transform: rotate(360deg); }
}
@keyframes spinner-grow {
  0% {
    transform: scale(0);
  }
  50% {
    opacity: 1;
    transform: none;
  }
}
</style>
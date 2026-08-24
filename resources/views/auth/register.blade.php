@extends('layouts.auth')
@section('content')
<section class="new-login-web @if (request()->query('action') === 'iframe-register') no-bg @endif">
    <div class="new-login-container">
        <div class="background-image">
			<a href="{{ url('/')}}">
				<img src="{{ asset('assets/frontend/assets/images/register-image.png')}}" alt="background image">
			</a>	
        </div>


        <link rel="stylesheet" href="https://code.jquery.com/ui/1.14.1/themes/base/jquery-ui.css">
        <script src="https://code.jquery.com/ui/1.14.1/jquery-ui.js"></script>

<style>
.d-none { display: none;}
ul li {display: block;}  
.fname , .lname {text-transform: capitalize;}
</style>      
        
        <div class="login-form-web">
                <div class="lotin-card-web register">
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


                        <form class="web-login cust-form" method="POST" action="{{ route('customRegister') }}" id="sign-up-form">
                        @csrf
                            <div class="form-row">

                                <div class="col-50 form-group">
                                    <input class="form-control fname" type="text" name="fname" placeholder="First Name">
                                </div>
                                <div class="col-50 form-group">
                                    <input class="form-control lname" type="text" name="lname" placeholder="Last Name">
                                </div>
                                <div class="col-50 form-group emailFieldContainer">
                                    <input class="form-control" type="email" name="email" id="email" placeholder="Email">
                                    
                                    <div type="button" class="eye-icon spinner-border-div d-none">
                                            <img src="{{ asset('assets/frontend/assets/images/codex_loader.svg') }}" alt="eye icon" class="spinner-border">
                                    </div>
                                    <div type="button" class="eye-icon register-check d-none">
                                            <img src="{{ asset('assets/frontend/assets/images/icon-park-solid_check-one.svg') }}" alt="eye icon">
                                    </div>
                                    <div type="button" class="eye-icon register-triangle d-none">
                                            <img src="{{ asset('assets/frontend/assets/images/material-symbols_warning-rounded.svg') }}" alt="eye icon">
                                    </div>

                                </div>
                                <div class="col-50 form-group">
                                    <input class="form-control" type="tel" name="primaryPhone" placeholder="Phone"  oninput="lengthValidation(this,'10')">
                                </div>
                                <div class="col-50 form-group">
                                    <input class="form-control" type="text" name="dob" id="dob" placeholder="Date of Birth" readonly>
                                    <button type="button" class="eye-icon" id="dobIcon">
                                            <img src="{{ asset('assets/frontend/assets/images/solar_calendar-linear.svg') }}" alt="eye icon">
                                    </button>
                                </div>

                                <div class="col-50 form-group">
                                    <div class="custom-select-wrapper">
                                        <div class="custom-select">
                                            <select id="gender" name="gender">
                                                <option value="">Gender</option>
                                                <option value="m">Male</option>
                                                <option value="f">Female</option>
                                                <option value="o">Other</option>
                                                
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-100 form-group" style="display:none;">
                                    <div class="custom-select-wrapper">
                                        <div class="custom-select">
                                            <select id="timezoneId" name="timezoneId">
                                                @foreach ($timezones as $timezone)
                                                    <option value="{{ $timezone->id }}">{{ $timezone->name }}</option>
                                                @endforeach
                                                
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-50 form-group">
                                    <input class="form-control" type="password" name="password" id="password" placeholder="Password" >
                                    <button id="password_div" type="button" class="eye-icon" onclick="TogglePassword('password','password_div')">
                                            <img src="{{ asset('assets/frontend/assets/images/eye-open.svg') }}" alt="eye icon">
                                    </button>
                                </div>

                                <div class="col-50 form-group">
                                    <input class="form-control" type="password" name="password_confirmation" id="password_confirmation" placeholder="Confirm Password">
                                    <button id="cpassword_div" type="button" class="eye-icon" onclick="TogglePassword('password_confirmation','cpassword_div')">
                                            <img src="{{ asset('assets/frontend/assets/images/eye-open.svg') }}" alt="eye icon"> 
                                    </button>
                                </div>
                                
                                <div class="col-100 register-meter_container form-group cust-pas-wrap" style="display:none">
                                    <div class="password-strength_cal slide-wrap">
                                            <span>Password strength <span id="calcuate-password-per">0%</span></span>
                                            <span class="password-slide"></span>
                                            <span class="password-slide-strong" id="password-slide-strong"></span>
                                    </div>
                                    <ul>
                                                                                            <li id="long">
                                                    <span class="wrongIcon">
                                                        <svg xmlns="http://www.w3.org/2000/svg" style="color: red"
                                                            width="16" height="16" fill="currentColor"
                                                            class="bi bi-x-circle" viewBox="0 0 16 16">
                                                            <path
                                                                d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                                            <path
                                                                d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z" />
                                                        </svg>
                                                    </span>
                                                    At least 8 characters long
                                                </li>
                                                                                            <li id="upper">
                                                    <span class="wrongIcon">
                                                        <svg xmlns="http://www.w3.org/2000/svg" style="color: red"
                                                            width="16" height="16" fill="currentColor"
                                                            class="bi bi-x-circle" viewBox="0 0 16 16">
                                                            <path
                                                                d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                                            <path
                                                                d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z" />
                                                        </svg>
                                                    </span>
                                                    One uppercase character
                                                </li>
                                                                                            <li id="lower">
                                                    <span class="wrongIcon">
                                                        <svg xmlns="http://www.w3.org/2000/svg" style="color: red"
                                                            width="16" height="16" fill="currentColor"
                                                            class="bi bi-x-circle" viewBox="0 0 16 16">
                                                            <path
                                                                d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                                            <path
                                                                d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z" />
                                                        </svg>
                                                    </span>
                                                    One lowercase character
                                                </li>
                                                                                            <li id="number">
                                                    <span class="wrongIcon">
                                                        <svg xmlns="http://www.w3.org/2000/svg" style="color: red"
                                                            width="16" height="16" fill="currentColor"
                                                            class="bi bi-x-circle" viewBox="0 0 16 16">
                                                            <path
                                                                d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                                            <path
                                                                d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z" />
                                                        </svg>
                                                    </span>
                                                    One number
                                                </li>
                                                                                            <li id="special">
                                                    <span class="wrongIcon">
                                                        <svg xmlns="http://www.w3.org/2000/svg" style="color: red"
                                                            width="16" height="16" fill="currentColor"
                                                            class="bi bi-x-circle" viewBox="0 0 16 16">
                                                            <path
                                                                d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                                            <path
                                                                d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z" />
                                                        </svg>
                                                    </span>
                                                    One special character
                                                </li>
                                                                                    </ul>
                                </div>

                                
                               
								<div class="col-100 form-group">
									<div class="form-check" style="display:flex; align-items:flex-start; gap:10px;">
										<input 
											class="user_agree_term_condition"
											type="checkbox" 
											name="termsCheckbox" 
											id="termsCheckbox" 
											value="1" 
											required
											style="margin-top:4px;"
										>
										<label for="termsCheckbox" style="font-size:14px; line-height:20px;">
										
											Review and agree to the terms and conditions and Privacy policy.
											<?php /*
											I agree to the 
											<a href="javascript:void(0)">
												Terms & Conditions
											</a> 
											and 
											<a href="javascript:void(0)">
												Privacy Policy
											</a>.
											*/ ?>
										</label>
									</div>
								</div>
                                <div class="col-100 form-group cta ">
                                    <button type="submit" class="custom-cta custom-button">Sign Up</button>
                                </div>
                            </div>
                        </form>

                        <div class="dont-account">
                            <p>Already have an account? <span><a href="{{ route('login')}}" class="dont">Log in</a></span></p>
                        </div>
                </div>  
            </div>
        </div>

    </div>
</section>   

<style>

.register-meter_container.cust-pas-wrap {
    border: 1px solid black;
    padding: 10px;
    border-radius: 5px;
}

</style>
<script>
$(document).on('focus', '#sign-up-form input[type="password"]#password', function() {
    console.log("Password field focused");
   
});
$(document).on('focus','input[type=password]#password',function(){
    $(".register-meter_container").show();
});

$(document).on('blur','input[type=password]#password',function(){
    if($(this).val() === '' ){
        $(".register-meter_container").hide();
    }
});


$(document).on('change', '.user_agree_term_condition', function () {
	$("#packagetermconditionmodal").modal({backdrop: 'static',keyboard: false}).modal("show");
});
$(document).on('change', '#agree_term_condition_checkbox', function () { 
	$("#packagetermconditionmodal").modal('hide');
	$('.user_agree_term_condition').prop('checked', true);
	$(".user_agree_term_condition").prop('disabled', true);
});

function close_modal() {
	$('.user_agree_term_condition').prop('checked', false);
	$('.agree_term_condition_checkbox').prop('checked', false);
}



	
$(document).on('keyup','#password',function(){
    let value = $(this).val();
	
    var stringCheck = {
            long:    false,
            upper:   false,
            lower:   false,
            number:  false,
            special: false,
        };

    let wrongIcon = `<svg xmlns="http://www.w3.org/2000/svg" style="color:red" width="16" height="16" fill="currentColor" class="bi bi-x-circle" viewBox="0 0 16 16">
        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
        <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
        </svg>`;

    let checkIcon = `<svg xmlns="http://www.w3.org/2000/svg" style="color:green" width="16" height="16" fill="currentColor" class="bi bi-check-circle" viewBox="0 0 16 16">
                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                    <path d="M10.97 4.97a.235.235 0 0 0-.02.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05z"/>
                    </svg>`;
    $('.register-meter_container #lower span').html(wrongIcon);
    $('.register-meter_container #upper span').html(wrongIcon);
    $('.register-meter_container #number span').html(wrongIcon);
    $('.register-meter_container #special span').html(wrongIcon);
    $('.register-meter_container #long span').html(wrongIcon);
	console.log("----------------++++++++++++++");
    let i = 0;
    while (i <= value.length){
            let specialChars = /[`!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?~]/;
            let character = value.charAt(i);
            if( character !== '' ){
                if( isNaN(parseInt(character)) && typeof character === "string"  && character.toLowerCase() === character && !specialChars.test(character) ){
                    $('.register-meter_container #lower span').html('');
                    $('.register-meter_container #lower span').html(checkIcon);
                    stringCheck.lower = true;
                }
                if( isNaN(parseInt(character)) && typeof character === "string" && character.toUpperCase() === character && !specialChars.test(character) ){
                    $('.register-meter_container #upper span').html('');
                    $('.register-meter_container #upper span').html(checkIcon);
                    stringCheck.upper = true;
                }
                if ( !isNaN(parseInt(character)) && !isNaN(character * 1)){
                    $('.register-meter_container #number span').html('');
                    $('.register-meter_container #number span').html(checkIcon);
                    stringCheck.number = true;
                }
                if( specialChars.test(character) ){
                    $('.register-meter_container #special span').html('');
                    $('.register-meter_container #special span').html(checkIcon);
                    stringCheck.special = true;
                }
            }
            i++;
        }
        if( value.length > 7 ){
            $('.register-meter_container #long span').html('');
            $('.register-meter_container #long span').html(checkIcon);
            stringCheck.long = true;

        }
        let countTrue = Object.values(stringCheck).filter(item => item === true).length;
        let percante = '0%';
        let percanteWidth = '2%';
        let percanteColor = '0 0 5px rgba(246, 8, 110, 0.8)';
        if( countTrue == 1 && value.length > 4 ){
            percante = '20%';
            percanteWidth = '20%';
        }else if( ( countTrue > 1 && countTrue < 5 ) ){
            if( countTrue == 2 ){
                percante = '40%';
                percanteWidth = '40%';
            }else if( countTrue == 3 ){
                percante = '60%';
                percanteWidth = '60%';
            }else if( countTrue == 4 ){
                percante = '80%';
                percanteWidth = '80%';
            }
            percanteColor = '#ffad00';
        }else if( countTrue == 5  ){
             percante = '100%';
             percanteWidth = '100%';
             percanteColor = '#02b502';
        }
        $("#calcuate-password-per").html(percante);
        $('#password-slide-strong').css({'width':`${percanteWidth}`,'background':`${percanteColor}`});

});

</script>   

<script>
$( function() {

    let today = new Date();
    let eighteenYearsAgo = new Date();
    eighteenYearsAgo.setFullYear(today.getFullYear() - <?php echo config('constants.age_limit') ?>); 

    $( "#dob" ).datepicker({
					changeYear: true,
                 dateFormat: "mm/dd/yy",
                yearRange: "-90:",
                 maxDate: eighteenYearsAgo
            });

$('#dobIcon').click(function(){
    $('#dob').datepicker('show');
});

var rows_to_delete = [];
$('[data-toggle="tooltip"]').tooltip();
var lis = $(".register-number li");
var dataArray = [];
$("#sign-up-form").submit(function(e) {
	
	
			
    e.preventDefault();
    $form = $("#sign-up-form");
    if ($("#sign-up-form").valid()) {
		
		toastr.info('Please Wait...', 'Processing', {
                timeOut: 0,
                extendedTimeOut: 0,
            });
		
        $("#sign-up-form .custom-button")
            .val("Please Wait...")
            .html("Please Wait...")
            .attr("disabled", true);
        $.post(
            $form.attr("action"),
            $(this).serialize(),
            function(response) {
				toastr.clear();
                var response = JSON.parse(response);
                console.log(response);
                $("#sign-up-form .custom-button")
                    .val("Submit")
                    .html("Submit")
                    .attr("disabled", false);
                if (response.original.status) {
					
					toastr.success("Congratulations! Your account has been successfully created.");
					setTimeout(function() {
						let res = response.original.data;
						location.href = SITE_URL + "/dashboard";
					},2000); 
					

                    /* if (response.original.data) {
                        let res = response.original.data;
                        location.href = SITE_URL + "/dashboard";

                        if (res.step_position == 4) {
                            setPaymentFields(res);
                        }
                    } else {
                        location.href = SITE_URL + "/dashboard";
                    } */
					
                } else {
                    if (response.original.payment_status == 1 && response.original.user_status == 1 && response.original.tele_userid) {
                        $(".set-error")
                            .html(
                                "You are already registered, please login <a href='" +
                                SITE_URL +
                                "/login'>here</a>"
                            )
                            .show();
                    } else if (response.original.payment_status == 2) {
                        $(".set-error").hide();
                        $("#access-code-div").show("");
                    } else {
						toastr.warning(response.original.message);
                    }
                }
            }
        );
    }else{
        console.log( $("#sign-up-form").valid() );
    }
});
});
function lengthValidation(input,max_number) {
    let value = input.value.replace(/\D/g, ''); // Remove any non-digit characters
    if (value.length > max_number) {
        value = value.substring(0, max_number); // Ensure the length doesn't exceed 10 digits
    }
    input.value = value; // Set the value back to the input
} 
$('#password').on('keydown', function(event) {
    const maxLength = 20;
    if ($(this).val().length >= maxLength && event.key.length === 1 && !event.ctrlKey && !event.metaKey) {
        event.preventDefault();
        toastr.error("Maximum 20 characters allowed.");
    }
});
</script>



<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<style>
.modal{display:none;position:fixed;z-index:1050;top:0;left:0;width:100%;height:100%;overflow:hidden;outline:0}.modal.show{display:block}.modal-backdrop{position:fixed;top:0;left:0;z-index:1040;width:100vw;height:100vh;background-color:rgba(0,0,0,.5)}.modal-dialog{position:relative;width:auto;margin:10% auto;max-width:600px}.modal-content{position:relative;background-color:#fff;border-radius:6px;padding:20px}.modal-header,.modal-footer{display:flex;justify-content:space-between;align-items:center}.modal-body{max-height:400px;overflow-y:auto}.close{background:none;border:0;font-size:20px;cursor:pointer}
</style>


<div class="modal fade term_condition_return_policy" id="packagetermconditionmodal" tabindex="-1" aria-labelledby="packagetermconditionmodal" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-sm">
    <div class="modal-content">
      <div class="modal-header">
			<h4 class="modal-title">Term & Condition</h4>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="close_modal()">
                      <span aria-hidden="true">×</span>
            </button>
      </div>
      <div class="modal-body">
	  
		@include('user.package.refund_policy_content',['page'=>'term_condition'])	
    	
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal" onclick="close_modal()">Close</button>
      </div>
    </div>
  </div>
</div>

@endsection

 


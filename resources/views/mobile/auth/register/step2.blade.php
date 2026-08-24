<?php /*
<section class="sign-in-min started v2 register-new-v1 app-main screen-email filter" id="step-2" style="background-image: url({{ asset('mobile-images/login-new-image.png') }}) !important;">
        <div class="cust-container">
			
			
	  
            <div class="sign-content">
                <div class="logo-main">
                    <a href="{{ url('/')}}">
                        <img class="logo" src="{{ asset('mobile-images/'. config('app.white_logo').'') }}"   alt="logo" />
                    </a>
                </div>
                <div class="sign-detail">
                    <div class="form-detail">
                        <form action="" id="step2-form" >
                            @csrf
								<div class="cust-form">
									<label for="country-input-group" style="display:none;">What is your mobile number?</label>
									<div class=" input-group">
										<select class="form-control" id="country-input-group" name="country">
											<option value="+1">+1 (US)</option>
											
										</select>
										<input class="form-control" type="number" name="phone" id="phone" placeholder="Your mobile number" maxlength="10" autocomplete oninput="validatePhoneNumber(this)" required>
										
									</div>
									<div class="spinner-border position-absolute register-spin" role="status" style="display: none">
										<span class="sr-only error" style="font-size:16px;">Please wait verifying phone number...</span>
									</div>
									<div class="error-message"></div>
								</div>
								
								<div class="cta">
									
									<button type="submit" class="primary-button step-button-next" id="button-step2" value="1">Continue</button>
								</div>
                          
                        </form>
                    </div>
                    <div class="bottom-detail">
                         <p>Already Account? <span><a href="{{ url('login') }}">Sign In</a></span></p>
                    </div>
                </div>
            </div>
        </div>
    </section>
	
*/ ?>
<section class="started v2 standard-logo" id="step-2">
    <div class="cust-container">
	
      <div class="back-btn">
        <a href="javascript:void(0)" class="back-main" onclick="BackToLogin()">
            <img src="{{ asset('mobile-images/back-arrow-for-darktheme.svg') }}" alt="back" />
        </a> 
      </div>
      
      <div class="reg-auth-logo">
			<div class="logo-main">
                    <a href="{{ url('/')}}">
                       <img src="{{ asset(env('APP_LOGIN_MOBILE')) }}" alt="app logo">
                    </a>
                </div>
      </div>
      <div class="get-started">
        <h5 class="heading-h5">Let's get started</h5>
		<p>Take the next step toward a healthier you.</p>
      </div>

      <div class="form-started emailFieldContainer">
        <form action="" id="step2-form" >
            @csrf
            <div class="cust-form">
                <label for="country-input-group">What is your mobile number?</label>
                <div class=" input-group">
                    <select class="form-control" id="country-input-group" name="country">
                        <option value="+1">+1 (US)</option>
                        
                    </select>
                    <input class="form-control" type="number" name="phone" id="phone" placeholder="Phone number" maxlength="10" autocomplete oninput="validatePhoneNumber(this)">
					
                </div>
                <div class="spinner-border position-absolute register-spin" role="status" style="display: none">
                    <span class="sr-only error" style="font-size:16px;">Please wait verifying phone number...</span>
                </div>
                <div class="error-message"></div>
            </div>
            <div class="number_helps_us">
				<p>Your number helps us keep your medical information secure. It is safe with us.</p>
			</div>
            <div class="cta">
                
                <button type="submit" class="primary-button step-button-next" id="button-step2" value="1">Continue</button>
            </div>
        </form>
    </div>

    </div>
</section>

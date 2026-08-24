<section class="started verification sign-in-min register-otp-v1" id="step-3" style="display: none;">
    <div class="cust-container">
		
		<div class="sign-content">
		
          <div class="back-btn">
            <button type="button" class="back-main step-button-back" value="3" onclick="getBackgroundChange('apply')">
                <img src="{{ asset('mobile-images/back-arrow-for-darktheme.svg') }}" alt="back" />
            </button>
          </div>
		  
			<div class="logo-main brand_logo_new">
                    <a href="{{ url('/')}}">
                         <img src="{{ asset(env('APP_LOGIN_MOBILE_BLACK')) }}" alt="app logo">
                    </a>
            </div>
		  
		  
          <div class="get-started">
            <h5 class="heading-h5">Verification code</h5>
          </div>
            <div class="form-started">
                <div class="enter-code-outer">
                    <p>Please enter the 4-digit code sent to you at <b><span id="showPhoneNumber"></span></b></p>
                </div>
                <form action="" id="step3-form" >
                    @csrf
                    <div class="cust-form">
                        
                        <div class="code-input-container">
                            <input type="text" id="digit1" name="digit1" maxlength="1" class="code-input" required>
                            <input type="text" id="digit2" name="digit2" maxlength="1" class="code-input" required>
                            <input type="text" id="digit3" name="digit3" maxlength="1" class="code-input" required>
                            <input type="text" id="digit4" name="digit4" maxlength="1" class="code-input" required>
                        </div>

                        <div id="errorMessages" class="code-input-container" style="color: red;font-size: 16px;"></div>

                        <div class="enter-code-bottom">
                            <p id="seconds-interval">If you don’t receive the code in <span id="countdown">30</span> seconds tap below to resend it</p>
                            <button type="submit" class="primary-button step-button-next" id="button-step3-resend" style="display:none">
                                Re-send
                            </button>
                        </div>

                    </div>

                    <div class="cta">
                        <button type="submit" class="primary-button step-button-next" id="button-step3" value="3">Submit</button>
                    </div>
                </form>
            </div>
		</div>
    </div>
</section>
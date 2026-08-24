<section class="started profile sign-in-min" id="step-5" style="display: none;">
    <div class="cust-container">
	
          <div class="back-btn">
            <button type="button" class="back-main step-button-back" value="5">
                <img src="{{ asset('mobile-images/back-arrow-for-darktheme.svg') }}" alt="back" />
            </button>
          </div>
		  
		  <div class="logo-main brand_logo_new">
                    <a href="{{ url('/')}}">
                        <img src="{{ asset(env('APP_LOGIN_MOBILE_BLACK')) }}" alt="app logo">
                    </a>
            </div>
			
          <div class="get-started">
            <h5 class="heading-h5">Create a profile</h5>
          </div>

         <div class="create-profile-form mb-50">
            <div class="top">
                <p>Tell us about you</p>
            </div>
            <form action="" id="step5-form" >
                @csrf
                <div class="input-container">
                    <input type="text" name="fname" class="fname" placeholder=" " required>
                    <label for="username">First name</label>
                </div>
                <div class="input-container">
                    <input type="text" name="lname" class="lname" placeholder=" " required>
                    <label for="userlastname">Last name</label>
                </div>
                <div class="input-container emailFieldContainer">
                    <input type="email" name="email" id="email" placeholder=" " required>
                    <label for="usercontact">Email</label>

                    <div type="button" class="eye-icon spinner-border spinner-border-div d-none">
                        <img src="{{ asset('assets/frontend/assets/images/codex_loader.svg') }}" alt="eye icon" class="spinner-border">
                    </div>
                    <div type="button" class="eye-icon register-check d-none">
                        <img src="{{ asset('assets/frontend/assets/images/icon-park-solid_check-one.svg') }}" alt="eye icon">
                    </div>
                    <div type="button" class="eye-icon register-triangle d-none">
                        <img src="{{ asset('assets/frontend/assets/images/material-symbols_warning-rounded.svg')}}" alt="eye icon">
                    </div>

                </div>
                <div class="input-container">
                    <input type="password" name="password" id="password" placeholder=" " >
                    <label for="usercontact">Password</label>
                </div>
                <div class="input-container">
                    <input type="text" name="dob" id="dob" required>
                    <label for="useraddress">Date Of Birth</label>
                </div>
                <div class="input-container">
                    <input type="text" name="address" placeholder=" " required>
                    <label for="useraddress">Address</label>
                </div>
                <div class="input-container gend" required>
                        <select id="gender" name="gender">
                                                <option value="">Choose a Gender</option>    
                                                <option value="m">Male</option>
                                                <option value="f">Female</option>
                                                <option value="other">Other</option>
                                                
                        </select>
                        <?php /*
                    <label for="gender">Gender</label>
                    */ ?>
                </div>
				
				<div class="input-container user_agree_chk" >
									<div class="form-check" style="display:flex;">
										<input 
											onclick="user_agree_term_condition()"
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


                <div class="cta">
                    <span class="error submit-error" style=""></span>
                    <button type="submit" class="primary-button step-button-next" id="button-step5" value="5">Register</button>
                </div>
            </form>
         </div>
		 
    </div>
</section>



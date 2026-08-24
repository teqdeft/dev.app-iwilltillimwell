
<div class="app-main started-main-v1">

    <section class="started profile invoice-screen">
        <div class="cust-container">
          <div class="back-btn">
            <a href="javascript:void(0)" onclick="show_tabs(2)" class="back-main"><img src="{{ asset('mobile-images/back-arrow-for-darktheme.svg') }}" alt="back" /></a>
          </div>
		    <section class="onbd-logo-section">
					 <div class="logo-main">
						<a href="{{ url('/')}}">
							<img src="{{ asset(env('APP_LOGIN_MOBILE_BLACK')) }}" alt="app logo">
						</a>
					</div>	
			</section>
				
          <div class="get-started">
            <h5 class="heading-h5">Invoice Details</h5>
          </div>

         <div class="create-profile-form invoice-details">
            <div class="top">
                <p>Tell us about you</p>
            </div>
            <form action="{{ route('updateStep') }}" id="invoice-form">
                {{ csrf_field() }}
                <input type="hidden" name="next_step" value="4">
                <input type="hidden" name="email" value="{{ $user->email }}">
                <input type="hidden" name="request_from" value="mobile-view">
                <div class="input-container">   
                    <input type="text" id="fname_inv" name="fname" value="{{ $user->fname }}" readonly >
                    <label for="firstname">First name</label>
                </div>
                
                <div class="input-container">
                    <input type="text" id="lname_inv" name="lname" value="{{ $user->lname }}" readonly >
                    <label for="userlastname">Last name</label>
                </div>
                
                <div class="input-container">
                    <input type="number" id="phone_inv" placeholder="" name="primaryPhone" value="{{ $user->primaryPhone }}" onkeyup="lengthValidation(this,'10')" readonly>
                    <label for="PrimaryPhone">Primary Phone</label>
                </div>
                
               
                
                <div class="input-container clc" style="display: none;">
                    <input id="date_of_birth"  name="dob" autocomplete="off" value="{{ $user->dob }}"  class="datepicker-ico" disabled>
                     <label for="date">Date Of Birth</label>
                </div>
                
                <div class="cust-radio">
                    <div class="title">
                        <p>Gender</p>
                    </div>
                    <div class="radio-g">
                        <label>
                            <input type="radio" name="gender" id="optionsRadios1" value="m" {{ ($user->gender=="m") ? "checked" : ""}}>
                            Male
                        </label>
                        <label>
                            <input type="radio" name="gender" id="optionsRadios1" value="f" {{ ($user->gender=="f") ? "checked" : ""}}>
                            Female
                        </label>
                    </div>
                    <div id="gender-error"></div>
                </div>
                
                <div class="input-container">
                    <select class="form-control theme-select" name="timezoneId">
                        <option value=""> -- SELECT TIME ZONE -- </option>
                        @foreach ($timezones as $timezone)
                        <option value="{{ $timezone->id }}" {{ ($timezone->id == $user->timezoneId) ? 'selected' : '' }}>
                            {{ $timezone->name }}
                        </option>
                        @endforeach
                    </select>
                   
                </div>
                
                 <div class="input-container">
                    <input type="text" id="address" placeholder="" name="address" value="{{ $user->address }}">
                    <label for="Address">Address</label>
                </div>
                
                <div class="input-container">
                    <input type="text" id="city" placeholder="" name="city" value="{{ $user->city }}">
                    <label for="City">City</label>
                </div>
                
                <div class="input-container">
                    <select class="form-control" name="stateid">
                        <option value="">Please select state</option>
                        @foreach ($states as $state)
                        <option value="{{ $state->id }}" {{ ($state->id == $user->stateid) ? 'selected' : '' }}>
                            {{ $state->name }}
                        </option>
                        @endforeach
                    </select>
                </div>
                
                <div class="input-container mb-50">
                    <input type="text" id="zipcode" placeholder="" name="zipCode" value="{{ $user->zipCode }}" onkeyup="lengthValidation(this,'6')">
                    <label for="zipcode">Zip Code</label>
                </div>
                
               
                <div class="cta">
                    <div id="res-msg" style="color:red"></div>
                    <button type="submit" class="primary-button" onclick="return VerifyInvoice();">next</button>
                </div>
            </form>
    
         </div>

        </div>
    </section>

</div>

<script>
function VerifyInvoice(){
   // return false;
}    
</script>


<div class="tabs choose-plan">
    <div class="choose-plan-nav mt-0 mb-0">
            <div class="plan-nav-text">
				<button type="button" class="primary-button" onclick="backToScreen('invoice')"> <i class="fa fa-chevron-left fa-arrow-icon fa-arrow-icon-back"></i> Back</button>
                <div class="title">
                    <h2>Invoice Details</h2>
                </div>
                <div class="text">
                    <p>Personalized health plans for every step of your journey.</p>
					
                </div>
            </div>
    </div>
</div>

    <section class="invoice-details-web">
        <div class="invoice-detail">
            <div class="create-profile-form invoice-details">
                <div class="top">
                    <p>Tell Us About You</p>
                </div>
               
				<form class="invoice-form-main" action="{{ route('updateStep') }}" id="invoice-form-web">
					{{ csrf_field() }}
					<input type="hidden" name="next_step" value="4">
					<input type="hidden" name="email" value="{{ $user->email }}">
				
                    <div class="cust-form-group">
                        <label>First Name</label>
                        <input class="form-control" name="fname" type="text" placeholder="Your Name" value="{{ ucfirst($user->fname) }}" readonly>
                    </div>

                    <div class="cust-form-group">
                        <label>Last Name</label>
                        <input class="form-control" name="lname" type="text" placeholder="Your Last Name" value="{{ ucfirst($user->lname) }}" readonly>
                    </div>

                    <div class="cust-form-group">
                        <label>Primary Phone</label>
                        <input class="form-control" type="number" name="primaryPhone"  placeholder="Your Contact Number" value="{{ $user->primaryPhone }}" onkeyup="lengthValidation(this,'10')" readonly>
                    </div>

                    <div class="cust-form-group">
                        <label>Date Of Birth</label>
                        <input class="form-control" placeholder="Date Of Birth" value="{{ $user->dob }}"  class="datepicker-ico"  readonly>
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
							
                            <label>
                                <input type="radio" name="gender" id="optionsRadios1" value="o" {{ ($user->gender=="o") ? "checked" : ""}}>
                                Other
                            </label>
							
                        </div>
                        <div id="gender-error"></div>
                    </div>

                    <div class="cust-form-group">
                        <label> Select Time Zone</label>
                        <select class="form-control theme-select" name="timezoneId">
                            
								<option value="">  -- Select Time Zone -- </option>
								@foreach ($timezones as $timezone)
								<option value="{{ $timezone->id }}" {{ ($timezone->id == $user->timezoneId) ? 'selected' : '' }}>
									{{ $timezone->name }}
								</option>
								@endforeach
								
                        </select>
                    </div>

                    <div class="cust-form-group">
                        <label>Address</label>
                        <input class="form-control" type="text" name="address" id="address" value="{{ $user->address }}" placeholder="Address">
                    </div>

                    <div class="cust-form-group">
                        <label>City</label>
                        <input type="text" id="city" placeholder="Enter Your City" name="city" id="city" value="{{ $user->city }}">
                    </div>

                    <div class="cust-form-group">
                        <label>State</label>
                        <select class="form-control" name="stateid" id="stateid">
                            
								<option value="">Please select state</option>
								@foreach ($states as $state)
								<option value="{{ $state->id }}" {{ ($state->id == $user->stateid) ? 'selected' : '' }}>
									{{ $state->name }}
								</option>
								@endforeach
                        </select>
                    </div>

                    <div class="cust-form-group mb-50">
                         <label>Zip Code</label>
                        <input class="form-control" type="text" name="zipCode" id="zipCode" value="{{ $user->zipCode }}" placeholder="Your Zip Code"
						onkeyup="validateCreditCard(this,'6')"
						>
                    </div>

                    <div class="cta">
						
                        <button type="submit" class="medicine-detail-btn">Next <i class="fa fa-chevron-right fa-arrow-icon"></i> </button>
                    </div>
                </form>

            </div>
        </div>
</section>
@push('scripts')
<script>
$(document).on('submit','#invoice-form-web',function(e){
    e.preventDefault();
	
	let city = $("#city").val().trim();
	let cityRegex = /^[A-Za-z\s]{2,}$/;

	if(city === "") {
		toastr.error("City is required.");
		return false;
	} else if (!cityRegex.test(city)) {
		toastr.error("Please enter a valid city name (letters only, minimum 2 characters).");
		return false;
	}
	let address = $("#address").val().trim();
	if(address === "") {
		toastr.error("Address is required.");
		return false;
	}
	let stateid = $("#stateid").val().trim();
	if(stateid === "") {
		toastr.error("Please select a state.");
		return false;
	}
	let zipCode = $("#zipCode").val().trim();
	if(zipCode === "") {
		toastr.error("Zip Code is required.");
		return false;
	}
	
    var formId = $("#invoice-form-web");
    $.ajax({
        method: "POST",
        url: formId.attr("action"),
        data: $(this).serialize(),
        dataType: "json",
        success: function(data) {
            if (data.original.status) {

                     $("#asking-payment-method").modal({
						backdrop: 'static',
						keyboard: false
					}).modal('show');
                /*
                let res = data.original.data;
                setPaymentFields_update(res);
				$(".user-invoice-section").hide();
				$(".user-payment-section").show();
				const url = new URL(window.location);
				url.searchParams.set('active-tab', 'payment');
				window.history.pushState({}, '', url);
				*/ 
				
					
					
            } else {
				toastr.error(data.original.message);
                
            }
        },
    });
});
function setPaymentFields_update(res) {
    $("#card-button").attr("data-secret", res.client_secret);
    $("#getPlan").val(res.stripe_planid);
    $("#getPlanName").val(res.stripe_plan_name);
    $("#getPrice").val(res.stripe_plan_price);
    $("#card-holder-name").val(res.fname + " " + res.lname);
    $("#step4-email").val(res.email);
}
</script>

<link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>

<script>
    $(function () {
      $("#appointment-date").datepicker({
        changeYear: true,
        dateFormat: "yy-mm-dd",
        minDate: 0,
		maxDate: 14,
		beforeShowDay: function (date) {
			
			const day = date.getDay();
			if (day === 0 || day === 6) {
			  return [false, '', 'Weekend disabled'];
			}
			return [true, ''];
			
		}
      });
    });
</script>
@endpush
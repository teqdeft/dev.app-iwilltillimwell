<div class="showaddeditform" style="display: none;">
	
	<div class="dependent-eighteen-plus dependent-section" style="display:none;">
		
		
		<form class="row" method="post">
			<div class="form relac-type">
				<div class="form-row">
				
					<div class="col-100 form-group">
						<label>Relationship</label>
						<?php $relationship = Config::get('constants.relationship'); ?>    
						<select class="form-control theme-select" name="relationship" id="dependent-relationship">
							@foreach ($relationship as $key=> $relation)
								<option value="{{ $key }}">
									{{ $relation }}</option>
							@endforeach
						</select>
					</div>
					
					<div class="col-100 cta">
						<button type="button" class="primary-button relationship-btn">Save</button>
					</div>
				</div>	
			</div>	
		</form>
		
		<form class="row email-record" method="post">
			<div class="form">
				<div class="form-row">
				
					<div class="col-100 form-group">
						<label>Email</label>
						<input class="form-control" type="text" name="email" id="resend_email" readonly>
					</div>
					
					<div class="col-100 cta">
						<button type="button" class="primary-button resend-email-btn">Resend Registration Email</button>
					</div>
				</div>	
			</div>	
		</form>
		
		<form class="row update-email" method="post">
			<div class="form">
				<div class="form-row">
					<div class="reset-ahref">
						<a href="javascript:void(0)" onclick="changeEmailDependent()">Click Here Update Email Address.?</a>
					</div>
					<div class="email-section" style="display:none;">
						<div class="col-100 form-group">
							<label>Email</label>
							<input class="form-control" type="text" name="change_email_id" id="change_email_id">
						</div>
						
						<div class="col-100 cta">
							<button type="button" class="primary-button change-email-btn">Change Email</button>
						</div>
					</div>
					
				</div>	
			</div>	
		</form>
		
		<form class="row status-email" method="post">
			<div class="form">
				<div class="form-row">
				
					<div class="col-100 form-group">
						<label>Status</label>
						
						<select class="form-control theme-select" name="status" id="dependent-status">
							<option value="">Select Status</option>
							<option value="1">Active</option>
							<option value="0">Inactive</option>
						</select>
					</div>
					
					<div class="col-100 cta">
						<button type="button" class="primary-button dependent-status">Save</button>
					</div>
				</div>	
			</div>	
		</form>
		
	</div>
	
	
	
	<div class="dependent-eighteen-below dependent-section" style="display:none;">
		<form class="row" method="post" id="add-dependent-form"
									action="{{ route('add-dependent') }}">
									@csrf   
									<input type="hidden" name="dependent-id" id="dependent-id">                                 
									<div class="form">
										<div class="form-row">


										<div class="relaction-v" style="font-family: var(--helvetica-neue);font-size: 16px;position: relative;border-bottom: 1px solid #d7d7d7;padding-bottom: 10px;width: 100%;">
											<p>Relationship to  {{ $user->name}}</p>
										</div>

											<div class="col-100 form-group">
												<label>Relationship</label>
												<?php $relationship = Config::get('constants.relationship'); ?>    
												
												<select class="form-control theme-select" name="relationship" id="relationship">
																					@foreach ($relationship as $key
																					=> $relation)
																					<option value="{{ $key }}">
																						{{ $relation }}</option>
																					@endforeach
																				</select>


											</div>
											
											<div class="col-100 form-group">
												<label>First Name</label>
												<input class="form-control" type="text" name="fname" id="fname">
											</div>

											<div class="col-100 form-group">
												<label>Last Name</label>
												<input class="form-control" type="text" name="lname" id="lname">
											</div>

											<div class="col-100 form-group">
												<label>Date of Birth</label>
												<input class="form-control datepicker-ico" type="text" name="dob" id="dependent_dob" readonly>
											</div>

											<div class="col-100 form-group">
												<label>Gender</label>
												<select name="gender" id="gender-department">
													<option value="">Select</option>
													<option value="m">Male</option>
													<option value="f">Female</option>
													<option value="o">Other</option>
												</select>
											</div>
	<?php /*
											<div class="col-100 form-group">
												<label>Status</label>
												<select class="form-control" name="status">
													<option value="">Select Status</option>
													<option value="1">Active</option>
													<option value="0">Inactive</option>
												</select>
											</div>    
	*/ ?>
											<div class="col-100 form-group">
												<label>Primary Phone</label>
												<input class="form-control" type="tel" name="primaryPhone" id="primaryPhone" onkeyup="lengthValidation(this,'10')">
											</div>

											<div class="col-100 form-group">
												<label>Secondary Phone</label>
												<input class="form-control" type="tel" name="secondaryPhone" id="secondaryPhone" onkeyup="lengthValidation(this,'10')">
											</div>

											<?php $user_status = Config::get('constants.user_status'); ?>

											<div class="col-100 form-group">
												<label>Address</label>
												<input class="form-control" type="text" name="address" id="address">
											</div>

											<div class="col-100 form-group">
												<label>Address Line 2</label>
												<input class="form-control" type="text" name="address2" id="address2">
											</div>

											<div class="col-100 form-group">
												<label>City</label>
												<input class="form-control" type="text" name="city" id="city">
											</div>

											<div class="col-100 form-group">
												<label>State</label>
												<select class="form-control theme-select"
																					name="stateid" id="stateid">
																					<option value="">Please select state
																					</option>
																					@foreach ($states as $state)
																					<option value="{{ $state->id }}">
																						{{ $state->name }}</option>
																					@endforeach
												</select>
											</div>

											<div class="col-100 form-group">
												<label>Zip Code</label>
												<input class="form-control" type="text" name="zipCode" id="zipCode" onkeyup="lengthValidation(this,'6')">
											</div>

											

											   
											<div class="col-100 form-group">
												<label>Time Zone</label>
												<select class="form-control theme-select"
																					name="timezoneId"  id="timezoneId">
																					<option value=""> -- SELECT TIMEZONE --
																					</option>
																					@foreach ($timezones as $timezone)
																					<option value="{{ $timezone->id }}">
																						{{ $timezone->name }}</option>
																					@endforeach
												</select>
											</div>

											<div class="col-100 form-group dependent-email-cnt" style="display: none;">
												<label>Email</label>
												<input class="form-control" type="text" name="email" id="email" >
											</div>

											<div class="col-100 cta">
												<button type="submit" class="primary-button">Save</button>
											</div>

										</div>
									</div>
	</form>

	<link rel="stylesheet" href="https://code.jquery.com/ui/1.14.1/themes/base/jquery-ui.css">
	  <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
	  <script src="https://code.jquery.com/ui/1.14.1/jquery-ui.js"></script>
	  <script>
	  $( function() {
		$( "#dependent_dob" ).datepicker({
			changeYear: true,
			yearRange: "-60:",
			onSelect: function(dateText, inst) {
			var selectedDate = new Date(dateText);
			var currentDate = new Date();

			// Calculate the difference in years
			var age = currentDate.getFullYear() - selectedDate.getFullYear();
			var month = currentDate.getMonth() - selectedDate.getMonth();

			// Adjust if birthday hasn't occurred yet this year
			if (month < 0 || (month === 0 && currentDate.getDate() < selectedDate.getDate())) {
				age--;
			}

			if (age > 18) {
				$(".dependent-email-cnt").show();
			 } else {
				$(".dependent-email-cnt").hide();
			}

		  }
		});
	  } );
	</script>
	</div>								
</div>
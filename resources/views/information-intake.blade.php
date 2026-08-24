 @extends('layouts.default')
 @section('content')

 <div class="banner-sec information-banner">
 	<div class="cust-container">
 		<div class="banner-cont">
 			<h1>Information Intake Form</h1>
 		</div>
 	</div>
 </div>
 @if($consultations)
 <section class="information-sec">
 	<div class="cust-container">
 		<div class="information-cont" id="info-step-1">
 			<div class="information-top">
 				<h2>Consultation Details</h2>
 			</div>
 			<div class="information-bottom">
 				@foreach ($consultations as $consultation)

 				<div class="form-group-outer">
 					<div class="form-group">
 						<label>Consultation Type</label><br>
 						<span>{{ $consultation['consultationTypeName'] }}</span>
 					</div>

 					<div class="form-group">
 						<label>Name</label><br>
 						<span>{{ $consultation['patient']['firstName'] . ' ' . $consultation['patient']['lastName']}}</span>
 					</div>

 					<div class="form-group">
 						<label>Patient Phone</label><br>
 						<span>{{ $consultation['patientPhone'] }}</span>
 					</div>

 					<div class="form-group">
 						<label>Scheduled Date</label><br>
 						<span>{{ $consultation['whenScheduled'] }}</span>
 					</div>

 					<div class="form-group">
 						<label>Created Date</label><br>
 						<span>{{ $consultation['whenCreated'] }}</span>
 					</div>

 					<div class="form-group">
 						<label>Chief Complaint</label><br>
 						<span>{{ $consultation['problems']['chiefComplaint'][0]['name'] }}</span>
 					</div>

 					<div class="form-group">
 						<label>Pharmacy Name</label><br>
 						<span>{{ $consultation['pharmacy']['pharmacy_name'] }}</span>
 					</div>

 				</div>
 				@endforeach
 			</div>
 		</div>
 	</div>
 </section>
 @endif

 @if(@$healthRecords['success'])
 <section class="information-sec">
 	<div class="cust-container">
 		<div class="information-cont" id="info-step-1">
 			<div class="information-top">
 				<h2>Health Records</h2>
 			</div>
 			<div class="information-bottom">
 				@if (@$healthRecords['MedicalConditions'])
 				<div class="information-top">
 					<h2>Medical Conditions</h2>
 				</div>
 				<div class="form-group-outer">
 					@php $count = 1 @endphp
 					@foreach ($healthRecords['MedicalConditions'] as $condition)
 					<div class="form-group">
 						<label>Sr. No.</label><br>
 						<span>{{ $count }}</span>
 					</div>
 					<div class="form-group">
 						<label>Name</label><br>
 						<span>{{ $condition['name'] }}</span>
 					</div>
 					<div class="form-group">
 						<label>Description</label><br>
 						<span>{{ $condition['description'] }}</span>
 					</div>
 					<div class="form-group">
 						<label>Medical Condition id</label><br>
 						<span>{{ $condition['userMedicalCondition_id'] }}</span>
 					</div>
 					<br>
 					@php $count++ @endphp
 					@endforeach
 				</div>
 				@endif

 				@if (@$healthRecords['problems']['uncommonProblems'])
 				<div class="information-top">
 					<h2>Problems</h2>
 				</div>
 				<div class="form-group-outer">
 					@php $count = 1; @endphp
 					@foreach ($healthRecords['problems']['uncommonProblems'] as $problem)
 					<div class="form-group">
 						<label>Sr. No.</label><br>
 						<span>{{ $count }}</span>
 					</div>
 					<div class="form-group">
 						<label>Problem</label><br>
 						<span>{{ $problem['name'] }}</span>
 					</div>
 					<div class="form-group">
 						<label>Problem Category Name</label><br>
 						<span>{{ $problem['problemCategoryName'] }}</span>
 					</div>
 					<br>
 					@php $count++ @endphp
 					@endforeach
 				</div>
 				@endif

 				@if (@$healthRecords['MedicationAllergies'])
 				<div class="information-top">
 					<h2>Medication Allergies</h2>
 				</div>
 				<div class="form-group-outer">
 					@php $count = 1; @endphp
 					@foreach ($healthRecords['MedicationAllergies'] as $allergy)
 					<div class="form-group">
 						<label>Sr. No.</label><br>
 						<span>{{ $count }}</span>
 					</div>
 					<div class="form-group">
 						<label>Description</label><br>
 						<span>{{ $allergy['description'] }}</span>
 					</div>
 					<div class="form-group">
 						<label>when Created</label><br>
 						<span>{{ $allergy['whenCreated'] }}</span>
 					</div>
 					<br>
 					@php $count++ @endphp
 					@endforeach
 				</div>
 				@endif


 				@if (@$healthRecords['Medications'])
 				<div class="information-top">
 					<h2>Medication</h2>
 				</div>
 				<div class="form-group-outer">
 					@php $count = 1; @endphp
 					@foreach ($healthRecords['Medications'] as $medication)
 					<div class="form-group">
 						<label>User Medication id</label><br>
 						<span>{{ $medication['userMedication_id'] }}</span>
 					</div>
 					<div class="form-group">
 						<label>Description</label><br>
 						<span>{{ $medication['name'] }}</span>
 					</div>
 					<div class="form-group">
 						<label>Frequency</label><br>
 						<span>{{ $medication['frequency'] }}</span>
 					</div>
 					<div class="form-group">
 						<label>Comment</label><br>
 						<span>{{ $medication['comment'] }}</span>
 					</div>

 					<br>
 					@php $count++ @endphp
 					@endforeach
 				</div>
 				@endif
 			</div>
 		</div>
 	</div>
 </section>
 @endif

 <section class="information-sec">
 	<div class="cust-container">
 		@if ($user->parentId == null)
 		<div class="information-cont" id="info-step-1">
 			<div class="information-top">
 				<h2>1. General Information</h2>
 			</div>
 			<div class="information-bottom">
 				<form action="{{ route('store.generalinfo') }}" id="general-info-form" method="post">
 					{{ csrf_field() }}
 					<div class="radio-sec">
 						<ul>
 							<li><strong>Gender :</strong></li>
 							<li>
 								<input type="radio" id="male" name="gender" {{ $user->gender == 'm' ? 'checked' : '' }} value="m" required="required">
 								<label for="male">Male</label><br></li>
 								<li><input type="radio" id="female" name="gender" {{ $user->gender == 'f' ? 'checked' : '' }} value="f">
 									<label for="female">Female</label><br></li>
 								</ul> 
 							</div>
 							<div class="form-group-outer">
 								<div class="form-group">
 									<label for="text">First Name*</label>
 									<input type="text" class="form-control" id="first name" placeholder="enter your first name" name="firstname" value="{{$user->fname}}" required="required">
 								</div>
 								<div class="form-group">
 									<label for="last_name3">Last Name*</label>
 									<input type="text" class="form-control" id="last_name3" placeholder="enter your last name" name="lastname" value="{{$user->lname}}" required="required">
 								</div>
 								<div class="form-group">
 									<label for="password">Password*</label>
 									<input type="password" class="form-control" id="password" placeholder="" name="password" value="" required="required">
 								</div>
 								<div class="form-group">
 									<label for="date">Date of Birth *</label>
 									<input type="date" class="form-control" id="date" placeholder="" name="dob" value="{{$user->dob}}" required="required">
 								</div>
 								<div class="form-group">
 								</div>
 								<div class="form-group">
 									<label for="address">Address*</label>
 									<input type="text" class="form-control" id="address" placeholder="enter your address" name="address" value="{{$user->address}}" required="required">
 								</div>
 								<div class="form-group">
 									<label for="address12">Address*</label>
 									<input type="text" class="form-control" id="address12" placeholder="enter your address" name="address2" value="{{$user->address2}}" required="required">
 								</div>
 								<div class="form-group">
 									<label for="stateid">Select plan*</label>
 									<select class="form-control" name="planDetailsId" required="required">
 										<option value="">Select plan</option>
 										<option value="1" {{$user->planDetailsId == 1 ? 'selected' : ''}} >Single</option>
 										<option value="2" {{$user->planDetailsId == 2 ? 'selected' : ''}} >Single Plus Spouse</option>
 										<option value="3" {{$user->planDetailsId == 3 ? 'selected' : ''}} >Family</option>
 									</select>
 								</div>
 								<div class="form-group">
 									<label for="stateid">State*</label>
 									<select class="form-control" name="stateid" required="required">
 										<option>Select State</option>
 										@foreach ($states as $state)
 										<option value="{{ $state->id }}" {{$user->stateid == $state->id ? 'selected' : ''}}>{{ $state->name }}</option>
 										@endforeach
 									</select>
 								</div>
 								<div class="form-group">
 									<label for="city2">City*</label>
 									<input type="text" class="form-control" id="city2" placeholder="enter your address" name="city" value="{{$user->city}}" required="required">
 								</div>
 								<div class="form-group">
 									<label for="zipcode">Zip Code *</label>
 									<input type="text" class="form-control" id="zipcode" placeholder="" name="zipCode" value="{{$user->zipCode}}" required="required">
 								</div>
 								<div class="form-group">
 									<label for="email">E-mail Address*</label>
 									<input type="email" class="form-control" id="email" placeholder="" name="email" value="{{$user->email}}" required="required">
 								</div>
 								<div class="form-group">
 									<label for="phone1">Mobile Number *</label>
 									<input type="tel" class="form-control" id="phone1" placeholder="" name="primaryPhone" value="{{$user->primaryPhone}}" required="required">
 								</div>
 								<div class="form-group">
 									<label for="phone2">Height feet *</label>
 									<input type="tel" class="form-control" id="phone2" placeholder="" name="heightFeet" value="{{$user->heightFeet}}" required="required">
 								</div>
 								<div class="form-group">
 									<label for="phone3">Height Inches *</label>
 									<input type="tel" class="form-control" id="phone3" placeholder="" name="heightInches" value="{{$user->heightInches}}" required="required">
 								</div>
 								<div class="form-group">
 									<label for="phone4">weight *</label>
 									<input type="tel" class="form-control" id="phone4" placeholder="" name="weight" value="{{$user->weight}}" required="required">
 								</div>
 								<div class="form-group">
 									<label for="date2">Effective Date *</label>
 									<input type="date" class="form-control" id="date2" placeholder="" name="effectiveDate" value="{{$user->effectiveDate}}" required="required">
 								</div>
 								<div class="form-group">
 									<label for="date3">Allowed Dependents *</label>
 									<input type="number" class="form-control" id="date3" placeholder="" name="numAllowedDependents" value="{{$user->numAllowedDependents}}" required="required">
 								</div>
 								<div class="form-group">
 									<label for="date4">Disable Notifications *</label>
 									<input type="checkbox" id="date4" placeholder="" name="disableNotifications" {{ ($user->disableNotifications == 1) ? 'checked' : ''}} value="1" required="required">
 								</div>
 								<div class="form-group">
 									<label for="stateid">Timezones*</label>
 									<select class="form-control" name="timezoneId" required="required">
 										<option>Select Timezones</option>
 										@foreach ($timezones as $timezone)
 										<option value="{{ $timezone->id }}">{{ $timezone->name }}</option>
 										@endforeach
 									</select>
 								</div>
 							</div>
 							<div class="required-sec">
 								<div class="require-text"><p>* required field</p></div>
 								<div class="require-button">
 									<input type="submit" class="custom-button movetoStep general-info" name="submit" value="Next Step">
 									<!-- <a href="#" class="custom-button movetoStep" data-current="info-step-1" data-prev="info-step-2">Next Step</a> -->
 								</div>
 							</div>
 						</form>
 					</div>
 				</div>
 				<div class="information-cont infor-second" id="info-step-2" style="display: block;">
 					<div class="information-top">
 						<h2>2. Dependent information </h2>
 						<p>The following requested information in confidential
 						Please answer all of the following questions.</p>
 					</div>
 					<div class="information-bottom">
 						<form action="{{ route('store.dependentinfo') }}" id="dependent-info-form" method="post">
 							{{ csrf_field() }}
 							<div class="radio-sec">
 								<ul>
 									<li><strong>Gender :</strong></li>
 									<li><input type="radio" id="male1" name="gender" value="m" required="required">
 										<label >Male</label><br></li>
 										<li><input type="radio" id="female1" name="gender" value="f">
 											<label >Female</label><br></li>
 										</ul> 
 									</div>
 									<div class="form-group-outer">
 										<div class="form-group">
 											<label >First Name*</label>
 											<input type="text" class="form-control" id="first_name1" placeholder="enter your first name" name="firstname" required="required">
 										</div>
 										<div class="form-group">
 											<label for="last_name1">Last Name*</label>
 											<input type="text" class="form-control" id="last_name1" placeholder="enter your last name" name="lastname" required="required">
 										</div>
 										<div class="form-group">
 											<label for="last_name2">Password*</label>
 											<input type="password" class="form-control" id="last_name2" placeholder="" name="password" value="" required="required">
 										</div>
 										<div class="form-group">
 											<label for="date5">Date of Birth *</label>
 											<input type="date" class="form-control" id="date5" placeholder="" name="dob" required="required">
 										</div>
 										<div class="form-group">
 										</div>
 										<div class="form-group">
 											<label for="address">Address*</label>
 											<input type="text" class="form-control" id="address1" placeholder="enter your address" name="address" required="required">
 										</div>
 										<div class="form-group">
 											<label for="address">Address*</label>
 											<input type="text" class="form-control" id="address2" placeholder="enter your address" name="address2" required="required">
 										</div>
 										
 										<div class="form-group">
 											<label for="relationshipId">Dependent Relationships*</label>
 											<select class="form-control" name="relationshipId" required="required">
 												<option value="">Dependent Relationships</option>
 												<option value="1" >Spouse</option>
 												<option value="2" >Child</option>
 												<option value="3" >Other</option>
 											</select>
 										</div>
 										<div class="form-group">
 											<label for="stateid">State*</label>
 											<select class="form-control" name="stateid" required="required">
 												<option>Select State</option>
 												@foreach ($states as $state)
 												<option value="{{ $state->id }}">{{ $state->name }}</option>
 												@endforeach
 											</select>
 										</div>
 										<div class="form-group">
 											<label for="address3">City*</label>
 											<input type="text" class="form-control" id="address3" placeholder="enter your address" name="city" required="required">
 										</div>
 										<div class="form-group">
 											<label for="zipcode2">Zip Code *</label>
 											<input type="text" class="form-control" id="zipcode2" placeholder="" name="zipCode" required="required">
 										</div>
 										<div class="form-group">
 											<label for="email2">E-mail Address*</label>
 											<input type="email" class="form-control" id="email2" placeholder="" name="email" required="required">
 										</div>
 										<div class="form-group">
 											<label for="phone12">Mobile Number *</label>
 											<input type="tel" class="form-control" id="phone12" placeholder="" name="primaryPhone" required="required">
 										</div>
 										<div class="form-group">
 											<label for="phone13">Height feet *</label>
 											<input type="tel" class="form-control" id="phone13" placeholder="" name="heightFeet" required="required">
 										</div>
 										<div class="form-group">
 											<label for="phone14">Height Inches *</label>
 											<input type="tel" class="form-control" id="phone14" placeholder="" name="heightInches" required="required">
 										</div>
 										<div class="form-group">
 											<label for="phone15">weight *</label>
 											<input type="tel" class="form-control" id="phone15" placeholder="" name="weight" required="required">
 										</div>
 										<div class="form-group">
 											<label for="date6">Effective Date *</label>
 											<input type="date" class="form-control" id="date6" placeholder="" name="effectiveDate" required="required">
 										</div>
 										<div class="form-group">
 											<label for="date8">Disable Notifications *</label>
 											<input type="checkbox" id="date8" placeholder="" name="disableNotifications" value="1" required="required">
 										</div>
 										<div class="form-group">
 											<label for="timezoneId1">Timezones*</label>
 											<select class="form-control" name="timezoneId" required="required">
 												<option>Select Timezones</option>
 												@foreach ($timezones as $timezone)
 												<option value="{{ $timezone->id }}">{{ $timezone->name }}</option>
 												@endforeach
 											</select>
 										</div>
 									</div>
 									<div class="required-sec">
 										<div class="require-text"><p>* required field</p></div>
 										<div class="require-button">
 											<input type="submit" class="custom-button movetoStep dependent-info" name="submit" value="Next Step">
 											<!-- <a href="#" class="custom-button movetoStep" data-current="info-step-1" data-prev="info-step-2">Next Step</a> -->
 										</div>
 									</div>
 								</form>
 							</div>
 						</div>
 						@endif

 						<div class="information-cont infor-second" id="info-step-3" style="display: block;">
 							<div class="information-top">
 								<h2>3. Medical Condition</h2>
 								<p>The following requested information is confidential
 								and HIPAA protected.</p>
 								<p>Please answer all of the following questions.</p>
 							</div>
 							<div class="information-bottom">
 								<form action="{{ route('store.medicalcondition', $user->id) }}  id="medical-condition-form">
 									{{ csrf_field() }}
 									<div class="form-group">
 										<label for="date-cond-1">Medical Condition Name *</label>
 										<input type="text" class="form-control" id="date-cond-1" placeholder="" name="medicalConditionName" value="" required="required">
 									</div>
 									<div class="form-group">
 										<label for="date-cond-2">medical Condition Description *</label>
 										<input type="text" class="form-control" id="date-cond-2" placeholder="" name="medicalConditionDescription" value="" required="required">
 									</div>
 									<div class="form-group">
 										<label for="stateid">Medical Condition Status*</label>
 										<select class="form-control" name="medicalConditionStatus" required="required">
 											<option value="">Select status</option>
 											<option value="1">Currently Has</option>
 											<option value="2">Had in the past</option>
 										</select>
 									</div>
 									<div class="required-sec">
 										<div class="require-text"><p>* required field</p></div>
 										<div class="require-button">
 											<input type="submit" class="custom-button movetoStep medicalConditionSubmit" name="submit" value="Next Step">
 										</div>
 									</div>
 								</form>
 							</div>
 						</div>

 						<div class="information-cont infor-second" id="info-step-3" style="display: block;">
 							<div class="information-top">
 								<h2>4. Medication Details</h2>
 								<p>The following requested information is confidential
 								and HIPAA protected.</p>
 								<p>Please answer all of the following questions.</p>
 							</div>
 							<div class="information-bottom"> 
 								<form action="{{ route('store.medication', $user->id) }}" id="medication-form">
 									{{ csrf_field() }}
 									<div class="form-group">
 										<label for="medicationName-1">Medication Name *</label>
 										<input type="text" class="form-control" id="medicationName-1" placeholder="" name="medicationName" value="paracetamol" required="required">
 									</div>
 									<div class="form-group">
 										<label for="medicationName-2">medication Frequency *</label>
 										<input type="text" class="form-control" id="medicationName-2" placeholder="" name="medicationFrequency" value="high" required="required">
 									</div>
 									<div class="form-group">
 										<label for="medicationName-2">medication Comment *</label>
 										<input type="text" class="form-control" id="medicationName-3" placeholder="" name="medicationComment" value="for body ache" required="required">
 									</div>
 									<div class="form-group">
 										<label for="stateid">Medication Current Use*</label>
 										<select class="form-control" name="medicationCurrentUse" required="required">
 											<option value="">Select status</option>
 											<option value="true">True</option>
 											<option value="false">False</option>
 										</select>
 									</div>
 									<div class="form-group">
 										<label for="medicationForeignId">medication Foreign Id *</label>
 										<input type="text" class="form-control" id="medicationForeignId" placeholder="" name="medicationForeignId" value="294431.0" required="required">
 									</div>
 									<div class="form-group">
 										<label for="medicationSearch">medication NDC *</label>
 										<div id="searchFilter">
 											<input type="text" class="form-control" id="medicationSearch" placeholder="" name="medicationNDC" value="54629069300" required="required">
 										</div>
 									</div>
          <!-- <div class="form-group">
           <label for="medicationName-2">Search medication *</label>
           <input type="text" class="form-control" id="medicationSearch" placeholder="" name="medicationComment" value="" required="required">
       </div> -->
          <!-- <input type="hidden" name="medicationForeignId" id="medicationForeignId">
          	<input type="hidden" name="medicationNDC" id="medicationNDC"> -->
          	<div class="required-sec">
          		<div class="require-text"><p>* required field</p></div>
          		<div class="require-button">
          			<input type="submit" class="custom-button movetoStep medicationSubmit" name="submit" value="Next Step">
          		</div>
          	</div>
          </form>
      </div>
  </div>

  <div class="information-cont infor-second" id="info-step-3" style="display: block;">
  	<div class="information-top">
  		<h2>5. Medication Allergy Details</h2>
  		<p>The following requested information is confidential
  		and HIPAA protected.</p>
  		<p>Please answer all of the following questions.</p>
  	</div>
  	<div class="information-bottom">
  		<form action="{{ route('store.medication.allergy', $user->id) }}" id="medication-allergy-form">
  			{{ csrf_field() }}
  			<div class="form-group">
  				<label for="medicationName-1">medication Allergy Name *</label>
  				<input type="text" class="form-control" id="medicationAllergyName" name="medicationAllergyName" value="6703" required="required">
  			</div>
  			<div class="form-group">
  				<label for="medicationName-2">medication Allergy ForeignId *</label>
  				<input type="text" class="form-control" id="medicationAllergyForeignId" name="medicationAllergyForeignId" value="Aleve Sinus and Headache" required="required">
  			</div>
  			<div class="form-group">
  				<label for="medicationName-2">medication Allergy Dam Concept Id Type *</label>
  				<input type="text" class="form-control" id="medicationAllergyDamConceptIdType" name="medicationAllergyDamConceptIdType" value="2.0" required="required">
  			</div>

  			<div class="form-group">
  				<label for="medicationName-2">medication Allergy Dam Concept Id *</label>
  				<input type="text" class="form-control" id="medicationAllergyDamConceptId" name="medicationAllergyDamConceptId" value="56613.0" required="required">
  			</div>

          <!-- <div class="form-group">
           <label for="medicationName-2">Search medication *</label>
           <input type="text" class="form-control" id="medicationSearch" name="medicationComment" value="" required="required">
       </div> -->
          <!-- <input type="hidden" name="medicationForeignId" id="medicationForeignId">
          	<input type="hidden" name="medicationNDC" id="medicationNDC"> -->
          	<div class="required-sec">
          		<div class="require-text"><p>* required field</p></div>
          		<div class="require-button">
          			<input type="submit" class="custom-button movetoStep medicationAllergySubmit" name="submit" value="Next Step">
          		</div>
          	</div>
          </form>
      </div>
  </div>


  <div class="information-cont infor-second" id="info-step-3" style="display: block;">
  	<div class="information-top">
  		<h2>6. New Consultation</h2>
  	</div>
  	<div class="information-bottom">
  		<form action="{{ route('store.consultation') }}" id="consultation-form">
  			{{ csrf_field() }}
  			<div class="form-group">
  				<label for="stateid">State*</label>
  				<select class="form-control" name="stateid" required="required">
  					<option>Select State</option>
  					@foreach ($states as $state)
  					<option value="{{ $state->id }}" {{ $user->stateid == $state->id ? 'selected' : '' }}>{{ $state->name }}</option>
  					@endforeach
  				</select>
  			</div>
  			<div class="form-group">
  				<label for="medicationName-2">Modalities *</label>
  				<div class="custom-control custom-checkbox">
  					<input type="checkbox" class="custom-control-input" id="customCheck" name="modalities[]" value="phone">
  					<label class="custom-control-label" for="customCheck">Phone</label>
  				</div>
  				<div class="custom-control custom-checkbox">
  					<input type="checkbox" class="custom-control-input" id="customCheck-1" name="modalities[]" value="video">
  					<label class="custom-control-label" for="customCheck-1">Video</label>
  				</div>
  			</div>
  			<div class="form-group">
  				<label for="medicationName-2">phone Number (should be a valid number) *</label>
  				<input type="text" class="form-control" id="medicationAllergyDamConceptIdType" name="phoneNumber" value="" required="required">
  			</div>

  			<div class="form-group">
  				<label for="medicationName-2">video Consult Ready Text Number () *</label>
  				<input type="text" class="form-control" id="medicationAllergyDamConceptId" name="videoConsultReadyTextNumber" value="12345678" required="required">
  			</div>

  			<div class="form-group">
  				<label for="medicationName-21">sure Script Pharmacy id *</label>
  				<input type="text" class="form-control" id="medicationName-21" name="sureScriptPharmacy_id" value="29392" required="required">
  			</div>

  			<div class="form-group">
  				<label for="medicationName-211">Patient Description *</label>
  				<input type="text" class="form-control" id="medicationName-211" name="patientDescription" value="Suffering from weakness a nd fever" required="required">
  			</div>

  			<div class="form-group">
  				<label for="chiefComplaint">Chief Complaint *</label>
  				<select id="chiefComplaint" name="translate">
  					<option value="en">English</option>
  					<option value="es">Spanish</option>
  				</select>
  			</div>

  			<div class="form-group">
  				<label for="whenScheduled">whenScheduled *</label>
  				<input type="date" class="form-control" id="whenScheduled" placeholder="" name="whenScheduled">
  			</div>

  			<div class="form-group">
  				<label for="stateid">Timezones*</label>
  				<select class="form-control" name="timezoneOffset" required="required">
  					<option>Select Timezones</option>
  					@foreach ($timezones as $timezone)
  					<option value="{{ $timezone->id }}">{{ $timezone->name }}</option>
  					@endforeach
  				</select>
  			</div>

  			<div class="form-group">
  				<label for="chiefComplaint">Roi *</label>
  				<select id="chiefComplaint" name="roi">
  					<option value="">Please Select Roi</option>
  					<option value="PCP">PCP</option>
  					<option value="Urgent Care">Urgent Care</option>
  					<option value="Emergency Room">Emergency Room</option>
  					<option value="Nothing">Nothing</option>
  				</select>
  			</div>
  			@if(@$healthRecords['problems']['chiefComplaints'])
  			<div class="form-group">
  				<label for="chiefComplaint">chief Complaint *</label>
  				<select id="chiefComplaint" name="problems[chiefComplaint]">
  					@foreach($healthRecords['problems']['chiefComplaints'] as $complaints)
  					<option value="{{ $complaints['problem_id'] }}">{{ $complaints['name'] }}</option>
  					@endforeach
  				</select>
  			</div>
  			@endif

  			@if(isset($healthRecords['problems']['uncommonProblems'])  && isset($healthRecords['problems']['commonProblems']))

  			@php
  			$otherProblems = array_merge(
  			@$healthRecords['problems']['uncommonProblems'],
  			@$healthRecords['problems']['commonProblems']
  			)
  			@endphp
  			<div class="form-group">
  				<label for="otherProblems">Other Problems *</label>
  				@foreach($otherProblems as $complaint)
  				<div class="custom-control custom-checkbox">
  					<input type="checkbox" class="custom-control-input" id="problem-{{ $complaint['problem_id'] }}" name="problems[otherProblems][]" value="{{ $complaint['problem_id'] }}">
  					<label class="custom-control-label" for="problem-{{ $complaint['problem_id'] }}">{{ $complaint['name'] }}</label>
  				</div>
  				@endforeach
  			</div>
  			@endif
  			<div class="custom-control custom-checkbox">
  				<input type="checkbox" class="custom-control-input" id="acceptInformedConsent-1" name="problems[acceptInformedConsent]" value="1">
  				<label class="custom-control-label" for="acceptInformedConsent-1">Accept Consent</label>
  			</div>

          <!-- <div class="form-group">
           <label for="medicationName-2">Search medication *</label>
           <input type="text" class="form-control" id="medicationSearch" name="medicationComment" value="" required="required">
       </div> -->
          <!-- <input type="hidden" name="medicationForeignId" id="medicationForeignId">
          	<input type="hidden" name="medicationNDC" id="medicationNDC"> -->
          	<div class="required-sec">
          		<div class="require-text"><p>* required field</p></div>
          		<div class="require-button">
          			<input type="submit" class="custom-button movetoStep consultationSubmit" name="submit" value="Next Step">
          		</div>
          	</div>
          </form>
      </div>
  </div>

  <div class="information-cont infor-second" id="info-step-3" style="display: none;">
  	<div class="information-top">
  		<h2>3. Medical Information</h2>
  		<p>The following requested information is confidential
  		and HIPAA protected.</p>
  		<p>Please answer all of the following questions.</p>
  	</div>
  	<div class="information-bottom">
  		<form action="{{ route('store.medicalcondition', $user->id) }}">
  			<div class="consul-infor">
  				<div class="consul-seek">
  					<div class="consul-top">
  						<p>What is your main reason for seeking counseling?</p>
  						<div class="form-group">
  							<textarea class="form-control" rows="5" id="comment">enter reason here</textarea>
  						</div> 
  						<div class="consul-bottom">
  							<p>Please rate your current distress regarding this
  							concern. Rating scale 1 (low) to 5 (high) ?</p>
  							<div class="radio-sec">
  								<ul>
  									<li><input type="radio" id="male2" name="gender" value="male">
  										<label for="01">1</label><br></li>
  										<li><input type="radio" id="female2" name="gender" value="female">
  											<label for="02">2</label><br></li>
  											<li><input type="radio" id="male3" name="gender" value="male">
  												<label for="03">3</label><br></li>
  												<li><input type="radio" id="female3" name="gender" value="female">
  													<label for="04">4</label><br></li>
  													<li><input type="radio" id="male4" name="gender" value="male">
  														<label for="05">5</label><br></li>
  													</ul> 
  												</div>
  											</div>
  										</div>
  									</div>
  								</div>
  								<div class="medical-history">
  									<div class="medical-history-top">
  										<h3>Medical History</h3>
  										<p>Check all that apply</p>
  									</div>
  									<div class="medical-history-bottom">
  										<div class="medical-history-cont">
  											<div class="custom-control custom-checkbox">
  												<input type="checkbox" class="custom-control-input" id="customCheck" name="example1">
  												<label class="custom-control-label" for="customCheck">No Medical problems</label>
  											</div>
  											<div class="custom-control custom-checkbox">
  												<input type="checkbox" class="custom-control-input" id="customCheck-1" name="example1">
  												<label class="custom-control-label" for="customCheck-1">Allergic Rhinitis</label>
  											</div>
  											<div class="custom-control custom-checkbox">
  												<input type="checkbox" class="custom-control-input" id="customCheck-2" name="example1">
  												<label class="custom-control-label" for="customCheck-2">Allergies / Hay Fever</label>
  											</div>
  											<div class="custom-control custom-checkbox">
  												<input type="checkbox" class="custom-control-input" id="customCheck-3" name="example1">
  												<label class="custom-control-label" for="customCheck-3">Asthma</label>
  											</div>
  											<div class="custom-control custom-checkbox">
  												<input type="checkbox" class="custom-control-input" id="customCheck-4" name="example1">
  												<label class="custom-control-label" for="customCheck-4">Back Problems</label>
  											</div>
  											<div class="custom-control custom-checkbox">
  												<input type="checkbox" class="custom-control-input" id="customCheck-5" name="example1">
  												<label class="custom-control-label" for="customCheck-5">Bleeding Disorder</label>
  											</div>
  											<div class="custom-control custom-checkbox">
  												<input type="checkbox" class="custom-control-input" id="customCheck-6" name="example1">
  												<label class="custom-control-label" for="customCheck-6">Blood Transfusion</label>
  											</div>
  											<div class="custom-control custom-checkbox">
  												<input type="checkbox" class="custom-control-input" id="customCheck-7" name="example1">
  												<label class="custom-control-label" for="customCheck-7">Chron’s Disease</label>
  											</div>
  											<div class="custom-control custom-checkbox">
  												<input type="checkbox" class="custom-control-input" id="customCheck-8" name="example1">
  												<label class="custom-control-label" for="customCheck-8">Concussion</label>
  											</div>
  										</div>
  										<div class="medical-history-cont">
  											<div class="custom-control custom-checkbox">
  												<input type="checkbox" class="custom-control-input" id="diabetes" name="example1">
  												<label class="custom-control-label" for="diabetes">Diabetes, Type 1</label>
  											</div>
  											<div class="custom-control custom-checkbox">
  												<input type="checkbox" class="custom-control-input" id="diabetes-2" name="example1">
  												<label class="custom-control-label" for="diabetes-2">Diabetes, Type 2</label>
  											</div>
  											<div class="custom-control custom-checkbox">
  												<input type="checkbox" class="custom-control-input" id="ear" name="example1">
  												<label class="custom-control-label" for="ear">Ear, Nose , Throat Problems</label>
  											</div>
  											<div class="custom-control custom-checkbox">
  												<input type="checkbox" class="custom-control-input" id="trouble" name="example1">
  												<label class="custom-control-label" for="trouble">Eye Trouble</label>
  											</div>
  											<div class="custom-control custom-checkbox">
  												<input type="checkbox" class="custom-control-input" id="gastrointestinal" name="example1">
  												<label class="custom-control-label" for="gastrointestinal">Gastrointestinal problems</label>
  											</div>
  											<div class="custom-control custom-checkbox">
  												<input type="checkbox" class="custom-control-input" id="genetic" name="example1">
  												<label class="custom-control-label" for="genetic">Genetic Disorder</label>
  											</div>
  											<div class="custom-control custom-checkbox">
  												<input type="checkbox" class="custom-control-input" id="hearing" name="example1">
  												<label class="custom-control-label" for="hearing">Hearing problem</label>
  											</div>
  											<div class="custom-control custom-checkbox">
  												<input type="checkbox" class="custom-control-input" id="heart-disease" name="example1">
  												<label class="custom-control-label" for="heart-disease">Heart Disease</label>
  											</div>
  											<div class="custom-control custom-checkbox">
  												<input type="checkbox" class="custom-control-input" id="heart-problems" name="example1">
  												<label class="custom-control-label" for="heart-problems">Heart Problems</label>
  											</div>
  										</div>
  										<div class="medical-history-cont">
  											<div class="custom-control custom-checkbox">
  												<input type="checkbox" class="custom-control-input" id="high-blood-pressure" name="example1">
  												<label class="custom-control-label" for="high-blood-pressure">High Blood Pressure</label>
  											</div>
  											<div class="custom-control custom-checkbox">
  												<input type="checkbox" class="custom-control-input" id="high-choleserol" name="example1">
  												<label class="custom-control-label" for="high-choleserol">High Choleserol</label>
  											</div>
  											<div class="custom-control custom-checkbox">
  												<input type="checkbox" class="custom-control-input" id="liver" name="example1">
  												<label class="custom-control-label" for="liver">Liver or Kidney Problems</label>
  											</div>
  											<div class="custom-control custom-checkbox">
  												<input type="checkbox" class="custom-control-input" id="rheumatic" name="example1">
  												<label class="custom-control-label" for="rheumatic">Rheumatic Fever</label>
  											</div>
  											<div class="custom-control custom-checkbox">
  												<input type="checkbox" class="custom-control-input" id="seizure" name="example1">
  												<label class="custom-control-label" for="seizure">Seizure Disorder</label>
  											</div>
  											<div class="custom-control custom-checkbox">
  												<input type="checkbox" class="custom-control-input" id="transmitted" name="example1">
  												<label class="custom-control-label" for="transmitted">Sexually Transmitted Disease</label>
  											</div>
  											<div class="custom-control custom-checkbox">
  												<input type="checkbox" class="custom-control-input" id="stomach" name="example1">
  												<label class="custom-control-label" for="stomach">Stomach or Intestinal Problems</label>
  											</div>
  											<div class="custom-control custom-checkbox">
  												<input type="checkbox" class="custom-control-input" id="thyroid" name="example1">
  												<label class="custom-control-label" for="thyroid">Thyroid problems</label>
  											</div>
  											<div class="custom-control custom-checkbox">
  												<input type="checkbox" class="custom-control-input" id="uberculosis" name="example1">
  												<label class="custom-control-label" for="uberculosis">uberculosis</label>
  											</div>
  										</div>
  										<div class="medical-history-cont">
  											<div class="custom-control custom-checkbox">
  												<input type="checkbox" class="custom-control-input" id="tumor" name="example1">
  												<label class="custom-control-label" for="tumor">Tumor or Cancer</label>
  											</div>
  											<div class="custom-control custom-checkbox">
  												<input type="checkbox" class="custom-control-input" id="ulcerative" name="example1">
  												<label class="custom-control-label" for="ulcerative">Ulcerative Colitis</label>
  											</div>
  											<div class="custom-control custom-checkbox">
  												<input type="checkbox" class="custom-control-input" id="weakness" name="example1">
  												<label class="custom-control-label" for="weakness">Weakness or Paralysis</label>
  											</div>
  											<div class="custom-control custom-checkbox">
  												<input type="checkbox" class="custom-control-input" id="other-medical" name="example1">
  												<label class="custom-control-label" for="other-medical">Other Medical Concerns not listed</label>
  											</div>
  										</div>

  									</div>
  								</div>
  								<div class="mental-health-outer">
  									<div class="mental-health-left">
  										<div class="mental-health">
  											<h3>Mental Health</h3>
  											<p><input type="radio" id="Mental" name="No Mental problems" value="No Mental problems">
  												<label for="No Mental problems">No Mental problems</label></p>
  												<p><input type="radio" id="Anxiety" name="Anxiety" value="Anxiety">
  													<label for="Anxiety">Anxiety</label></p>
  													<p><input type="radio" id="Depression" name="Depression" value="Depression">
  														<label for="Depression">Depression</label></p>
  														<p><input type="radio" id="disorder" name="Eating disorder" value="Eating disorder">
  															<label for="Eating disorder">Eating disorder</label></p>
  															<p><input type="radio" id="Health" name="Other Mental Health Concerns not listed" value="Other Mental Health Concerns not listed">
  																<label for="Other Mental Health Concerns not listed">Other Mental Health Concerns not listed</label></p>
  															</div>
  															<div class="phyiscal-asses">
  																<h3>Physical Assessment</h3>
  																<p style="font-weight: 600; font-size: 16px; padding-bottom: 20px;">Date if last Physical Exam</p>
  																<div class="form-group">
  																	<input type="date" class="form-control" id="date9" placeholder="" name="date">
  																</div>
  																<p>
  																	<input type="radio" id="Injuries" name="Injuries not completely healed" value="Injuries not completely healed">
  																	<label for="Injuries not completely healed">Injuries not completely healed</label>
  																</p>
  																<p><input type="radio" id="Major " name="Major Injury" value="Major Injury">
  																	<label for="Major Injury">Major Injury</label>
  																</p>
  																<p>
  																	<input type="radio" id="Medical-Condition" name="Medical Condition" value="Medical Condition">
  																	<label for="Medical Condition">Medical Condition requiring care</label>
  																</p>
  																<p>
  																	<input type="radio" id="Surgical" name="Surgical procedure advised, but not performed" value="Surgical procedure advised, but not performed">
  																	<label for="Yes">Surgical procedure advised, but not performed</label>
  																</p>
  															</div>
  															<div class="phyiscal-asses">
  																<h3>Social History</h3>
  															</div>
  															<p><input type="radio" id="Alcohol" name="Alcohol use" value="Alcohol use">
  																<label for="Alcohol use">Alcohol use</label>
  															</p>
  															<p><input type="radio" id="Drug" name="Drug use" value="Drug use">
  																<label for="Drug use">Drug use</label>
  															</p>
  															<p><input type="radio" id="Eating" name="Eating concerns" value="Eating concerns">
  																<label for="Eating concerns">Eating concerns</label>
  															</p>
  															<p><input type="radio" id="Exercise" name="Exercise" value="Exercise">
  																<label for="Exercise">Exercise</label>
  															</p>
  															<p><input type="radio" id="active" name="Sexually active" value="Sexually active">
  																<label for="Sexually active">Sexually active</label>
  															</p>
  															<p><input type="radio" id="Tobacco" name="Tobacco usage" value="Tobacco usage">
  																<label for="Tobacco usage">Tobacco usage</label>
  															</p>
  															<p><input type="radio" id="Weight" name="Weight concerns" value="Weight concerns">
  																<label for="Weight concerns">Weight concerns</label>
  															</p>
  															<p><input type="radio" id="History" name="Other Social History concerns not listed" value="Other Social History concerns not listed">
  																<label for="Other Social History concerns not listed">Other Social History concerns not listed</label>
  															</p>

  														</div>
  														<div class="mental-health-left">
  															<div class="mental-health">
  																<h3>Women’s Health</h3>
  																<p><input type="radio" id="health-problems" name="No women’s health problems" value="No women’s health problems">
  																	<label for="No women’s health problems">No women’s health problems</label>
  																</p>
  																<p><input type="radio" id="Abnormal" name="Abnormal Pap" value="Abnormal Pap">
  																	<label for="Abnormal Pap">Abnormal Pap</label>
  																</p>
  																<p><input type="radio" id="Contraception" name="Contraception History" value="Contraception History">
  																	<label for="Contraception History">Contraception History</label>
  																</p>
  																<p><input type="radio" id="Currently" name="Currently Pregnant" value="Currently Pregnant">
  																	<label for="Currently Pregnant">Currently Pregnant</label>
  																</p>
  																<p><input type="radio" id="Menstrual" name="Menstrual Irregularity" value="Menstrual Irregularity">
  																	<label for="Yes">Menstrual Irregularity</label>
  																</p>
  																<p><input type="radio" id="Pregnancy" name="Pregnancy History" value="Pregnancy History">
  																	<label for="Pregnancy History">Pregnancy History</label>
  																</p>
  																<p><input type="radio" id="Other-Women’s-Health" name="Other Women’s Health Concerns not listed" value="Other Women’s Health Concerns not listed">
  																	<label for="Other Women’s Health Concerns not listed">Other Women’s Health Concerns not listed</label>
  																</p>
  															</div>
  															<div class="phyiscal-asses">
  																<h3>Family History (FH)</h3>
  															</div>
  															<p><input type="radio" id="Family-medical" name="Family medical history unknown" value="Family medical history unknown">
  																<label for="Family medical history unknown">Family medical history unknown</label>
  															</p>
  															<p><input type="radio" id="Alcohol/Drug" name="Alcohol/Drug Issues" value="Alcohol/Drug Issues">
  																<label for="Alcohol/Drug Issues">Alcohol/Drug Issues</label>
  															</p>
  															<p><input type="radio" id="Cancer" name="Cancer" value="Cancer">
  																<label for="Cancer">Cancer</label>
  															</p>
  															<p><input type="radio" id="Death" name="Death Before Age 50" value="Death Before Age 50">
  																<label for="Death Before Age 50">Death Before Age 50</label>
  															</p>
  															<p><input type="radio" id="Diabetes" name="FH Diabetes, Type 1" value="FH Diabetes, Type 1">
  																<label for="FH Diabetes, Type 1">FH Diabetes, Type 1</label>
  															</p>
  															<p><input type="radio" id="FH" name="FH Diabetes, Type 2" value="FH Diabetes, Type 2">
  																<label for="FH Diabetes, Type 2">FH Diabetes, Type 2</label>
  															</p>
  															<p><input type="radio" id="Blood" name="FH High Blood Pressure" value="FH High Blood Pressure">
  																<label for="FH High Blood Pressure">FH High Blood Pressure</label>
  															</p>
  															<p><input type="radio" id="Cholesterol" name="FH High Cholesterol" value="FH High Cholesterol">
  																<label for="FH High Cholesterol">FH High Cholesterol</label>
  															</p>
  															<p><input type="radio" id="Thyroid-Problems" name="FH Thyroid Problems" value="FH Thyroid Problems">
  																<label for="FH Thyroid Problems">FH Thyroid Problems</label>
  															</p>
  															<p><input type="radio" id="Tuberculosis" name="FH Tuberculosis" value="FH Tuberculosis">
  																<label for="FH Tuberculosis">FH Tuberculosis</label>
  															</p>
  															<p><input type="radio" id="Disease/Stroke" name="Heart Disease/Stroke" value="Heart Disease/Stroke">
  																<label for="Heart Disease/Stroke">Heart Disease/Stroke</label>
  															</p>
  															<p><input type="radio" id="Kidney" name="Kidney Disease" value="Kidney Disease">
  																<label for="Kidney Disease">Kidney Disease</label>
  															</p>
  															<p><input type="radio" id="Psychological" name="Psychological Disorder" value="Psychological Disorder">
  																<label for="Psychological Disorder">Psychological Disorder</label>
  															</p>
  															<p><input type="radio" id="Rheumatoid" name="Rheumatoid Arthritis" value="Rheumatoid Arthritis">
  																<label for="Rheumatoid Arthritis">Rheumatoid Arthritis</label>
  															</p>
  															<p><input type="radio" id="Seizures" name="Seizures/Epilepsy" value="Seizures/Epilepsy">
  																<label for="Seizures/Epilepsy">Seizures/Epilepsy</label>
  															</p>
  															<p><input type="radio" id="Family-History" name="Other Family History concerns not listed" value="Other Family History concerns not listed">
  																<label for="Other Family History concerns not listed">Other Family History concerns not listed</label>
  															</p>

  														</div>
  														<div class="mental-health-left">
  															<div class="mental-health">
  																<p style="font-weight: 600; padding-bottom: 10px;">Add additional family history comments here,<br>if needed
  																</p>
  																<div class="form-group">
  																	<textarea class="form-control" rows="5" id="comment2">Enter Comments Here</textarea>
  																</div>
  																<p style="font-weight: 600; padding-bottom: 10px;">Add additional family history comments here,<br>if needed
  																</p>
  																<div class="form-group">
  																	<textarea class="form-control" rows="5" id="comment3">Enter Comments Here</textarea>
  																</div>
  																<p style="font-weight: 600; padding-bottom: 10px;">Hospitalization / Surgery / Procedures
  																</p>
  																<p><input type="radio" id="Hospitalization" name="No Hospitalization / Surgery / Procedures" value="No Hospitalization / Surgery / Procedures">
  																	<label for="No Hospitalization / Surgery / Procedures">No Hospitalization / Surgery / Procedures</label>
  																</p>
  																<p><input type="radio" id="Yes1" name="Yes" value="Yes">
  																	<label for="Yes">Yes</label>
  																</p>
  																<div class="form-group">
  																	<textarea class="form-control" rows="5" id="comment4">Description</textarea>
  																</div>
  																<p style="padding-bottom:10px;">Approximate Date
  																</p>
  																<div class="form-group">
  																	<label for="from">From</label>
  																	<input type="date" class="form-control" id="date10" placeholder="" name="date">
  																</div>
  																<div class="form-group">
  																	<label for="to">To</label>
  																	<input type="date" class="form-control" id="date11" placeholder="" name="date">
  																</div>
  																<p style="font-weight: 600; padding-bottom:20px;">Medications
  																</p>
  																<p><input type="radio" id="Medications" name="No Medications" value="No Medications">
  																	<label for="No Medications">No Medications</label>
  																</p>
  																<p><input type="radio" id="Yes2" name="Yes" value="Yes">
  																	<label for="Yes">Yes</label>
  																</p>
  																<div class="form-group">
  																	<textarea class="form-control" rows="5" id="comment5">Description</textarea>
  																</div>
  																<p style="font-weight: 600; padding-bottom: 10px;">Allergies
  																</p>
  																<p><input type="radio" id="No-Allergies" name="No Allergies" value="No Allergies">
  																	<label for="No Allergies">No Allergies</label></p>
  																	<p><input type="radio" id="Yes3" name="Yes" value="Yes">
  																		<label for="Yes">Yes</label></p>
  																		<p style="padding-bottom: 20px;">Name of Substance type of reaction
  																		</p>
  																		<div class="form-group">
  																			<textarea class="form-control" rows="5" id="comment6">Description</textarea>
  																		</div>
  																		<div class="form-group">
  																			<label for="to">Date of Onset</label>
  																			<input type="date" class="form-control" id="date12" placeholder="" name="date">
  																		</div>


  																	</div>
  																</div>
  															</div>
  															<div class="required-sec" style="border: none;">
  																<div class="require-text"></div>
  																<div class="require-button">
  																	<a href="#" class="custom-button">Send Answers</a>
  																</div>
  															</div>
  														</div>

  													</form>
  												</div>
  											</div>

  										</div>
  									</section>


  									@endsection

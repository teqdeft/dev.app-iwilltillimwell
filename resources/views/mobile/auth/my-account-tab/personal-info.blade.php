<div id="personal-info" class="tab-content active">
<div class="midical-form v1 detail">

                            <div class="edit-det-row">
                                <div class="form-title detail">
                                    <p>Personal Info</p>
                                </div>
                            </div>

                            <div class="edit-tab-content">
                                <p>Have you moved recently? Changed your telephone number? This is where you can update
                                    your personal information. Be sure to review and confirm that all changes are
                                    accurate before hitting "Save".</p>
                            </div>

@php
    $formAction = auth()->user()->user_role === 'user'
        ? route('update-account')
        : route('group-organizations-update-profile');
@endphp

							
							
                            <form class="row" id="personal-info-form"
                            action="{{ $formAction }}" method="post">
                            @csrf
                            <div class="form">
                                <div class="form-row">

                                    <div class="col-50 form-group">
                                        <label>Fist Name <span class="required-ico">*</span></label>
                                        <input class="form-control" type="text" name="fname" id="fname"  placeholder="Your Fist Name" value="{{ $user->fname}}">
                                    </div>

                                    <div class="col-50 form-group">
                                        <label>Last Name <span class="required-ico">*</span></label>
                                        <input class="form-control" type="text" name="lname" id="lname"
                                            placeholder="Your Last Name"  value="{{ $user->lname}}">
                                    </div>

                                    
                                    <div class="col-50 form-group">
                                        <label>Date of Birth</label>
                                        <input class="form-control datepicker-ico" type="text" name="dob"  id="dob" value="<?php echo getDOBFormat($user['dob']??'')?>" readonly>
                                    </div>

                                    <div class="col-50 form-group">
                                        <label>Gender <span class="required-ico">*</span></label>
                                        <select name="gender" id="gender">
                                            <option value="">Select</option>
                                            <option value="m"  {{ ($user->gender=="m") ? "selected" : ""}}>Male</option>
                                            <option value="f"  {{ ($user->gender=="f") ? "selected" : ""}}>Female</option>
                                            <option value="o"  {{ ($user->gender=="o") ? "selected" : ""}}>Other</option>
                                        </select>
                                    </div>

                                    <div class="col-50 form-group">
                                        <label>Primary Phone</label>
                                        <input class="form-control" type="number" name="primaryPhone"
                                            placeholder="Your Primary Phone" value="{{ $user->primaryPhone }}" readonly>
                                    </div>

                                    <div class="col-50 form-group">
                                        <label>Secondary Phone</label>
                                        <input class="form-control" type="number" name="secondaryPhone"
                                            placeholder="Your Secondary Phone" value="{{ $user->secondaryPhone }}" onkeyup="lengthValidation(this,'10')">
                                    </div>

                                    <div class="col-100 form-group">
                                        <label>Email</label>
                                        <input class="form-control" type="email" value="{{ $user->email }}" readonly>
                                    </div>

                                    <div class="col-100 form-group">
                                        <label>Address</label>
                                        <input class="form-control" type="text" name="address"
                                            placeholder="Your Address" value="{{ $user->address }}">
                                    </div>

                                    <div class="col-100 form-group">
                                        <label>Address Line 2</label>
                                        <input class="form-control" type="text" name="address2"
                                            placeholder="Address Line 2" value="{{ $user->address2 }}">
                                    </div>

                                    <div class="col-50 form-group">
                                        <label>City</label>
                                        <input class="form-control" type="text" name="city" placeholder="Your City" value="{{ $user->city }}">
                                    </div>

                                   

                                    <div class="col-50 form-group">
                                        <label>Zip Code</label>
                                        <input class="form-control" type="text" name="zipCode"
                                            placeholder="Your Zip Code" value="{{ $user->zipCode }}" onkeyup="lengthValidation(this,'6')">
                                    </div>
                                    <div class="col-100 form-group">
                                        <label>State <span class="required-ico">*</span></label>
                                        <select class="form-control theme-select" name="stateid" id="stateid">
                                            <option value="">Please select state</option>

                                            @foreach ($states as $state)
                                                                <option value="{{ $state->id }}"
                                                                    {{ ($state->id == $user->stateid) ? 'selected' : '' }}>
                                                                    {{ $state->name }}</option>
                                                                @endforeach
                                        </select>                        
                                    </div>
                                    
                                    <div class="col-100 form-group">
                                        <label>Time Zone <span class="required-ico">*</span></label>
                                        <select class="form-control theme-select" name="timezoneId"  id="timezoneId">
                                        <option value=""> -- SELECT TIMEZONE -- </option>
                                                                @foreach ($timezones as $timezone)
                                                                <option value="{{ $timezone->id }}"
                                                                    {{ ($timezone->id == $user->timezoneId) ? 'selected' : '' }}>
                                                                    {{ $timezone->name }}</option>
                                                                @endforeach
                                        </select>                        
                                    </div>
									
                                    <div class="col-100 form-group input-with-img">
                                        <label>Upload Profile Image<span class="required-ico">*</span></label>
                                        <input type="file" class="form-control upload_img-v1" name="profile_image"
                                                                placeholder="Profile">  
									
										@if(!empty($user->profile_image) && file_exists(public_path('profiles/' . $user->profile_image)))
										<div class="img-close-icon">
											<div class="img-box">
												<img src="{{ asset('profiles/' . $user->profile_image) }}" width="100" alt="Profile Image">
											</div>	
											<a class="deleteByAjax" data-url="{{ route('profile-img-deleted')}}" number="{{$user->id}}">X</a>
										</div>	
										@endif
                                    </div>

                                    <div class="col-100 cta">
                                        <button type="submit" class="primary-button" onclick="return profileValidation()">Save</button>
                                    </div>

                                </div>
                            </div>
                            </form>
                        </div>
</div> 
  @push('scripts')
<link rel="stylesheet" href="https://code.jquery.com/ui/1.14.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="https://code.jquery.com/ui/1.14.1/jquery-ui.js"></script>
<script>
let today = new Date();
let eighteenYearsAgo = new Date();
eighteenYearsAgo.setFullYear(today.getFullYear() - <?php echo config('constants.age_limit') ?>); 
    
  $( function() {
    
    $( "#dob" ).datepicker({
        changeYear: true,
        yearRange: "-90:",
        dateFormat: "mm/dd/yy",
        maxDate: eighteenYearsAgo
    });
  } );

function profileValidation() {
}  
</script>    
@endpush         
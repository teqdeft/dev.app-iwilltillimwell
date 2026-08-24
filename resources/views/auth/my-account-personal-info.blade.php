<div id="personal-info" class=" tab-pane active">
                                <br>
                                <h3>Personal Info</h3>
                                <p>Have you moved recently? Changed your telephone number? This is where you can update
                                    your personal information. Be sure to review and confirm that all changes are
                                    accurate before hitting "Save".</p>
                                <div class="row personal-info-value-box">
                                    <div class="col-md-12 grid-margin stretch-card">
                                        <div class="card theme-border-0">
                                            <div class="card-body px-0 ">
@php
    $formAction = auth()->user()->user_role === 'user'
        ? route('update-account')
        : route('group-organizations-update-profile');
@endphp
                                            
	<form class="row" id="personal-info-form" action="{{ $formAction }}" method="post" enctype="multipart/form-data">
 
	
	
                                                    @csrf
                                                    <div class="col-xl-4">
                                                        <div class="form-group inner-details-box">
                                                            <label for="exampleInputWeight">First Name </label>
                                                             <input type="text" class="form-control"
                                                                id="exampleInputWeight" name="fname"
                                                                placeholder="First Name"
                                                                value="{{ ucfirst($user->fname)}}">
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-4">
                                                        <div class="form-group inner-details-box">
                                                            <label for="exampleInputWeight">Last Name</label>
                                                          <input type="text" class="form-control"
                                                                id="exampleInputWeight" name="lname"
                                                                placeholder="Last Name"
                                                                value="{{ ucfirst($user->lname)}}">
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-4">
                                                        <div class="form-group inner-details-box ">
                                                            <label for="exampleInputWeight">Date of Birth </label>
                                                           <input type="text" class="form-control" id="date_of_birth_calendar" name="dob" value="<?php echo getDOBFormat($user['dob']??'')?>">
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="col-sm-4">
                                                        <div class="form-group main-phone-box viewing_records_phone_box">
                                                            <label for="exampleInputWeight">Primary Phone <span
                                                                    class="fs-12 d-none">( 011 is a required prefix when
                                                                    dialing from the U.S. Do not add that into this
                                                                    field, it is automatic.)</span> </label>
                                                            
                                                                <input type="tel" class="form-control" id="phone"
                                                                    name="primaryPhone" placeholder="Phone"
                                                                    value="{{ $user->primaryPhone }}"
																	onkeyup="validLength(this,'10')"
																	readonly
																	>
                                                                
                                                                <!-- 
																
																<i class="fas fa-phone-alt" aria-hidden="true"></i>
																<a href="#0" class="fs-12 w-100 theme-link-txt1 click-here1 click-here">Click here to add an International Phone Number</a> -->
                                                                <a href="#0"
                                                                    class="fs-12   theme-link-txt1 click-here2 d-none click-here">Click
                                                                    here to add a U.S. Phone Number</a>
                                                            
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <div class="form-group">
                                                            <label for="exampleInputWeight">Secondary Phone</label>
                                                            <input type="tel" class="form-control"
                                                                id="exampleInputWeight" name="secondaryPhone"
                                                                placeholder="Secondary Phone"
                                                                value="{{ $user->secondaryPhone }}"
																onkeyup="validLength(this,'10')"
																>
                                                        </div>
                                                    </div>
													<div class="col-xl-4">
                                                        <div class="form-group inner-details-box">
                                                            <label for="exampleInputWeight">Gender</label>
                                                            <div class="d-flex">
                                                                <div class="form-check mr-4">
                                                                    <label class="form-check-label">
                                                                        <input type="radio" class="form-check-input"
                                                                            name="gender" id="optionsRadios1" value="m"
                                                                            {{ ($user->gender=="m") ? "checked" : ""}}>
                                                                        Male
                                                                        <i class="input-helper"></i></label>
                                                                </div>
                                                                <div class="form-check">
                                                                    <label class="form-check-label">
                                                                        <input type="radio" class="form-check-input "
                                                                            name="gender" id="optionsRadios1" value="f"
                                                                            {{ ($user->gender=="f") ? "checked" : ""}}>
                                                                        Female
                                                                        <i class="input-helper"></i></label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <div class="form-group">
                                                            <label for="exampleInputWeight">Email</label>
                                                            <input type="email" class="form-control"
                                                                id="exampleInputWeight" name="email" placeholder="Email"
                                                                value="{{ $user->email }}" readonly />
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <div class="form-group">
                                                            <label for="exampleInputWeight">Address</label>
                                                            <input type="text" class="form-control"
                                                                id="exampleInputWeight" name="address"
                                                                placeholder="Address" value="{{ $user->address }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <div class="form-group">
                                                            <label for="exampleInputWeight">Address Line 2</label>
                                                            <input type="text" class="form-control"
                                                                id="exampleInputWeight" name="address2"
                                                                placeholder="Address" value="{{ $user->address2 }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <div class="form-group">
                                                            <label>City</label>
                                                            <input type="text" class="form-control" placeholder="City"
                                                                name="city" value="{{ $user->city }}" />
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <div class="form-group">
                                                            <label for="">State</label>
                                                            <select class="form-control theme-select" name="stateid">
                                                                <option value="">Please select state</option>
                                                                @foreach ($states as $state)
                                                                <option value="{{ $state->id }}"
                                                                    {{ ($state->id == $user->stateid) ? 'selected' : '' }}>
                                                                    {{ $state->name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <div class="form-group">
                                                            <label>Zip Code</label>
                                                            <input type="text" class="form-control" name="zipCode"
                                                                placeholder="Zip Code" value="{{ $user->zipCode }}"
																onkeyup="validLength(this,'6')"
																>
                                                        </div>
                                                    </div>
													
                                                    <div class="col-sm-4">
                                                        <div class="form-group">
                                                            <label>Time Zone</label>
                                                            <select class="form-control theme-select" name="timezoneId">
                                                                <option value=""> -- Select Time Zone -- </option>
                                                                @foreach ($timezones as $timezone)
                                                                <option value="{{ $timezone->id }}"
                                                                    {{ ($timezone->id == $user->timezoneId) ? 'selected' : '' }}>
                                                                    {{ $timezone->name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
													
                                                    <div class="col-sm-4">
                                                        <div class="form-group input-with-img">
                                                            <label>Upload Profile Image(Upload jpg, png, jpeg files only)</label>
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
                                                    </div>
													
													<?php 
														/* echo "<pre>";
														print_r($user->profile_image);
														echo "</pre>"; */
													?>
													
													
                                                    <div class="col-sm-4">
														<div class="form-group">
														<label>&nbsp;</label>
                                                        <button type="submit" class="btn btn-primary w-100 ml-auto">Save</button>
														</div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
</div>
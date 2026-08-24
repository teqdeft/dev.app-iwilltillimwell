@extends('layouts.dashboard')
@section('content')
<div class="main-panel main-panel-for-modal-page">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12 grid-margin top-header-page">
                <div class="row">
                    <div class="col-12 col-xl-6 mb-4 mb-xl-0">
                        <h3 class="font-weight-bold">Profile</h3>
                        {{-- <h6 class="font-weight-normal mb-0">General information</h6> --}}
                    </div>
                </div>
            </div>
            <div class="col-md-12 align-items-stretch">
                <div class="row">
                    <div class="col-md-12 grid-margin stretch-card">
                        <div class="card health-card">
                            <div class="card-body">
                                <div class="health-summary-box mb-4">
									<div class="medical-conse-v1">
										<h4 class="card-title">Medical Consent</h4>
									</div>
                                    <form action="{{ url('share/save-user-data') }}" id="user-{{ $type }}" method="post" class="medi-technical-v1">
                                        @csrf
                                        <input type="hidden" name="type" value="{{ $type }}" />
                                        <div class="row">
                                            <div class="col-md-12">
											
                                                <div class="mc_consent-desc mt-19">
													<div class="mb-4">
														
														
													<h4>Telemedicine services can occur via phone or videoconference using a variety of technologies. </h4>
																											
													<p>These services may also include <span style="color:purple"><strong>prescribing medication, scheduling appointments, communicating</strong></span> via secure messaging systems within the electronic medical record, electronic scheduling, providing case management services (e.g., referrals), and providing educational materials when possible.</p>
																											
													<p>Telemedicine is offered to improve access to treatment services and to preserve the continuity of care when significant barriers to accessing medical services exist.</p>
													<ol>
														<li>I understand that the results of telemedicine cannot be guaranteed or assured.</li>
														<li>I understand that I have the right to withdraw this consent at any time.</li>
													</ol>
													</div>
                                                </div>

                                                <div class="mc_consent-desc mt-19">
													<div class="mb-4">
														<h4>I understand that Telemedicine services may not be appropriate or the best choice of service for reasons including, but not limited to:</h4>
														<ol>
															<li>The patient’s reporting symptoms indicate the need for immediate, in-person medical attention and/or evaluation.</li>
															<li>Access to, or difficulty with, communications technology</li>
															<li>Significant communications service disruptions</li>
														</ol>
													</div>
                                                </div>

                                                <div class="mc_consent-desc mt-19">
													<div class="mb-4">
														<h4>Telemedicine services are conducted and documented confidentially according to applicable laws similar to in-person services.  However, there are additional risks including, but not limited to:</h4>
														<ol>
														<li>Telemedicine visits, evaluations, or treatments could be disrupted, delayed, or communications distorted due to technical failures.</li>
														<li>Telemedicine involves alternative forms of communication that may reduce visual and auditory cues and increase the likelihood of misunderstanding one another.</li>
														<li>Difficulties in accessing all necessary medical information can result in adverse drug interactions, allergic reactions, and other errors in clinical judgment.</li>
														<li>Your clinician may determine Telemedicine is not an appropriate treatment option or stop TMT treatment at any time if your condition changes or Telemedicine presents barriers to treatment.</li>
														<li>All information and data is controlled under proper security measures with the very latest technology".However despite every possible precaution being taken In extremely rare cases, security protocols could fail, and unauthorized persons could access your confidential information. And while we strongly feel this will not occur, as a consumer be aware this is a standard online risk today.</li>
														<li>Discuss any concerns about TMT sessions with your provider.</li>
														</ol>
													</div>
                                                </div>
												
                                            </div>



                                            <div class="col-md-6 mt-19">
                                                <div class="mb-3">
                                                    <label>First Name</label>
												<input type="text" class="form-control" name="mc_first_name" value="{{ isset($userMeta['mc_first_name']) ? ucfirst($userMeta['mc_first_name']) : ucfirst($user->fname) }}" placeholder="Name"
                                                        value="">
                                                    
                                                </div>
                                            </div>

                                            <div class="col-md-6 mt-19">
                                                <div class="mb-3">
												<label>Last Name</label>
												<input type="text" class="form-control" name="mc_last_name" value="{{ isset($userMeta['mc_last_name']) ? ucfirst($userMeta['mc_last_name']) : ucfirst($user->lname) }}" placeholder="Last Name"
                                                        >
														
                                                </div>
                                            </div>

                                            <div class="col-md-6 mt-19">
                                                <div class="mb-3">
												<label>Phone Number</label>
                                                    <input type="text" class="form-control" name="mc_phone_number" value="{{ $userMeta['mc_phone_number']??$user->primaryPhone }}" placeholder="Name"
                                                        id="floatingPhone">
                                                    
                                                </div>
                                            </div>
											

                                            <div class="col-md-6 mt-19">
                                                <div class="mb-3">
													<label for="homeAddress">Street Address</label>
                                                    <input type="text" class="form-control" id="homeAddress" name="mc_street_address"
                                                        value="{{ $userMeta['mc_street_address']??$user->address }}">
                                                    
                                                </div>
                                            </div>

                                            <div class="col-md-6 mt-19">
                                                <div class=" mb-3">
													<label for="homeAddress">City</label>
                                                    <input type="text" class="form-control" id="homeAddress" name="mc_city_state" 
                                                        value="{{ $userMeta['mc_city_state']??$user->city }}">
														
                                                    
                                                </div>
                                            </div>
											
                                            <div class="col-md-6 mt-19">
                                                <div class="mb-3">
													<label for="mc_only_state">State</label>														
													<select class="form-control" name="mc_only_state">
														
														@foreach ($states as $state)
														<option value="{{ $state->id }}" {{ ($state->id == ($userMeta['mc_only_state'] ?? $user->stateid)) ? 'selected' : '' }}>
    {{ $state->name }}
</option>

														@endforeach
													</select>
													
                                                    
                                                </div>
                                            </div>
											
											<div class="col-12">
												<div class="mc_consent-desc mb-3 mt-4">
													<h4>Emergency Contacts</h4>
												</div>
											</div>

                                            <div class="col-md-6">
                                                <div class="mb-3">
												 <label>First Name</label>												
    <input type="text" class="form-control" name="mc_emergency_first_name" value="{{ isset($userMeta['mc_emergency_first_name']) ? ucfirst($userMeta['mc_emergency_first_name']) : ucfirst($user->fname) }}" placeholder="First Name"
                                                        >
														
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="mb-3">
												<label>Last Name</label>
		<input type="text" class="form-control" name="mc_emergency_last_name" value="{{ isset($userMeta['mc_emergency_last_name']) ? ucfirst($userMeta['mc_emergency_last_name']) : ucfirst($user->lname) }}" placeholder="Last Name" >
														
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="mb-3">
													<label>Email</label>
                                                    <input type="email" class="form-control" name="mc_emergency_email" value="{{ $userMeta['mc_emergency_email']??$user->email }}" placeholder="Email"
                                                        value="">
                                                    
                                                </div>
                                            </div>

                                            <div class="col-md-12 mt-19">
												<div class="mt-4">
													<h4>Acknowledgment</h4>
													<div class="medical_radio-checks">
														<input class="form-check-input" {{ checkedIcon($userMeta['mc_acknowledgment_1']??'','1') }} type="checkbox" name="mc_acknowledgment_1[]" id="mc_acknowledgment_id-1-1"
															value="1">
														<label class="form-check-label" for="mc_acknowledgment_id-1-1">I have read and understand the above information </label>
													</div>
													 <div class="medical_radio-checks">
														<input class="form-check-input" {{ checkedIcon($userMeta['mc_acknowledgment_1']??'','1') }} type="checkbox" name="mc_acknowledgment_1[]" id="mc_acknowledgment_id-1-2"
															value="1">
														<label class="form-check-label" for="mc_acknowledgment_id-1-2">I hereby give informed consent to IWTIW to provide Telemedicine to deliver my care </label>
													</div>
												</div>
                                            </div>
                                            <div class="col-sm-12 mt-3">
                                                <div class="form-group text-right">
                                                    {{--  <a href="{{ url('share/user/general-information')  }}" class="btn btn-primary"><i class="fa fa-chevron-left fa-arrow-icon fa-arrow-icon-back"></i> Back</a> --}}
                                                    <button type="submit" class="btn btn-primary mr-10 float-right user_submit-profile-consent" id="submit">Next <i class="fa fa-chevron-right fa-arrow-icon"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

 @if ( !isset($userMeta['mc_last_name']) )
        <x-medical-consent-popup />
    @endif

@endsection

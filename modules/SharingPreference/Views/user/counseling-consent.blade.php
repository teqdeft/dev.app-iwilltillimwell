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
										<h4 class="card-title">Counseling Consent</h4>
									</div>
                                    <form action="{{ url('share/save-user-data') }}" id="user-{{ $type }}" method="post" class="medi-technical-v1">
                                        @csrf
                                        <input type="hidden" name="counseling-type" value="{{ $type }}" />
                                        <input type="hidden" name="type" value="{{ $type }}" />
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="mc_consent-desc mt-19">
													<div class="mb-4">
														<h4>All aspects of this informed consent for treatment apply to iWILL ‘til i’mWELL (IWTIW).  I hereby consent to engage in the teletherapy counseling services with iWILL ‘til i’mWELL.</h4>
														<ol>
															<li>I understand counseling is a confidential, collaborative effort between a counselor and an individual. Professional counselors help people identify their personal goals, improve their communication and coping skills, find potential solutions, strengthen their self-esteem, promote behavior change, and achieve optimal levels of mental health.</li>
															<li>I understand that "teletherapy" includes the practice of health care delivery, diagnosis, consultation, treatment, transfer of medical data, and education using interactive live audio, video, or data communications. </li>
															<li>I understand that teletherapy can also involve communicating my medical/mental information, both orally and visually, to health care practitioners.</li>
														</ol>
													</div>
                                                </div>

                                                <div class="mc_consent-desc mt-19">
													<div class="mb-4">
														<h4>I understand that I have the following rights and understanding concerning teletherapy:</h4>
														<ol>
														<li>I have the right to withhold or withdraw consent at any time.</li>
														<li>The laws that protect the confidentiality of my medical information also apply to teletherapy. As such, I must attest that I am in a private, non-public, secure place and alone for each of my teletherapy sessions.</li>
														<li>I understand that the information I disclosed during my therapy is generally confidential. However, there are both mandatory and permissive exceptions to confidentiality, including, but not limited to reporting abuse of vulnerable populations; expressed threats of violence towards an ascertainable victim; expressed threat to harm or kill self; and where I make my mental or emotional state an issue in a legal proceeding or the involvement of law enforcement. </li>
														</ol>
													</div>
                                                </div>

                                                <div class="mc_consent-desc mt-19">
													<div class="mb-4">
														<h4>I also understand that the dissemination of any personally identifiable images or information from the teletherapy interaction to researchers or other entities shall not occur without my written consent.</h4>
														<ol>
														<li>I understand that there are risks and consequences of teletherapy. This includes, but is not limited to, the possibility, despite reasonable efforts on the part of my counselor, that technical failure could disrupt or distort the transmission of my medical information; unauthorized persons could interrupt the transmission of my medical information; and/or unauthorized persons could access the electronic storage of my medical information. </li>
														<li>I understand that teletherapy-based services and care may not be as complete as in-person facet-to-face services. </li>
														<li>I also understand that if my therapist believes I would be better served by another form of therapeutic service (e.g., face-to-face services), I will be referred to a psychotherapist who can provide such services in my area. </li>
														</ol>
													</div>
                                                </div>

                                                <div class="mc_consent-desc mt-19">
													<div class="mb-4">
														<h4>Examples include, but are not limited to, crises, severe and persistent mental illness, and medication management. </h4>
														<ol>
															<li>I understand that there are potential risks and benefits associated with any form of counseling and that despite my efforts and the efforts of my counselor, my condition may not improve and, in some cases, even worsen. </li>
															<li>I understand that I may benefit from teletherapy, but that results cannot be guaranteed or assured. </li>
															<li>I accept that IWTIW teletherapy does not provide emergency services. </li>
														</ol>
													</div>
                                                </div>

                                                 <div class="mc_consent-desc mt-19">
													<div class="mb-4">
														<ol>
														<li>I understand that I can call 911 or proceed to the nearest hospital emergency room for help. Examples of emergencies include having thoughts of hurting or killing another person or myself, having hallucinations, being in a life-threatening emergency of any kind, having uncontrollable emotional reactions, or being dysfunctional due to abusing alcohol or drugs. </li>
														<li>I acknowledge I can call the National Suicide Prevention Lifeline at 1-800-273-TALK (8255) for free 24-hour hotline support. </li>
														<li>I understand that I have a right to request access to portions of my medical information and copies of medical records per HIPAA privacy and security rules.</li>
														<li>I have read and understand the information provided above. I understand that I can discuss this with my counselor.</li>
														</ol>
													</div>
                                                </div>

                                                <div class="mc_consent-desc mt-19">
													<div class="mb-4">
														<h4>If in an emergency, please call/contact any of the following numbers for care:</h4>
														<ol>
														<li>1) 911 or go to the nearest emergency room</li>
														<li>2) The National Suicide Prevention Hotline: 800-273-8255 (24 hours)</li>
														<li>3) The crisis text line: Text HOME to 741741 (24 hours) or <a href="https://www.crisistextline.org"><strong>
                                                        Crisis Text Line</strong></a></li>
														</ol>
													</div>
                                                </div>

                                            </div>

                                            <div class="col-md-6 mt-19">
                                                <div class="mb-3">
												
												<label>First Name</label>
												<input type="text" class="form-control" name="cc_first_name" placeholder=""
												value="{{ isset($userMeta['cc_first_name']) ? ucfirst($userMeta['cc_first_name']) : ucfirst($user->fname) }}">
													
                                                </div>
                                            </div>

                                            <div class="col-md-6 mt-19">
                                                <div class="mb-3">
												<label>Last Name</label>
                                                    <input type="text" class="form-control" name="cc_last_name" placeholder="Name"
                                                        value="{{ isset($userMeta['cc_last_name']) ? ucfirst($userMeta['cc_last_name']) : ucfirst($user->lname) }}">
                                                    
                                                </div>
                                            </div>

                                            <div class="col-md-6 mt-19">
                                                <div class="mb-3">
												<label>Phone Number</label>
                                                    <input type="text" class="form-control" name="cc_phone_number" placeholder="Name"
                                                        value="{{ $userMeta['cc_phone_number']??$user->primaryPhone }}" id="floatingPhone">
                                                    
                                                </div>
                                            </div>


                                            <div class="col-md-6 mt-19">
                                                <div class="mb-3">
												<label for="homeAddress">Street Address</label>
                                                    <input type="text" class="form-control" id="homeAddress" name="cc_street_address"
														value="{{ $userMeta['cc_street_address']??$user->address }}">
                                                    
                                                </div>
                                            </div>

                                            <div class="col-md-6 mt-19">
                                                <div class="mb-3">
												<label for="homeAddress">City</label>
     <input type="text" class="form-control" id="homeAddress" name="cc_city_state" value="{{ $userMeta['cc_city_state']??$user->city }}">
                                                    
                                                </div>
                                            </div>

                                            <div class="col-md-6 mt-19">
                                                <div class="mb-3">
													<label for="cc_only_state">State</label>
													<select class="form-control" name="cc_only_state">
														
														@foreach ($states as $state)
														<option value="{{ $state->id }}" {{ ($state->id == ($userMeta['cc_only_state'] ?? $user->stateid)) ? 'selected' : '' }}>{{ $state->name }}</option>

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
	<input type="text" class="form-control" name="cc_emergency_first_name" value="{{ isset($userMeta['cc_emergency_first_name']) ? ucfirst($userMeta['cc_emergency_first_name']): ucfirst($user->fname) }}" placeholder="First Name">
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label>Last Name</label>
													
		<input type="text" class="form-control" name="cc_emergency_last_name" value="{{ isset($userMeta['cc_emergency_last_name']) 
    ? ucfirst($userMeta['cc_emergency_last_name']) 
    : ucfirst($user->lname) }}" placeholder="Last Name" >
														
														
														
                                                    
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="mb-3">
													<label>Email</label>
                                                    <input type="email" class="form-control" name="cc_emergency_email" value="{{ $userMeta['cc_emergency_email']??$user->email }}" placeholder="Email"
                                                        >

                                                </div>
                                            </div>

                                            <div class="col-md-12 mt-19">
												<div class="mt-4">
													<h4>Acknowledgment:</h4>
													<div class="medical_radio-checks">
														<input class="form-check-input" {{ checkedIcon($userMeta['cc_acknowledgment_1']??'',1) }} type="checkbox" name="cc_acknowledgment_1[]" id="cc_acknowledgment_id-1-1"
															value="1">
														<label class="form-check-label" for="cc_acknowledgment_id-1-1">I have read and understand the above information </label>
													</div>
													 <div class="medical_radio-checks">
														<input class="form-check-input" {{ checkedIcon($userMeta['cc_acknowledgment_1']??'',1) }} type="checkbox" name="cc_acknowledgment_1[]" id="cc_acknowledgment_id-1-2"
															value="1">
														<label class="form-check-label" for="cc_acknowledgment_id-1-2">I hereby give informed consent to IWTIW to provide Tele-Counseling to deliver my care</label>

													</div>
												</div>
                                            </div>

                                            <div class="col-sm-12 mt-3">
                                                <div class="form-group text-right">
                                                    <a href="{{ url('share/user/medical-consent')  }}" class="btn btn-primary"><i class="fa fa-chevron-left fa-arrow-icon fa-arrow-icon-back"></i> Back</a>
                                                    <button type="submit" class="btn btn-primary mr-10 float-right user_submit-profile-consent" id="submit">Finish</button>
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
    @if ( !isset($userMeta['cc_last_name']) )
        <x-complete-counseling-consent />
    @endif
    <x-personal-record-popup />
@endsection

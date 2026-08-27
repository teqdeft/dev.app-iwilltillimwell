@php
    /*
     | Recent Prescriptions and Pick Up Pharmacy are not part of an
     | organisation plan, so both tabs and their panels are hidden for
     | organisation members. Every other user sees them exactly as before.
     */
    $imwellOrgMember = function_exists('org_current') && org_current();
@endphp

<div class="dash-right">
                    <div class="dash-filter">
                        @if(!$imwellOrgMember)
                        <div class="tabs">
                            <div class="tab active" data-tab="Recent-tab">Recent Prescriptions</div>
                            <div class="tab" data-tab="Pharmacy-tab">Pick Up Pharmacy</div>
                        </div>
                        @endif
                        <div class="content">
						
<?php 
$graph_data = array();
?>						
                        @if(!$imwellOrgMember)
                            <div class="tab-content active" id="Recent-tab">
                                <div class="dash-card">
                                    <div class="card-title">
                                        <p>Prescriptions</p>
                                    </div>
                                    <div class="content medi-overflow">
										<?php /*
                                        <div class="recent-dr">
                                            <p>Dr Sushant Singh, General Physician, Visited on 06 Mar 2025</p>
                                        </div>
										*/ ?>
                                        
					
										@if(!$user_medications->isEmpty())
											
											<div class="medicine-detail medi-overflow">
												@foreach($user_medications as $list)
													<div class="medicine-record">
														<div class="medicine-icon">
															<img src="{{asset('assets/dashboard/htmlv/assets/images/paracetamol-icon.svg')}}" alt="icon" />
														</div>
														<div class="medicine-text">
															<div class="text">
																<p>{{$list->name}}</p>
															</div>
																
														</div>	
													</div>
												@endforeach
											</div>
										@else
											<div class="medicine-detail medi-overflow empty-section-main">
												<div class="up-medicine empty-section">
														<div class="medicine-name">
															<p>No Prescriptions</p>
														</div>
												</div>
											</div>
										@endif
                                           

                                        

                                    </div>
                                </div>
                            </div>
                        @endif
							
							
							
							
							
							
                        @if(!$imwellOrgMember)
                            <div class="tab-content" id="Pharmacy-tab">
                                <div class="dash-card">
                                    <div class="card-title">
                                        <p>Pick Up Pharmacy</p>
                                    </div>
                                    <div class="content">
                                       
										
											@if(!$user_medications->isEmpty() && !empty($pharmacy?->address))
											<div class="pick-up">
												

												<div class="up-medicine">
													<div class="medicine-icon">
														<img src="{{asset('assets/dashboard/htmlv/assets/images/paracetamol-icon.svg')}}" alt="icon">
													</div>
													<div class="medicine-name">
														<p>{{ $user_pharmcay?->name ?? '' }}</p>
													</div>
												</div>

												<div class="address">
													<p>
														{{ $user_pharmcay?->address ?? '' }}.
														<br/>
														{{ $user_pharmcay?->city ?? '' }},
														{{ $user_pharmcay?->abbreviation ?? '' }},
														{{ $user_pharmcay?->zipCode ?? '' }}
														
													<br>
													</p>
												</div>
												
												<div class="cta">
													<a href="https://www.google.com/maps/dir/?api=1&destination={{ $user_pharmcay?->latitude ?? '' }},{{ $user_pharmcay?->longitude ?? '' }}" target="_blank" class="medicine-detail-btn">
													<span><img src="{{asset('assets/dashboard/htmlv/assets/images/location-v1.svg')}}" /></span> Directions</a>
													
													<a href="tel:{{ $user_pharmcay?->phone ?? '' }}" class="medicine-detail-btn"><span><img src="{{asset('assets/dashboard/htmlv/assets/images/call-icon.svg')}}" /></span> {{ $user_pharmcay?->phone ?? '' }}</a>
												</div>
											</div>	
											@else
												<div class="medicine-detail medi-overflow empty-section-main">
													<div class="up-medicine empty-section">
														<div class="medicine-name">
															<p>No Pharmacy</p>
														</div>
													</div>
												</div>
											@endif

                                        
                                    </div>
                                </div>
                            </div>
                        @endif
							
							@include('user.dashboard.personal-analytics-graph',['graph_data' => $graph_data])
							
                            <div class="dash-card">
                                <div class="card-title">
                                    <p>Personal Information</p>
                                </div>
                                <div class="content">

                                    <div class="personal-info">
                                        <div class="main-info">
                                            <div class="image">
											@if(!empty($user->profile_image) && file_exists(public_path('profiles/' . $user->profile_image)))	
											<img src="{{ asset('profiles/' . $user->profile_image) }}" width="100" alt="Profile Image">
											@else
											<img src="{{ asset('assets/dashboard/assets/images/dummy-image.svg')}}" alt="image" />
											@endif
										
                                            </div>
                                            <div class="name">
                                                <p>{{ ucfirst(Auth::user()->fname) }} {{ ucfirst(Auth::user()->lname) }}</p>
                                            </div>
                                            <div class="cta">
                                                <a href="{{ url('my-account')}}" class="medicine-detail-btn">Update Details</a>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="basic-info">
                                        <div class="title">
                                            <p>Basic Info</p>
                                        </div>
                                        <div class="info-row">
                                            <div class="info">
                                                <div class="info-name">
                                                    <p>Email</p>
                                                </div>
                                                <div class="info-value">
                                                    <p>{{ Auth::user()->email }}</p>
                                                </div>
                                            </div>
                                            <div class="info">
                                                <div class="info-name">
                                                    <p>Date of Birth</p>
                                                </div>
                                                <div class="info-value">
                                                    <p>{{ Auth::user()->dob }}</p>
                                                </div>
                                            </div>
                                            <div class="info">
                                                <div class="info-name">
                                                    <p>Gender</p>
                                                </div>
                                                <div class="info-value">
                                                    <p>{{ Auth::user()->gender == 'm' ? 'Male' : 'Female' }}</p>
                                                </div>
                                            </div>
                                            <div class="info">
                                                <div class="info-name">
                                                    <p>Phone</p>
                                                </div>
                                                <div class="info-value">
                                                    <p>{{ Auth::user()->primaryPhone }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="basic-info">
                                        <div class="title">
                                            <p>Health Information</p>
                                        </div>
                                        <div class="info-row health">
                                            <div class="info">
                                                <div class="info-name">
                                                    <p>Height</p>
                                                </div>
                                                <div class="info-value">
                                                    <p>{{@$user_details->heightFeet??'NA'}}’ {{@$user_details->heightInches}}”</p>
                                                </div>
                                            </div>
                                            <div class="info">
                                                <div class="info-name">
                                                    <p>Weight</p>
                                                </div>
                                                <div class="info-value">
                                                    <p>{{$user_details->weight??'N/A'}} lbs</p>
                                                </div>
                                            </div>
                                            <div class="info">
                                                <div class="info-name">
                                                    <p>Marital Status</p>
                                                </div>
                                                <div class="info-value">
                                                    
		<p>
		{{ 
    $user_details 
        ? ($user_details->maritalStatus == "1" ? 'Single' 
            : ($user_details->maritalStatus == "2" ? 'Married' 
            : ($user_details->maritalStatus == "3" ? 'Widowed' : 'N/A')))
        : 'N/A' 
}}
</p>
													
													
                                                </div>
                                            </div>
<?php $blood_types = Config::get('constants.blood_type'); ?>	
<?php $exercises = Config::get('constants.exercise'); ?>										
                                            <div class="info">
                                                <div class="info-name">
                                                    <p>Blood Type</p>
                                                </div>
                                                <div class="info-value">
                                                    <p>{{ $user_details && isset($blood_types[$user_details->bloodType]) ? $blood_types[$user_details->bloodType] : 'N/A' }}</p>
                                                </div>
                                            </div>
                                            <div class="info">
                                                <div class="info-name">
                                                    <p>Blood Pressure</p>
                                                </div>
                                                <div class="info-value">
                                                    <p>
													{{ $user_details->bloodPressureSystolic??'N/A' }}
													/
													{{ @$user_details->bloodPressureDiastolic??'N/A' }}
													</p>
													
													
                                                </div>
                                            </div>
                                            <div class="info">
                                                <div class="info-name">
                                                    <p>Excercise</p>
                                                </div>
                                                <div class="info-value">
                                                    <p>{{ $user_details && isset($exercises[$user_details->exerciseHabits]) ? $exercises[$user_details->exerciseHabits] : 'N/A' }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>

								{{-- Family Depandents block: hidden for organisation members. --}}
								@if(!$imwellOrgMember)
								@if(!Auth::user()->parentId)
									<div class="dash-card">
										<div class="card-title">
											<p>Your Family Depandents</p>
										</div>
										<div class="content">
											<div class="adult-info">
												<div class="top-title">
													<div class="text">
														<p>Adult Dependents</p>
													</div>
													<div class="cta">
														<a href="{{url('my-account')}}?active-tab=dependents" class="medicine-detail-btn">Manage Dependents</a>
													</div>
												</div>
												<?php $relationship = Config::get('constants.relationship'); ?>
												@if($dependents->isNotEmpty())
													@foreach ($dependents as $dependent)
														
															<div class="main-info">																																																														
																<div class="image">
																	<img src="{{ asset('assets/dashboard/assets/images/dummy-image.svg')}}" alt="icon">
																</div>
																<div class="adult-detail">
																	<div class="name">
																		<p>{{ $dependent->name }}</p>
																	</div>
																	<div class="value">
																		<p> <?php echo getAgeNumberWithMonth($dependent->dob); ?>
																		({{ ($dependent->relationship!=0) ? $relationship[$dependent->relationship] : "" }})
																		</p>
																	</div>
																</div>
															</div>
													@endforeach
												@else
													<div class="main-info no-dependents-section">
														<p>No Dependents</p>
													</div>
												@endif
											</div>
										</div>
									</div>
								@endif
								@endif
                        </div>
                    </div>
                </div>
				
			
				
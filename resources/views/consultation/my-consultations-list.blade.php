<div class="table-detail">
<?php $userConsultation_id = $consultation['userConsultation_id'];?>
							<div class="consul-type">
								<div class="type">
									<p>{{$consultation['friendlySubTypeName']}}</p>
								</div>
							</div>
							<div class="couns-primary-detail">
								<div class="type-detail">
									<div class="title-td">
										<p></p>
									</div>
									<div class="tel-row">
										<div class="left">
											<div class="ke-title">
												<p>Provider Name</p>
											</div>
											<div class="ke-detial">
												<p class="provider-name">Michael McKee</p>
											</div>
										</div>
										<div class="right">
											<div class="ke-title">
												<p>Modality</p>
											</div>
											<div class="ke-detial">
												<p>{{ucfirst($consultation['modality'][0])}}</p>
											</div>
										</div> 
									</div>
								</div>

								<div class="type-detail">
									<div class="title-td">
										<p>
										
										{{$consultation['patient']['firstName']}}
										{{$consultation['patient']['middleName']}}
										{{$consultation['patient']['lastName']}}
										
										</p>
									</div>
									<div class="tel-row">
										<div class="left">
									
											<div class="ke-detial">
												<p>({{calculateAge($consultation['patient']['dob'])}} yr old {{getGender($consultation['patient']['gender'])}})</p>
											</div>
										</div>

									</div>
								</div>

								<div class="type-date">
									
									<div class="ke-title">
										<p>Scheduled For:</p>
									</div>
									<div class="ke-detial">
										<p>{{ convertToLocal($consultation['whenScheduled']) }}</p>
									</div>
									
									<div class="ke-title">
										<p>Completed On:</p>
									</div>
									<div class="ke-detial">
										<p>{{ convertToLocal($consultation['whenScheduled']) }}</p>
									</div>
									
								</div>

								<div class="status-btn-v1">
									<div class="status">
										@if($consultation['statusName'] === 'New')
											<button class="new primary-v1">New</button>
										@elseif($consultation['statusName'] === 'Pendingschedule')
											<button type="button" class="pending primary-v1">Pending Schedule</button>
										@elseif($consultation['statusName'] === 'Inactive')
											<button type="button" class="cancelled primary-v1">Cancelled</button>
										@elseif($consultation['statusName'] === 'Inprogress')
											<button type="button" class="nav-link inprogress primary-v1">InProgress</button>
										@elseif($consultation['statusName'] === 'Complete')
											<button type="button" class="completed primary-v1">Completed</button>
										@else
											{{ $consultation['statusName'] }}
										@endif
									</div>
								</div>

								<div class="action-main-v1">
									
									@if($consultation['statusName'] != 'Inactive')
										
										<a target="_blank" href="{{ url('my-consultations/print-out')}}?consultation_id={{ $consultation['userConsultation_id'] }}" class="primary-v1 btn">
											<span>
												<img 
													src="{{ asset('assets/dashboard/htmlv/assets/images/print-consultation-svg.svg')}}"
													alt="Print Document">
											</span>
											Print Record
										</a>
										
										<?php /*
										<a class="primary-v1 btn" target="_blank" href="{{ url('my-consultations-download-audio')}}?consultation_id={{ $consultation['userConsultation_id'] }}">
											<span>
												<img 
													src="{{ asset('assets/dashboard/htmlv/assets/images/download-con-icon-svg.svg')}}"
													alt="Print Document">
											</span> Download Consultation Audio
										</a>
										*/ ?>
										<a class="primary-v1 btn"  href="{{url('audio/blank-audio.mp3')}}" download="blank-audio.mp3">
											<span>
												<img 
													src="{{ asset('assets/dashboard/htmlv/assets/images/download-con-icon-svg.svg')}}"
													alt="Print Document">
											</span> Download Consultation Audio
										</a>
									
									@endif 
									
									<button id="toggleBtn-{{ $consultation['userConsultation_id'] }}" onclick="toggleDiv({{ $consultation['userConsultation_id'] }})" class="full-consultation-detail btn">
										<span>
											<img
												src="{{ asset('assets/dashboard/htmlv/assets/images/monotone-add-svg.svg')}}" 
												alt="toggle div">
										</span>
									</button>
									
								</div>

							</div>
							
							@include('consultation.my-consultations-basic-info')
							
</div>
<div id="myDiv-{{ $consultation['userConsultation_id'] }}"  class="information-bg-v1" style="display: none;">
	<div class="basic-information">
		@if($consultation['statusName'] === 'Inactive')
			
			<div class="constant-inactive">
				<h5 class="constant-inactive-heading">Reason for the Consult</h5>
				<div class="constant-inactive-des">
				
					<div class="constant-inactive-list">
						<p><strong>Reason for Visit:</strong>{{$consultation['soap']['intake']['reasonForVisit']}}</p>
					</div>
					<div class="constant-inactive-list">
						<p><strong>Reason for Cancellation:</strong>{{ $consultation['cancellationDetails'][0]['reason']}}</p>
					</div>
					
				</div>	
			</div>
			
		@else 
			
		<div class="left">
			<div class="main-title"><p>Basic Information</p></div>

										<div class="date-created">
											<div class="date-col">
												<div class="created-title">
													<p>Date Created</p>
												</div>
												<div class="created-text">
													<p>
														{{ ConsultantDateFormat($consultation['whenCreated'])}}
													</p>
												</div>
											</div>
											<?php /*	
											<div class="date-col">
												<div class="created-title">
													<p>Call Initiated</p>
												</div>
												<div class="created-text">
													<p>08/01/2025 @ 7:51 PM</p>
												</div>
											</div>
											*/ ?>
											<div class="date-col">
												<div class="created-title">
													<p>Prescription</p>
												</div>
												<div class="created-text">
													@if($consultation['soap']['prescriptions'])
														<p><span><img  src="{{ asset('assets/dashboard/htmlv/assets/images/tidck-icon-time.svg')}}" alt="icon" /></span><span> Yes</span></p>
													@else 
														<p class="no-prescription">No</p> 	
													@endif
												</div>
											</div>
										</div>

										<div class="main-title">
											<p>Reason for the Consult</p>
										</div>

										<div class="reson-consult">
											<p>{{$consultation['soap']['intake']['reasonForVisit']}}</p>
										</div>
										
										<?php /*
										<div class="main-title">
											<p>Consult Notes </p>
										</div>

										<div class="consult-notes">
											<div class="col-row">
												<div class="title">
													<p>Subjective</p>
												</div>
												<div class="text">
													Had a respiratory illness. Thought it was viral but the amoxicillin cleared it up
													immediately but the cough lingered. The cough is now so bad and consistent (even
													with OTC muscinex) that the dry cough has changed to a productive cough with light
													green mucous. That means that the infection is coming back. Im wondering if I should
													go in to let a provider listen to my lungs AND/OR get a chest xray.
												</div>
											</div>

											<div class="col-row">
												<div class="title">
													<p>Objective</p>
												</div>
												<div class="text">
													Had a respiratory illness. Thought it was viral but the amoxicillin cleared it up
													immediately but the cough lingered. The cough is now so bad and consistent (even
													with OTC muscinex) that the dry cough has changed to a productive cough with light
													green mucous. That means that the infection is coming back. Im wondering if I should
													go in to let a provider listen to my lungs AND/OR get a chest xray.
												</div>
											</div>

											<div class="col-row">
												<div class="title">
													<p>Assessment</p>
												</div>
												<div class="text">
													Had a respiratory illness. Thought it was viral but the amoxicillin cleared it up
													immediately but the cough lingered. The cough is now so bad and consistent (even
													with OTC muscinex) that the dry cough has changed to a productive cough with light
													green mucous. That means that the infection is coming back. Im wondering if I should
													go in to let a provider listen to my lungs AND/OR get a chest xray.
												</div>
											</div>

											<div class="col-row">
												<div class="title">
													<p>Treatment Plan</p>
												</div>
												<div class="text">
													Had a respiratory illness. Thought it was viral but the amoxicillin cleared it up
													immediately but the cough lingered. The cough is now so bad and consistent (even
													with OTC muscinex) that the dry cough has changed to a productive cough with light
													green mucous. That means that the infection is coming back. Im wondering if I should
													go in to let a provider listen to my lungs AND/OR get a chest xray.
												</div>

												<div class="treatment-plan">
													<button class="treatment btn">
														<span>
															<img 
															src="{{ asset('assets/dashboard/htmlv/assets/images/view-plan.svg')}}"
															alt="icon">
														</span>
														View Treatment Plan</button>
												</div>

											</div>

											<div class="medicines-main-v1">
												<div class="title">
													<p>Medicines</p>
												</div>
												<div class="medicines-detail">
													<div class="icon">
														<img 
												src="{{ asset('assets/dashboard/htmlv/assets/images/medicine-icon-svg.svg')}}"
												alt="medicine icon">
													</div>
													<div class="medi-detail">
														<div class="detail-100 w-500">
															<p>Paracetamol 500mg</p>
														</div>
														<div class="detail-25">

															<div class="medi-col-25">
																<div class="lable-name">
																	<p>Strength</p>
																</div>
																<div class="lable-value">
																	<p>90 mcg/inh</p>
																</div>
															</div>

															<div class="medi-col-25">
																<div class="lable-name">
																	<p>Dosage</p>
																</div>
																<div class="lable-value">
																	<p>Aerosol</p>
																</div>
															</div>

															<div class="medi-col-25">
																<div class="lable-name">
																	<p>Quantity</p>
																</div>
																<div class="lable-value">
																	<p>1</p>
																</div>
															</div>

															<div class="medi-col-25">
																<div class="lable-name">
																	<p>Refills</p>
																</div>
																<div class="lable-value">
																	<p>0</p>
																</div>
															</div>

														</div>
														<div class="detail-100">
															<div class="lable-name">
																<p>Directions</p>
															</div>
															<div class="lable-value">
																<p>1 tablet everyday for 1 week in morning, noon after food.</p>
															</div>
														</div>

													</div>
												</div>
											</div>

										</div>
										*/ ?>

									</div>
									<div class="right">
										<div class="main-title">
											<p>Consultation Health Records</p>
										</div>


										<div class="vitals-main-v1">
											<div class="vit-title">
												<p>Vitals</p>
											</div>

											<div class="vit-row">

												
													<div class="vit-col">
														<div class="lable-name">
															<p>Height</p>
														</div>
														<div class="lable-value">
															<p>
															
									
															{{ $consultation['soap']['vitals']['height']['feet'] ?? '-' }}’
															{{ $consultation['soap']['vitals']['height']['inches'] ?? '-' }}”
															
															</p>
														</div>
													</div>

													<div class="vit-col">
														<div class="lable-name">
															<p>Weight</p>
														</div>
														<div class="lable-value">
															<p>{{ $consultation['soap']['vitals']['height']['lbs'] ?? '-' }}lbs</p>
															
														</div>
													</div>
												
												
											</div>
											<?php /*
											<div class="main-title">
												<p>Consultation Health Records</p>
											</div>

											<div class="main-col-row">
												<div class="lable-name">
													<p>Medicine</p>
												</div>
												<div class="lable-value">
													<p>Sulfamethoxazole</p>
												</div>
											</div>
											*/ ?>
											
										</div>
		</div>
		@endif
	</div>
</div>
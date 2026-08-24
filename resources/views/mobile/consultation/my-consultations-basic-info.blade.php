<div id="myDiv-{{ $consultation['userConsultation_id'] }}" style="display: none; margin-top: 10px;">
	@if($consultation['statusName'] === 'Inactive')
		
		<div class="constant-inactive">
				<h5 class="constant-inactive-heading">Reason for the Consult</h5>
				<div class="constant-inactive-des">
				
					<div class="constant-inactive-list">
						<p><strong>Reason for Visit:</strong>{{$consultation['soap']['intake']['reasonForVisit']??''}}</p>
					</div>
					<div class="constant-inactive-list">
						<p><strong>Reason for Cancelled:</strong>{{ $consultation['cancellationDetails'][0]['reason']??''}}</p>
					</div>
					
				</div>	
		</div>
		
	@else 
			
	
                        <div class="main-title">
                            <p>Basic Information</p>
                        </div>

                        <div class="basic-v1">
                            <div class="date-created">
                                <div class="date-col">
                                    <div class="created-title">
                                        <p>Date Created</p>
                                    </div>
                                    <div class="created-text">
                                        <p>{{ ConsultantDateFormat($consultation['whenCreated'])}}</p>
                                    </div>
                                </div>
								
								
								
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
                        </div>

                        <div class="main-title">
                            <p>Reason for the Consult</p>
                        </div>

                        <div class="reson-consult">
                            <p>{{$consultation['soap']['intake']['reasonForVisit']}}</p>
                        </div>
						

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
                                            {{ $consultation['soap']['vitals']['height']['feet'] ?? '0' }}’
											{{ $consultation['soap']['vitals']['height']['inches'] ?? '0' }}”
                                        </p>
                                    </div>
                                </div>

                                <div class="vit-col">
                                    <div class="lable-name">
                                        <p>Weight</p>
                                    </div>
                                    <div class="lable-value">
                                        <p>{{ $consultation['soap']['vitals']['height']['lbs'] ?? '0' }}lbs</p>
                                      
                                    </div>
                                </div>
									
                            </div>
							
							
                        </div>
						
	@endif		
	
</div>
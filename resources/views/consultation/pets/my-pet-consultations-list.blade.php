<div class="table-detail">
	<div class="consul-type"><div class="type"><p>{{ucfirst($consultation['name'])}}</p></div></div>
		<div class="couns-primary-detail">
			<div class="type-detail">
				<div class="tel-row">					<div class="left">						<div class="ke-title"><p>Species</p></div>						<div class="ke-detial"><p class="provider-name">{{$consultation['species']}} || {{$gender}}</p></div>					</div>					<div class="right">						<div class="ke-title">							<p>Age & Breed</p>						</div>						<div class="ke-detial">							<p>{{$consultation['years']. ' Year(s) old' }} <br /> {{ 'Breed: '.$consultation['breed'] }}</p>						</div>					</div> 
				</div>					
			</div>			<div class="type-detail">				<div class="title-td">					<p>					{{ $consultation['vet'] ? $consultation['vet']['firstName']." ".$consultation['vet']['lastName'] : " Dr. Patricia Simon "; }}					</p>				</div>			</div>			<div class="type-date">				<div class="ke-title">					<p>Scheduled For:</p>				</div>				<div class="ke-detial">					<p>{{ ConsultantDateFormat($consultation['whenScheduled']); }}</p>				</div>			</div>

											<div class="status-btn-v1" >
												<div class="status">
												
													@if($consultation['statusName'] === 'new')
														<button class="new primary-v1">New</button>
													@elseif($consultation['statusName'] === 'Pendingschedule')
														<button type="button" class="pending primary-v1">Pending Schedule</button>
													@elseif($consultation['statusName'] === 'inactive')
														<button type="button" class="cancelled primary-v1">Cancelled</button>
													@elseif($consultation['statusName'] === 'inprogress')
														<button type="button" class="inprogress primary-v1">InProgress</button>
													@elseif($consultation['statusName'] === 'Complete')
														<button type="button" class="completed primary-v1">Completed</button>
													@else
														{{ $consultation['statusName'] }}
													@endif
												
													
													
												</div>
											</div>

											<div class="action-main-v1">
												
												<div class="pet-action-sv1">
												
													@if( $consultation['statusName'] == 'new' )
														<button class="primary-v1 btn cancelPetConsult"
															pet_id="{{ $consultation['pet_id'] }}"
															petConsult="{{ $consultation['petconsultation_id'] }}">Cancel Consultation</button>
													@endif 
													
													<button id="toggleBtn-{{$consultation['petconsultation_id']}}" onclick="toggleDiv({{$consultation['petconsultation_id']}})" class="full-consultation-detail btn">
														<span>
															<img
																src="{{ asset('assets/dashboard/htmlv/assets/images/monotone-add-svg.svg')}}" 
																alt="toggle div">
														</span>
													</button>
													
												</div>
											</div>

	</div>
										
	<div id="myDiv-{{$consultation['petconsultation_id']}}" class="information-bg-v1" style="display: none;">
		<div class="basic-information">
			<div class="left">
				<div class="main-title"><p>{{ ($consultation['outcome'] && isset($consultation['outcome'][0]['outcome']))?$consultation['outcome'][0]['outcome']:'No Outcome Listed'; }}</p></div>
				

				<div class="main-title">
					<p>Reason for the Consult <small>( patient request )</small></p>
				</div>
				<div class="reson-consult">
					<p>	
						{{ $consultation['consultNotes'][0]['subjective'] ?? 'No Answer' }}
						
					</p>
				</div>
				
				<div class="main-title">
					<p>Consult Notes</p>
				</div>
				<div class="reson-consult">
					<p>
						{{ !empty($consultation['consultNotes'][0]['plan']) ? $consultation['consultNotes'][0]['plan'] : 'No Answer' }}
						
					</p>
				</div>	
				@if($consultation['statusName'] === 'inactive')
					
					<div class="main-title">
						<p>Reason for Cancellation</p>
					</div>
					<div class="reson-consult">
						<p>{{$consultation['cancelReason']}}</p>
					</div>
					
				@endif
			</div>										
		</div>
	</div>							
</div>
<div id="tab{{$key}}" class="tab-content @if ($key==1) active @endif allUserPlan">
	@foreach ($value as $dataKey => $dataValue )
		<div class="radio-select-v1 plan-info-{{$dataValue['id']}}" onclick="package_details({{$dataValue['id']}},'pack-detail')">
							
			<input type="hidden" class="plan-type" value="{{ $dataValue['type'] }}">  
            <input type="hidden" class="plan-name" value="{{ $dataValue['name'] }}">  
            <input type="hidden" class="plan-amount" value="{{ number_format($dataValue['amount'],2) }}">
										
			<label>
				<input 
					type="radio" 
					name="choose-plan{{ $key }}" 
					value="{{ $dataValue['id'] ?? '' }}" 
					planId="{{ $dataValue['id'] ?? '' }}" 
					data-id="{{ $dataValue['id'] ?? '' }}"
				>
				<div class="plan-card">
                    <div class="left">
                        <div class="type"><p><span>{{ $dataValue['name'] }}</span></p></div>
                        
						<div class="plan-amount">
								<p>
									<span class="amount stripe-amount" data-amount="{{ number_format($dataValue['amount']) }}">
										${{ number_format($dataValue['amount']) }}
										
									@if(in_array($dataValue['id'], [13, 14, 15, 16]))
										<span class="package-pm">
											@if(in_array($dataValue['id'], [14,16]))
												( at $50/month )
											@else 
												( at $30/month )
											@endif
										</span>
									@else
										<span class="package-pm">per month</span>
									@endif
									
										
									</span>

									@if (in_array($dataValue['id'], [7, 8]))
										<small>+ $25 / Co-pay per visit</small>
									@endif
								</p>
						</div>
						
						<div class="plan-description">
							@if(in_array($dataValue['id'], [13, 14, 15, 16]))
								
								@if(in_array($dataValue['id'], [14,16]))
										<p>Primary Care + Mental Health Care + Prescription Plan</p>
									@else 
										<p>Primary Care + Mental Health Care</p>
								@endif
								
							@else 
								
								{!! html_entity_decode($dataValue['description']) !!}
							
							@endif 
						
						</div>
                    </div>
					
                    <div class="right">
                        <button class="choose-pln-btn" >View</button>
                    </div>
					
                </div>			
			</label>								
		</div>		
	@endforeach	
</div>
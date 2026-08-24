<div class="plan-content {{ $pack_type == 1 ? 'user-package-list' : 'user-holiday-list' }} "  
	@if($pack_type == 2) style="display:none" @endif
>
    <div class="tab-container">
		<div class="tabs">
			@if($memberType)
				@foreach($memberType as $key => $value)
					@if ($pack_type == 1)
						@if($key <=2)
							
							<button class="tab plan-tab @if($key == 1) active @endif @if($key == 1) self-tab @else self-family-tab @endif" data-tab="tab{{ $key }}"><strong>{{ $value }}</strong></button>
						
						@endif 
					@else
						@if($key > 2)
							
							<button class="tab plan-tab  @if($key == 3) four-month @else twelve-month-tab @endif" data-tab="tab{{ $key }}"><strong>{{ $key == 3 ? '4 Month' : '12 Month' }}</strong>
							</button>
							
						@endif 
					@endif
				@endforeach
			@endif
		</div>
		
		
		@if ($monthPlanDouble)
				@foreach ($monthPlanDouble as $key => $value)

					@if($pack_type == 1)
						@if($key <= 2)
							@include('mobile.dashboardplanpayment.package-holiday-list-show', [
								'key' => $key,
								'value' => $value
							])
					@endif

					@else
						@if ($key > 2)
							@include('mobile.dashboardplanpayment.package-holiday-list-show', [
								'key' => $key,
								'value' => $value
							])
						@endif
					@endif

				@endforeach
			@endif	
		
	</div>
</div>	
<?php /*
<div class="plan-content">
    <div class="tab-container">
		<?php /*
                    <div class="tabs">
					
									
                        @if ($memberType)
							@foreach ($memberType as $key => $value)

								@if ($pack_type == 1)
									
									@if($key <=2)
										
										<button class="tab plan-tab @if($key == 1) active @endif" data-tab="tab{{ $key }}">
											<strong>{{ $value }}</strong>
										</button>
										
									@endif 
									
								@else
									
									@if($key > 2)
										<button class="tab plan-tab @if($key == 3) active @endif" data-tab="tab{{ $key }}">
											<strong>{{ $value }}</strong>
										</button>
									@endif 
									
								@endif

							@endforeach
						@endif
						
                    </div>
					
    </div>
            
        <?php /*            
        @if ( $monthPlanDouble )
            @foreach ($monthPlanDouble as $key => $value )
							
               <div id="tab{{$key}}" class="tab-content @if ($key==1) active @endif allUserPlan">
                    @foreach ($value as $dataKey => $dataValue )
                                    
                                    <div class="radio-select-v1 plan-info-{{$dataValue['id']}}" onclick="package_details({{$dataValue['id']}},'pack-detail')">

                                        <input type="hidden" class="plan-type" value="{{ $dataValue['type'] }}">  
                                        <input type="hidden" class="plan-name" value="{{ $dataValue['name'] }}">  
                                        <input type="hidden" class="plan-amount" value="{{ number_format($dataValue['amount'],2) }}">  
                                         
                                           
                                        

																			

                                        <label>    
                                            <input type="radio" name="choose-plan{{$key}}" value='{{$dataValue['id']}}'  planId="{{ $dataValue['id']??'' }}" data-id="{{ $dataValue['id']??'' }}">

                                                <div class="plan-card">
                                                    <div class="left">
                                                        <div class="type">
                                                            <p><span>{{ $dataValue['name'] }}</span></p>
                                                        </div>
                                                        
                                                        <div class="plan-amount">
                                                            <p>
															
	<span class="amount stripe-amount" data-amount='{{ number_format($dataValue['amount']) }}' > ${{ number_format($dataValue['amount']) }} 
	
	<span class="package-pm">per month</span>
	
	
	</span>  
															
															<?php if($dataValue['id']==7 or $dataValue['id']==8) {?>
																<small>+$25/Co-pay per visit</small>
															<?php } ?>
															
															</p>
                                                        </div>
														<div class="plan-description">{!! html_entity_decode($dataValue['description']) !!}</div>
                                                    </div>
                                                    <div class="right">
                                                        <button class="choose-pln-btn" >
															View
														
														
														</button>
                                                    </div>
                                                </div>
                                        </label>
                                    </div>
									
									
									
									

                @endforeach
                            
            @endforeach
			
        @endif
		
</div>
*/ ?>
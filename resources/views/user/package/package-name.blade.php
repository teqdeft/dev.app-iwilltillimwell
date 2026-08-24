<section class="plan-cards">
    <div class="radio-group">
	
	
	
	@foreach($plan as $result)
		@if($result['member_type']==$member_type)
			
			<label class="radio-wrapper plan-info-list plan-info-{{$result['id']}}" onclick="package_details({{$result['id']}},'pack-detail')">
		
				<input type="hidden" class="plan-type" value="{{$result['type']}}">  
                <input type="hidden" class="plan-name" value="{{$result['name']}}">  
                <input type="hidden" class="plan-amount" value="{{$result['amount']}}"> 
				
									<div class="radio-card">
										<div class="icon">

@if (in_array($result['id'], [14, 16]))
    <img src="{{ asset('assets/dashboard/htmlv/assets/images/premium-family.svg') }}" alt="icon">

@elseif (in_array($result['id'], [13, 15]))
    <img src="{{ asset('assets/dashboard/htmlv/assets/images/basic.svg') }}" alt="icon">

@elseif (in_array($result['id'], [5, 6]))
    <img src="{{ asset('assets/dashboard/htmlv/assets/images/plus-package.svg') }}" alt="icon">

@elseif (in_array($result['id'], [3, 4]))
    <img src="{{ asset('assets/dashboard/htmlv/assets/images/standard-package.svg') }}" alt="icon">

@else
    <img src="{{ asset('assets/dashboard/htmlv/assets/images/basic.svg') }}" alt="icon">
@endif


										</div>
										<div class="detail">
											<div class="plan-name">
												<p>{{$result['name']}} </p>
											</div>
											<div class="price">
												<p class="amount stripe-amount" data-amount="{{$result['amount']}}">
									<?php if($member_type==3 || $member_type==4){?>
														
									${{$result['amount']}}
									<span class="package-pm">
										
									@if (in_array($result['id'], [14, 16]))
										$50/month for 12 months
									@else
										$30/month for 4 months
									@endif
									
									</span>
													
									<?php } else {?>
													
									${{$result['amount']}} <span class="package-pm">per month</span>
									<?php if($result->id==7 or $result->id==8) {?><small>+$25.00 co-pay per visit</small><?php } ?>
													
									<?php } ?>
									
												</p>
											</div>
										</div>
									</div>
									<input type="radio" name="package_name" value="{{$result['id']}}" />
									<span class="custom-radio"></span>
			</label>
			
		@endif		
	@endforeach
	
    </div>
</section>
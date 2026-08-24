<div class="term-v1 cutom-checkbox">
    <div class="addon-features">

	@if($p_type=="package")
	
		@for($i = 0; $i < count($include_list); $i++)
            
			<?php 
            $class_name = getClassNamePackageList($include_list[$i]['option_ids'],'package_option');
            if($class_name) {
				$price = $include_list[$i]['price'];
				$description = $include_list[$i]['description']??'No description';
				if($member_type==2) {
					$price = $include_list[$i]['fm_price']??'0';
				}
            ?>
			
			<?php if(!in_array($include_list[$i]['id'], [17, 18, 20])) { ?>	
				<div id="option_id_{{$include_list[$i]['id']}}" class="chek-s1 service-list <?php echo $class_name?> package_include" style="display:none">
					
					<input type="checkbox" class="package_service_list" id="option_{{$include_list[$i]['id']}}_{{$member_type}}" name="package_option[]" value="{{$include_list[$i]['id']}}" price="{{$price}}" >
										
					<label for="option_{{$include_list[$i]['id']}}_{{$member_type}}" class="checkbox-container">
						<span></span>
						<div>
							<p>{{ $include_list[$i]['name']}}</p>
							<p class="adon">{{ucfirst($description)}}</p>
						</div>
						<p>${{ $price }}</p>
					</label>
				</div>
			
			<?php } 
			}
			?>
			
        @endfor
		
		<div class="lable_prescription_plan">
			<label class="checkbox-container">Select a Prescription Plan</label>
		</div>
		<div class="lable_prescription_plan_main">
			@for($i = 0; $i < count($include_list); $i++)
				
				<?php 
				$class_name = getClassNamePackageList($include_list[$i]['option_ids'],'package_option');
				if($class_name) {
					$price = $include_list[$i]['price'];
					$description = $include_list[$i]['description']??'No description available.';
					if($member_type==2) {
						$price = $include_list[$i]['fm_price']??'0';
					}
				?>
					
				<?php if(in_array($include_list[$i]['id'], [17, 18, 20])) { ?>
				
				<div id="option_id_{{$include_list[$i]['id']}}" class="chek-s1 service-list <?php echo $class_name?> package_include" style="display:none">
					
					<input type="radio" class="package_service_list" id="option_{{$include_list[$i]['id']}}_{{$member_type}}" name="package_option[]" value="{{$include_list[$i]['id']}}" price="{{$price}}" >
								
					<label for="option_{{$include_list[$i]['id']}}_{{$member_type}}" class="checkbox-container">
						<span></span>
						<div>
							<p>{{ $include_list[$i]['name']}}</p>
							<p class="adon">{{ucfirst($description)}}</p>
						</div>
						<p>${{ $price }}</p>
					</label>
				</div>
				
				
				<?php } 
				}?>
				
			@endfor
		</div>
		
		
	@else
			
	
		<div id="option_id_" class="chek-s1 service-list ">
			<input type="checkbox" class="package_service_list"  >
			<label for="option_" class="checkbox-container">
                <span></span>
                <div>
                        <p class="service-list-name">Primary Care + Mental Health Care</p>
                        <p class="adon">&nbsp;</p>
                </div>
                <p class="subtotal-pay-list">$120</p>
            </label>
        </div>
	@endif		
    </div>
	<div class="subtotal-pay"></div>
	
</div>
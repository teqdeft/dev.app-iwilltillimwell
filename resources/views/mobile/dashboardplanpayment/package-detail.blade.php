<div class="">
                <div class="pricing-pln-v4">
                    
                    <div class="top" style="border-bottom:none;">
                        <div class="sub-title"><p>Purchasing</p></div>
                        <div class="title"><h5 class="heading-h5 plan_name_heading"></h5></div>
                    </div>
                    <div class="auto-renew" ><div class="left"><strong>Includes</strong></div></div>
                    <div class="term-v1 cutom-checkbox includes-main">

                        <div class="addon-features pack-holy-list">
                        @php
                        $include_list = getPackageIncludeList();
                        @endphp
                        @if(!empty($include_list))
                             @for($i = 0; $i < count($include_list); $i++)
                                <?php 
                                    $class_name = getClassNamePackageList($include_list[$i]['include_ids'],'package_include');
                                    if($class_name) {
                                            ?>
                                            <div class="service-list chek-s1 assing-pack-id <?php echo $class_name?> package_include" style="display: none;">
                                                <input type="checkbox" class="package_service_list" value="{{$include_list[$i]['id']}}" id="TelePet<?php echo $i?>" checked disabled>
                                                <label for="TelePet<?php echo $i?>" class="checkbox-container">
                                                <span></span>
												<div>
													<p><?php echo $include_list[$i]['name']?></p>
													<p class="adon">
													<?php 
													if(isset($include_list[$i]['description']) && !empty($include_list[$i]['description'])) {
															echo "(".$include_list[$i]['description'].")";
													}
													?>	
													</p>
												</div>
												</label>
                                            </div>
                                        <?php 
                                    } 
                                ?>
                            @endfor       
                        @endif
                        </div>
                    </div>

                    @if(!empty($include_list))
                    <div class="auto-renew optional_heading" style="display:none;"><div class="left"><strong>Optional Add Ons</strong></div></div>
                    <div class="term-v1 cutom-checkbox">
					
                        <div class="addon-features package-addon-list">

                        @php
                            $selectedpackageservicelist_array = []; 
                        @endphp

                        @if($selectedpackageservicelist)
                            @php
                                $selectedpackageservicelist_array = explode(',', $selectedpackageservicelist); 
                            @endphp
                        @endif
                        
                        
                            @for($i = 0; $i < count($include_list); $i++)   
                                <?php 
                                    $class_name = getClassNamePackageList($include_list[$i]['option_ids'],'package_option');
                                    if($class_name) {
                                ?>
                                    <?php if(!in_array($include_list[$i]['id'], [17, 18, 20])) { ?>
                                    <div id="option_id_{{$include_list[$i]['id']}}" class="@if(in_array($include_list[$i]['id'], $selectedpackageservicelist_array))  @endif service-list chek-s1 <?php echo $class_name?> package_include" style="display: none;">

                                        <input type="checkbox" class="package_service_list" id="option_{{$include_list[$i]['id']}}" name="package_option[]" 
                                            value="{{$include_list[$i]['id']}}"
                                            price="{{$include_list[$i]['price']}}"
                                            @if(in_array($include_list[$i]['id'], $selectedpackageservicelist_array)) checked @endif
                                            >
                                        <label for="option_{{$include_list[$i]['id']}}" class="checkbox-container">
                                            <span></span>
                                            <div>
                                                <p>{{ $include_list[$i]['name']}}</p>
                                                <p class="adon">{{ucfirst($include_list[$i]['description'])}}</p>
                                            </div>
                                            <p>${{ $include_list[$i]['price']}} <span class="package-pm">per month</span></p>
                                        </label>
                                    </div>
									
                                    <?php 
									} 
								}
							?>    
                            @endfor

		<div class="lable_prescription_plan">
			<label class="checkbox-container">Choose a Prescription Plan</label>
		</div>	
		<div class="lable_prescription_plan_main">	
								
								@for($i = 0; $i < count($include_list); $i++)   
                                <?php 
                                    $class_name = getClassNamePackageList($include_list[$i]['option_ids'],'package_option');
                                    if($class_name) {
                                ?>
                                    
                                    
								<?php if(in_array($include_list[$i]['id'], [17, 18, 20])) { ?>	
									<div id="option_id_{{$include_list[$i]['id']}}" class="@if(in_array($include_list[$i]['id'], $selectedpackageservicelist_array))  @endif service-list chek-s1 <?php echo $class_name?> package_include" style="display: none;">

                                        <input type="radio" class="package_service_list" id="option_{{$include_list[$i]['id']}}" name="package_option[]" 
                                            value="{{$include_list[$i]['id']}}"
                                            price="{{$include_list[$i]['price']}}"
                                            @if(in_array($include_list[$i]['id'], $selectedpackageservicelist_array)) checked @endif
                                            >
                                        <label for="option_{{$include_list[$i]['id']}}" class="checkbox-container">
                                            <span></span>
                                            <div>
                                                <p>{{ $include_list[$i]['name']}}</p>
                                                <p class="adon">{{ucfirst($include_list[$i]['description'])}}</p>
                                            </div>
                                            <p>${{ $include_list[$i]['price']}} <span class="package-pm">per month</span></p>
                                        </label>
                                    </div>
								<?php } ?>	
									
									
                                    <?php } ?>    
                                @endfor    
            </div>
            </div>
						
						<div class="addon-features holiday-addon-list" style="display:none;">
							
							
							<div id="holiday-package-addon" class=" service-list chek-s1 package_option_1 package_option_2 package_option_3 package_option_4 package_option_5 package_option_6 package_option_7 package_option_8 package_option_13 package_option_14 package_option_15 package_option_16 package_include" style="">

                                        <input type="checkbox" class="package_service_list" id="option_20" name="package_option[]" value="20" price="20">
                                        <label for="option_20" class="checkbox-container">
                                            <span></span>
                                            <div>
                                                <p class="holidaytextdisplys">Primary Care + Mental Health Care</p>
                                                <p class="adon">&nbsp;</p>
                                            </div>
                                            <p class="subtotal-holyday">$0</p>
                                        </label>
                            </div>	
							
						</div>	
						
                    </div>  
                    @endif 

        <div class="term-v1 cutom-checkbox">                    
            <div class="subtotal-pay"></div>
        </div>
		
		<div class="checkout-update cutom-checkbox">                    
            
        </div>
		
    </div>
</div>


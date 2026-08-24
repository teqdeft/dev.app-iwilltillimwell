<div class="main-title">
            <div class="title">
                <p>Welcome to iWILL ‘til i’mWELL</p>
            </div>
			
            <div class="text">
                <p>The Easiest Way to Save on Your Medications</p>
            </div>
			
        </div>

@php
$pay_amount_prescriptions = $pay_amount;
if($plan_info && in_array($plan_info->plan_id, Config::get('constants.family_plan'))) {
		
}
@endphp
			

        <div class="detail-main">

            <div class="main-row">
                <div class="left">
					
					
                    <div class="detail-text">
                        <p>As a subscriber to <b>iWILL ‘til i’mWELL</b>, <span>you won’t have to worry about the expensive cost of 200 common medications.</span></p>
						
                        <p>That’s because <b>iWILL ‘til i’mWELL</b> has created a <span>medication subscription program that provides 200 meds at just $<?php echo $pay_amount_prescriptions?>.00</span>, plus great discounts on all other medications.</p>
                        <p>Consider us your Pharmacy Savings Advocate. Our live Customer Care team is here to help you find the lowest prices on medications available.</p>
						
						<?php if(!$prescription_a) { ?>
						<div class="paynow-button">
							
							@if(config('constants.trial_days') > 0)
									<button type="button" class="btn btn-secondary" disabled>
										Coming Soon
									</button>
								@else
									<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#prescriptions-modal">
										Pay Now
									</button>
							@endif	
						
						</div>
						<?php } ?>
                    </div>
                </div>
                <div class="right">
                    <div class="main-image">
                        <img src="{{ asset('assets/dashboard/assets/images/prescriptions-a-new-v1.png')}}" alt="image" />
                    </div>
					
                    <div class="common">
                        <p><span>200</span> Common Medications</p>
                    </div>
					
				
				<div class="price"><p>Just <span>${{$pay_amount}}!</span></p></div>	
                    
					
                </div>
            </div>

            <div class="program-row">
                <div class="program-title">
                    <p>Our Program Covers:</p>
                </div>
                <div class="program-list">
                    <ul>
                        <li>Allergy.</li>
                        <li>Arthritis/Pain.</li>
                        <li>Asthma.</li>
                        <li>Blood Pressure/Heart.</li>
                        <li>Cholesterol.</li>
                        <li>Cold/Cough.</li>
                        <li>Diabetes.</li>
                        <li>Men’s/Women’s Health.</li>
                        <li>Mental Health.</li>
                        <li>Pink Eye.</li>
                        <li>Poison Ivy, and More!</li>
                    </ul>
                </div>
            </div>
        
            <div class="program-row">
                <div class="program-title">
                    <p>Drugs Like:</p>
                </div>
                <div class="program-list">
                    <ul>
                        <li>Amoxicillin.</li>
                        <li>Azithromycin (Z–pak).</li>
                        <li>Cialis (generic).</li>
                        <li>Glipizide.</li>
                        <li>Omeprazole.</li>
                        <li>Sprintec.</li>
                        <li>Viagra (generic).</li>
                        <li>Warfarin.</li>
                        <li>And much more!</li>
                    </ul>
                </div>
            </div>


			
			<x-prescriptions.program-easy-to-use 					
            pagename="gold" 						
            :payamount="$pay_amount"					
            />
			

            <x-prescriptions.add-pdf-download-button 
						pagename="gold" 
					/>

        </div>
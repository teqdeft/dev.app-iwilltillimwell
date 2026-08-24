<section class="msg-special-header">
        <div class="cust-container-md">
            <div class="rec-row">
                <div class="back">
                    <a href="{{url('mobile-dashboard')}}" class="back-btn">
                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M12.875 16.0417L7.33334 10.5L12.875 4.95834" stroke="#222A3D"
                                stroke-width="1.58333" stroke-linecap="round" stroke-linejoin="round"></path>
                        </svg>
                    </a>
                </div>
                <div class="top-title">
                    <h2 class="title">Welcome to iWILL ‘til i’mWELL</h2>
                </div>
            </div>
        </div>
    </section>
@php
$pay_amount_prescriptions = $pay_amount;
if($plan_info && in_array($plan_info->plan_id, Config::get('constants.family_plan'))) {
		
}
@endphp

    <section class="prescription-main">

        <div class="main-title">
            <!-- <div class="title">
                <p>Welcome to iWILL ‘til i’mWELL</p>
            </div> -->

            <div class="text">
                <p>Easiest Way to Save on Your Medications</p>
            </div>

        </div>

        <div class="detail-main">

            <div class="main-row">
                <div class="left">
                    <div class="detail-text">
                        <p>As a subscriber to <b>iWILL ‘til i’mWELL</b>, <span>you won’t have to worry about the
                                expensive cost of 200 common medications.</span></p>

                        <p>That’s because <b>iWILL ‘til i’mWELL</b> has created a <span>medication subscription program
                                that provides 200 meds at just $<?php echo $pay_amount_prescriptions?>.00</span>, plus great discounts on all other
                            medications.</p>
                        <p>Consider us your pharmacy savings advocate. Our live Customer Care team is here to help you
                            find the lowest prices on medications available.</p>
                    </div>
                </div>
                <div class="right">
                    <div class="main-image">
                        <img src="{{ asset('assets/dashboard/assets/images/prescriptions-a.png') }}"
                            alt="image" />
                    </div>
                    <div class="common">
                        <p><span>200</span> Common Medications</p>
                    </div>
					
				<?php 
				$plan_info = getMyCurrentPlanRecords(Auth::user()->id);
				?>
				<div class="price"><p>Just <span>${{$pay_amount}}!</span></p></div>
				
					
                </div>
            </div>

			<div class="paynow-button">
			
				@if(config('constants.trial_days') > 0)
					
					<button type="button" class="btn primary-button" disabled>Coming Soon</button>
									
				@else
					
					<button onclick="showPaymentScreen('payment-screen')" type="button" class="btn primary-button" data-toggle="modal" data-target="#prescriptions-modal">Pay Now</button>
				
				@endif
				
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
                        <li>Poison Ivy and More!.</li>
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
                        <li>And much more!.</li>
                    </ul>
                </div>
            </div>

			<x-prescriptions.program-easy-to-use 					
            pagename="gold" 						
            :payamount="$pay_amount"					
            />	

            <div class="easy-to-use program-row">
                <x-prescriptions.add-pdf-download-button 
						pagename="gold" 
					/>	
		    </div>



        </div>


    </section>
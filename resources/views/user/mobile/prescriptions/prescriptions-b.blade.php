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
 <section class="prescription-main">
    <div class="main-title">		
            <div class="text">
                <p>Discount Prescription Drug Program</p>
        </div>
    </div>
    <div class="detail-main">
            <div class="main-row">
                <div class="left">
                    <div class="min-left-title">
                        <p>Acute Medication Subscription Program</p>
                    </div>
                    <div class="detail-text">
                        <p>Consider us your Pharmacy Savings Advocate.</p>
                        <p>As a subscriber to <b>iWILL ‘til i’mWELL,</b> <span>you won’t have to worry about the expensive cost of 37 commonly prescribed medications.</span></p>
                        <p><b>iWILL ‘til i’mWELL</b> has created an Acute Medication Subscription Program that provides 37 drugs at no charge just for you, plus great discounts on all other medications.</p>
                        <p>Our live Customer Care team is also here to help you find the lowest prices on medications available.</p>
                    </div>
                </div>
                <div class="right">
                    <div class="main-image">
                        <img src="{{ asset('assets/dashboard/assets/images/prescriptions-b.jpg')}}"
                            alt="image" />
                    </div>
                    <div class="common">
                        <p><span>37</span> Common Medications</p>
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
                        <li>Antibiotics.</li>
                        <li>Bronchitis/Asthma.</li>
                        <li>Cough.</li>
                        <li>Ear Infections.</li>
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
                        <li>Azithromycin (Z-Pak).</li>
                        <li>Ciprofloxacin.</li>
                        <li>Eye Infection/PinkEye.</li>
                        <li>Fever.</li>
                        <li>Headache/Migraine.</li>
                        <li>Pain Management.</li>
                        <li>Hydrocortisone.</li>
                        <li>Meclizine.</li>
                        <li>Naproxen.</li>
                        <li>Poison Ivy.</li>
                        <li>Sore Throat/Strep.</li>
                        <li>Prednisone.</li>
                        <li>Tessalon.</li>
                        <li>and More!.</li>
                    </ul>
                </div>
            </div>
			<x-prescriptions.program-easy-to-use 						
			pagename="silver" 						
			:payamount="$pay_amount"					
			/>												 
			
			<div class="easy-to-use program-row">
                <x-prescriptions.add-pdf-download-button 
						pagename="silver" 
					/>	
		    </div>
    </div>
</section>
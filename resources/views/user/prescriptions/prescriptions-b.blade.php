<div class="main-title">
            <div class="title">
                <p>Welcome to iWILL ‘til i’mWELL</p>
            </div>
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
                        <p><b>iWILL ‘til i’mWELL</b>  has created an Acute Medication Subscription Program that provides 37 drugs at no charge just for you, plus great discounts on all other medications.</p>
                        <p>Our live Customer Care team is also here to help you find the lowest prices on medications available.</p>
						
						<?php if(!$prescription_b) { ?>
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
                        <img src="{{ asset('assets/dashboard/assets/images/prescriptions-b.jpg')}}" alt="image" />
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
						<li>Eye Infection/Pink Eye.</li>
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
						<li>and More!</li>
                    </ul>
                </div>
            </div>


            


			
			<x-prescriptions.program-easy-to-use 
						pagename="silver" 
						:payamount="$pay_amount"
					/>
					
					
					
			<x-prescriptions.add-pdf-download-button 
						pagename="silver" 
					/>	

            
			
			
			

        </div>
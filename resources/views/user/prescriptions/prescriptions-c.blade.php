<div class="main-title">
    <div class="title"><p>Welcome to iWILL ‘til i’mWELL</p></div>
    <div class="text"><p>Affordable Prescription Assistance Program</p></div>		
</div>
<div class="detail-main">

            <div class="main-row">
                <div class="left">
					<?php /*
                    <div class="min-left-title">
                        <p>WELCOME TO BESTCHOICE RX</p>
                    </div>
					*/ ?>
                    <div class="detail-text">
				
						<p>iWILL ‘til i’mWELL has partnered with BestChoiceRx to bring you the best prescription prices possible. As a member of iWILL ‘til i’mWELL, there is no need to worry about the high cost of over 1,000 commonly prescribed medications. That's because as a member of iWILL 'til i'm WELL, you get to take advantage of BestChoiceRx's $0 ENHANCED MEDICATION PROGRAM that includes 37 ACUTE and 95 ACA (Affordable Care Act) medications, plus over 1,000 routinely prescribed CHRONIC drugs at no cost to you.</p>
						
						<p>You can view all medications included in this program by logging into <b>BestChoiceRx.com.</b> Feel free to print and take this formulary to your physician so they can prescribe a listed medication and help you stay within your budget.</p>
					
						
						<?php if(!$prescription_c) { ?>
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
                        <img src="{{ asset('assets/dashboard/assets/images/prescriptions-c.png')}}" alt="image" />
                    </div>
					
                    <div class="common prescrip_c">
                        <p><span>1000</span> Commonly Prescribed Medications</p>
                    </div>
					
				<?php 
				$plan_info = getMyCurrentPlanRecords(Auth::user()->id);
				?>
							
				<div class="price"><p>Just <span>${{$pay_amount}}!</span></p></div>
				
                </div>
            </div>

			
		
			<x-prescriptions.program-easy-to-use pagename="platinum" />

			<div class="easy-to-use program-row">
                <x-prescriptions.add-pdf-download-button 
						pagename="platinum" 
					/>	
		    </div>


        </div>
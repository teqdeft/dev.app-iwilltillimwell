@if(ismobile()) 
	
<div class="modal fade" id="package-free-trial-option" tabindex="-1" aria-labelledby="packageFreeTrialLabel" aria-hidden="true">
    <div class="modal-content">
       
            <div class="modal-header border-0 text-center d-block">
                <h5 class="modal-title font-weight-bold mb-0" id="packageFreeTrialLabel">
                    🎁 Free Trial Offer
                </h5>
            </div>

            <div class="modal-body">
                
                <div class="border rounded p-3 mb-4 bg-white">
                    <p class="text-muted mb-0">
                        Enjoy a complimentary 30-day free trial and explore all key features at no cost. At the end of the 30-day trial period, your selected plan will be activated, and the applicable charges will be processed upon successful completion of your payment.
                    </p>
                </div>

                <div class="d-flex justify-content-center mt-3">
					<a 
						href="{{ route('freeTrailSubscription') }}"  
						class="btn btn-primary font-weight-bold px-5 py-2 rounded-pill shadow-sm mx-auto primary-button">
						Confirm
					</a>
				</div>

            </div>
    </div>
</div>

@else 
	
<div class="modal fade" id="package-free-trial-option" tabindex="-1" aria-labelledby="packageFreeTrialLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content shadow-lg border-0 rounded-lg">

            <div class="modal-header border-0 text-center d-block">
                <h5 class="modal-title font-weight-bold mb-0" id="packageFreeTrialLabel">
                    🎁 Free Trial Offer
                </h5>
                <button type="button" 
						class="close position-absolute" 
						style="right:15px; top:10px;" 
						onclick="window.location.href='/dashboard';">
					<span>&times;</span>
				</button>
            </div>

            <div class="modal-body text-center px-4 py-4">
                
                <div class="border rounded p-3 mb-4 bg-white">
                    <p class="text-muted mb-0">
                        Enjoy a complimentary 30-day free trial and explore all key features at no cost. At the end of the 30-day trial period, your selected plan will be activated, and the applicable charges will be processed upon successful completion of your payment.
                    </p>
                </div>

                <div class="d-flex justify-content-center mt-3">
					<a 
						href="{{ route('freeTrailSubscription') }}" 
					    class="btn btn-primary font-weight-bold px-5 py-2 rounded-pill shadow-sm mx-auto d-inline-block">
						Confirm
					</a>
				</div>

            </div>

        </div>
    </div>
</div>

@endif
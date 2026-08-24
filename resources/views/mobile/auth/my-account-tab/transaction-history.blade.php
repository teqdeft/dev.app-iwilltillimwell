<div id="transaction-history" class="tab-content">
	@php
	use Carbon\Carbon;
	if($transction_record->count()) {
		$nextBilling = Carbon::parse($plan_info->subscription_end_date);
	}
	@endphp
    <div class="midical-form v1 detail">
        <div class="account-man-ship">
		
			<div class="trasc-top">
				<div class="support-title">	
					 <h3>Transaction History</h3>
				</div>
				<?php 
					if($transction_record->count()) {
						?>
						<div class="next-bill">
							<button class="btn btn-primary mr-3">Next Billing: {{ $nextBilling->format('F j, Y') }}</button>
						</div>
						<?php 
					}
				?>
			</div>
		
			<div id="transaction-wrapper" class="table-responsive drag-scroll">
			 @include('auth.manage-transaction-history-table', ['transction_record' => $transction_record])
			</div>
			
		</div>
	</div>
	
	
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).on('click', '.pagination a', function(e) {
	e.preventDefault();
    let url = $(this).attr('href');

    $.ajax({
        url: url,
        type: 'GET',
        beforeSend: function() {
            showLoaderPageLoad('show');
        },
        success: function(data) {
			showLoaderPageLoad('hide');
            $('#transaction-wrapper').html(data);
        },
        error: function() {
			showLoaderPageLoad('hide');
            toatr.warning('Something went wrong!');
        }
    });
});
</script>
</div>
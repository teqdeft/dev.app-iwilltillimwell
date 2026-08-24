<div id="manage-membership" class="tab-pane fade pt-3">
	<div class="pl-name">
		<h3>Manage Membership</h3>
	</div>
    <div class="pt-2 row max-width-80">
	
		<?php 
			/* echo "<pre>";
			print_r($subscription_info->plan_id);
			echo "</pre>"; */
		?>
        <div class="col-sm-6">
            <div class="inner-details-box pb-2">
                <label for="exampleInputWeight"><b>Plan Name</b></label>
                <h3 class="text-primary fs-20 font-weight-medium">
                {{ ucfirst($subscription_info->name ?? '') }}</h3>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="inner-details-box pb-2">
                <label for="exampleInputWeight"><b>Plan Type </b></label>
                <h3 class="text-primary fs-20 font-weight-medium">
                {{ ucfirst($subscription_info->name ?? '') }}
				[ <?php 
				
				if($subscription_info->plan_id%2==0) {
					echo "Self + Family";
				} else {
					echo "Self";
				}
				?> ]
                </h3>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="inner-details-box pb-2">
                <label for="exampleInputWeight"><b>Plan Start Date</b></label>
                <h3 class="text-primary fs-20 font-weight-medium">
                {{ date('d F Y',strtotime($subscription_info->subscription_start_date ?? '')) }}</h3>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="inner-details-box pb-2">
                <label for="exampleInputWeight"><b>Plan End Date</b></label>
                <h3 class="text-primary fs-20 font-weight-medium">
                {{ date('d F Y',strtotime($subscription_info->subscription_end_date ?? '')) }}</h3>
            </div>
        </div>
		<?php /*
        <div class="col-sm-4">
            <div class="inner-details-box switch-cont pb-2">
                <label for="exampleInputWeight"><b>Auto Renew Plan</b></label>
            <div class="switch-cont">
                <label class="switch">
                    <input type="checkbox">
                    <span class="slider round"></span>
                </label>
            </div>

            </div>
        </div>
		*/ ?>
        <div class="col-sm-12  mt-4">
            <a href="{{ url('dashboard?action=change-plan')}}" class="btn btn-primary mr-3">
              
			  <svg id="Layer_1" enable-background="new 0 0 48 48" viewBox="0 0 48 48" xmlns="http://www.w3.org/2000/svg" width="30" height="26" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.dev/svgjs"><g width="100%" height="100%" transform="matrix(1,0,0,1,0,0)"><g><path d="m36.1 24.8c-.5 0-.9 0-1.4.1-2.3.3-4.4 1.2-6.2 2.8-2.1 1.8-3.4 4.4-3.7 7.1-.1.5-.1.9-.1 1.4 0 .8.1 1.5.2 2.2.5 2.4 1.8 4.7 3.6 6.3 2.1 1.8 4.8 2.9 7.5 2.9 6.3 0 11.4-5.1 11.4-11.4s-5-11.4-11.3-11.4zm5.4 8.3h-2.2v-1.1c0-.5-.4-.8-.8-.8h-4.6c-.5 0-.8.4-.8.8v2.1c0 .5.4.8.8.8h4.6c1.7 0 3.1 1.4 3.1 3.1v2.1c0 1.7-1.4 3.1-3.1 3.1h-1.2v2.1h-2.3v-2.1h-1.2c-1.7 0-3.1-1.4-3.1-3.1v-1.1h2.3v1.1c0 .5.4.8.8.8h4.6c.5 0 .8-.4.8-.8v-2.1c0-.5-.4-.8-.8-.8h-4.6c-1.7 0-3.1-1.4-3.1-3.1v-2.1c0-1.7 1.4-3.1 3.1-3.1h1.2v-2.1h2.2v2.1h1.2c1.7 0 3.1 1.4 3.1 3.1z" fill="#ffffff" fill-opacity="1" data-original-color="#000000ff" stroke="none" stroke-opacity="1"/><path d="m13.6 12.2c1.4 0 2.5-1.1 2.5-2.5s-1.1-2.5-2.5-2.5-2.5 1.1-2.5 2.5 1.1 2.5 2.5 2.5z" fill="#ffffff" fill-opacity="1" data-original-color="#000000ff" stroke="none" stroke-opacity="1"/><path d="m25.9 8.7-11.1-7.8c-.3-.2-.7-.4-1.1-.4s-.8.1-1.2.4l-11.2 7.8c-.5.4-.8 1-.8 1.6v35.2c0 1.1.9 2 2 2h22.3c.9 0 1.7-.7 1.9-1.6-.1-.1-.1-.1-.2-.2s-.2-.2-.3-.3-.3-.3-.4-.4-.2-.2-.3-.4-.2-.3-.3-.5c-.1-.1-.2-.3-.3-.4-.1-.2-.2-.3-.3-.5-.1-.1-.2-.3-.2-.4-.1-.2-.2-.3-.3-.5-.1-.1-.1-.3-.2-.4-.1-.2-.2-.4-.2-.6-.1-.1-.1-.3-.2-.4-.1-.2-.1-.4-.2-.7 0-.1-.1-.2-.1-.4-.1-.3-.2-.7-.3-1-.2-.8-.3-1.7-.3-2.7 0-.5 0-1 .1-1.4 0-.2 0-.3.1-.5 0-.3.1-.6.2-.9 0-.2.1-.4.1-.5.1-.3.1-.6.2-.8s.1-.4.2-.5c.1-.3.2-.5.3-.8.1-.2.2-.4.3-.5.1-.2.2-.5.4-.7.1-.2.2-.4.3-.5.1-.2.3-.4.4-.6s.3-.3.4-.5c.2-.2.3-.4.5-.6.1-.2.3-.3.4-.5.1-.1.2-.2.3-.4v-16c-.1-.7-.4-1.3-.9-1.7zm-12.3-3.8c2.6 0 4.8 2.1 4.8 4.8s-2.1 4.8-4.8 4.8-4.8-2.1-4.8-4.8 2.2-4.8 4.8-4.8zm6.3 34.6h-12.5v-2.2h12.5zm0-7.2h-12.5v-2.2h12.5zm0-7.2h-12.5v-2.2h12.5z" fill="#ffffff" fill-opacity="1" data-original-color="#000000ff" stroke="none" stroke-opacity="1"/></g></g></svg>
			  
			  Upgrade Your Plan</a>
            <!-- <button type="submit" class="btn btn-primary mr-3"><i class="fas fa-calendar-times mr-2"></i>Cancel Plan</button> -->
        </div>
    </div>
</div>
@include('includes.planPopup')

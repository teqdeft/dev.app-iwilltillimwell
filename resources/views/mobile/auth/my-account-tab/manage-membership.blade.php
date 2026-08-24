<div id="manage-membership" class="tab-content">
    <div class="midical-form v1 detail">
        <div class="account-man-ship">

<?php 
$plan_info = getMyCurrentPlanRecords(Auth::user()->id);
/*
echo "<pre>";
print_r($subscription_info);
echo "</pre>";   */
?>

            <div class="app-heading"><p>Manage Membership</p></div>
            <div class="form">
                <form class="form-row">
                                        <div class="col-50 form-group">
                                            <div class="ship-card">
                                                <div class="title">
                                                    <p>Plan Name</p>
                                                </div>
                                                <div class="value">
                                                    <p>{{ ucfirst($subscription_info->name ?? '') }}</p>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-50 form-group">
                                            <div class="ship-card">
                                                <div class="title">
                                                    <p>Plan Type</p>
                                                </div>
                                                <div class="value">
                                                    <p> 
														[ <?php 
															if($subscription_info->plan_id%2==0) {
																echo "Self + Family";
															} else {
																echo "Self";
															}
															?> 
														]
													</p>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-50 form-group">
                                            <div class="ship-card">
                                                <div class="title">
                                                    <p>Plan Start Date</p>
                                                </div>
                                                <div class="value">
                                                    <p>{{ date('d F Y',strtotime($subscription_info->subscription_start_date ?? '')) }}</p>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-50 form-group">
                                            <div class="ship-card">
                                                <div class="title">
                                                    <p>Plan End Date</p>
                                                </div>
                                                <div class="value">
                                                    <p>{{ date('d F Y',strtotime($subscription_info->subscription_end_date ?? '')) }}</p>
                                                </div>
                                            </div>
                                        </div>
										
										<?php /*
                                        <div class="col-50 form-group">
                                            <div class="togle">
                                                <div class="custom-toggle-container">
                                                    <span class="custom-toggle-label">Auto Renew Plan</span>
                                                    <div class="custom-toggle">
                                                        <input type="checkbox" id="MyMood" class="custom-toggle__checkbox">
                                                        <label for="MyMood" class="custom-toggle__label">
                                                            <span class="custom-toggle__slider"></span>
                                                        </label>
                                                    </div>
        
                                                </div>
                                            </div>
                                        </div>
										*/ ?>

                                        <div class="col-100 cta">
                                            <button type="button" class="primary-button" onclick="ChangePlan()">Upgrade Your Plan</button>
                                            
                                        </div>
                                        
                </form>
            </div>
            <div class="ship-row">
            </div>
        </div>
    </div>
</div>
<script>
function ChangePlan() {
    window.location.href="{{ url('/change-plan')}}";
}
</script>
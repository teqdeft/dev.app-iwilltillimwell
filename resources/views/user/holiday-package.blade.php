<div class="tabs choose-plan">
@php
    $include_list = getPackageIncludeList();
@endphp
<script> 
var promo_data=""; 
</script>

<?php 
$plan_info = getMyCurrentPlanRecords(Auth::user()->id);

?>

        <div class="choose-plan-nav mt-0 mb-0">
            <div class="plan-nav-text">
                <div class="title">
                    <h2>Holiday Special Plan</h2>
                </div>
                <div class="text">
                    <p>Personalized health plans for every step of your journey.</p>
                </div>
            </div>
			<div class="enter_p_code">
                
            </div>
            <div class="tab-buttons">
                <button class="tab-button plan-tab active four-month-tab" data-tab="four-month">4 Month</button>
                <button class="tab-button plan-tab twelve-month-tab" data-tab="twelve-month">12 Month</button>
            </div>
        </div>

        <div class="choose-plan-detail">
            <div class="tab-content">
                <div class="tab-panel active allUserPlan" id="four-month">

					@include('user.package.package-name',['member_type' => 3])
                    

                    <section class="all-feature-detail">
                        <div class="left">
                            <div class="plan-detail-title">
                                <div class="table-title">
                                    <p>Compare features by plan</p>
                                </div>
                            </div>
                            <div class="comp-fiture">
                                <div class="table-responsive">
									@include('user.package.package-details',['p_type'=>'holiday'])
                                </div>
                            </div>
                        </div>
                        <div class="right">
                            <div class="plan-detail-title">
                                <div class="table-title">
                                    <p>Optional</p>
                                </div>
                            </div>
                            <div class="pricing-pln-v4">
								@include('user.package.optional-service',['member_type' => 3,'p_type'=>'holiday'])
                            </div>
							<div class="cta">
                                <button class="medicine-detail-btn get-started-button">Subscribe Now <i class="fa fa-chevron-right fa-arrow-icon"></i></button>
                            </div>
                        </div>
                    </section>

                </div>
                <div class="tab-panel allUserPlan" id="twelve-month">

                    @include('user.package.package-name',['member_type' => 4])

                    <section class="all-feature-detail">
                        <div class="left">
                            <div class="plan-detail-title">
                                <div class="table-title">
                                    <p>Compare features by plan</p>
                                </div>
                            </div>
                            <div class="comp-fiture">
                                <div class="table-responsive">
                                    @include('user.package.package-details',['p_type'=>'holiday'])
                                </div>
                            </div>
                        </div>
                        <div class="right">
                            <div class="plan-detail-title">
                                <div class="table-title">
                                    <p>Optional</p>
                                </div>
                            </div>
                            <div class="pricing-pln-v4">
                                @include('user.package.optional-service',['member_type' => 4,'p_type'=>'holiday'])
                            </div>
							<div class="cta">
                                <button class="medicine-detail-btn get-started-button">Subscribe Now <i class="fa fa-chevron-right fa-arrow-icon"></i></button>
                            </div>
                        </div>
                    </section>

                </div>
            </div>
        </div>
</div>

@include('user.package.package-holiday-script')

<div class="app-main choose-plan">
    <div class="package-list-design">

        <section class="plan-v1 mb-0">
            <div class="cust-container">
				
				<section class="onbd-logo-section">
					 <div class="logo-main">
						<a href="{{ url('/')}}">
							<img src="{{ asset(env('APP_LOGIN_MOBILE_BLACK')) }}" alt="app logo">
						</a>
					</div>	
				</section>
				
                <div class="plan-header">
                    <div class="back-btn">

                        @if(request()->routeIs('MobileUserChangePlans'))
                            <a href="{{ route('mobile-dashboard')}}" class="back-main"><img src="{{ asset('mobile-images/back-arrow-for-darktheme.svg') }}" alt="back" /></a>
                        @else 
								
						
						@endif
                    </div>
                    <div class="get-started">
                        <h5 class="heading-h5 plan-name-show">Choose a plan</h5>
                    </div>
                </div>
				
				
				
            </div>
            <div class="enter_p_code user-package-list">
                <div class="title">
                    <p><strong>Enter Your Promo Code</strong></p>
                </div>
                <form class="code_row">
                    <div class="input">
                        <input type="text" name="your code" id="inputPromoCode">
                    </div>
                    <div class="code-validate">
                        <button type="button" class="promo-code-apply-btn primary-button" style="width: auto;" onclick="apply_coupon()">Apply</button>
                    </div>
                    
                </form>
                <div class="code_row"> <span class="promo-error" style="display:none;color:red;">Please fill your promo code</span></div>
            </div>
            
			@include('mobile.dashboardplanpayment.package-holiday-list',['pack_type'=>'1'])
			@include('mobile.dashboardplanpayment.package-holiday-list',['pack_type'=>'2'])
			
            
				
			@if(!request()->routeIs('MobileUserChangePlans'))
				<div class="logout-pack-v1 ">
					<a href="/logout" class="primary-button">Logout</a>
				</div>
			@endif
				
            </div>

            <div class="cta" style="display: none;">
                <input type="hidden" name="promo_code_id" value="">
                <a href="javascript:void(0);" class="primary-button" onclick="package_step_submit(0)">Get Started</a>
                <span style="font-size: 16px; margin: 14px 0px 0px 0px;display:none;" class="package-error error">Please select Plan</span>

                <input type="hidden" id="package_discount_amount"> 
            </div>

        </section>

    </div>

    <div class="package-list-detail-design" style="display: none;">

        <div class="app-main choose-plan pln1">

            <section class="plan-v1">
                <div class="cust-container">
                    <div class="plan-header plan-basic">
                        <div class="back-btn">
                            <a onclick="package_details(0,'back-request')" href="javascript:void(0)" class="back-main"><img src="{{ asset('mobile-images/back-arrow-for-darktheme.svg') }}" alt="back" /></a>
                        </div>
                    </div>
                </div>
				
				<section class="onbd-logo-section">
					 <div class="logo-main">
						<a href="{{ url('/')}}">
							<img src="{{ asset(env('APP_LOGIN_MOBILE_BLACK')) }}" alt="app logo">
						</a>
					</div>	
				</section>
        
                <div class="plan-content">
                    <div class="tab-container">
                        
                        <div class="tabs">
                            
                            <button class="tabsssss active plan_amount_monthly" data-tab="tab1" style="flex: 1;text-align: center;padding: 5px 2px;cursor: pointer;border: none;transition: background-color 0.3s;font-size: 14px;font-weight: 400;font-family: var(--karla-font);background: linear-gradient(300deg, #6D568F, #8462A8);color: var(--white);border-radius: 5px;"></button>
                          
                        </div>
                
                        <div id="tab1" class="tab-content active" style="display: block !important;">
                            @include('mobile.dashboardplanpayment.package-detail')
                        </div>

                    </div>
                </div>
        
                <div class="cta">
                    <a href="javascript:void(0);" class="primary-button get-started-button">Subscribe Now</a>
                </div>
        
            </section>
        
        </div> 

    </div>   
    
</div>
<script>
 var package_amount  = 0; 
 var plan = @json(Auth::user()->plan);


    const tabs = document.querySelectorAll('.tab');
    const tabContents = document.querySelectorAll('.tab-content');
    tabs.forEach(tab => {
        tab.addEventListener('click', () => {
            tabs.forEach(t => t.classList.remove('active'));
            tab.classList.add('active');
            tabContents.forEach(content => content.classList.remove('active'));
            const targetTab = document.getElementById(tab.dataset.tab);
            targetTab.classList.add('active');
        });
    });
    
    function package_step_submit(package_id) {
		
		//showLoader();
        if(package_id) {
            $('input[name="choose-plan1"][value="'+package_id+'"]').prop('checked', true);
            $('input[name="choose-plan2"][value="'+package_id+'"]').prop('checked', true);
        }
        var userEmail = @json(Auth::user()->email);
        let active_tabs = $('.plan-tab.active').text();
        var promo_code_id = $('input[name="promo_code_id"]').val();
        let plan_id = 0;
        $(".package-error").hide();
        if(active_tabs=="Self") {
            plan_id = $('input[name="choose-plan1"]:checked').val();
        } else {
            plan_id = $('input[name="choose-plan2"]:checked').val();
        }
        if(!plan_id) {
            $(".package-error").show();
            return false; 
        }  
        
        let package_service_list = $(".package_service_list:checked").filter(function() {
            return $(this).closest('.service-list').is(':visible'); // Check if the parent div is visible
        }).map(function() {
            return $(this).val();
        }).get();
        console.log(package_service_list);
        //return false;
        let optional_amount = getPackageOptionalAmount();
    
        var formData = new FormData();
        formData.append("next_step","3");
        formData.append("current_step","2");
        formData.append("promo_code_id",promo_code_id);
        formData.append("select_plan",plan_id);
        formData.append("getPlanDetail",plan_id);
        formData.append("email",userEmail);
        formData.append("package_service_list",package_service_list);
        formData.append("optional_amount",optional_amount);
        
        let optional_service = $("input[name='package_option[]']:checked").map(function() {
                return $(this).val(); 
            }).get();

        formData.append("optional_service",optional_service);     

        $.ajax({
            url: "{{ route('updateStep') }}",  // Use the named route from routes/web.php
            type: 'POST',
            data: formData,
            dataType: 'json',
            processData: false,  // Important for FormData, prevents jQuery from processing the data
            contentType: false,  // Important for FormData, tells jQuery not to alter the content type
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {

                if(response.original.status){
                    show_tabs(3);
                } else {
                    toastr.error(response.original.message);
                }
                
            },
            error: function(xhr, status, error) {
                console.log("Here");
            }
    });

}
function apply_coupon(){
	
	let promoCode = $("#inputPromoCode").val();
    $(".promo-error").hide();
    $("input[name='promo_code_id']").val("");
    
	if(promoCode !== "") {
            $.ajax({
                method: "POST",
                url: SITE_URL + "/apply-promo-code",
                dataType: "json",
                data: {
                    "_token": $('meta[name="csrf-token"]').attr('content'),
                    "promoCode": promoCode,
                },
                success: function(data) {
                    if (data.original.status) {
						
                        promo_data = data.original.data;
                        $(".promo-code-apply-btn").text("Applied");
                        $(".promo-code-apply-btn").attr("disabled", true);
                        $(".promo-code-applied-text").show();
						$("input[name='promo_code_id']").val(promo_data.id);
						
						if(data.original.data.coupon_mode=="package") {

							$(".allUserPlan").find(".stripe-amount").each(function(i, el) {
								var stripe_amount = parseFloat($(this).data("amount"));
								console.log(stripe_amount);
								var discount_amount = promo_data.member_discount_type == "fixed" ? promo_data.member_discount_amount : (stripe_amount * promo_data.member_discount_amount / 100).toFixed(2);
								var after_discount_amount = (stripe_amount - discount_amount).toFixed(2);
								$(this).text(`$${after_discount_amount}`);
								
								$("#package_discount_amount").val(discount_amount);
								
							});

                        } else {
							
							console.log("================");	
							$(".user-package-list").hide();
							$(".user-holiday-list").show();
							$('[data-tab="tab3"]').click();

						}

                      
                    } else {
                        $(".promo-error").text("Your code is not valid");
                        $(".promo-error").show();
                        $(".promo-code-apply-btn").attr("disabled", false);
                    }
                },
            });
    } else {
        $(".promo-error").show();
    }
		
	/* $(document).on("click", ".promo-code-apply-btn", function(e) {	
    }); */
	
}
</script>
@include('mobile.dashboardplanpayment.script')
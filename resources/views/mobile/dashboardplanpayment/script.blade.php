<script>

function getPackageOptionalAmount(){

    return  $("input[name='package_option[]']:checked").map(function() {

            return Number($(this).attr("price")); 

        }).get().reduce((sum, price) => sum + price, 0);

} 

function GetPackageFinalAmount() {

    

    console.log(promo_data);



    let package_amount_show = package_amount;



    let package_discount_amount = promo_data.member_discount_type == "fixed" ? promo_data.member_discount_amount : (package_amount_show * promo_data.member_discount_amount / 100).toFixed(2);

                            

    //let package_discount_amount = $("#package_discount_amount").val();

    let html = "";

    

    let optional_amount = getPackageOptionalAmount();

    console.log(optional_amount);

	if(promo_data.coupon_mode=="holiday") {

		package_discount_amount = 0;

		optional_amount = 0;

	}

	

    if(optional_amount) {



        html += '<div class="total-row"><p>Subtotal:</p><p>$'+package_amount+'</p></div>';

        html +='<div class="total-row"><p>Optional:</p><p>$'+optional_amount+'</p></div>';

        package_amount_show = parseFloat((Number(package_amount) + Number(optional_amount)).toFixed(2));

    }

    

	

    if(package_discount_amount > 0 ) {

        html += '<div class="total-row"><p>Promo Code Discount:</p><p>$'+package_discount_amount+'</p></div>';

        package_amount_show -= package_discount_amount;

    }

   

    

    html +='<div class="total-row total-amount"><p>Total price:</p><p>$'+parseFloat(package_amount_show).toFixed(2)+'</p></div>';

    $(".subtotal-pay").html(html);

	

	if(promo_data.coupon_mode=="holiday") {

		

		$(".subtotal-holyday").html("$"+parseFloat(package_amount_show).toFixed(2));

	}

	

	

	let purchaseDate = new Date();

	purchaseDate.setDate(purchaseDate.getDate() + <?php echo config('constants.add_extra_days') ?>);

	let billingDate_info = getFirstBillingDetails(purchaseDate,package_amount_show);	

	console.log("Here=====");	

	console.log(billingDate_info);

	let checkout_update=getCheckoutUpdate(billingDate_info);

	$(".checkout-update").html(checkout_update);

	

}



function getCheckoutUpdate(billingDate_info) {

	

	let html_section="";

		html_section += '<div class="pay-update-info"><div class="card shadow-sm mt-3" style="border-radius:12px;"><div class="card-body">';

		

	@if(config('constants.pro_data_status') === 'active')

	

		html_section += '<div class="alert alert-info d-flex align-items-center mb-4" style="border-radius:8px;"><i class="fas fa-calendar-alt me-2"></i><div><strong>Next Billing Date:</strong><span class="ms-1">'+billingDate_info.firstBillingDate+'</span></div></div>';

		if(billingDate_info.extraDays) {

			

			html_section += '<div class="billing-summary"><div class="d-flex justify-content-between py-2 border-bottom"><span class="text-muted">Pro Rata Days</span><strong>'+billingDate_info.extraDays+' Days</strong></div><div class="d-flex justify-content-between py-2 border-bottom"><span class="text-muted">Pro Rata Amount</span><strong>$'+billingDate_info.extraAmount+'</strong></div><div class="d-flex justify-content-between py-3 mt-2"><span class="fw-bold fs-5">Grand Total</span><span class="fw-bold fs-5 text-success">$'+billingDate_info.firstChargeAmount+'</span></div></div>';

			

			

			

		}

		

	

	@endif

	

	

	let checkbox_status_html = "";

	let disabled_status = "";

	let checkbox_status = document.getElementById('agree_terms1');

	if (checkbox_status && checkbox_status.checked) {

		checkbox_status_html = "checked";

		disabled_status = "disabled";

	} 

	

	

	

		html_section += '<div class="custom-checkbox_new mt-4"><div id="" class="chek-s1 service-list" style=""><input type="checkbox" class="agree_terms1" id="agree_terms1" '+checkbox_status_html+' '+disabled_status+'><label for="agree_terms1" class="checkbox-container"><span></span><div><p>Review and agree to the Terms and Conditions and Privacy Policy.</p></div></label></div></div>';

		

		

		html_section += '</div></div></div>';

	return html_section;

	

}



 

function package_details(package_id,request_type){

    if(request_type=="back-request") {

        $(".package-list-design").show();

        $(".package-list-detail-design").hide();

    } else {

		

		  

		 

		 

        $("#getPlanDetail").val(package_id);

        $('input[name="choose-plan1"][value="'+package_id+'"]').prop('checked', true);

        $('input[name="choose-plan2"][value="'+package_id+'"]').prop('checked', true);

        $('input[name="package_option[]"]').prop('checked', false).change();



        $(".package-list-design").hide();

        $(".package-list-detail-design").show();



           

         let plan_type = $(".plan-info-"+package_id+" .plan-type").val();   

         let plan_name = $(".plan-info-"+package_id+" .plan-name").val();  

         let plan_amount = package_amount = $(".plan-info-"+package_id+" .plan-amount").val(); 

         let plan_description = $(".plan-info-"+package_id+" .plan-description").html().trim();

       

        $(".plan_type_heading").html(plan_type);

        $(".plan_name_heading").html("<p>"+plan_name+"</p>");

        $(".plan_amount_monthly").html("<span>Monthly</span> <br> $"+plan_amount+"/mo");

        $(".package-content").html(plan_description);

        $(".get-started-button").attr("onclick","package_step_submit("+package_id+")");

        console.log(plan_description);



        $(".package_include").hide();

        $(".package_include_"+package_id).show();

        $(".optional_heading").hide();

        if ($(".package_option_" + package_id).length) {

            $(".optional_heading").show();

            $(".package_option_"+package_id).show();

        }

        GetPackageFinalAmount();

		

		if(promo_data.coupon_mode=="holiday") {

			

			let plan_tab = $(".user-holiday-list .tab.active").attr("data-tab");

			console.log(plan_tab);

			$(".package-addon-list").hide();

			$(".holiday-addon-list").show();

			

			let month_name = "12";

			

			let html_list='';

			

			$(".pack-holy-list-pre").remove();

			

			$(".holidaytextdisplys").html('Primary Care + Mental Health Care');

			

			if(package_id==14 || package_id==16) {

				

				html_list='<div class="service-list pack-holy-list-pre chek-s1 assing-pack-id package_include_5 package_include_6 package_include_7 package_include_8 package_include_13 package_include_14 package_include_15 package_include_16 package_include" style=""><input type="checkbox" class="package_service_list" value="19" id="TelePet9" checked="" disabled=""><label for="TelePet9" class="checkbox-container"><span></span><div><p>Prescription Plan</p><p class="adon"></p></div></label></div>';

				$(".holidaytextdisplys").html('Primary Care + Mental Health Care + Prescription Plan');

				

			} else if(plan_tab=="tab3") {

				month_name = "4";

			}

			

			$(".pack-holy-list").append(html_list);

			$(".plan_amount_monthly").html("<span>"+month_name+" Month </span> <br> $"+plan_amount+"");

		}

		

		

        if(plan==package_id){

            <?php 

                if($selectedpackageservicelist) {

                    $values = explode(',', $selectedpackageservicelist);

                    for($i=0;$i<count($values);$i++) {

                    ?>

                    $(".package_option_"+package_id+" #option_<?php echo $values[$i]?>").prop("checked", !$("#option_1").prop("checked")).change();

                    <?php 

                    }

                }

            ?>

        }



		

    }

}

document.addEventListener("DOMContentLoaded", function () {

    document.querySelectorAll("input[name='package_option[]']").forEach(function (element) {

        element.addEventListener("change", function () {

            if (typeof GetPackageFinalAmount === "function") {

               

                GetPackageFinalAmount();

            }

        });

    });

});







function package_step_submit(package_id) {

	

	const checkbox = document.getElementById('agree_term_condition_checkbox');

    if(!checkbox.checked) {

		console.log("false");

		$("#packagetermconditionmodal").css("display","flex");

        return false;

    }

	

	console.log("True");

	

showLoaderPageLoad('show');

if(package_id) {

    $('input[name="choose-plan1"][value="'+package_id+'"]').prop('checked', true);

    $('input[name="choose-plan2"][value="'+package_id+'"]').prop('checked', true);

}

var userEmail = @json(Auth::user()->email);

let active_tabs = $('.plan-tab.active').text();

var promo_code_id = $('input[name="promo_code_id"]').val();

let plan_id = 0;

let plan_tab = 'monthly';

$(".package-error").hide();



console.log(active_tabs);



if(promo_data.coupon_mode=="holiday") {

	

	plan_id = package_id;

	let tab_name = $('.plan-tab.active').attr("data-tab");

	plan_tab = "twelve-month-tab";

	if(tab_name=="tab3") {

		plan_tab = "four-month";

	}





} else {



	if(active_tabs=="Self") {

		plan_id = $('input[name="choose-plan1"]:checked').val();

	} else {

		plan_id = $('input[name="choose-plan2"]:checked').val();

	}

	

}







if(!plan_id) {

	

    $(".package-error").show();

    return false; 

}  



let package_service_list = $(".package_service_list:checked").filter(function() {

    return $(this).closest('.service-list').is(':visible'); 

}).map(function() {

    return $(this).val();

}).get();



let optional_amount = getPackageOptionalAmount();



console.log("Pack Service List "+package_service_list);

console.log("optional_amount "+optional_amount);



var formData = new FormData();

formData.append("next_step","3");

formData.append("current_step","2");

formData.append("promo_code_id",promo_code_id);

formData.append("select_plan",plan_id);

formData.append("getPlanDetail",plan_id);

formData.append("email",userEmail);

formData.append("plan_tab",plan_tab);

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

		showLoaderPageLoad('hide');

        if(response.original.status){

           console.log(response);

            $("#step3").show();

            $("#step2").hide();

            <?php if(isMobile()) { ?> 

			
                //$("#asking_payment_confirmation").css("display","flex");
			show_tabs(3); 

			

			<?php } ?>    

        } else {

            toastr.error(response.original.message);

        }

        

    },

    error: function(xhr, status, error) {

		showLoaderPageLoad('hide');

        toastr.error("Something went wrong.Please try again.");

    }

});



}

function getPaymentStatus(data) {

	

	let user_final_amount = data.user_final_amount;

	if(user_final_amount < 1) {

		$("#step4 .payment").hide();

		$("#step4 .payment-update").show().html('<p style="margin: 34px 12px 11px 20px;">Please Wait...</p>');

		toastr.info('Please wait...', 'Processing', {

               timeOut: 0,

               extendedTimeOut: 0,

           });

	}



    $.post("{{ url('account-active-coupon-code') }}", {

        action: 'account_active',

        _token: '{{ csrf_token() }}'

    }, function(response) {

        if(response.status){

			location.reload();

		} else {

			toastr.clear();

			toastr.error(response.message);

		}

    });

}



function getFirstBillingDetails(purchaseDate = new Date(), monthlyAmount = 0) {

    const BILLING_DAY = <?php echo config('constants.billing-cycle-date') ?>;

	console.log("BILLING_DAY"+BILLING_DAY);

	

    let billingDate = new Date(purchaseDate);

    let firstChargeAmount = monthlyAmount;

    let extraDays = 0;

    let extraAmount = 0;



    if (purchaseDate.getDate() <= BILLING_DAY) {

        

        billingDate.setDate(BILLING_DAY);



    } else {

        

        billingDate.setMonth(billingDate.getMonth() + 1);

        billingDate.setDate(BILLING_DAY);



        

        let daysInMonth = new Date(

            purchaseDate.getFullYear(),

            purchaseDate.getMonth() + 1,

            0

        ).getDate();



        extraDays = daysInMonth - purchaseDate.getDate();



        let perDayAmount = monthlyAmount / daysInMonth;

        extraAmount = parseFloat((extraDays * perDayAmount).toFixed(2)) ?? '0';



        firstChargeAmount = parseFloat((Number(monthlyAmount) + Number(extraAmount)).toFixed(2));

    }



    // Next billing date (for both cases)

    let nextBillingDate = new Date(billingDate);

    nextBillingDate.setMonth(nextBillingDate.getMonth() + 1);



    return {

        firstBillingDate: formatDate(billingDate),

        nextBillingDate: formatDate(nextBillingDate),

        firstChargeAmount: firstChargeAmount,

        extraDays: extraDays,

        extraAmount: extraAmount

    };

}

function formatDate(date) {

    return date.toLocaleDateString('en-GB', {

        day: '2-digit',

        month: 'long',

        year: 'numeric'

    });

}





</script>


<script>

var package_payment_info = JSON.parse(localStorage.getItem("package_payment_info"));

if(!package_payment_info) {

    package_payment_info = {};

}



var package_amount  = 0; 

        const tabButtons = document.querySelectorAll('.tab-button');

        const tabPanels = document.querySelectorAll('.tab-panel');

        tabButtons.forEach(button => {

            button.addEventListener('click', () => {

                tabButtons.forEach(btn => btn.classList.remove('active'));

                tabPanels.forEach(panel => panel.classList.remove('active'));

                button.classList.add('active');

                document.getElementById(button.dataset.tab).classList.add('active');

				

				

				$('.agree_term_condition_checkbox').prop('checked', false);

				$('.user_agree_term_condition').prop('checked', false);

				$(".user_agree_term_condition").prop('disabled', false);

	

				const activeTabValue = button.dataset.tab;

				console.log(activeTabValue);

				if(activeTabValue=="self") {

					package_details(1,'');

				} else if(activeTabValue=="four-month") {

					package_details(13,'');

				} else if(activeTabValue=="twelve-month") {

					package_details(15,'');

				} else {

					package_details(2,'');

				}

		

            });

        });

        const radioWrappers = document.querySelectorAll('.radio-wrapper');

        radioWrappers.forEach(wrapper => {

            const radio = wrapper.querySelector('input[type="radio"]');

            radio.addEventListener('change', () => {

                radioWrappers.forEach(w => w.classList.remove('active'));

                if (radio.checked) {

                    wrapper.classList.add('active');

                }

            });

        });



function getPackageOptionalAmount(){

    return  $("input[name='package_option[]']:checked").map(function() {

            return Number($(this).attr("price")); 

        }).get().reduce((sum, price) => sum + price, 0);

} 



function GetPackageFinalAmount() {

    





    let package_amount_show = package_amount;



    let package_discount_amount = promo_data.member_discount_type == "fixed" ? promo_data.member_discount_amount : (package_amount_show * promo_data.member_discount_amount / 100).toFixed(2);

    

	if(promo_data.coupon_mode=="holiday") {

		package_discount_amount = 0;

	}	

    //let package_discount_amount = $("#package_discount_amount").val();

    let html = "";

    

    let optional_amount = getPackageOptionalAmount();

    



    if(optional_amount) {



        html += '<div class="total-row"><p>Subtotal:</p><p>$'+package_amount+'</p></div>';

        html +='<div class="total-row"><p>Optional:</p><p>$'+optional_amount+'</p></div>';

        package_amount_show = parseFloat((Number(package_amount) + Number(optional_amount)).toFixed(2));

    }

    

    if(package_discount_amount > 0 ) {

        html += '<div class="total-row"><p>Promo Code Discount:</p><p>$'+package_discount_amount+'</p></div>';

        package_amount_show -= package_discount_amount;

    }

   

    

    html +='<div class="total-row total-amount"><p>Total Price:</p><p>$'+parseFloat(package_amount_show).toFixed(2)+'</p></div>';

    

	



	let purchaseDate = new Date();

	purchaseDate.setDate(purchaseDate.getDate() + <?php echo config('constants.add_extra_days') ?>);

	

	

	let billingDate = getFirstBillingDate(purchaseDate);

	let billingDate_info = getFirstBillingDetails(purchaseDate,package_amount_show);

	



	

	

	

	

	let checkout_update=getCheckoutUpdate(billingDate_info);

	$(".checkout-update").html(checkout_update);

	html += checkout_update;

	

		

	



	

		

	



    $(".subtotal-pay").html(html);

    $(".subtotal-pay-list").html('$'+parseFloat(package_amount_show).toFixed(2)+'');

	$(".total-paying-amount").html('$'+parseFloat(package_amount_show).toFixed(2)+'');

	

	

}

function getCheckoutUpdate(billingDate_info) {

	

	let html_section="";

		html_section += '<div class="pay-update-info"><div class="card shadow-sm mt-3" style="border-radius:12px;"><div class="card-body">';

		

		@if(config('constants.pro_data_status') === 'active')

			

			html_section += '<div class="alert alert-info d-flex align-items-center mb-4" style="border-radius:8px;"><i class="fas fa-calendar-alt me-2"></i><div><strong>Next Billing Date:</strong><span class="ms-1">'+billingDate_info.firstBillingDate+'</span></div></div>';

					if(billingDate_info.extraDays) {

						

						html_section += '<div class="pro_rata_days"><div class="rata_pro_title"><p>With Pro Data:-</p></div><div class="rata_input"><div class="pro_input_radio"><input type="radio" id="ProRataPay" name="pro-rata" checked><label for="ProRataPay">Yes</label></div><div class="pro_input_radio"><input type="radio" id="NextNonthPay" name="pro-rata"><label for="NextNonthPay">No</label></div></div></div>';

						

						

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

	

	html_section += '<div class="custom-checkbox_new mt-2"><div id="" class="chek-s1 service-list" style=""><input type="checkbox" class="agree_terms1 user_agree_term_condition" id="agree_terms1" '+checkbox_status_html+' '+disabled_status+'><label for="agree_terms1" class="checkbox-container"><span></span><div><p>Review and agree to the Terms and Conditions and Privacy Policy.</p></div></label></div></div>';	

	html_section += '</div></div></div>';

	return html_section;

	

}

function getFirstBillingDetails(purchaseDate = new Date(), monthlyAmount = 0) {

    const BILLING_DAY = <?php echo config('constants.billing-cycle-date') ?>;

		

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





function getFirstBillingDate(purchaseDate = new Date()) {

  

}



function formatDate(date) {

    return date.toLocaleDateString('en-GB', {

        day: '2-digit',

        month: 'long',

        year: 'numeric'

    });

}

		

function package_details(package_id,request_type){

	

	if(promo_data.coupon_mode=="holiday") {

		

		if(package_id==13 || package_id==15) {

			$(".service-list-name").html("Primary Care + Mental Health Care");

		} else if(package_id==14 || package_id==16) {

			$(".service-list-name").html("Primary Care + Mental Health Care + Prescription Plan");

		}

		

	}

	

	

	$(".plan-info-list").removeClass("active card");

	$(".plan-info-"+package_id).addClass("active card");

	

	package_payment_info.package_id = package_id;

	localStorage.setItem("package_payment_info", JSON.stringify(package_payment_info));



	$(".get-started-button").attr("onclick","package_step_submit("+package_id+")");

	$('input[name="package_name"][value="'+package_id+'"]').prop('checked', true);

	$(".package_include").hide();

    $(".package_include_"+package_id).show();

	

	

	//$(".service-list-include").removeClass("active").addClass("no-feature");

	//$(".service-list-include-"+package_id).removeClass("no-feature ").addClass(" check-ic active");

	

	$(".package_option_"+package_id).show();

	 

	let plan_amount = package_amount = $(".plan-info-"+package_id+" .plan-amount").val(); 

	$('input[name="package_option[]"]').prop('checked', false).change();

	

	if(request_type=="pack-detail") {

		let package_payment_info2 = JSON.parse(localStorage.getItem("package_payment_info"))

		package_payment_info2.optional_service = [];

		localStorage.setItem("package_payment_info", JSON.stringify(package_payment_info2));

	}

	GetPackageFinalAmount();

}





setTimeout(function() {

	

	let package_payment_info = JSON.parse(localStorage.getItem("package_payment_info"));

	let packageId = (package_payment_info && package_payment_info.package_id) || '1';

	

	<?php if($plan_info) {?>

	

		<?php if($plan_info->plan_id%2==0) { ?>

			$(".self-family-tab").trigger("click");	

		<?php }?>

		

		package_details(<?php echo $plan_info->plan_id?>,'');

		$(".plan-info-<?php echo $plan_info->plan_id?>").addClass("current-package");

		

	<?php } else { ?>

		package_details(packageId,'');

	<?php } ?>

    

	

	if(package_payment_info.optional_service){

		

		 for(var i=0;i < package_payment_info.optional_service.length; i++) {

			

			let optional_id = package_payment_info.optional_service[i].optional_id;

			$('.addon-features input[value="'+optional_id+'"]').prop('checked', true).trigger('change');

			

		} 

	}

	GetPackageFinalAmount();

},1000);	



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

	

	if(!$('#agree_terms1').is(':checked')) {

		

		$("#packagetermconditionmodal").modal({backdrop: 'static',keyboard: false}).modal("show");

		return false;

	}

	

	

	

	let plan_tab = $(".tab-button.active").attr("data-tab");

	var userEmail = @json(Auth::user()->email);

	let active_tabs = $('.plan-tab.active').text();

	var promo_code_id = $('input[name="promo_code_id"]').val();

	let plan_id = package_id;  

	

    

    let package_service_list = $(".package_service_list:checked").filter(function() {

            return $(this).closest('.service-list').is(':visible');

        }).map(function() {

            return $(this).val();

        }).get();

    

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

        formData.append("plan_tab",plan_tab);

        

        let optional_service = $("input[name='package_option[]']:checked").map(function() {

                return $(this).val(); 

            }).get();



        formData.append("optional_service",optional_service);  

        $.ajax({

            url: "{{ route('updateStep') }}", 

            type: 'POST',

            data: formData,

            dataType: 'json',

            processData: false,  

            contentType: false, 

            headers: {

                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

            },

            success: function(response) {

				//alert(response);

                if(response.original.status){

					$(".user-package-list").hide();

					$(".user-holidy-list").hide();

					$(".user-invoice-section").show();

                    

					const url = new URL(window.location);

					url.searchParams.set('active-tab', 'invoice');

					window.history.pushState({}, '', url);

					

					

                } else {

                    toastr.error(response.original.message);

                }

                

            },

            error: function(xhr, status, error) {

                

            }

    });

}

function backToScreen(request_type) {

	

	const url = new URL(window.location);			

	if(request_type=="payment") {

		$(".user-invoice-section").show();

		$(".user-payment-section").hide();

		url.searchParams.set('active-tab', 'invoice');

	} else if(request_type=="invoice") {

		

		

		

		

		$(".user-invoice-section").hide();

		if(promo_data.coupon_mode=="holiday") {

			$(".user-holidy-list").show();

		} else {

			$(".user-package-list").show();

		}

		url.searchParams.set('active-tab', 'package');

		

	}

	window.history.pushState({}, '', url);

}



const url = new URL(window.location);

url.searchParams.set('active-tab', '{{ request('active-tab', 'package') }}');

window.history.pushState({}, '', url);

</script>

@push('scripts')

<script>

$(function() {

	



$('.addon-features input[type="checkbox"]').on('change', function () {



    // Get localStorage or initialize

    let package_payment_info = JSON.parse(localStorage.getItem("package_payment_info")) || {};



    // Ensure optional_service is an array

    if (!Array.isArray(package_payment_info.optional_service)) {

        package_payment_info.optional_service = [];

    }



    let optional_id = $(this).val();



    if ($(this).is(':checked')) {

        // Checkbox is checked — add or update

        let newData = { optional_id: optional_id };



        let existingIndex = package_payment_info.optional_service.findIndex(

            item => item.optional_id == optional_id

        );



        if (existingIndex !== -1) {

            package_payment_info.optional_service[existingIndex] = newData;

        } else {

            package_payment_info.optional_service.push(newData);

        }



    } else {

        // Checkbox is unchecked — remove from array

        package_payment_info.optional_service = package_payment_info.optional_service.filter(

            item => item.optional_id != optional_id

        );

    }



    // Save back to localStorage

    localStorage.setItem("package_payment_info", JSON.stringify(package_payment_info));



    // Optional: debug output

    



});



$('#inputPromoCode').on('keydown', function(event) {

    const maxLength = 15;

    if (event.key === "Enter") {

        event.preventDefault();

        $('.promo-code-apply-btn').click();

    }

    if ($(this).val().length >= maxLength && event.key.length === 1 && !event.ctrlKey && !event.metaKey) {

        event.preventDefault();

		$(".promo-error").html('Maximum 15 characters allowed.').show();

        //toastr.error("Maximum 15 characters allowed.");

    }

});

});

</script>

@endpush
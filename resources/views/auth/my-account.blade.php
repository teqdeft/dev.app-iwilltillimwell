@extends('layouts.dashboard')
@section('content')
<style>
    .switch {
      position: relative;
      display: inline-block;
      width: 60px;
      height: 34px;
    }
    
    .switch input { 
      opacity: 0;
      width: 0;
      height: 0;
    }
    
    .slider {
      position: absolute;
      cursor: pointer;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background-color: #ccc;
      -webkit-transition: .4s;
      transition: .4s;
    }
    
    .slider:before {
      position: absolute;
      content: "";
      height: 26px;
      width: 26px;
      left: 4px;
      bottom: 4px;
      background-color: white;
      -webkit-transition: .4s;
      transition: .4s;
    }
    
    input:checked + .slider {
      background-color: #2196F3;
    }
    
    input:focus + .slider {
      box-shadow: 0 0 1px #2196F3;
    }
    
    input:checked + .slider:before {
      -webkit-transform: translateX(26px);
      -ms-transform: translateX(26px);
      transform: translateX(26px);
    }
    
    /* Rounded sliders */
    .slider.round {
      border-radius: 34px;
    }
    
    .slider.round:before {
      border-radius: 50%;
    }
    #manage-membership label{
    margin-bottom: 0px;
}
.pro-rata-cell {
    font-size: 12px;
    line-height: 1.4;
}
.pro-rata-cell strong {
    font-size: 13px;
}
.final-amount-box {
    line-height: 1.3;
}

.amount-main {
    font-size: 16px;
    font-weight: 700;
    color: #2c2c2c;
}

</style>
<div class="main-panel">
    <div class="content-wrapper account-details-mainv1">
        <div class="row">
            <div class="col-md-12 grid-margin">
                <div class="row">
                    <div class="col-12 col-xl-6 mb-4 mb-xl-0">
                        <div class="patient-details ">
                            <div class="media">
                                <div class="title-heading-icon-box-cus">
                                    <i class="far fa-user"></i>
                                </div>
                                <div class="media-body">
                                    <h3 class="font-weight-bold">My Account Details</h3>
                                    <h6 class="font-weight-normal mb-0">Manage Your Account</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card card-body">
                    <div class="all-consultations-box  p-3">
                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs" role="tablist" id="myTab">
                            <li class="nav-item ">
                                <a class="nav-link active" data-toggle="tab" href="#personal-info"><i
                                        class="far fa-address-card mr-2"></i> Personal Info</a>
                            </li>
                            @if(!Auth::user()->parentId)
								<li class="nav-item">
									<a class="nav-link" data-toggle="tab" href="#dependents">
										<i class="fas fa-user-friends mr-2 "></i> Dependents
									</a>
								</li>
							@endif

                           
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#pharmacy"><i class="fas fa-pills mr-2"></i>
                                    Pharmacy</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#password-management"><i
                                        class="fas fa-unlock-alt mr-2"></i> Password Management</a>
                            </li>
                            
							@if(!Auth::user()->parentId)
								<li class="nav-item">
									<a class="nav-link" data-toggle="tab" href="#supporters">
										<i class="far fa-calendar-check mr-2"></i> Manage Supporters
									</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" data-toggle="tab" href="#manage-membership"><i class="far fa-calendar-check mr-2"></i> Manage Membership</a>
								</li>
							@endif
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#manage-transaction" onclick="setTabParam('manage-transaction')"><i class="far fa-calendar-check mr-2"></i> Transaction History</a>
                            </li>
                            
                        </ul>
                        <!-- Tab panes -->
                        <div class="tab-content pt-1 account_details_form">

<?php 
$plan_info = getMyCurrentPlanRecords(Auth::user()->id);
?>
						
							@include('auth.my-account-personal-info')
							@include('auth.manage-supporters')
							@include('auth.manage-transaction-history')
							@include('auth.manage-change-password')
							@include('auth.manage-pharmacy-section')
							@include('auth.manage-dependents-section')
                        @if(isset($subscription_info) )                                    
                            @include('auth.membership')
                        @endif
                    
                    </div>
                </div>
            </div>
        </div>
    </div>

<script type="text/javascript">
    const form = document.getElementById('payment-form');
    
     form.addEventListener('submit', event => {
    });
    
    
    
    const validateCardNumber = number => {
    //Check if the number contains only numeric value  
    //and is of between 13 to 19 digits
    const regex = new RegExp("^[0-9]{13,19}$");
    if (!regex.test(number)){
        return false;
    }
  
    return luhnCheck(number);
}
const luhnCheck = val => {
}
    
    
const checkCreditCard = cardnumber => {
}
function validLength(input,max_number) {
    let value = input.value.replace(/\D/g, ''); // Remove any non-digit characters
    if (value.length > max_number) {
        value = value.substring(0, max_number); // Ensure the length doesn't exceed 10 digits
    }
    input.value = value; // Set the value back to the input
}


document.addEventListener("DOMContentLoaded", function () {
    
    function getQueryParam(name) {
        let urlParams = new URLSearchParams(window.location.search);
        return urlParams.get(name);
    }

    let activeTab = getQueryParam("active-tab");
    if (activeTab) {
		setTimeout(function(){ 
			console.log("Here");
			let tabLink = document.querySelector('#myTab a[href="#' + activeTab + '"]');
			if (tabLink) {
				
				$('#myTab a.nav-link').removeClass('active');
				$('.tab-pane').removeClass('active show');
				$(tabLink).tab('show');
			}
		},900);
    } else {
				setTimeout(function(){ 

		$('#myTab li:first-child a').trigger('click');
		}, 200);
			console.log("No Active Tab");
		
	}
    $('#myTab a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
        let target = $(e.target).attr("href").substring(1);
        let url = new URL(window.location);
        url.searchParams.set("active-tab", target);
        history.replaceState(null, null, url);
    });
});


function addNewDependent() {	$(".add-new-dependent-tab").addClass("active").removeClass("d-none");	$(".add-new-dependent-content").addClass("active show").removeClass("d-none");
}
function changeEmailDependent(){
	$(".email-section").toggle();
}
function setTabParam(tab) {
    const url = new URL(window.location);
    url.searchParams.set("active-tab", tab);
    window.history.replaceState(null, "", url.toString());
}
</script>


</div>
</div>

@push('scripts')
<link rel="stylesheet" href="https://code.jquery.com/ui/1.14.2/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="https://code.jquery.com/ui/1.14.2/jquery-ui.js"></script>

<script>
$(function(){    

	$( "#date_of_birth_calendar" ).datepicker({	changeYear: true, maxDate: 0 , yearRange: "-70:+0" 	});
    $( "#dependent_dob_add" ).datepicker({	changeYear: true, maxDate: 0, yearRange: "-70:+0" 	});

    
	
	$("#account-update-password-form").on("submit", function (e) {

        let isValid = true;

        // remove old errors
        $(".error").remove();

        let current_password = $("#current_password").val().trim();
        let password = $("#password").val().trim();
        let confirm_password = $("#password-confirm").val().trim();

        // Old Password
        if (current_password === "") {
            $("#current_password").after('<span class="error">Please enter old password</span>');
            isValid = false;
        }

        // New Password
        if (password === "") {
            $("#password").after('<span class="error">Please enter new password</span>');
            isValid = false;
        } else if (password.length < 6) {
            $("#password").after('<span class="error">Password must be at least 6 characters</span>');
            isValid = false;
        }

        // Confirm Password
        if (confirm_password === "") {
            $("#password-confirm").after('<span class="error">Please confirm password</span>');
            isValid = false;
        } else if (password !== confirm_password) {
            $("#password-confirm").after('<span class="error">Passwords do not match</span>');
            isValid = false;
        }

        // stop form submit if invalid
        if (!isValid) {
            e.preventDefault();
        }

    });
	
});

</script>  

@endpush
@endsection

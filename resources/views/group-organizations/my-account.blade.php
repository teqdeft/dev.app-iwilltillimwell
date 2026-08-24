@extends('layouts.group-organizations')
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
    </style>
<div class="main-panel-"> 
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
                 
                        <div class="tab-content pt-1">

<?php 
$plan_info = getMyCurrentPlanRecords(Auth::user()->id);
?>
						
							@include('auth.my-account-personal-info')
							
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


function addNewDependent() {
	$(".add-new-dependent-content").addClass("active show");
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

@endsection
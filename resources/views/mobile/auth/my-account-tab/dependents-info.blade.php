<div id="dependents-info" class="tab-content">
    <div class="midical-form v1 detail">
        
        <div class="edit-det-row">
            <div class="form-title detail"><p>Manage Dependents and other Household users</p></div>
        </div>

        <div class="edit-tab-content">
                <p>Here you can add and edit your dependent information.</p>
                <p>You may add up to 7 dependents. Your spouse and any dependents over 18 years of age will receive a registration email and must register to use the system. Your spouse will have access to all of your dependents records who are under the age of 18 but
                will not have access to your records or any dependents records who are over the age
                of 18.</p>
        </div>

        <div class="add-dependent">
            <button class="primary-button" onclick="showaddeditform(0)">
                                    <span>
                                        <svg width="28" height="28" viewBox="0 0 28 28" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M14 26.25C7.245 26.25 1.75 20.755 1.75 14C1.75 7.245 7.245 1.75 14 1.75C20.755 1.75 26.25 7.245 26.25 14C26.25 20.755 20.755 26.25 14 26.25ZM14 3.5C8.2075 3.5 3.5 8.2075 3.5 14C3.5 19.7925 8.2075 24.5 14 24.5C19.7925 24.5 24.5 19.7925 24.5 14C24.5 8.2075 19.7925 3.5 14 3.5Z"
                                                fill="#fff" />
                                            <path
                                                d="M14 20.125C13.51 20.125 13.125 19.74 13.125 19.25V8.75C13.125 8.26 13.51 7.875 14 7.875C14.49 7.875 14.875 8.26 14.875 8.75V19.25C14.875 19.74 14.49 20.125 14 20.125Z"
                                                fill="#fff" />
                                            <path
                                                d="M19.25 14.875H8.75C8.26 14.875 7.875 14.49 7.875 14C7.875 13.51 8.26 13.125 8.75 13.125H19.25C19.74 13.125 20.125 13.51 20.125 14C20.125 14.49 19.74 14.875 19.25 14.875Z"
                                                fill="#fff" />
                                        </svg>
                                    </span>
                                    <span>
                                    Add A Dependent
                                    </span>
            </button>
        </div>

        <div class="add-dependent-content">
            @include('mobile.auth.my-account-tab.dependents-info-list')   
            @include('mobile.auth.my-account-tab.dependents-info-add') 
        </div>
    </div>

<script>
function showaddeditform(id) {

    let url = "{{ route('add-dependent') }}";
    $("#add-dependent-form")[0].reset();

    $("#add-dependent-form").find(".error").each(function() {
        if ($(this).is("span")) {
            $(this).hide();
        } else if ($(this).is("input")) {
            console.log("Input");
            $(this).removeClass("error"); 
            $(this).val(""); 
        }
    });


    $(".showaddeditform").show();
    $('html, body').animate({
            scrollTop: $('.showaddeditform').offset().top
        }, 100); // 1000 is the duration of the scroll in milliseconds (1 second)
    $("#dependent-id").val(id); 
	if(!id) {
		$(".dependent-eighteen-below").show();
	}	
    if(id) {
        url = "{{ route('update-dependent')}}";
        let data_dependent = $("#dependent-"+id).attr('data-dependent'); 
        data_dependent = JSON.parse(data_dependent);
        console.log(data_dependent.gender);

        $("#relationship").val(data_dependent.relationship);
        $("#fname").val(data_dependent.fname);
        $("#lname").val(data_dependent.lname);
        $("#dependent_dob").val(data_dependent.dob);
        $("#gender-department").val(data_dependent.gender);
        $("#primaryPhone").val(data_dependent.primaryPhone);
        $("#secondaryPhone").val(data_dependent.secondaryPhone);
        $("#address").val(data_dependent.address);
        $("#address2").val(data_dependent.address2);
        $("#city").val(data_dependent.city);
        $("#stateid").val(data_dependent.stateid);
        $("#zipCode").val(data_dependent.zipCode);
        $("#timezoneId").val(data_dependent.timezoneId);
        $("#resend_email").val(data_dependent.email);
        $("#change_email_id").val(data_dependent.email);
        
		$(".relationship-btn").attr("onclick","DPChangeRelationship("+id+")");
		$(".dependent-status").attr("onclick","DependenChangeStatus("+id+")");
		$(".resend-email-btn").attr("onclick","DependentResendEmail("+id+")");
		
		let dependent_age = $("#dependent-age-"+id).val();
		$(".dependent-section").hide();
		$("."+dependent_age).show();
		
    }    
    $("#add-dependent-form").attr("action",url);   
}


/*
$(document).ready(function() {
    $('#dependent_dob').datepicker(pickerOptsGeneral).on('changeDate', function(ev) {
            let dob = new Date(ev.date);
            let today = new Date();
            let age = Math.floor((today - dob) / (365.25 * 24 * 60 * 60 * 1000));
            console.log(age);
            if (age > 18) {
                $(".dependent-email-cnt").show();
            } else {
                $(".dependent-email-cnt").hide();
            }
        });
});
*/
function DependenChangeStatus(id){
	
	let change_status_url = $("#dependent-status-"+id).val();
	let dependent_status = $("#dependent-status").val();
	if(dependent_status=="") {
		toastr.error("Status is required");
		return false;
	}
	showLoaderPageLoad('show');
	$.post({
		url:change_status_url,
		data: {
			_token: $('meta[name="csrf-token"]').attr("content"),
			status:dependent_status
		},
		success: function (response) {
			showLoaderPageLoad('hide');
			if(response.status) {
				toastr.success(response.message);
			} else {
				toastr.error(response.message);
			}
		},
		error: function (xhr) {
			showLoaderPageLoad('hide');
			toastr.error(xhr.responseText);
		}
	});
	
}

function DPChangeRelationship(id) {
	
	
	let relationship_url = $("#dependent-relationship-"+id).val();
	let dependent_relationship = $("#dependent-relationship").val();
	if(dependent_relationship=="") {
		toastr.error("Relationship is required");
		return false;
	}
	showLoaderPageLoad('show');
	$.post({
		url:relationship_url,
		data: {
			_token: $('meta[name="csrf-token"]').attr("content"),
			relationship:dependent_relationship
		},
		success: function (response) {
			showLoaderPageLoad('hide');
			if(response.status) {
				toastr.success(response.message);
			} else {
				toastr.error(response.message);
			}
		},
		error: function (xhr) {
			showLoaderPageLoad('hide');
			toastr.error(xhr.responseText);
		}
	});
}
function DependentResendEmail(id) {
	
	
	let relationship_url = $("#dependent-resend-email-"+id).val();
	let resend_email = $("#resend_email").val();
	if(resend_email=="") {
		toastr.error("Email can't blank");
		return false;
	}
	showLoaderPageLoad('show');
	$.post({
		url:relationship_url,
		data: {
			_token: $('meta[name="csrf-token"]').attr("content")
		},
		success: function (response) {
			showLoaderPageLoad('hide');
			if(response.status) {
				toastr.success(response.message);
			} else {
				toastr.error(response.message);
			}
		},
		error: function (xhr) {
			showLoaderPageLoad('hide');
			toastr.error(xhr.responseText);
		}
	});
}
function changeEmailDependent(){
	$(".email-section").toggle();
}
</script>    
</div>

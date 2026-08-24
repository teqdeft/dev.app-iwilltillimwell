@if(Request::segment(3) == 'step-3')
@php
    $scheduleUrl = url('/schedule-consultation/' . Request::segment(2) . '/step-2/' . Request::segment(4)) . '?action=' . request('action');
    $nextUrl = url('/schedule-consultation/' . Request::segment(2) . '/step-4/' . Request::segment(4)) . '?action=' . request('action');
@endphp
    <div id="phone-tab" class="tab-content">
        
        <div class="patient-tab-content phone-tab-content">
            <div class="pat-title">
                <p>By-Appointment Medical Questionnaire for {{ $user ? $user->fname.' '.$user->lname : '' }}</p>
            </div>
            <div class="sub-detail">
               
                <p>You are about to schedule a diagnostic telephone consultation with a licensed physician. Diagnostic consultations involve detailed discussions to review symptoms, diagnose common conditions, and prescribe medications when appropriate.</p>

            </div>
            <?php $consultation_id = $consultation ? $consultation->id : "" ?>            
            <div class="quest-form">
                <div class="form">
                    <form action="{{ route('update.consultation', $consultation_id) }}" method="POST" id="select-consulation">
                        @csrf
                         <div class="form-row">
                        
                        <div class="col-100 form-group">
                            <label>Phone number</label>
                            <input class="form-control" type="number" id="phone" name="phoneNumber" value="{{ $user ? $user->primaryPhone : '' }}" required onkeyup="lengthValidation(this,'10')">
                            <input type="hidden" value="<?php echo request('action')?>" name="action_type" />
                        </div>
                        <div class="col-100 form-group" style="display:none;">
                            <label>Service</label>
                            <?php $roi = Config::get('constants.roi'); ?>
							@php
								$action = request('action');
							@endphp
                            <select class="form-control theme-select mx-select" name="roi" required>

                                @if($action === 'urgentcare')
									<option value="Urgent Care">Go to Urgent Care</option>
								@elseif($action === 'primarycare')
									<option value="Primary Care">Go to Primary Care</option>
								@elseif($action === 'dermatology')
									<option value="Dermatology">Go to Dermatology</option>
								@elseif($action === 'psychology')
									<option value="psychology">Go to Psychology</option>
								@elseif($action === 'psychiatry')
									<option value="psychiatry">Go to Psychiatry</option>
								@endif

                                

                           </select>

                        </div>
                        
                        <div class="col-100 cta">
                            <div class="recorc-cta" style="width: 100%;">
                                <a href="{{ $scheduleUrl }}" class="outline-button showLoaderPageLoad">Back</a>
                                <button type="button" class="primary-button" onclick="next_screen()">Next</button>
                            </div>   
                        </div>
                        <input type="hidden" name="next-step" value="step-4" />
                    </div>
                </form>
                </div>
            </div>
        </div>
		
		@include('mobile.consultation.schedule-consultation-step.reason-visite-content')
		
		

    </div>
<script>
$(function(){
    $(".schedule-consultation .back-btn").attr("href", "{{ $scheduleUrl }}");
	if(scheduleConsultation.phoneNumber) {
		$("#phone").val(scheduleConsultation.phoneNumber);
	}
	if(scheduleConsultation.reason_for_visit) {
		$("#reason_for_visit").val(scheduleConsultation.reason_for_visit);
	}
	if(Array.isArray(scheduleConsultation.dermatology)) {
		delete scheduleConsultation.dermatology;
		localStorage.setItem("scheduleConsultation", JSON.stringify(scheduleConsultation));
	}
});
function backtophone(){
	$(".phone-tab-content").show();
	$(".reason-visite-content").hide();
}
function next_screen(){
	
	var phone = $("#phone").val().trim();
	if (phone === "") {
		toastr.error("Phone number is required");
		return false;
	}
	if(phone.length < 10) {
		toastr.error("Phone number must be at least 10 digits");
		return false;
	}
	
	scheduleConsultation.phoneNumber = $("#phone").val();
	localStorage.setItem("scheduleConsultation", JSON.stringify(scheduleConsultation));
	//window.location.href="{{ $nextUrl }}";
	
	$(".phone-tab-content").hide();
	$(".reason-visite-content").show();
}
function reasonforvisitSubmit(){
	
	let reason_for_visit = $("#reason_for_visit").val(); 
	if(!reason_for_visit) {
		toastr.error("Describe Reason Please ");
		return false;
	}
	
	<?php if($action === 'dermatology') { ?>
	
		let scheduleConsultation = JSON.parse(localStorage.getItem("scheduleConsultation")) || {};
		
		if(!Array.isArray(scheduleConsultation.dermatology) || scheduleConsultation.dermatology.length < 2) {
			toastr.error("Please upload a minimum of 2 images");
			return false;
		}
	
	<?php } ?>
	
	showLoaderPageLoad('show');
	scheduleConsultation.reason_for_visit = $("#reason_for_visit").val();
	localStorage.setItem("scheduleConsultation", JSON.stringify(scheduleConsultation));
	window.location.href="{{ $nextUrl }}";
}

</script>  

<script>
$(document).ready(function () {
    $("#image").on("change", function () {
        uploadImage(this);
    }); 
});
$(document).on("click", ".img-remove-section a", function (e) {
    e.preventDefault(); 
	let attachmentId = $(this).attr("attachmentId");
    $(this).closest('.d-upload-status').remove();
	let scheduleConsultation = JSON.parse(localStorage.getItem("scheduleConsultation")) || {};
	if (Array.isArray(scheduleConsultation.dermatology)) {
		
		scheduleConsultation.dermatology = scheduleConsultation.dermatology.filter(id => id != attachmentId);
		localStorage.setItem("scheduleConsultation", JSON.stringify(scheduleConsultation));
	}

});
	

function uploadImage(input) {
    if (input.files && input.files[0]) {
        let formData = new FormData();
        formData.append("image", input.files[0]);
        formData.append("_token", "{{ csrf_token() }}");

        // Show and reset progress bar
        $(".progress").show();
        $("#uploadProgress").css("width", "0%").text("0%");

        $.ajax({
            url: "{{ route('DermatologyUploadImg') }}",
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            xhr: function () {
                let xhr = new window.XMLHttpRequest();
                xhr.upload.addEventListener("progress", function (e) {
                    if (e.lengthComputable) {
                        let percent = Math.round((e.loaded / e.total) * 100);
                        $("#uploadProgress").css("width", percent + "%").text(percent + "%");
                    }
                }, false);
                return xhr;
            },
            beforeSend: function () {
                $("#uploadStatus").html('');
            },
            success: function (response) {
				
				let url_img = response.url;
				let attachmentId = response.attachmentId;
				if(!scheduleConsultation.dermatology) {
						scheduleConsultation.dermatology = [];
				}
				scheduleConsultation.dermatology.push(attachmentId);
				localStorage.setItem("scheduleConsultation", JSON.stringify(scheduleConsultation));
				
				
				$("#uploadStatus").html('');
				$("#uploadStatus_html").append('<div class="d-upload-status"><div class="img-section"><img src="'+url_img+'"  /></div><div class="img-remove-section"><a href="javascript:void(0)">X</a></div></div>');
				
				$(".progress").hide();
				$(input).val('');
				$("#uploadProgress").css("width", "0%").text("0%");
				
            },
            error: function (xhr) {
                $("#uploadStatus").html(`<p class="text-danger">Error: ${xhr.responseJSON.message}</p>`);
                $(".progress").hide();
            }
        });
    }
}
</script>  
@endif   
@if(Request::segment(3) == 'step-3')
@php
    $scheduleUrl = url('/schedule-consultation/' . Request::segment(2) . '/step-2/' . Request::segment(4)) . '?action=' . request('action');
    $nextUrl = url('/schedule-consultation/' . Request::segment(2) . '/step-4/' . Request::segment(4)) . '?action=' . request('action');
@endphp

<div role="tabpanel"
	class="tab-pane {{ (Request::segment(3) == 'step-3') ? 'active' : '' }}"
	id="optimization">
	<div class="design-process-content phone-tab-content">

                                             <h3 class="semi-bold">By-Appointment Medical Questionnaire for 

                                                 {{ $user ? $user->fname.' '.$user->lname : '' }}</h3>

    <p>You are about to schedule a diagnostic telephone consultation with a licensed physician. Diagnostic consultations involve detailed discussions to review symptoms, diagnose common conditions, and prescribe medications when appropriate.</p>
											 
					<form action="{{ route('update.consultation', $consultation_id) }}" method="POST" id="select-consulation">

                                         @csrf
                                             <div class=" my-3">

                                                 <h4>Please verify that this is the phone number where we can reach you.</h4>

                                                 <div class="inputWithIcon inputIconBg">

                                                     <input type="tel" id="phone" name="phoneNumber"

                                                         value="{{ $user ? $user->primaryPhone : '' }}" 
														 onkeyup="LengthValidation(this,'10')"
														 required>

                                                     <i class="fas fa-phone-alt" aria-hidden="true"></i>

                                                     </br>

                                                     <!--  <a href="#0" class="fs-12 d-block w-100 theme-link-txt1" > <span>Click here to add an International Phone Number</span></a> -->

                                                 </div>

                                             </div>

                                             <div class="" style="display:none;">

                                                 <h4 class="mb-3">What would you have done if you hadn’t had this service?</h4>

                                                 <div class="form-group">

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

                                             </div>

                                             <input type="hidden" name="next-step" value="step-4" />

                                             <div class="d-flex justify-content-between btn-group-box mt-5 ">
							<a class="outline-button back-btn" ><i class="fa fa-chevron-left fa-arrow-icon fa-arrow-icon-back"></i> Back</a>
							
							
                                                 <button type="button" class="btn btn-primary mr-3" onclick="next_screen()">Next <i class="fa fa-chevron-right fa-arrow-icon"></i></button>

                                     </form>

                                     

                                    

                                     <form method="post" id="cancel-consultation-form-{{$consultation_id}}"

                                         action="{{ route('consultations.cancel',$consultation) }}"

                                         style="display:none">

                                         @csrf

                                         @method('DELETE')

                                     </form>

        </div>
    </div>
	
	<div class="design-process-content">
		<div class="patient-tab-content  reason-visite-content" style="display:none">
			<div class="pat-title"><p>What Is the Reason for Today’s Visit?</p></div>
			
			<form id="uploadForm" enctype="multipart/form-data">
				@csrf
				<div class="col-100 form-group" style="display: grid;">
<label>Please describe the reason(s) in detail.<span class="required-ico">*</span></label>
					<textarea placeholder="(required)" rows="5" id="reason_for_visit"></textarea>
				</div>
				@if($action === 'dermatology')
					
					<div class="dermat-main-v1">
						<div class="dermat-title">
							<p>Please upload at least two images (JPG, PNG, JPEG).</p>
						</div>
						<div class="dermatology-img-section">
							<div class="col-100 form-group">
								<div class="image-group">
									<div id="uploadStatus_html"></div>
								</div>
								<div class="upload-file">
									<input type="file" name="image" id="image" accept=".jpg,.jpeg,.png" required>
								</div>
								<div class="progres-area">
									<div class="progress mt-2" style="height: 20px; display: none;">
										<div id="uploadProgress" class="progress-bar" role="progressbar" style="width: 0%">0%</div>
									</div>
								</div>
								<div class="error-message">
									<div id="uploadStatus"></div>
								</div>
							</div>
						</div>
					</div>
					
				@endif
				<div class="col-100 cta mt-2">
					<div class="recorc-cta" style="width: 100%; display: flex; justify-content: space-between; align-items: center;">
						
						<a href="javascript:void(0)" class="outline-button back-btn" onclick="backtophone()"><i class="fa fa-chevron-left fa-arrow-icon fa-arrow-icon-back"></i> Back </a>
						
						<button class="btn btn-primary mr-3" type="button" onclick="return reasonforvisitSubmit()"> Next <i class="fa fa-chevron-right fa-arrow-icon"></i></button>
					
					</div>
				</div>
			</form>
			
		</div>
	</div>
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
	
	let phone = $("#phone").val();
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
		toastr.error("Please describe the reason.");
		return false;
	}
	
	<?php if($action === 'dermatology') { ?>
	
		let scheduleConsultation = JSON.parse(localStorage.getItem("scheduleConsultation")) || {};
		
		if(!Array.isArray(scheduleConsultation.dermatology) || scheduleConsultation.dermatology.length < 2) {
			toastr.error("Please upload a minimum of 2 images");
			return false;
		}
	
	<?php } ?>
	
	
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
    $(this).closest('.d-upload-status').remove();
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
@if(Request::segment(3) == 'step-5')

@php
    $scheduleUrl = url('/schedule-consultation/' . Request::segment(2) . '/step-4/' . Request::segment(4)) . '?action=' . request('action');
    $next_url = url('/schedule-consultation/' . Request::segment(2) . '/step-6/' . Request::segment(4)) . '?action=' . request('action');
@endphp
<div role="tabpanel" class="tab-pane {{ (Request::segment(3) == 'step-5') ? 'active' : '' }}"
                 id="reporting">
                 <div class="design-process-content consul-detail-tb">
                     <form action="{{ route('update.consultation', $consultation_id) }}" method="POST">
                         @csrf
                         <div class="doctor-why">
							<h4  class="mb-2" style="display:none;">Now we need to tell the doctor why you're scheduling this consultation.</h4>
							<p>Please fill out the form below with accurate details regarding <strong>
                                 {{ $user ? $user->fname.' '.$user->lname : '' }}'s</strong> current condition.</p>
                         </div>
						<?php /* 
						 <p>Please fill the form below with accurate details regarding <strong>
                                 {{ $user ? $user->fname.' '.$user->lname : '' }}'s</strong> current
                             condition. </p>
						*/ ?>	 
                         <div class="Content-consultation mt-5">
                             
                             <div class="form-group">
								<h4 class="mb-2">Please Choose What Best Describes Your Problem<span class="required-ico">*</span></h4>
                                 <select class="form-control theme-select mx-select" name="cheifComplaint" id="cheifComplaint" required>
                                     <option value="">Please Choose One</option>
                                     <option value="15" iswarning="0">"Cold" or "Flu"</option>
                                     <option value="3" iswarning="1">Abdominal pain</option>
                                     <option value="13" iswarning="0">Backache</option>
                                     <option value="1" iswarning="1">Chest pain</option>
                                     <option value="6" iswarning="0">Chills</option>
                                     <option value="17" iswarning="0">Cough</option>
                                     <option value="5" iswarning="0">Diarrhea</option>
                                     <option value="14" iswarning="0">Earache</option>
                                     <option value="20" iswarning="0">Eye problem</option>
                                     <option value="9" iswarning="0">Female problems</option>
                                     <option value="7" iswarning="0">Fever</option>
                                     <option value="26" iswarning="0">Foot pain</option>
                                     <option value="18" iswarning="0">General malaise</option>
                                     <option value="22" iswarning="0">Headache</option>
                                     <option value="25" iswarning="0">Hypertension (High blood
                                         pressure)</option>
                                     <option value="8" iswarning="0">Lightheadedness or Dizziness
                                     </option>
                                     <option value="4" iswarning="1">Loss of consciousness</option>
                                     <option value="10" iswarning="0">Male problems</option>
                                     <option value="19" iswarning="0">Nausea, vomiting</option>
                                     <option value="2" iswarning="1">Shortness of breath</option>
                                     <option value="21" iswarning="0">Sinus congestion</option>
                                     <option value="12" iswarning="0">Skin rash</option>
                                     <option value="11" iswarning="0">Sore throat</option>
                                     <option value="24" iswarning="0">Tired</option>
                                     <option value="16" iswarning="0">Urinary problems</option>
                                     <option value="23" iswarning="0">Weak</option>
                                     <option value="27" iswarning="0">Multiple</option>
                                 </select>
                             </div>
                             <div class="form-group symptoms-content-consultations" style="display:none;">
                                 <div class="common-symptoms-box">
                                     <h4><i class="fas fa-procedures mr-1"></i> Common Symptoms</h4>
                                     <div class="common-symptoms">
                                         <ul class="list-unstyled row">
                                             <li class=" col-sm-6 col-md-4 col-lg-3">
                                                 <div class="form-check form-check-primary">
                                                     <label class="form-check-label">
                                                         <input type="checkbox" name="otherProblems[]" value="15"
                                                             class="form-check-input">
                                                         "Cold" or "Flu"
                                                         <i class="input-helper"></i></label>
                                                 </div>
                                             </li>
                                             <li class=" col-sm-6 col-md-4 col-lg-3">
                                                 <div class="form-check form-check-primary">
                                                     <label class="form-check-label">
                                                         <input type="checkbox" name="otherProblems[]" value="6"
                                                             class="form-check-input">
                                                         Chills
                                                         <i class="input-helper"></i></label>
                                                 </div>
                                             </li>
                                             <li class=" col-sm-6 col-md-4 col-lg-3">
                                                 <div class="form-check form-check-primary">
                                                     <label class="form-check-label">
                                                         <input type="checkbox" name="otherProblems[]" value="17"
                                                             class="form-check-input">
                                                         Cough
                                                         <i class="input-helper"></i></label>
                                                 </div>
                                             </li>
                                             <li class=" col-sm-6 col-md-4 col-lg-3">
                                                 <div class="form-check form-check-primary">
                                                     <label class="form-check-label">
                                                         <input type="checkbox" name="otherProblems[]" value="5"
                                                             class="form-check-input">
                                                         Diarrhea
                                                         <i class="input-helper"></i></label>
                                                 </div>
                                             </li>
                                             <li class=" col-sm-6 col-md-4 col-lg-3">
                                                 <div class="form-check form-check-primary">
                                                     <label class="form-check-label">
                                                         <input type="checkbox" name="otherProblems[]" value="14"
                                                             class="form-check-input">
                                                         Earache
                                                         <i class="input-helper"></i></label>
                                                 </div>
                                             </li>
                                             <li class=" col-sm-6 col-md-4 col-lg-3">
                                                 <div class="form-check form-check-primary">
                                                     <label class="form-check-label">
                                                         <input type="checkbox" name="otherProblems[]" value="7"
                                                             class="form-check-input">
                                                         Fever
                                                         <i class="input-helper"></i></label>
                                                 </div>
                                             </li>
                                             <li class=" col-sm-6 col-md-4 col-lg-3">
                                                 <div class="form-check form-check-primary">
                                                     <label class="form-check-label">
                                                         <input type="checkbox" name="otherProblems[]" value="12"
                                                             class="form-check-input">
                                                         Headache
                                                         <i class="input-helper"></i></label>
                                                 </div>
                                             </li>
                                             <li class=" col-sm-6 col-md-4 col-lg-3">
                                                 <div class="form-check form-check-primary">
                                                     <label class="form-check-label">
                                                         <input type="checkbox" name="otherProblems[]" value="19"
                                                             class="form-check-input">
                                                         Nausea, vomiting
                                                         <i class="input-helper"></i></label>
                                                 </div>
                                             </li>
                                             <li class=" col-sm-6 col-md-4 col-lg-3">
                                                 <div class="form-check form-check-primary">
                                                     <label class="form-check-label">
                                                         <input type="checkbox" name="otherProblems[]" value="21"
                                                             class="form-check-input">
                                                         Sinus congestion
                                                         <i class="input-helper"></i></label>
                                                 </div>
                                             </li>
                                             <li class=" col-sm-6 col-md-4 col-lg-3">
                                                 <div class="form-check form-check-primary">
                                                     <label class="form-check-label">
                                                         <input type="checkbox" name="otherProblems[]" value="12"
                                                             class="form-check-input">
                                                         Skin rash
                                                         <i class="input-helper"></i></label>
                                                 </div>
                                             </li>
                                             <li class=" col-sm-6 col-md-4 col-lg-3">
                                                 <div class="form-check form-check-primary">
                                                     <label class="form-check-label">
                                                         <input type="checkbox" name="otherProblems[]" value="11"
                                                             class="form-check-input">
                                                         Sore throat
                                                         <i class="input-helper"></i></label>
                                                 </div>
                                             </li>
                                             <li class=" col-sm-6 col-md-4 col-lg-3">
                                                 <div class="form-check form-check-primary">
                                                     <label class="form-check-label">
                                                         <input type="checkbox" name="otherProblems[]" value="16"
                                                             class="form-check-input">
                                                         Urinary problems
                                                         <i class="input-helper"></i></label>
                                                 </div>
                                             </li>
                                         </ul>
                                     </div>
                                 </div>
                                 <div class="common-symptoms-box">
                                     <h4><i class="fas fa-diagnoses mr-1"></i> All Other Symptoms
                                     </h4>
                                     <div class="common-symptoms">
                                         <ul class="list-unstyled row">
                                             <li class=" col-sm-6 col-md-4 col-lg-3">
                                                 <div class="form-check form-check-primary">
                                                     <label class="form-check-label">
                                                         <input type="checkbox" name="otherProblems[]" value="18"
                                                             class="form-check-input">
                                                         General malaise
                                                         <i class="input-helper"></i></label>
                                                 </div>
                                             </li>
                                             <li class=" col-sm-6 col-md-4 col-lg-3">
                                                 <div class="form-check form-check-primary">
                                                     <label class="form-check-label">
                                                         <input type="checkbox" name="otherProblems[]" value="24"
                                                             class="form-check-input">
                                                         Tired
                                                         <i class="input-helper"></i></label>
                                                 </div>
                                             </li>
                                             <li class=" col-sm-6 col-md-4 col-lg-3">
                                                 <div class="form-check form-check-primary">
                                                     <label class="form-check-label">
                                                         <input type="checkbox" name="otherProblems[]" value="23"
                                                             class="form-check-input">
                                                         Weak
                                                         <i class="input-helper"></i></label>
                                                 </div>
                                             </li>
                                             <li class=" col-sm-6 col-md-4 col-lg-3">
                                                 <div class="form-check form-check-primary">
                                                     <label class="form-check-label">
                                                         <input type="checkbox" name="otherProblems[]" value="20"
                                                             class="form-check-input">
                                                         Eye problem
                                                         <i class="input-helper"></i></label>
                                                 </div>
                                             </li>
                                             <li class=" col-sm-6 col-md-4 col-lg-3">
                                                 <div class="form-check form-check-primary">
                                                     <label class="form-check-label">
                                                         <input type="checkbox" name="otherProblems[]" value="8"
                                                             class="form-check-input">
                                                         Lightheadedness or Dizziness
                                                         <i class="input-helper"></i></label>
                                                 </div>
                                             </li>
                                             <li class=" col-sm-6 col-md-4 col-lg-3">
                                                 <div class="form-check form-check-primary">
                                                     <label class="form-check-label">
                                                         <input type="checkbox" name="otherProblems[]" value="1"
                                                             class="form-check-input">
                                                         Chest pain
                                                         <i class="input-helper"></i></label>
                                                 </div>
                                             </li>
                                             <li class=" col-sm-6 col-md-4 col-lg-3">
                                                 <div class="form-check form-check-primary">
                                                     <label class="form-check-label">
                                                         <input type="checkbox" name="otherProblems[]" value="25"
                                                             class="form-check-input">
                                                         Hypertension (High blood pressure)
                                                         <i class="input-helper"></i></label>
                                                 </div>
                                             </li>
                                             <li class=" col-sm-6 col-md-4 col-lg-3">
                                                 <div class="form-check form-check-primary">
                                                     <label class="form-check-label">
                                                         <input type="checkbox" name="otherProblems[]" value="4"
                                                             class="form-check-input">
                                                         Loss of consciousness
                                                         <i class="input-helper"></i></label>
                                                 </div>
                                             </li>
                                             <li class=" col-sm-6 col-md-4 col-lg-3">
                                                 <div class="form-check form-check-primary">
                                                     <label class="form-check-label">
                                                         <input type="checkbox" name="otherProblems[]" value="2"
                                                             class="form-check-input">
                                                         Shortness of breath
                                                         <i class="input-helper"></i></label>
                                                 </div>
                                             </li>
                                             <li class=" col-sm-6 col-md-4 col-lg-3">
                                                 <div class="form-check form-check-primary">
                                                     <label class="form-check-label">
                                                         <input type="checkbox" name="otherProblems[]" value="3"
                                                             class="form-check-input">
                                                         Abdominal pain
                                                         <i class="input-helper"></i></label>
                                                 </div>
                                             </li>
                                             <li class=" col-sm-6 col-md-4 col-lg-3">
                                                 <div class="form-check form-check-primary">
                                                     <label class="form-check-label">
                                                         <input type="checkbox" name="otherProblems[]" value="9"
                                                             class="form-check-input">
                                                         Female problems
                                                         <i class="input-helper"></i></label>
                                                 </div>
                                             </li>
                                             <li class=" col-sm-6 col-md-4 col-lg-3">
                                                 <div class="form-check form-check-primary">
                                                     <label class="form-check-label">
                                                         <input type="checkbox" name="otherProblems[]" value="10"
                                                             class="form-check-input">
                                                         Male problems
                                                         <i class="input-helper"></i></label>
                                                 </div>
                                             </li>
                                             <li class=" col-sm-6 col-md-4 col-lg-3">
                                                 <div class="form-check form-check-primary">
                                                     <label class="form-check-label">
                                                         <input type="checkbox" name="otherProblems[]" value="13"
                                                             class="form-check-input">
                                                         Backache
                                                         <i class="input-helper"></i></label>
                                                 </div>
                                             </li>
                                             <li class=" col-sm-6 col-md-4 col-lg-3">
                                                 <div class="form-check form-check-primary">
                                                     <label class="form-check-label">
                                                         <input type="checkbox" name="otherProblems[]" value="26"
                                                             class="form-check-input">
                                                         Foot pain
                                                         <i class="input-helper"></i></label>
                                                 </div>
                                             </li>
                                         </ul>
                                     </div>
                                 </div>
                             </div>
                             <div class="form-group scheduling-consultation-textarea my-4">
                                 <div class="inner-scheduling-consultation-textarea">
                                     <h4 class="mb-2">Please Describe the Medical Condition for Which You Are Scheduling a Consultation<span class="required-ico">*</span></h4>
                                     <div class="form-group">
                                         <textarea class="form-control" rows="7"
                                             name="patientDescription" id="patientDescription" required></textarea>
                                     </div>
                                 </div>
                             </div>
                             <input type="hidden" name="next-step" value="step-6" />

                             <div class="d-flex justify-content-between btn-group-box mt-5 ">
                                
								<a href="{{ $scheduleUrl }}" class="outline-button back-btn"> <i class="fa fa-chevron-left fa-arrow-icon fa-arrow-icon-back"></i> Back</a>
								
								<button type="button" class="btn btn-primary mr-3" onclick="return validate_step()">Next <i class="fa fa-chevron-right fa-arrow-icon"></i></button>
								
								
                     </form>
					 
                    
                     
                     
                 </div>
             </div>

         </div>
</div>

<script>
function validate_step(){

    let cheifComplaint = $('#cheifComplaint').val();
    if(cheifComplaint =="") {
        toastr.error("Please select an option.");
        return false;
    } 

    let patientDescription = $('#patientDescription').val();
    if(patientDescription =="") {
        toastr.error("Description is required.");
        return false;
    } 
	
	let chief_other_problems = $('input[name="otherProblems[]"]:checked')
        .map(function() {
            return parseInt($(this).val());
        }).get()
						
    scheduleConsultation.cheifComplaint = cheifComplaint;
    scheduleConsultation.patientDescription = patientDescription;
    scheduleConsultation.chief_other_problems = chief_other_problems;
    localStorage.setItem("scheduleConsultation", JSON.stringify(scheduleConsultation));
    window.location.href='{{$next_url}}';
}
$(function(){

    $(".schedule-consultation .back-btn").attr("href", "{{ $scheduleUrl }}");
    $("#cheifComplaint").val(scheduleConsultation.cheifComplaint);
    $("#patientDescription").val(scheduleConsultation.patientDescription??'');
    console.log(scheduleConsultation.chief_other_problems);
	if(scheduleConsultation.chief_other_problems) {
		scheduleConsultation.chief_other_problems.forEach(function(val) {
			const isChecked = $('input[name="otherProblems[]"][value="' + val + '"]').prop('checked', true);;
            console.log('Value: ' + val + ' - Checked: ' + isChecked);
		});
	}
	
	
})
</script>
@endif
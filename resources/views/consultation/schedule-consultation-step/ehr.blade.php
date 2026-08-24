@if(Request::segment(3) == 'step-2')
	
@php
    $scheduleUrl = url('/schedule-consultation/' . Request::segment(2) . '/step-1/?action=' . request('action'));
@endphp

<div role="tabpanel"

                                     class="tab-pane {{ (Request::segment(3) == 'step-2') ? 'active' : '' }}" id="ehr">

                                     <?php $consultation_id = $consultation ? $consultation->id : "" ?>

                                     <div class="design-process-content">

                                         <h3 class="semi-bold">A Diagnostic Consultation Requires Valid and Up-to-Date Electronic Health Records.</h3>

                                         <div class="my-3">

                                             <label for="start" class="mr-3"><i class="far fa-calendar-alt"></i> Health

                                                 Records Last Updated On</label>

                                             <input type="text" id="start" name="trip-start" disabled

                                                 value="{{ $last_updated ? $last_updated : '' }}" />

                                         </div>

                                         <div class="card-body p-0" style="background:#8462A8 !important;">

                                             <blockquote class="blockquote blockquote-primary">

                                                 @php $id = $user ? $user->id : "" @endphp

                                                 <a href="{{ url('/personal-record/'.$id) }}"

                                                     class="fs-16 theme-link-txt1" target="_blank" style="color: #fff;"><i

                                                         class="fas fa-external-link-alt"></i> Click here if you’d like to update your Electronic Health Record; otherwise, continue to Step 3.</a>

                                             </blockquote>

                                         </div>

                                         <div class="table-responsive">

                                             <table class="table table-striped table-bordered ehr-table-cus">

                                                 <tbody>

                                                     <tr>

                                                         <td class="py-1" width="80px">

                                                             <div class="form-group mb-0">

                                                                 <div class="form-check form-check-primary mb-0">

                                                                     <label class="form-check-label mb-0">

                                                                         <input type="checkbox"

                                                                             class="form-check-input compulsory-policy checkbox-item"

                                                                             name="cb1" id="cb1">

                                                                         <i class="input-helper"></i></label>

                                                                 </div>

                                                             </div>

                                                         </td>

                                                         <td>
<label for="cb1">I certify that the Electronic Health Records of {{ ucfirst(Auth::user()->fname) }} {{ ucfirst(Auth::user()->lname) }} are up-to-date to the best of my knowledge.</label>
															<?php /*
                                                             <label for="cb1">I certify that the Electronic Medical

                                                                 Records of {{ ucfirst(Auth::user()->fname) }} {{ ucfirst(Auth::user()->lname) }} are up-to-date to the best of

                                                                 my knowledge.</label>
																 */ ?>

                                                         </td>

                                                     </tr>

                                                     <tr>

                                                         <td class="py-1">

                                                             <div class="form-group mb-0">

                                                                 <div class="form-check form-check-primary mb-0">

                                                                     <label class="form-check-label mb-0">

                                                                         <input type="checkbox"

                                                                             class="form-check-input compulsory-policy checkbox-item"

                                                                             id="cb-2">

                                                                         <i class="input-helper"></i></label>

                                                                 </div>

                                                             </div>

                                                         </td>

                                                         <td>

<label for="cb-2">By selecting this box, I confirm that I have read, understood, and agreed to the terms of the Informed Member Consent.</label>

                                                             <a href="#" class="w-100 d-block fs-16 theme-link-txt1"

                                                                 data-toggle="modal" data-target="#myModalconsent"><i

                                                                     class="fas fa-external-link-alt"></i> Click here to

                                                                 view full version of the Informed Member Consent.</a>

                                                         </td>

                                                     </tr>

                                                     <tr>

                                                         <td class="py-1">

                                                             <div class="form-group mb-0">

                                                                 <div class="form-check form-check-primary mb-0">

                                                                     <label class="form-check-label mb-0">

                                                                         <input type="checkbox"

                                                                             class="form-check-input compulsory-policy checkbox-item"

                                                                             id="cb-3">

                                                                         <i class="input-helper"></i></label>

                                                                 </div>

                                                             </div>

                                                         </td>

                                                         <td>
<label for="cb-3">I have read and agree to the <a target="_blank" href="{{ config('constants.web_term_condition') }}" class=" fs-16 theme-link-txt1">Terms of Use</a>, <a target="_blank" href="{{ config('constants.web_privacy_link') }}" class=" fs-16 theme-link-txt1">Privacy Policy</a>, and <span class=" fs-16 theme-link-txt1">HIPAA Privacy</span> Practices.</label>
															
															<?php /*	
                                                             <label for="cb-3">I have read and agree with the<a

                                                                     href="#0" class=" fs-16 theme-link-txt1"> Terms of

                                                                     Use </a>, <a href="#0"

                                                                     class=" fs-16 theme-link-txt1">Privacy Policy

                                                                 </a>and <a href="#0"

                                                                     class=" fs-16 theme-link-txt1">HIPAA Privacy

                                                                     Practices</a></label>
																	 */ ?>

                                                         </td>

                                                     </tr>

                                                 </tbody>

                                             </table>

                                         </div>

                                         <div class="d-flex justify-content-between btn-group-box mt-5 ">

											<a class="outline-button back-btn"> <i class="fa fa-chevron-left fa-arrow-icon fa-arrow-icon-back"></i> Back</a>
											
											<a class="btn btn-primary mr-3 disabled next-button-ehr-phone" id="submit-policy"

                                                 disabled="disabled"

                                                 href="javascript:void(0)">Next <i class="fa fa-chevron-right fa-arrow-icon"></i></a>

                                             

                                             </li>

                                             

                                         </div>

                                     </div>

</div>


<script>
$(function(){

    let modality = @json(Request::segment(2));
    let consult_id = @json(Request::segment(4));
    let link = SITE_URL + "/schedule-consultation/" + modality + "/step-3/" + consult_id + "?action=<?php echo request('action')?>";

    $('.checkbox-item').click(function() {

        
       
        if ($('.checkbox-item:checked').length == $('.checkbox-item').length) {
                $('.next-button-ehr-phone').prop('disabled', false);
                $(".next-button-ehr-phone").attr("href",link);
                $(".next-button-ehr-phone").removeAttr("onclick");
                scheduleConsultation.ehr_checkbox = "yes";
                localStorage.setItem("scheduleConsultation", JSON.stringify(scheduleConsultation));
            } else {
                
                $(".next-button-ehr-phone").attr("href","javascript:void(0)");
                $('.next-button-ehr-phone').prop('disabled', true);

            }
     });

     $(".schedule-consultation .back-btn").attr("href", "{{ $scheduleUrl }}");
     if(scheduleConsultation.ehr_checkbox){
        $('.checkbox-item').prop('checked', true);
        $('.next-button-ehr-phone').removeClass('disabled');
        $('.next-button-ehr-phone').removeAttr('disabled');
        $(".next-button-ehr-phone").removeAttr("onclick");
        $(".next-button-ehr-phone").attr("href",link);
     }
});
function nextehr() {
    toastr.error("Terms & Conditions are required.");
}
</script>

@endif
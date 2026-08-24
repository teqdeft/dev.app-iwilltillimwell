@if(Request::segment(3) == 'step-4')
@php
    $scheduleUrl = url('/schedule-consultation/' . Request::segment(2) . '/step-3/' . Request::segment(4)) . '?action=' . request('action');
    $nextUrl = url('/schedule-consultation/' . Request::segment(2) . '/step-5/' . Request::segment(4)) . '?action=' . request('action');
@endphp
<div role="tabpanel" class="tab-pane {{ (Request::segment(3) == 'step-4') ? 'active' : '' }}" id="content">
	
	<div id="state-tab" class="tab-content">
				<div class="patient-tab-content state-residence">
				<div class="residence">
					<div class="pat-title">
						<p><strong>State of Residence</strong></p>
					</div>
					<div class="sub-detail">
						<p>Our records indicate <span style="font-weight:600;">{{ $user ? ucfirst($user->fname).' '.ucfirst($user->lname) : '' }}</span> lives in {{ $user_state }}.</p>
					</div>
					</div>
					
					<?php $consultation_id = $consultation ? $consultation->id : "" ?>  
					<div class="resi-form">
					<form action="{{ route('update.consultation', $consultation_id) }}" method="POST">
						@csrf
						<input type="hidden" name="stateid"
						value="{{ $user ? $user->stateid : '' }}" />
						<input type="hidden" name="next-step" value="step-5" />

						<div class="col-100 form-group">
						<h4>
							<label>Is {{ $user ? ucfirst($user->fname).' '.ucfirst($user->lname) : '' }} currently in {{ $user_state }}?</label></h4>
							<div class="custom-radio-group indicate-radio">
										
								<label class="custom-radio state_option_1">
									Yes
									<input type="radio" name="state_option" value="1">
									<span class="custom-radio-button"></span>
									<input type="hidden" value="<?php echo request('action')?>" name="action_type" />
								</label>
								
								<label class="custom-radio state_option_2">
									No
									<input type="radio" name="state_option" value="2" >
									<span class="custom-radio-button"></span>
								</label>
							</div>
						</div>

						<div class="col-100 form-group state_list_dropdown" style="display: none">
							<select class="form-control theme-select theme-select mx-select" name="stateid_option"  id="stateid_option">
								
								<option value="">Please Select State</option>
								@foreach ($states as $state)
								<option value="{{ $state->state_id }}">
									{{ $state->name }}</option>
								@endforeach
							</select>
						</div>
						
						<div class="sub-detail state-info-video-dermatology"></div>
						<div class="col-100 cta">
							 <div class="recorc-cta" style="width: 100%;display: flex;justify-content: space-between;align-items: center;margin-top: 20px;">
								
								<a href="{{ $scheduleUrl }}" class="outline-button back-btn"><i class="fa fa-chevron-left fa-arrow-icon fa-arrow-icon-back"></i>Back</a>
								
								<button type="button" class="btn btn-primary mr-3" onclick="return validate_step()">Next <i class="fa fa-chevron-right fa-arrow-icon"></i></button>
								
								
								
							 </div>  
						</div>
					</form>
					</div>
					
				</div>
			</div>	
	<?php /*						 
                             <form action="{{ route('update.consultation', $consultation_id) }}" method="POST">
                                 @csrf
                                 <div class="design-process-content consultation-state-cnt">
                                     <h3 class="semi-bold">State of Residence</h3>
                                     <p>Our records indicate
                                         <strong>{{ $user ? $user->fname.' '.$user->lname : '' }} </strong>
                                         lives in
                                         <strong>{{ $user_state }}</strong>.
                                     </p>
                                     <div class="mt-2">
                                         <h4>Is
                                             <strong>{{ $user ? $user->fname.' '.$user->lname : '' }}</strong>
                                             currently in <strong>{{ $user_state }}?</strong>
                                         </h4>
                                         <input type="hidden" name="stateid"
                                             value="{{ $user ? $user->stateid : '' }}" />
                                     </div>
                                     <input type="hidden" name="next-step" value="step-5" />
                                     <div class="d-flex justify-content-between btn-group-box mt-5 ">
                                         <div class="btn-box">
                                             <button type="submit" class="btn btn-primary mr-2">Yes</button>
                                             <button type="button"
                                                 class="btn btn-primary mr-3 consultation-show-custom-state-btn">No</button>
                                         </div>
                             </form>
                             <a class="cancel_resource btn btn-outline-secondary btn-fw"
                                 data-resource="{{ 'cancel-consultation-form-' . $consultation_id }}"
                                 href="{{route('consultations.cancel', $consultation)}}">Cancel
                                 Consult</a>
                             </li>
                             <form method="post" id="cancel-consultation-form-{{$consultation_id}}"
                                 action="{{ route('consultations.cancel',$consultation) }}" style="display:none">
                                 @csrf
                                 @method('DELETE')
                             </form>
                         </div>
                     </div>
                     <div class="design-process-content consultation-custom-state-cnt" style="display:none">
                         <form action="{{ route('update.consultation', $consultation_id) }}" method="POST">
                             @csrf
                             <h3 class="semi-bold">State of Residence</h3>
                             <p>What state is <strong>{{ $user ? $user->fname.' '.$user->lname : '' }}</strong> currently located in?. </p>
                             <div class="mt-2">
                                 <select class="form-control theme-select theme-select mx-select" name="stateid">
                                     <option value="">Please select state
                                     </option>
                                     @foreach ($states as $state)
                                     <option value="{{ $state->id }}">
                                         {{ $state->name }}</option>
                                     @endforeach
                                 </select>
                             </div>
                             <input type="hidden" name="next-step" value="step-5" />
                             <div class="d-flex justify-content-between btn-group-box mt-5 ">
                                 <div class="btn-box">
                                     <button type="submit" class="btn btn-primary mr-2">Continue</button>
                                     <button type="button" class="btn btn-primary mr-3"
                                         onClick="window.location.reload()">Back</button>
                                 </div>
                         </form>
                         <a class="cancel_resource btn btn-outline-secondary btn-fw"
                             data-resource="{{ 'cancel-consultation-form-' . $consultation_id }}"
                             href="{{route('consultations.cancel', $consultation)}}">Cancel
                             Consult</a>
                         </li>
                         <form method="post" id="cancel-consultation-form-{{$consultation_id}}"
                             action="{{ route('consultations.cancel',$consultation) }}" style="display:none">
                             @csrf
                             @method('DELETE')
                         </form>
                     </div>
                 </div>
				 */ ?>

</div>

<script>
$(document).ready(function() {
    
    

     $('input[name="state_option"]').on('click change', function () {
        let selectedValue = $('input[name="state_option"]:checked').val(); 
        if(selectedValue==1){
            $(".state_list_dropdown").hide();
         } else {
             $(".state_list_dropdown").show();     
         }
        //$(".btn-submit-next-screen").attr("type","submit");
     });

     if(scheduleConsultation.state_option) {
        $('input[name="state_option"][value="'+scheduleConsultation.state_option+'"]').prop('checked', true).trigger('click');
        if(scheduleConsultation.stateid_option) {
            $("#stateid_option").val(scheduleConsultation.stateid_option);
        }
    }

     $(".schedule-consultation .back-btn").attr("href", "{{ $scheduleUrl }}");
	 
	/*  
	 3,4,13,15,16
	 */
	 
	if(scheduleConsultation.action == "dermatology" && scheduleConsultation.modality=="video") {
		
		
		$(".state_option_1 input").prop("disabled", true);
		$(".state_option_2 input").trigger("click");
		$("#stateid_option").trigger("click");
		$("#stateid_option option").hide();
		$('#stateid_option option[value="3"], #stateid_option option[value="4"], #stateid_option option[value="13"], #stateid_option option[value="15"], #stateid_option option[value="16"]').show(); 
		
		$(".state-info-video-dermatology").html('<p style="color:red">Dermatology video call services are available only in AZ, AR, IA, ID, and IN.</p>');
		/* */
	}
     
});
function validate_step(){

    let selectedValue = $('input[name="state_option"]:checked').val();
    if(selectedValue == undefined) {
        toastr.error("Please select a state option.");
        return false;
    }  else if(selectedValue==2){
        let stateid_option = $("#stateid_option").val();
        if(stateid_option==""){
            toastr.error("Please select a state.");
            return false;
        }
        scheduleConsultation.stateid_option = stateid_option;
    }

    scheduleConsultation.state_option = selectedValue;
    localStorage.setItem("scheduleConsultation", JSON.stringify(scheduleConsultation));
    window.location.href="{{ $nextUrl }}";
}
</script>
@endif
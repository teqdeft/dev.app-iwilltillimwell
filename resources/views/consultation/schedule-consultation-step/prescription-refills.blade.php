@if (
    (Request::segment(3) === 'step-7' && request('action') === 'urgentcare') ||
    (Request::segment(3) === 'step-5' && request('action') === 'primarycare') ||
    (Request::segment(3) === 'step-5' && request('action') === 'psychology') ||
    (Request::segment(3) === 'step-5' && request('action') === 'dermatology') ||
    (Request::segment(3) === 'step-5' && request('action') === 'psychiatry')
)
@php

	$scheduleUrl = '';
	$next_url = '';
	
	if (Request::segment(3) === 'step-7' && request('action') === 'urgentcare') {
        $scheduleUrl = url('/schedule-consultation/' . Request::segment(2) . '/step-6/' . Request::segment(4)) . '?action=' . request('action');
        $next_url = url('/schedule-consultation/' . Request::segment(2) . '/step-8/' . Request::segment(4)) . '?action=' . request('action');
    }
	if (Request::segment(3) === 'step-5' && in_array(request('action'), ['primarycare', 'psychiatry', 'psychology', 'dermatology'])) {
       $scheduleUrl = url('/schedule-consultation/' . Request::segment(2) . '/step-4/' . Request::segment(4)) . '?action=' . request('action');
       $next_url = url('/schedule-consultation/' . Request::segment(2) . '/step-6/' . Request::segment(4)) . '?action=' . request('action');
    }
@endphp	
    <div id="prescription-refills" class="tab-pane active prescri-refills">
	
	
	<div class="card">
		<div class="card-body personal-info-card-box">
			<div class="row">
				<div class="col">
					<div class="lav-v1">
						<label><h4 class="card-title">Do You Require Any Prescription Refills?</h4></label>
					</div>
					<div class="form-group">
						<div class="form-check-inline">
							<input class="form-check-input take_medication-check" type="radio" name="prescription_status" id="take_medication-yes"
								value="yes"                                             checked
								 >
							<label class="form-check-label" for="take_medication-yes">Yes</label>
						</div>
						<div class="form-check-inline">
							<input class="form-check-input take_medication-check" type="radio" name="prescription_status" id="take_medication-no"
								value="no"  >
							<input type="hidden" name="segment" value="medications" >
							<label class="form-check-label" for="take_medication-no">No</label>
						</div>
					</div>								
				</div>	
			</div>

			<div class="tab-content p-0 medications-previously-reported" style="display:none;">
				<div class="tab-pane active">
				
				
				
					<div class="row">
						<div class="col-12">
							<div class="form-group">
								<label for="prescription_description">Comment*</label>
								<textarea class="form-control" id="prescription_description" name="prescription_description" rows="7"></textarea>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="user-name-cus-box w-100"><h4 class="">MEDICATION SUMMARY</h4></div>
						 
						<div class="col-lg-12 grid-margin stretch-card">
							<div class="card-box card">	
								<div class="card-body px-0">
									<div class="table-responsive">
										<table class="table table-hover table-striped medication-table-box table-bordered">
											<thead>
												<tr>
													<th>Medication</th>
													<th>Frequency</th>
													<th>Currently taking?</th>
													<th>Comment</th>
													<th>Actions</th>
												</tr>
											</thead>
											<tbody>
												@forelse ($medications as $medication)
													<tr>
														<td>{{ $medication->name }}</td>
														<td>{{ $medication->frequency }}</td>
														<td>{{ ($medication->currentlyUse == 'true') ? 'Yes' : 'No' }}</td>
														<td>{{ $medication->comment }}</td>
														<td>
															@if ($medication->currentlyUse == 'true')
																<a class="medication-status"
																   href="#!"
																   id="medication-inactive"
																   medication-id="{{ $medication->medicationId ?? '___'.$medication->id }}"
																   url-string="{{ url('medication-inactive') }}"
																   u-id="{{ $medication->userId }}">
																	<label class="badge badge-danger-cus">
																		<i class="fas fa-ban mr-1"></i>
																		I'm no longer taking this medication
																	</label>
																</a>
															@else
																<span>-</span>
															@endif
														</td>
													</tr>
												@empty
													<tr>
														<td colspan="5" class="text-center text-muted">
															No record found
														</td>
													</tr>
												@endforelse
											</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>

						
					</div>
				</div>
			</div>
			
			<div class="d-flex justify-content-between btn-group-box mt-5 ">
			
			<a href="javascript:void(0)" class="outline-button back-btn"><i class="fa fa-chevron-left fa-arrow-icon fa-arrow-icon-back"></i> Back</a>
			<a onclick="savePrescription()" href="javascript:void(0)"  class="btn btn-primary">Next <i class="fa fa-chevron-right fa-arrow-icon"></i></a>
					
			</div>
				
		</div>	
	</div>	

</div>
<script>
     
    var prescription_status = "";
$(function(){

    if(!scheduleConsultation.primarycare) {
          scheduleConsultation.primarycare = {};
    }

    $(".schedule-consultation .back-btn").attr("href", "{{ $scheduleUrl }}");

    $('input[name="prescription_status"]').on('change click', function () {
        prescription_status = $('input[name="prescription_status"]:checked').val();
        $(".medications-previously-reported").hide();
        if(prescription_status=="yes") {
            $(".medications-previously-reported").show();
        }
        
        scheduleConsultation.primarycare.prescription_status = prescription_status;
        localStorage.setItem("scheduleConsultation", JSON.stringify(scheduleConsultation));
    });
    
    if(scheduleConsultation.primarycare.prescription_status=="yes") {
        $('input[name="prescription_status"][value="yes"]').prop('checked', true).trigger("click");
    } else {
        $('input[name="prescription_status"][value="no"]').prop('checked', true).trigger("click");
    }
    if(scheduleConsultation.primarycare.prescription_description) {}
    $("#prescription_description").val(scheduleConsultation.primarycare.prescription_description??'');
    
    

});
function savePrescription() {
    if(prescription_status=="yes") {
        let prescription_description = $("#prescription_description").val();
        if(!prescription_description) {
            toastr.error("Description is required.");
            return false;
        }
        scheduleConsultation.primarycare.prescription_description = prescription_description;
        localStorage.setItem("scheduleConsultation", JSON.stringify(scheduleConsultation));
    }
    window.location.href='<?php echo $next_url?>';

}
</script> 
@endif
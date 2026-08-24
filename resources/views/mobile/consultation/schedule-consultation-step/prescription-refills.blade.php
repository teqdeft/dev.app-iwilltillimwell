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
<div id="prescription-refills" class="tab-content">

                        <div class="patient-tab-content">

                            <div class="pat-title">
                                <p>Prescription Refills</p>
                            </div>

                            <form class="primary-care-f1">
                                <div class="col-100 form-group">
                                    <label>Do You Require Any Prescription Refills?</label>
                                    <div class="custom-radio-group indicate-radio">
                                        <label class="custom-radio">
                                            Yes
                                            <input type="radio" name="prescription_status" value="yes" >
                                            <span class="custom-radio-button"></span>
                                        </label>
                                        <label class="custom-radio">
                                            No
                                            <input type="radio" name="prescription_status" value="no" checked>
                                            <span class="custom-radio-button"></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="medications-previously-reported" style="display: none;"> 
                                    <div class="pat-title mt-5">
                                        <p>Medications previously reported</p>
                                    </div>

                                    <div class="">
 
 
                                    @if ($medications)
                @foreach ($medications as $medication)
                            <div class="col-100 medication-allergies mt-2">
                               
                                
                                <div class="aller-row">
                                    <div class="left">
                                        <p>Medication</p>
                                    </div>
                                    <div class="right">
                                        <p>{{$medication->name}}</p>
                                    </div>
                                </div>

                                <div class="aller-row">
                                    <div class="left">
                                        <p>Frequency</p>
                                    </div>
                                    <div class="right">
                                        <p>{{$medication->frequency}}</p>
                                    </div>
                                </div>
                                <div class="aller-row">
                                    <div class="left">
                                        <p>Currently taking?</p>
                                    </div>
                                    <div class="right">
                                        <p>{{ (@$medication->currentlyUse == 'true') ? 'Yes' : 'No' }}</p>
                                    </div>
                                </div>

                                <div class="aller-row">
                                    <div class="left">
                                        <p>Comment</p>
                                    </div>
                                    <div class="right">
                                        <p>{{ @$medication->comment }}</p>
                                    </div>
                                </div>
                                <div class="aller-row">
                                    <div class="left">
                                        <p>Action</p>
                                    </div>
                                    <div class="right">
                                        @if (@$medication->currentlyUse == 'true')
                                            <a class="medication-status" href="#!{{-- {{ url('/medication-inactive/'. $medication->medicationId .'/' . $medication->userId) }} --}}" id="medication-inactive" medication-id = "{{ $medication->medicationId??'___'.$medication->id }}" url-string="{{ url('medication-inactive') }}" u-id = {{ $medication->userId }} > <label class="badge badge-danger-cus"><i class="fas fa-ban mr-1" ></i>  I"m no longer taking this medication</label></a>
                                        @else
                                        <span>-</span>
                                        @endif
                                    </div>
                                </div>

                                
                            </div>
                        @endforeach
                    @endif

                                    </div>
                                    <div class="col-100 form-group">
                                        <label>Enter prescription  details <span class="required-ico">*</span></label>
                                        <textarea rows="5" id="prescription_description"></textarea>
                                    </div>
                                </div>

                            
                                <div class="col-100 cta">
                                    <div class="recorc-cta" style="width: 100%; display: flex; justify-content: space-between; align-items: center;">   
                                            <a href="{{$scheduleUrl}}" class="outline-button showLoaderPageLoad">Back</a>
                                            <button type="button" class="primary-button " onclick="savePrescription()">Next</button>
                                    </div>    
                                </div>

                            </form>

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
            toastr.error("Description Required");
            return false;
        }
        scheduleConsultation.primarycare.prescription_description = prescription_description;
        localStorage.setItem("scheduleConsultation", JSON.stringify(scheduleConsultation));
    }
	showLoaderPageLoad('show');
    window.location.href='<?php echo $next_url?>';

}
</script> 
@endif
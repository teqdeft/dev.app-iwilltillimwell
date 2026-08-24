<form method="POST" action="{{ route('store.medicalcondition', $user->id) }}" id="health-record-medication-condition-form">    
    @csrf
<div class="midical-form v1">
    
    
    <div class="form">
        <div class="form-row">
		
			@if (count($medicalConditions))
				
			<div class="col-100 medical-condition-section">
			<div class="col-100">
				<div class="form-title detail">
					<p>Medical Condition Summary</p>
				</div>
                <div class="inner-title-detail mt-2">
                    <p>Please review the summary of your drug type, dosage and frequency if any medications you have taken/are currently taking as indicated below.</p>
                </div>
            </div>


            
                @foreach ($medicalConditions as $medicalCondition)
                        <div class="col-100 medication-allergies mt-2">
							<?php /*
                            <button class="edit-icon">
                                <img src="{{ asset('assets/dashboard/assets/images/edit-icon-v1.png')}}" alt="icon">
                            </button>
							 */ ?>
                            <button type="button" class="icon">
                                    <?php /*
                                    <a href="{{ url('/medical-history-inactive-mobile/'. $medicalCondition->medicalConditionId .'/' . $medicalCondition->userId) }}"> 
                                         <img src="{{ asset('assets/dashboard/assets/images/delete-icon.png')}}" alt="icon">
                                    </a>
                                    */ ?>

<a href="javascript:void(0)" onclick="OnClickHealthDocumentDeleted('medication-condition-tab')"> 
    <img src="{{ asset('assets/dashboard/assets/images/delete-icon.png')}}" alt="icon">
</a>

<input type="hidden" id="medication-condition-tab-url" value="{{ url('/medical-history-inactive/'. $medicalCondition->medicalConditionId .'/' . $medicalCondition->userId) }}">

    
                                    
                            </button>
                            <div class="aller-row">
                                <div class="left">
                                    <p>Condition name</p>
                                </div>
                                <div class="right">
                                    <p>{{ $medicalCondition->name }}</p>
                                </div>
                            </div>
                            <div class="aller-row">
                                <div class="left">
                                    <p>Status</p>
                                </div>
                                <div class="right">
                                    <p>{{ ($medicalCondition->status == 1) ? 'Current Condition' : 'Previous Condition' }}</p>
                                </div>
                            </div>
                            <div class="aller-row">
                                <div class="left">
                                    <p>Description</p>
                                </div>
                                <div class="right">
                                    <p>{{ $medicalCondition->description }}</p>
                                </div>
                            </div>
                        </div>
                @endforeach        
                    
            </div>
			@endif
			

            <div class="col-100 form-group">
                <label>Do You Have Medical History?</label>
                <select name="take_medication" id="take_medication_store" required onchange="MedicationConditionChange(this.value)">
                    <?php /*
                    <option value="">Select</option>
                    <option value="yes" @if (count($medicalConditions) > 0) selected  @endif>Yes</option>
                    <option value="no" @if(empty($medicalConditions) ) selected  @endif>No</option>
                    */ ?>
                   
                    <option value="yes">Yes</option>
                    <option value="no" selected>No</option>
                </select>
            </div>

            <input type="hidden" id="take_medication_store_url" name="take_medication_store_url" value="{{ route('store.NottakeMedication', $user->id) }}" >
            <input type="hidden" name="segment" value="medical-history" >
            
            <div class="col-100 medication-condition-section">
                <div class="inner-title">
                    <p>Add new medical condition record</p>
                </div>
            </div>

            <div class="col-100 form-group medication-condition-section">
                <label>Condition name <span class="required-ico"> *</span></label>
                <input class="form-control" type="text" name="medical[0][medicalConditionName]" placeholder="Enter here" id="Conditionname">
            </div>

            <div class="col-100 form-group medication-condition-section">
                <label>Description <span class="required-ico"> *</span></label>
                <textarea placeholder="Enter here" rows="4" name="medical[0][medicalConditionDescription]" id="description"></textarea>
            </div>

            <div class="col-100 form-group medication-condition-section">
                <label>Status <span class="required-ico"> *</span></label>
                <select name="medical[0][medicalConditionStatus]" id="medication_status" required>
                    
                    <option value="">Select</option>
                    <option value="1">Currently in such condition.</option>
                    <option value="2">Show Archived</option>
                </select>
            </div>
			

            <div class="col-100 cta medication-condition-section">
                <div class="recorc-cta">
                    <button type="button" class="primary-button" onclick="helthRecordMedicationConditionFormSubmit('save')">Save</button>
                </div>
            </div>
			
            <div class="col-100 cta">
                <div class="recorc-cta">
                    <button type="button" class="outline-button" onclick="nextTabHealRecoards('preview')" >Back</button>
                    <button type="button" class="primary-button" onclick="helthRecordMedicationConditionFormSubmit('next')">Next</button>
                </div>
            </div>

        </div>
    </div>
</div>
</form>
<style>.medication-condition-section { display: none;}</style>

<script>
var medicationConditionLocalValue = {};    
var medicationConditionLocalValueChange = false;
$(document).ready(function() {

    medicationConditionLocalValue = getLocalValueStoreForm(medicationConditionLocalValue,"health-record-medication-condition-form");
    //console.log(medicationConditionLocalValue);

    $('#health-record-medication-condition-form input, #health-record-medication-condition-form select, #health-record-medication-condition-form textarea').on('change', function() {
        var currentValue = $(this).val();
        var name = $(this).attr('name');
        if(medicationConditionLocalValue[name] !== currentValue) {
            console.log('Field "' + name + '" has changed');
            medicationConditionLocalValueChange = true;
        }

    });


});

function helthRecordMedicationConditionFormSubmit(request) {
    
	if(request=="next") {
		nextTabHealRecoards('next_tab'); 
		return false;
	}
	
    let take_medication_store = $("#take_medication_store").val();
    if(medicationConditionLocalValueChange && take_medication_store=="yes") {

        let Conditionname = $("#Conditionname").val();
        if(!Conditionname) {
            toastr.error("Name Required");
            return false;
        }
        let description = $("#description").val();
        if(!description) {
            toastr.error("Description Required");
            return false;
        }
        let medication_status = $("#medication_status").val();
        if(!medication_status) {
            toastr.error("Status Required");
            return false;
        }

           toastr.info('Please wait...', 'Processing', {
               timeOut: 0,
               extendedTimeOut: 0,
           });
           let url = $("#health-record-medication-condition-form").attr("action");
           const formData = $("#health-record-medication-condition-form").serialize(); // Serialize form data
           let take_medication_store = $("#take_medication_store").val();
           console.log(take_medication_store);
           if(take_medication_store=="no") {
                url = $("#take_medication_store_url").val();
           }
    
           $.ajax({
                   method: "POST",
                   url:url,
                   dataType: "json",
                   data:formData,
                   success: function(data) {
                       
                       toastr.clear();
                       if(data.success) {
                        
                           toastr.success(data.message);
						   
						   if(request=="save") {
								location.reload();
						   } else  {
							   window.location.href='{{ Route("personal-record") }}?active-tab=tab5';
						   }
                           
                          
                       } else {
                           toastr.warning(data.message);
                       }
    
                   },
               });
               return false;
            }
            nextTabHealRecoards('next_tab');           
}
function MedicationConditionChange(value){
    $(".medication-condition-section").hide();
    if(value=="yes") {
        $(".medication-condition-section").show();
    }
}
    </script>
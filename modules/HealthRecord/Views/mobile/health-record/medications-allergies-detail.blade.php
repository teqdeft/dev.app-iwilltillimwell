<form method="POST" action="{{ route('store.medication.allergy', $user->id) }}" id="health-record-medication-allergy-form">    
    @csrf
    
<div class="midical-form v1">
	<?php /*
    <div class="form-title detail">
        <p>Enter Your Details</p>
    </div>
	*/ ?>
    <div class="form">
        <div class="form-row">
			<div class="medication-allergy-summary col-100">
				<input type="hidden" id="medication-all-tab-url" value="{{ url('medication-allergies/delete') }}">
				<input type="hidden" name="segment" value="medication-allergies"/>
				
			
					@if (count($allergies))
							<div class="col-100">
								<div class="inner-title">
									<p>Medications Allergy Summary</p>
								</div>
							</div>

							<div class="col-100">
								<div class="inner-title-detail helvetica-neue font-500">
									Please review the summary of your drug type, dosage and frequency if any medications you have taken/are currently taking as indicated below.
								</div>
							</div>
							
							

							@foreach ($allergies as $allergy)
								<div class="col-100 medication-allergies mt-2">
									
									<button type="button" class="icon" onclick="OnClickHealthDocumentDeleted('medication-all-tab')">
										<img src="{{ asset('assets/dashboard/assets/images/delete-icon.png')}}" alt="icon">
									</button>
									
									<input type="hidden" id="medication-all-tab-deleted-id" value="{{@$allergy->id}}">
									<div class="aller-row">
										<div class="left">
											<p>Medication Allergies</p>
										</div>
										<div class="right">
											<p>
												 {{@$allergy->name}}   
											</p>
										</div>
									</div>
									<div class="aller-row">
										<div class="left">
											<p>Actions</p>
										</div>
										<div class="right">
											<p>
												@if (@$allergy->deleted_at == '')  
												This medication allergy is not valid for me. 
												@else
												 {{ 'Inactive - no actions allowed' }}
												@endif

											</p>
										</div>
									</div>
								</div>
								@endforeach
							@endif
						   

			</div>
			
			
            <div class="col-100 form-group">
                <label>Do You Have Medical Allergies?</label>
                <select name="take_medication" id="take_medication-allergies" onchange="takeMedicationAllergies()" required>
                   
                    <option value="yes" @if (count($allergies)) selected @endif>Yes</option>
                    <option value="no" @if(count($allergies) <=0) selected @endif >No</option>

                </select>
            </div>

            <div class="col-100 add-medication-section">
                <div class="inner-title">
                    <p>Add medication allergy</p>
                </div>
            </div>

            <div class="col-100 form-group  add-medication-section">
                <label>Indicate any known drug allergies that you may have <span class="required-ico"> *</span></label>
                <select name="medication_allergies-selection" id="medication_allergies-selection" class="medication_allergies-selection">
                    
                </select>
            </div>

            <input type="hidden" name="medicationAllergyForeignId" id="medicationAllergyForeignId" value="" >
            <input type="hidden" name="medicationAllergyDamConceptIdType" id="medicationAllergyDamConceptIdType" value="" >
            <input type="hidden" name="medicationAllergyDamConceptId" id="medicationAllergyDamConceptId" value="" >
            <input type="hidden" name="medicationAllergyName" id="medicationAllergyName" value="" >


			
			
            <div class="col-100 cta add-medication-section">
                <div class="recorc-cta">
                    <button type="button" class="primary-button" onclick="helthRecordMedicationAllergiesFormSubmit('save')">Save</button>
                </div>
            </div>
			
			
            <div class="col-100 cta">
                <div class="recorc-cta">
                    <button type="button" class="outline-button" onclick="nextTabHealRecoards('preview')" >Back</button>
                    <button type="button" class="primary-button" onclick="helthRecordMedicationAllergiesFormSubmit('next')">Next</button>
                </div>
            </div>

        </div>
    </div>
</div>
</form>

<script>
var medicationAllergiesLocalValue = {};    
var medicationAllergiesLocalValueChange = false;

$(document).ready(function() {

    medicationAllergiesLocalValue = getLocalValueStoreForm(medicationAllergiesLocalValue,"health-record-medication-allergy-form");
    console.log(medicationAllergiesLocalValue);

    $('#health-record-medication-allergy-form input, #health-record-medication-allergy-form select').on('change', function() {
        var currentValue = $(this).val();
        var name = $(this).attr('name');
        if(medicationAllergiesLocalValue[name] !== currentValue) {
            console.log('Field "' + name + '" has changed');
            medicationAllergiesLocalValueChange = true;
        }

    });

});

function helthRecordMedicationAllergiesFormSubmit(request) {
	if(request=="next") {
		nextTabHealRecoards('next_tab');  
		return false;
	}
    let take_medication = $("#take_medication-allergies").val();
    if(medicationAllergiesLocalValueChange || take_medication=="yes") {

        let medication_allergiesselection = $("#medication_allergies-selection").val();
            if(!medication_allergiesselection) {
                toastr.error("Medication Name Required");
                return false;
            }

       toastr.info('Please wait...', 'Processing', {
           timeOut: 0,
           extendedTimeOut: 0,
       });
       let url = $("#health-record-medication-allergy-form").attr("action");
       const formData = $("#health-record-medication-allergy-form").serialize(); // Serialize form data
       
       if(take_medication=="no") {
            url = $("#NottakeMedication").val();
       }
       //return false;
       $.ajax({
               method: "POST",
               url:url,
               dataType: "json",
               data:formData,
               success: function(data) {
                   
                   toastr.clear();
                   if(data.success) {
                       toastr.success(data.message);
                       //nextTabHealRecoards('next_tab');
					   if(request=="save") {
						   location.reload();
					   } else {
						   window.location.href='{{ Route("personal-record") }}?active-tab=tab4';
					   }
                       
                       //setTimeout(function(){ location.reload(); }, 500);
                   } else {
                       toastr.warning(data.message);
                   }

               },
           });
           return false;
        }
        nextTabHealRecoards('next_tab');     

}

function takeMedicationAllergies() {
    
    $(".add-medication-section").hide();
    $(".document-manager-section").hide();

    let take_medication_allergies = $("#take_medication-allergies").val();
    if(take_medication_allergies=="yes"){
        $(".add-medication-section").show();
    }

    let medicatical_document_upload = $("#medicatical-document_upload").val();
    if(medicatical_document_upload=="yes"){
        $(".document-manager-section").show();
    }
}
takeMedicationAllergies();
</script>

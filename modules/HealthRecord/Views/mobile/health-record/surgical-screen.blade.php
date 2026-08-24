<form method="POST" action="{{url('save-surgical-data')}}" id="health-record-surgical-condition-form">    
    @csrf
<div class="midical-form v1">
    
    <div class="form">
        <div class="form-row">
			
			@if (count($surgical_history))
                @foreach ($surgical_history as $medicalCondition)
                        <div class="col-100 medication-allergies mt-2">
                            
                            <button type="button" class="icon">
								<a href="javascript:void(0)" onclick="OnClickSurgicalDeleted('<?php echo $medicalCondition->id?>')"> 
									<img src="{{ asset('assets/dashboard/assets/images/delete-icon.png')}}" alt="icon">
								</a>
							</button>
                            <div class="aller-row">
                                <div class="left">
                                    <p>Procedure Name</p>
                                </div>
                                <div class="right">
                                    <p>{{ $medicalCondition->name }}</p>
                                </div>
                            </div>
							
							<div class="aller-row">
                                <div class="left">
                                    <p>Procedure Date	</p>
                                </div>
                                <div class="right">
                                    <p>
																
									@if($medicalCondition->procedure_date)
										
										<?php 
										echo DateTime::createFromFormat('d/m/Y', $medicalCondition->procedure_date)->format('F j, Y');
											//echo (new DateTime($medicalCondition->procedure_date))->format('F j, Y') 
										?>
										
									@endif	
									
									</p>
                                </div>
                            </div>
                            <div class="aller-row">
                                <div class="left">
                                    <p>Source</p>
                                </div>
                                <div class="right">
                                    <p>Self Reported	</p>
                                </div>
                            </div>
                            <div class="aller-row">
                                <div class="left">
                                    <p>When Reported</p>
                                </div>
                                <div class="right">
                                    <p>
										@if ($medicalCondition->updated_at)
														{{ $medicalCondition->updated_at->format('F j, Y') }}
										@endif
									</p>
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
            @endif
			
            <div class="col-100 form-group">
                <label>Do you have Surgical History?</label>
                <select name="stake_medication" id="stake_medication" required onchange="surgicalYesNo(this.value)">
                    
                    <option value="yes">Yes</option>
                    <option value="no" selected>No</option>
                </select>
            </div>

            <input type="hidden" id="take_medication_store_url" name="take_medication_store_url" value="{{ route('store.NottakeMedication', $user->id) }}" >
            <input type="hidden" name="segment" value="medical-history" >
            
            <div class="col-100 surgical-condition-section">
                <div class="inner-title">
                    <p>Add new medical condition record</p>
                </div>
            </div>

            <div class="col-100 form-group surgical-condition-section">
                <label>Procedure Name <span class="required-ico"> *</span></label>
                <input class="form-control" type="text" name="procedure_name" id="procedure_name">
				<input type="hidden" name="surgical_uid" id="surgical_uid" value="{{$user->id}}">
            </div>
			
            <div class="col-100 form-group surgical-condition-section">
                <label>Procedure Date <span class="required-ico"> *</span></label>
                <input class="form-control datepicker-ico" type="text" name="procedure_date" id="procedure_date">
            </div>

            <div class="col-100 form-group surgical-condition-section">
                <label>Description <span class="required-ico"> *</span></label>
                <textarea rows="4" name="description" id="sdescription"></textarea>
            </div>

            

            <div class="col-100 surgical-condition-section">
                <div class="inner-title-detail mt-2">
                    <p>Describe any chronic or acute medical issues that you have experienced. Be as detailed as possible.</p>
                </div>
            </div>

			 <div class="col-100 cta surgical-condition-section">
                <div class="recorc-cta">
                    <button type="button" class="primary-button" onclick="updateSurgical('save')">Save</button>
                </div>
            </div>
                    
			<?php /*	
	
            <div class="col-100">
                <div class="inner-title">
                    <p>Add medication record.</p>
                </div>
            </div>

            <div class="col-100">
                <div class="inner-title-detail">
                    <p>Please review the summary of your drug type, dosage and frequency if any medications you have taken/are currently taking as indicated above.</p>
                </div>
            </div>
			*/ ?>
			
           
			
            <div class="col-100 cta">
                <div class="recorc-cta">
                    <button type="button" class="outline-button" onclick="nextTabHealRecoards('preview')" >Back</button>
                    <button type="button" class="primary-button" onclick="updateSurgical('next')">Next</button>
                </div>
            </div>

        </div>
    </div>
</div>
</form>
<style>.surgical-condition-section { display: none;}</style>

<script>

var medicationSurgicalLocalValue = {};    
var medicationSurgicalLocalValueChange = false;
/*
$(document).ready(function() {

    medicationConditionLocalValue = getLocalValueStoreForm(medicationConditionLocalValue,"health-record-medication-condition-form");
    

    $('#health-record-medication-condition-form input, #health-record-medication-condition-form select, #health-record-medication-condition-form textarea').on('change', function() {
        var currentValue = $(this).val();
        var name = $(this).attr('name');
        if(medicationConditionLocalValue[name] !== currentValue) {
            console.log('Field "' + name + '" has changed');
            medicationConditionLocalValueChange = true;
        }

    });


});
*/ 
function updateSurgical(request) {
    
	if(request=="next") {
		nextTabHealRecoards('next_tab');  
		return false;
	}
		
    let stake_medication = $("#stake_medication").val();
    if(stake_medication=="yes") {
	
        let procedure_name = $("#procedure_name").val();
        if(!procedure_name) {
            toastr.error("Name Required");
            return false;
        }
        let procedure_date = $("#procedure_date").val();
        if(!procedure_date) {
            toastr.error("Date Required");
            return false;
        }
		
		let dateRegex = /^(0[1-9]|1[0-2])\/(0[1-9]|[12][0-9]|3[01])\/\d{4}$/;
		if(!dateRegex.test(procedure_date)) {
			toastr.error("Invalid date format. Use MM/DD/YYYY");
			return false;
		}
		
		
        let description = $("#sdescription").val();
		console.log(description);
        if(!description) {
            toastr.error("Description Required");
            return false;
        }

        

        


           toastr.info('Please wait...', 'Processing', {
               timeOut: 0,
               extendedTimeOut: 0,
           });
           let url = '{{url("save-surgical-data")}}';
           const formData = $("#health-record-surgical-condition-form").serialize(); // Serialize form data
           
		   /* let take_medication_store = $("#take_medication_store").val();
           console.log(take_medication_store);
           if(take_medication_store=="no") {
                url = $("#take_medication_store_url").val();
           } */
    
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
							} else {
								window.location.href='{{ Route("personal-record") }}?active-tab=tab6';
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
function OnClickSurgicalDeletedConfirm(id) {
	toastr.info('Please wait...', 'Processing', {
               timeOut: 0,
               extendedTimeOut: 0,
           });
		   
	let csrfToken = $('meta[name="csrf-token"]').attr('content');
	let url = '{{url("surgical-history-deleted")}}';
	var formData = new FormData(); 
	formData.append('_token', csrfToken);
    formData.append('id', id);
	
	$.ajax({
               method: "POST",
               url:url,
               data:formData,
               processData: false, 
               contentType: false,
               success: function(data) {
                   
                   location.reload();

               },
    });
		
}
function OnClickSurgicalDeleted(id) {
	
	$("#surgical-popup-confirmation").addClass("show");
    $("#surgical-popup-confirmation .confirm_btn").attr("onclick","OnClickSurgicalDeletedConfirm('"+id+"')");
}
function surgicalYesNo(value){
    $(".surgical-condition-section").hide();
    if(value=="yes") {
        $(".surgical-condition-section").show();
    }
}
</script>
<link rel="stylesheet" href="https://code.jquery.com/ui/1.14.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="https://code.jquery.com/ui/1.14.1/jquery-ui.js"></script>
<script>
let today = new Date();
let eighteenYearsAgo = new Date();
eighteenYearsAgo.setFullYear(today.getFullYear() - <?php echo config('constants.age_limit') ?>); 
    
$(function() {
    $("#procedure_date" ).datepicker({
    });
});

function profileValidation() {
}  
</script>

<div class="popup" id="surgical-popup-confirmation">
    <div class="popup-content">
      <span class="popup-close-icon" onclick="close_popup('surgical-popup-confirmation')">&times;</span>
  
      <div class="popu-content delete-pup">
          <div class="delete-alert" >
              <img src="{{ asset('assets/dashboard/assets/images/alert-icon.png') }}" />
          </div>
          <div class="complete-form">
             <h2 class="text-center heading">Are you sure ? </h2>
             <p class="text-center message" style="padding: 10px 0 0 0;">Are you sure you want to delete this record?</p>
          </div>
          <div class="popup-cta">
              <a class="primary-button confirm_btn" href="javascript:void(0)">Yes</a>
              <a class="outline-button" href="javascript:void(0)" onclick="close_popup('surgical-popup-confirmation')">No</a>
          </div>
      </div>
    </div>
</div>  
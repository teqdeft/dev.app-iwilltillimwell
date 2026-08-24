@if(Request::segment(3) == 'step-7')
@php
    $scheduleUrl = url('/schedule-consultation/' . Request::segment(2) . '/step-6/' . Request::segment(4)) . '?action=' . request('action');
    $next_url = url('/schedule-consultation/' . Request::segment(2) . '/step-8/' . Request::segment(4)) . '?action=' . request('action');
@endphp 
 <div id="medical-allergies" class="tab-content">
 
@php
$user = Auth::user(); 
@endphp 
	<div class="patient-tab-content">

                            <div class="pat-title">
                                <p>Enter Your Details</p>
                            </div>

                            <div class="col-100 add-new-detail">
                                <button type="button" class="primary-button " onclick="showhideform()">Add</button>
                            </div>
                           
                            <div class="newly-reported">
                                <div class="title">
                                    <p>Newly reported allergies</p>
                                </div>
                               

                                <div class="primary-care-card-v1">
                                    <table class="table" style="margin-bottom: 0" border="0">
                                        <thead>
                                            <tr>
                                                <th width="40%">Condition name</th>
                                                <th width="30%">Source</th>
                                                <th width="20%">When Reported</th>
                                              
                                                <th width="10%">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
										
										@if($user->user_allergies)
											@foreach ($user->user_allergies as $allergy)
                                            <tr name="Ezetimibe-Simvastatin (oral - tablet) 10 mg-10 mg">
                                                <td>
												{{@$allergy->name}}
												<input type="hidden" id="medication-all-tab-deleted-id" value="{{@$allergy->id}}">
												</td>
                                                <td>Self Reported</td>
                                                <td>
													@if ($allergy->updated_at)
														{{ $allergy->updated_at->format('F j, Y') }}
													@endif	
												</td>
                                                
                                                <td> 
          <button type="button" onclick="OnClickHealthDocumentDeleted('medication-all-tab','<?php echo $allergy->id?>')">
                                                        <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M7.5 1.6875C7.35082 1.6875 7.20774 1.74676 7.10225 1.85225C6.99676 1.95774 6.9375 2.10082 6.9375 2.25V2.8125H3.75C3.60082 2.8125 3.45774 2.87176 3.35225 2.97725C3.24676 3.08274 3.1875 3.22582 3.1875 3.375C3.1875 3.52418 3.24676 3.66726 3.35225 3.77275C3.45774 3.87824 3.60082 3.9375 3.75 3.9375H14.25C14.3992 3.9375 14.5423 3.87824 14.6477 3.77275C14.7532 3.66726 14.8125 3.52418 14.8125 3.375C14.8125 3.22582 14.7532 3.08274 14.6477 2.97725C14.5423 2.87176 14.3992 2.8125 14.25 2.8125H11.0625V2.25C11.0625 2.10082 11.0032 1.95774 10.8977 1.85225C10.7923 1.74676 10.6492 1.6875 10.5 1.6875H7.5ZM7.5 7.9875C7.64918 7.9875 7.79226 8.04676 7.89775 8.15225C8.00324 8.25774 8.0625 8.40082 8.0625 8.55V13.8C8.0625 13.9492 8.00324 14.0923 7.89775 14.1977C7.79226 14.3032 7.64918 14.3625 7.5 14.3625C7.35082 14.3625 7.20774 14.3032 7.10225 14.1977C6.99676 14.0923 6.9375 13.9492 6.9375 13.8V8.55C6.9375 8.40082 6.99676 8.25774 7.10225 8.15225C7.20774 8.04676 7.35082 7.9875 7.5 7.9875ZM11.0625 8.55C11.0625 8.40082 11.0032 8.25774 10.8977 8.15225C10.7923 8.04676 10.6492 7.9875 10.5 7.9875C10.3508 7.9875 10.2077 8.04676 10.1023 8.15225C9.99676 8.25774 9.9375 8.40082 9.9375 8.55V13.8C9.9375 13.9492 9.99676 14.0923 10.1023 14.1977C10.2077 14.3032 10.3508 14.3625 10.5 14.3625C10.6492 14.3625 10.7923 14.3032 10.8977 14.1977C11.0032 14.0923 11.0625 13.9492 11.0625 13.8V8.55Z" fill="#8462A8"></path>
                                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M4.49319 5.93775C4.50852 5.80012 4.57407 5.67297 4.67731 5.58067C4.78055 5.48837 4.91421 5.43739 5.05269 5.4375H12.9472C13.0857 5.43739 13.2193 5.48837 13.3226 5.58067C13.4258 5.67297 13.4914 5.80012 13.5067 5.93775L13.6567 7.28925C13.9289 9.738 13.9289 12.2093 13.6567 14.6588L13.6417 14.7915C13.5895 15.2641 13.3812 15.7059 13.0498 16.0468C12.7183 16.3878 12.2827 16.6085 11.8117 16.674C9.94631 16.9355 8.05357 16.9355 6.18819 16.674C5.71723 16.6085 5.28156 16.3878 4.95012 16.0468C4.61867 15.7059 4.41038 15.2641 4.35819 14.7915L4.34319 14.6588C4.07115 12.2098 4.07115 9.73822 4.34319 7.28925L4.49319 5.93775ZM5.55594 6.5625L5.46144 7.413C5.19856 9.77947 5.19856 12.1678 5.46144 14.5343L5.47644 14.667C5.50088 14.8913 5.59954 15.101 5.75674 15.2628C5.91395 15.4246 6.1207 15.5293 6.34419 15.5603C8.10669 15.807 9.89394 15.807 11.6557 15.5603C11.8791 15.5294 12.0857 15.4248 12.2429 15.2631C12.4001 15.1014 12.4988 14.8919 12.5234 14.6678L12.5384 14.5343C12.8009 12.168 12.8009 9.77925 12.5384 7.413L12.4439 6.5625H5.55594Z" fill="#8462A8"></path>
                                                        </svg> 
                                                    </button>
                                                </td>
                                            </tr>
											@endforeach
										@endif 
                                            
										
										</tbody>
                                    </table>
                                </div>
                                
                                   

                                <div class="fot-detail">
                                    <p>Please review the summary of your drug type, dosage and frequency if any medications you have taken/are currently taking as indicated above.</p>
                                </div>

                                

                            </div>
							
							<div id="medical-allergies-add-section" style="display:none;">
								<form id="health-record-medication-allergy-form" method="POST" action="{{ route('store.medication.allergy', $user->id) }}">
								@csrf
								
								 <input type="hidden" name="medicationAllergyForeignId" id="medicationAllergyForeignId" value="" >
            <input type="hidden" name="medicationAllergyDamConceptIdType" id="medicationAllergyDamConceptIdType" value="" >
            <input type="hidden" name="medicationAllergyDamConceptId" id="medicationAllergyDamConceptId" value="" >
            <input type="hidden" name="medicationAllergyName" id="medicationAllergyName" value="" >
			
									<div class="col-100 form-group">
										<label>Do you have medical allergies?</label>
										<select name="medication_allergies-selection" id="medication_allergies-selection" class="medication_allergies-selection">
											
										</select>
									</div>
									<div class="col-100 cta">
										<button type="button" class="primary-button" onclick="helthRecordMedicationAllergiesFormSubmit('medication-all-tab')">Save</button>
									</div>
								</form>
							</div>	
							

                            <div class="col-100 cta mt-2">
                                <div class="recorc-cta" style="width: 100%; display: flex; justify-content: space-between; align-items: center;">   
                                    <a href="{{$scheduleUrl}}" class="outline-button">Back</a>
                                    <a class="primary-button" href="{{$next_url}}" >Next</a>
                                </div>    
                            </div>

                        </div>
                      
                 
				 
				 
</div>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<style>.medication-section { display: none;} </style>
<script>
var allergy_id = 0;
$(function(){
    $(".schedule-consultation .back-btn").attr("href", "{{ $scheduleUrl }}");
});
function showhideform() {
	$("#medical-allergies-add-section").show();
	$('html, body').animate({
		scrollTop: $('#medical-allergies-add-section').first().offset().top
	}, 500);
}
function OnClickHealthDocumentDeleted(request_from,allergyid) {
	allergy_id = allergyid;
    $("#health-record-popup-confirmation").addClass("show");
    $(".confirm_btn").attr("onclick","DeletedConfirmation('"+request_from+"')");

}
function DeletedConfirmation(request_from) {
	
    toastr.info('Please wait...', 'Processing', {
               timeOut: 0,
               extendedTimeOut: 0,
           });
		   
    let url = "{{url('medication-allergies/delete')}}";
	
    const csrfToken = $('meta[name="csrf-token"]').attr('content');
	
    var formData = new FormData(); 
	formData.append('_token', csrfToken);
    formData.append('id', allergy_id);
    if(request_from=="medication-condition-tab" || request_from=="document-manager-tab") {
        formData.append('_method', 'DELETE');
    }
    $.ajax({
               method: "POST",
               url:url,
               data:formData,
               processData: false, 
               contentType: false,
               success: function(data) {
                   
                  location.reload();

               }
    });
}

$(document).ready(function() {
	
	 $('.medication_allergies-selection').select2({
        width: '100%',
        minimumInputLength: 2,
        ajax: {
            url: `${SITE_URL}/search-medication-allergy`,
            dataType: 'json',
            type: "GET",
            quietMillis: 100,
            data: function (params) {
                return {
                keyword: params.term // search term
                };
            },
            processResults: function (response) {
                return {
                    results: $.map(response.data, function (item) {
                        return {
                            text: item.text,
                            damConceptId: `${item.damConceptId}`,
                            medicationAllergyForeignId: `${item.medicationAllergyForeignId}`,
                            damConceptIdType: `${item.damConceptIdType}`,
                            medicationAllergyName: `${item.medicationAllergyName}`,
                            id: item.id,

                        }
                    })
                };
            },
            tags: true,
        },language: {
                inputTooShort: function () {
                    return "Please search medication"; // Custom message
                }
            }
    }).on('select2:select', function (e) {
        var data = e.params.data;
        console.log( data );
        $('input[name="medicationAllergyForeignId"]').val(data.medicationAllergyForeignId);
        $('input[name="medicationAllergyDamConceptIdType"]').val(data.damConceptIdType);
        $('input[name="medicationAllergyDamConceptId"]').val(data.damConceptId);
        $('input[name="medicationAllergyName"]').val(data.medicationAllergyName);
    }).val(0).trigger('change');
	
});

function helthRecordMedicationAllergiesFormSubmit() {
	

   
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
                      
                       setTimeout(function(){ location.reload(); }, 500);
                   } else {
                       toastr.warning(data.message);
                   }

               },
           });
          
        
        

}
</script>					
<div class="popup" id="health-record-popup-confirmation">
    <div class="popup-content">
      <span class="popup-close-icon" onclick="close_consemt_popup('health-record-popup-confirmation')">&times;</span>
  
      <div class="popu-content delete-pup">
          <div class="delete-alert" >
              <img src="{{ asset('assets/dashboard/assets/images/alert-icon.png')}}" />
          </div>
          <div class="complete-form">
             <h2 class="text-center heading">Are you sure ? </h2>
             <p class="text-center message" style="padding: 10px 0 0 0;">Are you sure you want to delete this record?</p>
          </div>
          <div class="popup-cta">
              <a class="primary-button confirm_btn" href="javascript:void(0)">Yes</a>
              <a class="outline-button" href="javascript:void(0)" onclick="close_consemt_popup('health-record-popup-confirmation')">No</a>
          </div>
      </div>
    </div>
</div>  					
@endif					
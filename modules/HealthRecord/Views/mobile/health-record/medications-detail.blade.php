<form method="POST" action="{{ route('store.medication', $user->id) }}" id="health-record-medication-detail-form">    
    @csrf
    <input type="hidden" name="segment" value="medications"/>
    <input type="hidden" id="NottakeMedication" value="{{ route('store.NottakeMedication', $user->id) }}">

<div class="midical-form v1">
    
    <div class="form">
       
        <div class="form">
            <div class="form-row">
			
					
			@if ($medications->count() > 0)
				<div class="medication-v1">
                <div class="col-100">
                    <div class="inner-title">
                        <p>Medication Record</p>
                    </div>
                </div>

                <div class="col-100">
                    <div class="inner-title-detail">
                        <p>Please review the summary of your drug type, dosage, and frequency for any medications you have taken or are currently taking, as indicated below.</p>
                    </div>
                </div>
				<input type="hidden" id="medication-d-section-url" value="{{ url('medication-details/delete') }}">
				
				<div class="" style="width: 100%;">
						@if ($medications)
						@foreach ($medications as $medication)
									<div class="col-100 medication-allergies mt-2">
									   
					<button type="button" class="icon" onclick="OnClickHealthDocumentDeleted('medication-d-section')">
                        <img src="{{ asset('assets/dashboard/assets/images/delete-icon.png')}}" alt="icon">
                    </button>	
					
					<input type="hidden" id="medication-d-section-deleted-id" value="{{@$medication->id}}">
					
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
												<p>Frequency Per Day</p>
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
				</div>
			@endif


			<div class="medication-add-v1 col-100">	
                <div class="col-100 form-group">
                    <label>Do You Take Any Medications?</label>
                    <select name="take_medication" id="take_medication" required onchange="getmedicationsV(this.value)">
                        <option value="yes" @if($medications->count() > 0) selected @endif>Yes</option>
                        <option value="no"  @if ($medications->count() <=0) selected @endif>No</option>
                    </select>
                </div>
				<div class="medicationadd-v2 col-100" @if ($medications->count() <=0) style="display:none;" @endif >	
					<div class="col-100">
						<div class="inner-title">
							<p>Add medication record</p>
						</div>
					</div>

					<div class="col-100 form-group">
						<label>Medication Search <span class="required-ico"> *</span></label>
						<select name="medication-search" id="medication-search-id" class="medication_search-selection form-control">
						</select>
						<input type="hidden" name="medicationForeignId" id="medicationForeignId" value="{{ $inComplete->foreignId??''  }}">
						<input type="hidden" name="medicationNDC" id="medicationNDC" value="{{ $inComplete->ndc??''  }}">
						<input type="hidden" name="medicationName" id="medicationName" value="">
					</div>

					<div class="col-100 form-group">
						<label>Frequency Per Day <span class="required-ico"> *</span></label>
						<input type="number" class="form-control" name="medicationFrequency" id="medicationFrequency" value="" onkeyup="lengthValidation(this,'2')" autocomplete="off"/>
							
					</div>

					<div class="col-100 form-group ">
						<label>Comment <span class="required-ico"> *</span></label>
						<textarea placeholder="Comment*" rows="4" name="medicationComment" id="medicationComment"></textarea>
					</div>
					
					<div class="col-100 form-group">
						<label>Currently using <span class="required-ico"> *</span></label>
						<select name="medicationCurrentUse" id="">
							
							<option value="true">Yes</option>
							<option value="false">No</option>
						</select>
					</div>
					
					<div class="col-100 cta">
						<div class="recorc-cta ct-bt-center">
							<button type="button" class="primary-button" onclick="helthRecordMedicationFormSubmit('save')">Save</button>
						</div>
					</div>
                </div>
			</div>	
				
				
                <div class="col-100 cta">
                    <div class="recorc-cta">
                        <button type="button" onclick="nextTabHealRecoards('preview')" class="outline-button">Back</button>
                        <button type="button" class="primary-button" onclick="helthRecordMedicationFormSubmit('next')">Next</button>
                    </div>
                </div>

            </div>
        </div>

    </div>
</div>
</form>
@push('scripts')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<style> </style>
<script>
 
var medicationLocalValue = {};    
var medicationLocalValueChange = false;

$(document).ready(function() {
    
	
	

	
    medicationLocalValue = getLocalValueStoreForm(medicationLocalValue,"health-record-medication-detail-form");
    console.log(medicationLocalValue);

    $('#health-record-medication-detail-form input, #health-record-medication-detail-form select').on('change', function() {
        var currentValue = $(this).val();
        var name = $(this).attr('name');
        if(medicationLocalValue[name] !== currentValue) {
            console.log('Field "' + name + '" has changed');
            medicationLocalValueChange = true;
        }

    });
    console.log(medicationLocalValueChange);


    $('.medication_search-selection').select2({
        placeholder: 'Medication Search...',
        width: '100%',
        minimumInputLength: 2,
        ajax: {
            url: `${SITE_URL}/search-medication`,
            dataType: 'json',
            type: "GET",
            quietMillis: 100,
            data: function (params) {
                return {
                keyword: params.term // search term
                };
            },
            processResults: function (response) {
                console.log( response.data );
                return {
                    results: $.map(response.data, function (item) {
                        return {
                            text: item.text,
                            ndc: `${item.ndc}`,
                            foreign: `${item.data}`,
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
        $('input[name="medicationForeignId"]').val(data.foreign);
        $('input[name="medicationNDC"]').val(data.ndc);
        $('input[name="medicationName"]').val(data.text);
    }).val(0).trigger('change');

    let medicationNameValue = $('input[name="medicationName"]').val();

    if( medicationNameValue != '' ){
        var newOptionMedication = new Option($('input[name="medicationName"]').val(), 12, false, false);
        $('.medication_search-selection').append(newOptionMedication).trigger('change');
    }


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

    let medicalNameValue = $('input[name="medicationAllergyName"]').val();

    if( medicalNameValue != '' ){
        var newOption = new Option($('input[name="medicationAllergyName"]').val(), 12, false, false);
        $('.medication_allergies-selection').append(newOption).trigger('change');
    }


});
</script>
<script>
function helthRecordMedicationFormSubmit(request) {
         
		if(request=="next") {
			nextTabHealRecoards('next_tab');  
			return false;
		}
	
        let take_medication = $("#take_medication").val();
		console.log("----"+take_medication);
        if(medicationLocalValueChange || take_medication=="yes") {
       
            let medicationsearchid = $("#medication-search-id").val();
            if(!medicationsearchid) {
                toastr.error("Medication Name Required");
                return false;
            }

            let medicationFrequency = $("#medicationFrequency").val();
            if(!medicationFrequency) {
                toastr.error("Medication Frequency Required");
                return false;
            }
			
            let medicationComment = $("#medicationComment").val();
            if(!medicationComment) {
                toastr.error("Description Required");
                return false;
            }

        toastr.info('Please wait...', 'Processing', {
            timeOut: 0,
            extendedTimeOut: 0,
        });
        let url = $("#health-record-medication-detail-form").attr("action");
        const formData = $("#health-record-medication-detail-form").serialize();
        
        if(take_medication=="no") {
             url = $("#NottakeMedication").val();
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
						} else {
							window.location.href='{{ Route("personal-record") }}?active-tab=tab3';
						}
                        
                    } else {
                        toastr.error(data.message);
                    }

                },
				error: function(xhr, status, error) {
					toastr.clear();
					toastr.error("Please try again");
				}
            });
            return false;
        }
        nextTabHealRecoards('next_tab');    
}
function getmedicationsV(value){
    $(".medicationadd-v2").hide();
    if(value=="yes") {
        $(".medicationadd-v2").show();
    }
}
</script>  
@endpush
@extends('layouts.dashboard')
@section('content')
@section('moduleStyle')
    @include('HealthRecord::style')
@endsection
<div class="main-panel medications-main-v1">
   <div class="content-wrapper">
      <div class="row">
         <div class="col-md-12 grid-margin top-header-page">
            <div class="row">
               <div class="col-12 col-xl-6 mb-4 mb-xl-0">
                  <h3 class="font-weight-bold">Medications</h3>
                  <h6 class="font-weight-normal mb-0">Your Personalized Health Portal</h6>
               </div>
            </div>
         </div>
      </div>
<?php
if(request()->has('user_id')) {
   $user_mid = request()->get('user_id');
} else {
    $user_mid = $user->id;
}
?>	  
      <div class="main-content-box">
	  
        <div class="record-tabs-box">
         <div class="row">
            <div class="col-12 stretch-card">
               <div class="card">
					
					@include('HealthRecord::medications-card-header',['slug'=>'medications'])


				
                  <div class="card-body personal-info-card-box">
                    <div class="row">
                        <div class="col">
                            <form class="forms-sample clickOffSubmitBtn" method="post" action="{{ route('store.NottakeMedication', $user_mid) }}">
                                {{ csrf_field() }}
								<div class="for-lab">
									<label><h4 class="card-title">Do you take any Medications?</h4></label>
								</div>
								<div class="form-group">
									<div class="form-check-inline">
										<input class="form-check-input take_medication-check" type="radio" name="take_medication" id="take_medication-yes"
											value="yes" >
										<label class="form-check-label" for="take_medication-yes">Yes</label>
									</div>
									<div class="form-check-inline">
										<input class="form-check-input take_medication-check" type="radio" name="take_medication" id="take_medication-no"
											value="no" 
											checked
											>
											
											
											
										<input type="hidden" name="segment" value="{{ getSegment(1) }}" >
										<label class="form-check-label" for="take_medication-no">No</label>
									</div>
								</div>
                               <p class="errorMedicalCheck mt-3 mb-0 alert alert-danger displayNone"></p>
                            </form>
                        </div>
                    </div>
                    <div class="medical_show-check mt-4" id="medical_show-check"  style="display:none;">
                        <h4 class="card-title">Add Medication Record</h4>
						
						<h5 class="mb-0 mr-2 lh-2 ">Please list any medications you are currently taking, including name, dosage, and how often you take them.</h5>
						
                        <form class="forms-sample clickOnSubmitBtn med-ser-v1" method="post" action="{{ route('store.medication', $user_mid) }}" id="medication-form">
                        {{ csrf_field() }}
                        <div class=" row">
                           <div class="col-lg-6">
                              <div class="form-group">
                                 <label>Medication Search <span class="required-ico">*</span></label>
                                <div id="selectMedicationAllergySearch">
                                    <select class="medication_search-selection">
                                    </select>
                                </div>
                                 {{-- <select id="medicationSearch" class="medication-option">
                                 </select> --}}
                                 <input type="hidden" name="medicationForeignId" id="medicationForeignId" value="{{ $inComplete->foreignId??''  }}">
                                 <input type="hidden" name="medicationNDC" id="medicationNDC" value="{{ $inComplete->ndc??''  }}">
                                 <input type="hidden" name="medicationName" id="medicationName" value="">
                              </div>
                           </div>

                           <div class="col-sm-6">
                              <div class="form-group">
                                 <label>Frequency Per Day <span class="required-ico">*</span></label>
                                 <input type="text" class="form-control" name="medicationFrequency" placeholder="Frequency" value="" onkeyup="LengthValidation(this,'2')">
                              </div>
                           </div>
                        </div>
                        <div class="row">
                           <div class="col-sm-12">
                              <div class="form-group">
                                 <label for="medicationComment">Comment <span class="required-ico">*</span></label>
                                 <textarea class="form-control" id="medicationComment" name="medicationComment" rows="7"></textarea>
                              </div>
                           </div>
                           <div class="col-sm-12">
                              <div class="form-group">
                                 <label>Currently Using <span class="required-ico">*</span></label>
                                 <div class="d-flex custom-check-box">
                                    <div class="form-check mr-5">
                                       <label class="form-check-label">
                                          <input type="radio" class="form-check-input" name="medicationCurrentUse" id="optionsRadios1" value="true"
                                            @if ( isset($inComplete->currentlyUse) && $inComplete->currentlyUse == 'true' )
                                                    checked
                                            @endif      >
                                          Yes
                                          <i class="input-helper"></i></label>
                                       </div>
                                       <div class="form-check">
                                          <label class="form-check-label">
                                             <input type="radio" class="form-check-input" name="medicationCurrentUse" id="optionsRadios2" value="false"
                                                @if ( isset($inComplete->currentlyUse) && $inComplete->currentlyUse == 'false' )
                                                    checked
                                            @endif >
                                             No
                                             <i class="input-helper"></i></label>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
								 
								 <div class="col-sm-12 cta-save">
									<button class="btn btn-primary" onclick="return savMedication()"> Save</button>
								 </div>
								 
                              </div>
                           </form>
                        </div>
                    </div>
                     </div>
                  </div>
               </div>
            </div>
			   
			   
			   
            </div>
            <div class="record-tabs-box">

               <div class="inner-record-tab-box">
                  <div class="container-fluid mt-3">
                     <div class="row">
                        <div class="col-md-12 ml-auto col-xl-12 mr-auto px-0">
                           <div class="card">
                              <div class="card-header " >
                                <div class="ip-hamburger-icon d-flex align-items-center">
                                  <ul>
                                      <li></li>
                                      <li></li>
                                      <li></li>

                                   </ul>
                                   <h5 class="fs-16 mb-0">Members</h5>
                                 </div>
                                 
                              </div>
                              <div class="card-body add-margin-cus adds">
                                 <!-- Tab panes -->
                                 <div class="tab-content p-0">
                                    <div 
									
									class="tab-pane {{ !request()->get('user_id') ? 'active' : '' }}"
									
									
									
									
									id="user{{ Auth::user()->id }}" role="tabpanel">
                                       <div class="row record-tabs-box-div" style="display:none;">
                                         
                                          <div class="col-lg-12 grid-margin stretch-card ">
                                             <div class="card-box card">
                                                
                                                
                                                <div class="card-body px-0">
                                                   <div class="table-responsive">
                                                      <table class="table table-hover table-striped medication-table-box table-bordered">
                                                         <thead>
                                                            <tr>
                                                               <th>Medication</th>
                                                               <th>Frequency Per Day</th>
                                                               <th>Currently Taking?</th>
                                                               <th>Comment</th>
                                                               <th>Actions</th>
                                                            </tr>
                                                         </thead>
                                                         <tbody>
														@if (count($medications)) 
                                                            @foreach ($medications as $medication)
                                                            <tr>
                                                               <td>{{ @$medication->name }}</td>
                                                               <td>{{ @$medication->frequency }}</td>
                                                               <td class="{{ ($medication->currentlyUse == true) ? 'text-danger' : 'text-success' }}">
                                                                  {{ (@$medication->currentlyUse == 'true') ? 'Yes' : 'No' }}
                                                               </td>
                                                               <td>{{ @$medication->comment }}</td>
                                                               <td>
                                                                  @if (@$medication->currentlyUse == 'true')
																	  
																<div class="med-action-v1">  
                                                                  <a class="medication-status" href="#" id="medication-inactive" medication-id = "{{ $medication->medicationId??'___'.$medication->id }}" url-string="{{ url('medication-inactive') }}" u-id = {{ $medication->userId }} > <label class="badge badge-danger-cus"><i class="fas fa-ban mr-1" ></i>  I"m no longer taking this medication</label></a>
																</div>  
															  
                                                                 
                                                                  @endif
																  
																<div class="med-action-v2">
																	<a class="deleteByAjax" href="javascript:;" number="{{ $medication->id }}" data-url="{{ url('medication-details/delete') }}"  data-toggle="tooltip" title="Delete"><label class="badge badge-danger-cus"><i class="fas fa-trash"></i></label></a>
																</div>	
																  
                                                               </td>
                                                            </tr>
                                                            @endforeach
														@endif	
                                                         </tbody>
                                                      </table>
                                                   </div>
                                                </div>
                                                
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                    @if ($dependents)
                                    @foreach ($dependents as $dependent)
								
                                    <div class="tab-pane {{ request()->get('user_id')==$dependent->id ? 'active' : '' }}" id="user{{ $dependent->id }}" role="tabpanel">
                                       <div class="row">
                                          <div class="col-lg-12 grid-margin stretch-card record-tabs-box-div">
                                             <div class="card">
                                                <div class=" d-flex  align-items-center">
                                                   <h4 class=" mb-0 mr-2 lh-2 ">Indicate the drug type, dosage, and frequency of any medications you have taken/are currently taking.</h4>
                                                </div>
                                                @php $medications_d = $dependent->user_medications; @endphp
                                                @if (count($medications_d))
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
                                                            @foreach ($medications_d as $medication)
                                                            <tr>
                                                               <td>{{ @$medication->name }}</td>
                                                               <td>{{ @$medication->frequency }}</td>
                                                               <td class="{{ ($medication->currentlyUse == true) ? 'text-danger' : 'text-success' }}">
                                                                  {{ (@$medication->currentlyUse == 'true') ? 'Yes' : 'No' }}
                                                               </td>
                                                               <td>{{ @$medication->comment }}</td>
                                                               <td>
																<div class="med-action-v1">
                                                                  @if (@$medication->currentlyUse == 'true')
                                                                  <a href="javascript:void(0)"> <label class="badge badge-danger-cus"><i class="fas fa-ban mr-1" ></i>  I"m no longer taking this medication</label></a>
                                                                   @else
                                                                  <span>-</span>
                                                                  @endif
																  </div>
																  <div class="med-action-v2">
																	<a class="deleteByAjax" href="javascript:;" number="{{ $medication->id }}" data-url="{{ url('medication-details/delete') }}"  data-toggle="tooltip" title="Delete"><label class="badge badge-danger-cus"><i class="fas fa-trash"></i></label></a>
																</div>
																
                                                               </td>
                                                            </tr>
                                                            @endforeach
                                                         </tbody>
                                                      </table>
                                                   </div>
                                                </div>
                                                @endif
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                    @endforeach
                                    @endif
                                 </div>
								 
                                
<div class="col-md-12 grid-margin">
    <div class="containerNext float-right">
    
	
	
	@if(request()->has('user_id'))
		<a href="{{ url('personal-record')}}/{{ request()->get('user_id') }}" class="btn btn-primary showLoaderPageLoad"><i class="fa fa-chevron-left fa-arrow-icon fa-arrow-icon-back"></i> Back</a>	
		<a href="{{ url('medication-allergies') }}?user_id={{ request()->get('user_id') }}" class="btn btn-primary showLoaderPageLoad">
			Next <i class="fa fa-chevron-right fa-arrow-icon"></i>
		</a>
	@else
		<a href="{{ url('personal-record')}}" class="btn btn-primary showLoaderPageLoad"><i class="fa fa-chevron-left fa-arrow-icon fa-arrow-icon-back"></i> Back</a>
		<a href="{{ url('medication-allergies') }}" class="btn btn-primary showLoaderPageLoad">
			Next <i class="fa fa-chevron-right fa-arrow-icon"></i>
		</a>
	@endif	
	
	
                        </div>
</div>
								
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <!-- update modal  start-->
         <div class="modal fade" id="updatemodal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog  modal-lg" role="document">
               <div class="modal-content">
                  <div class="modal-header theme-bg-color">
                     <h3 class="card-title mb-0">Update Medication Record</h3>
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                     </button>
                  </div>
                  <div class="modal-body">
                     <div class="card-body personal-info-card-box p-0">
                        <form class="forms-sample">
                           <div class=" row">
                              <div class="col-sm-6">
                                 <div class="form-group">
                                    <label>Medication Name </label>
                                    <input type="text" class="form-control"  placeholder="Medication Name" value="parachlorophenol (bulk) 100 % powder">
                                 </div>
                              </div>
                           </div>
                           <div class=" row">
                              <div class="col-sm-6">
                                 <div class="form-group">
                                    <label>Frequency</label>
                                    <input type="text" class="form-control"  placeholder="Frequency">
                                 </div>
                              </div>
                           </div>
                           <div class="row">
                              <div class="col-sm-12">
                                 <div class="form-group">
                                    <label for="exampleTextarea1">Comment</label>
                                    <textarea class="form-control" id="exampleTextarea1" rows="7"></textarea>
                                 </div>
                              </div>
                              <div class="col-sm-12">
                                 <div class="form-group">
                                    <label>Currently Using</label>
                                    <div class="d-flex custom-check-box">
                                       <div class="form-check mr-5">
                                          <label class="form-check-label">
                                             <input type="radio" class="form-check-input" name="optionsRadios" id="optionsRadios1" value="">
                                             Yes
                                             <i class="input-helper"></i></label>
                                          </div>
                                          <div class="form-check">
                                             <label class="form-check-label">
                                                <input type="radio" class="form-check-input" name="optionsRadios" id="optionsRadios2" value="option2" checked="">
                                                No
                                                <i class="input-helper"></i></label>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </form>
                           </div>
                        </div>
                        <div class="modal-footer">
                           <button type="button" class="btn btn-primary">Save changes</button>
                        </div>
                     </div>
                  </div>
               </div>
<script>
function savMedication(){
	if($('#medication-form').valid()) {
		
		let medicationForeignId = $("#medicationForeignId").val();
		let medicationComment = $("#medicationComment").val();
		if (medicationForeignId === "" || medicationForeignId === null || medicationForeignId === "0") {
			toastr.error("Enter Valid Medication Name");
			return false;
		}
		
		if (!medicationComment) {
			toastr.error("A comment is required to proceed.");
			return false;
		}
		
	}	
}
</script>
@endsection

@section('moduleScript')

@include('HealthRecord::script')

@if(count($medications))
<script>
$(function(){
	
		$('input[name="take_medication"][value="yes"]').prop('checked', true).trigger('click').trigger('change');
	
});
</script>
@endif
@endsection

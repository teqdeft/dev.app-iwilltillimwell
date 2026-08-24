@extends('layouts.dashboard')
@section('content')

<div class="main-panel">
   <div class="content-wrapper">
      <div class="row">
         <div class="col-md-12 grid-margin top-header-page">
            <div class="row">
               <div class="col-12 col-xl-6 mb-4 mb-xl-0">
                  <h3 class="font-weight-bold">Medical Conditions</h3>
                  <h6 class="font-weight-normal mb-0">Your Personalized Health Portal</h6>
               </div>
            </div>
         </div>
      </div>
      <div class="main-content-box medical-history-main">
		<div class="record-tabs-box">
         <div class="row">
            <div class="col-12 grid-margin stretch-card">
               <div class="card">
			   
					@include('HealthRecord::medications-card-header',['slug'=>'medical-history'])
					
					
                  <div class="card-body personal-info-card-box">
                        <div class="row mb1_5">
                            <div class="col">
                                <form class="forms-sample clickOffSubmitBtn" method="post" action="{{ route('store.NottakeMedication', $user->id) }}">
                                    {{ csrf_field() }}
									<div class="lab-mian">
										<label><h4 class="card-title">Do you have a medical history?</h4></label>
									</div>
									<div class="form-sam">
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
											<label class="form-check-label" for="take_medication-no">No</label>
											<input type="hidden" name="segment" value="{{ getSegment(1) }}"/>
										</div>
									</div>
                                    <p class="errorMedicalCheck mt-3 mb-0 alert alert-danger displayNone"></p>
                                </form>
                            </div>
                        </div>
                        <div class="medication-rec-cont medical_show-check" id="medical_show-check" @if ( empty($inComplete) ) style="display:none;" @endif >
							<div class="ad-medi">
								<h4 class="card-title">Add New Medical Conditions Record</h4>
								<h5 class=" mb-0 mr-2 lh-2 ">Please describe any chronic or acute medical conditions you have experienced. Include as much detail as possible.</h5>
							</div>
                            <form class="forms-sample clickOnSubmitBtn" method="post" action="{{ route('store.medicalcondition', $user->id) }}" id="medication-condition-form">
                            {{ csrf_field() }}
								<div class="medical_field-container">
									<div class="card medical_history-record mt1_5">
										<div class=" row mt1_5">
											<div class="col-md-6">
												<div class="form-group">
													<label>Condition Name <span class="required-ico">*</span> </label>
													<input 
													type="text" 
													class="form-control medicalConditionName" 
													placeholder="Condition Name" 
													name="medical[0][medicalConditionName]" 
													id="medicalConditionName"
													onkeyup="nameValidationTextOnly(this)"
													>
												</div>
											</div>
											<div class="col-md-6">
												<div class="deleteButton float-right">
													<a class="displayNone"><label class="badge badge-danger-cus"><i class="far fa-trash-alt"></i></label></a>
												</div>
											</div>
									   
									   
											<div class="col-md-6">
												<div class="form-group">
													<label>Description <span class="required-ico">*</span></label>
													<textarea class="form-control medicalConditionDescription" id="medicalConditionDescription" rows="6" placeholder="Description" name="medical[0][medicalConditionDescription]"></textarea>
												</div>
											</div>
											
											<div class="col-md-6">
												<div class="form-group">
													<label>Status <span class="required-ico">*</span></label>
													<div class="d-flex custom-check-box">
														<div class="form-check mr-5">
														<label class="form-check-label">
															<input type="radio" class="form-check-input medicalConditionStatus" name="medical[0][medicalConditionStatus]" id="optionsRadios3" value="1">
															Current Condition
															<i class="input-helper"></i></label>
														</div>
														<div class="form-check">
															<label class="form-check-label">
																<input type="radio" class="form-check-input medicalConditionStatus" name="medical[0][medicalConditionStatus]" id="optionsRadios4" value="2" >
																Previous Condition
																<i class="input-helper"></i></label>
														</div>
													</div>
												</div>
											</div>
											<div class="col-sm-6 cta-save">
												<button class="btn btn-primary" onclick="return saveMedicalHistory()"> Save</button>
											</div>
							
										</div>
                                    </div>
                                    </div>
                                </form>
								<?php /*
								<div class=" row">
									<div class="col-sm-6">
										<a href="#!" class="btn btn-primary float-right mt1_5 medical_add-more" >Add More</a>
									</div>
								</div>
								*/ ?>
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
                              <div class="card-header " style="display:none;">
                                <div class="ip-hamburger-icon d-flex align-items-center">
                                  <ul>
                                      <li></li>
                                      <li></li>
                                      <li></li>

                                   </ul>
                                   <h5 class="fs-16 mb-0">Members</h5>
                                 </div>
                                <div class="menu-tabs-cus">
                                 <ul class="nav nav-tabs nav-tabs-neutral nav-tabs-responsive theme-bg-color" role="tablist" data-background-color="orange">
                                    <li class="nav-item">
                                       <a class="nav-link {{ (Request::segment(2) == '' || Request::segment(2) == Auth::user()->id ) ? 'active' : '' }}" href="{{ url('/medical-history/') }}">{{ ucfirst(Auth::user()->fname) }} {{ ucfirst(Auth::user()->lname) }}</a>
                                    </li>
                                    @if ($dependents)
                                    @foreach ($dependents as $dependent)
                                    <li class="nav-item">

                                       @if ($dependent->age < Config::get('constants.minor_age'))
                                       <a class="nav-link {{ ($user->id == $dependent->id) ? 'active' : '' }}" href="{{ url('/medical-history/'.$dependent->id) }}" role="tab"> {{ $dependent->name }}</a>
                                       @else
                                       <!-- <a class="nav-link" href="javascript:void(0)" title="This Dependent is over 18 and must manage their own records"> <span class="text-danger">*</span> {{ $dependent->name }}</a> -->
                                       @endif
                                    </li>
                                    @endforeach
                                    @endif
                                 </ul>
                               </div>
                              </div>
                              <div class="card-body add-margin-cus adds">
                                 <!-- Tab panes -->
                                 <div class="tab-content p-0">
                                    <div class="tab-pane {{ !request()->get('user_id') ? 'active' : '' }}" id="user{{ Auth::user()->id }}" role="tabpanel">
                                       <div class="row">
                                          <div class="col-lg-12 grid-margin stretch-card">
                                             <div class="card ">
                                                
                                                @if (count($medicalConditions))
                                                <div class="card-body px-0">
                                                   <div class="table-responsive">
                                                      <table class="table table-hover table-striped medication-table-box table-bordered">
                                                         <thead>
                                                            <tr>
                                                               <th>Condition Name</th>
                                                               <th width="20%">Status</th>
                                                               <th>Description</th>
                                                               <th>Actions</th>
                                                            </tr>
                                                         </thead>
                                                         <tbody>
                                                            @foreach ($medicalConditions as $medicalCondition)
                                                            <tr>
                                                               <td>{{ $medicalCondition->name }}</td>
                                                               <td>{{ ($medicalCondition->status == 1) ? 'Current Condition' : 'Previous Condition' }}</td>
                                                               <td>{{ $medicalCondition->description }}</td>
                                                               <!-- <td>
                                                                  <div class="d-flex ">
                                                                     <a href="#0" class=" mr-2 medicalHistoryPopupClick" data-toggle="modal" data-id="{{ $medicalCondition->medicalConditionId }}" data-target="#updatemodal2"><label class="badge badge-success badge-danger-cus"><i class="fas fa-edit mr-1 "></i> Update</label></a>
                                                                     <a href="{{ url('/medical-history-inactive/'. $medicalCondition->medicalConditionId .'/' . $medicalCondition->userId) }}" class="beforeRedirect"> <label class="badge badge-danger-cus"><i class="far fa-trash-alt mr-2"></i>Delete</label></a>
                                                                  </div>
                                                               </td> -->
                                                               <td>
                                                                  <div class="d-flex ">
                                                                    
																	<?php /*	
																	  
																	  <a href="#0" class=" mr-2 medicalHistoryPopupClick" data-toggle="modal" data-id="{{ $medicalCondition->medicalConditionId }}" data-target="#updatemodal2"><label class="badge badge-success badge-danger-cus"><i class="fas fa-edit mr-1 "></i> Update</label></a>
                                                                     
																	 */ ?>
																	 
																	 <a 
																		href="javascript:;"
																		data-toggle="tooltip"
																		class="deleteByAjax"
																		number="{{$medicalCondition->medicalConditionId}}"
                                                                        data-url="{{ url('/medical-history-inactive/'. $medicalCondition->medicalConditionId .'/' . $medicalCondition->userId) }}">
																		<label class="badge badge-danger-cus"><i class="far fa-trash-alt mr-2"></i>Delete</label>
																				 
																	</a>
                                                                  
																	 
																	 
                                                                     <form method="post"
                                                                           id="destroy-medical-history-form-{{$medicalCondition->medicalConditionId}}"
                                                                           action="{{ url('/medical-history-inactive/'. $medicalCondition->medicalConditionId .'/' . $medicalCondition->userId) }}"
                                                                           style="display:none">
                                                                           @csrf
                                                                           @method('DELETE')
                                                                     </form>
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
                                    @if ($dependents)
                                    @foreach ($dependents as $dependent)
                                    <div class="tab-pane {{ request()->get('user_id')==$dependent->id ? 'active' : '' }}" id="user{{ $dependent->id }}" role="tabpanel">
                                       <div class="row">
                                          <div class="col-lg-12 grid-margin stretch-card">
                                             <div class="card ">
                                                <div class=" d-flex  align-items-center">
                                                   <h4 class=" mb-0 mr-2 lh-2 ">Describe any chronic or acute medical issues that you have experienced. Be as detailed as possible.</h4>
                                                </div>
                                                @php $medicalConditions_d = $dependent->user_medical_condition; @endphp
                                                @if (count($medicalConditions_d))
                                                <div class="card-body px-0">
                                                   <div class="table-responsive">
                                                      <table class="table table-hover table-striped medication-table-box table-bordered">
                                                         <thead>
                                                            <tr>
                                                               <th>Condition Name</th>
                                                               <th width="20%">Status</th>
                                                               <th>Description</th>
                                                               <th>Actions</th>
                                                            </tr>
                                                         </thead>
                                                         <tbody>
                                                            @foreach ($medicalConditions_d as $medicalCondition)
                                                            <tr>
                                                               <td>{{ $medicalCondition->name }}</td>
                                                               <td>{{ ($medicalCondition->status == 1) ? 'Current Condition' : 'Previous Condition' }}</td>
                                                               <td>{{ $medicalCondition->description }}</td>
                                                               <td>
                                                                  <div class="d-flex ">
																  
																  <a 
																		href="javascript:;"
																		data-toggle="tooltip"
																		class="deleteByAjax"
																		number="{{$medicalCondition->medicalConditionId}}"
                                                                        data-url="{{ url('/medical-history-inactive/'. $medicalCondition->medicalConditionId .'/' . $medicalCondition->userId) }}">
																		<label class="badge badge-danger-cus"><i class="far fa-trash-alt mr-2"></i>Delete</label>
																				 
																	</a>
																	
                                                                     <?php /*
																	 <a href="#0" class=" mr-2 medicalHistoryPopupClick" data-id="{{ $medicalCondition->medicalConditionId }}" data-toggle="modal" data-target="#updatemodal2"><label class="badge badge-success badge-danger-cus"><i class="fas fa-edit mr-1 "></i> Update</label></a>
																	 
                                                                     <a class="delete_resource"
                                                                           data-resource="{{ 'destroy-medical-history-form-'.$medicalCondition->medicalConditionId }}"
                                                                           href="{{ url('/medical-history-inactive/'. $medicalCondition->medicalConditionId .'/' . $medicalCondition->userId) }}"><label
                                                                              class="badge badge-danger-cus"><i
                                                                                 class="far fa-trash-alt mr-2"></i>Delete</label></a>
																				 
																		

																		
                                                                     </li>*/?>
                                                                     <form method="post"
                                                                           id="destroy-medical-history-form-{{$medicalCondition->medicalConditionId}}"
                                                                           action="{{ url('/medical-history-inactive/'. $medicalCondition->medicalConditionId .'/' . $medicalCondition->userId) }}"
                                                                           style="display:none">
                                                                           @csrf
                                                                           @method('DELETE')
                                                                     </form>
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
			
			<a href="{{url('medication-allergies')}}?user_id={{ request()->get('user_id') }}" class="btn btn-primary showLoaderPageLoad"><i class="fa fa-chevron-left fa-arrow-icon fa-arrow-icon-back"></i> Back</a>
			
			<a href="{{ url('surgical-conditions')}}?user_id={{ request()->get('user_id') }}" class="btn btn-primary showLoaderPageLoad">Next <i class="fa fa-chevron-right fa-arrow-icon"></i></a>
		@else
			<a href="{{url('medication-allergies')}}" class="btn btn-primary showLoaderPageLoad"><i class="fa fa-chevron-left fa-arrow-icon fa-arrow-icon-back"></i> Back</a>
		
			<a href="{{ url('surgical-conditions')}}" class="btn btn-primary showLoaderPageLoad">Next <i class="fa fa-chevron-right fa-arrow-icon"></i></a>
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
            <div class="modal-content" id="showMedicalHistoryPopup"></div>
         </div>
      </div>
       <!-- Modal -->
      {{--  <div class="modal fade congrats-modal" id="congrats-modal" tabindex="-1" role="dialog" aria-labelledby="congrats-modalTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="check-icon"><img src="{{ asset('assets/services/images/check-icon.png') }}" alt="check-icon"></div>
                    <h2 class="text-center">Congratulations!</h2>
                    <p class="text-center">You've completed successfully your Health records.</p>
                    <p class="text-center">Your need only one more step.</p>
                    <p class="text-center">Please complete your Personal settings!</p>
                    <div class="modal-btn-wrapper text-center">
                        <button class="btn btn-default">Get Started</button>
                    </div>
                </div>
            </div>
        </div> --}}


       
      
@push('scripts')
@if(count($medicalConditions))	
<script>
$(function(){
	
		$('input[name="take_medication"][value="yes"]').prop('checked', true).trigger('click').trigger('change');
			
});
</script>
@endif

<script>
function saveMedicalHistory() {
	
	let medicalConditionName = $("#medicalConditionName").val();
	if(medicalConditionName=="") {
		toastr.error("Condition Name Required");
		return false;
	}
	let medicalConditionDescription = $("#medicalConditionDescription").val();
	if(medicalConditionDescription=="") {
		toastr.error("Condition Description Required");
		return false;
	}
	
	let selectedValue = $('input[name="medical[0][medicalConditionStatus]"]:checked').val() || null;
	if (selectedValue === null) {
		toastr.error("Status Required");
		return false;
	}

}

</script>
@endpush


@endsection
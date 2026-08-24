@extends('layouts.dashboard')
@section('content')
@section('moduleStyle')
    @include('HealthRecord::style')
@endsection
<div class="main-panel">
   <div class="content-wrapper">
      <div class="row">
         <div class="col-md-12 grid-margin top-header-page">
            <div class="row">
               <div class="col-12 col-xl-6 mb-4 mb-xl-0">
                  <h3 class="font-weight-bold">Surgical Conditions</h3>
                  <h6 class="font-weight-normal mb-0">Your Personalized Health Portal</h6>
               </div>
            </div>
         </div>
      </div>
      <div class="main-content-box">
		<div class="record-tabs-box">
         <div class="row">
            <div class="col-12 stretch-card">
               <div class="card">
					
					@include('HealthRecord::medications-card-header',['slug'=>'surgical-conditions'])
					
                  <div class="card-body personal-info-card-box">
                    <div class="row">
                        <div class="col">
                            <form class="forms-sample clickOffSubmitBtn" method="post" action="">
                                {{ csrf_field() }}
								<div class="labe-titl">
									<label><h4 class="card-title">Do You Have a Surgical History?</h4></label>
								</div>
								<div class="form-take">
									<div class="form-check-inline">
										<input class="form-check-input take_medication-check" type="radio" name="take_medication" id="take_medication-yes"
											value="yes" >
										<label class="form-check-label" for="take_medication-yes">Yes</label>
									</div>
									<div class="form-check-inline">
										<input class="form-check-input take_medication-check" type="radio" name="take_medication" id="take_medication-no"
											value="no" checked>
										<input type="hidden" name="segment" value="{{ getSegment(1) }}" >
										<label class="form-check-label" for="take_medication-no">No</label>
									</div>
								</div>
                               <p class="errorMedicalCheck mt-3 mb-0 alert alert-danger displayNone"></p>
                            </form>
                        </div>
                    </div>
					
@php 		
	$currentUserId = request()->get('user_id') ?? (Request::segment(2) ?? Auth::id());
@endphp                   
                     
			
						<div class="medical_show-check mt-4" id="medical_show-check"  style="display:none;">
							<div class="con-title">
								<h4 class="card-title">Add New Surgical Condition Record</h4>
							</div>
							<form class="forms-sample clickOnSubmitBtn" method="post" action="{{ url('save-surgical-data')}}" id="medication-form">
								@csrf	
									<div class="row">
									   

									   <div class="col-sm-6">
										  <div class="form-group">
											 <label>Procedure Name <span class="required-ico">*</span></label>
											 
				<input type="hidden" name="surgical_uid" id="surgical_uid" value="{{$currentUserId}}">
				
				<input type="text" class="form-control" name="procedure_name" id="procedure_name" placeholder="Procedure Name" onkeyup="nameValidationTextOnly(this)">
				
				
										  </div>
									   </div>
									   
									   <div class="col-sm-6">
										  <div class="form-group">
											 <label>Procedure Date <span class="required-ico">*</span></label>
											 <input type="text" class="form-control" name="procedure_date" id="procedure_date" placeholder="Date" >
										  </div>
									   </div>
									   
									</div>
									<div class="row">
									   <div class="col-sm-12">
										  <div class="form-group">
											 <label for="description">Description <span class="required-ico">*</span></label>
											 <textarea class="form-control" id="description" name="description" rows="7"></textarea>
										  </div>
									   </div>	 
									</div>
									<div class="row">
										<div class="col-sm-12 cta-save">
											<button class="btn btn-primary" onclick="return saveSurgicalCondition()"> Save</button>
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
								<div class="card-body add-margin-cus adds">
								
								
									<div class="tab-content p-0">
									
										<div class="tab-pane {{ !request()->get('user_id') ? 'active' : '' }}">
											<div class="row">
												<div class="col-lg-12 grid-margin stretch-card">
													<div class="card">
														<div class="card-body px-0">
															<div class="table-responsive">
																<table class="table table-hover table-striped medication-table-box table-bordered">
																	<thead>
																		<tr>
																			<th>Procedure Name</th>
																			<th>Procedure Date</th>
																			<th>Source</th>
																			<th>When Reported</th>
																			<th>Description</th>
																			<th>Action</th>
																		</tr>
																	</thead>
																	<tbody>
													
																	@forelse($surgical_history as $result)
																		<tr>
																			<td>{{ $result->name }}</td>

																			<td>
																				{{ $result->procedure_date ?? '-' }}
																			</td>

																			<td>Self Report</td>

																			<td>
																				{{ optional($result->updated_at)->format('F j, Y') ?? '-' }}
																			</td>

																			<td>{{ $result->description ?? '-' }}</td>

																			<td>
																				<div class="d-flex">
																					<a class="deleteByAjax"
																					   href="javascript:;"
																					   number="{{ $result->id }}"
																					   data-url="{{ url('surgical-history-deleted') }}"
																					   data-toggle="tooltip"
																					   title="Delete">
																						<label class="badge badge-danger-cus">
																							<i class="fas fa-trash"></i>
																						</label>
																					</a>
																				</div>
																			</td>
																		</tr>
																	@empty
																		<tr>
																			<td colspan="6" class="text-center text-muted py-3">
																				No surgical history records found.
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
										
					@if ($dependents)
                                    @foreach ($dependents as $dependent)
                                    <div class="tab-pane {{ request()->get('user_id')==$dependent->id ? 'active' : '' }}" id="user{{ $dependent->id }}" role="tabpanel">
                                       <div class="row">
                                          <div class="col-lg-12 grid-margin stretch-card">
                                             <div class="card ">
                                                <div class=" d-flex  align-items-center">
                                                   <h4 class=" mb-0 mr-2 lh-2 ">Describe any chronic or acute medical issues that you have experienced. Be as detailed as possible.</h4>
                                                </div>
                                                @php $medicalConditions_d = $dependent->surgical_history; @endphp
                                                @if (count($medicalConditions_d))
                                                <div class="card-body px-0">
                                                   <div class="table-responsive">
                                                      
														<table class="table table-hover table-striped medication-table-box table-bordered">
																	<thead>
																		<tr>
																			<th>Procedure Name</th>
																			<th>Procedure Date</th>
																			<th>Source</th>
																			<th>When Reported</th>
																			<th>Description</th>
																			<th>Action</th>
																		</tr>
																	</thead>
																	<tbody>
													@if($surgical_history)
														@foreach($surgical_history as $result)
															<tr>
															
																<td>{{$result->name}}</td>
																<td>
																
																	@if($result->procedure_date)
																		
																		{{$result->procedure_date}}
																		
																		
																	@endif
																
																</td>
																<td>Self Report</td>
																<td>
																	@if ($result->updated_at)
																		{{ $result->updated_at->format('F j, Y') }}
																	@endif
																</td>
																<td>{{ $result->description }}</td>
																<td>
																	<div class="d-flex">

<a class="deleteByAjax" href="javascript:;" number="{{$result->id}}" data-url="{{url('surgical-history-deleted')}}" data-toggle="tooltip" title="" data-bs-original-title="Delete" aria-label="Delete" aria-describedby="tooltip350207"><label class="badge badge-danger-cus"><i class="fas fa-trash"></i></label></a>

																		
																		
																		
																	</div>
																</td>
															
															</tr>
														@endforeach
													@else 
														
													
													<tr>
														<td colspan="6" class="text-center text-muted py-3">No surgical history records found.</td>
													</tr>
													
													
													@endif				
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
												
												<a href="{{ url('medical-history')}}?user_id={{ request()->get('user_id') }}" class="btn btn-primary"><i class="fa fa-chevron-left fa-arrow-icon fa-arrow-icon-back"></i> Back</a>
												<a href="{{ url('document-manager')}}?user_id={{ request()->get('user_id') }}" class="btn btn-primary">Next <i class="fa fa-chevron-right fa-arrow-icon"></i></a>
												
											@else 
												
												<a href="{{ url('medical-history')}}" class="btn btn-primary"><i class="fa fa-chevron-left fa-arrow-icon fa-arrow-icon-back"></i> Back</a>
												<a href="{{ url('document-manager')}}" class="btn btn-primary">Next <i class="fa fa-chevron-right fa-arrow-icon"></i></a>
												
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

@push('scripts')
<link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>
<script>
$(function() {
    $("#procedure_date").datepicker({
        dateFormat: "mm/dd/yy",
		changeYear: true,
		yearRange: "-80:+0",
		maxDate: 0
    });
});

function saveSurgicalCondition() {
	
	let procedure_name = $("#procedure_name").val();
	if(procedure_name=="") {
		toastr.error("Procedure name is required.");
		return false;
	}
	
	let procedure_date = $("#procedure_date").val();
	if(procedure_date=="") {
		toastr.error("Procedure date is required.");
		return false;
	}
	
	let dateRegex = /^(0[1-9]|1[0-2])\/(0[1-9]|[12][0-9]|3[01])\/\d{4}$/;
	if(!dateRegex.test(procedure_date)) {
		toastr.error("Invalid date format. Please use MM/DD/YYYY.");
		return false;
	}
		
		
	let description = $("#description").val();
	if(description=="") {
		toastr.error("Procedure description is required.");
		return false;
	}
	
}
</script>

@if(count($surgical_history))	
<script>
$(function(){
	
		$('input[name="take_medication"][value="yes"]').prop('checked', true).trigger('click').trigger('change');
			
});
</script>
@endif

@endpush
         
@endsection

@section('moduleScript')

@include('HealthRecord::script')

@endsection

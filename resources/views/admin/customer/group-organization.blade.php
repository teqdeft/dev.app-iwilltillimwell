@extends('admin.layouts.dashboard')

@section('content')

<style>

  td img{

    height:60px !important;

  }

</style>

<div class="main-panel main-wrapper-user">

    <div class="content-wrapper">

        <div class="row">

            <div class="col-md-12 grid-margin">

                <div class="row">

                    <div class="col-12 col-xl-12 mb-4 mb-xl-0">

                        <div class="patient-details ">

                            <div class="media pc-media-box">

                                <div class="title-heading-icon-box-cus">

                                    <i class="fas fa-user-tag"></i>

                                </div>

                                <div class="media-body">

                                    <h3 class="font-weight-bold">Group Organization</h3>
									
									<?php /*	
                                    @if( permission_exist('plan_type_add',$permissions??'') )

                                      <a href="{{ route('admin.plan-type.create') }}" class="btn-custom"><i class="fas fa-user-tag" aria-hidden="true"></i> Create Plans Type</a>

                                    @endif
									*/ ?>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

        <div class="row">

            <div class="col-12 grid-margin stretch-card">

                <div class="card card-body">

                    <div class="all-consultations-box  p-3">

                        <div>

                            <div id="all">


                                <div class="table-responsive pt-3">

                                    <table class="table table-bordered user-table-box" id="planType-table-1">

                                        <thead>

                                            <tr>

                                                <th>#</th>
												<th>Name</th>
                                                <th>Email</th>
                                                <th>Total Commission</th>
                                                <th>Total Withdrawal</th>
                                                <th>Balance</th>
                                                <th>Group Status</th>
                                                <th>Created On</th>
                                                <th>View Transaction</th>
                                                <th>Reward</th>
                                                <th>Actions</th>
                                                <th>Login Info</th>

                                            </tr>

                                        </thead>

                                        <tbody>
											@if($group_organization->count())
												@php 
													$counter = 1;
												@endphp 
												@foreach($group_organization as $list) 
												
													<tr id="group_organization-{{ $list->id }}">
													
													@php
													$ins_wdata = getInfluenceWallet($list->influencers_id);
													@endphp 
														<td>{{ $counter++ }}
															<input type="hidden"  id="name-{{ $list->id }}" value="{{ $list->name }}" />
															<input type="hidden"  id="group_analytics-{{ $list->id }}" value="{{ $list->group_analytics }}" />
															<input type="hidden"  id="group_email-{{ $list->id }}" value="{{ $list->group_email }}" />
														</td>
														<td class="organization-name">{{ $list->name }}</td>
														<td class="organization-name">{{ $list->group_email }}</td>
														
														<td class="organization-name">
															${{$ins_wdata['total_commission']}}
														</td>
														<td class="organization-name">
															${{$ins_wdata['total_withdrawal']}}	
														</td>
														<td class="organization-name">
															${{$ins_wdata['total_balance']}}	
														</td>
														
														<td class="status-button">
														
															@if($list->group_analytics=="disabled")
																Disable
															@else
																Enabled
															@endif 
														
																
														</td>
														<td>{{ $list->created_at }}</td>
														
		
		<td><a target="_blank"  href="{{ url('admin/group-organization-commission-history')}}?user_id={{$list->influencers_id}}" title="View"><label class="badge badge-danger-cus">View</label></a></td>
		
		<td>
			<a onclick="addReward({{$list->id}})"  href="javascript:void(0)" title="View"><label class="badge badge-danger-cus">Add Reward</label></a>
		</td>
		
		
														
														<td>
															<a onclick="editGroup({{$list->id}})" href="javascript:void(0)" title="Edit">
																<label class="badge badge-danger-cus"><i class="fas fa-edit"></i></label>
															</a>
														</td>
														
														<td>
															<a onclick="loginInfo({{$list->id}})" href="javascript:void(0)" title="Edit">
																<label class="badge badge-danger-cus">Login Info</label>
															</a>
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
        </div>
    </div>
	
	
<script>
function view_transaction(id){
	$("#view_transaction").modal('show');
}
function addReward(organization_id){
	
	$("#organization_id").val(organization_id);
	var myModal = new bootstrap.Modal(document.getElementById('addReward'), {
		backdrop: 'static',
		keyboard: false
	});
	myModal.show();
	loadRewards();
}
function editGroup(id){
	
	let name = $("#name-"+id).val();
	let group_analytics = $("#group_analytics-"+id).val();
	let group_email = $("#group_email-"+id).val();
	$("#editGroup").modal('show');
	$("#name").val(name);
	$("#group_id").val(id);
	$("#group_analytics").val(group_analytics);
	$("#group_email").val(group_email);
	
}
function loginInfo(id){
	
	let group_email = $("#group_email-"+id).val();
	var myModal = new bootstrap.Modal(document.getElementById('loginInfo'), {
		backdrop: 'static',
		keyboard: false
	});
	myModal.show();
	$("#user_email").val(group_email);
	$("#loginInfo .modal-body").html('');
	$.ajax({
        url: "{{url('admin/group-organization-login-html')}}", 
        type: "POST",
        data: {
            _token: $('meta[name="csrf-token"]').attr('content'),
            group_email: group_email
        },
        success: function (response) {
			if (response.status) {
				$("#loginInfo .modal-body").html(response.html);
			} else {
				toastr.error("Something went wrong");
			}
        },
        error: function (xhr) {

        }
    });
	
}

function UpdateGroup() {
	
	let name = $("#name").val();
	let group_id = $("#group_id").val();
	let group_email = $("#group_email").val();
	let group_analytics = $("#group_analytics").val();
	
	$("#group_organization-"+group_id+" .organization-name").html(name);
	$("#name-"+group_id+"").val(name); 
	if(group_analytics=="enable") {
		$("#group_organization-"+group_id+" .status-button").html('Enabled');
	} else {
		$("#group_organization-"+group_id+" .status-button").html('Disabled');
	}
	
	toastr.warning("Please wait, updating group...");
	 $.ajax({
        url: "{{url('admin/group-organization-save')}}", 
        type: "POST",
        data: {
            _token: $('meta[name="csrf-token"]').attr('content'),
            group_id: group_id,
            name: name,
            group_email: group_email,
            group_analytics: group_analytics
        },
        success: function (response) {
			 toastr.clear();
            if (response.success) {
				toastr.success("Group updated successfully!");
                $("#editGroup").modal("hide");
				location.reload();
            } else {
                toastr.warning(response.message || "Something went wrong.");
            } 
        },
        error: function (xhr) {
			toastr.clear();
			toastr.error("Error: " + xhr.statusText);
        }
    });
}

function AddUpdateLoginUpdate() {
	
	let fname = $("#fname").val().trim();
    let lname = $("#lname").val().trim();
    let email = $("#user_email").val().trim();
    let password = $("#password").val().trim();
	
	$(".text-danger").remove();
	
	let error = false;
	
	if (fname === "") {
        $("#fname").after('<small class="text-danger">First name is required</small>');
        error = true;
    }
    if (lname === "") {
        $("#lname").after('<small class="text-danger">Last name is required</small>');
        error = true;
    }
    /* if (email === "") {
        $("#email").after('<small class="text-danger">Email is required</small>');
        error = true;
    } else if (!validateEmail(email)) {
        $("#email").after('<small class="text-danger">Invalid email format</small>');
        error = true;
    } */
    if (password === "") {
        $("#password").after('<small class="text-danger">Password is required</small>');
        error = true;
    }
	 if (error) return;
	 
	let formData = new FormData();
    formData.append("fname", fname);
    formData.append("lname", lname);
    formData.append("email", email);
    formData.append("password", password);
	formData.append("_token", "{{ csrf_token() }}");
	
	 $.ajax({
        url: "{{ url('admin/group-organization-login-save') }}",
        type: "POST",
        data: formData,
        processData: false,
        contentType: false,
        beforeSend: function () {
            $(".btn-success").prop("disabled", true).text("Processing...");
        },
        success: function (response) {

            if (response.status) {
				
                toastr.success(response.message);
                location.reload();

            } else {
                toastr.error(response.message);
            }
        },
        error: function (xhr) {
			
            if (xhr.status === 422) {
				let res = JSON.parse(xhr.responseText);
				toastr.error(res.message);
			} else {
				toastr.error("Something went wrong!");
			}
			
        },
        complete: function () {
            $(".btn-success").prop("disabled", false).text("Update");
        }
    });
	
}
function validateEmail(email) {
    var re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return re.test(email);
}
</script>	

<div id="editGroup" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Group & Organization</h4>
      </div>
      <div class="modal-body">
			<div class="row">
			
				<div class="form-group col-sm-12">
					<label for="type">Name*</label>
					<input type="text" class="form-control" id="name" name="name" value="">	
					<input type="hidden" id="group_id" name="group_id">	
				</div>
				<div class="form-group col-sm-12">
					<label for="type">Email ID*</label>
					<input type="text" class="form-control" id="group_email" name="group_email" >	
				</div>	
				<div class="form-group col-sm-12">
					<label for="type">Group Analytics*</label>
					<select class="form-control" id="group_analytics" name="group_analytics">	
						<option value="enable">Enable</option>
						<option value="disabled">Disable</option>
					</select>
				</div>
					
				
			</div>	
      </div>
      <div class="modal-footer d-flex justify-content-between">
	  
			<button class="btn btn-success" type="button" onclick="UpdateGroup()">Update</button>
			<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        
      </div>
    </div>
  </div>
</div>

<div id="loginInfo" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Login Info</h4>
      </div>
      <div class="modal-body login-info-div">
	  
				
			
      </div>
      <div class="modal-footer d-flex justify-content-between">
	  
			<button class="btn btn-success" type="button" onclick="AddUpdateLoginUpdate()">Update</button>
			<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        
      </div>
    </div>
  </div>
</div>

<div id="view_transaction" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">View Transaction History</h4>
      </div>
      <div class="modal-body login-info-div">
	  
				
			
      </div>
      <div class="modal-footer d-flex justify-content-between">
	  
			<button class="btn btn-success" type="button" onclick="AddUpdateLoginUpdate()">Update</button>
			<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="addReward" tabindex="-1" aria-hidden="true">

  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Add Reward Section</h4>
      </div>
      <div class="modal-body add-reward-section">
			<input type="hidden" id="organization_id" />
			@include('admin.customer.groupreward-add-component')
			
			@include('admin.customer.groupreward-add-component-table')		
	  
      </div>
      <div class="modal-footer d-flex justify-content-between">
			
		<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        
      </div>
    </div>
  </div>
</div>

@include('admin.customer.groupreward-add-component-script')
@endsection


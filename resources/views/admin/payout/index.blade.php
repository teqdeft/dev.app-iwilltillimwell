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

                                    <h3 class="font-weight-bold">Payout Section</h3>
									
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

@php
    $statusClasses = [
        'approved' => 'badge badge-success',
        'pending'  => 'badge badge-warning',
        'rejected' => 'badge badge-danger',
    ];
@endphp

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
                                                <th>Withdrawal Request</th>
                                                <th>Paid Withdrawal</th>
                                                <th>Status</th>
												<th>Remark</th>
												<th>Withdrawal Date & Time</th>
												
                                                <th>Actions</th>
												
                                            </tr>

                                        </thead>

                                        <tbody>
											@forelse($payouts as $key => $payout)
													<tr>
														<td>{{ $payouts->firstItem() + $key }}</td>
														<td>
															{{$payout->fname}}
														</td>
														<td>${{ $payout->total_withdrawal }}</td>
														<td>
															@if($payout->status!="pending")
																
																${{ number_format($payout->paid_payout, 2) }}
															@else 
																${{ number_format(0, 2) }}
															@endif
														</td>
														
														<td>
															<span class="{{ $statusClasses[$payout->status] ?? 'badge badge-secondary' }}">
																{{ ucfirst($payout->status) }}
															</span>
															
														</td>
														
														<td>
															
															@if($payout->remark) 
															
																<span>
																	{{ ucfirst($payout->remark) }}
																</span>
															@endif 
														</td>
														
														<td>{{ $payout->created_at->format('d M Y') }}</td>
														<td><button class="btn btn-success" type="button" onclick="take_action({{$payout->id}})">Action</button></td>
													</tr>
												@empty
													<tr>
														<td colspan="5" class="text-center text-danger">
															No payout records found
														</td>
													</tr>
												@endforelse
                                        </tbody>

                                    </table> 
									{{ $payouts->links() }}

                                </div>

                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>	
<script>
function take_action(id) {
	
	$("#payout_id").val(id);
	 $('#take_action_modal').modal({
        backdrop: 'static',
        keyboard: false
    }).modal('show');
}
function view_transaction(id){
	
	$("#view_transaction").modal('show');
	
}
function updatePayout() {

    let action = $('#action_type').val();
    let remark = $('#remark').val();
    let payout_id = $("#payout_id").val(); 
    let paid_payout = $("#paid_payout").val(); 

    if(!payout_id) {
		swal("Error", "ID Missing please reload page", "error");
        return;
    }
    if (!action) {
		swal("Error", "Please select action", "error");
        return;
    }
	if(action=="approved") {
		if(!paid_payout) {
			swal("Error", "Please enter paid amount", "error");
			return;
		}
	}
    if(!remark.trim()) {
		swal("Error", "Please add Remark", "error");
        return;
    }
	
	swal({title: "Please wait",text: "Processing request...",icon: "info",buttons: false,closeOnClickOutside: false,closeOnEsc: false});

    $.ajax({
        url: "{{ url('admin/payout/update') }}",
        type: "POST",
        data: {
            _token: $('meta[name="csrf-token"]').attr('content'),
            payout_id:payout_id,
            status: action,
            paid_payout:paid_payout,
            remark: remark
        },
        beforeSend: function () {
            $('.btn-success').prop('disabled', true);
        },
        success: function (res) {
			swal.close();
			swal("success", res.message ?? 'Request Done', "success");
           // alert(res.message);
           // $('#take_action_modal').modal('hide');
            location.reload();
        },
        error: function (xhr) {
			swal.close();
			swal("Error", xhr.responseJSON.errors[0] ?? 'Something went wrong', "error");
            //alert(xhr.responseJSON.message ?? 'Something went wrong');
        },
        complete: function () {
			swal.close();
            $('.btn-success').prop('disabled', false);
        }
    });
	
}
</script>	






<div id="take_action_modal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Action</h4>
      </div>
      <div class="modal-body">
			<input type="hidden" name="payout_id" id="payout_id"  />
			<div class="form-group">
					<label for="action_type">Select Action</label>
					<select class="form-control" id="action_type">
						<option value="">-- Select Action --</option>
						<option value="approved">Approve</option>
						<option value="rejected">Reject</option>
					</select>
			</div>	
			
			<div class="form-group" id="paid_amount_box">
			  <label>Paid Payout</label>
			  <input type="text" class="form-control" id="paid_payout" placeholder="Enter Paid Payout" />
			</div>
			
			<div class="form-group" id="remark_box">
			  <label>Remark</label>
			  <textarea class="form-control" id="remark" rows="3" placeholder="Enter remark..."></textarea>
			</div>
		
		
			
      </div>
      <div class="modal-footer d-flex justify-content-between">
	  
			<div class="btn btn-success" onclick="updatePayout()">Update</div>
			<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        
      </div>
    </div>
  </div>
</div>



@endsection


@extends("mobile.layouts.group-organizations")
@section('content')
	
<section class="record-header">
        <div class="cust-container-md">
            <div class="rec-row">
                <div class="back">
                    <a href="{{ route('group-organizations')}}" class="back-btn">
                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M12.875 16.0417L7.33334 10.5L12.875 4.95834" stroke="#222A3D"
                                stroke-width="1.58333" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </a>
                </div>
                <div class="top-title">
                    <h2 class="title">Commission History</p>
                </div>
                <div class="screen-number d-n">
                    <p>&nbsp;</p>
                </div>
            </div>
        </div>
</section>

<section class="custom-tab tab-edit-v2">
        <div class="cust-container-lg">
            <div class="tab-container">
                
<?php 
$plan_info = getMyCurrentPlanRecords(Auth::user()->id);
?>
			<div id="transaction-history" class="tab-content active">
                <div class="midical-form v1 detail">
					<div class="account-man-ship">
					
							<div class="table-responsive drag-scroll" id="transaction-wrapper">
					
								<table class="table table-bordered user-table-box" >
									<thead>	
										<tr>
											<th>#</th>
											<th>Month</th>
											<th>Commission</th>
											
											
										</tr>
									</thead>	
									<tbody>	
									@if($OrderHistory) 
										@foreach($OrderHistory as $index => $details)
											<tr>
											
												<td>{{ $OrderHistory->firstItem() + $index }}</td>
												<td>{{$details->display_months}}</td>
												<td>${{$details->total_commission}}</td>
												
												
										
											</tr>
										@endforeach
									@else 
										<tr>
											<td colspan="4">No record found</td>
										</tr>
								  
									@endif 
									  </tbody>
								</table>	
								
								
								<div class="d-flex justify-content-end">
									{{ $OrderHistory->links() }}
								</div>
								
								
							</div>

						</div>
					</div>
                </div>
            </div>
        </div>
</section>

@include('mobile.includes.foooter-tab')

@endsection
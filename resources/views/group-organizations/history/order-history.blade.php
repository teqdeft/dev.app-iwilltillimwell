@extends('layouts.group-organizations')
@section('content')

	<div class="content-wrapper">
		
	<div class="row">
            <div class="col-md-12 grid-margin">
                <div class="row">
                    <div class="col-12 col-xl-12 mb-12 mb-xl-0">
                        <div class="patient-details ">
                            <div class="media pc-media-box">
                                <div class="title-heading-icon-box-cus">
                                    <i class="far fa-user"></i>
                                </div>  
                                <div class="media-body theme-title-box">
                                     <h3 class="font-weight-bold">Order History</h3>
                                </div>   
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>
		
	<div>
		<div class="col-12 grid-margin stretch-card">
			<div class="card card-body">
				<div class="all-consultations-box  p-3">
					<div class="table-responsive pt-3" id="customer-table">
                        
		
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
	
@endsection
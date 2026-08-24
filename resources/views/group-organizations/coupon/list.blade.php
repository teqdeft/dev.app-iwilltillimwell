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
                                    <h3 class="font-weight-bold">Promo Code List</h3>
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
											<th>Promo Code</th>
											<th>Status</th>
											<th>Date & Time</th>
										</tr>
                                    </thead>	
                                    <tbody>	
									
									@if($coupons_list)
										@foreach($coupons_list as $data)
											<tr>
												<td>1</td>
												<td>{{$data->code}}</td>
												<td><span class="badge badge-success">Active</span></td>
												<td>{{$data->created_at}}</td>
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
	
@endsection
@extends("mobile.layouts.group-organizations")
@section("content")
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
                    <h2 class="title">Coupon List</p>
                </div>
                <div class="screen-number d-n">

                </div>
            </div>
        </div>
	</section>	
	
	<section class="custom-tab tab-edit-v2">
		<div class="cust-container-lg">
			<div class="tab-container">
				<div class="tab-content-detail account-edit-tab">
				
					<div class="tab-content active">
						<div class="midical-form v1 detail">
							<div class="account-man-ship">
								<div class="table-responsive drag-scroll">
									<table class="table table-striped table-data-theme">
										<thead>
											<tr>
		
												<th scope="col">#</th>
												<th scope="col">Promo Code</th>
												<th scope="col">Status</th>
												<th scope="col">Date & Time</th>
												
											</tr>	
										</thead>
										<tbody>
										
											@if($coupons_list)
												@foreach($coupons_list as $data)
													<tr>
														<td>{{ $loop->iteration }}</td>
														<td>{{$data->code}}</td>
														<td>Active</td>
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
		</div>
	</section>
	@include('mobile.includes.foooter-tab')	
@endsection

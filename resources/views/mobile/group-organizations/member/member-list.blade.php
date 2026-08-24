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
                    <h2 class="title">Monthly Members Stats</h2>
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
								
								
								@include('group-organizations.member.member-list-table')
								<?php /*	
								<div class="table-responsive drag-scroll">
									<table class="table table-striped table-data-theme">
										<thead>
											<tr>
		
												<th scope="col">#</th>
												<th scope="col">Name</th>
												<th scope="col">Joining Date</th>
												<th scope="col">Activation Date</th>
												<th scope="col">Current Status</th>
												
											</tr>	
										</thead>
										<tbody>
										
											@if($users->count())
													@foreach($users as $key => $user)
														<tr>
															<td>{{ $users->firstItem() + $key }}</td>
															<td>{{ $user->fname }} {{ $user->lname }}</td>
															<td>{{ \Carbon\Carbon::parse($user->user_created_at)->format('d-m-Y') }}</td>
															<td>
																{{ $user->activation_date 
																	? \Carbon\Carbon::parse($user->activation_date)->format('d-m-Y') 
																	: '-' 
																}}
															</td>
															<td>
																@if($user->payment_status == 1)
																	<span class="badge badge-success">Active</span>
																@else
																	<span class="badge badge-warning">Inactive</span>
																@endif
															</td>
														</tr>
													@endforeach
												@else
													<tr>
														<td colspan="5" class="text-center">No users found</td>
													</tr>
												@endif	
									
											
										</tbody>
									</table>
								</div>
								*/ ?>
							</div>
						</div>	
					</div>
					
				</div>
			</div>
		</div>
	</section>
	



@include('mobile.includes.foooter-tab')	
@endsection

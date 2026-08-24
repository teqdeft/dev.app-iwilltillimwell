@extends('admin.layouts.dashboard')
@section('content')
<div class="main-panel main-wrapper-user">
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
                                     <h3 class="font-weight-bold">Transaction History</h3>
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
                        <div id="all">
							<div class="row">
								<div class="table-responsive pt-3" id="customer-table">
								
									<table class="table table-bordered user-table-box" >
										<thead>		
											<tr>
												<td>#</td>
												<td>Transaction Period</td>
												<td>Name</td>
												<td>Package Info</td>
												<td>Package Type</td>
												<td>Package Amount</td>
												<td>Add-Ons</td>
												<th>Promo Code</th>
												<th>Final Amount</th>
												<th>Status</th>
												<th>Activation/Upgrade</th>
												
											</tr>	
										</thead>	
										 <tbody>	
											@if($transaction_history)
												@foreach($transaction_history as $details)
													
													<tr>
														<td>
															{{ $transaction_history->firstItem() + $loop->index }}	
														</td>
														<td>
															{{ \Carbon\Carbon::parse($details->subscription_start_date)->format('d M Y') }}
															–
															{{ \Carbon\Carbon::parse($details->subscription_end_date)->format('d M Y') }}
														</td>
														<td>
															{{ $details->fname }} {{ $details->lname }} - {{ $details->email }}
														</td>
														<td>
															{{ $details->package_name}} 
														</td>
														<td>
															@switch(true)
																@case($details->subscription_type === 'twelve-month')
																	12 Month
																	@break

																@case($details->subscription_type === 'four-month')
																	4 Month
																	@break

																@case($details->planid % 2 === 0)
																	Self + Family
																	@break

																@default
																	Self
															@endswitch
														</td>
														<td>${{ number_format($details->package_amount, 2) }}</td>
														<td>${{ number_format($details->optional_amount ?? 0, 2) }}</td>
														<td>
															@if(isset($details->promo_code))
																<strong>{{$details->promo_code}}</strong>
																-
																${{$details->promo_code_value}}
															@else 
																none
															@endif 		
															
														</td>
														<td>
															@php
																$final_amount = $details->final_amount;
															@endphp

															<div class="text-success">
																	<strong>${{ number_format($final_amount, 2) }}</strong>
																
															</div>
														</td>
														<td>
															<span class="badge 
																{{ $details->subscription_status === 'active' ? 'badge-success' : 'badge-danger' }}">
																{{ ucfirst($details->subscription_status) }}
															</span>
														</td>
														
														
														<td>
															{{ ucfirst($details->activation_type) }}
														
														</td>
														
													</tr>
													
												@endforeach	
											@endif	
										 </tbody>	
									</table>		
									{{ $transaction_history->links() }}
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>


@endsection
@section('scripts')
@endsection
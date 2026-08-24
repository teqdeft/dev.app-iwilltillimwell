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

                                    <h3 class="font-weight-bold">Transaction History</h3>
									
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
                                                <th>Month</th>
                                                <th>Commission</th>

                                             
                                            </tr>

                                        </thead>

                                        <tbody>
											@if($OrderHistory->count())
												@php 
													$counter = 1;
												@endphp 
												@foreach($OrderHistory as $list) 
												
													<tr>
														<td>{{ $OrderHistory->firstItem() + $loop->index }}</td>

														<td>{{$list->display_months}}</td>
														<td>${{$list->total_commission+0}}</td>
													
													</tr>
												@endforeach
											@else 
												
												<tr>
													<td colspan="3" class="text-center">
														No Record Found
													</td>
												</tr>
											
											@endif
                                        </tbody>

                                    </table>

                                </div>
								
								<div class="d-flex justify-content-end">
									@if ($OrderHistory->count())
										{{ $OrderHistory->links() }}
									@endif
								</div>

                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
	





@endsection


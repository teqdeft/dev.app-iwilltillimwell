@extends("mobile.layouts.dashboard")
@section("content")

	<section class="record-header h-matters">
        <div class="cust-container-md">
            <div class="rec-row">
                <div class="back">
                    <a href="{{ url('mobile-dashboard')}}" class="back-btn">
                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M12.875 16.0417L7.33334 10.5L12.875 4.95834" stroke="#222A3D"
                                stroke-width="1.58333" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </a>
                </div>
                <div class="top-title text-center">
                    <h2 class="title">Lab Reports</p>
                </div>
            </div>
        </div>
    </section>
	
	
	
	<section class="care-cordin">
        <div class="cust-container-md">
            <div class="health-matters">

                <div class="lab-report-detail">
                    <div class="lab-report-card">
						@if($data['labOrders'])	
							@foreach($data['labOrders'] as $result)
									<div class="report-text">
										<div class="report-col">
											<div class="report-lable">
												<p>Ordered</p>
											</div>
											<div class="report-value">
												<p>{{ ucfirst($result['patientFirstName']) }} {{ ucfirst($result['patientLastName'])}}</p>
											</div>
										</div>
										<div class="report-col">
											<div class="report-lable">
												<p>Date</p>
											</div>
											<div class="report-value">
												<p>{{ \Carbon\Carbon::createFromFormat('F, d Y H:i:s O', $result['whenCreated'])->format('M, d Y') }}</p>
											</div>
										</div>
										<div class="report-col">
											<div class="report-lable">
												<p>Labs</p>
											</div>
											<div class="report-value">
												<p>
													@foreach($result['lab_tests'] as $lab_test_res)
															{{ $lab_test_res['labtest_name'] }}@if(!$loop->last), @endif
													@endforeach
												</p>
											</div>
										</div>
										<div class="report-col">
											<div class="report-lable">
												<p>Status</p>
											</div>
											<div class="report-value">
												{{$result['statusExplanation']}} 
											</div>
										</div>
									</div>
									<div class="lab-report-footer">
										<div class="footer-lable">
											<p>Download Document</p>
										</div>
										<div class="footer-row">
											@foreach($result['attachments'] as $attachments_list)
												<a href="{{ route('labsReportDownload') }}?attachment_id={{$attachments_list['userAttachment_id']}}" class="primary-v1 btn">{{ ucfirst($attachments_list['attachmentLabOrderType'])}}</a> 
											@endforeach
											
										</div>
									</div>
						@endforeach 
						@else 
							<div class="report-text">	
								<p>Sorry No Records</p>	
							</div>
						@endif
                    </div>
                </div>
            </div>
        </div>
    </section>
@include('mobile.includes.foooter-tab')
@endsection
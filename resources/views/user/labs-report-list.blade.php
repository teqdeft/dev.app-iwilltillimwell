@extends('layouts.v1.dashboard')
@section('content')

<div class="content-wrapper">


        <div class="row">
            <div class="col-md-12 grid-margin top-header-page">
                <div class="row">
                    <div class="col-12 col-xl-6 mb-4 mb-xl-0">
                        <h3 class="font-weight-bold">Lab Reports</h3>
                        <h6 class="font-weight-normal mb-0 mt-2">Home / <span><a href="javascript:void(0);">Lab Reports</a></span></h6>
                    </div>
                </div>
            </div>
        </div>
<?php 
/*
echo "<pre>";
print_r($data);
echo "</pre>"; 
die();
 */
?>
        <div class="main-content-box">
            <div class="record-tabs-box">
                <div class="inner-record-tab-box">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12 ml-auto col-xl-12 mr-auto px-0 reports-detail">
                                <div class="lab-reports table-responsive card">
                                    <table>
                                        <thead>

                                            <tr>
                                                <th class="text-left">#</th>
                                                <th>Ordered For</th>
                                                <th>Date</th>
                                                <th>Labs</th>
                                                <th>Status</th>
                                                <th>Download Document</th>
                                            </tr>

                                        </thead>
                                        <tbody>
										
										<tr>
											<td class="text-left">1.</td>
											<td>John Smith</td>
											<td>Jun, 02 2025</td>
											<td>CBC,CMP	</td>
											<td> Lab request is complete </td>
											<td>
											<div class="request_dfg_cta">
	
	<a target="_blank" href="{{'lab-report-download'}}?attachment_id=25192" class="primary-v1">Result</a>
											</div>	
											</td>
										</tr>
										<?php /*
									@if($data['labOrders'])	
									@foreach($data['labOrders'] as $result)
                                            <tr>
                                                <td class="text-left">1.</td>
                                                <td>{{ ucfirst($result['patientFirstName']) }} {{ ucfirst($result['patientLastName'])}}</td>
                                                <td>{{ \Carbon\Carbon::createFromFormat('F, d Y H:i:s O', $result['whenCreated'])->format('M, d Y') }}</td>
                                                <td>
													@foreach($result['lab_tests'] as $lab_test_res)
														{{ $lab_test_res['labtest_name'] }}@if(!$loop->last), @endif
													@endforeach
												</td>
                                                <td> {{$result['statusExplanation']}} </td>
                                                <td> 
													
													@foreach($result['attachments'] as $attachments_list)
														
					
														<a target="_blank" href="{{ route('labsReportDownload') }}?attachment_id={{$attachments_list['userAttachment_id']}}" class="primary-v1 btn">{{ ucfirst($attachments_list['attachmentLabOrderType'])}}</a> 
														
														
													@endforeach
													
                                                    
                                                     
													

                                                </td>
                                            </tr>

                                    @endforeach        
									@else 
										
										<tr>
											<td colspan="6" style="text-align: center;">Sorry No Records</td>
										</tr>	
										
									@endif
									
									*/ ?>
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
 document.getElementById('download-document').addEventListener('click', function () {
        window.location.href = "{{ route('labsReportDownload') }}";
});
</script>
	
@endsection
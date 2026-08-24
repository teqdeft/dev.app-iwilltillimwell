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
                    <h2 class="title">Commission History</h2>
                </div>
                <div class="screen-number d-n">

                </div>
            </div>
        </div>
	</section>
	
		<div class="col-12 grid-margin stretch-card">
			<div class="card card-body">
				<div class="all-consultations-box  p-3">
					<div class="table-responsive pt-3" id="customer-table">
                                <table class="table table-bordered user-table-box" >
                                    <thead>	
										<tr>
											<th>#</th>
											<th>Credit</th>
											<th>Debit</th>
											<th>Date & Time</th>
											<th>Status</th>
										</tr>
                                    </thead>	
                                    <tbody>	
                                    </tbody>	
                                </table>	
						
					</div>
				</div>
			</div>
		</div>
	@include('mobile.includes.foooter-tab')	
@endsection
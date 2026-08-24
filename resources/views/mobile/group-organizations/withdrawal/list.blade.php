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
                    <h2 class="title">Withdrawal List</p>
                </div>
                <div class="screen-number d-n">

                </div>
            </div>
        </div>
	</section>
	<section class="custom-tab tab-edit-v2">	
		<div class="cust-container-lg">
			<div class="tab-container">
				<div id="withdrawal-history-app" class="tab-content active">
					<div class="midical-form v1 detail">
						<div class="account-man-ship">
							<div class="table-responsive drag-scroll">
								@include('group-organizations.withdrawal.withdrawal-list')	
							</div>		
						</div>		
					</div>		
				</div>		
			</div>		
		</div>		
	</section>
	@include('mobile.includes.foooter-tab')	
@endsection

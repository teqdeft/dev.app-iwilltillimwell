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
                    <h2 class="title">Semaglutide</p>
                </div>
            </div>
        </div>
    </section>
	
	
	
	<section class="care-cordin">
        <div class="cust-container-md">
            <div class="health-matters">

                <div class="lab-report-detail">
                    <div class="lab-report-card">
						<p>Contact Support Team</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
@include('mobile.includes.foooter-tab')
@endsection
@extends("mobile.layouts.dashboard")
@section("content")

<section class="msg-special-header">
        <div class="cust-container-md">
            <div class="rec-row">

                <div class="back">
                    <a href="{{ route('mobile-dashboard') }}" class="back-btn">
                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M12.875 16.0417L7.33334 10.5L12.875 4.95834" stroke="#222A3D"
                                stroke-width="1.58333" stroke-linecap="round" stroke-linejoin="round"></path>
                        </svg>
                    </a>
                </div>

                <div class="top-title">
                    <h2 class="title">In-The-Moment Care/Crisis Management  </h2>
                </div>

            </div>
        </div>
</section>


<section class="care-cordin moment-care-main">
    <div class="cust-container-md">
        <div class="cordin">
		
					@include('mobile.consultation.in-the-moment-care-form')
			
			<?php /*	
                <div class="content">
                    <h2 class="top-title therap">
                        In-The Moment Care / Crisis Management
                    </h2>
                    <div class="detail-v1">
                        <p>In-the-Moment Care offers immediate emotional support and Crisis Management helps stabilize, guide, and empower individuals during urgent stressful situations.</p>
                    </div>

                    <div class="image therap">
                        <img src="{{ asset('assets/assets/images/Clinically-Determined.jpg') }}" alt="image" />
                    </div>

                    <div class="repeat-content separate_mental_health">

                        
						<div class="behavior-content">
							
							<div class="access-line-box">
								
								<div class="access_text">
									<p>For Immediate Counseling and Crisis Support Services, please call:</p>
								</div>
								<div class="access_title">
									<p><a href="tel:+833-426-6476"><i class="fas fa-mobile-alt"></i> 833-426-6476</a></p>
								</div>
							</div>
							
							<p class="lry_detail">
								<span>Providers:</span>  Counselors and Master's Level Therapists<br>
								<span>When to Use:</span>  In-The-Moment Care, Crisis Management, Clinically Determined Sessions, Short-Term Therapy.
							</p>
							
							<ul class="lry_ul">
								<li class="fs-18">When you need to speak to a counselor "in-the-moment".</li>
								<li class="fs-18">When you are in a Crisis and need immediate attention.</li>
								<li class="fs-18">When you need Crisis Management.</li>
								<li class="fs-18">When you need Clinically Determined Sessions - When your therapist determines how many sessions you need for your presenting problem.</li>
							</ul>
							
							
							
							
							
						</div>

                       
                       
                    </div>

                   

                </div>
				*/ ?>
        </div>
    </div>
</section>

<?php /*
@include('mobile.consultation.inthe-momentcare-popup')
*/ ?>
@include('mobile.consultation.talk-therapist-popup')
@include('mobile.includes.foooter-tab')
@endsection
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
                    <h2 class="title">Talk to a Therapist</h2>
                </div>
            </div>
    </div>
</section>
<section class="care-cordin">
    <div class="cust-container-md">
        <div class="cordin">						<x-behavioral-health.header />						
			
<section class="support-section behavioral-health-web">
        <div class="container">
           
            <div class="row g-4">
                <!-- Telus -->
                <div class="col-lg-6">
                    <div class="card support-card p-4">
					
						<div class="support_head">
							<span class="badge bg-primary badge-title mb-3">Clinically-Determined Care</span>
							<a href="tel:8334266476">
							<span class="phone-icon">
							<?php if(ismobile()) {?>
							<svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path d="M12.82 10.1733L11.1267 9.98C10.9276 9.95662 10.7258 9.97866 10.5364 10.0445C10.347 10.1103 10.175 10.2182 10.0334 10.36L8.80669 11.5867C6.91429 10.624 5.37607 9.08574 4.41336 7.19334L5.64669 5.96C5.93336 5.67334 6.07336 5.27334 6.02669 4.86667L5.83336 3.18667C5.7957 2.8614 5.63967 2.56135 5.395 2.34373C5.15033 2.12611 4.83414 2.00613 4.50669 2.00667H3.35336C2.60003 2.00667 1.97336 2.63334 2.02003 3.38667C2.37336 9.08 6.92669 13.6267 12.6134 13.98C13.3667 14.0267 13.9934 13.4 13.9934 12.6467V11.4933C14 10.82 13.4934 10.2533 12.82 10.1733Z" fill="#8462A8"></path>
							</svg>
							<?php } else { ?>
							<i class="fas fa-phone-alt"></i>
							<?php } ?>
							</span>
						833-426-6476</a>
						</div>
                        
                        <div class="provider">
                            <h4>Providers</h4>
                            <p>Master’s Level Therapists</p>
                        </div>
						
						<div class="when_use type">
                            <h5 class="mt-4">Appointment Type:</h5>
                            <p><span>Phone</span>, <span>Video</span></p>
                        </div>
						
                        <div class="when_use">
                            <h5 class="mt-4">When to Use</h5>
							
                        </div>
						
						
                        <ul class="list-unstyled">
                           <li><span class="check_circle"><i class="fas fa-check-circle"></i></span>When you would prefer flexible session limits.</li>
                        </ul>
                    </div>
                </div>
                <!-- Lyric -->
                <!-- <div class="col-lg-6">
                    <div class="card support-card p-4">
						<div class="support_head">
							<span class="badge bg-success badge-title mb-3">Pre-Determined Session Limits</span>
							<a href="tel:8442008975"><span class="phone-icon">
							
							<?php if(ismobile()) {?>
							<svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path d="M12.82 10.1733L11.1267 9.98C10.9276 9.95662 10.7258 9.97866 10.5364 10.0445C10.347 10.1103 10.175 10.2182 10.0334 10.36L8.80669 11.5867C6.91429 10.624 5.37607 9.08574 4.41336 7.19334L5.64669 5.96C5.93336 5.67334 6.07336 5.27334 6.02669 4.86667L5.83336 3.18667C5.7957 2.8614 5.63967 2.56135 5.395 2.34373C5.15033 2.12611 4.83414 2.00613 4.50669 2.00667H3.35336C2.60003 2.00667 1.97336 2.63334 2.02003 3.38667C2.37336 9.08 6.92669 13.6267 12.6134 13.98C13.3667 14.0267 13.9934 13.4 13.9934 12.6467V11.4933C14 10.82 13.4934 10.2533 12.82 10.1733Z" fill="#8462A8"></path>
							</svg>
							<?php } else { ?>
							<i class="fas fa-phone-alt"></i>
							<?php } ?>
							
							</span>
						844-200-8975</a>
						</div>
                        
                        <div class="provider">
                            <h4>Providers</h4>
                            <p>Master’s Level Therapists, <br/> Psychologists</p>
                        </div>
						
						<div class="when_use type">
                            <h5 class="mt-4">Appointment Type:</h5>
                            <p><span>Phone</span>, <span>Video</span></p>
                        </div>
						
                        <div class="when_use">
                            <h5 class="mt-4">When to Use</h5>
                            <p></p>
                        </div>
						
						
						
                        <ul class="list-unstyled">
						
							
							
                            <li><span class="check_circle"><i class="fas fa-check-circle"></i></span>When you would prefer highly structured sessions.</li>
							<?php /*
                            <li><span class="check_circle"><i class="fas fa-check-circle"></i></span>When you would like to possibly meet with a psychologist</li>
							
                            <li><span class="check_circle"><i class="fas fa-check-circle"></i></span>Every New Issue starts a new Short-Term Therapy Cycle</li>
							*/ ?>
                            
							
								
                        </ul>
                    </div>
                </div> -->
            </div>
        </div>
    </section></div>
			
			
			

            <div class="safety-plan-detail therap">

                <div class="safety-plan-card open-modal life-retire">
                    <div class="top">
                        <div class="icon">
                            <img src="{{asset('assets/dashboard/assets/images/life-retire.svg')}}" alt="icon">
                        </div>
                        <div class="title">
                            <p>Life</p>
                        </div>
                    </div>
                    <div class="life-row">
                        <ul>
                            <li>Retirement</li>
                            <li>Midlife</li>
                            <li>Student Life</li>
                            <li>Legal</li>
                            <li>Relationships</li>
                            <li>Disabilities</li>
                            <li>Crisis</li>
                            <li>Personal Issues</li>
                        </ul>
                    </div>
                </div>

                <div class="safety-plan-card open-modal life-retire">
                    <div class="top">
                        <div class="icon">
                            <img src="{{ asset('assets/dashboard/assets/images/reasons-to-svg.svg') }}" alt="icon">
                        </div>
                        <div class="title">
                            <p>Family</p>
                        </div>
                    </div>
                    <div class="life-row">
                        <ul>
                            <li>Parenting</li>
                            <li>Couples</li>
                            <li>Separation/Divorce</li>
                            <li>Older Relatives</li>
                            <li>Adoption</li>
                            <li>Death/Loss</li>
                            <li>Child Care</li>
                            <li>Education</li>
                        </ul>
                    </div>
                </div>

                <div class="safety-plan-card open-modal life-retire">
                    <div class="top">
                        <div class="icon">
                            <img src="{{ asset('assets/dashboard/assets/images/find-urgent-svg.svg') }}" alt="icon">
                        </div>
                        <div class="title">
                            <p>Health.</p>
                        </div>
                    </div>
                    <div class="life-row">
                        <ul>
                            <li>Mental Health</li>
                            <li>Addictions</li>
                            <li>Fitness</li>
                            <li>Managing Stress</li>
                            <li>Nutrition</li>
                            <li>Sleep</li>
                            <li>Smoking Cessation</li>
                            <li>Alternative Health</li>
                        </ul>
                    </div>
                </div>

                <div class="safety-plan-card open-modal life-retire">
                    <div class="top">
                        <div class="icon">
                            <img src="{{ asset('assets/dashboard/assets/images/warning-sign-svg.svg') }}" alt="icon">
                        </div>
                        <div class="title">
                            <p>Work.</p>
                        </div>
                    </div>
                    <div class="life-row">
                        <ul>
                            <li>Time Management</li>
                            <li>Career Development</li>
                            <li>Work Relationships</li>
                            <li>Work Stress</li>
                            <li>Managing People</li>
                            <li>Shift Work</li>
                            <li>Coping with Change</li>
                            <li>Communication</li>
                        </ul>
                    </div>
                </div>

                <div class="safety-plan-card open-modal life-retire">
                    <div class="top">
                        <div class="icon">
                            <img src="{{ asset('assets/dashboard/assets/images/dollar-outline-icon.svg') }}" alt="icon">
                        </div>
                        <div class="title">
                            <p>Money.</p>
                        </div>
                    </div>
                    <div class="life-row">
                        <ul>
                            <li>Saving</li>
                            <li>Investing</li>
                            <li>Budgeting</li>
                            <li>Managing Debt</li>
                            <li>Home Buying</li>
                            <li>Renting</li>
                            <li>Estate Planning</li>
                            <li>Bankruptcy</li>
                        </ul>
                    </div>
                </div>

            </div>

            <div class="cordin">

                <div class="content">

                    <div class="repeat-content">
                        <div class="title">
                            <p>Clinical services</p>
                        </div>
                        <div class="repeat-detail">
                            <p>If you or someone you know has been a victim of sexual abuse, text "STRENGTH" to the Crisis Text Line at 741-741 to speak with a certified crisis counselor.</p>
                        </div>
                    </div>

                </div>
            </div>

        </div>

    </section>

@include('mobile.consultation.talk-therapist-popup')
@include('mobile.includes.foooter-tab')
@endsection
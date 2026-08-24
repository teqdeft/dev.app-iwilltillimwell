@extends('layouts.dashboard')
@section('content')
<div class="main-panel">
<div class="content-wrapper">
   <div class="row">
      <div class="col-md-12 grid-margin">
         <div class="row">
            <div class="col-12 col-xl-6 mb-4 mb-xl-0">
               <div class="patient-details ">
                  <div class="media">
                     <div class="title-heading-icon-box-cus">
                        <i class="fas fa-user-md"></i>
                     </div>
                     <div class="media-body">
                        <h3 class="font-weight-bold">Short Term Therapy - Behavioral Health Virtual Counseling </h3>
                        <h6 class="font-weight-normal mb-0">We are here to help </h6>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
   <div class="row">
      <div class="col-12 grid-margin stretch-card behavioral-health-web">
         <div class="card card-body">
            <div class="all-consultations-box all-consultations-box2  p-3">
			
			
			
			<x-behavioral-health.header />
				
			   
			   
              
				<section class="support-section ">
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
										<p>
											<span>Phone</span>, <span>Video</span> <?php /*, <span>Chat</span> */?></p>
									</div>
									
									<div class="when_use">
										<h5 class="mt-4">When to Use</h5>
										<?php /*
										<p>Short-Term Therapy, Clinically Determined Sessions</p>
										*/ ?>
									</div>
									
									
									<ul class="list-unstyled">
									
										<li><span class="check_circle"><i class="fas fa-check-circle"></i></span>When you would prefer flexible session limits.</li>
										
									<?php /*
										<li><span class="check_circle"><i class="fas fa-check-circle"></i></span>When you need Clinically Determined Sessions – Together with your therapist, the number of sessions needed is determined by your presenting problem.</li>
										
										<li><span class="check_circle"><i class="fas fa-check-circle"></i></span>Every New Issue starts a new Short-Term Therapy Cycle.</li>
										*/ ?>	
											
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
										<li><span class="check_circle"><i class="fas fa-check-circle"></i></span>When you would prefer highly structured sessions</li>
										
										<li><span class="check_circle"><i class="fas fa-check-circle"></i></span>When you would like to possibly meet with a psychologist</li>
										
										<li><span class="check_circle"><i class="fas fa-check-circle"></i></span>Every New Issue starts a new Short-Term Therapy Cycle</li>
										*/ ?>
										
										
										
											
									</ul>
								</div>
							</div> -->
						</div>
					</div>
				</section>
	
               
			   
			   
			   
				<?php /*
                <div class="clinical-service-content-box mb-4">
                  <div class="inner-clinical-service-content-box">
                    <h3 class="theme-color">CLINICAL SERVICES</h3>
                     <p class="fs-18">Behavioral Health Virtual Counseling PLUS Clinical, which gives you immediate access to thousands of
                       Masters – level professionals. Members are provided up to 5 counseling visits per issue that can be on the phone, video or face to face.</p>
                  </div>

                </div>
				*/ ?>	



 
	


                <div class="service-tabe-box">
                  <div class="inner-service-tabe-box">
                    
                    <div class="table-responsive">
      								<table class="table table-bordered">
      									<thead>
      										<tr>
      											<th scope="col">Life</th>
      											<th scope="col">Family</th>
      											<th scope="col">Health</th>
      											<th scope="col">Work</th>
      											<th scope="col">Money</th>
      										</tr>
      									</thead>
      									<tbody>
      										<tr>
      											<td>Retirement</td>
      											<td>Parenting</td>
      											<td>Mental Health</td>
      											<td>Time Management</td>
      											<td>Saving</td>
      										</tr>
      										<tr>
      											<td>Midlife</td>
      											<td>Couples</td>
      											<td>Addictions</td>
      											<td>Career Development</td>
      											<td>Investing</td>
      										</tr>
      										<tr>
      											<td>Student Life</td>
      											<td>Separation/Divorce</td>
      											<td>Fitness</td>
      											<td>Work Relationships</td>
      											<td>Budgeting</td>
      										</tr>
      										<tr>
      											<td>Legal</td>
      											<td>Older Relatives</td>
      											<td>Managing Stress</td>
      											<td>Work Stress</td>
      											<td>Managing Debt</td>
      										</tr>
      										<tr>
      											<td>Relationships</td>
      											<td>Adoption</td>
      											<td>Nutrition</td>
      											<td>Managing People</td>
      											<td>Home Buying</td>
      										</tr>
      										<tr>
      											<td>Disabilities</td>
      											<td>Death/Loss</td>
      											<td>Sleep</td>
      											<td>Shift Work</td>
      											<td>Renting</td>
      										</tr>
      										<tr>
      											<td>Crisis</td>
      											<td>Child Care</td>
      											<td>Smoking Cessation</td>
      											<td>Coping with Change</td>
      											<td>Estate Planning</td>
      										</tr>
      										<tr>
      											<td>Personal Issues</td>
      											<td>Education</td>
      											<td>Alternative Health</td>
      											<td>Communication</td>
      											<td>Bankruptcy</td>
      										</tr>
      									</tbody>
      								</table>
      							</div>

                  </div>
				  
				  
					<div class="clinical-services">
					   <div class="behavior-heading-title mb-3">
							<h3 class="theme-color text-capitalize">Clinical services.</h3>
							<div class="content">
							
								<p class="fs-18">If you or someone you know has been a victim of sexual abuse, text "STRENGTH" to the Crisis Text Line at 741-741 to speak with a certified crisis counselor.</p>
								
							</div>
						</div>
					</div>
						 

                </div>
            </div>
         </div>
      </div>
   </div>
</div>
@include('mobile.consultation.talk-therapist-popup')
@endsection

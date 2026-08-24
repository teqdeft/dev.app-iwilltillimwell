@extends('services.dashboard')
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
                        <h3 class="font-weight-bold">Behavioral Health Virtual Counseling PLUS</h3>
                        <h6 class="font-weight-normal mb-0">We are here to help </h6>
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
            <div class="all-consultations-box all-consultations-box2  p-3">
               <div class="row">
                  <div class="col-sm-12">
                     <p class="fs-18">
                        Whether you have questions about handling stress at work and home, parenting and child care,
                        managing money, or health issues, you can turn to your Behavioral Health Virtual
                        Counseling PLUS benefits for a confidential service that you can trust.
                        Behavioral Health Virtual Counseling PLUS offers support with mental, financial, physical,
                        and emotional well-being ANY TIME, 24/7, 365 days a year.
                     </p>
                  </div>
               </div>
               <div class="bhhavioral-contact-wrapper  mb-4">
                 <div class="row">
                    <div class="col-sm-12">
                    </div>
                    <div class="col-xl-5">
                       <div class="inner-behavior-img mb-3 mb-xl-0">
                          <img src="{{ asset('assets/assets/images/call-img.jpg') }}"  alt="call-img"/>
                       </div>
                    </div>
                    <div class="col-xl-7">
                       <div class="inner-behavior-content">
                         <div class="behavior-heading-title mb-3">
                           <h3 class="theme-color text-capitalize">When life gets complicated, Lets us help!</h3>

                         </div>

                          <p class="fs-20">Mental health and wellbeing support program. Speak with a professional counselor via phone or video</p>
                          <ul>
                             <li class="fs-18"><i class="far fa-clock" ></i> Anytime</li>
                             <li class="fs-18"><i class="fas fa-map-marker"></i> Anywhere</li>
                             <li class="fs-18"><i class="fas fa-headset"></i> (24/7/365)</li>
                          </ul>
<hr>
                          <div class="access-line-content-box">
                            <div class="inner-access-line-box">
                               <h3 class="theme-color">ACCESS LINE</h3>
                               <p class="fs-18">To accesss your dedicated counseling service please call:</p>
                               <h2 class="py-2"><a href="tel:+855-399-5547"><i class="fas fa-mobile-alt"></i> 855-399-5547</a></h2>
                            </div>

                          </div>
                       </div>
                    </div>
                 </div>
               </div>
                <div class="clinical-service-content-box mb-4">
                  <div class="inner-clinical-service-content-box">
                    <h3 class="theme-color">CLINICAL SERVICES</h3>
                     <p class="fs-18">Behavioral Health Virtual Counseling PLUS Clinical, which gives you immediate access to thousands of
                       Masters – level professionals. Members are provided up to 5 counseling visits per issue that can be on the phone, video or face to face.</p>
                  </div>

                </div>

                <div class="service-tabe-box">
                  <div class="inner-service-tabe-box">
                    <h3 class="theme-color">CLINICAL SERVICES</h3>
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

                </div>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection

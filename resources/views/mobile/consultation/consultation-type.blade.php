@extends('mobile.layouts.dashboard')
@section('content')

    <section class="msg-special-header">
        <div class="cust-container-md">
            <div class="rec-row">

                <div class="back">
                    <a href="{{ route('mobile-dashboard')}}" class="back-btn">
                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M12.875 16.0417L7.33334 10.5L12.875 4.95834" stroke="#222A3D"
                                stroke-width="1.58333" stroke-linecap="round" stroke-linejoin="round"></path>
                        </svg>
                    </a>
                </div>

                <div class="top-title">
                    <h2 class="title">
					
						@php
								$action = request('action') ?? 'urgentcare';
						@endphp
							
						@if($action == 'psychology')
							Meet with a Psychologist
						@elseif($action == 'psychiatry')
							Meet with a Psychiatrist
						@else
							{{ getConsultantHeading($action) }} Consultation
						@endif
					
					</h2>
                </div>

            </div>
        </div>
    </section>

    <section class="care-cordin my-setting">
        <div class="cust-container-md">

            <div class="sup-t">
                <p>Appointment Type</p>
            </div>
            
            <div class="type-cta-set">
                <button class="phone-class outline-button active-tab" onclick="AppointmentType('phone')" tab-attribute="phone">
                    <span>
                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M12.82 10.1733L11.1267 9.98C10.9276 9.95662 10.7258 9.97866 10.5364 10.0445C10.347 10.1103 10.175 10.2182 10.0334 10.36L8.80669 11.5867C6.91429 10.624 5.37607 9.08574 4.41336 7.19334L5.64669 5.96C5.93336 5.67334 6.07336 5.27334 6.02669 4.86667L5.83336 3.18667C5.7957 2.8614 5.63967 2.56135 5.395 2.34373C5.15033 2.12611 4.83414 2.00613 4.50669 2.00667H3.35336C2.60003 2.00667 1.97336 2.63334 2.02003 3.38667C2.37336 9.08 6.92669 13.6267 12.6134 13.98C13.3667 14.0267 13.9934 13.4 13.9934 12.6467V11.4933C14 10.82 13.4934 10.2533 12.82 10.1733Z" fill="#8462A8"/>
                        </svg>                                                     
                    </span>
                    <span>
                        Phone
                    </span>
                </button>
                <button class="video-class outline-button" onclick="AppointmentType('video')" tab-attribute="video">
                    <span>
                        <svg width="21" height="21" viewBox="0 0 21 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M8.53125 11.375C8.53125 10.8529 8.73867 10.3521 9.10788 9.98288C9.4771 9.61367 9.97786 9.40625 10.5 9.40625C11.0221 9.40625 11.5229 9.61367 11.8921 9.98288C12.2613 10.3521 12.4688 10.8529 12.4688 11.375C12.4688 11.8971 12.2613 12.3979 11.8921 12.7671C11.5229 13.1363 11.0221 13.3438 10.5 13.3438C9.97786 13.3438 9.4771 13.1363 9.10788 12.7671C8.73867 12.3979 8.53125 11.8971 8.53125 11.375Z" fill="#8462A8"/>
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M6.53951 6.68675C6.53928 6.32565 6.61023 5.96804 6.74832 5.63439C6.8864 5.30073 7.0889 4.99756 7.34423 4.74222C7.59957 4.48689 7.90274 4.28439 8.2364 4.14631C8.57005 4.00822 8.92766 3.93727 9.28876 3.9375H11.7108C12.0719 3.93727 12.4295 4.00822 12.7631 4.14631C13.0968 4.28439 13.3999 4.48689 13.6553 4.74222C13.9106 4.99756 14.1131 5.30073 14.2512 5.63439C14.3893 5.96804 14.4602 6.32565 14.46 6.68675C14.4602 6.693 14.4625 6.69898 14.4667 6.70363C14.4709 6.70828 14.4766 6.71129 14.4828 6.71213L16.434 6.86963C17.3081 6.94138 18.0265 7.58713 18.1901 8.449C18.6056 10.6475 18.6364 12.9014 18.2811 15.1104L18.1963 15.6389C18.1184 16.1231 17.8804 16.5672 17.5203 16.9002C17.1602 17.2331 16.6988 17.4357 16.21 17.4755L14.5099 17.6129C11.8409 17.8297 9.15866 17.8297 6.48963 17.6129L4.78951 17.4755C4.30056 17.4357 3.83911 17.233 3.479 16.8998C3.11889 16.5667 2.88095 16.1224 2.80326 15.638L2.71839 15.1104C2.36226 12.901 2.39376 10.6479 2.80939 8.449C2.88886 8.02989 3.10372 7.64846 3.42098 7.36329C3.73823 7.07813 4.14033 6.905 4.56551 6.8705L6.51676 6.71213C6.52295 6.71129 6.52864 6.70828 6.53281 6.70363C6.53698 6.69898 6.53936 6.693 6.53951 6.68675ZM10.4998 8.09375C9.62952 8.09375 8.79492 8.43945 8.17957 9.05481C7.56421 9.67016 7.21851 10.5048 7.21851 11.375C7.21851 12.2452 7.56421 13.0798 8.17957 13.6952C8.79492 14.3105 9.62952 14.6563 10.4998 14.6563C11.37 14.6563 12.2046 14.3105 12.82 13.6952C13.4353 13.0798 13.781 12.2452 13.781 11.375C13.781 10.5048 13.4353 9.67016 12.82 9.05481C12.2046 8.43945 11.37 8.09375 10.4998 8.09375Z" fill="#8462A8"/>
                        </svg>                          
                    </span>
                    <span>
                        Video
                    </span> 
                </button>
            </div>

            <div class="in-depth">
                <div class="top phone-div-content">
                    <div class="title">
                        <p>Phone</p>
                    </div>
                    <div class="disc">
					<p>
					
                        @if($action == 'psychology')
							Via the phone, get in therapy with a Psychologist.
						@elseif($action == 'psychiatry')
							Via the phone, meet with a psychiatrist. Obtain medical advice, recommendations, diagnoses, and prescription medication when appropriate.
						@else 
							Get an in-depth phone consultation with a physician. Obtain medical advice, recommendations, diagnoses, and prescription medication when appropriate.
						@endif
						
						</p>
                    </div>
                </div>
                <div class="top video-div-content" style="display: none;">
                    <div class="title">
                        <p>Video</p>
                    </div>
                    <div class="disc">
                        <p>
						
						@if($action == 'psychology')
							Talk to a psychologist face-to-face.
						@elseif($action == 'psychiatry')
							Talk to a psychiatrist face-to-face. Obtain medical advice, treatment recommendations, diagnoses, and prescription medication when appropriate.
						@else 
							Talk to a physician face-to-face. Obtain medical advice, treatment recommendations, diagnoses, and prescription medication when appropriate.
						@endif
						
						</p>
                    </div>
                </div>

                <div class="action">
                    <button type="button" class="primary-button" onclick="nextScreen()">Next</button>
                </div>

                <div class="depth-row">
                    <div class="row-title">
                        <p>When to use</p>
                    </div>
					
                    <div class="when-to-use-main-v1 audio-case">
						
						<p class="when-to-use-main">
						<?php if(request('action')=="psychiatry") {?>
						
							When you want to meet with a psychiatrist for professional diagnosis, medication management, and treatment plans for mental health conditions requiring medical intervention.
							
						<?php } else if(request('action')=="psychology") {?>
						
							When you need or want to engage in therapy with a psychologist for mental health support, help with managing stress, anxiety, depression, or other emotional challenges.


							
						<?php } else if(request('action')=="dermatology") {?>
						Opt for a Dermatology consultation to address skin concerns such as acne, rashes, eczema, or suspicious moles, with the convenience of expert advice from home.
						<?php } else if(request('action')=="primarycare") {?>
						Schedule a Primary Care appointment with a doctor of your choice for routine check-ups, ongoing health management, and preventive care to maintain your overall well-being and catch potential health issues early. Primary Care is particularly beneficial when you want to check back in with the same doctor over a period of time.
						<?php } else {?>
						Use Virtual Urgent Care for immediate, non-life-threatening medical issues like minor injuries, infections, or illnesses when you need prompt attention without the hassle of an in-person visit.
						<?php } ?>
						</p>

                    </div>
					
                    <div class="when-to-use-main-v1 video-case" style="display:none;">
						
						<p class="when-to-use-main">
						<?php if(request('action')=="psychiatry") {?>
						
							When you need or want to engage in treatment with a psychiatrist for professional diagnosis, medication management, and treatment plans for mental health conditions requiring medical intervention.



						<?php } else if(request('action')=="psychology") {?>
						
							When you need or want to engage in therapy with a psychologist for mental health support, help with managing stress, anxiety, depression, or other emotional challenges.
							
						<?php } else if(request('action')=="dermatology") {?>
						Opt for a Dermatology consultation to address skin concerns such as acne, rashes, eczema, or suspicious moles, with the convenience of expert advice from home.
						<?php } else if(request('action')=="primarycare") {?>
						Schedule a Primary Care appointment with a doctor of your choice for routine check-ups, ongoing health management, and preventive care to maintain your overall well-being and catch potential health issues early. Primary Care is particularly beneficial when you want to check back in with the same doctor over a period of time.
						<?php } else {?>
						Use Virtual Urgent Care for immediate, non-life-threatening medical issues like minor injuries, infections, or illnesses when you need prompt attention without the hassle of an in-person visit.
						<?php } ?>
						</p>

                    </div>
					
                </div>

              

            </div>
            
        </div>
    </section>

  
  <?php /*
@include('mobile.consultation.schedule-consultation-step.psy-welcome-popup')
*/?>

@if(in_array(request('action'), ['psychiatry','psychology']))
	@include('mobile.consultation.talk-therapist-popup')
@endif
	
@include('mobile.includes.foooter-tab')  
<script>
var scheduleConsultation = JSON.parse(localStorage.getItem("scheduleConsultation"));
function AppointmentType(appType) {

    if(appType=="video") {
        $(".phone-class").removeClass("active-tab")
        $(".video-class").addClass(" active-tab");
		$(".audio-case").hide();
        $(".video-case").show();
		
    } else {
        $(".video-class").removeClass("active-tab");
        $(".phone-class").addClass("active-tab");
        
		$(".audio-case").show();
        $(".video-case").hide();
		
    }
    $(".in-depth .top").hide();
    $("."+appType+"-div-content").show();
}  
function nextScreen() {

    let phoneVideo = $(".active-tab").attr("tab-attribute");
    let current_url = localStorage.getItem("current_url");
    let current_segment = localStorage.getItem("current_segment");

	let url = '{{url("schedule-consultation")}}/'+phoneVideo+'/step-1/?action=<?php echo request('action')?>';
    window.location.href=url;
		
   /*  
    if(scheduleConsultation && phoneVideo == scheduleConsultation.current_segment && scheduleConsultation.action === "{{ request('action') }}") {
        window.location.href=scheduleConsultation.current_url;
    } else {
        localStorage.removeItem("scheduleConsultation");
        let url = '{{url("schedule-consultation")}}/'+phoneVideo+'/step-1/?action=<?php echo request('action')?>';
        window.location.href=url;
    } 
	*/
    

} 
$(function(){
    if(scheduleConsultation) {
        if(scheduleConsultation.modality=="phone") {
            AppointmentType('phone')
        } else {
            AppointmentType('video')
        }
        console.log(scheduleConsultation.modality);
    }
});

$(document).on("click", ".primary-button-loading", function () {
    showLoaderPageLoad('show');
});
</script>    
@endsection 
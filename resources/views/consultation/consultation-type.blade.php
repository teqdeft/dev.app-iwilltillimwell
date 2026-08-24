@extends('layouts.v1.dashboard')
@section('content')
<?php 
$mypackageservicelist = GetMyPackageServiceList();
$primarycare = checkServiceEnabled($mypackageservicelist, 5);
$dermatology = checkServiceEnabled($mypackageservicelist, 4);
$psychology = $psychiatry = checkServiceEnabled($mypackageservicelist, 16);
$check_condition = true; 
if(request('action')=="primarycare" && empty($primarycare)) { 
	$check_condition = false;
} else if(request('action')=="dermatology" && empty($dermatology)) { 
	$check_condition = false;
} else if(request('action')=="psychology" && empty($psychology)) { 
	$check_condition = false;
} else if(request('action')=="psychiatry" && empty($psychiatry)) { 
	$check_condition = false;
}
?>
<div class="content-wrapper consultation-type-main">
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
						<h3 class="font-weight-bold">
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
							
						</h3>
						
					</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	</div>
	
	
<?php if(!$check_condition) { ?>
	<div class="row">
		<div class="col-12 grid-margin stretch-card">
			<div class="card card-body">
				<div class="alert alert-info custom-alert-info">							  
					<strong>Info!</strong> Please upgrade your plan. Click <a href="{{ url('dashboard?action=change-plan&active-tab=package')}}"><strong>Here</strong></a> to upgrade your plan.					
				</div>
			</div>
		</div>
	</div>
<?php }?>


<?php if($check_condition) { ?>   
<div class="row">
    <div class="col-12 grid-margin stretch-card">
      <div class="card card-body">
			
        <div class="all-consultations-box all-consultations-box2  p-3">
			<div class="appoint-title mb-3">
				<h4>Appointment Type</h4>
			</div>	
          
          <ul class="nav nav-tabs" role="tablist">
            <li class="nav-item">
              <a class="nav-link active" data-toggle="tab" href="#phone" tab-attribute="phone"><i class="fas fa-phone-alt"></i> Phone</a>
          </li>
          <li class="nav-item">
              <a class="nav-link" data-toggle="tab" href="#video" tab-attribute="video"><i class="fas fa-video"></i> Video</a>
          </li>

      </ul>

      <!-- Tab panes -->
      <div class="tab-content pt-1 border-cus-box">
        <div id="phone" class=" tab-pane active"><br>
          

            <div class="con-use-text ">
			
				<h3>Phone</h3>
				<p class="when-to-use-main">
				@if($action == 'psychology')
					Via the phone, engage in therapy with a psychologist.					
				@elseif($action == 'psychiatry')
					
Via the phone, meet with a psychiatrist. Obtain medical advice, recommendations, diagnoses, and prescription medication when appropriate.


				@else 
					Get an in-depth phone consultation with a physician. Obtain medical advice, recommendations, diagnoses, and prescription medication when appropriate.
				@endif
				</p>
					
				<h3 class="mt-2">When to Use:</h3>
				
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

          <a class="btn btn-primary mr-2" href="javascript:void(0)" onclick="nextScreen()">Next <i class="fa fa-chevron-right fa-arrow-icon"></i></a>

</div>
<div id="video" class=" tab-pane fade"><br>

    

      <div class="con-use-text">
			<h3>Video</h3>
				
			<p class="when-to-use-main">
				@if($action == 'psychology')
					Talk to a psychologist face-to-face.
				@elseif($action == 'psychiatry')
					Talk to a psychiatrist face-to-face. Obtain medical advice, treatment recommendations, diagnoses, and prescription medication when appropriate.
				@else
					Talk to a physician face-to-face. Obtain medical advice, treatment recommendations, diagnoses, and prescription medication when appropriate.
				@endif
			</p>
			
			
			
              <h4 class=" mt-2">When to Use:</h4>
				
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
				
			<div class="alert alert-info custom-alert-info">							  
					<strong>Disclaimer!</strong> Make sure you have a proper working camera, audio device, and proper lighting.					
			</div>
            </div>

    <a class="btn btn-primary mr-2" href="javascript:void(0)" onclick="nextScreen()" >Next <i class="fa fa-chevron-right fa-arrow-icon"></i></a>
</div>

</div>
</div>
</div>
</div>
</div>
<?php /*
@include('mobile.consultation.schedule-consultation-step.psy-welcome-popup')
*/?>

@if(in_array(request('action'), ['psychiatry','psychology']))
	@include('mobile.consultation.talk-therapist-popup')
@endif

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
var scheduleConsultation = JSON.parse(localStorage.getItem("scheduleConsultation"));	
function AppointmentType(appType) {
} 
function nextScreen() { 
  
	let phoneVideo = $(".all-consultations-box .nav-item .active").attr("tab-attribute");  
	
	let current_url = localStorage.getItem("current_url");    
	let current_segment = localStorage.getItem("current_segment");    
	if(scheduleConsultation && phoneVideo == scheduleConsultation.current_segment && scheduleConsultation.action === "{{ request('action') }}") {
		
		let url = '{{url("schedule-consultation")}}/'+phoneVideo+'/step-1/?action=<?php echo request('action')??'urgentcare'?>';        
		window.location.href=url;
	
	} else {        
		localStorage.removeItem("scheduleConsultation");        
		let url = '{{url("schedule-consultation")}}/'+phoneVideo+'/step-1/?action=<?php echo request('action')??'urgentcare'?>';        
		window.location.href=url;   
		
	}    
}
setTimeout(function(){ $(function(){	    
	if(scheduleConsultation) {        
		if(scheduleConsultation.modality=="phone") {            
			AppointmentType('phone')        
		} else {            
			AppointmentType('video')        
		}        
	console.log(scheduleConsultation.modality); 

	
		
	}});}, 1000);  
</script> 
	<?php } ?>
</div>
@endsection 

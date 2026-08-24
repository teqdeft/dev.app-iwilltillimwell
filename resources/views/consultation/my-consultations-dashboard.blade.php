@php
    $userDetails = single_user_details();
	if($upcomingConsultations) {
		$consultations = $upcomingConsultations;
	}
@endphp


@if($consultations)
    @foreach($consultations as $list)

		@php
			$status_class = "completed";
			$status_heading = "Completed";
			$cleanTime = str_replace(',', '',$list['whenScheduled']);
			$parsedTime = \Carbon\Carbon::parse($cleanTime);

			if($list['statusName']=="Pendingschedule") {
				$status_heading = "Pending";
				$status_class = "pending";
			}
			
		@endphp 

		@include('consultation.consultation-dashboard-list-show')

        @break
    @endforeach
	
	@if(count($consultations) >= 2)
		<?php /*
		@foreach($consultations as $details)

			<div class="next-consultaion-outer">
				<a href="{{url('my-consultations')}}" class="">
				<?php
				
					$cleanTime = str_replace(',', '',$details['whenScheduled']);
					$parsedTime = \Carbon\Carbon::parse($cleanTime);
				
				?>
				
				
					<div class="next-consultaion-ico">
						<img src="{{ asset('assets/assets/images/consultation-i.png') }}"  alt="Consultation Icon"/>
					</div>
					<div class="next-consiltation-info">
						<p>Next : <span>{{$details['friendlySubTypeName']}}</span></p>
						<p>•</p>
						<p>{{ $parsedTime->format('M d, Y') }}</p>
					</div>
					<div class="next-consultaion-action">
							<svg xmlns="http://www.w3.org/2000/svg" width="20px" height="20px" viewBox="0 0 24 24" fill="none">
							<path d="M11 16L15 12M15 12L11 8M15 12H3M4.51555 17C6.13007 19.412 8.87958 21 12 21C16.9706 21 21 16.9706 21 12C21 7.02944 16.9706 3 12 3C8.87958 3 6.13007 4.58803 4.51555 7" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
							</svg>
					</div>
					
				</a>
			</div>

		@endforeach
		*/ ?>
	@endif  
	
@else

<div class="dash2_no_record">    
	
	<div class="consul_name_info" style="display: none;"><p>Dr. Jillandra</p></div>

	<div class="image">                     
	<img src="{{asset('assets/dashboard/htmlv/assets/images/friendly-male-doctor.png')}}" alt="Image" />                 
	</div>                 
	<div class="dash_no_recordd_text">                     
		<div class="title">                         
			<p>No consultations yet.</p>                     
		</div>                    
		<div class="content">                         
		<p>You haven't booked any consultations. Book your first consultation to get started.</p>                     
		</div>                     
		<div class="cta">                         
			<a class="btn btn-primary schedule_consultation" href="javascript:void(0)" id="newAffirmationBtn">Schedule a Consultation</a>                    
		</div>                 
	</div>     
</div> 
<script> 

$(function(){ $(".dash2_view_record").hide(); }); 

$(document).on("click", ".schedule_consultation", function () {
	setTimeout(function () {

        $(".get-care-now").addClass("active");
		$("body").addClass("all_background_freeze");

    }, 100); 

});
</script>	
@endif
<div class="dash-wilson">
    <div class="welcome">
			<div class="say-hy">
				<p>Hi {{ ucfirst(Auth::user()->fname) }} {{ ucfirst(Auth::user()->lname) }}! <span> <img src="{{asset('assets/dashboard/htmlv/assets/images/gretha-wilson.svg')}}" > </span> </p>
			</div>
			<div class="wils-cont">
				<p>Welcome to Your Health Dashboard</p>
			</div>
    </div>
    {{-- Health-record completion bar: hidden for organisation members, who have no health record area. --}}
    @if(org_can('health_record'))
    <div class="pro-value">
			<div class="progress-main">
				{!! $GetHealthRecordProcessBarPercentage !!}
			</div>
    </div>
    @endif
</div>
<div class="upcom-row dashboard-header-default">

		<div class="upcoming-visit aff">
			<div class="daily-affirmation">
				<div class="affirmation-title">
					<p>My Daily Affirmation</p>
				</div>
				<div class="afirmation-text">
					@if($affirmation->message)
						<p id="affirmationMessage">{{$affirmation->message}}</p>
					@endif
				</div>
				<div class="afirmation_cta">
					<a class="btn btn-primary" href="javascript:void(0)" id="newAffirmationBtn">New Affirmation</a>
				</div>
				
			</div>
			<div class="affirmation_img">
				<img src="{{asset('assets/dashboard/htmlv/assets/images/iwilltilimwell-h-headerbar-mini.png')}}" >
			</div>
		</div>
		
		<div class="upcoming-visit vis_dash2">
			<div class="consul_dash2">
				<div class="dash2_top">
					<div class="dash2_left">
						<p>My Consultations</p>
					</div>
					<div class="dash2_right">
						{{-- The app's own empty state hides this link via JS; for org
						     members the empty state is rendered server-side, so hide
						     it here for the same result. --}}
						@if(!org_current())
							<a href="{{url('my-consultations')}}" class="dash2_view_record">View All</a>
						@endif
					</div>
				</div>
				
				@if(org_current())
					{{-- The counters are filled by an ajax call to
					     my-consultations-dashboard, which EnforceOrgAccess blocks
					     for an organisation without Medical Care - leaving the card
					     blank. Render the app's own empty state directly instead.
					     Same markup and classes as
					     consultation/my-consultations-dashboard.blade.php, so it
					     picks up the existing styling. --}}
					<div class="dash2_urgent imwell-empty-consult">
						<div class="dash2_no_record">
							<div class="image">
								<img src="{{ asset('assets/dashboard/htmlv/assets/images/friendly-male-doctor.png') }}" alt="Dr. Jill" />
							</div>
							<div class="dash_no_recordd_text">
								<div class="title">
									<p>No consultations yet.</p>
								</div>
								<div class="content">
									<p>You haven't booked any consultations. Book your first consultation to get started.</p>
								</div>
								@if(org_can('medical_care'))
									{{-- Only offered when the organisation actually has
									     Medical Care, so the button is never a dead end. --}}
									<div class="cta">
										<a class="btn btn-primary" href="{{ url('consultation-type') }}?action=urgentcare">Schedule a Consultation</a>
									</div>
								@endif
							</div>
						</div>
					</div>
					<style>
						/* The stock rule positions the illustration absolutely at
						   bottom:-49px, which assumes the taller layout that includes
						   the CTA. Without the button the block is shorter and the
						   image rides up over the card title, so pin it inside a
						   container of its own with room for it. Scoped to
						   .imwell-empty-consult, which only renders for org members. */
						.upcoming-visit.vis_dash2 .imwell-empty-consult .dash2_no_record{
							position:relative;min-height:200px;overflow:hidden;padding:6px 0}
						.upcoming-visit.vis_dash2 .imwell-empty-consult .dash2_no_record .image{
							position:absolute;left:0;bottom:0;height:auto;width:170px;
							max-height:196px;display:flex;align-items:flex-end}
						.upcoming-visit.vis_dash2 .imwell-empty-consult .dash2_no_record .image img{
							width:100%;height:auto;object-fit:contain;display:block}
						.upcoming-visit.vis_dash2 .imwell-empty-consult .dash2_no_record .dash_no_recordd_text{
							padding-left:190px;display:flex;flex-direction:column;
							justify-content:center;min-height:200px}
						@media(max-width:1199px){
							.upcoming-visit.vis_dash2 .imwell-empty-consult .dash2_no_record{min-height:172px}
							.upcoming-visit.vis_dash2 .imwell-empty-consult .dash2_no_record .image{
								width:142px;max-height:168px}
							.upcoming-visit.vis_dash2 .imwell-empty-consult .dash2_no_record .dash_no_recordd_text{
								padding-left:158px;min-height:172px}
						}
					</style>
				@else
				<div class="dash2_urgent" id="dash-consut-list">
					<div class="dash_consul_record" style="display:none;">
																		
									<div class="dash_consul_card new">
										<div class="title">
											<p>New</p>
										</div>
										<div class="dash_value">
											<p>12</p>
										</div>
									</div>
									
									<div class="dash_consul_card progress_vs1">
										<div class="title">
											<p>In Progress</p>
										</div>
										<div class="dash_value">
											<p>1</p>
										</div>
									</div>
									
									<div class="dash_consul_card complete">
										<div class="title">
											<p>Complete</p>
										</div>
										<div class="dash_value">
											<p>2</p>
										</div>
									</div>
									
									<div class="dash_consul_card canceled">
										<div class="title">
											<p>Canceled</p>
										</div>
										<div class="dash_value">
											<p>10</p>
										</div>
									</div>
									
								</div>
				</div>
				@endif
				
			</div>
	</div>         
</div>
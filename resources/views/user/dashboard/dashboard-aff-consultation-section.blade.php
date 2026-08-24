<div class="dash-wilson">
    <div class="welcome">
			<div class="say-hy">
				<p>Hi {{ ucfirst(Auth::user()->fname) }} {{ ucfirst(Auth::user()->lname) }}! <span> <img src="{{asset('assets/dashboard/htmlv/assets/images/gretha-wilson.svg')}}" > </span> </p>
			</div>
			<div class="wils-cont">
				<p>Welcome to Your Health Dashboard</p>
			</div>
    </div>
    <div class="pro-value">
			<div class="progress-main">
				{!! $GetHealthRecordProcessBarPercentage !!}
			</div>
    </div>
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
						<a href="{{url('my-consultations')}}" class="dash2_view_record">View All</a>
					</div>
				</div>
				
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
				
			</div>
	</div>         
</div>
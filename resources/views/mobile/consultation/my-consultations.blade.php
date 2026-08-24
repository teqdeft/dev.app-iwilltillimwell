@extends('mobile.layouts.dashboard')
@section('content')
<section class="record-header">
        <div class="cust-container-md">
            <div class="rec-row">
                <div class="back">
                    <a href="{{ route('mobile-dashboard')}}" class="back-btn">
                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M12.875 16.0417L7.33334 10.5L12.875 4.95834" stroke="#222A3D"
                                stroke-width="1.58333" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </a>
                </div>
                <div class="top-title">
                    <h2 class="title">My Consultations</p>
                </div>
                <div class="screen-number d-n">

                </div>
            </div>
        </div>
</section>

@php
    $slug = request()->segment(2);
@endphp
<section class="custom-tab">
	<div class="cust-container-lg">
		<div class="tab-container">
			<div class="tab-header">
				<div class="tab-buttons">
					
					<button onclick="view('all')" class="tab-link {{ ($slug === 'all' || $slug === null) ? 'active' : '' }}" data-tab="tab1">All</button>
					<button onclick="view('new')" class="tab-link {{ ($slug === 'new') ? 'active' : '' }}">New</button>
					<button onclick="view('inprogress')" class="tab-link {{ ($slug === 'inprogress') ? 'active' : '' }}">In Progress</button>
					<button onclick="view('complete')" class="tab-link {{ ($slug === 'complete') ? 'active' : '' }}">Complete</button>
					<button onclick="view('canceled')" class="tab-link {{ ($slug === 'canceled') ? 'active' : '' }}">Canceled</button>
					
				</div>
			</div>
		</div>
	</div>
</section>


<section class="consul-my-v1">
        <div class="cust-container-md">
            <?php /*
            <div class="con-row">
                <div class="left">
                    <p>All</p>
                </div>
                <div class="right">
                    <div class="custom-dropdown" style="display:none;">
                        <button class="dropdown-btn">
                            Sort
                            <span class="dropdown-icon"><img src="{{ asset('assets/dashboard/assets/images/down-icon.svg')}}" alt="icon" /> </span>
                        </button>
                        <ul class="dropdown-list">
                            <li class="dropdown-item" data-value="a">Value A</li>
                            <li class="dropdown-item" data-value="b">Value B</li>
                            <li class="dropdown-item" data-value="c">Value C</li>
                        </ul>
                    </div>
                </div>
            </div>
			*/ ?>
 @if($consultations)
    @foreach ($consultations as $consultation)

		<?php 
			$date = DateTime::createFromFormat('F, d Y H:i:s O', $consultation['whenScheduled']);
		
		?>
		
		<section class="app-consultation">
        <div class="app-xyz">
            <div class="consul-app-card">

                <div class="top">
                    <button class="primary-button  type-consul">{{$consultation['friendlySubTypeName']}}</button>
					
					
					@if($consultation['statusName'] === 'New')
						<button class="primary-button new primary-v1">New</button>
					@elseif($consultation['statusName'] === 'Pendingschedule')
						<button type="button" class="primary-button pending primary-v1">Pending Schedule</button>
					@elseif($consultation['statusName'] === 'Inactive')
						<button type="button" class="primary-button cancelled primary-v1">Cancelled</button>
					@elseif($consultation['statusName'] === 'Inprogress')
						<button type="button" class="primary-button inprogress primary-v1">InProgress</button>
					@elseif($consultation['statusName'] === 'Complete')
						<button type="button" class="primary-button completed primary-v1">Completed</button>
					@else
						{{ $consultation['statusName'] }}
					@endif
					
					
                </div>

                <div class="consul-main">



                    <div class="name-info">
						
                        <div class="left">
                            <div class="app-title">
                                <p>Provider Name</p>
                            </div>
                            <div class="app-text">
                                <p class="provider-name">Michael McKee</p>
                            </div>
                        </div>
                        <div class="right">
                            <div class="app-title">
                                <p>Modality</p>
                            </div>
                            <div class="app-text">
                                <p>{{ucfirst($consultation['modality'][0])}}</p>
                            </div>
                        </div>
                    </div>

                    <div class="patient-name">
                        <div class="patient sub-title">
                            <p>Patient</p>
                        </div>
                        <div class="app-text">
                            <p>Rakesh studioubique</p>
                        </div>
                        <div class="app-text">
                            <p>({{calculateAge($consultation['patient']['dob'])}} yr old {{getGender($consultation['patient']['gender'])}})</p>
                        </div>
                    </div>

                    <div class="date">
                        <div class="left">
                            <div class="app-title">
                                <p>Scheduled For</p>
                            </div>
                            <div class="app-text">
                                <p>{{ convertToLocal($consultation['whenScheduled']) }}</p>
                            </div>
                        </div>
                        <div class="right">
                            <div class="app-title">
                                <p>Completed On</p>
                            </div>
                            <div class="app-text">
                                <p>{{ convertToLocal($consultation['whenScheduled']) }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="pati-footer">
						@if($consultation['statusName'] != 'Inactive')
							<a target="_blank" href="{{ url('my-consultations/print-out')}}?consultation_id={{ $consultation['userConsultation_id'] }}" class="primary-button v1 btn">
												<span>
													<img 
														src="{{ asset('assets/dashboard/htmlv/assets/images/print-consultation-svg.svg')}}"
														alt="Print Document">
												</span>
												Print Record
							</a>
											
							<button class="primary-button download">
								<span>
									<img src="{{ asset('assets/dashboard/htmlv/assets/images/download-con-icon-svg.svg')}}" alt="Download">
								</span>	
								Download Consultation Audio
							</button>
						@endif
                        <button class="primary-button show-more-info" id="toggleBtn-{{ $consultation['userConsultation_id'] }}" onclick="toggleDiv({{ $consultation['userConsultation_id'] }})">
							<span>	
								<img src="{{ asset('assets/dashboard/htmlv/assets/images/monotone-add-svg.svg')}}" 
												alt="toggle div">
							</span>					
						</button>
                    </div>
					
					@include('mobile.consultation.my-consultations-basic-info')
					
                    

                </div>
            </div>
        </div>
    </section>
			<?php /*
            <div class="con-card">
                <div class="top">
                    <div class="image">
                        <img src="{{ asset('assets/dashboard/assets/images/qlementine-icons.svg')}}" alt="icon" />
                    </div>
                    <div class="conte-s1">
                        <div class="name">
                            <p>{{ $consultation['patient']['firstName'] . ' ' . $consultation['patient']['lastName']}}</p>
                        </div>
                        <div class="type-r">
                            <div class="col-50">
                                <div class="con-t">
                                    <p>Consultation Type</p>
                                </div>
                                <div class="con-v">
                                    <p>{{ $consultation['friendlySubTypeName'] }}</p>
                                </div>
                            </div>
                            <div class="col-50">
                                <div class="con-t">
                                    <p>Scheduled For</p>
                                </div>
                                <div class="con-v">
                                    <p>
									<?php echo $date->format('F j, Y g:i A');?>
									</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bottom">
                    <div class="left">
                        <p>
                            <span>Physician :</span>
                            <span class="font-b"> 
							{{ $consultation['physician'] ? $consultation['physician']['firstName']. " ".$consultation['physician']['lastName'] : "-"  }}
							</span>
                        </p>
                    </div>
                    <div class="ct-btn">
                        <button class="primary-button @if($consultation['statusName'] === 'New')  new @else cancel @endif">
						@if($consultation['statusName'] === 'New')
							{{ $consultation['statusName'] }}
						@elseif($consultation['statusName'] === 'Inactive')
							Inactive
						@elseif($consultation['statusName'] === 'Pendingschedule')
							Pending Schedule
						@else 
							
						@endif
						
						</button>
                    </div>
                </div>
            </div>
			*/ ?>
	@endforeach
    @else
		
	<div class="con-card">
		<div class="bottom">
			<p>No matching records found</p>
		</div>     
    </div>     
		 
   @endif

        </div>
    </section>

    @include('mobile.includes.foooter-tab')
	
<script>
function view(slug){
	window.location.href='{{ url("my-consultations")}}/'+slug;
}
function toggleDiv(userConsultation_id) {
            const div = document.getElementById("myDiv-"+userConsultation_id);
            const btn = document.getElementById("toggleBtn-"+userConsultation_id);

            if (div.style.display === "none" || div.style.display === "") {
                div.style.display = "block";
                btn.classList.add("show"); // add class to button
            } else {
                div.style.display = "none";
                btn.classList.remove("show"); // remove class from button
            }
}
</script>
@endsection
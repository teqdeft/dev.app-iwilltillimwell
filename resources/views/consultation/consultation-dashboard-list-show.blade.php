<div class="dash_row consultation_card-dash">
		
		
			<div class="dash_cta">
				<p class="dash_care">{{$list['friendlySubTypeName']}}</p>
				<p class="dash_status {{$status_class}}">{{$status_heading}}</p>
			</div>
			<div class="dash_consultation">
				<!-- <div class="dash_consultaion-left">
					<div class="provider-icon">
						<img src="{{ asset('assets/assets/images/user-demo.png') }}"  alt="Consultation Icon"/>
					</div>
				</div> -->
				<div class="dash_consultaion-info">
					<div class="dash_consultaion-info_left">
						<div class="provider-icon">
							<img src="{{ asset('assets/dashboard/assets/images/dummy-image.svg') }}"  alt="Consultation Icon"/>
						</div>
						<div class="provider-info">
							<div class="dash_title">
								<p>Provider</p>
							</div>
							<div class="provider_name">
								<p>Michael McKee</p>
						   </div>
							<div class="provider-extra-info">
								<p>{{ $parsedTime->format('M d, Y') }}</p>
								<span>•</span>
								<p>{{ $parsedTime->format('g:i A') }}</p>
							</div>
						</div>

					</div>
					
					 <div class="patient">
						<div class="provider-icon">
							@if(!empty($userDetails->profile_image) && file_exists(public_path('profiles/' . $userDetails->profile_image)))
								<img src="{{ asset('profiles/' . $userDetails->profile_image) }}" width="100" alt="Profile Image" />
							@else 
								<img src="{{ asset('assets/assets/images/user-demo.png') }}"  alt="Consultation Icon"/>
							@endif
						</div>
						<div class="patient-info">
							<div class="dash_title">
								<p>Patient</p>
							</div>
							<div class="provider_name">
								<p>
									{{$list['patient']['firstName']}}
									{{$list['patient']['middleName']}}
									{{$list['patient']['lastName']}}
								</p>
							</div>
						</div>

					</div>
				</div>

				
			</div>
        </div>
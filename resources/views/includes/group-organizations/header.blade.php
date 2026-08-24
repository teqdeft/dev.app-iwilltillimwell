@php
    $userDetails = single_user_details();
@endphp
<div class="container-scroller">
  	<nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row dashboard-header">
  		<div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
			@php
				$dashboard_url = url('/group-organizations');
			@endphp	
			
  			<a class="navbar-brand brand-logo px-1" href="{{$dashboard_url}}"><img src="{{ asset('assets/assets/images/sg-iwilltilimwell-h-headerbar-logomark.png') }}"  alt="logo"/></a>
			
  			<a class="navbar-brand brand-logo-mini" href="{{$dashboard_url}}"><img src="{{ asset('assets/assets/images/sg-iwilltilimwell-h-headerbar-logomark-mini.png' ) }}" alt="logo"/></a>
			
  		</div>
  		<div class="navbar-menu-wrapper d-flex align-items-center justify-content-between">
  			<button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
  				<span class="icon-menu"></span>
  			</button>
  			
  			<div class="navbar-nav-right d-flex align-items-center">
			
			
				<div class="google-translate">
					 
				</div>
					
			
			
  			<ul class="navbar-nav ml-4">
  				<li class="nav-item nav-profile dropdown">
  					<a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" id="profileDropdown">
  						<div class="profile-img-v1">
							@if(!empty($userDetails->profile_image) && file_exists(public_path('profiles/' . $userDetails->profile_image)))
								<img src="{{ asset('profiles/' . $userDetails->profile_image) }}" width="100" alt="Profile Image" />
							@else
								<img src="{{ asset('assets/dashboard/assets/images/dummy-image.svg')}}" alt="image" />
							@endif	
						</div>
						{{ ucfirst($userDetails->fname) }} {{ ucfirst($userDetails->lname) }}  <i class="fas fa-angle-down"></i>
  					</a>
  					<div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
  						
                       
                        <a class="dropdown-item" href="{{ route('group-organizations-my-account') }}">
                            {{ __('My Account') }}
                        </a>
						
                        <a class="dropdown-item" href="{{ route('logout') }}">
                            {{ __('Logout') }}
                        </a> 
                       
                      
                    </div>
                </li>
            </ul>
				<button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
					<span class="icon-menu"></span>
				</button>   
  			</div>
  			
      </div>
  </nav>

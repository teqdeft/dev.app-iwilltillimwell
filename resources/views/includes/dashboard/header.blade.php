@php
    $userDetails = single_user_details();
@endphp
<div class="container-scroller top_main_header">
  	<nav class="navbar col-lg-12 col-12 dashboard-header">
	
		<?php
			/*
  		<div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
			
			
			
			@php
				$dashboard_url = url('/dashboard');
				if ($userDetails->user_role == "admin") {
					$dashboard_url = url('/admin/dashboard');
				}
			@endphp	
  			<a class="navbar-brand brand-logo px-1" href="{{$dashboard_url}}"><img src="{{ asset(env('APP_LOGO_WEB')) }}"  alt="logo"/></a>
			
  			<a class="navbar-brand brand-logo-mini" href="{{$dashboard_url}}"><img src="{{ asset('assets/assets/images/sg-iwilltilimwell-h-headerbar-logomark-mini.png' ) }}" alt="logo"/></a>
			
			
  		</div>
		
		*/
			
		?>
  		<div class="navbar-menu-wrapper d-flex align-items-center justify-content-between">
			<?php
				/*
				<button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
					<span class="icon-menu"></span>
				</button>
			*/
			?>
  			
  			<div class="navbar-nav-right d-flex align-items-center">
			
			
			<div class="google-translate">
				  <div id="google_translate_element" style="display:none;"></div>
				  <div class="custom-lang" id="langDropdown">
					<div id="selectedLang" data-lang="en" class="selected">
					  <span class="flag-ico en"></span> English
					</div>
					<ul class="dropdown-v1">
					  <li data-lang="en"><span class="flag-ico en"></span> English</li>
					  <li data-lang="es"><span class="flag-ico spn"></span> Spanish</li>
					</ul>
				  </div>
			</div>
					
			<?php /*
  			 <div id="google_translate_element" style="display:none;"></div>
			 
			<div class="google-transalte">
				 <select id="customTranslate" class="custom-select">
				 
					<option value="en">
						<span class="flag-ico en">&nbsp;</span>English
					</option>
					<option value="es">
						<span class="flag-ico spn">&nbsp;</span>Spanish
					</option>
					
				</select>
			</div>
			*/?>
			
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
  						<!-- <a class="dropdown-item">
  							<i class="ti-settings text-primary"></i>
  							Settings
  						</a>
  						<a class="dropdown-item">
  							<i class="ti-power-off text-primary"></i>
  							Logout
  						</a> -->
                        @if (Route::has('login'))
                        @auth
					
					@if(auth()->user()?->user_role == 'user')
                        <a class="dropdown-item " href="{{ url('my-account') }}">
                            {{ 'My Profile' }}
                        </a>
						
						
							
						@endif	
						
						<?php /*	
						<a class="dropdown-item " href="{{ url('share/add/setting') }}">
                            {{ 'My Settings' }}
                        </a>
						*/ ?>
						
                        <a class="dropdown-item " href="{{ route('logout') }}">
                            {{ __('Logout') }}
                        </a>
                        <!-- <a href="{{ url('/home') }}" class="text-sm text-gray-700 underline">Home</a> -->
                        @else
                        <div class="login-link"><a href="{{ route('login') }}">Login</a></div>
                        <div class="register-link"><a href="{{ route('register') }}">Let's get started</a></div>
                        @endauth
                        @endif
                    </div>
                </li>
            </ul>
            <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
              <span class="icon-menu"></span>
          </button>   
  			</div>
  			
      </div>
  </nav>

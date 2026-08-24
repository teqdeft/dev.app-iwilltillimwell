<div class="container-scroller">
  	<nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
  		<div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center" style="visibility: hidden;">
  			<a class="navbar-brand brand-logo px-1" href="{{ url('/')  }}"><img src="{{ asset('assets/assets/images/company-logo.png') }}"  alt="logo"/></a>
  			<a class="navbar-brand brand-logo-mini" href="{{ url('/') }}"><img src="{{ asset('assets/assets/images/company-logo-small.png' ) }}" alt="logo"/></a>
  		</div>
  		<div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
  			<button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
  				<span class="icon-menu"></span>
  			</button>
  			<ul class="navbar-nav navbar-nav-right">
  				<li class="nav-item nav-profile dropdown">
  					<a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" id="profileDropdown">
  						<i class="fas fa-user-circle mr-2 fs-30"></i>  {{ Auth::user()->name }} <i class="fas fa-angle-down"></i>
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
                        <a class="dropdown-item " href="{{ url('/feels/logout') }}">
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
  </nav>
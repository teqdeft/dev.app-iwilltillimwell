<div class="shadow-cus-box"></div>
<div class="top-header-box">
	<div class="header-inner ">
		<div class="feature-sec d-flex justify-content-between w-100">
			<div class="d-flex mob-box-number">
				<!-- 	<div class="feature-box ">
               <div class="inner-box">
               <a href="tel:+8332375455">	<i class="fas fa-mobile-alt"></i>	<h4> (833) 237-5455</h4></a>
               </div>
               </div> -->
				<div class="feature-box ">
					<div class="inner-box">
						<a href="mailto:support@iwilltilimwell.com">
							<i class="far fa-envelope"></i>
							<h4>support@iwilltilimwell.com</h4>
						</a>
					</div>
				</div>
			</div>
			<div class="d-flex">
				<div class="feature-box ">
					<div class="inner-box">
						<!-- <img src="{{ asset('assets/images/telemedicine.png') }}" alt="telemedicine">	 -->
						<a href="{{ url('contact-us') }}"><i class="fa fa-address-book" aria-hidden="true"></i>
						<h4> Contact Us</h4></a>
					</div>
				</div>
				<div class="feature-box ">
					<div class="inner-box">
						<!-- <img src="{{ asset('assets/images/telemedicine.png') }}" alt="telemedicine">	 -->
						<i class="fas fa-headset"></i>
						<h4> Telemedicine</h4>
					</div>
				</div>
				<div class="feature-box ">
					<div class="inner-box">
						<!-- <img src="{{ asset('assets/images/teletherapy.png') }}" alt="teletherapy"> -->
						<i class="fas fa-laptop-medical"></i>
						<h4>Teletherapy</h4>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="header-inner">
	<div class="logo"><a href="{{ url('/')}}"><img src="{{ asset('assets/images/logo.png') }}" alt="logo"></a></div>
	<div class="header-right">
		<div id="google_translate_element" class="mr-15"></div>
		@if (Route::has('login'))
		@auth
		<div class="dropdown">
			<button class="btn btn-secondary dropdown-toggle user-logout-btn" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				<i class="fas fa-user-circle mr-2 fs-30"></i>
				<h5 class="un-text-db"> {{ Auth::user()->name }}</h5>
			</button>
			<div class="dropdown-menu user-logout-dropdown-menu" aria-labelledby="dropdownMenuButton">
				@if (Auth::user()->user_role=='admin')
				<a  href="{{ url('/admin/dashboard') }}" class="d-flex align-items-center justify-content-between">
				@elseif (Auth::user()->user_role=='influencer')
				<a  href="{{ url('/affiliate/dashboard') }}" class="d-flex align-items-center justify-content-between">
				@else
				<a  href="{{ url('/dashboard') }}" class="d-flex align-items-center justify-content-between">
				@endif
					Dashboard<i class="fas fa-tachometer-alt"></i>
				</a>
				<a href="{{ route('logout') }}" class="d-flex align-items-center justify-content-between">
					{{ __('Logout') }} <i class="fas fa-sign-out-alt"></i>
				</a>
			</div>
		</div>
	</div>
	<!-- <a href="{{ url('/home') }}" class="text-sm text-gray-700 underline">Home</a> -->
	@else
	<div class="login-link"><a href="{{ route('login') }}" class="btn-2">Login</a></div>
	<div class="register-link register-link-header-menu"><a href="{{ route('register') }}">Get Started </a></div>
	<div class="hamburger-menu">
		<ul class="mobile-menu">
			<li></li>
			<li></li>
			<li></li>
			<li></li>
		</ul>
	</div>
</div>
@endauth
@endif
</div>

<div class="bottom-header">
	<div class="inner-bottom-header">
		<nav class="navbar navbar-expand-lg navbar-light">
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarTogglerDemo01">
				{!! get_all_menu() !!}
			</div>
		</nav>
	</div>
</div>
</div>

@extends("mobile.layouts.auth")
@section("content")
<div class="app-main screen-email filter" style="background-image: url({{ asset('mobile-images/login-new-image.png') }}) !important;">

    <section class="sign-in-min">
        <div class="cust-container">
            <div class="sign-content">
                <div class="logo-main">
                    <a href="{{ url('/')}}">
						<img class="logo"  src="{{ asset(env('APP_LOGIN_MOBILE')) }}" alt="web logo">	
                    </a>
                </div>
                <div class="sign-detail">
                    <div class="form-detail">
                        <form method="POST" action="{{ route('custom-login') }}" id="user-login-form">
                            @csrf
                            <div class="cust-form">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                    name="email" placeholder="Email" aria-label="Email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong class="error">{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="cust-form">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"  name="password" placeholder="Password" aria-label="Password" required autocomplete="current-password">
                                
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong class="error">{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="cta">
                                <button type="submit" class="primary-button">sign-in</button>
                            </div>
                            <div class="full-w">
                                <div class="or">
                                    <p>Or</p>
                                </div>
                                <div class="cta-with-phone">
                                    <a href="{{ route('loginWithOtp')}}" class="outline-button">Sign In with Phone Number</a>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="bottom-detail">
                        <p>Need an account? <span><a href="{{ url('register') }}">Sign up</a></span></p>
                        <p>Need help with your password ?<span><a href="{{ url('password/reset') }}">Reset it.</a></span></p>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<script>
localStorage.clear();
</script>
@endsection

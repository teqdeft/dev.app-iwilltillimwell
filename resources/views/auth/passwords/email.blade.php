@extends('layouts.auth')
@section('content')
<section class="new-login-web">
        <div class="new-login-container">
            <div class="background-image">
                <img src="{{ asset('assets/frontend/assets/images/woman-sitting-front-lake.png')}}" alt="background image">
            </div>
            <div class="login-form-web">
                <div class="lotin-card-web">
                    <div class="card">
                        <div class="top-section">
                            <div class="logo">
								<a href="{{ url('/')}}">
									<img class="logo"  src="{{ asset(env('APP_LOGIN_MOBILE_BLACK')) }}" alt="web logo">	
								</a>	
                            </div>
                            <div class="title">
                                <h1 class="web-t"></h1>
                            </div>
                        </div>
                        @if (session('status'))
                                  <div class="alert alert-success" role="alert">
                                      {{ session('status') }}
                                  </div>
                              @endif
                              
                        <form class="web-login cust-form" method="POST" action="{{ route('password.email') }}" id="user-login-form">
                        @csrf
                            <div class="form-row">
                                <div class="col-100 form-group">
                                    <input class="form-control" type="text" name="email"  id="email" placeholder="Email">
                                </div>
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                               
                    
                                <div class="col-100 form-group cta">
                                    <button onclick="return formSubmit()" type="submit" class="custom-cta">Send Password Reset Link</button>
                                </div>
                            </div>
                        </form>

                        <div class="dont-account">
                            <p>Do have an account? <span><a href="{{ route('login')}}" class="dont">Back To Login</a></span></p>
                        </div>
                </div>  
            </div>
        </div>
    </div>
</section>
@endsection
<style>
span.invalid-feedback {
    color: red;
}
</style>  
<script>
function formSubmit() {

    let email = $("#email").val();
    var emailPattern = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
    if(!emailPattern.test(email)){
        toastr.warning('Please Enter Valid Email ID');
        return false;
    }
    return true;
}

</script>  
<?php /*
@extends('layouts.default')
@section('content')
<section class="main-content-wrapper">
    <div class="content-container inner-form-box">
        <div class="content-left">
            <div class="left-image"><img src="{{ asset('assets/images/login-background.png') }}" alt="login-background"></div>
        </div>
        <div class="content-right d-flex align-items-center justify-content-center">
            <div class="content-inner login-sec pt-0 rs-mt-100">
                <div class="login-cont bg-white">
                    <div class="login-top">
                        <h2>{{ __('Reset Password') }}</h2>
                        <p>Enter your email address to reset your password. </p>
                    </div>
                    <div class="login-form">
                              @if (session('status'))
                                  <div class="alert alert-success" role="alert">
                                      {{ session('status') }}
                                  </div>
                              @endif

                              <form method="POST" action="{{ route('password.email') }}" id="forgot-password-email-form">
                                  @csrf

                                  <div class="form-group">
                                      <label for="email" class=" col-form-label text-md-right">{{ __('E-Mail Address') }}</label>


                                          <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                          @error('email')
                                              <span class="invalid-feedback" role="alert">
                                                  <strong>{{ $message }}</strong>
                                              </span>
                                          @enderror

                                  </div>

                                  <div class="form-group  mb-0">

                                          <button type="submit" class="btn btn-primary">
                                              {{ __('Send Password Reset Link') }}
                                          </button>

                                  </div>
                              </form>


                    </div>
                </div>
        </div>
    </div>
</section>
@endsection
*/ ?>
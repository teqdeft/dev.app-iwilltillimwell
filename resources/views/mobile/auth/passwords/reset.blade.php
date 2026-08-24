@extends('mobile.layouts.default')

@section('content')
<div class="app-main reset-password filter">
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
                            <form method="POST" action="{{ route('password.update') }}" id="reset-password-form">
                                @csrf
                                 <input type="hidden" name="token" value="{{ $token }}">
                                <div class="cust-form"> 
                                  <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus placeholder="Email" aria-label="Email">

                                  @error('email')
                                      <span class="invalid-feedback" role="alert">
                                          <strong class="error">{{ $message }}</strong>
                                      </span>
                                  @enderror
                                </div>
                                <div class="cust-form"> 
                                     <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="password" aria-label="password">

                                      @error('password')
                                          <span class="invalid-feedback" role="alert">
                                              <strong class="error">{{ $message }}</strong>
                                          </span>
                                      @enderror
                                </div>

                                <div class="cust-form">
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder="confirm password" aria-label="confirm password">
                                </div>
                                <div class="cta">
                                  <button onclick="return resetPassword()" type="submit" class="primary-button"> {{ __('reset password') }} </button>
                                </div>
                            </form>
                        </div>
                        <div class="bottom-detail">
                            <p>login? <span><a href="{{ url('login')}}">{{ __('Login') }}</a></span></p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>


<script>
function resetPassword() {

    toastr.options = {
        closeButton: true,
        progressBar: true,
        positionClass: "toast-top-right",
        timeOut: 3000
    };

    let email = $("#email").val().trim();
    let password = $("#password").val().trim();
    let confirmPassword = $("#password-confirm").val().trim();

    let emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

    toastr.clear();

    // Email validation
    if (email === "") {
        toastr.error("Email is required");
        $("#email").focus();
        return false;
    }

    if (!emailPattern.test(email)) {
        toastr.error("Enter a valid email address");
        $("#email").focus();
        return false;
    }

    // Password validation
    if (password === "") {
        toastr.error("Password is required");
        $("#password").focus();
        return false;
    }

    if (password.length < 8) {
        toastr.error("Password must be at least 8 characters");
        $("#password").focus();
        return false;
    }

    // Confirm password validation
    if (confirmPassword === "") {
        toastr.error("Confirm password is required");
        $("#password-confirm").focus();
        return false;
    }

    if (password !== confirmPassword) {
        toastr.error("Passwords do not match");
        $("#password-confirm").focus();
        return false;
    }

    // If validation passed → submit form
    $("#reset-password-form").submit();
}

</script>


@endsection

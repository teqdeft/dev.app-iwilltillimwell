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
									<img src="{{ asset('assets/frontend/assets/images/logo-v.png') }}" alt="web logo">
								</a>	
                            </div>
                            <div class="title">
                                <h1 class="web-t"></h1>
                            </div>
                        </div>
                        <form class="web-login cust-form" method="POST" action="{{ route('password.update') }}" id="user-login-form">
                        @csrf
                        <input type="hidden" name="token" value="{{ $token }}">
                            <div class="form-row">
                                <div class="col-100 form-group">
                                    <input class="form-control" type="text" name="email" id="email" placeholder="Email" value="{{ $email ?? old('email') }}">

                                @error('email')
                                      <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                  @enderror
                                </div>

                                <div class="col-100 form-group">
                                    <input class="form-control" type="password" name="password" id="password" placeholder="Password*">
                                    <button id="password_div" type="button" class="eye-icon" onclick="TogglePassword('password','password_div')">
                                        <img src="{{ asset('assets/frontend/assets/images/eye-open.svg') }}" alt="eye icon">
                                    </button>
                                
                                  @error('password')
                                      <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                  @enderror
                                </div>  
                                <div class="col-100 form-group">
                                    <input class="form-control" type="password" name="password_confirmation" id="password_confirmation" placeholder="Confirm password*">
                                    <button id="cpassword_div" type="button" class="eye-icon" onclick="TogglePassword('password_confirmation','cpassword_div')">
                                        <img src="{{ asset('assets/frontend/assets/images/eye-open.svg') }}" alt="eye icon">
                                    </button>
                                </div>

                               
                    
                                <div class="col-100 form-group cta">
                                    <button type="submit" class="custom-cta" onclick="return resetPassword()">Reset Password</button>
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
<script>
$('#password').on('keydown', function(event) {
    const maxLength = 20;
    if ($(this).val().length >= maxLength && event.key.length === 1 && !event.ctrlKey && !event.metaKey) {
        event.preventDefault();
        toastr.error("Maximum 20 characters allowed.");
    }
});
</script>



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
    let confirmPassword = $("#password_confirmation").val().trim();

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

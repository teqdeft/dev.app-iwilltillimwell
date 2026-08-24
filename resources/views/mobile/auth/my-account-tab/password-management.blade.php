<div id="password-management" class="tab-content">



                        <div class="midical-form v1 detail">



                            <div class="pha-res-pass">

                                <div class="pass-title app-heading">

                                    <p>Update your account password</p>

                                </div>

                                <form class="forms-sample" method="post" id="update-password-form"

                                action="{{ route('update-password') }}">

                                @csrf

                                <div class="form">

                                    <div class="form-row">

                                        <div class="col-100 form-group">

                                            <label>Old Password <span class="required-ico">*</span></label>

                                            <input class="form-control" type="password" name="current_password"

                                                placeholder="Your Old Password">

                                            @error('current_password')

                                            <span class="error" role="alert">{{ $message }}</span>

                                            @enderror

                                        </div>

                                        <div class="col-100 form-group">

                                            <label>New Password <span class="required-ico">*</span></label>

                                            <input class="form-control" type="password" name="password"  id="password"

                                                placeholder="Enter Your New Password">

                                                @error('password')

                                            <span class="error" role="alert">{{ $message }}</span>

                                            @enderror

                                        </div>

                                        <div class="col-100 form-group">

                                            <label>Confirm Password <span class="required-ico">*</span></label>

                                            <input class="form-control" type="password" name="password_confirmation"

                                                placeholder="Enter Your Confirm Password">

                                            @error('password_confirmation')

                                            <span class="error" role="alert">{{ $message }}</span>

                                            @enderror    

                                        </div>

                                        <div class="col-100 cta">

                                            <button type="submit" class="primary-button">Update</button>

                                            

                                        </div>

                                    </div>

                                </div>

            </form>

         </div>

    </div>

</div>

@push('scripts')

<script>
document.getElementById("update-password-form").addEventListener("submit", function(e) {

    let currentPassword = document.querySelector('input[name="current_password"]');
    let password = document.querySelector('input[name="password"]');
    let confirmPassword = document.querySelector('input[name="password_confirmation"]');

    // Remove old errors
    document.querySelectorAll(".custom-error").forEach(el => el.remove());

    let isValid = true;

    // Old Password Validation
    if (currentPassword.value.trim() === "") {
        showError(currentPassword, "Please enter old password");
        isValid = false;
    }

    // New Password Validation
    if (password.value.trim() === "") {
        showError(password, "Please enter new password");
        isValid = false;
    } else if (password.value.length < 6) {
        showError(password, "Password must be at least 6 characters");
        isValid = false;
    }

    // Confirm Password Validation
    if (confirmPassword.value.trim() === "") {
        showError(confirmPassword, "Please enter confirm password");
        isValid = false;
    } else if (confirmPassword.value !== password.value) {
        showError(confirmPassword, "Confirm password does not match");
        isValid = false;
    }

    if (!isValid) {
        e.preventDefault();
    }

});

// Show Error Function
function showError(input, message) {

    let error = document.createElement("span");
    error.className = "custom-error";
    error.style.color = "red";
    error.style.fontSize = "13px";
    error.innerText = message;

    input.parentNode.appendChild(error);
}
</script>

@endpush 
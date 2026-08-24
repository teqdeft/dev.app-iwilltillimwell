@php
$config = config('constants.modes');
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Login</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        .login-box {
            max-width: 600px;
            margin: 60px auto;
            padding: 25px;
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 8px 20px rgba(0,0,0,0.1);
        }
        .password-wrapper {
            position: relative;
        }
        .toggle-eye {
            position: absolute;
            top: 50%;
            right: 10px;
            transform: translateY(-50%);
            cursor: pointer;
            font-size: 18px;
            color: #555;
        }
    </style>
</head>
<body>

<div class="login-box">
    <h3 class="text-center mb-4">Login</h3>

   <form id="loginForm">
        
        <!-- Mode -->
        <div class="mb-3">
            <label class="form-label">Mode</label>
           <select class="form-select mb-3" id="mode" onchange="updateTable()">
                <option value="">Select Mode</option>
                <option value="sandbox">Sandbox</option>
                <option value="live">Live</option>
            </select>
        </div>

        <!-- Email -->
        <div class="mb-3">
            <label>Email</label>
            <input type="email" class="form-control" id="email">
        </div>

        
        <!-- Password Field -->
        <div class="mb-3 password-wrapper">
            <label>Password</label>
            <input type="password" class="form-control" id="password" placeholder="Enter password">
            
            <!-- Eye Icon -->
            <i class="bi bi-eye-slash toggle-eye" onclick="togglePassword()" id="eyeIcon"></i>
        </div>



        <!-- Button (optional now) -->
        <button type="submit" class="btn btn-primary w-100">Login</button>
        <div id="responseMsg"></div>
    </form>

    <!-- Result Table -->
    <div class="result-table" id="resultTable" style="display: none;">
        
           <table class="table table-bordered">
                <tr><th>Login URL</th><td id="loginUrl"></td></tr>
                <tr><th>API URL</th><td id="apiUrl"></td></tr>
                <tr><th>Email</th><td id="email_show"></td></tr>
                <tr><th>Password</th><td id="password_show"></td></tr>
            </table>


    </div>

    <div id="response_get"></div>

</div>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
function togglePassword() {
    let passwordInput = document.getElementById("password");
    let eyeIcon = document.getElementById("eyeIcon");

    if (passwordInput.type === "password") {
        passwordInput.type = "text";
        eyeIcon.classList.remove("bi-eye-slash");
        eyeIcon.classList.add("bi-eye");
    } else {
        passwordInput.type = "password";
        eyeIcon.classList.remove("bi-eye");
        eyeIcon.classList.add("bi-eye-slash");
    }
}
</script>

<script>
let configData = @json($config);

function updateTable() {
    let mode = document.getElementById("mode").value;
    console.log(configData[mode]);
    if(mode && configData[mode]) {
        document.getElementById("loginUrl").innerText = configData[mode].login_url;
        document.getElementById("apiUrl").innerText   = configData[mode].api_url;
        document.getElementById("email_show").innerText    = configData[mode].email;
        document.getElementById("password_show").innerText = configData[mode].password;


        document.getElementById("email").value    = configData[mode].email;
        document.getElementById("password").value    = configData[mode].password;

        document.getElementById("resultTable").style.display = "block";
    } else {
        document.getElementById("resultTable").style.display = "none";
    }
}
</script>


<script>
$("#loginForm").submit(function(e) {
    e.preventDefault();

    $("#responseMsg").html('<div class="alert alert-warning">Please wait....</div>');
        
    let formData = {
        mode: $("#mode").val(),
        email: $("#email").val(),
        password: $("#password").val(),
        _token: $('meta[name="csrf-token"]').attr('content')
    };

    $.ajax({
        url: "{{ route('lyric.login.post') }}",
        type: "POST",
        data: formData,
        success: function(res) {

            $("#response_get").html(res.response);
            $("#responseMsg").html('<div class="alert alert-success">'+res.message+'</div>');
            console.log(res.response);
            console.log("==================");
            
        },
        error: function(err) {
   
            $("#responseMsg").html('<div class="alert alert-danger">'+err.responseJSON.message+'</div>');
        }
    });
});
</script>
</body>
</html>


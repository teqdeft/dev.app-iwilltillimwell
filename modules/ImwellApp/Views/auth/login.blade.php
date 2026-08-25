{{--
    Organisation-branded sign in.

    Uses the SAME layout, markup and CSS classes as resources/views/auth/login.blade.php
    so it is visually identical to the real login screen. The only differences are
    the organisation logo, the organisation name, and the form action.
--}}
@extends('layouts.auth')
@section('content')
<section class="new-login-web">
    <div class="new-login-container">

        <div class="background-image">
            <a href="{{ url('/org/' . $org->slug) }}">
                <img src="{{ asset('assets/frontend/assets/images/login-image-updated.png') }}" alt="background image">
            </a>
        </div>

        <div class="login-form-web">
            <div class="lotin-card-web">
                <div class="card">

                    <div class="top-section">
                        <div class="logo">
                            <a href="{{ url('/org/' . $org->slug) }}">
                                <img class="logo"
                                     src="{{ $org->logoUrl() ?: asset(env('APP_LOGIN_MOBILE_BLACK')) }}"
                                     alt="{{ $org->name }} logo">
                            </a>
                        </div>
                        <div class="title">
                            <h1 class="web-t">{{ $org->name }}</h1>
                        </div>
                    </div>

                    <form class="web-login cust-form with-email-id" method="POST"
                          action="{{ route('imwell.org.login.post', $org->slug) }}" id="user-login-form">
                        @csrf
                        <div class="form-row">

                            <div class="col-100 form-group">
                                <input class="form-control" type="text" name="email"
                                       value="{{ old('email') }}" placeholder="Email">
                            </div>

                            <div class="col-100 form-group">
                                <input class="form-control" type="password" name="password"
                                       id="password" placeholder="Password">
                                <button id="togglePassword" type="button" class="eye-icon">
                                    <img src="{{ asset('assets/frontend/assets/images/eye-open.svg') }}" alt="eye icon">
                                </button>
                            </div>

                            <div class="col-100 form-group">
                                <a href="{{ url('password/reset') }}" class="forget-pwd">Forgot Your Password?</a>
                            </div>

                            @if($errors->any())
                                <div class="col-100 form-group error-feedback">
                                    <span class="invalid-feedback error" role="alert">
                                        {{ $errors->first() }}
                                    </span>
                                </div>
                            @endif

                            @if(session('error'))
                                <div class="col-100 form-group error-feedback">
                                    <span class="invalid-feedback error" role="alert">
                                        {{ session('error') }}
                                    </span>
                                </div>
                            @endif

                            @if(session('success'))
                                <div class="col-100 form-group">
                                    <span class="alert alert-success" role="alert">
                                        {{ session('success') }}
                                    </span>
                                </div>
                            @endif

                            <div class="col-100 form-group cta">
                                <button type="submit" class="custom-cta">Sign In</button>
                            </div>

                        </div>

                        <div class="dont-account">
                            <p>Not set your password yet? <span>Use the activation link emailed to you.</span></p>
                        </div>
                    </form>

                </div>
            </div>
        </div>

    </div>
</section>

<script>
    // Same show/hide password behaviour as the main login screen.
    (function () {
        var toggle = document.getElementById('togglePassword');
        var field  = document.getElementById('password');
        if (toggle && field) {
            toggle.addEventListener('click', function () {
                field.type = field.type === 'password' ? 'text' : 'password';
            });
        }
    })();
</script>
@endsection

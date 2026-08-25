{{-- Same markup/classes as the real login screen, so activation looks native. --}}
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
                            <img class="logo"
                                 src="{{ $org->logoUrl() ?: asset(env('APP_LOGIN_MOBILE_BLACK')) }}"
                                 alt="{{ $org->name }} logo">
                        </div>
                        <div class="title">
                            <h1 class="web-t">Welcome{{ $user ? ', ' . $user->fname : '' }}</h1>
                            <p>Set a password to activate your {{ $org->name }} account.</p>
                        </div>
                    </div>

                    <form class="web-login cust-form with-email-id" method="POST"
                          action="{{ route('imwell.org.activate.post', [$org->slug, $token]) }}">
                        @csrf
                        <div class="form-row">

                            <div class="col-100 form-group">
                                <input class="form-control" type="email"
                                       value="{{ $user->email ?? '' }}" readonly>
                            </div>

                            <div class="col-100 form-group">
                                <input class="form-control" type="password" name="password"
                                       id="password" placeholder="Create password (min 8 characters)">
                                <button id="togglePassword" type="button" class="eye-icon">
                                    <img src="{{ asset('assets/frontend/assets/images/eye-open.svg') }}" alt="eye icon">
                                </button>
                            </div>

                            <div class="col-100 form-group">
                                <input class="form-control" type="password" name="password_confirmation"
                                       placeholder="Confirm password">
                            </div>

                            @if($errors->any())
                                <div class="col-100 form-group error-feedback">
                                    <span class="invalid-feedback error" role="alert">
                                        {{ $errors->first() }}
                                    </span>
                                </div>
                            @endif

                            <div class="col-100 form-group cta">
                                <button type="submit" class="custom-cta">Activate My Account</button>
                            </div>

                        </div>

                        <div class="dont-account">
                            <p>This activation link can only be used once.</p>
                        </div>
                    </form>

                </div>
            </div>
        </div>

    </div>
</section>

<script>
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

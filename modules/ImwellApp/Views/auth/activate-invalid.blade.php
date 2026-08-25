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
                            <h1 class="web-t">This link is no longer valid</h1>
                            <p>Your activation link has expired or has already been used.</p>
                        </div>
                    </div>

                    <div class="web-login cust-form">
                        <div class="form-row">
                            <div class="col-100 form-group cta">
                                <a href="{{ route('imwell.org.login', $org->slug) }}" class="custom-cta"
                                   style="display:block;text-align:center;text-decoration:none">Go to Sign In</a>
                            </div>
                        </div>

                        <div class="dont-account">
                            <p>Not activated yet? Ask your {{ $org->name }} administrator to resend the invitation.</p>
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div>
</section>
@endsection

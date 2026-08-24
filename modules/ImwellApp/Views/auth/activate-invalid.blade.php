@extends('ImwellApp::auth.layout')
@section('title', 'Link expired - ' . $org->name)

@section('content')
    <h2>This link is no longer valid</h2>
    <p class="sub">
        Your activation link has either expired or has already been used.
    </p>

    <a href="{{ route('imwell.org.login', $org->slug) }}" class="btn"
       style="display:block;text-align:center;text-decoration:none">Go to sign in</a>

    <p class="muted">
        If you have not activated your account yet, please ask your
        {{ $org->name }} administrator to resend the invitation.
    </p>

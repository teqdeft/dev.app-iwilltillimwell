@extends('ImwellApp::auth.layout')
@section('title', 'Activate your account - ' . $org->name)

@section('content')
    <h2>Welcome{{ $user ? ', ' . $user->fname : '' }}</h2>
    <p class="sub">Choose a password to activate your {{ $org->name }} account.</p>

    <form method="POST" action="{{ route('imwell.org.activate.post', [$org->slug, $token]) }}">
        @csrf

        <div class="field">
            <label>Email address</label>
            <input type="email" value="{{ $user->email ?? '' }}" disabled>
        </div>

        <div class="field">
            <label for="password">Create password</label>
            <input type="password" name="password" id="password" required
                   autocomplete="new-password" autofocus>
            <div class="hint">At least 8 characters.</div>
        </div>

        <div class="field">
            <label for="password_confirmation">Confirm password</label>
            <input type="password" name="password_confirmation" id="password_confirmation"
                   required autocomplete="new-password">
        </div>

        <button type="submit" class="btn">Activate my account</button>
    </form>

    <p class="muted">This activation link can only be used once.</p>

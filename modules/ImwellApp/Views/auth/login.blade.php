@extends('ImwellApp::auth.layout')
@section('title', 'Sign in - ' . $org->name)

@section('content')
    <h2>Sign in</h2>
    <p class="sub">Use the email address your organization registered for you.</p>

    <form method="POST" action="{{ route('imwell.org.login.post', $org->slug) }}">
        @csrf

        <div class="field">
            <label for="email">Email address</label>
            <input type="email" name="email" id="email" value="{{ old('email') }}"
                   required autofocus autocomplete="username">
        </div>

        <div class="field">
            <label for="password">Password</label>
            <input type="password" name="password" id="password" required autocomplete="current-password">
        </div>

        <label class="remember">
            <input type="checkbox" name="remember" value="1"> Keep me signed in
        </label>

        <button type="submit" class="btn">Sign in</button>
    </form>

    <p class="muted">
        Haven't set a password yet? Use the activation link emailed to you by
        {{ $org->name }}.
    </p>

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
                            @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif
                            <form method="POST" action="{{ route('password.email') }}" id="forgot-password-email-form">
                                @csrf
                                <div class="cust-form"> 
                                  <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Email" aria-label="Email" autofocus>

                                          @error('email')
                                              <span class="invalid-feedback" role="alert">
                                                  <strong class="error">{{ $message }}</strong>
                                              </span>
                                          @enderror
                                </div>
                                <div class="cta">
                                  <button type="submit" class="primary-button"> {{ __('reset password') }} </button>
                                </div>
                            </form>
                        </div>
                        <div class="bottom-detail">
                            <p>already a member? <span><a href="{{ url('login')}}">{{ __('Login') }}</a></span></p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

@endsection

@extends('layouts.services')
@section('content')
<style>
    .main-content-wrapper .content-container .content-right{
        width:100%;
        height:100vh;
    }
</style>
<section class="main-content-wrapper">
    <div class="content-container inner-form-box">
        <div class="content-right">
            <div class="content-inner login-sec">
                <div class="login-cont bg-white">
                    <div class="login-top">
                        <h2>LOGIN</h2>
                        <h3>Welcome back to imwell</h3>
                    </div>
                    <div class="login-form">
                        <form method="POST" action="{{ route('login') }}" id="user-login-form">
                            @csrf
                            <div class="form-group">
                                <label for="email">Email / Username</label>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                    name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                <input type='hidden' name='mood' value='1'>
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="pwd">Password</label>
                                <!-- <label for="pwd" style="text-align: right; float: right; color:#719642;"><a
                                        href="{{ url('password/reset') }}">Forgot Your Password?</a></label> -->

                                <input id="password" type="password"
                                    class="form-control @error('password') is-invalid @enderror" name="password"
                                    required autocomplete="current-password">

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
</section>
@endsection
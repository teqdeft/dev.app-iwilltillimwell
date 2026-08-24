@extends("mobile.layouts.default")
@section("content")
<div class="app-main">
    <section class="launch-screen">
        <div class="logo-main">
            
            <img class="light-logo" src="{{ asset('mobile-images/IWTIWLogo-new-black.svg') }}" alt="logo" />
            <img class="dark-logo"  src="{{ asset('mobile-images/sg-iwilltilimwell-v-app.svg') }}"  alt="logo" />
        </div>
    </section>
</div>
<script>
setTimeout(function () {
        window.location.href='{{ url("login") }}';
    }, 1000);
</script>
@endsection
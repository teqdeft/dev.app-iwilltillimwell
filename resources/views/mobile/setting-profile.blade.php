@extends("mobile.layouts.default")
@section("content")
<div class="app-main">
    <section class="edit-prof-hea">
        <div class="cust-container">
            <div class="profile-navbar">
                <div class="back-btn">
                    <a href="/mobile-dashboard" onclick="show_tabs(2)" class="back-main"><img src="{{ asset('mobile-images/back-arrow-for-darktheme.svg') }}" alt="back" /></a>
                </div>
                <div class="toggle-btn">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </div>

            <!-- hide bar -->
            <ul class="nav-menu">
                <li><a href="#">Home</a></li>
                <li><a href="#">About</a></li>
                <li><a href="#">Services</a></li>
                <li><a href="#">Contact</a></li>
            </ul>
            <!-- hide bar -->

            <div class="get-started">
                <h5 class="heading-h5">Edit Profile</h5>
            </div>

        </div>
    </section>

    <section class="change-e-address mt-5">
        <div class="change-v1">
            <div class="change-row">
                <div class="icon">
                    <img src="{{ asset('mobile-images/change_email.svg') }}" alt="icon"/>
                </div>
                <h6 class="heading-h6">Change Email Address</h6>
            </div>
            <div class="change-row">
                <div class="icon">
                    <img src="{{ asset('mobile-images/change-password.svg') }}" alt="icon"/>
                </div>
                <h6 class="heading-h6">Change Password</h6>
            </div>
            <div class="change-row">
                <div class="icon">
                    <img src="{{ asset('mobile-images/social-media-ac.svg') }}" alt="icon"/>
                </div>
                <h6 class="heading-h6">Social Media Accounts</h6>
            </div>
        </div>
    </section>

    <section class="reset-app">
        <div class="cust-container">
            <div class="cta">
                <a href="javascript:void(0);" class="primary-button">Reset In-App Purchases</a>
            </div>
        </div>
    </section>

    <section class="change-e-address">
        <div class="change-v1">
            <div class="change-row">
                <div class="icon">
                    <img src="{{ asset('mobile-images/eye-off-icon.svg') }}" alt="icon"/>
                </div>
                <h6 class="heading-h6">Additional Hubs</h6>
                <div class="toggle cust-toggle">
                    <!-- Toggle Switch -->
                    <label class="toggle-switch">
                        <input type="checkbox">
                        <span class="slider"></span>
                    </label>
                </div>
            </div>
            <div class="change-row">
                <div class="icon">
                    <img src="{{ asset('mobile-images/notification-icon.svg') }}" alt="icon"/>
                </div>
                <h6 class="heading-h6">Notifications</h6>
            </div>
        </div>
    </section>


    <section class="reset-app-cta">
        <div class="cust-container">
            <div class="support">
                <a href="javascript:void(0);" class="primary-button">Support</a>
            </div>
            <div class="log-out">
                <a href="{{route('logout')}}" class="primary-button">Log Out</a>
            </div>
        </div>
    </section>

</div>

@endsection
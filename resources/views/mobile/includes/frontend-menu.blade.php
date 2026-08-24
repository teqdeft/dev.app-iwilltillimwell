<section class="edit-prof-hea">
    <div class="cust-container">
        <div class="profile-navbar">
            <div class="back-btn">
             
                @isset($back_url) 
                    <a href="{{ route($back_url)}}" class="back-main">

                @else
                    <a href="{{ url('/')}}" class="back-main">
                @endif

                
                    <img src="{{ asset('mobile-images/back-arrow-for-darktheme.svg') }}" alt="back" />
                </a>
            </div>
            <div class="toggle-btn">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div>
        <!-- hide bar -->
        <ul class="nav-menu">
            <li><a href="/">Home</a></li>
        </ul>
        <!-- hide bar -->
        <div class="get-started">
            <h5 class="heading-h5">{{$heading}}</h5>
        </div>
    </div>
</section>
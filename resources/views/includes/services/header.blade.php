<meta name="csrf-token" content="{{ csrf_token() }}" id="csrf-token">
<header>
    <div class="new-container">
        <div class="header-inner">
            <div class="logo">
                <a href="#"><img src="{{ asset($company['compnay-details']['image']??'/') }}" alt="logo"></a>
            </div>
            <div class="header-right">
                <ul>
                    <li>
                        <div id="google_translate_element" class="mr-15"></div>
                    </li>
                    <li class="support-line"><img src="{{ asset('assets/services/images/support-line-img.png') }}" alt="24by7"></li>
                    @if (isset(Auth::user()->id))
                    @auth
                    <li>
                        <div class="dropdown-overlay"></div>
                        <div class="col-md-4">
                            <div class="dropdown servicesDropdown">
                            <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                {{ Auth::user()->name }}
                                <span class="caret"></span>
                            </button>
                            <div class="dropdown-menu default-menu" aria-labelledby="dropdownMenu1">
                                <a  href="{{ url('feels/dashboard') }}" class="">
                                    Dashboard<i class="fas fa-tachometer-alt"></i>
                                </a>
                                <a  href="{{ url('feels/user-mood') }}" class="">Mood</a>
                                <a href="{{ route('feels/logout') }}" class="">
                                    {{ __('Logout') }} <i class="fas fa-sign-out-alt"></i>
                                </a>
                            </div>
                            </div>
                        </div>
                    </li>
                    @endauth
                    @else
                    <li><a href="{{ url('services-login') }}" class="login">Login</a></li>
                    @endif
                    <li class="openMainuOuter"><a class="openMainu" onclick="openNav()">&#9776;</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="main-menu" id="myNav">
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
        <div class="new-container">
            <ul>
                <li><a href="#mentalhealthwellness">Mental Health Wellness</a></li>
                <!-- <li><a href="#medicalcare">Medical Care</a></li>
                <li><a href="#physicalwellness">Physical Wellness</a></li>
                <li><a href="#financialwellness">Financial Wellness</a></li> -->
            </ul>
        </div>
    </div>
</header>
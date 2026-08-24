@extends('layouts.default')

@section('content')
    <script type="text/javascript" src="https://js.stripe.com/v3/"></script>
    <script src="https://www.google.com/recaptcha/api.js"></script>


    <div class="landing-wrap-dbl">
        <section class="landing-sec">
            <div class="new-container">
                <div class="landing-wrap">
                    <div class="left-wrap">
                        <?php //dd(session()->all()); ?>
                        <h1 class="landing-title">AWMI Family Wellness</h1>
                    </div>
                    <div class="landing-page-img">
                        <img src="{{asset('/uploads/pageFiles/landing-img1.png')}}" alt="cold">
                    </div>
                </div>
            </div>
        </section>
        <section class="wellness-sec">
            <div class="new-container">
                <div class="well-content">
                    <div class="top-tilte">
                        <h3 class="title-h3">Your Wellness Partnership</h3>
                    </div>
                    <div class="wellness-inn">
                        <div class="wellness-left">
                            <div class="logo-1">
                                <a href="javascript:void(0)"><img src="{{asset('/uploads/pageFiles/logo-3.png')}}" alt="logo"></a>
                            </div>
                        </div>
                        <div class="wellness-right">
                            <div class="logo-2">
                                <a href="javascript:void(0)"><img src="{{asset('/uploads/pageFiles/imwel-logo.png')}}" alt="imwel-logo"></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="awmi_register-sec">
            <div class="new-container">
                <div class="register-inn">
                    <div class="register-left">
                        <div class="register-content">
                            <h4>iWILL 'til i'mWELL has partnered with AWMI to offer you
                                and your family premiere services that are designed to
                                meet your medical and mental health needs.</h4>
                            <h5><span>24X7 Communication</span> with Licensed <span>Physicians & Mental</span>
                                <span>Health Specialists</span> in English and Spanish.
                            </h5>
                            <h5>The highest quality care for your body, mind, and soul is
                                offered at a <span>flexible affordable value.</span></h5>
                            <div class="benefits-title">
                                <h3 class="title-h3">Benefits to you and Your Family</h3>
                            </div>
                            <div class="reg-list">
                                <ul>
                                    <li>Your one-stop gateway to manage your
                                        personal health</li>
                                    <li>Protecting mental health for you and your
                                        family</li>
                                    <li>Virtually communicate with a U.S.- based,
                                        licensed Physician</li>
                                </ul>
                            </div>
                        </div>

                        <div class="register-logos">
                            <div class="logos-inn">
                                <div class="logos-left">
                                    <div class="logo-img">
                                        <img src="{{asset('/uploads/pageFiles/barma-logo.png')}}" alt="barma-logo">
                                    </div>
                                </div>
                                <div class="logos-right">
                                    <div class="logo-img"> <img src="{{asset('/uploads/pageFiles/counseling-logo2.png')}}" alt="nami-logo"></div>
                                </div>
                            </div>
                            <div class="bottom-logo">
                                <img src="{{asset('/uploads/pageFiles/counceling-logo1.png')}}" alt="counceling-logo">
                            </div>
                        </div>
                    </div>
                    
                    

                    <div class="register-right">
                        <div class="content-rgt">
                            <div class="title-dbl">
                                <h2>REGISTER</h2>
                            </div>
                            <div class="subtitle">
                                <h3>Register for Telemedicine</h3>
                            </div>
                            
                            

                            <form action="awmi-store" autocomplete="off" id="awmi-store"
                                method="post">
                                @csrf

                                <div class="register-right-top">

                                    <div class="register-form cust-from-wrap">
                                        <div class="form-group">
                                            <label for="text">First Name*</label>
                                            <input type="text" class="form-control" id="fname" placeholder=""
                                                name="fname">
                                        </div>
                                        <div class="form-group">
                                            <label for="text">Last Name*</label>
                                            <input type="text" class="form-control" id="lname" placeholder=""
                                                name="lname">
                                        </div>
                                        <div class="form-group">
                                            <label for="email">E-mail Address*</label>
                                            <div class="emailFieldContainer position-relative">
                                                <input type="email" class="form-control" id="emailsec" placeholder=""
                                                    name="email">
                                                <div class="spinner-border position-absolute register-spin d-none"
                                                    role="status">
                                                    <span class="sr-only">Loading...</span>
                                                </div>
                                                <div class="position-absolute register-spin register-triangle d-none">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                        fill="currentColor" class="bi bi-exclamation-triangle-fill"
                                                        viewBox="0 0 16 16">
                                                        <path
                                                            d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
                                                    </svg>
                                                </div>
                                                <div class="position-absolute register-spin register-check d-none">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                        fill="currentColor" class="bi bi-check-circle-fill"
                                                        viewBox="0 0 16 16">
                                                        <path
                                                            d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
                                                    </svg>
                                                </div>

                                            </div>

                                            @if (\Session::has('error'))
                                            <div class="awmi_error alert alert-danger">
                                                <ul>
                                                    <li>{!! \Session::get('error') !!}</li>
                                                </ul>
                                            </div>
                                            @endif


                                            {{--   <div class="set-error error" style="display: none;"></div>
                                        <div id="access-code-div" style="display: none;">
                                            <label for="access-code">Please Enter code send to you email*</label>
                                            <input type="password" class="form-control" id="access-code" placeholder=""
                                                name="access_code">

                                        </div> --}}
                                        </div>



                                        <div class="form-group">
                                            <label for="phone">phone*</label>
                                            <input type="number" class="form-control" id="phone" placeholder=""
                                                name="primaryPhone">
                                        </div>
                                        <div class="form-group">
                                            <label for="text">Date of Birth*</label>
                                            <div class="dob-cal-box">
                                                <input  class="form-control datePickerMonthYear" name="dob"
                                                    required="required" autocomplete="off" placeholder="mm / dd / yyyy"
                                                    onkeydown="event.preventDefault()" readonly />
                                                <i class="far fa-calendar-alt date-icon"></i>
                                            </div>

                                        </div>
                                        <div class="form-group mac-res">
                                            <label for="text">Gender*</label>
                                            <div class="d-flex align-items-center ch-53 register-checkbox">
                                                <div class="form-check mr-5">
                                                    <label class="form-check-label">
                                                        <input type="radio" class="form-check-input" name="gender"
                                                            id="optionsRadios1" value="m">
                                                        Male
                                                        <i class="input-helper"></i></label>
                                                </div>
                                                <div class="form-check mr-5">
                                                    <label class="form-check-label">
                                                        <input type="radio" class="form-check-input " name="gender"
                                                            id="optionsRadios1" value="f">
                                                        Female
                                                        <i class="input-helper"></i></label>
                                                </div>
                                                <div class="form-check ">
                                                    <label class="form-check-label">
                                                        <input type="radio" class="form-check-input" name="gender"
                                                            id="optionsRadios1" value="other">
                                                        Prefer not to say
                                                        <i class="input-helper"></i></label>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="form-group w-100">
                                            <label for="stateid">Timezone*</label>
                                            <select class="form-control" name="timezoneId">
                                                <option value="">Select your timezone</option>
                                                @foreach ($timezones as $timezone)
                                                    <option value="{{ $timezone->id }}">{{ $timezone->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="pwd">Password*</label>
                                            <input type="password" autocomplete="new-password" class="form-control"
                                                id="password" placeholder="" name="password">
                                        </div>
                                        <div class="form-group ">
                                            <label for="pwd2">confirm password*</label>
                                            <input type="password" class="form-control" id="pwd2" placeholder=""
                                                name="password_confirmation">
                                        </div>
                                    </div>

                                    <div class="register-meter_container form-group cust-pas-wrap" style="display:none">
                                        <div class="password-strength_cal slide-wrap">
                                            <span>Password strength <span id="calcuate-password-per">0%</span></span>
                                            <span class="password-slide"></span>
                                            <span class="password-slide-strong" id="password-slide-strong"></span>
                                        </div>
                                        <ul>
                                            @foreach (config('constants.meterContant') as $key => $item)
                                                <li id="{{ $key }}">
                                                    <span class="wrongIcon">
                                                        <svg xmlns="http://www.w3.org/2000/svg" style="color: red"
                                                            width="16" height="16" fill="currentColor"
                                                            class="bi bi-x-circle" viewBox="0 0 16 16">
                                                            <path
                                                                d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                                            <path
                                                                d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z" />
                                                        </svg>
                                                    </span>
                                                    {{ $item }}
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>

                                    <div class="row align-items-center">
                                        <div class="col-md-6">
                                            <div class="form-group capcha-outer">
                                                <div class="pull-center">
                                                    <div class="g-recaptcha"
                                                        data-sitekey="6LdXPRwmAAAAAFc0owHc4gjQ2-CYwOZ3qp655TYS"
                                                        data-secretkey="6LejviAmAAAAAD2kOiPpMu9VggAqXHJh_iaqnPH3">
                                                    </div>
                                                    <input type="hidden" class="hiddenRecaptcha required"
                                                        name="hiddenRecaptcha" id="hiddenRecaptcha">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="register-right-bottom">
                                                <input type="submit" class="custom-button mr-0" name="submit"
                                                    value="Submit">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </form>

                    </div>
                </div>
            </div>

        </section>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>

    <script>
        $(function () {
            $("#datepicker").datepicker();
        });
    </script>


@endsection

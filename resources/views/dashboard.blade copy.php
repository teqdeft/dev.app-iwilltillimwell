@extends('layouts.dashboard')
@section('content')
<div class="main-panel main-panel-for-modal-page">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12 grid-margin">
                <div class="row">
                    <div class="col-12 col-xl-6 mb-4 mb-xl-0">
                        <h3 class="font-weight-bold">Member Dashboard</h3>
                        <h6 class="font-weight-normal mb-0">Your Personalized Health Portal</h6>
                    </div>
                    <div class="col-12 col-xl-6 mb-4 mb-xl-0">
                        <div class="template-demo d-flex justify-content-end">
                            <a href="{{ url('consultation-type') }}" class="btn btn-primary btn-icon-text theme-mt-0 fs-18">
                                <i class="fas fa-user-md mr-2"></i>
                                Schedule a consultation now!
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12 d-flex align-items-stretch">
                <div class="row">
                    <div class="col-md-12 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <div class="health-summary-box mb-4">
                                    <h4 class="card-title">Health Summary</h4>
                                    <p>
                                        Your Member Health Portal allows you to be healthier, with educational and interactive health management, risk assessment and decision support tools. These items will help you take better care of yourself, promote prevention, and have a healthier lifestyle.
                                        Your Member Health Portal helps you to understand your medical issues, evaluate symptoms, assess risks, and to initiate action that will decrease those risks.
                                     </p>
                                    <p>
                                       Here, you can get instant access to the Member Console - your one-stop gateway to manage your personal health, share important medical records with your Primary Care Physician, and virtually communicate with a U.S.- based, licensed Physician.
                                    </p>
                                </div>
                                <h5 class="card-title">Portal Features</h5>
                                <ol>
                                    <li>Secure Messaging</li>
                                    <li>
                                        Schedule Center
                                        <ul>
                                            <li>Consultation History</li>
                                            <li>Message a Doctor</li>
                                        </ul>
                                    </li>
                                    <li>Manage Personal Medical Records</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>




        <div class="quick-link-box">
            <div class="row">
                <div class="col-12 mb-4">
                    <h3 class="font-weight-bold"><i class="far fa-hand-point-right"></i> Quick Links</h3>
                </div>
                <div class="col-md-6 col-xl-3 mb-4 stretch-card transparent">
                    <div class="card card-tale">
                        <a href="{{ url('personal-record') }}">
                            <div class="card-body text-white">
                                <p class="fs-30 mb-4"><i class="fas fa-user-shield"></i></p>
                                <p class="fs-20">Personal Heath Record</p>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-md-6 col-xl-3 mb-4 stretch-card transparent">
                    <div class="card card-dark-blue">
                        <a href="{{ url('medications') }}">
                            <div class="card-body text-white">
                                <p class="fs-30 mb-4"><i class="fas fa-pills"></i></p>
                                <p class="fs-20">Medications</p>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-md-6 col-xl-3 mb-4 stretch-card transparent">
                    <div class="card card-light-blue">
                        <a href="{{ url('medication-allergies') }}">
                            <div class="card-body text-white">
                                <p class="fs-30 mb-4"><i class="fas fa-head-side-cough"></i></p>
                                <p class="fs-20">Medication Allergies</p>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-md-6 col-xl-3 mb-4 stretch-card transparent">
                    <div class="card card-light-danger">
                        <a href="{{ url('medical-history') }}">
                            <div class="card-body text-white">
                                <p class="fs-30 mb-4"><i class="fas fa-hospital-user"></i></p>
                                <p class="fs-20">Medical Conditions</p>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- update modal  start-->
    <div class="modal fade" id="updatemodal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog  modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header theme-bg-color">
                    <h3 class="card-title mb-0">Update Documentt</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="main-content-box">
                        <div class="row">
                            <div class="col-12 grid-margin stretch-card mb-0">
                                <div class="card">
                                    <div class="card-body personal-info-card-box ">
                                        <h4 class="card-title">Attach Photos, Lab Results, X-Rays, or any medically
                                            relevant documents (if any)</h4>
                                        <form class="forms-sample">
                                            <div class=" row">
                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <div class="">

                                                        </div>
                                                        <label>File upload (Upload jpg,pdf,gif,pdf files only) </label>
                                                        <input type="file" name="img[]" class="file-upload-default">
                                                        <div class="input-group col-xs-12">
                                                            <input type="text" class="form-control file-upload-info" disabled="" placeholder="Upload Image">
                                                            <span class="input-group-append">
                                                                <button class="file-upload-browse btn btn-primary" type="button">Upload</button>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary">Save Attachment</button>
                </div>
            </div>
        </div>
    </div>
    <!-- update modal  start-->
    <div class="modal fade" id="dashboard-popup" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl-cus" role="document">
            <div class="modal-content">
                <div class="modal-header theme-bg-color">
                    <h3 class="card-title mb-0 text-capitalize">Complete details</h3>
                    @if(Session::has('error'))
                        <p class="alert alert-danger">{{ Session::get('error') }}</p>
                    @endif
                    <!-- <a  class="close" href="{{ route('logout') }}" title="Logout"><i class="fas fa-sign-out-alt"></i> </a> -->
                </div>
                <div class="modal-body modal-table-body">
                    <center>
                        <h3 id="res-msg"></h3>
                    </center>
                    <div class="promo-code-sec">
                        <div class="register-right" id="step2" style='{{ (Auth::user()->step_position == 2) ? "display: block;" : "display: none;" }}'>
                            <div class="inner-promo-code-sec">
                                <!-- <h4 class="mb-4"><i class="fas fa-tags"></i> Have a promocode?</h4> -->
                                <!-- <div class="wrapper">
                                    <div class="promo-code-apply-form" name="promo-code-apply-form" id="promo-code-apply-form">
                                        <div class="from-group">
                                            <input type="text" placeholder="Enter promocode...." name="code" id="inputPromoCode" class="promo-text" />
                                            <button class="promo-code-apply-btn">Apply</button>
                                            <span class="promo-error" style="display:none">Please fill your promo
                                                code</span>
                                        </div>
                                    </div>
                                </div> -->
                            </div>
                            <div class="register-right-top">

                                <!-- <div class="register-form ">
                                    <form action="{{ route('updateStep') }}" id="sign-up2-form">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="next_step" value="3">
                                        <input type="hidden" name="current_step" value="2">
                                        <input type="hidden" name="promo_code_id" value="">
                                        <h4 class="mb-3 plan-title">
                                            Our Plans<span class="fs-25 theme-color promo-code-applied-text" style="display:none"> (Promo
                                                Code Applied)</span></h4>
                                        <div class="plan_sub_tabs">

                                            <div class="menu-list-cus">
                                                @if($monthPlan)
                                                <ul class="nav nav-tabs mb-0" role="tablist">
                                                    @php $i = 1; @endphp
                                                    @foreach($monthPlan as $key => $value)
                                                    <li class="nav-item">
                                                        <a class="nav-link {{ ($i == 1 )?'active':''; }} monthPlan " mpName="{{ $key }}" data-toggle="tab" href="#tabs-{{$key}}" role="tab">
                                                            {{ $value['month'] }}
                                                        </a>
                                                    </li>
                                                    @php $i++; @endphp
                                                    @endforeach
                                                    @endif
                                                </ul>
                                                @if($monthPlan)
                                                <div class="tab-content pb-0">
                                                    @php $i = 1; @endphp
                                                    @foreach($monthPlan as $key => $value)
                                                    <div class="tab-pane {{ ($i == 1)?'active':''; }}" id="tabs-{{ $key }}" role="tabpanel">
                                                        <ul class="nav nav-tabs sub-tabs">
                                                            @php $j = 1; @endphp
                                                            @foreach($value['plans'] as $planKey => $planValue)
                                                            <li class="nav-item userPlanType">
                                                                <a class="nav-link {{ ($j == 1)?'active':''; }}" data-toggle="tab" href="#plans-{{ $key }}-{{$planKey}}" role="tab">
                                                                    {{ $planValue }}
                                                                </a>
                                                            </li>
                                                            @php $j++; @endphp
                                                            @endforeach
                                                        </ul>
                                                    </div>
                                                    @php $i++; @endphp
                                                    @endforeach
                                                </div>
                                                @endif
                                            </div>


                                            @if($monthPlan)
                                            <div class="tab-content">
                                                <input type="hidden" name="select_plan" class="user-plans" id="self-counseling" data-id="">
                                                @php $i = 1; @endphp
                                                @foreach($monthPlan as $monthKey => $monthValue)

                                                @foreach($monthValue['plans'] as $priceKey => $priceValue)
                                                <div class="tab-pane allUserPlan" id="plans-{{ $monthKey }}-{{$priceKey}}" role="tabpanel" style="display:{{ ($i == 1)?'block':'none'; }}">
                                                    <div class="plan-heading">
                                                        <h4>{{ ucfirst($monthValue['price'][$priceKey][1]['name']??'N/A') }}</h4>
                                                    </div>
                                                    <div class=" layer plans">
                                                        <div class="inner_plan_cont">
                                                            @for($members = 1;$members <= count($monthValue['members']); $members++) @if( isset($monthValue['price'][$priceKey][$members]['id']) ) <div class="heading_title_cont">

                                                        </div>
                                                        <div class="third lift plan-tier">
                                                            <div class="heading_title_cont">

                                                                <h4>{{ $monthValue['members'][$members] }}</h4>

                                                            </div>
                                                            <h5><sup class="superscript">$</sup>
                                                                <span class="plan-price stripe-amount" data-amount="{{ $monthValue['price'][$priceKey][$members]['amount'] }}">{{ $monthValue['price'][$priceKey][$members]['amount'] }}
                                                                </span><sub>/ {{ $monthValue['price'][$priceKey][$members]['totalMonth'] }} mo</sub>
                                                            </h5>
                                                            <div class="planDescription">
                                                                {!! html_entity_decode($monthValue['price'][$priceKey][$members]['description']) !!}
                                                            </div>
                                                            <button class="but_text selectPlan" upgradePlanSelect="false" planId="{{ $monthValue['price'][$priceKey][$members]['id'] }}" data-id="{{ $monthValue['price'][$priceKey]['plan_type'][$members]['id']??'' }}">Get started</button>
                                                        </div>
                                                        @endif
                                                        @endfor
                                                    </div>
                                                </div>
                                            </div>
                                            @php $i++; @endphp
                                            @endforeach
                                            @endforeach
                                        </div>
                                        @endif
                                </div> -->
                            <!-- </div> -->
                            <!-- <div class="modal-footer">
                                    <div class="register-right-bottom register-button">
                                        <input type="submit" name="" class="custom-button btn btn-primary"
                                            id="selectPlan" value="Next" style="float: right;">
                                    </div>
                                </div> -->
                            <!-- </form> -->
                        <!-- </div> -->




                        <section class="imwell-wraper">
        <div class="new-container">
            <div class="imwell-inn">
                <div class="top-content">
                    <div class="im-title">
                        <h3 class="im-title-h3">Thank you for registering Kulwant. It's times to select your Member
                            Program Plan!</h3>
                    </div>
                    <div class="sub-title">
                        <p>Ou programs are designed to help to help you and yuor loved ones through thi ver challenging
                            times. Stand up and take your fighful place in the univese. Don't
                            put others in charge of who you want to ve in thi life. Put yourself in charge and say "I
                            WILL
                            ge the help that I need until I am WELL " It all
                            starts with you. Its's YOUR CHOICE!
                        </p>
                    </div>
                </div>

                <div class="cust-row">
                    <div class="cust-coll-9">
                        <div class="left-top">

                            <div class="input-form">
                                <div class="input-here"> 
                                    <input type="text" name="Enter promocode...." placeholder="Enter promocode...." class="form-control"></div>
                                <div class="apply-btn">
                                    <button type="submit" class="promo-code-apply-btn theme-btn">Apply</button>
                                </div>
                            </div>

                            <!-- <div class="select-buttons">
                                <div class="select-buttons-inn">
                                    <a href="javascript:void(0)" class="self-btn">SELF</a>
                                    <a href="javascript:void(0)" class="self-btn-2">SELF+FAMILY</a>
                                </div>
                            </div> -->

                        </div>


                        @if ( $memberType )
             <ul class="nav nav-pills mb-3 select-buttons-inn" id="pills-tab" role="tablist">
                @foreach ($memberType as $key => $value )
                    <li class="nav-item " role="presentation">
                        <a class="nav-link self-btn @if ( $key == 1 ) active @endif" id="pills-home-tab" data-toggle="pill" href="#pills-{{ $key }}" 
                        role="tab" aria-controls="pills-{{ $key }}" aria-selected="true">{{ $value }}</a>
                    </li>
                @endforeach
              </ul>    
              
              @if ( $monthPlanDouble )
                <div class="tab-content" id="pills-tabContent">
                  @foreach ($monthPlanDouble as $key => $value )
                    <div class="tab-pane fade  @if ($key == 1) show active @endif" id="pills-{{ $key }}" role="tabpanel" aria-labelledby="pills-{{ $key }}-tab">
                      <div class="pricing-plans-outer">
                        <div class="pricing-plans pricing-plans-top d-flex  my-auto">
                            <div class="dbl_list">
                          <div class="plan options">
                            <div class="plan-info">
                              <div class="plan-header gray">
                                <div class="plan-header-in">
                                  <h3>
                                  </h3>
                                </div>
                              </div>
                            </div>
                          </div>

                          <div class="price-list-inn">
                            @foreach ($value as $dataKey => $dataValue )
                                <div class="plan plan-basic">
                                    <div class="plan-header gray">
                                    <div class="plan-header-in">
                                        <h3>
                                        <span class="label">{{ $dataValue['type'] }}</span>
                                        <div class="figure">
                                            <span class="amount">{{ $dataValue['amount'] }}</span>
                                        </div>
                                        </h3>
                                        <div class="button"><a href="{{ url('register') }}" class="btn btn-sm btn-secondary self-btn">Select</a></div>
                                    </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        </div>

                          <div class="pricing-plans pricing-plans-bottom d-flex  my-auto">
                            <div class="plan options">
                              <div class="plan-info">
                                <ul class="list-group first text-right">
                                  @foreach ($value as $dataKey => $dataValue )
                                    <li class="list-group-item"> {{ $dataValue['name'] }} </li>
                                  @endforeach
                                </ul>
                              </div>
                            </div>
                            @for ($i = 1; $i <= 4;$i++)
                              <div class="plan plan-basic">
                                <div class="plan-info">
                                  <ul class="list-group">
                                    @for ($j = 1; $j <= 4;$j++)
                                    @php  $iconType = "times"; $iconColor = 'danger';  @endphp
                                    @if($i <= 4 && $j == 1 )
                                        @php $iconType = "check"; $iconColor = 'success'; @endphp
                                      @elseif( $j == 2 && ( $i == 2 || $i == 4 ) )
                                        @php $iconType = "check"; $iconColor = 'success'; @endphp
                                      @elseif( $i >= 3 && $j == 3 )
                                        @php $iconType = "check"; $iconColor = 'success'; @endphp
                                      @elseif( $i == 4 && $j == 4 )
                                        @php $iconType = "check"; $iconColor = 'success'; @endphp
                                      @endif
                                      <li class="list-group-item"><i class="fas fa-{{ $iconType }} text- fa-lg"></i></li>
                                    @endfor
                                  </ul>
                                </div>
                              </div>  
                            @endfor
                        </div>
                      </div>
                    </div>
                  </div>
                  @endforeach
                </div>
                @endif
                @endif


                        <!-- <div class="left-bottom">
                            <div class="price-list">
                                <div class="price-list-inn">
                                    <div class="price-coll">
                                        <div class="price-info">
                                            <h6 class="price-title">Basic</h6>
                                            <h3 class="price-rs">$35.99</h3>
                                            <a href="javascript:void(0)" class="self-btn">select</a>
                                        </div>
                                    </div>
                                    <div class="price-coll">
                                        <div class="price-info">
                                            <h6 class="price-title">Standard</h6>
                                            <h3 class="price-rs">$49.99</h3>
                                            <a href="javascript:void(0)" class="self-btn">select</a>
                                        </div>
                                    </div>
                                    <div class="price-coll">
                                        <div class="price-info">
                                            <h6 class="price-title">Premium Plus</h6>
                                            <h3 class="price-rs">$49.99</h3>
                                            <a href="javascript:void(0)" class="self-btn">select</a>
                                        </div>
                                    </div>
                                    <div class="price-coll">
                                        <div class="price-info">
                                            <h6 class="price-title">Premium Plus</h6>
                                            <h3 class="price-rs">$54.99</h3>
                                            <a href="javascript:void(0)" class="self-btn">select</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> -->

                        <!-- <div class="selecter-box">
                            <div class="selecter-inn">
                                <div class="cust-row">
                                    <div class="left-coll">
                                        <h4 class="selecter-title-1">Telemedicine Plus</h4>
                                        <p>Add short explainer of the program here.</p>
                                    </div>
                                    <div class="right-coll">
                                        <div class="img-box">
                                            <img src="{{ asset('assets/images/click-img.png') }}">
                                        </div>
                                    </div>
                                    <div class="right-coll">
                                        <div class="img-box">
                                            <img src="{{ asset('assets/images/click-img.png') }}">
                                        </div>
                                    </div>
                                    <div class="right-coll">
                                        <div class="img-box">
                                            <img src="{{ asset('assets/images/click-img.png') }}">
                                        </div>
                                    </div>
                                    <div class="right-coll">
                                        <div class="img-box">
                                            <img src="{{ asset('assets/images/click-img.png') }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> -->

                    </div>
                    <div class="dr-jill-info">
                        <div class="content">
                            <div class="dr-jill-img">
                            <img src="{{ asset('assets/images/dr-jill.png') }}">
                            </div>
                            <div class="jill-name">
                                <p>Dr Jill, Co-founder and CEO</p>
                            </div>
                            <div class="frst-p">
                                <p> <span>Welcome to our program.</span> As Dr Jill, I have been practicing psychology for well over 30 years. I have helped many people to believe in their own gifts and talents and to take their rightful place in the universe. I have always had a heart to help people.</p>
                            </div>
                            <div class="second-p">
                                <p>I have worked with children,
                                    adolescents, young adults and adults. I have also taught psychology in university/college settings, led university counseling centers, governed a university student health service and helped
                                    train many uprising professional mental health therapists.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </div>
    </section>




                    </div>
                    <div class="register-right" id="step3" style='{{ (Auth::user()->step_position == 3) ? "display: block;" : "display: none;" }}'>
                        <form action="{{ route('updateStep')}}" id="invoice-form">
                            {{ csrf_field() }}
                            <input type="hidden" name="next_step" value="4">
                            <input type="hidden" name="email" value="{{ $user->email }}">
                            <div class="register-right-top">
                                <h4 class="mb-4"><i class="fas fa-file-invoice"></i> Invoice Details</h4>
                                <div class="register-form">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="text">First Name*</label>
                                                <input type="text" class="form-control" id="fname_inv" placeholder="" name="fname" value="{{ $user->fname }}" readonly>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="text">Last Name*</label>
                                                <input type="text" class="form-control" id="lname_inv" placeholder="" name="lname" value="{{ $user->lname }}" readonly >
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="phone_inv">Primary Phone*</label>
                                                <input type="tel" class="form-control" id="phone_inv" placeholder="" name="primaryPhone" value="{{ $user->primaryPhone }}">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="text">Date of Birth*</label>
                                                <input id="date_of_birth" class="form-control" name="dob" autocomplete="off" value="{{ $user->dob }}" />
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="inner-details-box">
                                                <label for="exampleInputWeight">Gender*</label>
                                                <div class="d-flex">
                                                    <div class="form-check mr-4">
                                                        <label class="form-check-label">
                                                            <input type="radio" class="form-check-input" name="gender" id="optionsRadios1" value="m" {{ ($user->gender=="m") ? "checked" : ""}}>
                                                            Male
                                                            <i class="input-helper"></i></label>
                                                    </div>
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input type="radio" class="form-check-input " name="gender" id="optionsRadios1" value="f" {{ ($user->gender=="f") ? "checked" : ""}}>
                                                            Female
                                                            <i class="input-helper"></i></label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Time Zone*</label>
                                                <select class="form-control theme-select" name="timezoneId">
                                                    <option value=""> -- SELECT TIMEZONE -- </option>
                                                    @foreach ($timezones as $timezone)
                                                    <option value="{{ $timezone->id }}" {{ ($timezone->id == $user->timezoneId) ? 'selected' : '' }}>
                                                        {{ $timezone->name }}
                                                    </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="address">Address*</label>
                                                <input type="text" class="form-control" id="address" placeholder="" name="address" value="{{ $user->address }}">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="city">City*</label>
                                                <input type="text" class="form-control" id="city" placeholder="" name="city" value="{{ $user->city }}">
                                            </div>
                                        </div>

                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="state">State*</label>
                                                <select class="form-control" name="stateid">
                                                    <option value="">Please select state</option>
                                                    @foreach ($states as $state)
                                                    <option value="{{ $state->id }}" {{ ($state->id == $user->stateid) ? 'selected' : '' }}>
                                                        {{ $state->name }}
                                                    </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="zipcode">Zip Code*</label>
                                                <input type="number" class="form-control" id="zipcode" placeholder="" name="zipCode" value="{{ $user->zipCode }}">
                                            </div>
                                        </div>
                                         <!--<div class="col-md-6">
                                        <div class="form-group ">
                                            <div class="pull-center ">
                                                <div class="g-recaptcha"
                                                    data-sitekey="6LelAxwmAAAAADE7SyKaY-pRETH7h28l73m6OhKO">
                                                </div>
                                                <input type="hidden" class="hiddenRecaptcha required" name="hiddenRecaptcha" id="hiddenRecaptcha">
                                            </div>
                                        </div>
                                    </div>-->

                                        <div class="col-sm-12">
                                            <div class="modal-footer">
                                                <div class="register-right-bottom register-button w-100">
                                                    <a href="#" class="custom-button prevStep btn btn-outline-secondary btn-fw" data-prev="step2" data-current="step3">prev</a>
                                                    <input class="custom-button btn btn-primary" type="submit" name="" style="float: right;" value="Next">
                                                    <!-- <a href="#" class="custom-button" style="float: right;">Next</a> -->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>

                    <div class="register-right payment-card-box" id="step4" style='{{ (Auth::user()->step_position == 4) ? "display: block;" : "display: none;" }}'>
                        <div class="register-right-top">
                            <h4 class="heading-title"><i class="far fa-credit-card"></i> Payment information <span class="fs-16 theme-color"> (Pay with Card)</span></h4>

                            <div class="register-form payment">
                                <form id="payment-form" action="{{ route('braintree.payment') }}" method="post" class="mb-4">
                                    {{ csrf_field() }}
                                    <input type="hidden" value="" name="plan" id="plan">
                                    <!-- Putting the empty container you plan to pass to
                                                `braintree.dropin.create` inside a form will make layout and flow
                                                easier to manage -->
                                    <div id="dropin-container"></div>
                                    <input type="submit" class="custom-button btn btn-primary" id="paymentSubmit" />
                                    <input type="hidden" id="nonce" name="payment_method_nonce" />
                                </form>
                                <!-- stripe form setup -->
                                <div id="credit-card" class="tab-pane fade show active">

                                    <span id="card-errors" class="">
                                        <!-- <i class="fas fa-exclamation-triangle" ></i> -->
                                    </span>

                                </div>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="email" id="email" value="{{ Auth::user()->email }}">
                </div>

            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    const form = document.getElementById('payment-form');
    braintree.dropin.create({
        authorization: "<?php echo $clientToken; ?>",
        container: '#dropin-container'
    }, (error, dropinInstance) => {
        if (error) console.error(error);

        form.addEventListener('submit', event => {
            event.preventDefault();

            dropinInstance.requestPaymentMethod((error, payload) => {
                if (error) console.error(error);
                document.getElementById('nonce').value = payload.nonce;
                document.getElementById('paymentSubmit').style.setProperty("display", "none")
                form.submit();
            });
        });
    });
</script>


@endsection

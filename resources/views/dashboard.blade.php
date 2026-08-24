@extends('layouts.dashboard')
@section('content')
<div class="main-panel main-panel-for-modal-page as">
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
                    <div class="col-md-4 grid-margin stretch-card">
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
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-8 grid-margin stretch-card features_new_v1">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Portal Features</h5>
                                <div class="feature_row">
                                    <div class="fea_card">
                                        <div class="image">
                                            <img src="{{ asset('/assets/assets/images/Secure-Messaging-png.png')}}" />   
                                        </div>
                                         <div class="title">
                                             <p>Secure Messaging</p>
                                         </div>
                                    </div>
                                    <div class="fea_card">
                                        <div class="image">
                                            <img src="{{ asset('/assets/assets/images/secure_messaging_png.png')}}"  />   
                                        </div>
                                         <div class="title">
                                             <p>Schedule Center</p>
                                         </div>
                                         <ul>
                                            <li>Consultation History</li>
                                            <li>Message a Specialist</li>
                                        </ul>
                                    </div>
                                    <div class="fea_card">
                                        <div class="image">
                                            <img src="{{ asset('/assets/assets/images/Personal-Medical-Records-png.png')}}" />   
                                        </div>
                                         <div class="title">
                                             <p>Manage Personal Medical Records</p>
                                         </div>
                                    </div>
                                </div>
                                <!--<ol>-->
                                <!--    <li>Secure Messaging</li>-->
                                <!--    <li>-->
                                <!--        Schedule Center-->
                                <!--        <ul>-->
                                <!--            <li>Consultation History</li>-->
                                <!--            <li>Message a Doctor</li>-->
                                <!--        </ul>-->
                                <!--    </li>-->
                                <!--    <li>Manage Personal Medical Records</li>-->
                                <!--</ol>-->
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
            </div>
            <div class="quick_link_row">
                <div class="quick_col stretch-card transparent">
                    <div class="card card-tale">
                        <a href="{{ url('personal-record') }}">
                            <div class="card-body">
                                <!--<p class="fs-30 mb-4"><i class="fas fa-user-shield"></i></p>-->
                                <div class="icon">
                                    <img src="{{ asset('/assets/assets/images/Personal_Heath_Record_icon.png')}}" />
                                </div>
                                <div class="title-v1">
                                    <p class="fs-20">Personal Health Record</p>
                                </div>
                                 <div class="detail">
                                    <p>Your Member Health Portal allows you to be healthier, with educational and interactive health management, risk assessment and decision support tools.</p>
                                </div>
                                <div class="view_more">
                                     <img src="{{ asset('/assets/assets/images/right-side-viw-more.png')}}" />
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="quick_col stretch-card transparent">
                    <div class="card card-dark-blue">
                        <a href="{{ url('medications') }}">
                            <div class="card-body">
                                <!--<p class="fs-30 mb-4"><i class="fas fa-pills"></i></p>-->
                                 <div class="icon">
                                    <img src="{{ asset('/assets/assets/images/Medications_icioni_v1.png')}}" />
                                </div>
                                <div class="title-v1">
                                    <p class="fs-20">Medications</p>
                                </div>
                                 <div class="detail">
                                    <p>Your Member Health Portal allows you to be healthier, with educational and interactive health management, risk assessment and decision support tools.</p>
                                </div>
                                 <div class="view_more">
                                     <img src="{{ asset('/assets/assets/images/right-side-viw-more.png')}}" />
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="quick_col stretch-card transparent">
                    <div class="card card-light-blue">
                        <a href="{{ url('medication-allergies') }}">
                            <div class="card-body">
                                <!--<p class="fs-30 mb-4"><i class="fas fa-head-side-cough"></i></p>-->
                                 <div class="icon">
                                    <img src="{{ asset('/assets/assets/images/Medication_Allergies_icon.png')}}" />
                                </div>
                                <div class="title-v1">
                                    <p class="fs-20">Medication Allergies</p>
                                </div>
                                 <div class="detail">
                                    <p>Your Member Health Portal allows you to be healthier, with educational and interactive health management, risk assessment and decision support tools.</p>
                                </div>
                                 <div class="view_more">
                                     <img src="{{ asset('/assets/assets/images/right-side-viw-more.png')}}" />
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="quick_col stretch-card transparent">
                    <div class="card card-light-danger">
                        <a href="{{ url('medical-history') }}">
                            <div class="card-body">
                                <!--<p class="fs-30 mb-4"><i class="fas fa-hospital-user"></i></p>-->
                                 <div class="icon">
                                    <img src="{{ asset('/assets/assets/images/Medical_Conditions_vi.png')}}" />
                                </div>
                                <div class="title-v1">
                                    <p class="fs-20">Medical Conditions</p>
                                </div>
                                <div class="detail">
                                    <p>Your Member Health Portal allows you to be healthier, with educational and interactive health management, risk assessment and decision support tools.</p>
                                </div>
                                 <div class="view_more">
                                     <img src="{{ asset('/assets/assets/images/right-side-viw-more.png')}}" />
                                </div>
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
                    <h3 class="card-title mb-0">Update Document</h3>
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
    <div class="modal fade dev-v1-main" id="dashboard-popup" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl-cus" role="document">
            <div class="modal-content content-1 step1 modal-medium">
                <!-- <div class="modal-header theme-bg-color">
                    <h3 class="card-title mb-0 text-capitalize">Complete details</h3>
                    @if(Session::has('error'))
                        <p class="alert alert-danger">{{ Session::get('error') }}</p>
                    @endif -->
                    <!-- <a  class="close" href="{{ route('logout') }}" title="Logout"><i class="fas fa-sign-out-alt"></i> </a> -->
                <!-- </div> -->
                @if(Session::has('error'))
                        <p class="alert alert-danger">{{ Session::get('error') }}</p>
                    @endif
                <div class="modal-body modal-table-body">
                    <center>
                        <h3 id="res-msg"></h3>
                    </center>
                    <div class="promo-code-sec code-sec-1">
                        <div class="register-right" id="step2" style='{{ (Auth::user()->step_position == 2) ? "display: block;" : "display: none;" }}'>
                            <div class="register-right-top">
                                @include('packs')
                            </div>
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

                                <div class="register-form payment-update" style="display:none;"></div>								                                <div class="register-form payment">
                                    <form id="payment-form" action="{{ route('braintree.payment') }}" method="post" class="mb-4">
                                        {{ csrf_field() }}
                                        <input type="hidden" value="" name="plan" id="plan">
                                        <!-- Putting the empty container you plan to pass to
                                                    `braintree.dropin.create` inside a form will make layout and flow
                                                    easier to manage -->
                                        <!--<div id="dropin-container"></div>-->
                                        <div class="pay-form w-100">
                                            <input type="number" value="" min="1" name="card_number" id="card_number" placeholder="Card Number"/>
                                            <span id="card_number_error" style="display:none">Please enter valid card number.</span>
                                        </div>
                                       <div class="pay-form w-25">
                                             <input type="number" value="" name="exp_month" id="exp_month" placeholder="Expiry Month"/ max="12" min="1">    
                                             <span id="exp_month_error" style="display:none">Please enter valid Month.</span>
                                       </div>
                                       
                                       <div class="pay-form w-25">
                                        <input type="number" value="" name="exp_year" id="exp_year" min="23" placeholder="Expiry Year" />
                                        <span id="exp_year_error" style="display:none">Please enter valid expiry year.</span>
                                       </div>
                                       
                                       <div class="pay-form w-25">
                                            <input type="number" value="" name="ccv" id="cvv" placeholder="cvv" min="1" /> 
                                            <span id="cvv_error" style="display:none">Please enter valid cvv number.</span>
                                       </div>
                                        <div class="w-100 text-end">
                                            <input type="submit" class="custom-button btn btn-primary" id="paymentSubmit" />
                                            <input type="hidden" id="nonce" name="payment_method_nonce" />    
                                        </div>
                                        
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
    // braintree.dropin.create({
    //     authorization: "<?php echo $clientToken; ?>",
    //     container: '#dropin-container'
    // }, (error, dropinInstance) => {
    //     if (error) console.error(error);

    //     form.addEventListener('submit', event => {
    //         event.preventDefault();

    //         dropinInstance.requestPaymentMethod((error, payload) => {
    //             if (error) console.error(error);
    //             document.getElementById('nonce').value = payload.nonce;
    //             document.getElementById('paymentSubmit').style.setProperty("display", "none")
    //             form.submit();
    //         });
    //     });
    // });
    
    
    form.addEventListener('submit', event => {
        event.preventDefault();
        
        let current_month = new Date().getMonth() + 1;
        let year = new Date().getFullYear().toString().substr(-2);
        
        let error_couting = 0;
        let card_number = document.getElementById('card_number').value;
        let exp_month = document.getElementById('exp_month').value;
        let exp_year = document.getElementById('exp_year').value;
        let cvv= document.getElementById('cvv').value;
        
        if(card_number.length == 0){
            error_couting++;
            document.getElementById("card_number_error").style.display = 'block';
        }else{
            document.getElementById("card_number_error").style.display = 'none';
        }
        
        if(exp_month.length == 0 || ( exp_year == year &&  exp_month < current_month)){
            error_couting++;
            document.getElementById("exp_month_error").style.display = 'block';
        }else{
             document.getElementById("exp_month_error").style.display = 'none';
            
        }
        if(exp_year.length == 0 ||  exp_year < year){
            error_couting++;
            document.getElementById("exp_year_error").style.display = 'block';
            document.getElementById("exp_year_error").textContent  = 'Please enter valid year.';
        }else{
            document.getElementById("exp_year_error").style.display = 'none';
        }
        
        if(exp_year.length  > 2 ){
            error_couting++;
            document.getElementById("exp_year_error").textContent  = 'Please enter only last 2 digit of year.';
            document.getElementById("exp_year_error").style.display = 'block';
            
        }
        
        if(cvv.length == 0){
            error_couting++;
            document.getElementById("cvv_error").style.display = 'block';
        }else{
            document.getElementById("cvv_error").style.display = 'none';
        }
        if(error_couting){
                return false;
        }

        let res = checkCreditCard(card_number);
        console.log(res);
        if(res.success){
          form.submit();
        }else{
             document.getElementById("card_number_error").style.display = 'block';
            
        }
        // 
    });
    
    
    
    const validateCardNumber = number => {
    //Check if the number contains only numeric value  
    //and is of between 13 to 19 digits
    const regex = new RegExp("^[0-9]{13,19}$");
    if (!regex.test(number)){
        return false;
    }
  
    return luhnCheck(number);
}
const luhnCheck = val => {
    let checksum = 0; // running checksum total
    let j = 1; // takes value of 1 or 2

    // Process each digit one by one starting from the last
    for (let i = val.length - 1; i >= 0; i--) {
      let calc = 0;
      // Extract the next digit and multiply by 1 or 2 on alternative digits.
      calc = Number(val.charAt(i)) * j;

      // If the result is in two digits add 1 to the checksum total
      if (calc > 9) {
        checksum = checksum + 1;
        calc = calc - 10;
      }

      // Add the units element to the checksum total
      checksum = checksum + calc;

      // Switch the value of j
      if (j == 1) {
        j = 2;
      } else {
        j = 1;
      }
    }
  
    //Check if it is divisible by 10 or not.
    return (checksum % 10) == 0;
}
    
    
    const checkCreditCard = cardnumber => {
  
  //Error messages
  const ccErrors = [];
  ccErrors [0] = "Unknown card type";
  ccErrors [1] = "No card number provided";
  ccErrors [2] = "Credit card number is in invalid format";
  ccErrors [3] = "Credit card number is invalid";
  ccErrors [4] = "Credit card number has an inappropriate number of digits";
  ccErrors [5] = "Warning! This credit card number is associated with a scam attempt";
  
  //Response format
  const response = (success, message = null, type = null) => ({
    message,
    success,
    type
  });
     
  // Define the cards we support. You may add additional card types as follows.
  
  //  Name:         As in the selection box of the form - must be same as user's
  //  Length:       List of possible valid lengths of the card number for the card
  //  prefixes:     List of possible prefixes for the card
  //  checkdigit:   Boolean to say whether there is a check digit
  const cards = [];
  cards [0] = {name: "Visa", 
               length: "13,16", 
               prefixes: "4",
               checkdigit: true};
  cards [1] = {name: "MasterCard", 
               length: "16", 
               prefixes: "51,52,53,54,55",
               checkdigit: true};
  cards [2] = {name: "DinersClub", 
               length: "14,16", 
               prefixes: "36,38,54,55",
               checkdigit: true};
  cards [3] = {name: "CarteBlanche", 
               length: "14", 
               prefixes: "300,301,302,303,304,305",
               checkdigit: true};
  cards [4] = {name: "AmEx", 
               length: "15", 
               prefixes: "34,37",
               checkdigit: true};
  cards [5] = {name: "Discover", 
               length: "16", 
               prefixes: "6011,622,64,65",
               checkdigit: true};
  cards [6] = {name: "JCB", 
               length: "16", 
               prefixes: "35",
               checkdigit: true};
  cards [7] = {name: "enRoute", 
               length: "15", 
               prefixes: "2014,2149",
               checkdigit: true};
  cards [8] = {name: "Solo", 
               length: "16,18,19", 
               prefixes: "6334,6767",
               checkdigit: true};
  cards [9] = {name: "Switch", 
               length: "16,18,19", 
               prefixes: "4903,4905,4911,4936,564182,633110,6333,6759",
               checkdigit: true};
  cards [10] = {name: "Maestro", 
               length: "12,13,14,15,16,18,19", 
               prefixes: "5018,5020,5038,6304,6759,6761,6762,6763",
               checkdigit: true};
  cards [11] = {name: "VisaElectron", 
               length: "16", 
               prefixes: "4026,417500,4508,4844,4913,4917",
               checkdigit: true};
  cards [12] = {name: "LaserCard", 
               length: "16,17,18,19", 
               prefixes: "6304,6706,6771,6709",
               checkdigit: true};
   
  if (cardnumber.length == 0)  {
     return response(false, ccErrors[1]);
  }
    
  // Now remove any spaces from the credit card number
  // Update this if there are any other special characters like -
  cardnumber = cardnumber.replace (/\s/g, "");
  
  // Validate the format of the credit card
  // luhn's algorithm
  if(!validateCardNumber(cardnumber)){
    return response(false, ccErrors[2]);
  }
 
  // Check it's not a spam number
  if (cardnumber == '5490997771092064') { 
    return response(false, ccErrors[5]);
  }

  // The following are the card-specific checks we undertake.
  let lengthValid = false;
  let prefixValid = false; 
  let cardCompany = "";
  
  // Check if card belongs to any organization
  for(let i = 0; i < cards.length; i++){
    const prefix = cards[i].prefixes.split(",");
    
    for (let j = 0; j < prefix.length; j++) {
      const exp = new RegExp ("^" + prefix[j]);
      if (exp.test (cardnumber)) {
        prefixValid = true;
      }
    }
    
    if(prefixValid){
      const lengths = cards[i].length.split(",");
      // Now see if its of valid length;
      for (let j=0; j < lengths.length; j++) {
        if (cardnumber.length == lengths[j]) {
          lengthValid = true;
        }
      }
    }
    
    if(lengthValid && prefixValid){
      cardCompany = cards[i].name;
      return response(true, null, cardCompany);
    }  
  }
  
  // If it isn't a valid prefix there's no point at looking at the length
  if (!prefixValid) {
     return response(false, ccErrors[3]);
  }
  
  // See if all is OK by seeing if the length was valid
  if (!lengthValid) {
     return response(false, ccErrors[4]);
  };   
  
  // The credit card is in the required format.
  return response(true, null, cardCompany);
}
 
//$('#check_year').mask('00');   
 
 @if(session('utm_source') && session('utm_medium') && session('utm_campaign'))
     document.getElementById('inputPromoCode').value = '{{ config("constants.signup-promo") }}';
    setTimeout(function(){  
        document.querySelector('.promo-code-apply-btn').click();
    }, 3000);
@endif
</script>   
        
@endsection

@extends('layouts.default')
@section('content')

<section class="awmi_pricing_main">
    <section class="landing-sec">
        <div class="new-container">
            <div class="landing-wrap">
                <div class="left-wrap">
                    <h1 class="landing-title">AWMI Family Wellness</h1>
                </div>
                <div class="landing-page-img">
                    <img src="{{asset('/uploads/pageFiles/landing-img1.png')}}" alt="landing-img1">
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
    <section class="thank-dbl-sec">
        <div class="new-container">
            <div class="thank-content">
                <div class="thank-title">
                    <h3>Thank you for registering {{$user['fname'] .' '. $user['lname']}}. Let's select your plan!</h3>
                </div>
                <p>The Telemedicine plus and Telethorapy plan is designed to help you your loved ones through this very
                    challengin time.
                    <br>Please select option that works for you.</p>

                <div class="cust-row">
                    <div class="cust-coll-9">
                        <div class="plans-info">
                            <h3 class="clr-title"> Telemedicine Plus and Teletherapy</h3>
                           <div class="plans-info-inn">
                                  
                               
                               <!--Start-->
                               <form>
                               <div class="promo-code-sec">
                                   <input type="hidden" name="_token" id="awmi_token" value="{{ csrf_token() }}">
                                  
                               <div class="inner-promo-code-sec mb-3">
                                <h4 class="mb-2"><i class="fas fa-tags"></i> Have a promocode?</h4>
                                <div class="wrapper">
                                    <div class="promo-code-apply-form" name="promo-code-apply-form" id="promo-code-apply-form">
                                        <div class="from-group">
                                            <input type="text" placeholder="Enter promocode...." name="code" id="awmiinputPromoCode" class="promo-text" />
                                            <button class="awmi-promo-code-apply-btn">Apply</button>
                                            <span class="promo-error" style="display:none">Please fill your promo
                                                code</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            </div>
                            </form>
                               <!--End-->
                            <div class="plans-info-left">

                                @foreach(Config('constants.awmiPricing') as $key => $value )
                                    
                                    <div class="price-coll">
                                        <div class="price-info" data-key="{{$key}}" data-awmiprice={{ $value[0] }} >
                                            <h2 class="price-title">
                                                {{ $key }}
                                            </h2>
                                            <h3 class="price-rs" id="{{ 'price' . $key }}">${{ $value[0] }}</h3>
                                            <h6>PER MONTH</h6>
                                                <a href="javascript:void(0)" awmitype="{{ $key }}" awmiprice={{ array_keys($value)[0] }} id="{{ $key }}" class="self-btn splan_awmi">select</a>
                                        </div>
                                    </div>
                                    
                                @endforeach

                                {{-- <div class="price-coll">
                                    <div class="price-info">
                                        <h2 class="price-title">
                                            Self
                                        </h2>
                                        <h3 class="price-rs">$35.99</h3>
                                        <h6>PER MONTH</h6>
                                            <a href="javascript:void(0)" awmitype="self" awmiprice="35.99" class="self-btn splan_awmi">select</a>
                                    </div>
                                </div>

                                <div class="price-coll">
                                    <div class="price-info">
                                        <h2 class="price-title">Basic</h2>
                                        <h3 class="price-rs">$35.99</h3>
                                        <h6>PER MONTH</h6>
                                        <a href="javascript:void(0)" awmitype="basic" awmiprice="35.99" class="self-btn splan_awmi">select</a>
                                    </div>
                                </div> --}}

                            </div>
                           </div>
                        </div>
                    </div>
                        <div class="dr-jill-info">
                            <div class="content">
                                <div class="dr-jill-img">
                                    <img src="{{asset('/uploads/pageFiles/dr-jill.png')}}" alt="dr-jill-img">
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

</section>



{{--  add modal for card  --}}

<div class="modal fade" id="awmi-pricing-address" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl-cus" role="document">
        <div class="modal-content content-1 step1">
            @if(Session::has('error'))
                    <p class="alert alert-danger">{{ Session::get('error') }}</p>
                @endif
            <div class="modal-body modal-table-body">
                <center>
                    <h3 id="res-msg"></h3>
                </center>
                <div class="promo-code-sec code-sec-1">
                    <div class="register-right" id="step3">
                        <form action="{{ route('updateStep')}}" id="invoice-form">
                            {{ csrf_field() }}
                            <input type="hidden" name="promo_code_id" value="">
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
                                        <div class="col-sm-12">
                                            <div class="modal-footer">
                                                <div class="register-right-bottom register-button w-100">
                                                    {{-- <a href="#" class="custom-button prevStep btn btn-outline-secondary btn-fw" data-prev="step2" data-current="step3">prev</a> --}}
                                                    <input class="custom-button btn btn-primary" type="submit" name=""  value="Next">
                                                    <!-- <a href="#" class="custom-button" style="float: right;">Next</a> -->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="register-right payment-card-box" id="step4" style="display: none;">
                        <div class="register-right-top">
                            <h4 class="heading-title"><i class="far fa-credit-card"></i> Payment information <span class="fs-16 theme-color"> (Pay with Card)</span></h4>

                            <div class="register-form payment">
                                <form id="payment-form" action="{{ route('braintree.payment-awmi') }}" method="post" class="mb-4">
                                    {{ csrf_field() }}
                                    <input type="hidden" value="" name="plan" id="plan">
                                    <!--<div id="dropin-container"></div>-->
                                     <div class="pay-form w-100">
                                            <input type="number" value="" name="card_number" id="card_number" placeholder="Card Number"/>
                                            <span id="card_number_error" style="display:none">Please enter valid card number.</span>
                                        </div>
                                       <div class="pay-form w-25">
                                             <input type="number" value="" name="exp_month" id="exp_month" placeholder="Expiry Month"/ max="12" min="1">    
                                             <span id="exp_month_error" style="display:none">Please enter valid card number.</span>
                                       </div>
                                       
                                       <div class="pay-form w-25">
                                        <input type="number" value="" name="exp_year" id="exp_year" placeholder="Expiry Year" />
                                        <span id="exp_year_error" style="display:none">Please enter valid expiry year.</span>
                                       </div>
                                       
                                       <div class="pay-form w-25">
                                            <input type="number" value="" name="ccv" id="cvv" placeholder="cvv" /> 
                                            <span id="cvv_error" style="display:none">Please enter valid cvv number.</span>
                                       </div>
                                       
                                       <div class="submit-wrap12">
                                           <input type="submit" class="custom-button btn btn-primary" id="paymentSubmit" />
                                            <input type="hidden" id="nonce" name="payment_method_nonce" />
                                            <input type="hidden" name="awmiprice" id="awmi-price" >
                                            <input type="hidden" name="awmitype" id="awmi-type" >
                                            <input type="hidden" name="usertype" value="awmi-family" >
                                       </div>
                                    
                                </form>
                                <div id="credit-card" class="tab-pane fade show active">
                                    <span id="card-errors" class="">
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
        
        let card_number = document.getElementById('card_number').value;
        let exp_month = document.getElementById('exp_month').value;
        let exp_year = document.getElementById('exp_year').value;
        let cvv= document.getElementById('cvv').value;
        
        if(card_number.length == 0){
            document.getElementById("card_number_error").style.display = 'block';
        }else{
            document.getElementById("card_number_error").style.display = 'none';
        }
        
        if(exp_month.length == 0 || ( exp_year == year &&  exp_month < current_month)){
            document.getElementById("exp_month_error").style.display = 'block';
        }else{
             document.getElementById("exp_month_error").style.display = 'none';
            
        }
        if(exp_year.length == 0 ||  exp_year < year){
            document.getElementById("exp_year_error").style.display = 'block';
            document.getElementById("exp_year_error").textContent  = 'Please enter valid year.';
        }else{
            document.getElementById("exp_year_error").style.display = 'none';
        }
        
        if(exp_year.length  > 2 ){
            document.getElementById("exp_year_error").textContent  = 'Please enter only last 2 digit of year.';
            document.getElementById("exp_year_error").style.display = 'block';
            
        }
        
        if(cvv.length == 0){
            document.getElementById("cvv_error").style.display = 'block';
        }else{
            document.getElementById("cvv_error").style.display = 'none';
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

</script>


@endsection
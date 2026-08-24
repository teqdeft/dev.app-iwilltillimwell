



<div class="app-main choose-plan pln2 checkout-screen">

    <form id="payment-form" action="{{ route('braintree.payment') }}" method="post" >

    <section class="plan-v1 plan-v3">

        <div class="cust-container">

            <div class="plan-header">

                <div class="back-btn">

                    <a href="javascript:void(0)" onclick="show_tabs(3)" class="back-main"><img src="{{ asset('mobile-images/back-arrow-for-darktheme.svg') }}" alt="back" /></a>

                </div>

				

			

                

            </div>

			

			

				<section class="onbd-logo-section">

					 <div class="logo-main">

						<a href="{{ url('/')}}">

							<img src="{{ asset(env('APP_LOGIN_MOBILE_BLACK')) }}" alt="app logo">

						</a>

					</div>	

				</section>



           <div class="card-detail-img">

		   

			<div class="get-started text-center">

                    <h5 class="heading-h5">Checkout</h5>

                </div>

                <div class="title card-type">

                    <p>Credit Card</p>

                </div>

                <div class="image-box">

                    <img src="{{ asset('mobile-images/visa_card_image.png') }}" alt="back" />

                </div>

           </div>

            

            <div class="create-profile-form payment-card">

                <div class="top">

                    <p>Payment Information (Pay with Card)</p>

                </div>

                

               

                    {{ csrf_field() }}

                    <input type="hidden" value="" name="plan" id="plan">

                    <div class="input-container">

                        <input type="number" id="card_number" name="card_number" placeholder=" " value="" oninput="validateCreditCard(this,'16')">

                        <label for="username">Card Number</label>

                        <span id="card_number_error" class="error" style="display:none">Please enter valid card number.</span>

                    </div>

                    

                    <div class="month-year">

                        <div class="input-container">

@php

    $currentMonth = now()->format('m');

@endphp                          

                            <select id="exp_month" name="exp_month">

                                @for ($i = 1; $i <= 12; $i++)



                                    @php

                                        $month = str_pad($i, 2, '0', STR_PAD_LEFT);

                                    @endphp

                                    @if ($month >= $currentMonth)

                                        <option value="{{ str_pad($i, 2, '0', STR_PAD_LEFT) }}">

                                            {{ str_pad($i, 2, '0', STR_PAD_LEFT) }}

                                        </option>

                                        @endif    

                                @endfor

                            </select>   

                            

                            <span id="exp_month_error" class="error" style="display:none">Please enter valid month.</span>

                        </div>

                        

                        <div class="input-container">

                            

                          

                            <select id="exp_year" name="exp_year">

                            @for ($i = now()->year; $i <= now()->year + 9; $i++)

                                <option value="{{ substr($i, -2) }}">{{ $i }}</option>

                            @endfor

                            </select>



                            <span id="exp_year_error" class="error" style="display:none">Please enter valid expiry year.</span>

                        </div>

                    </div>

                    

                    <div class="input-container">

                        <input type="number" id="cvv" name="ccv" placeholder=" " value="" oninput="validateCreditCard(this,'3')">

                        <label for="useraddress">CVV</label>

                        <span id="cvv_error" class="error" style="display:none">Please enter valid cvv number.</span>

                    </div>

					

					<div class="not-roobt mt-4 mb-4 text-center">

						<div class="g-recaptcha" data-sitekey="{{ env('RECAPTCHA_SITE_KEY') }}"></div>

						@error('g-recaptcha-response')

							<div class="text-danger failed">{{ $message }}</div>

						@enderror

					</div>	



                    

                    <input type="hidden" id="nonce" name="payment_method_nonce" />



                

            </div>



        </div>

    </section>

    

    <div class="total-paying">



        <?php /*<div class="pay-total">Paying <span>${{$user_final_amount}}/mo</span> + <span>20%VAT</span></div>*/ ?>

        <div class="pay-total">Paying <span class="user_final_amount">${{$user_final_amount}}/mo</span></div>

		<div class="checkout-update" style="display:none;"></div>	

        <div class="cta">

            <button type="submit" class="primary-button" id="paymentSubmit">Secure Checkout</button>

        </div>

        <div class="paying-bottom-icon">

            <img src="{{ asset('mobile-images/PCI.png') }}" alt="icon">

            <img src="{{ asset('mobile-images/norton.png') }}" alt="icon">

        </div>

    </div>

</form>

</div>

<script src="https://www.google.com/recaptcha/api.js" async defer></script>

<script type="text/javascript">

        const form = document.getElementById('payment-form');

        form.addEventListener('submit', event => {

            event.preventDefault();

            let error_couting = 0;

            let current_month = new Date().getMonth() + 1;

            let year = new Date().getFullYear().toString().substr(-2);

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



            console.log("Here");

            

            if(exp_month.length == 0 || ( exp_year == year &&  exp_month < current_month)){

               // error_couting++;

                //document.getElementById("exp_month_error").style.display = 'block';

            }else{

                //document.getElementById("exp_month_error").style.display = 'none';

                

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

            

            if(cvv.length < 3){

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

				

				showLoaderPageLoad('show');

				setTimeout(function() {

					form.submit();

				}, 3000);

			

            }else{

                document.getElementById("card_number_error").style.display = 'block';

                

            }



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


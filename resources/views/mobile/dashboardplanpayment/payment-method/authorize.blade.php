<div class="app-main choose-plan pln2 checkout-screen">
    <form id="paymentForm" action="javascript:void(0)" method="post" >
        {{ csrf_field() }}
            <section class="plan-v1 plan-v3">
                <div class="cust-container">
                    <div class="plan-header">
                        <div class="back-btn">
                            <a href="{{url('change-plan')}}" class="back-main"><img src="{{ asset('mobile-images/back-arrow-for-darktheme.svg') }}" alt="back" /></a>

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


                            <div class="payment-card-form">
				
                                <div class="input-container">
                                  
                                    <input type="text" 
                                    name="card_number" 
                                    id="card_number_auth" 
                                    class="form-control" 

                            
                                    @if(config('services.authorize_net.environment') == 'sandbox')
                                        placeholder="4111111111111111"
                                        value="4111111111111111"
                                    @else
                                       
                                    @endif
                                    
                                    required>
                                    <label for="username">Card Number</label>
                                    <small class="text-danger" id="card_error"></small>
                                </div>


                                 <div class="month-year">

                                        <div class="input-container">
                                            <select name="expiry_year" id="expiry_year" class="form-control theme-select" required>
                                                <option value="">Year</option>
                                                    <?php
                                                        $currentYear = date('Y');
                                                        for ($i = 0; $i < 10; $i++) {
                                                            $year = $currentYear + $i;
                                                            echo "<option value='{$year}'>{$year}</option>";
                                                        }
                                                    ?>
                                            </select>
                                        </div>

                                        <div class="input-container">

                                      
                                        <select name="expiry_month" id="expiry_month" class="form-control theme-select" required>
                                        </select>    

                                        </div>


                                </div>


                                

                               <div class="input-container">
                                                   
                                    <input type="text" name="cvv" class="form-control" required 
                                    
                                    @if(config('services.authorize_net.environment') == 'sandbox')
                                        value="123"
                                        placeholder="123"
                                    @else
                                       
                                    @endif
                                    
                                    
                                    >
                                     <label>CVV</label>
                                    <small class="text-danger" id="cvv_error"></small>

                                </div>
                                


                            </div>

                            
                        <div class="not-roobt mt-4 mb-4 text-center">

                            <div class="g-recaptcha" data-sitekey="{{ env('RECAPTCHA_SITE_KEY') }}"></div>

                            @error('g-recaptcha-response')

                                <div class="text-danger failed">{{ $message }}</div>

                            @enderror

                        </div>	   
                        

                    </div>
                </div>
            </section>

            <div class="total-paying">

                <div class="pay-total">Paying <span class="user_final_amount">${{$user_final_amount}}/mo</span></div>

                <div class="checkout-update" style="display:none;"></div>	

                <div class="cta">


                     <button type="submit" id="pay-btn" class="btn btn-primary btn-pay primary-button">
                        <span id="btn-text" class="">Secure Checkout</span>
                        <span id="btn-loader" class="spinner-border spinner-border-sm d-none"></span>
                    </button>

                     <div id="result-message" class="mt-3 text-center"></div>

                </div>

                <div class="paying-bottom-icon">

                    <img src="{{ asset('mobile-images/PCI.png') }}" alt="icon">

                    <img src="{{ asset('mobile-images/norton.png') }}" alt="icon">

                </div>
            </div>
    </form>
</div>




@push('scripts')


<script>

document.getElementById('paymentForm').addEventListener('submit', function(e) {
    e.preventDefault();

    
    
    let recaptcha = grecaptcha.getResponse();
    if(!recaptcha) {
        document.getElementById('result-message').innerHTML ='<span class="text-danger">⚠️ Please verify reCAPTCHA</span>';
        return;
    }
   /* */


   let user_final_amount = $(".user_final_amount").html();
    user_final_amount = user_final_amount.replace('$','');
    user_final_amount = user_final_amount.replace('/mo',''); 

    
    let form = this;
    let formData = new FormData(form);
    formData.append('amount',user_final_amount);


    let month = form.querySelector('[name="expiry_month"]').value;
    let year = form.querySelector('[name="expiry_year"]').value;

    // Combine to YYYY-MM
    formData.append('expiry', year + '-' + month);
    formData.append('recaptcha',recaptcha);
    

    fetch("{{ url('authorize/pay') }}", {
    method: 'POST',
    headers: {
        'X-CSRF-TOKEN': document.querySelector('input[name=_token]').value
    },
    body: formData
})
.then(res => res.json())
.then(data => {

    if (data.status) {

        // ✅ Success UI
        document.getElementById('result-message').innerHTML =
            `<div class="alert alert-success" style="margin-top: 15px;">
                <strong>Success!</strong> ${data.message}<br>
                <small>Transaction ID: ${data.transaction_id}</small>
            </div>`;

        // ✅ Optional redirect after success
        setTimeout(() => {
            //window.location.href = "{{ url('dashboard') }}?action=invoice";
        }, 1500);

    } else {

        // ❌ Failure UI
        document.getElementById('result-message').innerHTML =
            `<span class="text-danger"> ⚠️ ${data.message || 'Payment failed'}
            </span>`;

        //document.getElementById('result-message').innerHTML ='<span class="text-danger">⚠️ Please verify reCAPTCHA</span>';

    }

})
.catch(error => {

    document.getElementById('result-message').innerHTML ='<span class="text-danger">⚠️ Something went wrong. Try again</span>';

});


});



const monthDropdown = document.getElementById('expiry_month');
const yearDropdown = document.getElementById('expiry_year');

const currentDate = new Date();
const currentYear = currentDate.getFullYear();
const currentMonth = currentDate.getMonth() + 1;

function populateMonths(selectedYear) {
    monthDropdown.innerHTML = '<option value="">Month</option>';

    let startMonth = 1;

    // If current year selected → restrict past months
    if (parseInt(selectedYear) === currentYear) {
        startMonth = currentMonth;
    }

    for (let i = startMonth; i <= 12; i++) {
        let month = i.toString().padStart(2, '0');

        let option = document.createElement('option');
        option.value = month;
        option.textContent = month;

        monthDropdown.appendChild(option);
    }
}

// On year change
yearDropdown.addEventListener('change', function () {
    populateMonths(this.value);
});

// Optional: auto-load current year months
window.addEventListener('load', function () {
    populateMonths(yearDropdown.value);
});


let input = document.getElementById('card_number_auth');

if (input) {
    input.addEventListener('input', function (e) {

        let value = e.target.value.replace(/\D/g, '');
        value = value.substring(0, 16);

        let formatted = value.replace(/(.{4})/g, '$1 ').trim();
        e.target.value = formatted;

        

    });
}
</script>


@endpush
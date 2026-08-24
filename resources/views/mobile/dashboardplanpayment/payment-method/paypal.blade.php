<div class="app-main choose-plan pln2 checkout-screen">
    <form id="payment-form" action="javascript:void(0)" method="post" >
        {{ csrf_field() }}
            <section class="plan-v1 plan-v3">
                <div class="cust-container">
                    <div class="plan-header">
                        <div class="back-btn">
                            <a href="{{url('change-plan')}}"  class="back-main"><img src="{{ asset('mobile-images/back-arrow-for-darktheme.svg') }}" alt="back" /></a>

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
				
                                <div class="cust-form-group">
                                    <label class="form-label">Card Number</label>
                                    <div id="card-number" class="paypal-field "></div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Expiry</label>
                                        <div id="expiration-date" class="paypal-field"></div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">CVV</label>
                                        <div id="cvv" class="paypal-field "></div>
                                    </div>
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


                     <button type="button" id="pay-btn" class="btn btn-primary btn-pay primary-button">
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

<script src="https://www.paypal.com/sdk/js?client-id={{ config('paypal.' . config('paypal.mode') . '.client_id') }}&currency={{ config('paypal.currency') }}&components=buttons,card-fields"></script>
<script>
        window.onload = function() {

            if (typeof paypal === 'undefined') {
                document.getElementById('result-message').innerHTML =
                    '<span class="text-danger">PayPal SDK failed to load</span>';
                return;
            }

            const cardFields = paypal.CardFields({

                style: {
                    input: {
                        'font-size': '15px',
                        'color': '#ccc',
                        'height': '40px',
                        'line-height': '40px',
                        'border-radius' : '4px',
                        'font-family' : 'Raleway, sans-serif',
                        'font-weight' : '400',
                        'width' : '50%'
                    },
                    ':focus': {
                        'color': '#ccc',
                        'box-shadow' : '0 0 0 0.1rem #000000 inset, 0 0 0 0 rgb(0 0 0 / 0%)'
                    },
                    '.invalid': {
                        'color': 'red',
                        'box-shadow' : '0 0 0 0.0425rem #d9360b inset',
                    }
                },
                createOrder: function() {

                        let recaptcha = grecaptcha.getResponse();

                        if (!recaptcha) {
                            document.getElementById('result-message').innerHTML =
                                '<span class="text-danger">⚠️ Please verify reCAPTCHA</span>';
                            return;
                        }

                        let user_final_amount = $("#payment-form .user_final_amount").html();
                        user_final_amount = user_final_amount.replace('$','');
                        user_final_amount = user_final_amount.replace('/mo','');    
                        

                        return fetch('{{url("/paypal/create-order")}}', {
                            method: 'post',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            body: JSON.stringify({

                                recaptcha: recaptcha,
                                total_price:user_final_amount

                            })
                        })
                        .then(res => res.json())
                        .then(data => data.id);
                    },

                onApprove: function(data) {
                    return fetch('{{url("/paypal/capture-order")}}', {
                            method: 'post',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            body: JSON.stringify({
                                orderID: data.orderID
                            })
                        })
                        .then(res => res.json())
                        .then(() => {
                            setLoading(false);
                            document.getElementById('result-message').innerHTML =
                                '<span class="text-success">✅ Payment Successful</span>';

                                window.location.href='/dashboard';

                               
                        });
                },

                onError: function(err) {
                    //console.log('FULL ERROR:', err);
                    setLoading(false);

                    document.getElementById('result-message').innerHTML =
                        '<span class="text-danger">❌ Payment Failed</span>';
                }
            });

            // Render fields
            cardFields.NumberField().render('#card-number');
            cardFields.ExpiryField().render('#expiration-date');
            cardFields.CVVField().render('#cvv');

            // Button click
            document.getElementById('pay-btn').addEventListener('click', function() {
                

                let recaptcha = grecaptcha.getResponse();
                if (!recaptcha) {
                    document.getElementById('result-message').innerHTML =
                        '<span class="text-danger">⚠️ Please verify reCAPTCHA</span>';
                    return;
                }

                console.log(cardFields.NumberField());

                if(!cardFields.isEligible()) {
                        
                    document.getElementById('result-message').innerHTML ='<span class="text-danger">Card fields not available</span>';
                    return;

                }

                cardFields.getState().then(function (state) {

                    // ❌ If fields are empty/invalid
                    if (!state.isFormValid) {
                        document.getElementById('result-message').innerHTML =
                            '<span class="text-danger">⚠️ Please enter valid card details first</span>';
                        return;
                    }

                    // ✅ Only now start loading + submit
                    setLoading(true);
                    cardFields.submit();
                });

               //setLoading(true);
               // cardFields.submit();

            });
        };

        function setLoading(isLoading) {

                const btn = document.getElementById('pay-btn');
                const text = document.getElementById('btn-text');
                const loader = document.getElementById('btn-loader');

                if (isLoading) {

                    btn.disabled = true;
                    text.innerText = "Please wait...";
                    loader.classList.remove('d-none');
                    document.getElementById('result-message').innerHTML = '';

                } else {
                    btn.disabled = false;
                    text.innerText = "Secure Checkout";
                    loader.classList.add('d-none');
                }

            }
</script>

@endpush
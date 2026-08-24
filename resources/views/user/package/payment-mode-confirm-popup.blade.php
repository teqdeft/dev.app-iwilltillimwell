<div class="modal fade"
    id="asking-payment-method"
    tabindex="-1"
    aria-labelledby="packageFreeTrialLabel"
    aria-hidden="true"
    data-bs-backdrop="static"
    data-bs-keyboard="false">

    <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content shadow-lg border-0 rounded-4">

            <!-- Header -->
            <div class="modal-header border-0 text-center d-block position-relative">
                <h5 class="modal-title fw-bold mb-0">
                    Choose Payment Method
                </h5>

                <!-- Single Close Button -->
                <button type="button"
                    class="btn-close position-absolute"
                    style="right:15px; top:10px;"
                   onclick="window.location.href='{{ url('dashboard') }}?action=change-plan'"
                   
                    >
                </button>
            </div>

            <!-- Body -->
            <div class="modal-body px-4 pb-4">

                <!-- Payment Options -->

                <ul class="list-unstyled mb-4">


            

                        <!-- PayPal -->

                        @if(config('services.payment_mode.paypal_status')=="enable")
                            <li class="mb-3">
                                <a href="{{ url('dashboard') }}?action=change-plan&active-tab=payment&paymentmethodselection=true&paymode=paypal"
                                class="text-decoration-none">

                                    <div class="payment-card border rounded-3 p-3 d-flex align-items-center">

                                        <div class="me-3">
                                            <img src="{{url('/assets/images/paypal.jpg')}}" height="24" alt="PayPal">
                                        </div>

                                        <div>
                                            <strong>PayPal</strong>
                                            <small class="text-muted d-block">Credit / Debit Card</small>
                                        </div>

                                    </div>
                                </a>
                            </li>
                        @endif

                        
                        @if(config('services.payment_mode.authorize_status')=="enable")
                            <!-- Authorize -->
                            <li>
                                <a href="{{ url('dashboard') }}?action=change-plan&active-tab=payment&paymentmethodselection=true&paymode=authorize"
                                class="text-decoration-none">

                                    <div class="payment-card border rounded-3 p-3 d-flex align-items-center">

                                        <div class="me-3">
                                            <img src="{{url('/assets/images/authorize.jpg')}}" height="24" alt="Authorize">
                                        </div>

                                        <div>
                                            <strong>Authorize.Net</strong>
                                            <small class="text-muted d-block">Credit Card</small>
                                        </div>

                                    </div>
                                </a>
                            </li>
                        @endif

                </ul>

               
                <!-- Button -->
                <div class="text-center">

                    <div onclick="continuePaymentSelected()" class="btn btn-primary w-50 rounded-pill fw-semibold text-center" style="margin: auto;">
                        Continue
                    </div>

                    <div id="payment-error" class="text-danger text-center mb-2" style="display:none;">
                        Please select a payment method.
                    </div>

                </div>

            </div>

        </div>
    </div>
</div>

<?php /*
<div class="modal fade"
    id="asking-google-captch"
    tabindex="-1"
    aria-labelledby="packageFreeTrialLabel"
    aria-hidden="true"
    data-bs-backdrop="static"
    data-bs-keyboard="false">

    <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content shadow-lg border-0 rounded-4">

            <!-- Header -->
            <div class="modal-header border-0 text-center d-block position-relative">
                <h5 class="modal-title fw-bold mb-0">
                    Verification
                </h5>

                <!-- Single Close Button -->
                <button type="button"
                    class="btn-close position-absolute"
                    style="right:15px; top:10px;"
                   
                   
                    >
                </button>
            </div>

            <!-- Body -->
            <div class="modal-body px-4 pb-4">

                <!-- Payment Options -->


                  

               
                <!-- Button -->
                <div class="text-center">

                    <div onclick="continuePaymentSelected()" class="btn btn-primary w-50 rounded-pill fw-semibold text-center" style="margin: auto;">
                        Continue
                    </div>

                  

                </div>

            </div>

        </div>
    </div>
</div>
*/ ?>




<style>

    #asking-payment-method .payment-card {
        cursor: pointer;
        transition: all 0.2s ease;
    }

    #asking-payment-method .payment-card:hover {
        border-color: #0d6efd;
        background-color: #f8fbff;
    }

    #asking-payment-method input[type="radio"]:checked+.payment-card {
        border: 2px solid #0d6efd;
        background-color: #eef5ff;
        box-shadow: 0 4px 10px rgba(13, 110, 253, 0.15);
    }
    #asking-payment-method .me-3 {width: 10%;}
    #asking-payment-method .payment-card img {
    height: 20px;    
    width: 100%;
    object-fit: contain;
}
</style>
<div class="modal fade" id="upgradeMyPlan" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl-cus" role="document">
            <div class="modal-content">
                <div class="modal-header theme-bg-color">
                    <h3 class="card-title mb-0 text-capitalize">Complete details</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body modal-table-body">
                    <center>
                        <h3 id="res-msg"></h3>
                    </center>
                    <div class="promo-code-sec">
                        <div class="register-right" id="step2">
                            @if( !$user->promo_code_id )
                            <div class="inner-promo-code-sec">
                                <h4 class="mb-4"><i class="fas fa-tags"></i> Have a promocode?</h4>
                                <div class="wrapper">
                                    <div class="promo-code-apply-form" name="promo-code-apply-form" id="promo-code-apply-form">
                                        <div class="from-group">
                                            <input type="text" placeholder="Enter promocode...." name="code" class="promo-text" />
                                            <button class="promo-code-apply-btn">Apply</button>
                                            <span class="promo-error" style="display:none">Please fill your promo
                                                code</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif
                            <div class="register-right-top">

                                <div class="register-form ">
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
                                                            @for($members = 1;$members <= count($monthValue['members']); $members++) 
                                                            @if( isset($monthValue['price'][$priceKey][$members]['id']) ) 
                                                            <div class="heading_title_cont">
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
                                                            <button class="but_text selectPlan 
                                                            {{ ($monthValue['price'][$priceKey][$members]['selectedPlan'])?'disabledPlan':''; }}" 
                                                            planId="{{ $monthValue['price'][$priceKey][$members]['id'] }}" data-id="{{ $monthValue['price'][$priceKey]['plan_type'][$members]['id']??'' }}" upgradePlanSelect="1">{{ ( $monthValue['price'][$priceKey][$members]['selectedPlan'] )?'Selected':'Upgrade Plan'; }}</button>
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
                                </div>
                            </div>
                            <!-- <div class="modal-footer">
                                    <div class="register-right-bottom register-button">
                                        <input type="submit" name="" class="custom-button btn btn-primary"
                                            id="selectPlan" value="Next" style="float: right;">
                                    </div>
                                </div> -->
                            </form>
                        </div>
                    </div>
                    <div class="register-right" id="step3" style='display: none;'>
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
                                                <input type="text" class="form-control" id="fname_inv" placeholder="" name="fname" value="{{ $user->fname }}">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="text">Last Name*</label>
                                                <input type="text" class="form-control" id="lname_inv" placeholder="" name="lname" value="{{ $user->lname }}">
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

                    <div class="register-right payment-card-box" id="step4" style='display: none;'>
                        <div class="register-right-top">
                            <h4 class="heading-title"><i class="far fa-credit-card"></i> Payment information <span class="fs-16 theme-color"> (Pay with Card)</span></h4>

                            <div class="register-form payment">
                                <form id="payment-form" action="{{ route('braintree.payment') }}" method="post" class="mb-4">
                                    {{ csrf_field() }}
                                    <input type="hidden" value="" name="plan" id="plan">
                                    <input type="hidden" value="1" name="upgradePlan">
                                    <!-- Putting the empty container you plan to pass to
                                                `braintree.dropin.create` inside a form will make layout and flow
                                                easier to manage -->
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
                                    <input type="submit" class="custom-button btn btn-primary" />
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
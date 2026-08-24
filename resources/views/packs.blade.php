
<link rel="stylesheet" href="{{ asset('assets/dashboard/assets/css/plan.css')}}">


    
<script> 
var promo_data=""; 
</script>

    <div class="member-plan-new">
        <div class="top">
            <div class="top-title">
                <h4 class="title">Thana you for registering {{ucfirst($monthPlan['Monthly']['uname'])}}. It's times to select your Member Program Plan!
                </h4>
            </div>
            <div class="text">
                <p>Our programs are designed to help you and your loved ones through challenging times. Stand up and
                    take your place in the universe. Don't put others in charge of who you want to have in your life.
                    Put yourself in charge and say, "I will get the help that I need until I am well." It all starts
                    with you. It's YOUR CHOICE!</p>
            </div>
        </div>
        <div class="choose-plan">

            <div class="promo-code">
                <div class="input-form" name="promo-code-apply-form" id="promo-code-apply-form" novalidate="novalidate">
                    <div class="input-here">
                        <input type="text" name="Enter promocode...." id="inputPromoCode"
                            placeholder="Enter promocode...." class="form-control promo-text">
                            
                            <input type="hidden" id="package_discount_amount"> 
                    </div>
                    <div class="apply-btn">
                        <button type="submit" class="promo-code-apply-btn theme-btn">Apply</button>
                    </div>
                    <span class="promo-error" style="display:none">Please fill your promo code</span>
                </div>
            </div>

            <div class="tab-container">

                <div class="tab-buttons">
                    <div class="max-button">
                        @if ( $memberType )
                            @foreach ($memberType as $key => $value )
                                <button onclick="tab_section({{$key}})" class="tab-button plan-tab @if($key == 1) active @endif" data-tab="tab{{$key}}">{{ $value }}</button>
                                
                            @endforeach
                        @endif
                    </div>
                </div>

                @if ( $monthPlanDouble )
                        @foreach ($monthPlanDouble as $key => $value )

                <div class="tab-content @if ($key==1) active @endif allUserPlan" id="tab{{$key}}">
                    <div class="new-card-web">
                        <div class="left-sidebar">

                            <!-- Sidebar with Tabs -->
                            <div class="sidebar">

                            @foreach ($value as $dataKey => $dataValue )
                            
                                <button class="left-tab-btn plan-info-{{$dataValue['id']}}" data-target="self-tab{{$key}}" 
                                        onclick="package_details({{$dataValue['id']}},'pack-detail')">

                                    <input type="hidden" class="plan-type" value="{{ $dataValue['type'] }}">  
                                    <input type="hidden" class="plan-name" value="{{ $dataValue['name'] }}">  
                                    <input type="hidden" class="plan-amount" value="{{ number_format($dataValue['amount'],2) }}">  
                                    <input type="radio" name="choose-plan{{$key}}" value='{{$dataValue['id']}}'  planId="{{ $dataValue['id']??'' }}" data-id="{{ $dataValue['id']??'' }}" style="opacity: 0;">


                                    <p class="plan-type">{{ $dataValue['name'] }}</p>
                                    <p class="plan-title">
                                            {{ $dataValue['name'] }} - 
                                            <span class="amount stripe-amount" data-amount="{{ number_format($dataValue['amount'],2) }}"> ${{ number_format($dataValue['amount'],2) }}</span>
                                             
                                    </p>
                                    <img src="{{ asset('assets/dashboard/assets/images/next-circle.svg')}}" alt="icon">

                                        <div class="plan-description" style="display: none">

                                            {!! html_entity_decode($dataValue['description']) !!}    
                                        </div>
                                </button>
                            @endforeach
                               

                            </div>
                            <!-- Main Content Area -->

                            <div class="content">
                                <div id="self-tab{{$key}}" class="left-tab-content left-active">
                                    <div class="purchasing">
                                        <div class="pricing-pln-v4">
                                            <div class="top">
                                                <div class="sub-title" >
                                                    <p>Purchasing</p>
                                                </div>
                                                <div class="title">
                                                    <h5 class="heading-h5 plan_name_heading"></h5>
                                                </div>
                                            </div>
                                            
                                            <div class="auto-renew" ><div class="left"><strong>Includes</strong></div></div>
                                                <div class="term-v1 cutom-checkbox">

                                                    <div class="addon-features">
                                                    @php
                                                    $include_list = getPackageIncludeList();
                                                    @endphp
                                                    @if(!empty($include_list))
                                                        @for($i = 0; $i < count($include_list); $i++)
                                                            <?php 
                                                                $class_name = getClassNamePackageList($include_list[$i]['include_ids'],'package_include');
                                                                if($class_name) {
                                                                        ?>
                                                                        <div class="service-list chek-s1 assing-pack-id <?php echo $class_name?> package_include" style="display: none;">
                                                                            <input type="checkbox" class="package_service_list" value="{{$include_list[$i]['id']}}" id="TelePet<?php echo $i?>" checked disabled>
                                                                            <label for="TelePet<?php echo $i?>" class="checkbox-container">
                                                                            <span></span><div><p><?php echo $include_list[$i]['name']?></p><p class="adon"></p></div></label>
                                                                        </div>
                                                                    <?php 
                                                                } 
                                                            ?>
                                                        @endfor       
                                                    @endif
                                                    </div>
                                                </div>

                                            @if(!empty($include_list))
                                            <div class="auto-renew optional_heading" style="display:none;"><div class="left"><strong>Optional</strong></div></div>
                                            <div class="term-v1 cutom-checkbox">
        
                                                <div class="addon-features">

                        @php
                            $selectedpackageservicelist_array = []; 
                        @endphp   
                        @if($selectedpackageservicelist)
                            @php
                                $selectedpackageservicelist_array = explode(',', $selectedpackageservicelist); // Convert comma-separated string to an array
                            @endphp
                        @endif
                        

                        @for($i = 0; $i < count($include_list); $i++)   
                            
                        <?php 
                                    $class_name = getClassNamePackageList($include_list[$i]['option_ids'],'package_option');
                                    if($class_name) {
                                ?> 
                                
                                <div id="option_id_{{$include_list[$i]['id']}}" class="@if(in_array($include_list[$i]['id'], $selectedpackageservicelist_array))  @endif service-list chek-s1 <?php echo $class_name?> package_include" style="display: none;">

                                
                                <input type="checkbox" class="package_service_list" 
                                            id="option_{{$key}}_{{$include_list[$i]['id']}}" name="package_option[]" 
                                            value="{{$include_list[$i]['id']}}"
                                            price="{{$include_list[$i]['price']}}"
                                            @if(in_array($include_list[$i]['id'], $selectedpackageservicelist_array)) checked @endif
                                            >


                                                                <label for="option_{{$key}}_{{$include_list[$i]['id']}}" class="checkbox-container">
                                                                    <div class="pri-l">
                                                                        <span></span>
                                                                        <div>
                                                                        <p>{{ $include_list[$i]['name']}}</p>
                                                                            <p class="adon">Nam nulla quam, gravida non, a, sodales sitamet,
                                                                                nisi quam lectus.</p>
                                                                        </div>
                                                                    </div>
                                                                    <p>${{ $include_list[$i]['price']}}</p>
                                                                </label>
                                </div>
                              <?php }?>

                        @endfor  
                                                   
                                                    
                                                   
                                                </div>
        
                                                
        
                                                <div class="subtotal-pay">
                                                    
                                                </div>
                                            </div>
                                            @endif                    

                                        </div>
                                    </div>

                                    <section class="plan-v1">
                                        <div class="cta">
                                            <a href="javascript:void(0);" class="primary-button get-started-button">Get Started</a>
                                        </div>   
                                    </section>
                                    
                                </div>
                            </div>

                           

                        </div>
                    </div>
                </div>

                 @endforeach
                @endif

            </div>
            <form action="{{ route('updateStep') }}" id="sign-up2-form">
                    {{ csrf_field() }}
                        <input type="hidden" name="next_step" value="3">
                        <input type="hidden" name="current_step" value="2">
                        <input type="hidden" name="promo_code_id" value="">
                        <input type="hidden" name="getPlanDetail" id="getPlanDetail" />
            </form>     
            


        </div>
    </div>



    <script>
        const tabButtons = document.querySelectorAll(".tab-button");
        const tabContents = document.querySelectorAll(".tab-content");

        tabButtons.forEach(button => {
            button.addEventListener("click", () => {
                let tabId = button.getAttribute("data-tab");
                tabButtons.forEach(btn => btn.classList.remove("active"));
                tabContents.forEach(content => content.classList.remove("active"));
                button.classList.add("active");
                document.getElementById(tabId).classList.add("active");
            });
        });
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const tabs = document.querySelectorAll(".left-tab-btn");
            const contents = document.querySelectorAll(".left-tab-content");

            tabs.forEach(tab => {
                tab.addEventListener("click", () => {
                    tabs.forEach(t => t.classList.remove("left-active"));
                    tab.classList.add("left-active");
                    contents.forEach(content => content.classList.remove("left-active"));
                    document.getElementById(tab.getAttribute("data-target")).classList.add("left-active");
                });
            });
        });
    </script>

@include('mobile.dashboardplanpayment.script')
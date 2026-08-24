@extends('layouts.default')

@section('content')
    <script type="text/javascript" src="https://js.stripe.com/v3/"></script>
    <script src="https://www.google.com/recaptcha/api.js"></script>


    <section class="imwell-wraper">
        <div class="new-container">
            <div class="imwell-inn">
                <div class="top-content">
                    <div class="im-title">
                        <h3 class="im-title-h3">Thank you for registering Kulwant. It's times to select your Member
                            Program Plan!</h3>
                    </div>
                    <div class="sub-title">
                        <p>Our programs are designed to help to help you and yuor loved ones through thi ver challenging
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
                                    <button type="submit" class="theme-btn">Apply</button>
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
              
              @if ( $monthPlan )
                <div class="tab-content" id="pills-tabContent">
                  @foreach ($monthPlan as $key => $value )
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


@endsection
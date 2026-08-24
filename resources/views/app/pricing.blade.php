@extends('layouts.default')
@section('content')
<?php //pre($monthPlan); ?>
 <div class="banner-sec information-banner inner-main-banner group-counseling-banner" style="background-image: url('assets/images/pricing-header-img.jpg');">
   <div class="cust-container">
      <div class="banner-cont">
         <h1 class="wow fadeInUp">Pricing</h1>
      </div>
   </div>
</div>
<section class="pricing-page-sec">
   <div class="cust-container">
      <div class="">
         <div class="wow fadeInUp your-plans" >
            <h2 class="theme-heading-text fs-30 mb-0 text-center lh-1">Select Your Monthly Plan</h2>
            @if ( $memberType )
             <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                @foreach ($memberType as $key => $value )
                    <li class="nav-item" role="presentation">
                        <a class="nav-link @if ( $key == 1 )
                          active
                        @endif" id="pills-home-tab" data-toggle="pill" href="#pills-{{ $key }}" role="tab" aria-controls="pills-{{ $key }}" aria-selected="true">{{ $value }}</a>
                    </li>
                @endforeach
              </ul>    
              
              @if ( $monthPlan )
                <div class="tab-content" id="pills-tabContent">
                  @foreach ($monthPlan as $key => $value )
                    <div class="tab-pane fade  @if ($key == 1) show active @endif" id="pills-{{ $key }}" role="tabpanel" aria-labelledby="pills-{{ $key }}-tab">
                      <div class="pricing-plans-outer">
                        <div class="pricing-plans pricing-plans-top d-flex  my-auto">
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
                                    <div class="button"><a href="{{ url('register') }}" class="btn btn-sm btn-secondary">Get Started</a></div>
                                  </div>
                                </div>
                              </div>
                          @endforeach

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
         </div>
      </div>
   </div>
</section>
@endsection

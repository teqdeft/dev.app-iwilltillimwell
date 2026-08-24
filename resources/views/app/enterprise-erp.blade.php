@extends('layouts.default')
@section('content')
<div class="erp-page">
   <div class="banner-sec information-banner inner-main-banner medical-banner">
      <div class="cust-container">
         <div class="banner-cont banner-enter-erp">
            @if(isset($formatedData['section1-left']) && $formatedData['section1-left']['type'] == 'text')
            {!! html_entity_decode($formatedData['section1-left']['content']) !!}
            @endif
            <div class="register-link"><a href="{{ url('behavioral-health') }}">Contact Us</a></div>
         </div>
      </div>
   </div>
   <section class="telemedicine-use-content ptb-100">
      <div class="inner-telemedicine-use-content">
         <div class="cust-container">
            @if(isset($formatedData['section2']) && $formatedData['section2']['type'] == 'text')
            {!! html_entity_decode($formatedData['section2']['content']) !!}
            @endif
            <div class="main-tu-content-box">
               @if(isset($formatedData['section3']) && $formatedData['section3']['type'] == 'text')
               {!! html_entity_decode($formatedData['section3']['content']) !!}
               @endif
               <div class="cust-container-two">
                  @if(isset($formatedData['section4']) && $formatedData['section4']['type'] == 'text')
                  {!! html_entity_decode($formatedData['section4']['content']) !!}
                  @endif
               </div>
               <hr class="my-5">
               @if(isset($formatedData['section5']) && $formatedData['section5']['type'] == 'text')
               {!! html_entity_decode($formatedData['section5']['content']) !!}
               @endif
               <hr class="my-5">
               @if(isset($formatedData['section6']) && $formatedData['section6']['type'] == 'text')
               {!! html_entity_decode($formatedData['section6']['content']) !!}
               @endif
               <hr class="my-5">
               <div class="workfroce-sec-box">
                  <div class="row">


                     <div class="col-xl-12 healthcare-problem-sec">
                        @if(isset($formatedData['section7-left']) && $formatedData['section7-left']['type'] == 'single-image')
                        <img src="{{ url($formatedData['section7-left']['section_file']) }}" alt="rgt-feature-img2">
                        @endif

                        @if(isset($formatedData['section7-right']) && $formatedData['section7-right']['type'] == 'text')
                        {!! html_entity_decode($formatedData['section7-right']['content']) !!}
                        @endif

                     </div>


                     <div class="card my-3 mx-3">
                        @if(isset($formatedData['section8']) && $formatedData['section8']['type'] == 'text')
                        {!! html_entity_decode($formatedData['section8']['content']) !!}
                        @endif

                     </div>
                     <div class="col-sm-7 col-lg-8 col-xl-8 ">
                        <div class="content-inner-box wow fadeInLeft  animated">
                           @if(isset($formatedData['section9-left']) && $formatedData['section9-left']['type'] == 'single-image')
                           <img src="{{ url($formatedData['section9-left']['section_file']) }}" alt="telemedicain-img" class="w-100 full-img">
                           @endif
                        </div>

                     </div>

                     <div class="col-sm-5 col-lg-4 col-xl-4 National-img-box">
                        <div class="content-inner-box wow fadeInRight  animated img-inner-box">
                           @if(isset($formatedData['section9-right']) && $formatedData['section9-right']['type'] == 'single-image')
                           <img src="{{ url($formatedData['section9-right']['section_file']) }}" alt="erpt-feature-img3">
                           @endif
                           <!-- <img src="{{ asset('assets/images/erpt-feature-img3.png') }}" alt="erpt-feature-img3"> -->
                        </div>
                     </div>


                     <div class="sec-footer-text py-4 px-3">
                        @if(isset($formatedData['section10']) && $formatedData['section10']['type'] == 'text')
                        {!! html_entity_decode($formatedData['section10']['content']) !!}
                        @endif

                        <!-- <div class="d-flex justify-content-between">
  <div class="com-number">
    <a href="tel:+855-399-5547">855-399-5547</a>
  </div>

  <div class="com-website">
    <a href="www.teqdeftdev.com">www.teqdeftdev.com</a>
  </div>

</div> -->
                     </div>
                  </div>
               </div>
            </div>
   </section>

   <section class="promo-home">
      <div class="inner-promo-home cust-container">
         @if(isset($formatedData['section11']) && $formatedData['section11']['type'] == 'text')
         {!! html_entity_decode($formatedData['section11']['content']) !!}
         @endif
      </div>
   </section>
</div>
@endsection
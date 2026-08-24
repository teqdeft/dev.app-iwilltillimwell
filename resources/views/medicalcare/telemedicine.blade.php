@extends('layouts.default')
@section('content')
<div class="banner-sec information-banner inner-main-banner">
  <div class="cust-container">
    <div class="banner-cont">
      <h1 class=" wow fadeInUp animated">
        @if($formatedData['section1']['type'] == 'boarding')
        @foreach($formatedData['section1']['children'] as $key => $eachValue)
        {{ $eachValue->section_title }}
        @endforeach
        @endif
      </h1>
    </div>
  </div>
</div>
<section class="information-sec">
  <div class="cust-container">
    <div class="consent-forms-contents ">
      <div class="d-flex tele-medi-fb tele-medi-common">
        <div class="col-lg-6-cus">
          <div class="wow fadeInUp animated pr-5 pb-5">
            @if(isset($formatedData['section2-left']) && $formatedData['section2-left']['type'] == 'text')
            {!! html_entity_decode($formatedData['section2-left']['content']) !!}
            @endif
            <div class="register-link mt-3 d-flex justify-content-start"><a href="{{ url('consultation-type') }}">Talk to a doctor </a></div>
          </div>
        </div>
        <div class="col-lg-6-cus">
          @if(isset($formatedData['section2-right']) && $formatedData['section2-right']['type'] == 'single-image')
          <img src="{{ url($formatedData['section2-right']['section_file']) }}" alt="telemedicain-img">
          @endif
        </div>
      </div>
    </div>
    <div class="consent-forms-contents">
      <div class="d-flex tele-medi-sb tele-medi-common">
        <div class="col-lg-6-cus">
          @if(isset($formatedData['section3-left']) && $formatedData['section3-left']['type'] == 'single-image')
          <img src="{{ url($formatedData['section3-left']['section_file']) }}" alt="telemedicain-img">
          @endif
          <!-- <img src="{{ asset('assets/images/Telemedicine-use.png') }}" alt="Telemedicine-use"> -->
        </div>
        <div class="col-lg-6-cus full-on-sm">
            <div class="wow fadeInUp  px-5 py-4 animated" style="visibility: visible; animation-name: fadeInUp;">
                @if(isset($formatedData['section3-right']) && $formatedData['section3-right']['type'] == 'text')
                {!! html_entity_decode($formatedData['section3-right']['content']) !!}
                @endif
                <div class="register-link mt-3 d-flex justify-content-start"><a href="{{ url('consultation-type') }}">Talk to a doctor </a></div>
            </div>
          <!-- @if(isset($formatedData['section2-left']) && $formatedData['section2-left']['type'] == 'text')
          {!! str_replace('register_url', route('register'),html_entity_decode($formatedData['section2-left']['content'])) !!}
          @endif -->
        </div>
      </div>
    </div>
  </div>
</section>
<section class="saves-time-sec">
  <div class="inner-saves-time-sec">
    <div class="cust-container-two">
      <div class="row">
        @if($formatedData['section4']['type'] == 'galleryt2')
        @foreach($formatedData['section4']['children'] as $key => $eachValue)
        <div class="col-lg-6">

          <div class="inner-child-st-sec wow fadeInLeft animated">
            <img src="{{  url($eachValue->section_file) }}" alt="time-save">
            <h4>{{ $eachValue->section_title }}</h4>
            <p>{{ $eachValue->section_content }}</p>
          </div>
        </div>
        @endforeach
        @endif
      </div>
    </div>


  </div>

</section>
<section class="telemedicine-use-content ptb-100">
  <div class="inner-telemedicine-use-content">
    @if(isset($formatedData['section5']) && $formatedData['section5']['type'] == 'text')
    {!! html_entity_decode($formatedData['section5']['content']) !!}
    @endif
  </div>

</section>
<section class="promo-home">
  @if(isset($formatedData['section6']) && $formatedData['section6']['type'] == 'text')
  {!! html_entity_decode($formatedData['section6']['content']) !!}
  @endif
</section>
@endsection

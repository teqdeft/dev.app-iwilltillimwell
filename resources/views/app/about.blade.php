 @extends('layouts.default')
 @section('content')
 <div class="banner-sec information-banner inner-main-banner about-us-banner">
    <div class="cust-container">
       <div class="banner-cont">
          @if(isset($formatedData['section1-left']) && $formatedData['section1-left']['type'] == 'text')
          {!! html_entity_decode($formatedData['section1-left']['content']) !!}
          @endif
       </div>
    </div>
 </div>
 <section class="information-sec">
    <div class="cust-container">
       <div class="consent-forms-contents theme-white-bg theme-pxy-50 theme-border-radius">
          @if(isset($formatedData['section2']) && $formatedData['section2']['type'] == 'text')
          {!! html_entity_decode($formatedData['section2']['content']) !!}
          @endif
       </div>
    </div>
 </section>
 @endsection
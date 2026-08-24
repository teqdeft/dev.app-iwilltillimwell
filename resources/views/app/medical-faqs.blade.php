@extends('layouts.default')
@section('content')
<div class="banner-sec information-banner inner-main-banner medical-banner">
   <!-- <div class="cust-container">
      <div class="banner-cont">
         <h1 class=" wow fadeInUp animated">Medical</h1>
         <h4 class="wow fadeInUp  text-white animated text-capitalize" >frequently asked questions</h4>
      </div>
   </div> -->
   @if(isset($formatedData['section1-left']) && $formatedData['section1-left']['type'] == 'text')
   {!! html_entity_decode($formatedData['section1-left']['content']) !!}
   @endif
</div>
<section class="information-sec faq-page pt-5">
   @if(isset($formatedData['section2']) && $formatedData['section2']['type'] == 'text')
   {!! html_entity_decode($formatedData['section2']['content']) !!}
   @endif
</section>
@endsection
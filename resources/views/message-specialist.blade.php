@extends('layouts.default')
@section('content')
<div class="banner-sec tele-counseling-banner inner-main-banner">
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
      <div class="consent-forms-contents theme-white-bg theme-pxy-50 theme-border-radius">
         @if(isset($formatedData['section2']) && $formatedData['section2']['type'] == 'text')
         {!! html_entity_decode($formatedData['section2']['content']) !!}
         @endif
         <div class="section-head style-3 text-center mb-5">
            @if(isset($formatedData['section3']) && $formatedData['section3']['type'] == 'text')
            {!! html_entity_decode($formatedData['section3']['content']) !!}
            @endif
            <div class="dlab-separator style-2 bg-primary"></div>
         </div>
         <div class="row">

            @if($formatedData['section4']['type'] == 'galleryt2')
            @foreach($formatedData['section4']['children'] as $key => $eachValue)
            <div class="col-xl-4 wow fadeInUp" data-wow-duration="2s" data-wow-delay="0.2s">
               <div class="dlab-blog blog-half m-b30">
                  <div class="dlab-media"><img src="{{ url($eachValue->section_file) }}" alt="general-Practitioners"></div>
                  <div class="dlab-info">
                     <h5 class="dlab-title">{{ $eachValue->section_title }}</h5>
                     <p>{{ $eachValue->section_content }}</p>
                  </div>
               </div>
            </div>
            @endforeach
            @endif
         </div>
      </div>
   </div>
</section>

@endsection
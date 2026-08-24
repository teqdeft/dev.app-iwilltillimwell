@extends('layouts.default')
@section('content')
<div class="banner-sec information-banner inner-main-banner grief-loss-banner">
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
      @if(isset($formatedData['section2']) && $formatedData['section2']['type'] == 'text')
      {!! html_entity_decode($formatedData['section2']['content']) !!}
      @endif
   </div>
</section>
@endsection
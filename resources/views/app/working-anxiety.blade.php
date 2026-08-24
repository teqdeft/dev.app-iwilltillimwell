@extends('layouts.default')
@section('content')
<div class="banner-sec information-banner inner-main-banner anxiety-banner">
   <div class="cust-container">
      <div class="banner-cont">
         <h1 class=" wow fadeInUp animated">Working with an Anxiety</h1>
      </div>
   </div>
</div>
<section class="information-sec">
   @if(isset($formatedData['section1']) && $formatedData['section1']['type'] == 'text')
   {!! html_entity_decode($formatedData['section1']['content']) !!}
   @endif
</section>
@endsection
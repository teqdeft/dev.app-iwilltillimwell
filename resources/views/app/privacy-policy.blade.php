@extends('layouts.default')
@section('content')
@php $img = $formatedData['section2']['section_file']; @endphp
<div class="banner-sec information-banner inner-main-banner pet-faq-banner" style='background:url("{{ $img }}")'>
   <div class="cust-container">
      <div class="banner-cont">
         <h1 class=" wow fadeInUp animated">{!! html_entity_decode($formatedData['section1']['content']) !!}</h1>
      </div>
   </div>
</div>
<section class="information-sec faq-page pt-5">
   <div class="cust-container">
      <div class="row  my-4 mb-3 pd-l-2 ">
         <h3>Privacy Policy</h3>
      </div>
      <div class="theme-white-bg theme-pxy-50 theme-border-radius">
         <div class="row">
            {!! html_entity_decode($formatedData['section3']['content']) !!}
         </div>
      </div>
   </div>
   </div>
</section>
@endsection

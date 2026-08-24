@extends('layouts.default')
@section('content')


@php $image = $formatedData['section1']['section_file']??''; @endphp
<div class="banner-sec information-banner inner-main-banner brochure-banner" style="background:url({{$image}})">
   <div class="cust-container">
      <div class="banner-cont">
         <h1 class=" wow fadeInUp animated">{!! html_entity_decode($formatedData['section-title']['content']??'') !!}</h1>  
      </div>
   </div>
</div>
<section class="information-sec qr-codes">
   <div class="cust-container">
      <div class="consent-forms-contents theme-white-bg theme-pxy-50 theme-border-radius">
         <div class="wow fadeInUp animated">
            <h2 class="theme-heading-text fs-30 mb-0 text-center lh-1">All Brochures</h2>
           
            <ul class="mt-5">
               @if ( isset($formatedData['section3']['children']) && !empty($formatedData['section3']['children']) )
                  @foreach ($formatedData['section3']['children'] as $value )
                        <li>	<a href="{{ url('brochures') }}/{{ $value->slug }}" class="theme-color" target="_blank"> <img src="{{ asset($value->section_file) }}" alt="brochure"> {{ $value->section_title }}</a> </li>
                  @endforeach
               @endif               
            </ul>

   

         </div>
      </div>
   </div>
</section>
@endsection

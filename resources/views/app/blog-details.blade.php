@extends('layouts.default')
@section('content')
<div class="banner-sec information-banner inner-main-banner blog-banner blog-details-banner" style="background-image:url({{url('/assets/images/blog-bg.jpg')}})">
   <div class="cust-container">
      <div class="banner-cont">
         <span><a href='{{ url("blogs/") }}'>Blogs</a> </span> <i class="fas fa-slash"></i> <strong> Post</strong>
      </div>
   </div>
</div>
<section class="information-sec blog-details ">
   <div class="cust-container">


   <div class="consent-forms-contents theme-white-bg theme-pxy-50 theme-border-radius ">

        <div class="title-box w-100 mb-4">
          <h1 class="theme-heading-text fs-30 mb-0 text-center lh-1 theme-color">{{ ucfirst($blog->title) }}</h1>


        </div>
          <div class="blog-info-img">
            <div class="inner-sec">
              <img src="{{ asset($blog->banner) }}" alt="{{ $blog->title }}">
            </div>
        </div>
        <div class="col-sm-12 mb-3">
            <div class="content-inner-box">
               <p>{!! html_entity_decode($blog->post) !!}</p>
            </div>
         </div>

   </div>
</section>
@endsection

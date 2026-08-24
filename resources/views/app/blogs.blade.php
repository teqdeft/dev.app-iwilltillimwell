@extends('layouts.default')
@section('content')
<style>
.information-sec .consent-forms-contents li::before {
    content: ' ';
    position: absolute;
    left: 0px;
    top: 0px;
    width: 0px;
    height: 0px;
    border-radius: 0%;
    background: none;
}
.information-sec .consent-forms-contents li {
     font-size: 18px;
     line-height: 28px;
     padding: 0px;
     position: relative;
     padding-left: 0px;
}
</style>
<div class="banner-sec information-banner inner-main-banner blog-banner" style="background-image:url({{url('/assets/images/blog-bg.jpg')}})">
   <div class="cust-container">
      <div class="banner-cont">
         <h1 class=" wow fadeInUp animated">Blogs</h1>
      </div>
   </div>
</div>

<section class="information-sec blog-list">
   <div class="cust-container">
      <div class="sort-blog-btns">
         <ul>
            <li class="{{ !request()->category_id ? 'active' : '' }}"><a href="{{ url('blogs') }}">All</a></li>
            @if($categories && count($categories) > 0 )
               @foreach($categories as $category)
                  <li class="{{ request()->category_id==$category->id ? 'active' : '' }}"><a href="{{ url('blogs/'.$category->id) }}">{{ $category->name }} </a></li>
               @endforeach
            @endif
         </ul>
      </div>
      <div class="consent-forms-contents theme-white-bg theme-pxy-50 theme-border-radius">
         <div class="row">
           @if($blogs && count($blogs) > 0 )
              @foreach($blogs as $value)
                <div class="col-sm-4">
                   <a href='{{ url("blog-details/{$value->slug}") }}'>
                      <div class="card">
                         <div class="blog-thunb-img">
                            <img src='{{ asset($value->thumbnail) }}'>
                         </div>
                         <div class="infos">
                            <p class="text">{{ substr(ucfirst($value->title),0,21) }}{{ (strlen($value->title) > 22 )?'...':'' }}</p>
                            <div class="foot-info">
                               <span class="date">{{ date('F d, Y',strtotime($value->created_at)) }}</span>
                               <i class="fas fa-long-arrow-alt-right" ></i>
                            </div>
                         </div>
                      </div>
                   </a>
                </div>
              @endforeach
              <div class="col-md-12">
                {!! $blogs->links() !!}
              </div>
            @else
            <div class="col-sm-12">
               <p class="text" style="text-align: center;">Coming Soon</p>
            </div>
            @endif
         </div>
      </div>
   </div>
</section>


@endsection

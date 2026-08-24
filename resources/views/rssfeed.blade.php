@extends('layouts.default')
@section('content')
@if( !$healthy )
    <style>
        .blog-thunb-img p{
            display: none;;
        }
    </style>
@endif
<div class="banner-sec topic-container information-banner inner-main-banner blog-banner" style="background-image:url({{url('/assets/images/blog-bg.jpg')}})">
   <div class="cust-container">
      <div class="banner-cont">
         <h1 class=" wow fadeInUp animated">Topics</h1>
      </div>
   </div>
</div>

<section class="information-sec blog-list">
   <div class="cust-container">
        <div class="sort-blog-btns">
            <ul>
               @if( !$allTabs->isEmpty() )
                  @foreach($allTabs as $key => $value)
                     <li class="{{ ($value->slug == 'inspirational')?'inspirational':'healthy_food'; }} {{ ($value->slug == Request::segment(2))?'active':''; }}">
                        <a href='{{ url("topics/{$value->slug}") }}'>{{ ucfirst($value->tab_name) }}</a>
                     </li>
                  @endforeach
               @endif
            </ul>
        </div>
        <div class="consent-forms-contents theme-white-bg theme-pxy-50 theme-border-radius">
         <div class="row">
           @if($xmlData && count($xmlData) > 0 )
              @foreach($xmlData as $value)
                @php $value = (Object)$value; @endphp
                @if( !$healthy )
                <div class="col-sm-4">
                   <a href='{{ url("{$value->link}") }}'>
                      <div class="card">
                         <div class="blog-thunb-img">
                            {!! html_entity_decode($value->encode) !!}
                         </div>
                         <div class="infos">
                            <p class="text">{{ ucfirst($value->title) }}</p>
                            <div class="foot-info">
                               <span class="date">{{ date('F d, Y',strtotime($value->pubDate)) }}</span>
                               <i class="fas fa-long-arrow-alt-right" ></i>
                            </div>
                         </div>
                      </div>
                   </a>
                </div>
                @else
                <div class="healthy_food_content">
                  {!! html_entity_decode($value->encode) !!}
                </div>
                @endif
              @endforeach
            @else
            <div class="col-sm-12">
               <p class="text" style="text-align: center;">Comming Soon</p>
            </div>
            @endif
          </div>
         </div>
      </div>
      
   </div>
</section>


@endsection
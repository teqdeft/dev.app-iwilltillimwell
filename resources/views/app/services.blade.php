@extends('layouts.services')
@section('content')
<style>
.dropdown-overlay {
  width: 100%;
  height: 100%;
  background-color: transparent;
  position: absolute;
  display: none;
}
.dropdown.dropup {
  padding-top: 100px;
}
.dropdown.dropup .slide-menu {
  margin-bottom: -1px;
  bottom: 28%;
  top: auto;
}

.btn.focus, .btn:focus{
    outline: 0;
    box-shadow: none !important;
}

.servicesDropdown a {
    border: none !important;
    color: #000 !important;
    text-align:center;
    font-size: 15px !important;
    font-weight: 400 !important;
}

</style>

@include('includes.services.header')
<div class="banner">
    <div class="banner-top">
        <div class="container">
            <div class="row">
                <div class="col-md-5">
                    <h1>{{ $company['banner']['title']??'' }}</h1>
                    <p>@if ( isset($company['banner']['description'] ))
                        {!! $company['banner']['description'] !!}
                    @endif</p>
                    @if ( isset(Auth::user()->id) )
                        <a class="btn-style1" href="{{ url('feels/user-mood') }}" >What's your mood</a>
                    @else
                        <a class="btn-style1" href="{{ url('services-login') }}" >What's your mood</a>
                    @endif
                </div>
                <div class="col-md-7">
                    <div class="banner-pic">
                        <div class="banner-pic-inn">
                            <img src="{{ asset('assets/services/images/banner-img.png' ) }}" alt="banner-img">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="banner-bottom">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="banner-bottom-inner">
                        <h3>{{ $company['compnay-details']['title']??'' }}</h3>
                        @if (isset($company['compnay-details']['description']))
                            <p>{!! $company['compnay-details']['description'] !!}</p>    
                        @endif
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="services">
    <div class="container">
        <h2>Our Services</h2>
    </div>
    @if (isset($company['emotional-wellness']['status']) && $company['emotional-wellness']['status'] )
    <div class="services-section before-left">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="service-img service-img-first"><img src="{{ asset($company['emotional-wellness']['image'][0]['image']??'/') }}"></div>
                </div>
                <div class="col-lg-6">
                    <div class="service-content">
                        <h3>{{ $company['emotional-wellness']['title'] }}</h3>
                        <p><?= html_entity_decode($company['emotional-wellness']['description']); ?></p>
                        <div class="row">
                            @if( isset($company['emotional-wellness']['child']) &&
                            !empty($company['emotional-wellness']['child']) )
                            @foreach ($company['emotional-wellness']['child'] as $key => $value )
                            <div class="col-md-6">
                                <h5>{{ $value['title'] }}</h5>
                                <p>{{ $value['description'] }}</p>
                                @if ($key == 0)
                                <a href="#" class="btn-style1">Talk to Therapist</a>
                                @else
                                <a href="#" class="btn-style1">Learn More</a>
                                @endif
                            </div>
                            @endforeach
                            @endif
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>
    @endif
    @if (isset($company['medical-care']['status']) && $company['medical-care']['status'] )
    <div class="services-section after-right" id="medical-care">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="service-content">
                        <h3>{{ $company['medical-care']['title'] }}</h3>
                        <p><?= html_entity_decode($company['medical-care']['description']); ?></p>
                        <a href="#" class="btn-style1">Talk to Doctor</a>
                        <a href="#" class="btn-style1">Learn More</a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="service-img service-img-slide">
                        <div id="medical-care-slider" class="carousel slide" data-interval="false" data-ride="carousel">

                            <div class="carousel-inner">
                                @if( isset($company['medical-care']['image']) &&
                                !empty($company['medical-care']['image']) )
                                @foreach ($company['medical-care']['image'] as $key => $value )
                                <div class="carousel-item @if ( $key == 0 )
                                        active
                                    @endif">
                                    <img src="{{ asset($value['image']) }}">
                                </div>
                                @endforeach
                                @endif
                            </div>
                            <a class="carousel-control-prev" href="#medical-care-slider" data-slide="prev">
                                <span class="carousel-control-prev-icon"></span>
                            </a>
                            <a class="carousel-control-next" href="#medical-care-slider" data-slide="next">
                                <span class="carousel-control-next-icon"></span>
                            </a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    @endif
    @if (isset($company['tele-pet-now']['status']) && $company['tele-pet-now']['status'] )
    <div class="services-section before-left" id="tele-pet-now">
        <div class="container">

            <div class="row">
                <div class="col-lg-6">
                    <div class="service-img service-img-slide">
                        <div id="pet-health-slider" class="carousel slide" data-interval="false" data-ride="carousel">

                            <div class="carousel-inner">
                                @if( isset($company['tele-pet-now']['image']) &&
                                !empty($company['tele-pet-now']['image']) )
                                @foreach ($company['tele-pet-now']['image'] as $key => $value )
                                <div class="carousel-item @if ( $key == 0 )
                                                active
                                            @endif">
                                    <img src="{{ asset($value['image']) }}">
                                </div>
                                @endforeach
                                @endif
                            </div>

                            <a class="carousel-control-prev" href="#pet-health-slider" data-slide="prev">
                                <span class="carousel-control-prev-icon"></span>
                            </a>
                            <a class="carousel-control-next" href="#pet-health-slider" data-slide="next">
                                <span class="carousel-control-next-icon"></span>
                            </a>

                        </div>


                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="service-content">
                        <h3>{{ $company['tele-pet-now']['title'] }}</h3>
                        <p><?= html_entity_decode($company['tele-pet-now']['description']); ?></p>
                        <a href="#" class="btn-style1">Talk to Veterinary</a>
                        <a href="#" class="btn-style1">Learn More</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>
<div>
    <div class="text-center QuizOuter">
        <div class="container">
            <div class="QuizOuterInn">
                <div class="QuizBtnGroup">
                    <h2>Take our Mental Health Screenings</h2>
                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. but also the leap into electronic typesetting.</p>
                    <a class="btn-style1" href="{{ url('anxiety/'.$company_selected.'/give-consent') }}"">Anxiety Screenings</a>
                <a class=" btn-style1" href="{{ url('depression/'.$company_selected.'/give-consent') }}"">Depression Screenings</a>
            </div>
        </div>
    </div>
</div>
</div>



<div class=" news-section">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12">
                                    <h2>Resources, news, and events</h2>
                                </div>
                            </div>
                        </div>
                        <div id="mentalhealthwellness" class="blog-mental-health">
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-12">
                                        <h3 style="margin-bottom: 0px;">Mental Health Wellness</h3>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="blog-inner blog-mental-slide">
                                            @if ( isset($xmlData['mentalHealth']) && !empty($xmlData['mentalHealth']) )
                                            <?php foreach ($xmlData['mentalHealth'] as $key => $value) { ?>
                                                <div class="blog-item">
                                                    <div class="blog-img">
                                                        <a href="#"><img src="{{ $value['image'] }}"></a>
                                                    </div>
                                                    <div class="blog-content">
                                                        <p class="date">{{ jsConvertPhpDate($value['pubDate']) }}</p>
                                                        <h4><a href="#">{{ $value['title'] }} </a></h4>
                                                        <p>{{ $value['description'] }}</p>
                                                    </div>
                                                </div>
                                            <?php } ?>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="blog-body-care" style="display:none">
                            <div class="container">
                                <div class="row">
                                    <div id="medicalcare" class="col-lg-8">
                                        <h3>Medical Care</h3>
                                        <div class="bc-inner">
                                            <div class="bc-blog-item">
                                                <div class="bc-blog-img">
                                                    <a href="#"><img src="{{ asset('assets/services/images/bc-blog-pic1.png') }}" alt=""></a>
                                                </div>
                                                <div class="bc-blog-content">
                                                    <h4><a href="#">Lorem Ipsum is simply dummy text of the printing.</a></h4>
                                                    <p>When an unknown printer took a galley of type and scrambled it to make a type
                                                        specimen book. It has survived not only five centuries.</p>
                                                </div>
                                            </div>
                                            <div class="bc-blog-item">
                                                <div class="bc-blog-img">
                                                    <a href="#"><img src="{{ asset('assets/services/images/bc-blog-pic2.png') }}" alt=""></a>
                                                </div>
                                                <div class="bc-blog-content">
                                                    <h4><a href="#">Lorem Ipsum is simply dummy text of the printing.</a></h4>
                                                    <p>When an unknown printer took a galley of type and scrambled it to make a type
                                                        specimen book. It has survived not only five centuries.</p>
                                                </div>
                                            </div>
                                            <div class="bc-blog-item">
                                                <div class="bc-blog-img">
                                                    <a href="#"><img src="{{ asset('assets/services/images/bc-blog-pic3.png') }}" alt=""></a>
                                                </div>
                                                <div class="bc-blog-content">
                                                    <h4><a href="#">Lorem Ipsum is simply dummy text of the printing.</a></h4>
                                                    <p>When an unknown printer took a galley of type and scrambled it to make a type
                                                        specimen book. It has survived not only five centuries.</p>
                                                </div>
                                            </div>
                                            <div class="bc-blog-item">
                                                <div class="bc-blog-img">
                                                    <a href="#"><img src="{{ asset('assets/services/images/bc-blog-pic4.png') }}" alt=""></a>
                                                </div>
                                                <div class="bc-blog-content">
                                                    <h4><a href="#">Lorem Ipsum is simply dummy text of the printing.</a></h4>
                                                    <p>When an unknown printer took a galley of type and scrambled it to make a type
                                                        specimen book. It has survived not only five centuries.</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="physicalwellness" class="col-lg-4" style="display:none">
                                        <div class="col-right-box">
                                            <h3>Physical Wellness</h3>
                                            <div class="pw-inner">
                                                <div class="pw-blog-item">
                                                    <div class="pw-blog-img">
                                                        <a href="#"><img src="{{ asset('assets/services/images/pw-blogpic1.png') }}" alt=""></a>
                                                    </div>
                                                    <div class="pw-blog-content">
                                                        <h6><a href="#">Lorem Ipsum is simply dummy text of the printing and typesetting</a>
                                                        </h6>

                                                    </div>
                                                </div>
                                                <div class="pw-blog-item">
                                                    <div class="pw-blog-img">
                                                        <a href="#"><img src="{{ asset('assets/services/images/pw-blogpic1.png') }}" alt=""></a>
                                                    </div>
                                                    <div class="pw-blog-content">
                                                        <h6><a href="#">Lorem Ipsum is simply dummy text of the printing and typesetting</a>
                                                        </h6>

                                                    </div>
                                                </div>
                                                <div class="pw-blog-item">
                                                    <div class="pw-blog-img">
                                                        <a href="#"><img src="{{ asset('assets/services/images/pw-blogpic1.png') }}" alt=""></a>
                                                    </div>
                                                    <div class="pw-blog-content">
                                                        <h6><a href="#">Lorem Ipsum is simply dummy text of the printing and typesetting</a>
                                                        </h6>

                                                    </div>
                                                </div>
                                            </div>
                                            <p>&nbsp;</p>
                                        </div>

                                        <div id="financialwellness" class="col-right-box" style="display:none">
                                            <h3>Financial Wellness</h3>
                                            <div class="pw-inner">
                                                @if ( isset($xmlData['mentalHealth']) && !empty($xmlData['mentalHealth']) )
                                                <?php foreach ($xmlData['financial'] as $key => $value) { ?>
                                                    <div class="pw-blog-item">
                                                        <div class="pw-blog-img">
                                                            <a href="#"><img src="{{ $value['image'] }}" alt=""></a>
                                                        </div>
                                                        <div class="pw-blog-content">
                                                            <h6><a href="#">{{ $value['title'] }}</a>
                                                            </h6>
                                                        </div>
                                                    </div>
                                                <?php } ?>
                                                @endif
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
                

                @endsection



                <script>
                    function openNav() {
                        document.getElementById(" myNav").style.width = "100%";
                    }

                    function closeNav() {
                        document.getElementById("myNav").style.width = "0%";
                    }
                </script>
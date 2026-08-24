@extends('layouts.default')
@section('content')
@php $img = $formatedData['section1']['section_file']; @endphp
<div class="banner-sec information-banner inner-main-banner pet-faq-banner" style='background:url("{{ $img }}")'>
    <div class="cust-container">
        <div class="banner-cont">
            <h1 class=" wow fadeInUp animated">{!! html_entity_decode($formatedData['section-title']['content']) !!}</h1>
        </div>
    </div>
</div>
<section class="information-sec pet-telehealth-wrapper">
    <div class="cust-container">
        <div class="consent-forms-contents theme-white-bg  theme-border-radius">
            <section class="information-sec py-0">
                <div class="cust-container">
                    <div class="consent-forms-contents ">
                        <div class="d-flex tele-medi-fb tele-medi-common">

                            <div class="col-lg-6-cus">
                                <div class="wow fadeInUp  pr-5 pb-5 animated">
                                    {!! html_entity_decode($formatedData['section3']['content']) !!}
                                </div>
                            </div>
                            <div class="col-lg-6-cus">
                                <img src="{{ asset('assets/images/pet-img1.jpg') }}" alt="Telemedicine-use">
                                
                                 @auth
                                  <a href="{{ url('/pet-consultations') }}" class="btn btn-primary mr-3" style="height: 40px;">Speak to a Veterinarian</a>
                                  
                                  @else
                                  <a href="{{ url('/login') }}" class="btn btn-primary mr-3" style="height: 40px;">Speak to a Veterinarian</a>
                                  @endauth
                  
                                
                            </div>
                        </div>
                    </div>
                    <div class="consent-forms-contents">
                        <div class="row tele-medi-sb tele-medi-common">

                            <div class="col-lg-12 px-0">
                                 {!! html_entity_decode($formatedData['section5']['content']) !!}
                            </div>
                            <div class="col-sm-6 mt-4">
                                <img src="{{ asset('assets/images/pet-img2.jpg') }}" alt="Telemedicine-use">
                                
                            </div>
                            <div class="col-sm-6">
                                <div class="anxiety-content-box mb-5 mt-4">
                                   {!! html_entity_decode($formatedData['section6']['content']) !!}
                                </div>


                            </div>

                            <div class="col-sm-12 mt-5">
                                {!! html_entity_decode($formatedData['section7']['content']) !!}
                            </div>
                        </div>
                    </div>
            </section>

        </div>
    </div>
</section>
@endsection
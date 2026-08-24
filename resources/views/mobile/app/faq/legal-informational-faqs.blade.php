@extends("mobile.layouts.default")
@section("content")
<div class="app-main">
    @include('mobile.includes.frontend-menu' , ['heading' =>"Support & Faqs",'back_url'=>"support-and-faqs"])
    
    <section class="faq-pay-detail">
        <div class="cust-container">
            <div class="title">
                <p>Legal Information Faq</p>
            </div>
            <div class="faq-link-main" id="faq-list">
                <?php /* 
                @if(isset($formatedData['section1-left']) && $formatedData['section1-left']['type'] == 'text')
                {!! html_entity_decode($formatedData['section1-left']['content']) !!}
                @endif
                */ ?>
                @if(isset($formatedData['section2']) && $formatedData['section2']['type'] == 'text')
                {!! html_entity_decode($formatedData['section2']['content']) !!}
                @endif

            </div>
            @include('mobile.app.faq.faq-ans-slide-list')
        </div>
    </section>
</div>
@endsection
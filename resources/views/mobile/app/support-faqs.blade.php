@extends("mobile.layouts.default")
@section("content")
<div class="app-main">
    @include('mobile.includes.frontend-menu' , ['heading' => 'Support & Faqs'])
    @foreach ($faq_list as $data)   
        <section class="faq-pay-detail">
            <div class="cust-container">
                <a href="{{ url($data->slug) }}">
                    <div class="title">
                        <p>{{$data->page_name}}</p>
                    </div>
                  </a>
                <hr/>
            </div>
        </section>
    @endforeach
</div>
@endsection
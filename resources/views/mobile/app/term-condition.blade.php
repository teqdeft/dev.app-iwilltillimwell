@extends("mobile.layouts.default")
@section("content")
<div class="app-main">
    @include('mobile.includes.frontend-menu' , ['heading' => 'Term Condition'])
    <section class="privacy-policy-main">
        <div class="cust-container">
            <div class="pvc-min">
                <div class="detail">
                    {!! html_entity_decode($formatedData['section3']['content']) !!}    
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
@extends("mobile.layouts.dashboard")
@section("content")
<section class="msg-special-header">
        <div class="cust-container-md">
            <div class="rec-row">
                <div class="back">
                    <a href="{{ route('mobile-dashboard')}}" class="back-btn">
                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M12.875 16.0417L7.33334 10.5L12.875 4.95834" stroke="#222A3D" stroke-width="1.58333" stroke-linecap="round" stroke-linejoin="round"></path>
                        </svg>
                    </a>
                </div>
                <div class="top-title">
                    <h2 class="title">Mental Health Screenings</h2>
                </div>
            </div>
        </div>
</section>
@if(LoginUserBToBVerification())
<section class="specilist-list">
    <div class="cust-container-md">
        <div class="title">
            <p>What type of screening would you like to start with.</p>
        </div>

        <div class="list-row">

            <div class="list-card">
                <a href="{{ url('anxiety/my-organization/give-consent') }}">
                    <div class="icon">
                        <img src="{{ asset('msgspec/AnxietyScreenings-v1.svg') }}" alt="image">
                    </div>
                    <div class="detail">
                        <p>Anxiety Screenings</p>
                    </div>
                </a>
            </div>

            <div class="list-card">
                <a href="{{ url('depression/my-organization/give-consent') }}">
                    <div class="icon">
                        <img src="{{ asset('msgspec/DepressionScreenings-v1.svg') }}" alt="image">
                    </div>
                    <div class="detail">
                        <p>Depression Screenings</p>
                    </div>
                </a>
            </div>

            <div class="list-card">
                <a href="{{ url('abuse/my-organization/give-consent') }}">
                    <div class="icon">
                        <img src="{{ asset('msgspec/AlcoholSubstanceAbuse-v1.svg') }}" alt="image">
                    </div>
                    <div class="detail">
                        <p>Alcohol & Substance Abuse</p>
                    </div>
                </a>
            </div>

        </div>

    </div>
   </section>

@else 
    <section class="written-journal">
        <div class="cust-container-md">
        {{ LoginUserBToBVerificationMSG() }}
        </div>
</section>    
@endif

@include('mobile.includes.foooter-tab')
@endsection
@extends("mobile.layouts.dashboard")
@section("content")

<section class="record-header">
        <div class="cust-container-md">
            <div class="rec-row">
                <div class="back">
                    <a href="{{ url('mental-health-screening')}}" class="back-btn">
                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M12.875 16.0417L7.33334 10.5L12.875 4.95834" stroke="#222A3D" stroke-width="1.58333" stroke-linecap="round" stroke-linejoin="round"></path>
                        </svg>
                    </a>
                </div>
                <div class="top-title">
                    <h2 class="title">Mental Health Screenings<p></p>
                </h2></div>
                <div class="screen-number d-n">
                    <p>&nbsp;</p>
                </div>
            </div>
        </div>
</section>

@if(LoginUserBToBVerification())
<section class="custom-tab tab-edit-v2">
        <div class="cust-container-lg">
            <div class="tab-container">
                <div class="tab-header account-tab">
                    <!-- Tab Buttons -->
                    <div class="tab-buttons detail">
                        <button class="tab-link <?php if($quiz_type==1) { ?> active <?php } ?>" data-tab="anxiety">Anxiety Screenings</button>
                        <button class="tab-link <?php if($quiz_type==2) { ?> active <?php } ?>" data-tab="depression">Depression Screenings</button>
                        <button class="tab-link <?php if($quiz_type==3) { ?> active <?php } ?>" data-tab="alcohol">Alcohol & Substance Abuse</button>
                    </div>
                </div>

                <div class="tab-content-detail account-edit-tab">
                     @include('mobile.app.mental-health-screening.anxiety-screenings')
                </div>
            </div>
        </div>
    </section>


    <script>
        const tabLinks = document.querySelectorAll('.tab-link');
        const tabContents = document.querySelectorAll('.tab-content');
        const tabButtonsContainer = document.querySelector('.tab-buttons');

        tabLinks.forEach(link => {
            link.addEventListener('click', () => {
                let url = "";
                const clickedTabName = event.currentTarget.getAttribute('data-tab');
                if(clickedTabName=="anxiety"){
                    url = "{{ url('anxiety/my-organization/give-consent') }}";
                } else if(clickedTabName=="depression"){
                    url = "{{ url('depression/my-organization/give-consent') }}";
                } else if(clickedTabName=="alcohol"){
                    url = "{{ url('abuse/my-organization/give-consent') }}";
                }
                window.location.href=url;
            });
        });


let activeTab = document.querySelector('.tab-link.active');    
if (activeTab) {
    setTimeout(() => {
            const buttonRect = activeTab.getBoundingClientRect();
            const containerRect = tabButtonsContainer.getBoundingClientRect();
            const offset = buttonRect.left - containerRect.left - containerRect.width / 2 + buttonRect.width / 2;
            tabButtonsContainer.scrollBy({
                left: offset,
                behavior: 'smooth'
            });
    }, 100);
}       
</script>

@else 
    <section class="written-journal">
        <div class="cust-container-md">
        {{ LoginUserBToBVerificationMSG() }}
        </div>
</section>    
@endif

@include('mobile.includes.foooter-tab')

<?php /*
<link rel="stylesheet" href="https://code.jquery.com/ui/1.14.1/themes/base/jquery-ui.css">
  <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
  <script src="https://code.jquery.com/ui/1.14.1/jquery-ui.js"></script>
  <script>
$(function() {
    $("#created_dated").datepicker({
        dateFormat: "mm/dd/yy",
        beforeShowDay: function(date) {
            const today = new Date();
            return [
                date.getDate() === today.getDate() &&
                date.getMonth() === today.getMonth() &&
                date.getFullYear() === today.getFullYear()
            ];
        }
    });
});
</script>
*/ ?>
@endsection
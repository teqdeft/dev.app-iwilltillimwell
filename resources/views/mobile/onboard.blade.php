@extends("mobile.layouts.dashboard")
@section("content")
    <style> .dashboard-top-section { display: none; }</style>
    <div class="onboard-step-1">
                <section class="onbord-top-image">
                    <div class="cust-container-lg">
                        <div class="imge-row">

                            <div class="left-col">
                                <div class="image1 img">
                                    <img src="{{ asset('mobile-images/onboarding-v1.png') }}">
                                </div>
                                <div class="image2 img">
                                    <img src="{{ asset('mobile-images/onboarding-v4.png') }}">
                                </div>
                            </div>
                            
                            <div class="center-col">
                                <div class="image3 img">
                                    <img src="{{ asset('mobile-images/onboarding-v2.png') }}">
                                </div>
                                <div class="image4 img">
                                    <img src="{{ asset('mobile-images/onboarding-v5.png') }}">
                                </div>
                                <div class="image5 img">
                                    <img src="{{ asset('mobile-images/onboarding-v6.png') }}">
                                </div>
                            </div>
                        
                            <div class="right-col">
                                <div class="image6 img">
                                    <img src="{{ asset('mobile-images/onboarding-v3.png') }}">
                                </div>
                                <div class="image7 img">
                                    <img src="{{ asset('mobile-images/vector-icon.png') }}">
                                </div>
                                <div class="image8 img">
                                    <img src="{{ asset('mobile-images/onboarding-v7.png') }}">
                                </div>
                            </div>

                        </div>
                    </div>
                </section>

                <section class="onbd-logo-section">
				<div class="cust-container-md">
					 <div class="logo-main">
						
							<img src="{{ asset(env('APP_LOGIN_MOBILE')) }}" alt="app logo">
						
					</div>	
					</div>
				</section>
				
                <section class="onbording-bottom">
                    <div class="cust-container-md">
                        <div class="onboard-content">
                            <div class="on-detail">
                                <p>Life is beautiful!</p>
                                <p>... but it has its challenges</p>
                            </div>
                            <div class="title">  
                                <h1 class="heading-h1">For every challenge there is a solution</h1>
                            </div>
                            <div class="on-bottom">
                                <p>Let's go find it ... together.</p>
                            </div>
                            <div class="cta">
                                <button class="primary-button" onclick="getStarted()">
                                Let’s Begin
                                </button>
                            </div>
                        </div>
                    </div>
                </section>
                
</div>




    <!-- stylesheet -->
    <link rel="stylesheet" href="{{ asset('assets/css/mobile/owl.carousel.min.css')}}" />
    <link rel="stylesheet" href="{{ asset('assets/css/mobile/owl.theme.default.min.css')}}" />

    <div class="onboard-step-2" style="display: none">

    <div class="on-boarding v1">
        <section class="bording-v1">
            <div class="cust-container-lg">
			
				<section class="onbd-logo-section">
					 <div class="logo-main">
						
							<img src="{{ asset(env('APP_LOGIN_MOBILE')) }}" alt="app logo">
						
					</div>	
				</section>
				
                <div class="on-boarding-slider-new owl-carousel owl-theme">

                    <div class="item">
                        <div class="onboard-card">
                            <div class="cd-image">
                                <img src="{{asset('mobile-images/counseling.png')}}" alt="image">
                            </div>
                            <div class="cd-title">
                                <h1 class="title">Counseling Care Services</h1>
                            </div>
                            <div class="cd-detail">
                                <p>Need help with anxiety, depression, family issues, or addictions? </p>
                            </div>
                        </div>
                    </div>

                    <div class="item">
                        <div class="onboard-card">
                            <div class="cd-image">
                                <img src="{{asset('mobile-images/medical-care.png')}}" alt="image">
                            </div>
                            <div class="cd-title">
                                <h1 class="title">Medical Care Services</h1>
                            </div>
                            <div class="cd-detail">
                                <p>Speak to licensed physicians via telephone or online video.</p>
                            </div>
                        </div>
                    </div>

                    <div class="item">
                        <div class="onboard-card">
                            <div class="cd-image">
                                <img src="{{asset('mobile-images/tele-vet.png')}}" alt="image">
                            </div>
                            <div class="cd-title">
                                <h1 class="title">Tele-Vet</h1>
                            </div>
                            <div class="cd-detail">
                                <p>Schedule your virtual consultation today and give your furry friend the care they deserve!</p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>

        <section class="bording-v1 cta">
            <div class="cust-container-md">
                <div class="cta-g">
                    <div class="skip">
                        <a href="javascript:void(0);" class="skip-button" onclick="goto_package_list()">Skip</a>
                    </div>
                    <div class="next">
                        <a href="javascript:void(0);" class="primary-button" onclick="nextSlider()">Next</a>
                    </div>
                </div>
            </div>
        </section>

    </div>

    
    <script src="{{ asset('assets/js/mobile/jquery-3.7.1.js')}}"></script>  
    <script src="{{ asset('assets/js/mobile/owl.carousel.min.js')}}"></script>

    <script>
        
        function getStarted() {
            $("body").removeClass("bg-purple");
            $(".onboard-step-1").hide();
            $(".onboard-step-2").show();

            $(".on-boarding-slider-new").owlCarousel({
            loop: false,
            margin: 10,
            navigation: false,
            singleItem: true,
            stagePadding: 0,
            nav: false,
            dots: false,
            autoplay: false,
            slideBy: 1,
        
            responsive: {
                0: {
                    items: 1,
                },
                600: {
                    items: 1,
                },
                768: {
                    items: 1
                },
                992: {
                    items: 1,
                },
            }
        });
        }

function nextSlider() {
    var owl = $(".on-boarding-slider-new");
    var totalItems = owl.find(".owl-item:not(.cloned)").length;
    var currentIndex = owl.find(".owl-item.active").index() + 1; // Convert to 1-based index

    if (currentIndex === totalItems) {
        goto_package_list();
    } else {
        owl.trigger("next.owl.carousel"); // Move only once
    }
}  
    function goto_package_list() {
		showLoaderPageLoad('show');
        $.ajax({
                method: "POST",
                url: '{{ route("saveOnBoard")}}',
                dataType: "json",
                data: {
                    "_token": $('meta[name="csrf-token"]').attr('content'),
                    "saveOnBoard": 'yes',
                },
                success: function(data) {
                    window.location.href='{{ route("MobileUserPlans") }}'
                }
            });
    } 
    $(function(){
        $("body").addClass("bg-purple");
    });
    </script>
</div>
@endsection
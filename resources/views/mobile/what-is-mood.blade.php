@extends("mobile.layouts.dashboard")
@section("content")
    
<section class="record-header">
        <div class="cust-container-md">
            <div class="rec-row">
                <div class="back">
                    <a href="{{ route('mobile-dashboard')}}" class="back-btn">
                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M12.875 16.0417L7.33334 10.5L12.875 4.95834" stroke="#222A3D"
                                stroke-width="1.58333" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </a>
                </div>
                <div class="top-title">
                    <h2 class="title">What is Mood?</p>
                </div>
                <div class="screen-number d-n">

                </div>
            </div>
        </div>
</section>
@if(LoginUserBToBVerification())
<section class="consul-my-v1">
        <div class="cust-container-md">
            <div class="mod-emot">
                <div class="title">
                    <p>Moods are Emotions.</p>
                </div>


				
				<div class="accordion">
					<div class="accordion-item mod-emot-card active">
					  <button class="accordion-header">
						Primary Emotions.
						<span class="accordion-icon">+</span>
					  </button>
					  <div class="accordion-content">
						<div class="detail">
							<p>Primary emotions are the body’s first response to something that has happened. They are adaptive because they make us react a certain way without being contaminated or examined. These emotions are very easy to identify because they are so strong. They are instinctual, primal, survival responses.</p>
						</div>
						<div class="image">
							<img src="{{ asset('assets/dashboard/assets/images/emotion-v1.png')}}" alt="image" />
						</div>
					  </div>
					</div>
					<div class="accordion-item mod-emot-card">
					  <button class="accordion-header">
						Secondary Emotions.
						<span class="accordion-icon">+</span>
					  </button>
					  <div class="accordion-content">
						<div class="detail">
							<p>Secondary emotions are much more complex because they often refer to the feelings you have about the primary emotion. These are learned emotions which we get from our parent(s) or primary caregivers as we grow up.</p>
						</div>
						<div class="image">
							<img src="{{ asset('assets/dashboard/assets/images/emotion-v2.png')}}" alt="image" />
						</div>
					  </div>
					</div>
					<div class="accordion-item mod-emot-card">
					  <button class="accordion-header">
						Instrumental Emotions.
						<span class="accordion-icon">+</span>
					  </button>
					  <div class="accordion-content">
						<div class="detail">
							<p>Secondary emotions can also be divided into instrumental emotions. These are unconscious and habitual. We learn instrumental emotions as children as a form of conditioning. For example, when we cry a parent comes to soothe us so we learn to use the facial expressions and response associated with crying when we need that soothing or sense of security.</p>
						</div>
						<div class="image">
							<img src="{{ asset('assets/dashboard/assets/images/emotion-v3.png')}}" alt="image" />
						</div>
					  </div>
					</div>
				</div>


				<?php /*
                <div class="mod-emot-card">
                    <div class="title">
                        <p>Primary Emotions.</p>
                    </div>
                    <div class="detail">
                        <p>Primary emotions are the body’s first response to something that has happened. They are adaptive because they make us react a certain way without being contaminated or examined. These emotions are very easy to identify because they are so strong. They are instinctual, primal, survival responses.</p>
                    </div>
                    <div class="image">
                        <img src="{{ asset('assets/dashboard/assets/images/emotion-v1.png')}}" alt="image" />
                    </div>
                </div>

                <div class="mod-emot-card">
                    <div class="title">
                        <p>Secondary Emotions.</p>
                    </div>
                    <div class="detail">
                        <p>Secondary emotions are much more complex because they often refer to the feelings you have about the primary emotion. These are learned emotions which we get from our parent(s) or primary caregivers as we grow up.</p>
                    </div>
                    <div class="image">
                        <img src="{{ asset('assets/dashboard/assets/images/emotion-v2.png')}}" alt="image" />
                    </div>
                </div>

                <div class="mod-emot-card">
                    <div class="title">
                        <p>Instrumental Emotions.</p>
                    </div>
                    <div class="detail">
                        <p>Secondary emotions can also be divided into instrumental emotions. These are unconscious and habitual. We learn instrumental emotions as children as a form of conditioning. For example, when we cry a parent comes to soothe us so we learn to use the facial expressions and response associated with crying when we need that soothing or sense of security.</p>
                    </div>
                    <div class="image">
                        <img src="{{ asset('assets/dashboard/assets/images/emotion-v3.png')}}" alt="image" />
                    </div>
                </div>
				*/ ?>
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



<script>
    const headers = document.querySelectorAll('.accordion-header');
    headers.forEach(header => {
      header.addEventListener('click', () => {
        const item = header.parentElement;
        const openItem = document.querySelector('.accordion-item.active');
        if (openItem && openItem !== item) {
          openItem.classList.remove('active');
        }
        item.classList.toggle('active');
      });
    });
  </script>
@endsection
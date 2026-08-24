@if (
    Request::segment(3) === 'step-9' &&
    in_array(request('action'), ['urgentcare', 'psychiatry','primarycare','psychology','dermatology'])
)
<div id="finish-tab" class="tab-content">

	<?php /*
    <div class="cust-container-lg">
        <div class="tab-container">
            <div class="tab-content-detail">
                <div class="patient-tab-content pharmacy-detail">
                    
                    <div class="pat-title"><p style="text-align: center;font-weight: bold;">Congratulation!</p></div>
                     <div class="pat-content thank-you-min">
                            <p>Consultation request submitted successfully</p>
                    </div>
                    <div class="col-100 cta">
                    <button type="submit" class="primary-button" onclick="GoToList()">Got To List</button>
                    </div>   
                </div>
            </div>
        </div>
    </div>
	*/ ?>
	
	
	<div class="patient-tab-content">
                            <div class="care-consultation-thanku">

                                <div class="main-title">
                                    <p>
                                        <span class="icon">
                                            <svg xmlns="http://www.w3.org/2000/svg"  viewBox="0 0 30 30" width="60px" height="60px"><path d="M 26.980469 5.9902344 A 1.0001 1.0001 0 0 0 26.292969 6.2929688 L 11 21.585938 L 4.7070312 15.292969 A 1.0001 1.0001 0 1 0 3.2929688 16.707031 L 10.292969 23.707031 A 1.0001 1.0001 0 0 0 11.707031 23.707031 L 27.707031 7.7070312 A 1.0001 1.0001 0 0 0 26.980469 5.9902344 z"/></svg>
                                        </span>
                                        <span>
                                            Success!
                                        </span>
                                    </p>
                                </div>

                                <div class="sub-title">
                                    <p>Your appointment has been successfully scheduled!</p>
                                </div>

                                <div class="text">
                                   
									<p>
									A confirmation text message has been sent to <a href="tel:{{ $user->primaryPhone }}"><b>{{ $user->primaryPhone }}</b></a>. All other notifications related to this appointment will also be sent to <a href="tel:{{ $user->primaryPhone }}"><b>{{ $user->primaryPhone }}</b></a>.
									</p>
									
                                   
									
									<p>If you have questions, or need to reschedule or cancel your appointment, please visit the My Consultations section or call <a href="tel:866-223-8831">866-223-8831</a>.</p>
                                </div>

                                <div class="consul-card">
                                    <p>The provider or a member of our staff may also contact you from <a href="tel:866-223-8831"><b>866-223-8831</b></a>. We suggest adding this number to your contacts to prevent any missed calls.</p>
                                </div>

                                <div class="detail">
                                    <h2 class="name">Wishing you good health,</h2>
                                    <p>- <b>iWILL 'til i'mWELL</b> Team</p>
                                </div>

                                <div class="cta">
                                    <a href="{{ url('mobile-dashboard')}}" class="primary-button">Return to Dashboard</a>
                                </div>

                            </div>
    </div>
	
</div>
<script>
function GoToList() {
    window.location.href='{{ url("my-consultations")}}';
}
localStorage.removeItem("scheduleConsultation");
</script>    
@endif
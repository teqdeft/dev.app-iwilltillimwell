@php
    $isnotification = getDashNotificationPUpdate();
@endphp
@if($isnotification)
<div class="popup show dash-notification-pupdate" id="dash-notification-pupdate">
    <div class="popup-content">
      <div class="popu-content delete-pup">
        <div class="complete-form">
             <h2 class="text-center">Package Expiry Notification </h2>
             <p class="text-center" style="padding: 10px 0 0 0;">
				Your 
						@if($isnotification->subscription_type=="four-month")
							4-Month Package
						@else
							12-Month Package
						@endif 
						is expiring soon. Starting next month, it will switch to a monthly plan.
			 </p>
			 
				<div class="agery">
						<div class="form-check">
							<label class="form-check-label">
								<input onclick="acknowledgedFun()" type="radio" class="form-check-input" name="acknowledged" id="acknowledged" value="agree">
								Acknowledged<i class="input-helper"></i>
							</label>
						</div>
				</div>
					
			 
          </div>
      </div>
    </div>
</div> 
@endif

<div class="popup" id="dashboard-semaglutide-alert">
    <div class="popup-content">
      <span class="popup-close-icon" onclick="close_consemt_popup('dashboard-semaglutide-alert')">&times;</span>
      <div class="popu-content delete-pup">
        <div class="complete-form">
             <h2 class="text-center">Upgrade </h2>
             <p class="text-center" style="padding: 10px 0 0 0;">Please Upgrade your plan</p>
			  <div class="text-center" style="padding: 10px 0 0 0;"></div> 
          </div>
      </div>
    </div>
</div> 

<div class="popup" id="upgrade-alert">
    <div class="popup-content">
      <span class="popup-close-icon" onclick="upgrade_alert_close('upgrade-alert')">&times;</span>
  
      <div class="popu-content delete-pup">
          
          <div class="complete-form">
             <h2 class="text-center">Upgrade </h2>
             <p class="text-center" style="padding: 10px 0 0 0;">Please Upgrade your plan</p>
			  <div class="text-center" style="padding: 10px 0 0 0;">
						<a class="btn btn-primary mr-2 primary-button" href="{{ url('change-plan')}}" > 
												
						<svg id="Layer_1" enable-background="new 0 0 48 48" viewBox="0 0 48 48" xmlns="http://www.w3.org/2000/svg" width="30" height="26" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.dev/svgjs"><g width="100%" height="100%" transform="matrix(1,0,0,1,0,0)"><g><path d="m36.1 24.8c-.5 0-.9 0-1.4.1-2.3.3-4.4 1.2-6.2 2.8-2.1 1.8-3.4 4.4-3.7 7.1-.1.5-.1.9-.1 1.4 0 .8.1 1.5.2 2.2.5 2.4 1.8 4.7 3.6 6.3 2.1 1.8 4.8 2.9 7.5 2.9 6.3 0 11.4-5.1 11.4-11.4s-5-11.4-11.3-11.4zm5.4 8.3h-2.2v-1.1c0-.5-.4-.8-.8-.8h-4.6c-.5 0-.8.4-.8.8v2.1c0 .5.4.8.8.8h4.6c1.7 0 3.1 1.4 3.1 3.1v2.1c0 1.7-1.4 3.1-3.1 3.1h-1.2v2.1h-2.3v-2.1h-1.2c-1.7 0-3.1-1.4-3.1-3.1v-1.1h2.3v1.1c0 .5.4.8.8.8h4.6c.5 0 .8-.4.8-.8v-2.1c0-.5-.4-.8-.8-.8h-4.6c-1.7 0-3.1-1.4-3.1-3.1v-2.1c0-1.7 1.4-3.1 3.1-3.1h1.2v-2.1h2.2v2.1h1.2c1.7 0 3.1 1.4 3.1 3.1z" fill="#ffffff" fill-opacity="1" data-original-color="#000000ff" stroke="none" stroke-opacity="1"/><path d="m13.6 12.2c1.4 0 2.5-1.1 2.5-2.5s-1.1-2.5-2.5-2.5-2.5 1.1-2.5 2.5 1.1 2.5 2.5 2.5z" fill="#ffffff" fill-opacity="1" data-original-color="#000000ff" stroke="none" stroke-opacity="1"/><path d="m25.9 8.7-11.1-7.8c-.3-.2-.7-.4-1.1-.4s-.8.1-1.2.4l-11.2 7.8c-.5.4-.8 1-.8 1.6v35.2c0 1.1.9 2 2 2h22.3c.9 0 1.7-.7 1.9-1.6-.1-.1-.1-.1-.2-.2s-.2-.2-.3-.3-.3-.3-.4-.4-.2-.2-.3-.4-.2-.3-.3-.5c-.1-.1-.2-.3-.3-.4-.1-.2-.2-.3-.3-.5-.1-.1-.2-.3-.2-.4-.1-.2-.2-.3-.3-.5-.1-.1-.1-.3-.2-.4-.1-.2-.2-.4-.2-.6-.1-.1-.1-.3-.2-.4-.1-.2-.1-.4-.2-.7 0-.1-.1-.2-.1-.4-.1-.3-.2-.7-.3-1-.2-.8-.3-1.7-.3-2.7 0-.5 0-1 .1-1.4 0-.2 0-.3.1-.5 0-.3.1-.6.2-.9 0-.2.1-.4.1-.5.1-.3.1-.6.2-.8s.1-.4.2-.5c.1-.3.2-.5.3-.8.1-.2.2-.4.3-.5.1-.2.2-.5.4-.7.1-.2.2-.4.3-.5.1-.2.3-.4.4-.6s.3-.3.4-.5c.2-.2.3-.4.5-.6.1-.2.3-.3.4-.5.1-.1.2-.2.3-.4v-16c-.1-.7-.4-1.3-.9-1.7zm-12.3-3.8c2.6 0 4.8 2.1 4.8 4.8s-2.1 4.8-4.8 4.8-4.8-2.1-4.8-4.8 2.2-4.8 4.8-4.8zm6.3 34.6h-12.5v-2.2h12.5zm0-7.2h-12.5v-2.2h12.5zm0-7.2h-12.5v-2.2h12.5z" fill="#ffffff" fill-opacity="1" data-original-color="#000000ff" stroke="none" stroke-opacity="1"/></g></g></svg>
						
						Change Plan</a>
					 </div> 
          </div>
         
      </div>
    </div>
</div>

<div class="popup" id="affirmation-msg">
	<div class="popup-content">
      <div class="close-modal">
        <p class="popup-close -icon" onclick="close_consemt_popup('affirmation-msg')">
			<img src="{{asset('assets/dashboard/assets/images/close-modal-icon.svg')}}" alt="affirmation-close-icon">
		</p>
      </div>
	  
		<div class="daily-affirmation">
			<div class="title"><p>My Daily Affirmation</p></div>
			<div class="text">
				@if($affirmation->message)
					<p id="affirmationMessage">{{$affirmation->message}}</p>
				@endif
			</div>
			<div class="afirmation_cta">
				<a class="btn btn-primary" href="javascript:void(0)" id="newAffirmationBtn">New Affirmation</a>
			</div>
		</div>
	  
    </div>
</div>

<div id="dash-semaglutide-alert" class="modal journal-modal">
        <div class="modal-content">
            <span class="close-modal" onclick="close_support_team();">
                <img src="{{ asset('assets/dashboard/assets/images/close.svg') }}" alt="icon">
            </span>
            <div class="modal-body">
                <div class="modal-form">
                    <div class="daily-affirmation">
					  <div class="text">
							<p class="text-center">Please contact support team at <a href="mailto:support@iwilltilimwell.com" style="font-weight: bold;">support@iwilltilimwell.com</a></p>
					  </div>
				  </div> 
                </div>
            </div>
        </div>
</div>

 <!-- Modal 1 -->
    <div id="MyJournalModal" class="modal journal-modal">
        <div class="modal-content">
            <span class="close-modal" onclick="upgrade_alert_close('MyJournalModal')">
                <img src="{{ asset('assets/dashboard/assets/images/close.svg') }}" alt="icon">
            </span>
            <div class="modal-body">
				<div class="top-head">
					<div class="modal-title">
						<p>Personal Journal Type</p>
					</div>
					<div class="view-log">
						 <a class="primary-button showLoaderPageLoad" 
						 href="{{ route('view-journal-log') }}"
						 ><span>View Log</span> <span><svg width="23" height="18" viewBox="0 0 23 18" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M12 6.6C11.4213 6.6 10.8664 6.85286 10.4572 7.30294C10.0481 7.75303 9.81818 8.36348 9.81818 9C9.81818 9.63652 10.0481 10.247 10.4572 10.6971C10.8664 11.1471 11.4213 11.4 12 11.4C12.5787 11.4 13.1336 11.1471 13.5428 10.6971C13.9519 10.247 14.1818 9.63652 14.1818 9C14.1818 8.36348 13.9519 7.75303 13.5428 7.30294C13.1336 6.85286 12.5787 6.6 12 6.6ZM12 13C11.0356 13 10.1107 12.5786 9.4287 11.8284C8.74675 11.0783 8.36364 10.0609 8.36364 9C8.36364 7.93913 8.74675 6.92172 9.4287 6.17157C10.1107 5.42143 11.0356 5 12 5C12.9644 5 13.8893 5.42143 14.5713 6.17157C15.2532 6.92172 15.6364 7.93913 15.6364 9C15.6364 10.0609 15.2532 11.0783 14.5713 11.8284C13.8893 12.5786 12.9644 13 12 13ZM12 3C8.36364 3 5.25818 5.488 4 9C5.25818 12.512 8.36364 15 12 15C15.6364 15 18.7418 12.512 20 9C18.7418 5.488 15.6364 3 12 3Z" fill="white"/></svg></span></a>
					</div>
				</div>
                <div class="modal-form">
                    <form>
                        <div class="col-100 form-group jour-radio home">
                            <div class="custom-radio-group">
                                <label class="custom-radio">
                                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M11.6667 18.3333H8.33341C5.19091 18.3333 3.61925 18.3333 2.64341 17.3567C1.66758 16.38 1.66675 14.8092 1.66675 11.6667V8.33334C1.66675 5.19084 1.66675 3.61917 2.64341 2.64334C3.62008 1.66751 5.19925 1.66667 8.35841 1.66667C8.86341 1.66667 9.26758 1.66667 9.60841 1.68084C9.5973 1.74751 9.59175 1.81528 9.59175 1.88417L9.58341 4.24584C9.58341 5.16 9.58341 5.96834 9.67091 6.61917C9.76591 7.325 9.98341 8.03084 10.5601 8.6075C11.1351 9.1825 11.8417 9.40084 12.5476 9.49584C13.1984 9.58334 14.0067 9.58334 14.9209 9.58334H18.2976C18.3334 10.0283 18.3334 10.575 18.3334 11.3025V11.6667C18.3334 14.8092 18.3334 16.3808 17.3567 17.3567C16.3801 18.3325 14.8092 18.3333 11.6667 18.3333ZM4.37508 12.0833C4.37508 11.9176 4.44093 11.7586 4.55814 11.6414C4.67535 11.5242 4.83432 11.4583 5.00008 11.4583H11.6667C11.8325 11.4583 11.9915 11.5242 12.1087 11.6414C12.2259 11.7586 12.2917 11.9176 12.2917 12.0833C12.2917 12.2491 12.2259 12.4081 12.1087 12.5253C11.9915 12.6425 11.8325 12.7083 11.6667 12.7083H5.00008C4.83432 12.7083 4.67535 12.6425 4.55814 12.5253C4.44093 12.4081 4.37508 12.2491 4.37508 12.0833ZM4.37508 15C4.37508 14.8342 4.44093 14.6753 4.55814 14.5581C4.67535 14.4409 4.83432 14.375 5.00008 14.375H9.58341C9.74917 14.375 9.90814 14.4409 10.0254 14.5581C10.1426 14.6753 10.2084 14.8342 10.2084 15C10.2084 15.1658 10.1426 15.3247 10.0254 15.4419C9.90814 15.5592 9.74917 15.625 9.58341 15.625H5.00008C4.83432 15.625 4.67535 15.5592 4.55814 15.4419C4.44093 15.3247 4.37508 15.1658 4.37508 15Z" fill="#8462A8"/>
                                        <path d="M16.1266 6.3475L12.8266 3.37834C11.8874 2.5325 11.4183 2.10917 10.8408 1.88834L10.8333 4.16667C10.8333 6.13084 10.8333 7.11334 11.4433 7.72334C12.0533 8.33334 13.0358 8.33334 14.9999 8.33334H17.9833C17.6816 7.74667 17.1399 7.26 16.1266 6.3475Z" fill="#8462A8"/>
                                    </svg>    
                                    Written                                    
                                    <input type="radio" name="journal" value="1" checked>
                                    <span class="custom-radio-button"></span>
                                    
                                </label>
                                <label class="custom-radio">
                                    <svg width="21" height="21" viewBox="0 0 21 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M10.4999 12.25C9.77078 12.25 9.15099 11.9948 8.64057 11.4844C8.13015 10.974 7.87494 10.3542 7.87494 9.625V4.375C7.87494 3.64583 8.13015 3.02604 8.64057 2.51562C9.15099 2.00521 9.77078 1.75 10.4999 1.75C11.2291 1.75 11.8489 2.00521 12.3593 2.51562C12.8697 3.02604 13.1249 3.64583 13.1249 4.375V9.625C13.1249 10.3542 12.8697 10.974 12.3593 11.4844C11.8489 11.9948 11.2291 12.25 10.4999 12.25ZM9.62494 17.5V15.6844C8.28328 15.4948 7.13499 14.926 6.18007 13.9781C5.22515 13.0302 4.64532 11.8781 4.44057 10.5219C4.4114 10.274 4.47703 10.0625 4.63744 9.8875C4.79786 9.7125 5.00203 9.625 5.24994 9.625C5.49786 9.625 5.70582 9.709 5.87382 9.877C6.04182 10.045 6.15469 10.2527 6.21244 10.5C6.41661 11.5208 6.92353 12.3594 7.73319 13.0156C8.54286 13.6719 9.46511 14 10.4999 14C11.5499 14 12.476 13.6684 13.2781 13.0051C14.0802 12.3419 14.5833 11.5068 14.7874 10.5C14.8458 10.2521 14.9589 10.0444 15.1269 9.877C15.2949 9.70958 15.5026 9.62558 15.7499 9.625C15.9973 9.62442 16.2014 9.71192 16.3624 9.8875C16.5234 10.0631 16.5891 10.2745 16.5593 10.5219C16.3552 11.849 15.7791 12.9937 14.8312 13.9563C13.8833 14.9187 12.7312 15.4948 11.3749 15.6844V17.5C11.3749 17.7479 11.2909 17.9559 11.1229 18.1239C10.9549 18.2919 10.7473 18.3756 10.4999 18.375C10.2526 18.3744 10.0449 18.2904 9.87694 18.123C9.70894 17.9556 9.62494 17.7479 9.62494 17.5Z" fill="#8462A8"/>
                                    </svg>   
                                    Audio                                     
                                    <input type="radio" name="journal" value="2">
                                    <span class="custom-radio-button"></span>
                                    
                                </label>

                                <label class="custom-radio">
                                   <img src="{{ asset('assets/dashboard/assets/images/request_affirmation.svg') }}"> 
                                    Requested Affirmation.                                     
                                    <input type="radio" name="journal" value="3">
                                    <span class="custom-radio-button"></span>
                                    
                                </label>
                            </div>
                        </div>

                        <div class="col-100 cta">
                            <button type="button" class="primary-button" onclick="goToNextScreen()">Next</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
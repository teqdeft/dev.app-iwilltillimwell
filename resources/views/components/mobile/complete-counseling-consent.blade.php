<div class="popup show " id="completed-counseling-consent-popup">
    <div class="popup-content">
      <span class="popup-close-icon" onclick="close_consemt_popup('completed-counseling-consent-popup')">&times;</span>
  
      <div class="popu-content">
          <div class="checkout-icon" >
              <svg xmlns="http://www.w3.org/2000/svg"  viewBox="0 0 24 24" width="24px" height="24px"><path d="M 20.292969 5.2929688 L 9 16.585938 L 4.7070312 12.292969 L 3.2929688 13.707031 L 9 19.414062 L 21.707031 6.7070312 L 20.292969 5.2929688 z"/></svg>
          </div>
          <div class="complete-form">
              <p>Hi {{ ucfirst(Auth::user()->fname) }}, Please complete the Counseling Consent Form</p>
          </div>
          <div class="popup-cta">
              <a class="primary-button" href="javascript:void(0);" onclick="close_consemt_popup('completed-counseling-consent-popup')">Get Started</a>
          </div>
      </div>
      
    </div>
</div>
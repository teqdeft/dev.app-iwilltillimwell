<div class="popup" id="audio-deleted-popup-confirmation">
    <div class="popup-content">
      <span class="popup-close-icon" onclick="close_consemt_popup('audio-deleted-popup-confirmation')">&times;</span>
  
      <div class="popu-content delete-pup">
          <div class="delete-alert" >
              <img src="{{ asset('assets/dashboard/assets/images/alert-icon.png') }}" />
          </div>
          <div class="complete-form">
             <h2 class="text-center">Are you sure ? </h2>
             <p class="text-center" style="padding: 10px 0 0 0;">Are you sure you want to delete this record?</p>
          </div>
          <div class="popup-cta">
              <a class="primary-button confirm_btn" href="javascript:void(0)">Yes</a>
              <a class="outline-button" href="javascript:void(0)" onclick="close_consemt_popup('audio-deleted-popup-confirmation')">No</a>
          </div>
      </div>
    </div>
</div>

<div class="modal create journal-modal" id="voiceRecModalMsg"  tabindex="-1" role="dialog" aria-labelledby="voiceRecModal" aria-hidden="true" style="display:none;">
    <div class="modal-content">
            <span class="close-modal voiceRecModalMsgClose" onclick="OpenModel('voiceRecModalMsg','none')" style="display: none;">
                <img src="{{ asset('assets/dashboard/assets/images/close.svg') }}" alt="icon">
            </span>
            <div class="modal-body">
                    <!-- Modal Body -->
                    <div class="form">
                        <!-- Loader icon -->
                        <div class="text-center message">
                            <p>Please wait...</p>
                        </div>
                    </div>
                </div>
    </div>
</div>

<div id="CreateShareLink" class="modal create journal-modal">
        <div class="modal-content">
            <span class="close-modal" onclick="OpenModel('CreateShareLink','none')">
                <img src="{{ asset('assets/dashboard/assets/images/close.svg') }}" alt="icon">
            </span>
            <div class="modal-body">
                <div class="form">
                    <div class="form-row">
                        <div class="col-100 form-group">
                           <label>Name <span class="required-ico">*</span></label>
                           <input class="form-control" type="text" name="name" id="name">
                        </div>
                        <div class="col-100 form-group">
                           <label>Email Address <span class="required-ico">*</span></label>
                           <input class="form-control" type="email" name="email" id="email">
                           <small id="" class="form-text">We'll share link to this email.</small>
                        </div>
                        <div class="col-100 form-group">
                           <label>Message</label>
                           <textarea rows="5" id="message" name="message"  placeholder="Enter Your Address"></textarea>
                           <input type="hidden" value="" name="share_token" id="showLinkText">
                        </div>
                        <div class="col-100 cta">
                            <button type="button" class="primary-button" onclick="ShareNow()">Send</button>
                        </div>                        
                    </div>
                </div>
            </div>
        </div>
</div>
<script>

function OpenModel(id,request_type) {
    if(request_type=="flex") {
        $("#"+id).css("display","flex");
    } else {
        $("#"+id).css("display","none");
    }
}
</script>
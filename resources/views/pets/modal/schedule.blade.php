<div class="modal fade upload-image schedulepopup schedule-pet" id="schedulepopup" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-header theme-bg-color">
            <h3 class="modal-title">Telemedicine Informed Pet Consent</h3>
         </div>
         <div class="modal-body">
            <ul>
               <li>This call is being recorded for quality assurance purposes.</li>
               <li>TeleVet is not for use for medical emergencies or urgent situations.</li>
               <li>TeleVet should not be considered veterinary care and is not a substitute for professional veterinary care, diagnosis, treatment or prescription for your pet.</li>
               <li>TeleVet operates subject to state regulations.</li>
            </ul>
            <div class="w-100 d-block checkbox-cont">
               <div class="form-group">
                  <input type="checkbox" class="informed-pet" id="html" data-toggle="modal" data-target="#fisrt-step-inner">
                  <label for="html">
                     <span>By selecting this box, I hereby state that I have read, understand, and agree to the terms of the Informed Pet Consent.</span>
               </div>
            </div>
         </div>
         <div class="modal-footer common-footer-btn">
         <button type="button" class="btn cancel closeSchedulepopup" data-dismiss="modal">Cancel</button>
         </div>
      </div>
   </div>
</div>

<div class="modal fade first-step common-pet" id="fisrt-step-inner" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-header theme-bg-color">
            <div class="mainpanel">
               <div class="row">
                  <div class="col-sm-3">
                     <a href="#step1" data-toggle="tab" data-step="1" class="active activeStep mysteps">1</a>
                  </div>
                  <div class="col-sm-3">
                     <a href="#step2" data-toggle="tab" data-step="2" class="mysteps">2</a>
                  </div>
                  <div class="col-sm-3">
                     <a href="#step3" data-toggle="tab" data-step="3" class="mysteps">3</a>
                  </div>
                  <div class="col-sm-3">
                     <a href="#step4" data-toggle="tab" data-step="4" class="mysteps">4</a>
                  </div>
               </div>
            </div>
         </div>
         <div class="modal-body">
            <div class="panel-inner">
                @include('pets.modal.first-step')
                @include('pets.modal.second-step')
                @include('pets.modal.third-step')
                @include('pets.modal.fourth-step')
            </div>
         </div>

         <div class="modal-footer common-footer-btn">
            <div class="footer-btn-left" id="backAndCancel">
               <button type="button" class="btn back">Back</button>
               <button type="button" class="btn cancel" data-dismiss="modal">Cancel</button>
            </div>
            <div class="footer-btn-right" id="nextAndComplete">
               <button type="button" class="btn next">Next</button>
               <button type="button" class="btn complete" onclick="SaveSchedule()">Schedule a Call</button>
               <button type="button" class="btn cancel closeModal" style="display:none;">Close</button>
            </div>
         </div>
      </div>
   </div>
</div>



@if(Request::segment(3) == 'step-2')

@php
    $scheduleUrl = url('/schedule-consultation/' . Request::segment(2) . '/step-1/?action=' . request('action'));
@endphp


<div id="erp-tab" class="tab-content">
   
   <div class="patient-tab-content electr">
      <div class="pat-title">
          <p>A Diagnostic Consultation Requires Valid and Up-to-Date Electronic Health Records.</p>
      </div>

      <div class="last-upd">
          <div class="top">
              <p>
                  <span>
                      <img src="{{ asset('assets/dashboard/assets/images/calender-icon.svg')}}" alt="icon" />                                              
                  </span>
                  <span>
                      Health Records Last Updated On
                  </span>
              </p>
          </div>
          <form class="form-row">
              <div class="col-100 form-group">
                  <input class="form-control" type="text" name="trip-start" disabled value="{{ $last_updated ? $last_updated : '' }}">
              </div>
          </form>
      </div>
      @php $id = $user ? $user->id : "" @endphp

      <div class="make-update-re">
          <div class="title">
              <a href="{{ url('/personal-record/'.$id) }}">Click here if you’d like to update your Electronic Health Record; otherwise, continue to Step 3.</a>
          </div>
          <div class="cta">
              <a class="outline-button" href="{{ url('/personal-record/'.$id) }}">Update to your Electronic Health Record</a>
          </div>
      </div>

      <form class="form-row">

          <div class="col-100 form-group">
              <div class="custom-checkbox">
                  <input type="checkbox" id="Medicallls1" class="checkbox-item">
                  <label for="Medicallls1" class="checkbox-label">
                      <span class="checkbox-indicator"></span>
                      I certify that the Electronic Health Records of Sultan Seven are up to date to the best of my knowledge.
                  </label>
              </div>
          </div>

          <div class="col-100  medi-reco">
              <a href="javascript:void(0)" onclick="show_popup('ehr-modal-popup')">
                  <span>
                      <img src="{{ asset('assets/dashboard/assets/images/follow-link-purple.svg')}}" alt="icon" />
                  </span> 
                  <span>
                      Click here to view full version of the Informed Member Consent.
                  </span>
              </a>
          </div>

          <div class="col-100 form-group">
              <div class="custom-checkbox">
                  <input type="checkbox" id="selec1" class="checkbox-item">
                  <label for="selec1" class="checkbox-label">
                      <span class="checkbox-indicator"></span>
                      By selecting this box, I confirm that I have read, understood, and agree to the terms of the Informed Member Consent.
                  </label>
              </div>
          </div>

          <div class="col-100 form-group add-line-hight">
              <div class="custom-checkbox">
                  <input type="checkbox" id="certify1" class="checkbox-item">
                  <label for="certify1" class="checkbox-label">
                      <span class="checkbox-indicator"></span>
					  
					  I have read and agree to the <a href="jascript:void(0)">Terms of Use</a>, <a href="jascript:void(0)">Privacy Policy</a>, and <a href="jascript:void(0)">HIPAA Privacy</a> Practices.
					  
					  <?php /*
                      I have read and agree with the <a href="jascript:void(0)">Terms of Use</a> , <a href="jascript:void(0)">Privacy Policy</a> and <a href="jascript:void(0)">HIPAA Privacy</a> Practices
					  */?>
                  </label>
              </div>
          </div>

          <div class="col-100 cta">
                <div class="recorc-cta" style="width: 100%;">
                <a href="{{ $scheduleUrl }}" class="outline-button showLoaderPageLoad">Back</a>
                <a href="javascript:void(0)" onclick="nextehr()" class="primary-button next-button-ehr-phone" disabled >Next</a>
                </div>
          </div>

      </form>
  </div>

</div>

<div class="popup" id="ehr-modal-popup">
    <div class="popup-content">
    <span class="popup-close-icon" onclick="close_consemt_popup('ehr-modal-popup')">&times;</span>
        <div class="popu-content">

            <div class="card-body-cus ">
                <h4>Informed Consent of Services Performed</h4>
                <p>Telemedicine involves the use of electronic communications to enable healthcare providers
                    at different locations to share individual patient medical information for the purpose of
                    improving patient care.
                    Providers may include primary care practitioners, specialists, and/or subspecialists. The
                    information may be used for diagnosis,
                    therapy, follow-up and/or education, and may include any of the following:
                </p>
                <ul class="list-arrow">
                    <li>Patient medical records</li>
                    <li>Medical images</li>
                    <li>Live two-way audio and video</li>
                    <li>Output data from medical devices and sound and video files</li>
                </ul>
                <p>Electronic systems used will incorporate network and software security protocols to protect the
                    confidentiality of patient identification
                    and imaging data and will include measures to safeguard the data and to ensure its integrity
                    against intentional or unintentional corruption.
                </p>
                <p>Responsibility for the patient care should remain with the patient's local clinician, if you
                    have one, as does the patient's medical record.</p>
            </div>
            <div class="card-body-cus ">
                <h4>Expected Benefits:</h4>
                <ul class="list-arrow">
                    <li>Improved access to medical care by enabling a patient to remain in his/her
                        local healthcare site (i.e. home) while the physician consults and obtains test results at
                        distant/other sites.
                    </li>
                    <li>More efficient medical evaluation and management.</li>
                    <li>Obtaining expertise of a specialist.</li>
                </ul>
            </div>
            <div class="card-body-cus ">
                <h4>Possible Risks:</h4>
                <p>As with any medical procedure, there are potential risks associated with the use of
                    telemedicine. These risks include, but may not be limited to:</p>
                <ul class="list-arrow">
                    <li>In rare cases, the consultant may determine that the transmitted information is of
                        inadequate quality, thus necessitating a face-to-face meeting with the patient, or at least
                        a rescheduled video consult;</li>
                    <li>Delays in medical evaluation and treatment could occur due to deficiencies or failures of
                        the equipment;</li>
                    <li>In very rare instances, security protocols could fail, causing a breach of privacy of
                        personal medical information;</li>
                    <li>In rare cases, a lack of access to complete medical records may result in adverse drug
                        interactions or allergic reactions or other judgment errors;</li>
                </ul>
                <p>By using this service, you acknowledge that you understand and agree with the following:</p>
                <ul class="list-arrow">
                    <li>I understand that my consultation with my healthcare provider will be recorded for quality
                        assurance purposes. </li>
                    <li>I understand that the laws that protect privacy and the confidentiality of medical
                        information also apply to telemedicine,
                        and that no information obtained in the use of telemedicine, which identifies me, will be
                        disclosed to researchers or other entities without my
                        written consent.
                    </li>
                    <li>I understand that I have the right to withhold or withdraw my consent to the use of
                        telemedicine in the course of my care at any time,
                        without affecting my right to future care or treatment.
                    </li>
                    <li>I understand the alternatives to telemedicine consultation as they have been explained to
                        me, and in choosing to participate in
                        a telemedicine consultation, I understand that some parts of the exam involving physical
                        tests may be conducted by individuals at my location, or at a testing facility, at the
                        direction of the consulting healthcare provider.
                    </li>
                    <li>I understand that telemedicine may involve electronic communication of my personal medical
                        information to other medical practitioners
                        who may be located in other areas, including out of state.
                    </li>
                    <li>I understand that I may expect the anticipated benefits from the use of telemedicine in my
                        care, but that no results can be guaranteed or assured.</li>
                    <li>I understand that my healthcare information may be shared with other individuals for
                        scheduling and billing purposes. Others may also be present during the consultation other
                        than my healthcare provider and consulting healthcare provider in order to operate the
                        video equipment. The above mentioned people will all maintain confidentiality of the
                        information obtained. I further understand that I will be informed of their presence in the
                        consultation and thus will have the right to request the following: (1) omit specific
                        details of my medical history/physical examination that are personally sensitive to me; (2)
                        ask non-medical personnel to leave the telemedicine examination room; and/or (3) terminate
                        the consultation at any time.</li>
                </ul>
            </div>
            <div class="card-body-cus ">
                <h4>Patient Consent To The Use of Telemedicine</h4>
                <p>I have read and understand the information provided above regarding telemedicine, have
                    discussed it with my physician or such assistants as may be designated, and all of my questions
                    have been answered to my
                    satisfaction.I have read and understand the information provided above regarding telemedicine,
                    have discussed it with
                    my physician or such assistants as may be designated, and all of my questions have been
                    answered to my satisfaction.
                </p>
                <p>I have read this document carefully, and understand the risks and benefits of the
                    teleconferencing consultation and have
                    had my questions regarding the procedure explained
                    and I hereby give my informed consent to participate in a telemedicine visit under the terms
                    described herein.
                </p>
                <p> <strong>By using this service I hereby state that I have read, understood, and agree to the
                        terms of this document.</strong> </p>
            </div>
        </div>
</div>			 
        </div>
    </div>
</div>
<script>
$(function(){

    let modality = @json(Request::segment(2));
    let consult_id = @json(Request::segment(4));
    let link = SITE_URL + "/schedule-consultation/" + modality + "/step-3/" + consult_id + "?action=<?php echo request('action')?>";

    $('.checkbox-item').click(function() {

        
       
        if ($('.checkbox-item:checked').length == $('.checkbox-item').length) {
                $('.next-button-ehr-phone').prop('disabled', false);
                $(".next-button-ehr-phone").attr("href",link);
                $(".next-button-ehr-phone").removeAttr("onclick");
                scheduleConsultation.ehr_checkbox = "yes";
                localStorage.setItem("scheduleConsultation", JSON.stringify(scheduleConsultation));
            } else {
                
                $(".next-button-ehr-phone").attr("href","javascript:void(0)");
                $('.next-button-ehr-phone').prop('disabled', true);

            }
     });

     $(".schedule-consultation .back-btn").attr("href", "{{ $scheduleUrl }}");
     if(scheduleConsultation.ehr_checkbox){
        $('.checkbox-item').prop('checked', true);
        $('.next-button-ehr-phone').prop('disabled', false);
        $(".next-button-ehr-phone").removeAttr("onclick");
        $(".next-button-ehr-phone").attr("href",link);
     }
});

$(document).on("click", ".showLoaderPageLoad", function () {
    showLoaderPageLoad('show');
});

function nextehr() {
    toastr.error("Term & Condition Required");
}
</script>

@endif
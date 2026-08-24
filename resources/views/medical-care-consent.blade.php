@extends('layouts.default')
@section('content')

<div class="banner-sec information-banner inner-main-banner">
  <div class="cust-container">
    <div class="banner-cont">
      <h1 class=" wow fadeInUp animated">Medical Care</h1>
    </div>
  </div>
</div>
<section class="information-sec ms-ptb-30">
  <div class="cust-container">
    <div class="consent-forms-contents">
      <p>TMT refers to telemedicine services that occur via phone or videoconference using a variety of technologies. These services may also include prescribing medication, scheduling appointments, communicating via secure messaging systems within the electronic medical record, electronic scheduling, providing case management services (e.g., referrals) and providing educational materials, when possible.</p>

      <p>TMT is offered to improve access to treatment services and to preserve continuity of care when significant barriers to access medical services exist.</p>
      <p>The results of TMT cannot be guaranteed or assured. You are not required to use TMT and have the right to request other service option or withdraw this consent at any time without affecting your right to future treatment at IWTIW.</p>


      <h4>TMT services may not be appropriate, or the best choice of service, for reasons including, but not limited to:</h4>

      <ul>
        <li>Patient’s reporting symptoms indicating the need for immediate, in-person medical attention and/or evaluation.</li>
        <li>Access to, or difficulty with, communications technology</li>
        <li>Significant communication service disruptions.</li>
      </ul>
      <p>&nbsp;</p>
      <h4>
        TMT services are conducted and documented in a confidential manner according to applicable laws in similar ways as in-person services. However, there are additional risk including, but not limited to:
      </h4>
      <ul>
        <li>TMT visits, evaluations or treatments could be disrupted, delayed, or communications distorted due to technical failures.</li>
        <li>TMT involves alternative forms of communication that may reduce visual and auditory cues and increase the likelihood of misunderstanding one another.</li>
        <li>Difficulties in accessing all necessary medical information can result in errors in adverse drug interactions, allergic reactions and other errors in clinical judgement.</li>
        <li>Your clinician may determine TMT is not an appropriate treatment option or stop TMT treatment at any time if your condition changes or TMT presents barriers to treatment.

        </li>
        <li>In rare cases, security protocols could fail and your confidential information could be accessed by unauthorized persons.</li>
        <li>Discuss any concerns about TMT session with your provider</li>
      </ul>



      <div class="consent-forms">

        <div class="row">
          <div class="col-sm-6 col-md-6 col-lg-5">
            <div class="emergency-contact-form">
              <h5>Emergency Contact:</h5>
              <div class="form-group">
                <label for="text">Full Name</label>
                <input type="text" class="form-control" id="Full Name" placeholder="" name="text">
              </div>
              <div class="form-group">
                <label for="text">Relationship*</label>
                <select class="form-control">
                  <option value="">option 1</option>
                  <option value="">option 2</option>
                  <option value="">option 3</option>
                  <option value="">option 4</option>
                </select>
              </div>
              <div class="form-group">
                <label for="text">Phone Number*</label>
                <input type="text" class="form-control" id="first name" placeholder="" name="text">
              </div>
            </div>
          </div>
          <div class="col-sm-6 col-md-6 col-lg-7">
            <div class="emergency-contact-form">
              <h5>Client's current location for TCT Appointments:</h5>
              <div class="form-group">
                <label for="text">Phone Number*</label>
                <input type="text" class="form-control" id="first name" placeholder="" name="text">
              </div>
              <div class="form-group">
                <label for="text">Street Address</label>
                <select class="form-control">
                  <option value="">option 1</option>
                  <option value="">option 2</option>
                  <option value="">option 3</option>
                  <option value="">option 4</option>
                </select>
              </div>
              <div class="form-group">
                <label for="text">City, State</label>
                <select class="form-control">
                  <option value="">option 1</option>
                  <option value="">option 2</option>
                  <option value="">option 3</option>
                  <option value="">option 4</option>
                </select>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <p>&nbsp;</p>
            <h4>Acknowledgement</h4>
            <div class="form-group">
              <label><input type="checkbox" name="agreementwithabove" value="Yes i have read and understand above information"> i have read and understand above information.</label>
              <br>
              <label><input type="checkbox" name="consenttoiwtiw" value="I hereby give my informed consent to IWTIW to use Counseling/TeleCounseling Treatment in my care."> I hereby give my informed consent to IWTIW to use Counseling/TeleCounseling Treatment in my care.</label>
            </div>
            <div class="form-group submit-button">
              <input type="submit" class="btn btn-primary" value="Submit">
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>
</div>
</section>

@endsection

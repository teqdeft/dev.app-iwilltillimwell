@extends('mobile.layouts.dashboard')
@section('content')
<?php /*
<div class="main-panel main-panel-for-modal-page">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12 grid-margin top-header-page">
                <div class="row">
                    <div class="col-12 col-xl-6 mb-4 mb-xl-0">
                        <h3 class="font-weight-bold">Profile</h3>
                        {{-- <h6 class="font-weight-normal mb-0">General information</h6> --}}
                    </div>
                </div>
            </div>
            <div class="col-md-12 align-items-stretch">
                <div class="row">
                    <div class="col-md-12 grid-margin stretch-card">
                        <div class="card health-card">
                            <div class="card-body">
                                <div class="health-summary-box mb-4">
                                    <h4 class="card-title">Counseling Consent</h4>
                                    <form action="{{ url('share/save-user-data') }}" id="user-{{ $type }}" method="post">
                                        @csrf
                                        <input type="hidden" name="counseling-type" value="{{ $type }}" />
                                        <input type="hidden" name="type" value="{{ $type }}" />
                                        <div class="row">
                                           
                                            

                                            
                                            <div class="col-md-12 mt-19">
                                                <h4>Acknowledgment:</h4>
                                                <div class="medical_radio-checks">
                                                   
                                                    <label class="form-check-label" for="cc_acknowledgment_id-1-1">I have read and understand the above information </label>
                                                </div>
                                                 <div class="medical_radio-checks">
                                                    <input class="form-check-input" {{ checkedIcon($userMeta['cc_acknowledgment_1']??'',1) }} type="checkbox" name="cc_acknowledgment_1[]" id="cc_acknowledgment_id-1-2"
                                                        value="1">
                                                    <label class="form-check-label" for="cc_acknowledgment_id-1-2">I hereby give informed consent to IWTIW to provide Tele-Counseling to deliver my care</label>



                                                </div>
                                            </div>

                                            <div class="col-sm-12 mt-3">
                                                <div class="form-group text-right">
                                                    <a href="{{ url('share/user/medical-consent')  }}" class="btn btn-primary"><i class="fa fa-chevron-left fa-arrow-icon fa-arrow-icon-back"></i> Back</a>
                                                    <button type="submit" class="btn btn-primary mr-10 float-right user_submit-profile-consent" id="submit">Finish</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if ( !isset($userMeta['cc_last_name']) )
        <x-complete-counseling-consent />
    @endif
    <x-personal-record-popup />
    */ ?>


    <section class="record-header">
        <div class="cust-container-md">
            <div class="rec-row">
                <div class="back">
                    <a href="/share/user/medical-consent" class="back-btn">
                        <img src="{{ asset('assets/dashboard/assets/images/left-errow.png')}}" alt="back icon">
                    </a>
                </div>
                <div class="top-title">
                    <h2 class="title">Counseling Consent</p>
                </div>
                <div class="screen-number d-n">
                    <!-- <p><span>1</span> of <span>5</span></p> -->
                </div>
            </div>
        </div>
    </section>

    <section class="medical_outer">
        <div class="cust-container-md">
            <div class="content">
                <div class="cont-t">
                    <p>All aspects of this informed consent for treatment apply to iWILL ‘til i’mWELL (IWTIW). I hereby consent to engage in the teletherapy counseling services with iWILL ‘til i’mWELL.</p>
                </div>
                <div class="cont-n">
                    <p>I understand counseling is a confidential, collaborative effort between a counselor and an individual. Professional counselors help people identify their personal goals, improve their communication and coping skills, find potential solutions, strengthen their self-esteem, promote behavior change, and achieve optimal levels of mental health.</p>
                    <p>I understand that "teletherapy" includes the practice of health care delivery, diagnosis, consultation, treatment, transfer of medical data, and education using interactive live audio, video, or data communications.</p>
                    <p>I understand that teletherapy can also involve communicating my medical/mental information, both orally and visually, to health care practitioners.</p>
                </div>
                <div class="cont-t">
                    <p>I understand that I have the following rights and understanding concerning teletherapy:</p>
                </div>
                <div class="cont-n">
                    <p>
                        1) I have the right to withhold or withdraw consent at any time.<br>
                        2) The laws that protect the confidentiality of my medical information also apply to teletherapy. As such, I must attest that I am in a private, non-public, secure place and alone for each of my teletherapy sessions.<br>
                        3) I understand that the information I disclosed during my therapy is generally confidential. However, there are both mandatory and permissive exceptions to confidentiality, including, but not limited to reporting abuse of vulnerable populations; expressed threats of violence towards an ascertainable victim; expressed threat to harm or kill self; and where I make my mental or emotional state an issue in a legal proceeding or the involvement of law enforcement.

                    </p>
                </div>
                <div class="cont-t">
                    <p>I also understand that the dissemination of any personally identifiable images or information from the teletherapy interaction to researchers or other entities shall not occur without my written consent.
                    </p>
                </div>
                <div class="cont-n">
                    <p>
                        1) I understand that there are risks and consequences of teletherapy. This includes, but is not limited to, the possibility, despite reasonable efforts on the part of my counselor, that technical failure could disrupt or distort the transmission of my medical information; unauthorized persons could interrupt the transmission of my medical information; and/or unauthorized persons could access the electronic storage of my medical information.<br>
                        2) I understand that teletherapy-based services and care may not be as complete as in-person facet-to-face services.<br>
                        3) I also understand that if my therapist believes I would be better served by another form of therapeutic service (e.g., face-to-face services), I will be referred to a psychotherapist who can provide such services in my area.
                    </p>
                </div>

                <div class="cont-t">
                    <p>Examples include, but are not limited to, crises, severe and persistent mental illness, and medication management.</p>
                </div>

                <div class="cont-n">
                    <p>
                        1) I understand that there are potential risks and benefits associated with any form of counseling and that despite my efforts and the efforts of my counselor, my condition may not improve and, in some cases, even worsen.<br>
                        2) I understand that I may benefit from teletherapy, but that results cannot be guaranteed or assured.<br>
                        3) I accept that IWTIW teletherapy does not provide emergency services.</p>
                </div>

                <div class="cont-t">
                    <p>I understand that I can call 911 or proceed to the nearest hospital emergency room for help. Examples of emergencies include having thoughts of hurting or killing another person or myself, having hallucinations, being in a life-threatening emergency of any kind, having uncontrollable emotional reactions, or being dysfunctional due to abusing alcohol or drugs.</p>
                </div>

                <div class="cont-n">
                    <p>I acknowledge I can call the National Suicide Prevention Lifeline at 1-800-273-TALK (8255) for free 24-hour hotline support.<br>
                        I understand that I have a right to request access to portions of my medical information and copies of medical records per HIPAA privacy and security rules.<br>
                        I have read and understand the information provided above. I understand that I can discuss this with my counselor.</p>
                </div>

                <div class="cont-t">
                    <p>If in an emergency, please call/contact any of the following numbers for care:</p>
                </div>

                <div class="cont-n">
                    <p> - 911 or go to the nearest emergency room.<br>
                        - The National Suicide Prevention Hotline: 800-273-8255 (24 hours).<br>
                        - The crisis text line: Text HOME to 741741 (24 hours) or <a href="https://www.crisistextline.org/">Crisis Text Line</a>.
                    </p>
                </div>

                <div class="midical-form">
                    <div class="form-title">
                        <p>Please fill the below form:</p>
                    </div>
                    <div class="form">
                        <form action="{{ url('share/save-user-data') }}" id="user-{{ $type }}" method="post">
                            @csrf
                            <input type="hidden" name="counseling-type" value="{{ $type }}" />
                            <input type="hidden" name="type" value="{{ $type }}" />
                        <div class="form-row">
                            <div class="col-50 form-group">
                                <label>First name.</label>
                                <input class="form-control" type="text" name="cc_first_name" value="{{ $userMeta['cc_first_name']??$user->fname }}">
                            </div>
                            <div class="col-50 form-group">
                                <label>Last name.</label>
                                <input class="form-control" type="text" name="cc_last_name" value="{{ $userMeta['cc_last_name']??$user->lname }}">
                            </div>
                            <div class="col-100 form-group">
                                <label>Phone number.</label>
                                <input class="form-control" type="text"  name="cc_phone_number" value="{{ $userMeta['cc_phone_number']??$user->primaryPhone }}">
                            </div>														<?php /*
                            <div class="col-100 form-group">
                                <label>Client’s current location for appointments.</label>
                                <input class="form-control" type="text" name="cc_tmt_appointments" value="{{ $userMeta['cc_tmt_appointments']??'' }}"> 
                            </div>							*/ ?>
                            <div class="col-100 form-group">
                                <label>Street address.</label>
                                <input class="form-control" type="text" name="cc_street_address" value="{{ $userMeta['cc_street_address']??$user->address }}">
                            </div>
                            <div class="col-100 form-group">
                                <label>City, state.</label>
                                <input class="form-control" type="text" name="cc_city_state"  value="{{ $userMeta['cc_city_state']??$user->city }}">
                            </div>
                            <div class="col-100">
                                <div class="inner-title">
                                    <p>Emergency contact.</p>
                                </div>
                            </div>
                            <div class="col-50 form-group">
                                <label>First name.</label>
                                <input class="form-control" type="text" name="cc_emergency_first_name" value="{{ $userMeta['cc_emergency_first_name']??$user->fname }}">
                            </div>
                            <div class="col-50 form-group">
                                <label>Last name.</label>
                                <input class="form-control" type="text" name="cc_emergency_last_name" value="{{ $userMeta['cc_emergency_last_name']??$user->lname }}">
                            </div>

                            <div class="col-100 form-group">
                                <label>Email.</label>
                                <input class="form-control" type="email" name="cc_emergency_email" value="{{ $userMeta['cc_emergency_email']??$user->email }}">
                            </div>

                            <div class="col-100">
                                <div class="inner-title">
                                    <p>Acknowledgement</p>
                                </div>
                            </div>

                            <div class="col-100">
                                <div class="custom-checkbox">
                                    <input type="checkbox" {{ checkedIcon($userMeta['cc_acknowledgment_1']??'',1) }} type="checkbox" name="cc_acknowledgment_1[]" value="1"  id="cc_acknowledgment_1_1" />
                                    <label for="cc_acknowledgment_1_1">I have read and understand the above information.</label>
                                </div>
                                <div class="custom-checkbox">
                                    <input type="checkbox" {{ checkedIcon($userMeta['cc_acknowledgment_1']??'',1) }} type="checkbox" name="cc_acknowledgment_1[]" value="1"  id="cc_acknowledgment_1_2" />
                                    <label for="cc_acknowledgment_1_2">I hereby give informed consent to IWTIW to provide Telemedicine to deliver my care </label>
                                </div>
                            </div>

                            <div class="col-100 cta">
                                <button class="primary-button">Next</button>
                            </div>
                        </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </section>
   

        
@include('mobile.includes.foooter-tab') 
@if ( !isset($userMeta['cc_last_name']) )
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
@else   
<div class="popup show " id="personal-record-consent-popup">
    <div class="popup-content">
      <span class="popup-close-icon" onclick="close_consemt_popup('personal-record-consent-popup')">&times;</span>
  
      <div class="popu-content">
          <div class="checkout-icon" >
              <svg xmlns="http://www.w3.org/2000/svg"  viewBox="0 0 24 24" width="24px" height="24px"><path d="M 20.292969 5.2929688 L 9 16.585938 L 4.7070312 12.292969 L 3.2929688 13.707031 L 9 19.414062 L 21.707031 6.7070312 L 20.292969 5.2929688 z"/></svg>
          </div>
          <div class="complete-form">
             <h2 class="text-center">Congratulations! </h2>
             <p class="text-center" style="padding: 10px 0 0 0;">You’ve successfully completed your profile.</p>
             <p class="text-center" style="padding: 10px 0 0 0;">Next, please complete your personal health records.</p>
          </div>
          <div class="popup-cta">
              <a class="primary-button" href="{{ route('personal-record')}}" >Get Started</a>
          </div>
      </div>
      
    </div>
</div>
@endif
@endsection

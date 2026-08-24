@extends('mobile.layouts.dashboard')
@section('content')
    <section class="record-header">
        <div class="cust-container-md">
            <div class="rec-row">
                <div class="back">
				<?php /*
                    <a href="{{ route('mobile-dashboard')}}" class="back-btn">
                            <img src="{{ asset('assets/dashboard/assets/images/left-errow.png')}}" alt="back icon">
                    </a>
					*/ ?>
                </div>
                <div class="top-title">
                    <h2 class="title">Medical Consent</p>
                </div>
                <div class="screen-number d-n">
                    
                </div>
            </div>
        </div>
    </section>

    <section class="medical_outer">
        <div class="cust-container-md">
            <div class="content">
                <div class="cont-t">
                    <p>Telemedicine services can occur via phone or videoconference using a variety of technologies.</p>
                </div>
                <div class="cont-n">
                    <p>These services may also include prescribing medication, scheduling appointments, communicating via secure messaging systems within the electronic medical record, electronic scheduling, providing case management services (e.g., referrals), and providing educational materials when possible.</p>
                    <p>Telemedicine is offered to improve access to treatment services and to preserve the continuity of care when significant barriers to accessing medical services exist.</p>
                    <p>I understand that the results of telemedicine cannot be guaranteed or assured.</p>
                    <p>I understand that I have the right to withdraw this consent at any time.</p>
                </div>
                <div class="cont-t">
                    <p>I understand that Telemedicine services may not be appropriate or the best choice of service for reasons including, but not limited to:</p>
                </div>
                <div class="cont-n">
                    <p>
                        1) The patient's reporting symptoms indicate the need for immediate, in-person medical attention and/or evaluation.<br>
                        2) access to, or difficulty with, communications technology.<br>
                        3) significant communications service disruptions.
                    </p>
                </div>
                <div class="cont-t">
                    <p>Telemedicine services are conducted and documented confidentially according to applicable laws similar to in-person services. However, there are additional risks including, but not limited to:
                    </p>
                </div>
                <div class="cont-n">
                    <p>1) Telemedicine visits, evaluations, or treatments could be disrupted, delayed, or communications distorted due to technical failures.
                    <p>2) Telemedicine involves alternative forms of communication that may reduce visual and auditory cues and increase the likelihood of misunderstanding one another.</p>
                    <p>3) Difficulties in accessing all necessary medical information can result in adverse drug interactions, allergic reactions, and other errors in clinical judgment.</p>
                    <p>4) Your clinician may determine Telemedicine is not an appropriate treatment option or stop TMT treatment at any time if your condition changes or Telemedicine presents barriers to treatment.</p>
                    <p>5) In rare cases, security protocols could fail, and unauthorized persons could access your confidential information.</p>
                    <p>6) Discuss any concerns about TMT sessions with your provider.</p>
                </div>

                <div class="midical-form">
                    <div class="form-title">
                        <p>Please fill the below form:</p>
                    </div>
                    <div class="form">
                        <form action="{{ url('share/save-user-data') }}" id="user-{{ $type }}" method="post">
                            @csrf
                            <input type="hidden" name="type" value="{{ $type }}" />    
                        <div class="form-row">
                            <div class="col-50 form-group">
                                <label>First name.</label>
                                <input class="form-control" type="text" id="mc_first_name" name="mc_first_name"  value="{{ $userMeta['mc_first_name']??$user->fname }}">
                            </div>
                            <div class="col-50 form-group">
                                <label>Last name.</label>
                                <input class="form-control" type="text" id="mc_last_names"  name="mc_last_names" value="{{ $userMeta['mc_last_name']??$user->lname }}">
                            </div>
                            <div class="col-100 form-group">
                                <label>Phone number.</label>
                                <input class="form-control" type="tel" name="mc_phone_number" value="{{ $userMeta['mc_phone_number']??$user->primaryPhone }}">
                            </div>														<?php /*
                            <div class="col-100 form-group">
                                <label>Client’s current location for appointments.</label>
                                <input class="form-control" name="mc_tmt_appointments" value="{{ $userMeta['mc_tmt_appointments']??'' }}">
                            </div>							*/ ?>
                            <div class="col-100 form-group">
                                <label>Street address.</label>
                                <input class="form-control" type="text" name="mc_street_address" value="{{ $userMeta['mc_street_address']??$user->address }}">
                            </div>
                            <div class="col-100 form-group">
                                <label>City, state.</label>
                                <input class="form-control" type="text" name="mc_city_state" value="{{ $userMeta['mc_city_state']??$user->city }}">
                            </div>
                            <div class="col-100">
                                <div class="inner-title">
                                    <p>Emergency contact.</p>
                                </div>
                            </div>
                            <div class="col-50 form-group">
                                <label>First name.</label>
                                <input class="form-control" type="text" name="mc_emergency_first_name" value="{{ $userMeta['mc_emergency_first_name']??$user->fname }}">
                            </div>
                            <div class="col-50 form-group">
                                <label>Last name.</label>
                                <input class="form-control" type="text" name="mc_emergency_last_name" value="{{ $userMeta['mc_emergency_last_name']??$user->lname }}">
                            </div>

                            <div class="col-100 form-group">
                                <label>Email.</label>
                                <input class="form-control" type="email" name="mc_emergency_email" value="{{ $userMeta['mc_emergency_email']??$user->email }}">
                            </div>

                            <div class="col-100">
                                <div class="inner-title">
                                    <p>Acknowledgement</p>
                                </div>
                            </div>

                            <div class="col-100">
                                <div class="custom-checkbox">
                                    <input type="checkbox" id="mc_acknowledgment_id-1-1" {{ checkedIcon($userMeta['mc_acknowledgment_1']??'','1') }} type="checkbox" name="mc_acknowledgment_1[]" value="1"  />
                                    <label for="mc_acknowledgment_id-1-1">I have read and understand the above information.</label>
                                </div>
                                <div class="custom-checkbox">
                                    <input type="checkbox" id="mc_acknowledgment_id-1-2"  {{ checkedIcon($userMeta['mc_acknowledgment_1']??'','1') }} type="checkbox" name="mc_acknowledgment_1[]" value="1"  />
                                    <label for="mc_acknowledgment_id-1-2">I hereby give informed consent to IWTIW to provide Telemedicine to deliver my care </label>
                                </div>
                            </div>

                            <div class="col-100 cta">

                                <button  type="submit" class="primary-button user_submit-profile-consent" id="submit">Next</button>
                               
                            </div>
                        </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </section>
   

 
@include('mobile.includes.foooter-tab')
@if ( !isset($userMeta['mc_last_name']) )
    <div class="popup show " id="medical-consent-popup">
            <div class="popup-content">
            <span class="popup-close-icon" onclick="close_consemt_popup('medical-consent-popup')">&times;</span>
        
            <div class="popu-content">
                <div class="checkout-icon" >
                    <svg xmlns="http://www.w3.org/2000/svg"  viewBox="0 0 24 24" width="24px" height="24px"><path d="M 20.292969 5.2929688 L 9 16.585938 L 4.7070312 12.292969 L 3.2929688 13.707031 L 9 19.414062 L 21.707031 6.7070312 L 20.292969 5.2929688 z"/></svg>
                </div>
                <div class="complete-form">
                    <p>Hi {{ ucfirst(Auth::user()->fname) }}, please complete the Medical Consent Form.</p>
                </div>
                <div class="popup-cta">
                    <a class="primary-button" href="javascript:void(0);" onclick="close_consemt_popup('medical-consent-popup')">Get Started</a>
                </div>
            </div>
            </div>
    </div>
@endif
@endsection

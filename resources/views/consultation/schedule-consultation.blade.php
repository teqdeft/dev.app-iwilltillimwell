@extends('layouts.v1.dashboard') 
@section('content') 
@php $action = request('action') ?? 'urgentcare';@endphp 

<div class="content-wrapper consultation-type-main">
    <div class="row patient-details-main">

        <div class="col-md-12 grid-margin">
                <div class="row">
                    <div class="col-12">
                        <div class="patient-details ">
                            <div class="media">
                                <div class="title-heading-icon-box-cus"> <i class="fas fa-user"></i> </div>
                                <div class="media-body">
                                    <h3 class="font-weight-bold"> Patient Details</h3>
                                    <h6 class="font-weight-normal mb-0"> </h6>
                                </div>
                                <div class="media-body consultant-heading-main">
                                    <h3 class="font-weight-bold"> @if($action == 'psychology') Meet with a Psychologist @elseif($action == 'psychiatry') Meet with a Psychiatrist @else {{ getConsultantHeading($action) }} Consultation @endif </h3>
                                    <div class="consul_via"> Consultation via {{ ucfirst($modality) }} </div>
                                </div>
                            </div>
                        </div>
                        <div class="ehr-box ">
                            <div class="media">
                                <div class="title-heading-icon-box-cus"> <i class="fas fa-user"></i> </div>
                                <div class="media-body">
                                    <h3 class="font-weight-bold"> Patient Details</h3>
                                    <h6 class="font-weight-normal mb-0">Diagnostic Consultation By Phone</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
     

      
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script>
            var scheduleConsultation = JSON.parse(localStorage.getItem("scheduleConsultation"));
            if (!scheduleConsultation) {
                scheduleConsultation = {};
            }
        </script>
        <div class="row">
            <div class="col-lg-12 stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="design-process-section" id="process-tab"> <!-- design process steps--> <!-- Nav tabs --> @include('consultation.schedule-consultation-step.tab') <!-- end design process steps--> <!-- Tab panes -->
                            
                        <div class="tab-content pt-0 schedule-consultation"> 

                         
                            <input type="hidden" id="modality" value="{{ $modality }}" /> 
                            <?php $consultation_id = $consultation ? $consultation->id : "" ?> 
                            @include('consultation.schedule-consultation-step.patient') 
                            @include('consultation.schedule-consultation-step.ehr') 
                            @include('consultation.schedule-consultation-step.phone') 
                            @include('consultation.schedule-consultation-step.state') 
                            <?php if (request('action') == "urgentcare") { ?> 
                            @include('consultation.schedule-consultation-step.details') 
                            @include('consultation.schedule-consultation-step.schedule') 
                            @include('consultation.schedule-consultation-step.prescription-refills') 
                            @include('consultation.schedule-consultation-step.pharmacy') 
                            <?php } ?> 
                            <?php if (in_array(request('action'), ['primarycare', 'psychiatry', 'psychology', 'dermatology'])) { ?> 
                            @include('consultation.schedule-consultation-step.prescription-refills') 
                            @include('consultation.schedule-consultation-step.doctors-list') 
                            @include('consultation.schedule-consultation-step.health-risk-assessment') 
                            @include('consultation.schedule-consultation-step.pharmacy') 
                            <?php } ?> 
                            @include('consultation.schedule-consultation-step.finish') 

                          
                        </div>



                        </div>
                    </div>
                </div>
            </div>
        </div>
      

    </div>

<div class="modal diagnostic_consultation_member" id="myModalconsent">
    <div class="modal-dialog  modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header theme-bg-color">
                <h3 class="card-title mb-0">Telemedicine Informed Patient Consent</h3> <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
            </div>
            <div class="modal-body">
                <div class="card-body-cus ">
                    <h4>Informed Consent of Services Performed</h4>
                    <p>Telemedicine involves the use of electronic communications to enable healthcare providers at different locations to share individual patient medical information for the purpose of improving patient care. Providers may include primary care practitioners, specialists, and/or subspecialists. The information may be used for diagnosis, therapy, follow-up and/or education, and may include any of the following: </p>
                    <ul class="list-arrow">
                        <li>Patient medical records</li>
                        <li>Medical images</li>
                        <li>Live two-way audio and video</li>
                        <li>Output data from medical devices and sound and video files</li>
                    </ul>
                    <p>Electronic systems used will incorporate network and software security protocols to protect the confidentiality of patient identification and imaging data and will include measures to safeguard the data and to ensure its integrity against intentional or unintentional corruption. </p>
                    <p>Responsibility for the patient care should remain with the patient's local clinician, if you have one, as does the patient's medical record.</p>
                </div>
                <div class="card-body-cus ">
                    <h4>Expected Benefits:</h4>
                    <ul class="list-arrow">
                        <li>Improved access to medical care by enabling a patient to remain in his/her local healthcare site (i.e. home) while the physician consults and obtains test results at distant/other sites. </li>
                        <li>More efficient medical evaluation and management.</li>
                        <li>Obtaining expertise of a specialist.</li>
                    </ul>
                </div>
                <div class="card-body-cus ">
                    <h4>Possible Risks:</h4>
                    <p>As with any medical procedure, there are potential risks associated with the use of telemedicine. These risks include, but may not be limited to:</p>
                    <ul class="list-arrow">
                        <li>In rare cases, the consultant may determine that the transmitted information is of inadequate quality, thus necessitating a face-to-face meeting with the patient, or at least a rescheduled video consult;</li>
                        <li>Delays in medical evaluation and treatment could occur due to deficiencies or failures of the equipment;</li>
                        <li>In very rare instances, security protocols could fail, causing a breach of privacy of personal medical information;</li>
                        <li>In rare cases, a lack of access to complete medical records may result in adverse drug interactions or allergic reactions or other judgment errors;</li>
                    </ul>
                    <p>By using this service, you acknowledge that you understand and agree with the following:</p>
                    <ul class="list-arrow">
                        <li>I understand that my consultation with my healthcare provider will be recorded for quality assurance purposes. </li>
                        <li>I understand that the laws that protect privacy and the confidentiality of medical information also apply to telemedicine, and that no information obtained in the use of telemedicine, which identifies me, will be disclosed to researchers or other entities without my written consent. </li>
                        <li>I understand that I have the right to withhold or withdraw my consent to the use of telemedicine in the course of my care at any time, without affecting my right to future care or treatment. </li>
                        <li>I understand the alternatives to telemedicine consultation as they have been explained to me, and in choosing to participate in a telemedicine consultation, I understand that some parts of the exam involving physical tests may be conducted by individuals at my location, or at a testing facility, at the direction of the consulting healthcare provider. </li>
                        <li>I understand that telemedicine may involve electronic communication of my personal medical information to other medical practitioners who may be located in other areas, including out of state. </li>
                        <li>I understand that I may expect the anticipated benefits from the use of telemedicine in my care, but that no results can be guaranteed or assured.</li>
                        <li>I understand that my healthcare information may be shared with other individuals for scheduling and billing purposes. Others may also be present during the consultation other than my healthcare provider and consulting healthcare provider in order to operate the video equipment. The above mentioned people will all maintain confidentiality of the information obtained. I further understand that I will be informed of their presence in the consultation and thus will have the right to request the following: (1) omit specific details of my medical history/physical examination that are personally sensitive to me; (2) ask non-medical personnel to leave the telemedicine examination room; and/or (3) terminate the consultation at any time.</li>
                    </ul>
                </div>
                <div class="card-body-cus ">
                    <h4>Patient Consent To The Use of Telemedicine</h4>
                    <p>I have read and understand the information provided above regarding telemedicine, have discussed it with my physician or such assistants as may be designated, and all of my questions have been answered to my satisfaction.I have read and understand the information provided above regarding telemedicine, have discussed it with my physician or such assistants as may be designated, and all of my questions have been answered to my satisfaction. </p>
                    <p>I have read this document carefully, and understand the risks and benefits of the teleconferencing consultation and have had my questions regarding the procedure explained and I hereby give my informed consent to participate in a telemedicine visit under the terms described herein. </p>
                    <p> <strong>By using this service I hereby state that I have read, understood, and agree to the terms of this document.</strong> </p>
                </div>
            </div>
        </div>
    </div>
</div> 

</div>

@unless ( (Request::segment(3) === 'step-9' && request('action') === 'urgentcare') || (Request::segment(3) === 'step-9' && request('action') === 'primarycare')) <script>
    scheduleConsultation.modality = "{{ $modality }}";
    scheduleConsultation.action = "{{ request('action') }}";
    scheduleConsultation.current_segment = "{{ Request::segment(2) }}";
    scheduleConsultation.current_url = window.location.href;
    localStorage.setItem("scheduleConsultation", JSON.stringify(scheduleConsultation));
    const storedUser = JSON.parse(localStorage.getItem("scheduleConsultation"));
    console.log(storedUser);
</script>
@endunless

@endsection
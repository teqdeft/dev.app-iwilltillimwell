 @extends('layouts.default')
 @section('content')

 <div class="banner-sec information-banner">
  <div class="cust-container">
   <div class="banner-cont">
    <h1>Information Intake Form</h1>
   </div>
  </div>
 </div>
 <section class="information-sec">
  <div class="cust-container">
   <div class="information-cont" id="info-step-1">
    <div class="information-top">
     <h2>1. General Information</h2>
    </div>
    <div class="information-bottom">
     <form action="http://localhost/iwilltilimwell/store-general-info" id="general-info-form" method="post">
      <input type="hidden" name="_token" value="i4wnTJDByPjYfb8upFtqKodZ4UYCXiEj3Luz5lml">
      <div class="form-group">
       <label for="stateid">Please Select whome you want to take consultation for*</label>
       <select class="form-control" name="planDetailsId" required="required">
        <option value="">Select</option>
       </select>
      </div>
      <div class="radio-sec">
       <ul>
        <li><strong>Gender :</strong></li>
        <li>
         <input type="radio" id="male" name="gender" checked value="m" required="required">
         <label for="male">Male</label><br></li>
         <li><input type="radio" id="female" name="gender"  value="f">
          <label for="female">Female</label><br></li>
         </ul> 
        </div>
        <div class="form-group-outer">
         <div class="form-group">
          <label for="text">First Name*</label>
          <input type="text" class="form-control" id="first name" placeholder="enter your first name" name="firstname" value="Palmer" required="required">
         </div>
         <div class="form-group">
          <label for="last_name3">Last Name*</label>
          <input type="text" class="form-control" id="last_name3" placeholder="enter your last name" name="lastname" value="Renee" required="required">
         </div>
         <div class="form-group">
          <label for="date">Date of Birth *</label>
          <input type="date" class="form-control" id="date" placeholder="" name="dob" value="2021-06-18" required="required">
         </div>
         <div class="form-group">
          <label for="phone1">Primary phone *</label>
          <input type="tel" class="form-control" id="phone1" placeholder="" name="primaryPhone" value="7412589630" required="required">
         </div>
         <div class="form-group">
          <label for="date2">Effective Date *</label>
          <input type="date" class="form-control" id="date2" placeholder="" name="effectiveDate" value="2021-06-15" required="required">
         </div>
         <div class="form-group">
          <label for="email">E-mail Address*</label>
          <input type="email" class="form-control" id="email" placeholder="" name="email" value="tel@mailinator.com" required="required">
         </div>
         <div class="form-group">
          <label for="password">Password*</label>
          <input type="password" class="form-control" id="password" placeholder="" name="password" value="" required="required">
         </div>
         <div class="form-group">
          <label for="stateid">State*</label>
          <select class="form-control" name="stateid" required="required">
           <option>Select State</option>
           <option value="1" >Alabama</option>
           <option value="2" >Alaska</option>
           <option value="3" selected>American Samoa</option>
           <option value="4" >Arizona</option>
           <option value="5" >Arkansas</option>
           <option value="6" >Armed Forces Americas</option>
           <option value="7" >Armed Forces Non-Americas</option>
           <option value="8" >Armed Forces Pacific</option>
           <option value="9" >California</option>
           <option value="10" >Colorado</option>
           <option value="11" >Connecticut</option>
           <option value="12" >Delaware</option>
           <option value="13" >District of Columbia</option>
           <option value="14" >Federated States of Miconesia</option>
           <option value="15" >Florida</option>
           <option value="16" >Georgia</option>
           <option value="17" >Guam</option>
           <option value="18" >Hawaii</option>
           <option value="19" >Idaho</option>
           <option value="20" >Illinois</option>
           <option value="21" >Indiana</option>
           <option value="22" >Iowa</option>
           <option value="23" >Kansas</option>
           <option value="24" >Kentucky</option>
           <option value="25" >Louisiana</option>
           <option value="26" >Maine</option>
           <option value="27" >Marshall Islands</option>
           <option value="28" >Maryland</option>
           <option value="29" >Massachusetts</option>
           <option value="30" >Michigan</option>
           <option value="31" >Minnesota</option>
           <option value="32" >Mississippi</option>
           <option value="33" >Missouri</option>
           <option value="34" >Montana</option>
           <option value="35" >Nebraska</option>
           <option value="36" >Nevada</option>
           <option value="37" >New Hampshire</option>
           <option value="38" >New Jersey</option>
           <option value="39" >New Mexico</option>
           <option value="40" >New York</option>
           <option value="41" >North Carolina</option>
           <option value="42" >North Dakota</option>
           <option value="43" >Northern Mariana Islands</option>
           <option value="44" >Ohio</option>
           <option value="45" >Oklahoma</option>
           <option value="46" >Oregon</option>
           <option value="47" >Palau</option>
           <option value="48" >Pennsylvania</option>
           <option value="49" >Puerto Rico</option>
           <option value="50" >Rhode Island</option>
           <option value="51" >South Carolina</option>
           <option value="52" >South Dakota</option>
           <option value="53" >Tennessee</option>
           <option value="54" >Texas</option>
           <option value="55" >Utah</option>
           <option value="56" >Vermont</option>
           <option value="57" >Virgin Islands</option>
           <option value="58" >Virginia</option>
           <option value="59" >Washington</option>
           <option value="60" >West Virginia</option>
           <option value="61" >Wisconsin</option>
           <option value="62" >Wyoming</option>
          </select>
         </div>
         <div class="form-group">
          <label for="city2">City*</label>
          <input type="text" class="form-control" id="city2" placeholder="enter your address" name="city" value="City aaa" required="required">
         </div>
         <div class="form-group">
          <label for="zipcode">Zip Code *</label>
          <input type="text" class="form-control" id="zipcode" placeholder="" name="zipCode" value="51078" required="required">
         </div>
         <div class="form-group">
          <label for="address">Address 1*</label>
          <input type="text" class="form-control" id="address" placeholder="enter your address" name="address" value="Quo nobis tempora qu" required="required">
         </div>
         <div class="form-group">
          <label for="address12">Address 2*</label>
          <input type="text" class="form-control" id="address12" placeholder="enter your address" name="address2" value="djksjdks jdks" required="required">
         </div>

         <div class="form-group">
          <label for="phone2">Height feet *</label>
          <input type="tel" class="form-control" id="phone2" placeholder="" name="heightFeet" value="6" required="required">
         </div>
         <div class="form-group">
          <label for="phone3">Height Inches *</label>
          <input type="tel" class="form-control" id="phone3" placeholder="" name="heightInches" value="72" required="required">
         </div>
         <div class="form-group">
          <label for="phone4">weight *</label>
          <input type="tel" class="form-control" id="phone4" placeholder="" name="weight" value="78" required="required">
         </div>
         <div class="form-group">
          <label for="stateid">Time zones*</label>
          <select class="form-control" name="timezoneId" required="required">
           <option>Select Timezones</option>
           <option value="1">Atlantic Time Zone (UTC-04:00)</option>
           <option value="2">Eastern Time Zone (UTC-05:00)</option>
           <option value="3">Central Time Zone (UTC-06:00)</option>
           <option value="4">Mountain Time Zone (UTC-07:00)</option>
           <option value="5">Pacific Time Zone (UTC-08:00)</option>
           <option value="6">Alaska Time Zone (UTC-09:00)</option>
           <option value="7">Hawaii-Aleutian Time Zone (UTC-10:00)</option>
           <option value="8">Samoa Time Zone (UTC-11:00)</option>
           <option value="9">Chamorro Time Zone (UTC+10:00)</option>
          </select>
         </div>
         <div class="form-group">
          <label for="date4">Disable Notifications *</label>
          <input type="checkbox" id="date4" placeholder="" name="disableNotifications"  value="1" required="required">
         </div>
         <div class="form-group">
          <label for="date4">sendRegistrationNotification *</label>
          <input type="checkbox" id="date4" placeholder="" name="disableNotifications"  value="1" required="required">
         </div>

         <div class="form-group">
          <label for="date3">Allowed Dependents *</label>
          <input type="number" class="form-control" id="date3" placeholder="" name="numAllowedDependents" value="8" required="required">
         </div>

         <div class="form-group">
          <label for="chiefComplaint">language *</label>
          <select id="chiefComplaint" name="translate">
           <option value="en">English</option>
           <option value="es">Spanish</option>
          </select>
         </div>
        </div>
        <div class="required-sec">
         <div class="require-text"><p>* required field</p></div>
         <div class="require-button">
          <input type="submit" class="custom-button movetoStep general-info" name="submit" value="Next Step">
          <!-- <a href="#" class="custom-button movetoStep" data-current="info-step-1" data-prev="info-step-2">Next Step</a> -->
         </div>
        </div>
       </form>
      </div>
     </div>
   
   <div class="information-cont" id="info-step-3" style="display: block;">
    <div class="information-top">
     <h2>3. Medical Condition</h2>
     <p>The following requested information is confidential
     and HIPAA protected.</p>
     <p>Please answer all of the following questions.</p>
    </div>
    <div class="information-bottom">
     <form action="http://localhost/iwilltilimwell/store-medical-condition" id="medical-condition-form">
      <input type="hidden" name="_token" value="i4wnTJDByPjYfb8upFtqKodZ4UYCXiEj3Luz5lml">
      <div class="form-group-outer">
       <div class="form-group">
        <label for="date-cond-1">Medical Condition Name *</label>
        <input type="text" class="form-control" id="date-cond-1" placeholder="" name="medicalConditionName" value="" required="required">
       </div>
       <div class="form-group">
        <label for="date-cond-2">medical Condition Description *</label>
        <input type="text" class="form-control" id="date-cond-2" placeholder="" name="medicalConditionDescription" value="" required="required">
       </div>
       <div class="form-group">
        <label for="stateid">Medical Condition Status*</label>
        <select class="form-control" name="medicalConditionStatus" required="required">
         <option value="">Select status</option>
         <option value="1">Currently Has</option>
         <option value="2">Had in the past</option>
        </select>
       </div>
      </div>
      <div class="required-sec">
       <div class="require-text"><p>* required field</p></div>
       <div class="require-button">
        <input type="submit" class="custom-button movetoStep medicalConditionSubmit" name="submit" value="Next Step">
       </div>
      </div>
     </form>
    </div>
   </div>
   <div class="information-cont infor-second" id="info-step-3" style="display: block;">
    <div class="information-top">
     <h2>4. Medication Details</h2>
    </div>
    <div class="information-bottom">
     <form action="http://localhost/iwilltilimwell/store-medication" id="medication-form">

      <div class="radio-sec">
       <ul>
        <li><strong>Are you taking any Medication ?</strong></li>
        <li><label><input type="radio" id="Yes" name="qforplan" value="male"> Yes</label></li>
        <li><label><input type="radio" id="No" name="qforplan" value="female"> No</label></li>
       </ul> 
      </div>
      <div class="form-group-outer">
       <div class="form-group">
        <label for="medicationName-1">Medication Name *</label>
        <input type="text" class="form-control" id="medicationName-1" placeholder="" name="medicationName" value="paracetamol" required="required">
       </div>
       <div class="form-group">
        <label for="medicationName-2">medication Frequency *</label>
        <input type="text" class="form-control" id="medicationName-2" placeholder="" name="medicationFrequency" value="high" required="required">
       </div>
       <div class="form-group">
        <label for="medicationName-2">medication Comment *</label>
        <input type="text" class="form-control" id="medicationName-3" placeholder="" name="medicationComment" value="for body ache" required="required">
       </div>
       <div class="form-group">
        <label for="stateid">Medication Current Use*</label>
        <select class="form-control" name="medicationCurrentUse" required="required">
         <option value="">Select status</option>
         <option value="true">True</option>
         <option value="false">False</option>
        </select>
       </div>
      </div>
      <div class="required-sec">
       <div class="require-text"><p>* required field</p></div>
       <div class="require-button">
        <input type="submit" class="custom-button movetoStep medicationSubmit" name="submit" value="Next Step">
       </div>
      </div>
     </form>
    </div>
   </div>
   <div class="information-cont infor-second" id="info-step-3" style="display: block;">
    <div class="information-top">
     <h2>4. Medication Allergy</h2>
    </div>
    <div class="information-bottom">
     <form action="http://localhost/iwilltilimwell/store-medication" id="medication-form">
      <div class="radio-sec">
       <ul>
        <li><strong>Are you having any Medication Allergy ?</strong></li>
        <li><label><input type="radio" id="Yes" name="qforplan" value="male"> Yes</label></li>
        <li><label><input type="radio" id="No" name="qforplan" value="female"> No</label></li>
       </ul> 
      </div>
      <div class="form-group-outer">
       <div class="form-group">
        <label for="medicationName-1">Medication Allergy Name *</label>
        <input type="text" class="form-control" id="medicationName-1" placeholder="" name="medicationName" value="paracetamol" required="required">
       </div>
      </div>
      <div class="required-sec">
       <div class="require-text"><p>* required field</p></div>
       <div class="require-button">
        <input type="submit" class="custom-button movetoStep medicationSubmit" name="submit" value="Next Step">
       </div>
      </div>
     </form>
    </div>
   </div>
   <div class="information-cont infor-second" id="info-step-3" style="display: block;">
    <div class="information-top">
     <h2>6. New Consultation</h2>
    </div>
    <div class="information-bottom">
     <form action="http://localhost/iwilltilimwell/store-consultation" id="consultation-form">
      <input type="hidden" name="_token" value="i4wnTJDByPjYfb8upFtqKodZ4UYCXiEj3Luz5lml">
      <div class="form-group">
       <label for="stateid">State*</label>
       <select class="form-control" name="stateid" required="required">
        <option>Select State</option>
        <option value="1" >Alabama</option>
        <option value="2" >Alaska</option>
        <option value="3" selected>American Samoa</option>
        <option value="4" >Arizona</option>
        <option value="5" >Arkansas</option>
        <option value="6" >Armed Forces Americas</option>
        <option value="7" >Armed Forces Non-Americas</option>
        <option value="8" >Armed Forces Pacific</option>
        <option value="9" >California</option>
        <option value="10" >Colorado</option>
        <option value="11" >Connecticut</option>
        <option value="12" >Delaware</option>
        <option value="13" >District of Columbia</option>
        <option value="14" >Federated States of Miconesia</option>
        <option value="15" >Florida</option>
        <option value="16" >Georgia</option>
        <option value="17" >Guam</option>
        <option value="18" >Hawaii</option>
        <option value="19" >Idaho</option>
        <option value="20" >Illinois</option>
        <option value="21" >Indiana</option>
        <option value="22" >Iowa</option>
        <option value="23" >Kansas</option>
        <option value="24" >Kentucky</option>
        <option value="25" >Louisiana</option>
        <option value="26" >Maine</option>
        <option value="27" >Marshall Islands</option>
        <option value="28" >Maryland</option>
        <option value="29" >Massachusetts</option>
        <option value="30" >Michigan</option>
        <option value="31" >Minnesota</option>
        <option value="32" >Mississippi</option>
        <option value="33" >Missouri</option>
        <option value="34" >Montana</option>
        <option value="35" >Nebraska</option>
        <option value="36" >Nevada</option>
        <option value="37" >New Hampshire</option>
        <option value="38" >New Jersey</option>
        <option value="39" >New Mexico</option>
        <option value="40" >New York</option>
        <option value="41" >North Carolina</option>
        <option value="42" >North Dakota</option>
        <option value="43" >Northern Mariana Islands</option>
        <option value="44" >Ohio</option>
        <option value="45" >Oklahoma</option>
        <option value="46" >Oregon</option>
        <option value="47" >Palau</option>
        <option value="48" >Pennsylvania</option>
        <option value="49" >Puerto Rico</option>
        <option value="50" >Rhode Island</option>
        <option value="51" >South Carolina</option>
        <option value="52" >South Dakota</option>
        <option value="53" >Tennessee</option>
        <option value="54" >Texas</option>
        <option value="55" >Utah</option>
        <option value="56" >Vermont</option>
        <option value="57" >Virgin Islands</option>
        <option value="58" >Virginia</option>
        <option value="59" >Washington</option>
        <option value="60" >West Virginia</option>
        <option value="61" >Wisconsin</option>
        <option value="62" >Wyoming</option>
       </select>
      </div>
      <div class="form-group">
       <label for="medicationName-2">Modalities *</label>
       <div class="custom-control custom-checkbox">
        <input type="checkbox" class="custom-control-input" id="customCheck" name="modalities[]" value="phone">
        <label class="custom-control-label" for="customCheck">Phone</label>
       </div>
       <div class="custom-control custom-checkbox">
        <input type="checkbox" class="custom-control-input" id="customCheck-1" name="modalities[]" value="video">
        <label class="custom-control-label" for="customCheck-1">Video</label>
       </div>
      </div>
      <div class="form-group">
       <label for="medicationName-2">phone Number (should be a valid number) *</label>
       <input type="text" class="form-control" id="medicationAllergyDamConceptIdType" name="phoneNumber" value="" required="required">
      </div>
      <div class="form-group">
       <label for="medicationName-2">video Consult Ready Text Number () *</label>
       <input type="text" class="form-control" id="medicationAllergyDamConceptId" name="videoConsultReadyTextNumber" value="12345678" required="required">
      </div>
      <div class="form-group">
       <label for="medicationName-21">sure Script Pharmacy id *</label>
       <input type="text" class="form-control" id="medicationName-21" name="sureScriptPharmacy_id" value="29392" required="required">
      </div>
      <div class="form-group">
       <label for="medicationName-211">Patient Description *</label>
       <input type="text" class="form-control" id="medicationName-211" name="patientDescription" value="Suffering from weakness a nd fever" required="required">
      </div>
      <div class="form-group">
       <label for="chiefComplaint">language *</label>
       <select id="chiefComplaint" name="translate">
        <option value="en">English</option>
        <option value="es">Spanish</option>
       </select>
      </div>
      <div class="form-group">
       <label for="whenScheduled">whenScheduled *</label>
       <input type="date" class="form-control" id="whenScheduled" placeholder="" name="whenScheduled">
      </div>
      <div class="form-group">
       <label for="stateid">Timezones*</label>
       <select class="form-control" name="timezoneOffset" required="required">
        <option>Select Timezones</option>
        <option value="1">Atlantic Time Zone (UTC-04:00)</option>
        <option value="2">Eastern Time Zone (UTC-05:00)</option>
        <option value="3">Central Time Zone (UTC-06:00)</option>
        <option value="4">Mountain Time Zone (UTC-07:00)</option>
        <option value="5">Pacific Time Zone (UTC-08:00)</option>
        <option value="6">Alaska Time Zone (UTC-09:00)</option>
        <option value="7">Hawaii-Aleutian Time Zone (UTC-10:00)</option>
        <option value="8">Samoa Time Zone (UTC-11:00)</option>
        <option value="9">Chamorro Time Zone (UTC+10:00)</option>
       </select>
      </div>
      <div class="form-group">
       <label for="chiefComplaint">Roi *</label>
       <select id="chiefComplaint" name="roi">
        <option value="">Please Select Roi</option>
        <option value="PCP">PCP</option>
        <option value="Urgent Care">Urgent Care</option>
        <option value="Emergency Room">Emergency Room</option>
        <option value="Nothing">Nothing</option>
       </select>
      </div>
      <div class="form-group">
       <label for="chiefComplaint">chief Complaint *</label>
       <select id="chiefComplaint" name="problems[chiefComplaint]">
        <option value="15">&quot;Cold&quot; or &quot;Flu&quot;</option>
        <option value="3">Abdominal pain</option>
        <option value="13">Backache </option>
        <option value="1">Chest pain</option>
        <option value="6">Chills</option>
        <option value="17">Cough</option>
        <option value="5">Diarrhea</option>
        <option value="14">Earache</option>
        <option value="20">Eye problem</option>
        <option value="9">Female problems</option>
        <option value="7">Fever</option>
        <option value="26">Foot pain</option>
        <option value="18">General malaise</option>
        <option value="22">Headache</option>
        <option value="25">Hypertension (High blood pressure)</option>
        <option value="8">Lightheadedness or Dizziness</option>
        <option value="4">Loss of consciousness</option>
        <option value="10">Male problems</option>
        <option value="19">Nausea, vomiting</option>
        <option value="2">Shortness of breath</option>
        <option value="21">Sinus congestion</option>
        <option value="12">Skin rash</option>
        <option value="11">Sore throat</option>
        <option value="24">Tired</option>
        <option value="16">Urinary problems</option>
        <option value="23">Weak</option>
        <option value="27">Multiple</option>
       </select>
      </div>
      <div class="form-group">
       <label for="otherProblems">Other Problems *</label>
       <div class="custom-control custom-checkbox">
        <input type="checkbox" class="custom-control-input" id="problem-18" name="problems[otherProblems][]" value="18">
        <label class="custom-control-label" for="problem-18">General malaise</label>
       </div>
       <div class="custom-control custom-checkbox">
        <input type="checkbox" class="custom-control-input" id="problem-24" name="problems[otherProblems][]" value="24">
        <label class="custom-control-label" for="problem-24">Tired</label>
       </div>
       <div class="custom-control custom-checkbox">
        <input type="checkbox" class="custom-control-input" id="problem-23" name="problems[otherProblems][]" value="23">
        <label class="custom-control-label" for="problem-23">Weak</label>
       </div>
       <div class="custom-control custom-checkbox">
        <input type="checkbox" class="custom-control-input" id="problem-20" name="problems[otherProblems][]" value="20">
        <label class="custom-control-label" for="problem-20">Eye problem</label>
       </div>
       <div class="custom-control custom-checkbox">
        <input type="checkbox" class="custom-control-input" id="problem-8" name="problems[otherProblems][]" value="8">
        <label class="custom-control-label" for="problem-8">Lightheadedness or Dizziness</label>
       </div>
       <div class="custom-control custom-checkbox">
        <input type="checkbox" class="custom-control-input" id="problem-1" name="problems[otherProblems][]" value="1">
        <label class="custom-control-label" for="problem-1">Chest pain</label>
       </div>
       <div class="custom-control custom-checkbox">
        <input type="checkbox" class="custom-control-input" id="problem-25" name="problems[otherProblems][]" value="25">
        <label class="custom-control-label" for="problem-25">Hypertension (High blood pressure)</label>
       </div>
       <div class="custom-control custom-checkbox">
        <input type="checkbox" class="custom-control-input" id="problem-4" name="problems[otherProblems][]" value="4">
        <label class="custom-control-label" for="problem-4">Loss of consciousness</label>
       </div>
       <div class="custom-control custom-checkbox">
        <input type="checkbox" class="custom-control-input" id="problem-2" name="problems[otherProblems][]" value="2">
        <label class="custom-control-label" for="problem-2">Shortness of breath</label>
       </div>
       <div class="custom-control custom-checkbox">
        <input type="checkbox" class="custom-control-input" id="problem-3" name="problems[otherProblems][]" value="3">
        <label class="custom-control-label" for="problem-3">Abdominal pain</label>
       </div>
       <div class="custom-control custom-checkbox">
        <input type="checkbox" class="custom-control-input" id="problem-9" name="problems[otherProblems][]" value="9">
        <label class="custom-control-label" for="problem-9">Female problems</label>
       </div>
       <div class="custom-control custom-checkbox">
        <input type="checkbox" class="custom-control-input" id="problem-10" name="problems[otherProblems][]" value="10">
        <label class="custom-control-label" for="problem-10">Male problems</label>
       </div>
       <div class="custom-control custom-checkbox">
        <input type="checkbox" class="custom-control-input" id="problem-13" name="problems[otherProblems][]" value="13">
        <label class="custom-control-label" for="problem-13">Backache </label>
       </div>
       <div class="custom-control custom-checkbox">
        <input type="checkbox" class="custom-control-input" id="problem-26" name="problems[otherProblems][]" value="26">
        <label class="custom-control-label" for="problem-26">Foot pain</label>
       </div>
       <div class="custom-control custom-checkbox">
        <input type="checkbox" class="custom-control-input" id="problem-15" name="problems[otherProblems][]" value="15">
        <label class="custom-control-label" for="problem-15">&quot;Cold&quot; or &quot;Flu&quot;</label>
       </div>
       <div class="custom-control custom-checkbox">
        <input type="checkbox" class="custom-control-input" id="problem-6" name="problems[otherProblems][]" value="6">
        <label class="custom-control-label" for="problem-6">Chills</label>
       </div>
       <div class="custom-control custom-checkbox">
        <input type="checkbox" class="custom-control-input" id="problem-17" name="problems[otherProblems][]" value="17">
        <label class="custom-control-label" for="problem-17">Cough</label>
       </div>
       <div class="custom-control custom-checkbox">
        <input type="checkbox" class="custom-control-input" id="problem-5" name="problems[otherProblems][]" value="5">
        <label class="custom-control-label" for="problem-5">Diarrhea</label>
       </div>
       <div class="custom-control custom-checkbox">
        <input type="checkbox" class="custom-control-input" id="problem-14" name="problems[otherProblems][]" value="14">
        <label class="custom-control-label" for="problem-14">Earache</label>
       </div>
       <div class="custom-control custom-checkbox">
        <input type="checkbox" class="custom-control-input" id="problem-7" name="problems[otherProblems][]" value="7">
        <label class="custom-control-label" for="problem-7">Fever</label>
       </div>
       <div class="custom-control custom-checkbox">
        <input type="checkbox" class="custom-control-input" id="problem-22" name="problems[otherProblems][]" value="22">
        <label class="custom-control-label" for="problem-22">Headache</label>
       </div>
       <div class="custom-control custom-checkbox">
        <input type="checkbox" class="custom-control-input" id="problem-19" name="problems[otherProblems][]" value="19">
        <label class="custom-control-label" for="problem-19">Nausea, vomiting</label>
       </div>
       <div class="custom-control custom-checkbox">
        <input type="checkbox" class="custom-control-input" id="problem-21" name="problems[otherProblems][]" value="21">
        <label class="custom-control-label" for="problem-21">Sinus congestion</label>
       </div>
       <div class="custom-control custom-checkbox">
        <input type="checkbox" class="custom-control-input" id="problem-12" name="problems[otherProblems][]" value="12">
        <label class="custom-control-label" for="problem-12">Skin rash</label>
       </div>
       <div class="custom-control custom-checkbox">
        <input type="checkbox" class="custom-control-input" id="problem-11" name="problems[otherProblems][]" value="11">
        <label class="custom-control-label" for="problem-11">Sore throat</label>
       </div>
       <div class="custom-control custom-checkbox">
        <input type="checkbox" class="custom-control-input" id="problem-16" name="problems[otherProblems][]" value="16">
        <label class="custom-control-label" for="problem-16">Urinary problems</label>
       </div>
      </div>
      <div class="custom-control custom-checkbox">
       <input type="checkbox" class="custom-control-input" id="acceptInformedConsent-1" name="problems[acceptInformedConsent]" value="1">
       <label class="custom-control-label" for="acceptInformedConsent-1">Accept Consent</label>
      </div>
          <!-- <div class="form-group">
           <label for="medicationName-2">Search medication *</label>
           <input type="text" class="form-control" id="medicationSearch" name="medicationComment" value="" required="required">
          </div> -->
          <!-- <input type="hidden" name="medicationForeignId" id="medicationForeignId">
           <input type="hidden" name="medicationNDC" id="medicationNDC"> -->
           <div class="required-sec">
            <div class="require-text"><p>* required field</p></div>
            <div class="require-button">
             <input type="submit" class="custom-button movetoStep consultationSubmit" name="submit" value="Next Step">
            </div>
           </div>
          </form>
         </div>
        </div>
        <div class="information-cont infor-second" id="info-step-3" style="display: none;">
         <div class="information-top">
          <h2>3. Medical Information</h2>
          <p>The following requested information is confidential
          and HIPAA protected.</p>
          <p>Please answer all of the following questions.</p>
         </div>
         <div class="information-bottom">
          <form action="http://localhost/iwilltilimwell/store-medical-condition">
           <div class="consul-infor">
            <div class="consul-seek">
             <div class="consul-top">
              <p>What is your main reason for seeking counseling?</p>
              <div class="form-group">
               <textarea class="form-control" rows="5" id="comment">enter reason here</textarea>
              </div> 
              <div class="consul-bottom">
               <p>Please rate your current distress regarding this
               concern. Rating scale 1 (low) to 5 (high) ?</p>
               <div class="radio-sec">
                <ul>
                 <li><input type="radio" id="male2" name="gender" value="male">
                  <label for="01">1</label><br></li>
                  <li><input type="radio" id="female2" name="gender" value="female">
                   <label for="02">2</label><br></li>
                   <li><input type="radio" id="male3" name="gender" value="male">
                    <label for="03">3</label><br></li>
                    <li><input type="radio" id="female3" name="gender" value="female">
                     <label for="04">4</label><br></li>
                     <li><input type="radio" id="male4" name="gender" value="male">
                      <label for="05">5</label><br></li>
                     </ul> 
                    </div>
                   </div>
                  </div>
                 </div>
                </div>
                <div class="medical-history">
                 <div class="medical-history-top">
                  <h3>Medical History</h3>
                  <p>Check all that apply</p>
                 </div>
                 <div class="medical-history-bottom">
                  <div class="medical-history-cont">
                   <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" id="customCheck" name="example1">
                    <label class="custom-control-label" for="customCheck">No Medical problems</label>
                   </div>
                   <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" id="customCheck-1" name="example1">
                    <label class="custom-control-label" for="customCheck-1">Allergic Rhinitis</label>
                   </div>
                   <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" id="customCheck-2" name="example1">
                    <label class="custom-control-label" for="customCheck-2">Allergies / Hay Fever</label>
                   </div>
                   <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" id="customCheck-3" name="example1">
                    <label class="custom-control-label" for="customCheck-3">Asthma</label>
                   </div>
                   <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" id="customCheck-4" name="example1">
                    <label class="custom-control-label" for="customCheck-4">Back Problems</label>
                   </div>
                   <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" id="customCheck-5" name="example1">
                    <label class="custom-control-label" for="customCheck-5">Bleeding Disorder</label>
                   </div>
                   <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" id="customCheck-6" name="example1">
                    <label class="custom-control-label" for="customCheck-6">Blood Transfusion</label>
                   </div>
                   <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" id="customCheck-7" name="example1">
                    <label class="custom-control-label" for="customCheck-7">Chron’s Disease</label>
                   </div>
                   <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" id="customCheck-8" name="example1">
                    <label class="custom-control-label" for="customCheck-8">Concussion</label>
                   </div>
                  </div>
                  <div class="medical-history-cont">
                   <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" id="diabetes" name="example1">
                    <label class="custom-control-label" for="diabetes">Diabetes, Type 1</label>
                   </div>
                   <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" id="diabetes-2" name="example1">
                    <label class="custom-control-label" for="diabetes-2">Diabetes, Type 2</label>
                   </div>
                   <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" id="ear" name="example1">
                    <label class="custom-control-label" for="ear">Ear, Nose , Throat Problems</label>
                   </div>
                   <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" id="trouble" name="example1">
                    <label class="custom-control-label" for="trouble">Eye Trouble</label>
                   </div>
                   <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" id="gastrointestinal" name="example1">
                    <label class="custom-control-label" for="gastrointestinal">Gastrointestinal problems</label>
                   </div>
                   <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" id="genetic" name="example1">
                    <label class="custom-control-label" for="genetic">Genetic Disorder</label>
                   </div>
                   <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" id="hearing" name="example1">
                    <label class="custom-control-label" for="hearing">Hearing problem</label>
                   </div>
                   <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" id="heart-disease" name="example1">
                    <label class="custom-control-label" for="heart-disease">Heart Disease</label>
                   </div>
                   <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" id="heart-problems" name="example1">
                    <label class="custom-control-label" for="heart-problems">Heart Problems</label>
                   </div>
                  </div>
                  <div class="medical-history-cont">
                   <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" id="high-blood-pressure" name="example1">
                    <label class="custom-control-label" for="high-blood-pressure">High Blood Pressure</label>
                   </div>
                   <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" id="high-choleserol" name="example1">
                    <label class="custom-control-label" for="high-choleserol">High Choleserol</label>
                   </div>
                   <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" id="liver" name="example1">
                    <label class="custom-control-label" for="liver">Liver or Kidney Problems</label>
                   </div>
                   <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" id="rheumatic" name="example1">
                    <label class="custom-control-label" for="rheumatic">Rheumatic Fever</label>
                   </div>
                   <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" id="seizure" name="example1">
                    <label class="custom-control-label" for="seizure">Seizure Disorder</label>
                   </div>
                   <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" id="transmitted" name="example1">
                    <label class="custom-control-label" for="transmitted">Sexually Transmitted Disease</label>
                   </div>
                   <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" id="stomach" name="example1">
                    <label class="custom-control-label" for="stomach">Stomach or Intestinal Problems</label>
                   </div>
                   <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" id="thyroid" name="example1">
                    <label class="custom-control-label" for="thyroid">Thyroid problems</label>
                   </div>
                   <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" id="uberculosis" name="example1">
                    <label class="custom-control-label" for="uberculosis">uberculosis</label>
                   </div>
                  </div>
                  <div class="medical-history-cont">
                   <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" id="tumor" name="example1">
                    <label class="custom-control-label" for="tumor">Tumor or Cancer</label>
                   </div>
                   <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" id="ulcerative" name="example1">
                    <label class="custom-control-label" for="ulcerative">Ulcerative Colitis</label>
                   </div>
                   <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" id="weakness" name="example1">
                    <label class="custom-control-label" for="weakness">Weakness or Paralysis</label>
                   </div>
                   <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" id="other-medical" name="example1">
                    <label class="custom-control-label" for="other-medical">Other Medical Concerns not listed</label>
                   </div>
                  </div>
                 </div>
                </div>
                <div class="mental-health-outer">
                 <div class="mental-health-left">
                  <div class="mental-health">
                   <h3>Mental Health</h3>
                   <p><input type="radio" id="Mental" name="No Mental problems" value="No Mental problems">
                    <label for="No Mental problems">No Mental problems</label></p>
                    <p><input type="radio" id="Anxiety" name="Anxiety" value="Anxiety">
                     <label for="Anxiety">Anxiety</label></p>
                     <p><input type="radio" id="Depression" name="Depression" value="Depression">
                      <label for="Depression">Depression</label></p>
                      <p><input type="radio" id="disorder" name="Eating disorder" value="Eating disorder">
                       <label for="Eating disorder">Eating disorder</label></p>
                       <p><input type="radio" id="Health" name="Other Mental Health Concerns not listed" value="Other Mental Health Concerns not listed">
                        <label for="Other Mental Health Concerns not listed">Other Mental Health Concerns not listed</label></p>
                       </div>
                       <div class="phyiscal-asses">
                        <h3>Physical Assessment</h3>
                        <p style="font-weight: 600; font-size: 16px; padding-bottom: 20px;">Date if last Physical Exam</p>
                        <div class="form-group">
                         <input type="date" class="form-control" id="date9" placeholder="" name="date">
                        </div>
                        <p>
                         <input type="radio" id="Injuries" name="Injuries not completely healed" value="Injuries not completely healed">
                         <label for="Injuries not completely healed">Injuries not completely healed</label>
                        </p>
                        <p><input type="radio" id="Major " name="Major Injury" value="Major Injury">
                         <label for="Major Injury">Major Injury</label>
                        </p>
                        <p>
                         <input type="radio" id="Medical-Condition" name="Medical Condition" value="Medical Condition">
                         <label for="Medical Condition">Medical Condition requiring care</label>
                        </p>
                        <p>
                         <input type="radio" id="Surgical" name="Surgical procedure advised, but not performed" value="Surgical procedure advised, but not performed">
                         <label for="Yes">Surgical procedure advised, but not performed</label>
                        </p>
                       </div>
                       <div class="phyiscal-asses">
                        <h3>Social History</h3>
                       </div>
                       <p><input type="radio" id="Alcohol" name="Alcohol use" value="Alcohol use">
                        <label for="Alcohol use">Alcohol use</label>
                       </p>
                       <p><input type="radio" id="Drug" name="Drug use" value="Drug use">
                        <label for="Drug use">Drug use</label>
                       </p>
                       <p><input type="radio" id="Eating" name="Eating concerns" value="Eating concerns">
                        <label for="Eating concerns">Eating concerns</label>
                       </p>
                       <p><input type="radio" id="Exercise" name="Exercise" value="Exercise">
                        <label for="Exercise">Exercise</label>
                       </p>
                       <p><input type="radio" id="active" name="Sexually active" value="Sexually active">
                        <label for="Sexually active">Sexually active</label>
                       </p>
                       <p><input type="radio" id="Tobacco" name="Tobacco usage" value="Tobacco usage">
                        <label for="Tobacco usage">Tobacco usage</label>
                       </p>
                       <p><input type="radio" id="Weight" name="Weight concerns" value="Weight concerns">
                        <label for="Weight concerns">Weight concerns</label>
                       </p>
                       <p><input type="radio" id="History" name="Other Social History concerns not listed" value="Other Social History concerns not listed">
                        <label for="Other Social History concerns not listed">Other Social History concerns not listed</label>
                       </p>
                      </div>
                      <div class="mental-health-left">
                       <div class="mental-health">
                        <h3>Women’s Health</h3>
                        <p><input type="radio" id="health-problems" name="No women’s health problems" value="No women’s health problems">
                         <label for="No women’s health problems">No women’s health problems</label>
                        </p>
                        <p><input type="radio" id="Abnormal" name="Abnormal Pap" value="Abnormal Pap">
                         <label for="Abnormal Pap">Abnormal Pap</label>
                        </p>
                        <p><input type="radio" id="Contraception" name="Contraception History" value="Contraception History">
                         <label for="Contraception History">Contraception History</label>
                        </p>
                        <p><input type="radio" id="Currently" name="Currently Pregnant" value="Currently Pregnant">
                         <label for="Currently Pregnant">Currently Pregnant</label>
                        </p>
                        <p><input type="radio" id="Menstrual" name="Menstrual Irregularity" value="Menstrual Irregularity">
                         <label for="Yes">Menstrual Irregularity</label>
                        </p>
                        <p><input type="radio" id="Pregnancy" name="Pregnancy History" value="Pregnancy History">
                         <label for="Pregnancy History">Pregnancy History</label>
                        </p>
                        <p><input type="radio" id="Other-Women’s-Health" name="Other Women’s Health Concerns not listed" value="Other Women’s Health Concerns not listed">
                         <label for="Other Women’s Health Concerns not listed">Other Women’s Health Concerns not listed</label>
                        </p>
                       </div>
                       <div class="phyiscal-asses">
                        <h3>Family History (FH)</h3>
                       </div>
                       <p><input type="radio" id="Family-medical" name="Family medical history unknown" value="Family medical history unknown">
                        <label for="Family medical history unknown">Family medical history unknown</label>
                       </p>
                       <p><input type="radio" id="Alcohol/Drug" name="Alcohol/Drug Issues" value="Alcohol/Drug Issues">
                        <label for="Alcohol/Drug Issues">Alcohol/Drug Issues</label>
                       </p>
                       <p><input type="radio" id="Cancer" name="Cancer" value="Cancer">
                        <label for="Cancer">Cancer</label>
                       </p>
                       <p><input type="radio" id="Death" name="Death Before Age 50" value="Death Before Age 50">
                        <label for="Death Before Age 50">Death Before Age 50</label>
                       </p>
                       <p><input type="radio" id="Diabetes" name="FH Diabetes, Type 1" value="FH Diabetes, Type 1">
                        <label for="FH Diabetes, Type 1">FH Diabetes, Type 1</label>
                       </p>
                       <p><input type="radio" id="FH" name="FH Diabetes, Type 2" value="FH Diabetes, Type 2">
                        <label for="FH Diabetes, Type 2">FH Diabetes, Type 2</label>
                       </p>
                       <p><input type="radio" id="Blood" name="FH High Blood Pressure" value="FH High Blood Pressure">
                        <label for="FH High Blood Pressure">FH High Blood Pressure</label>
                       </p>
                       <p><input type="radio" id="Cholesterol" name="FH High Cholesterol" value="FH High Cholesterol">
                        <label for="FH High Cholesterol">FH High Cholesterol</label>
                       </p>
                       <p><input type="radio" id="Thyroid-Problems" name="FH Thyroid Problems" value="FH Thyroid Problems">
                        <label for="FH Thyroid Problems">FH Thyroid Problems</label>
                       </p>
                       <p><input type="radio" id="Tuberculosis" name="FH Tuberculosis" value="FH Tuberculosis">
                        <label for="FH Tuberculosis">FH Tuberculosis</label>
                       </p>
                       <p><input type="radio" id="Disease/Stroke" name="Heart Disease/Stroke" value="Heart Disease/Stroke">
                        <label for="Heart Disease/Stroke">Heart Disease/Stroke</label>
                       </p>
                       <p><input type="radio" id="Kidney" name="Kidney Disease" value="Kidney Disease">
                        <label for="Kidney Disease">Kidney Disease</label>
                       </p>
                       <p><input type="radio" id="Psychological" name="Psychological Disorder" value="Psychological Disorder">
                        <label for="Psychological Disorder">Psychological Disorder</label>
                       </p>
                       <p><input type="radio" id="Rheumatoid" name="Rheumatoid Arthritis" value="Rheumatoid Arthritis">
                        <label for="Rheumatoid Arthritis">Rheumatoid Arthritis</label>
                       </p>
                       <p><input type="radio" id="Seizures" name="Seizures/Epilepsy" value="Seizures/Epilepsy">
                        <label for="Seizures/Epilepsy">Seizures/Epilepsy</label>
                       </p>
                       <p><input type="radio" id="Family-History" name="Other Family History concerns not listed" value="Other Family History concerns not listed">
                        <label for="Other Family History concerns not listed">Other Family History concerns not listed</label>
                       </p>
                      </div>
                      <div class="mental-health-left">
                       <div class="mental-health">
                        <p style="font-weight: 600; padding-bottom: 10px;">Add additional family history comments here,<br>if needed
                        </p>
                        <div class="form-group">
                         <textarea class="form-control" rows="5" id="comment2">Enter Comments Here</textarea>
                        </div>
                        <p style="font-weight: 600; padding-bottom: 10px;">Add additional family history comments here,<br>if needed
                        </p>
                        <div class="form-group">
                         <textarea class="form-control" rows="5" id="comment3">Enter Comments Here</textarea>
                        </div>
                        <p style="font-weight: 600; padding-bottom: 10px;">Hospitalization / Surgery / Procedures
                        </p>
                        <p><input type="radio" id="Hospitalization" name="No Hospitalization / Surgery / Procedures" value="No Hospitalization / Surgery / Procedures">
                         <label for="No Hospitalization / Surgery / Procedures">No Hospitalization / Surgery / Procedures</label>
                        </p>
                        <p><input type="radio" id="Yes1" name="Yes" value="Yes">
                         <label for="Yes">Yes</label>
                        </p>
                        <div class="form-group">
                         <textarea class="form-control" rows="5" id="comment4">Description</textarea>
                        </div>
                        <p style="padding-bottom:10px;">Approximate Date
                        </p>
                        <div class="form-group">
                         <label for="from">From</label>
                         <input type="date" class="form-control" id="date10" placeholder="" name="date">
                        </div>
                        <div class="form-group">
                         <label for="to">To</label>
                         <input type="date" class="form-control" id="date11" placeholder="" name="date">
                        </div>
                        <p style="font-weight: 600; padding-bottom:20px;">Medications
                        </p>
                        <p><input type="radio" id="Medications" name="No Medications" value="No Medications">
                         <label for="No Medications">No Medications</label>
                        </p>
                        <p><input type="radio" id="Yes2" name="Yes" value="Yes">
                         <label for="Yes">Yes</label>
                        </p>
                        <div class="form-group">
                         <textarea class="form-control" rows="5" id="comment5">Description</textarea>
                        </div>
                        <p style="font-weight: 600; padding-bottom: 10px;">Allergies
                        </p>
                        <p><input type="radio" id="No-Allergies" name="No Allergies" value="No Allergies">
                         <label for="No Allergies">No Allergies</label></p>
                         <p><input type="radio" id="Yes3" name="Yes" value="Yes">
                          <label for="Yes">Yes</label></p>
                          <p style="padding-bottom: 20px;">Name of Substance type of reaction
                          </p>
                          <div class="form-group">
                           <textarea class="form-control" rows="5" id="comment6">Description</textarea>
                          </div>
                          <div class="form-group">
                           <label for="to">Date of Onset</label>
                           <input type="date" class="form-control" id="date12" placeholder="" name="date">
                          </div>
                         </div>
                        </div>
                       </div>
                       <div class="required-sec" style="border: none;">
                        <div class="require-text"></div>
                        <div class="require-button">
                         <a href="#" class="custom-button">Send Answers</a>
                        </div>
                       </div>
                      </div>
                     </form>
                    </div>
                   </div>
                  </div>
                 </section>

                 @endsection

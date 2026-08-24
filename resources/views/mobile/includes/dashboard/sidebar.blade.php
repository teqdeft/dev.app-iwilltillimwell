<nav class="sidebar sidebar-offcanvas" id="sidebar">
   <ul class="nav">
      <li class="nav-item">
         <a class="nav-link" href="{{ url('dashboard') }}">
            <i class="icon-grid menu-icon"></i>
            <span class="menu-title">Dashboard</span>
         </a>
      </li>
      <li class="nav-item hr-list-box">
         <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
            <i class="fas fa-laptop-medical menu-icon"></i>
            <span class="menu-title">Health Record</span>
            <i class="menu-arrow"></i>
         </a>
         <div class="collapse" id="ui-basic">
            <ul class="nav flex-column sub-menu">
               <li class="nav-item"> <a class="nav-link" href="{{ url('personal-record') }}">Personal</a></li>
               <li class="nav-item"> <a class="nav-link" href="{{ url('medications') }}">Medications</a></li>
               <li class="nav-item"> <a class="nav-link" href="{{ url('medication-allergies') }}">Medication Allergies</a></li>
               <li class="nav-item"> <a class="nav-link" href="{{ url('medical-history') }}">Medical Conditions</a></li>
               <li class="nav-item"> <a class="nav-link" href="{{ url('document-manager') }}">Document Manager</a></li>
            </ul>
         </div>
      </li>
      <li class="nav-item">
         <a class="nav-link" data-toggle="collapse" href="#form-elements" aria-expanded="false" aria-controls="form-elements">
            <i class="fas fa-user-md menu-icon"></i>
            <span class="menu-title"><span>Talk to a doctor</span></span>
            <i class="menu-arrow"></i>
         </a>
         <div class="collapse" id="form-elements">
            <ul class="nav flex-column sub-menu">
               <li class="nav-item"><a class="nav-link" href="{{ url('consultation-type') }}">Schedule a Consultation</a></li>
               <li class="nav-item"><a class="nav-link" href="{{ url('my-consultations') }}">My Consultations</a></li>
            </ul>
         </div>
      </li>
      <li class="nav-item">
         <a class="nav-link" href="{{ url('behavioral-health') }}">
            <i class="fas fa-phone-alt menu-icon"></i>
            <span class="menu-title">Talk to a therapist</span>
         </a>
      </li>
      <li class="nav-item">
         <a class="nav-link" href="{{ url('care-coordination') }}">
            <i class="fa fa-medkit menu-icon"></i>
            <span class="menu-title">Care Coordination</span>
         </a>
      </li>
      <li class="nav-item">
         <a class="nav-link" href="{{ url('message-a-specialist') }}">
            <i class="fas fa-comment-medical fa-fw menu-icon"></i>
            <span class="menu-title">Message a Specialist</span>
         </a>
      </li>
      <li class="nav-item">
         <a class="nav-link" data-toggle="collapse" href="#form-elements-1" aria-expanded="false" aria-controls="form-elements-1">
            <i class="fas fa-user-md menu-icon"></i>
            <span class="menu-title"><span>Pet Consultant</span></span>
            <i class="menu-arrow"></i>
         </a>
         <div class="collapse" id="form-elements-1">
            <ul class="nav flex-column sub-menu">
               <li class="nav-item"><a class="nav-link" href="{{ url('pets') }}">Pets</a></li>
               <li class="nav-item"><a class="nav-link" href="{{ url('pets#pets-listing-sec') }}">Talk to a Veterinarian</a></li>
               <li class="nav-item"><a class="nav-link" href="{{ url('pet-consultations') }}">My Pet History</a></li>
            </ul>
         </div>
      </li>
      <li class="nav-item">
         <a class="nav-link" href="{{ url('my-account') }}">
            <i class="far fa-user menu-icon"></i>
            <span class="menu-title">My Account</span>
         </a>
      </li>
   </ul>
</nav>

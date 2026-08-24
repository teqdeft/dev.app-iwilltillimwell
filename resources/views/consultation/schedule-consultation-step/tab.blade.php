<ul class="nav nav-tabs process-model more-icon-preocess" role="tablist">

                                 <li role="presentation"

                                     class="{{ (Request::segment(3) == '' || Request::segment(3) == 'step-1') ? 'active' : '' }}"

                                     id="discove-tab">

                                     <a aria-controls="discover" role="tab" data-toggle="tab">

                                         <i class="fas fa-hospital-user" aria-hidden="true"></i>

                                         <p>Patient</p>

                                     </a>

                                 </li>

                                 <li role="presentation" id="ehr-tab"

                                     class="{{ (Request::segment(3) == 'step-2') ? 'active' : '' }}">

                                     <a class="ehr-link" aria-controls="ehr" role="tab" data-toggle="tab">

                                         <i class="fas fa-laptop-medical" aria-hidden="true"></i>

                                         <p>EHR</p>

                                     </a>

                                 </li>

                                 <li role="presentation"

                                     class="{{ (Request::segment(3) == 'step-3') ? 'active' : '' }}">

                                     <a aria-controls="optimization" role="tab" data-toggle="tab">

                                         <i class="fas fa-mobile-alt" aria-hidden="true"></i>

                                         <p>Phone</p>

                                     </a>

                                 </li>

                                 <li role="presentation"

                                     class="{{ (Request::segment(3) == 'step-4') ? 'active' : '' }}">

                                     <a aria-controls="content" role="tab" data-toggle="tab">

                                         <i class="fas fa-city" aria-hidden="true"></i>

                                         <p>State</p>

                                     </a>

                                 </li>
								 <?php if(request('action')=="urgentcare") { ?>
                                 <li role="presentation"

                                     class="{{ (Request::segment(3) == 'step-5') ? 'active' : '' }}">

                                     <a aria-controls="reporting" role="tab" data-toggle="tab">

                                         <i class="fas fa-notes-medical" aria-hidden="true"></i>

                                         <p>Details</p>

                                     </a>

                                 </li>

                                 <li role="presentation"

                                     class="{{ (Request::segment(3) == 'step-6') ? 'active' : '' }}">

                                     <a aria-controls="schedule" role="tab" data-toggle="tab">

                                         <i class="fas fa-stopwatch" aria-hidden="true"></i>

                                         <p>Schedule</p>

                                     </a>

                                 </li>

                                 <li role="presentation"

                                     class="{{ (Request::segment(3) == 'step-7') ? 'active' : '' }}">

                                     <a aria-controls="pharmacy" role="tab" data-toggle="tab">

                                          <i class="fas fa-file-prescription"></i>
											
                                         <p>Prescription Refills</p>

                                     </a>

                                 </li>
								 
								 <li role="presentation"

                                     class="{{ (Request::segment(3) == 'step-8') ? 'active' : '' }}">

                                     <a aria-controls="pharmacy" role="tab" data-toggle="tab">

                                         <i class="fas fa-solid fa-pills"></i>
                                         <p>Pharmacy</p>

                                     </a>

                                 </li>

                                 
								 
								<?php } ?>


								<?php if(in_array(request('action'), ['primarycare','psychiatry','psychology','dermatology'])) { ?>


								<li role="presentation"

                                     class="{{ (Request::segment(3) == 'step-5') ? 'active' : '' }}">

                                     <a aria-controls="pharmacy" role="tab" data-toggle="tab">

                                         <i class="fas fa-file-prescription"></i>

                                         <p>Prescription Refills</p>

                                     </a>

                                 </li>
								 
								<li role="presentation"

                                     class="{{ (Request::segment(3) == 'step-6') ? 'active' : '' }}">

                                     <a aria-controls="pharmacy" role="tab" data-toggle="tab">

                                         <i class="fas fa-user-md"></i>

                                         <p>Doctors List</p>

                                     </a>

                                 </li>
								<?php if(!in_array(request('action'), ['dermatology'])) { ?>
								<li role="presentation"

                                     class="{{ (Request::segment(3) == 'step-7') ? 'active' : '' }}">

                                     <a aria-controls="pharmacy" role="tab" data-toggle="tab">

                                         <i class="fas fa-notes-medical"></i>


                                         <p>Health Risk Assessment</p>

                                     </a>

                                 </li>
								<?php } ?>
								 
								
	<li role="presentation"
	
			<?php if(!in_array(request('action'), ['dermatology'])) { ?>
                class="{{ (Request::segment(3) == 'step-8') ? 'active' : '' }}"
			<?php } else {?>
				class="tab-link {{ (Request::segment(3) == 'step-7') ? 'active' : 'disabled' }}" 
		<?php } ?>
		
		
	>

                                     <a aria-controls="pharmacy" role="tab" data-toggle="tab">

                                         <i class="fas fa-solid fa-pills"></i>

                                         <p>Pharmacy</p>

                                     </a>

    </li>

	<?php } ?>								
		
		<li role="presentation" class="{{ (Request::segment(3) == 'step-9') ? 'active' : '' }}">
			<a aria-controls="finish" role="tab" data-toggle="tab">

                                         <i class="fas fa-user-check" aria-hidden="true"></i>

                                         <p>Finish</p>

            </a>
		</li>	

</ul>
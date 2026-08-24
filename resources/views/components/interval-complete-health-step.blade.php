<?php $doctorStep = Auth::user()->doctor_step; ?>

<div class="modal fade congrats-modal health-steps-modal" id="intervalCompleteHealthStep" tabindex="-1" role="dialog" aria-labelledby="congrats-modalTitle" aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered" role="document">

        <div class="modal-content">

            <div class="check-icon"><img src="{{ asset('assets/services/images/check-icon.png') }}" alt="check-icon"></div>

            <h3 class="text-center">Please complete Step {{ Auth::user()->doctor_step + 1 }} of 6</h3>

            <div class="progressbar-container">

                     <ul class="progressbar clearfix mt-5 mb-4">

                       <li class="active @if ( $doctorStep >= 0 ) active-done @endif ">Personal Health Records</li>

                       <li class=" @if ( $doctorStep >= 1 ) active @endif @if ( $doctorStep > 1 ) active-done @endif ">Medications</li>

                       <li class=" @if ( $doctorStep >= 2 ) active @endif @if ( $doctorStep > 2 ) active-done @endif " >Medication Allergies</li>

                        <li class=" @if ( $doctorStep >= 3 ) active @endif @if ( $doctorStep > 3 ) active-done @endif " >Medical Conditions</li>

                        <li class=" @if ( $doctorStep >= 4 ) active @endif @if ( $doctorStep > 4 ) active-done @endif " >Surgical Conditions</li>

                         <li class=" @if ( $doctorStep >= 5 ) active @endif @if ( $doctorStep > 5 ) active-done @endif " >Upload Documents</li>

                        <?php /*
                      

                    
                      
                       */ ?>

                     </ul>

                   </div>

            <div class="modal-btn-wrapper text-center">



               @if ( $doctorStep == 0 )

                <a class="btn btn-primary saveAndNextHealth showAddInfoModalHealthStepOne" >Next <i class="fa fa-chevron-right fa-arrow-icon"></i></a>

               @else

               <button type="button" class="btn btn-primary"  data-dismiss="modal" >Next <i class="fa fa-chevron-right fa-arrow-icon"></i></button>

               @endif



            </div>

        </div>

    </div>

</div>


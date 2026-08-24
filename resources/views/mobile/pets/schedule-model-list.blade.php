
<div id="schedule-term-condition" class="modal journal-modal pet-modal-edit">
    <div class="modal-content">
            <span class="close-modal" onclick="CloseModel('schedule-term-condition','none')">
                <img src="{{ asset('assets/dashboard/assets/images/close.svg')}}" alt="icon">
            </span>
            <div class="modal-body">
                <div class="form-ed form-max">
                    <div class="title-ed">
                        <p>Telemedicine Informed Pet Consent</p>
                    </div>
                    <form class="form-row" id="pet-sterm-condition">
                        <div class="pet-content col-100">
                            <ul>
                                <li>This call is being recorded for quality assurance purposes.</li>
                                <li>TeleVet is not for use for medical emergencies or urgent situations.</li>
                                <li>TeleVet should not be considered veterinary care and is not a substitute for
                                    professional veterinary care, diagnosis, treatment or prescription for your pet.
                                </li>
                                <li>TeleVet operates subject to state regulations.</li>
                            </ul>
                        </div>
                        <div class="col-100 mt-20">
                            <div class="custom-checkbox">
                                <input type="checkbox" id="term-condition" name="term-condition">
                                <label for="term-condition">By selecting this box, I hereby state that I have read,
                                    understand, and agree to the terms of the Informed Pet Consent.</label>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="next">
                    <a href="javascript:void(0)" class="open-modal outline-button" data-modal="WhatSeems" onclick="NextTab('1')">Next</a>
                </div>
            </div>
    </div>
</div>



<div id="whatSeems" class="modal journal-modal pet-modal-edit">
        <div class="modal-content">
            <span class="close-modal"  onclick="cancel_tab()">
                <img src="{{ asset('assets/dashboard/assets/images/close.svg')}}" alt="icon">
            </span>
            <div class="modal-body">
                <div class="form-ed form-max-v1">
					<div class="mod-step">
						<div class="prog-bar">
							<p><span>1</span>/<span>4</span></p>
						</div>
						<div class="title-ed">
							<p>Telemedicine Informed Pet Consent</p>
						</div>
					</div>
                    <div class="patient-tab-content v2">
                        <form class="form-row" id="pet-swhatSeems">

                            <div class="col-100 form-group">
                                <div class="inner-title">
                                    <p>Coughing/Sneezing.</p>
                                </div>
                            </div>

    @if( !empty($petProblem) )
         @foreach($petProblem as $key => $value)
                            <div 
							
							@if(in_array($value['petproblem_id'], ["11", "4", "8"]))
								class="col-100 form-group"
							@else 
								class="col-50 form-group"
							@endif
							
							>
                                <div class="custom-checkbox">
                                    <input type="radio" id="problem_{{ $value['petproblem_id'] }}" name="petProblem" value="{{ $value['petproblem_id'] }}">
                                    <label for="problem_{{ $value['petproblem_id'] }}" class="checkbox-label">
                                        <span class="checkbox-indicator"></span>
                                        {{ $value['name'] }}
                                    </label>
                                </div>
                            </div>

        @endforeach
    @endif


                          
                           
                            <div class="col-100 form-group">
                                <label>Additional Notes for the Vet.</label>
                                <textarea name="additional_notes" id="additional_notes" placeholder="Enter here" rows="5"></textarea>
                            </div>

                            <div class="what-seems">
                                <div class="next">
                                    <a href="javascript:void(0)" class="outline-button" onclick="BackToScreen('1')">Back</a>
                                    <a href="javascript:void(0)" class="open-modal outline-button" onclick="NextTab('2')">Next</a>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
</div>



<div id="scheduling-type" class="modal journal-modal pet-modal-edit">
        <div class="modal-content">
            <span class="close-modal" onclick="cancel_tab()">
                <img src="{{ asset('assets/dashboard/assets/images/close.svg')}}" alt="icon">
            </span>
            <div class="modal-body">
                <div class="form-ed form-max-v3">
				<div class="mod-step">
                    <div class="prog-bar">
                        <p><span>2</span>/<span>4</span></p>
                    </div>
                    <div class="title-ed">
                        <p>Scheduling preferences</p>
                    </div>
				</div>
                    <div class="schedu-dis">
                        <div class="icon">
                            <img src="{{ asset('assets/dashboard/assets/images/exclamation-sign.svg')}}" alt="icon">
                            
                        </div>
                        <div class="you-tex">
                            <p>You are scheduling a consult within the next hour, please be sure to check your
                                availability.</p>
                        </div>
                    </div>
                    <div class="title-ed">
                        <p>Select Modality</p>
                    </div>
                    <div class="patient-tab-content">
                        <div class="modal-form">
                            <form id="pet-form-scheduling-type">
                                <div class="col-100 form-group jour-radio">
                                    <div class="custom-radio-group">
                                        <label class="custom-radio">
                                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                    d="M11.6667 18.3333H8.33341C5.19091 18.3333 3.61925 18.3333 2.64341 17.3567C1.66758 16.38 1.66675 14.8092 1.66675 11.6667V8.33334C1.66675 5.19084 1.66675 3.61917 2.64341 2.64334C3.62008 1.66751 5.19925 1.66667 8.35841 1.66667C8.86341 1.66667 9.26758 1.66667 9.60841 1.68084C9.5973 1.74751 9.59175 1.81528 9.59175 1.88417L9.58341 4.24584C9.58341 5.16 9.58341 5.96834 9.67091 6.61917C9.76591 7.325 9.98341 8.03084 10.5601 8.6075C11.1351 9.1825 11.8417 9.40084 12.5476 9.49584C13.1984 9.58334 14.0067 9.58334 14.9209 9.58334H18.2976C18.3334 10.0283 18.3334 10.575 18.3334 11.3025V11.6667C18.3334 14.8092 18.3334 16.3808 17.3567 17.3567C16.3801 18.3325 14.8092 18.3333 11.6667 18.3333ZM4.37508 12.0833C4.37508 11.9176 4.44093 11.7586 4.55814 11.6414C4.67535 11.5242 4.83432 11.4583 5.00008 11.4583H11.6667C11.8325 11.4583 11.9915 11.5242 12.1087 11.6414C12.2259 11.7586 12.2917 11.9176 12.2917 12.0833C12.2917 12.2491 12.2259 12.4081 12.1087 12.5253C11.9915 12.6425 11.8325 12.7083 11.6667 12.7083H5.00008C4.83432 12.7083 4.67535 12.6425 4.55814 12.5253C4.44093 12.4081 4.37508 12.2491 4.37508 12.0833ZM4.37508 15C4.37508 14.8342 4.44093 14.6753 4.55814 14.5581C4.67535 14.4409 4.83432 14.375 5.00008 14.375H9.58341C9.74917 14.375 9.90814 14.4409 10.0254 14.5581C10.1426 14.6753 10.2084 14.8342 10.2084 15C10.2084 15.1658 10.1426 15.3247 10.0254 15.4419C9.90814 15.5592 9.74917 15.625 9.58341 15.625H5.00008C4.83432 15.625 4.67535 15.5592 4.55814 15.4419C4.44093 15.3247 4.37508 15.1658 4.37508 15Z"
                                                    fill="#8462A8" />
                                                <path
                                                    d="M16.1266 6.3475L12.8266 3.37834C11.8874 2.5325 11.4183 2.10917 10.8408 1.88834L10.8333 4.16667C10.8333 6.13084 10.8333 7.11334 11.4433 7.72334C12.0533 8.33334 13.0358 8.33334 14.9999 8.33334H17.9833C17.6816 7.74667 17.1399 7.26 16.1266 6.3475Z"
                                                    fill="#8462A8" />
                                            </svg>
                                            Written
                                            <input type="radio" name="modality" value="video" checked>
                                            <span class="custom-radio-button"></span>
                                        </label>
                                        <label class="custom-radio">
                                            <svg width="21" height="21" viewBox="0 0 21 21" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M10.4999 12.25C9.77078 12.25 9.15099 11.9948 8.64057 11.4844C8.13015 10.974 7.87494 10.3542 7.87494 9.625V4.375C7.87494 3.64583 8.13015 3.02604 8.64057 2.51562C9.15099 2.00521 9.77078 1.75 10.4999 1.75C11.2291 1.75 11.8489 2.00521 12.3593 2.51562C12.8697 3.02604 13.1249 3.64583 13.1249 4.375V9.625C13.1249 10.3542 12.8697 10.974 12.3593 11.4844C11.8489 11.9948 11.2291 12.25 10.4999 12.25ZM9.62494 17.5V15.6844C8.28328 15.4948 7.13499 14.926 6.18007 13.9781C5.22515 13.0302 4.64532 11.8781 4.44057 10.5219C4.4114 10.274 4.47703 10.0625 4.63744 9.8875C4.79786 9.7125 5.00203 9.625 5.24994 9.625C5.49786 9.625 5.70582 9.709 5.87382 9.877C6.04182 10.045 6.15469 10.2527 6.21244 10.5C6.41661 11.5208 6.92353 12.3594 7.73319 13.0156C8.54286 13.6719 9.46511 14 10.4999 14C11.5499 14 12.476 13.6684 13.2781 13.0051C14.0802 12.3419 14.5833 11.5068 14.7874 10.5C14.8458 10.2521 14.9589 10.0444 15.1269 9.877C15.2949 9.70958 15.5026 9.62558 15.7499 9.625C15.9973 9.62442 16.2014 9.71192 16.3624 9.8875C16.5234 10.0631 16.5891 10.2745 16.5593 10.5219C16.3552 11.849 15.7791 12.9937 14.8312 13.9563C13.8833 14.9187 12.7312 15.4948 11.3749 15.6844V17.5C11.3749 17.7479 11.2909 17.9559 11.1229 18.1239C10.9549 18.2919 10.7473 18.3756 10.4999 18.375C10.2526 18.3744 10.0449 18.2904 9.87694 18.123C9.70894 17.9556 9.62494 17.7479 9.62494 17.5Z"
                                                    fill="#8462A8" />
                                            </svg>
                                            Audio
                                            <input type="radio" name="modality" value="phone">
                                            <span class="custom-radio-button"></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-100 form-group mb-v5">
                                    <label>Phone number</label>
                                    <input class="form-control" type="number" name="phone_number" id="phone_number" placeholder="Enter here" onkeyup="lengthValidation(this,'10')">
                                </div>
                                <div class="col-100 mt-20">
                                    <div class="custom-checkbox">
                                        <input type="checkbox" id="doctod1" name="optIn" value="true">
                                        <label for="doctod1">Receive a text message when the doctor starts the video
                                            call. Message and data rates may apply.</label>
                                    </div>
                                </div>
                                <div class="col-100 cta">
                                    <button type="button" class="outline-button" onclick="cancel_tab()">Cancel</button>
                                    <button type="button" class="open-modal primary-button" data-modal="Attachments1" onclick="NextTab('3')">Next</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>


<div id="Attachments1" class="modal journal-modal pet-modal-edit">
        <div class="modal-content">
            <span class="close-modal" onclick="cancel_tab()">
                <img src="{{ asset('assets/dashboard/assets/images/close.svg')}}" alt="icon">
            </span>
            <div class="modal-body upload-img-t">
                <div class="form-ed form-max-v4">
				<div class="mod-step">
                    <div class="prog-bar">
                        <p><span>3</span>/<span>4</span></p>
                    </div>
                    <div class="title-ed">
                        <p>Attachments</p>
                    </div>
				</div>
                    <div class="schedu-dis d-b">
                        <div class="you-tex">
                            <p>Upload your files quickly and easily to share with the veterinarian.</p>
                            <p>Accepted formats: JPEG, PNG, GIF, PDF Max File Size: 5 MB</p>
                        </div>
                    </div>
                    <div class="title-ed1">
                        <p>Upload Multiple Image By Click On Box</p>
                    </div>
                    <form class="form-row" id="SaveScheduleForm" method="post" enctype="multipart/form-data">
                        <div class="upload-multi-image col-100">
                            <div class="uplod-image">
                                <p>Upload Multiple Image By Click On Box</p>
                                <p>Drop files here to upload</p>
                            </div>
                            <div class="file-upload">
                                <input class="imageupload" type="file" id="file" name="file[]" multiple accept="image/*">
                                <label for="file" class="file-label">Choose File</label>
                            </div>
                            <div id="preview" class="preview">
                            </div>
                        </div>
                        <div class="col-100 cta pet-schedule-v1">
                            <button type="button" class="outline-button" onclick="cancel_tab()">Cancel</button>
                            <button type="button" class="open-modal primary-button" data-modal="Attachments1" onclick="SaveSchedule()">Next</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
</div>



<div id="uploadPetProfile" class="modal journal-modal pet-modal-edit">
        <div class="modal-content">
            <span class="close-modal" onclick="cancel_tab()">
                <img src="{{ asset('assets/dashboard/assets/images/close.svg')}}" alt="icon">
            </span>
            <div class="modal-body upload-img-t">
                <div class="form-ed form-max-v5">
				<div class="mod-step">
                    <div class="prog-bar">
                        <p></p>
                    </div>
                    <div class="title-ed">
                        <p>Add / Update Profile Image for</p>
                    </div>
				</div>
                    <div class="schedu-dis d-b">
                        <div class="you-tex">

                            <p>Only JPG or PNG files accepted. Image should be no larger than 200px X 200px</p>
                            
                        </div>
                    </div>
                    <div class="title-ed1">
                        <p>Profile Image </p>
                    </div>
                    <form action="{{ url('pets/profile-upload') }}" enctype="multipart/form-data" method="post">
                        @csrf
                        <div class="upload-multi-image col-100">
                            <div class="uplod-image">
                                <p>Drop files here to upload</p>
                            </div>
                            <div class="file-upload">

                                <input class="imageupload" type="file" id="file_profile" name="petBioImage" multiple accept="image/*">
                                <input type="hidden" name="petIdImage" id="petIdImage" value="0">
                                <label for="file_profile" class="file-label">Choose File</label>

                            </div>
                            <div id="previewProfile" class="preview" style="width: 50%;margin: auto;">
                            </div>
                        </div>
                        <div class="col-100 cta">
                            <button type="submit" class="open-modal primary-button" data-modal="Attachments1">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
</div>



<div id="congratulation" class="modal journal-modal pet-modal-edit">
        <div class="modal-content">
            <span class="close-modal" onclick="cancel_tab()">
                <img src="{{ asset('assets/dashboard/assets/images/close.svg')}}" alt="icon">
            </span>
            <div class="modal-body upload-img-t">
                <div class="form-ed form-max-v7">
                    <div class="title-ed">
                        <p style="text-align: center;">Congratulation</p>
                    </div>
                    <div class="schedu-dis d-b">
                        <div class="you-tex">
                            <p class="congratulation-response"></p>
                            
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
</div>
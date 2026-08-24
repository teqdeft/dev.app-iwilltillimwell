@if(Request::segment(3) == 'step-5')

@php
    $scheduleUrl = url('/schedule-consultation/' . Request::segment(2) . '/step-4/' . Request::segment(4)) . '?action=' . request('action');
    $next_url = url('/schedule-consultation/' . Request::segment(2) . '/step-6/' . Request::segment(4)) . '?action=' . request('action');
@endphp

<div id="details-tab" class="tab-content">
    <div class="patient-tab-content v2">    
        <div class="pat-title">
            <p>Tell Us About Your Problem</p>
        </div>

        <?php $consultation_id = $consultation ? $consultation->id : "" ?>  
        <form action="{{ route('update.consultation', $consultation_id) }}" method="POST" class="form-row">
                @csrf
                <input type="hidden" value="<?php echo request('action')?>" name="action_type" />
                <input type="hidden" name="next-step" value="step-6">     
            <div class="col-100 form-group">
                <label>Choose one.</label>
                <select class="form-control theme-select mx-select" name="cheifComplaint" id="cheifComplaint" required>
                    <option value="">Please Choose One</option>
                    <option value="15" iswarning="0">"Cold" or "Flu"</option>
                    <option value="3" iswarning="1">Abdominal pain</option>
                    <option value="13" iswarning="0">Backache</option>
                    <option value="1" iswarning="1">Chest pain</option>
                    <option value="6" iswarning="0">Chills</option>
                    <option value="17" iswarning="0">Cough</option>
                    <option value="5" iswarning="0">Diarrhea</option>
                    <option value="14" iswarning="0">Earache</option>
                    <option value="20" iswarning="0">Eye problem</option>
                    <option value="9" iswarning="0">Female problems</option>
                    <option value="7" iswarning="0">Fever</option>
                    <option value="26" iswarning="0">Foot pain</option>
                    <option value="18" iswarning="0">General malaise</option>
                    <option value="22" iswarning="0">Headache</option>
                    <option value="25" iswarning="0">Hypertension (High blood
                        pressure)</option>
                    <option value="8" iswarning="0">Lightheadedness or Dizziness
                    </option>
                    <option value="4" iswarning="1">Loss of consciousness</option>
                    <option value="10" iswarning="0">Male problems</option>
                    <option value="19" iswarning="0">Nausea, vomiting</option>
                    <option value="2" iswarning="1">Shortness of breath</option>
                    <option value="21" iswarning="0">Sinus congestion</option>
                    <option value="12" iswarning="0">Skin rash</option>
                    <option value="11" iswarning="0">Sore throat</option>
                    <option value="24" iswarning="0">Tired</option>
                    <option value="16" iswarning="0">Urinary problems</option>
                    <option value="23" iswarning="0">Weak</option>
                    <option value="27" iswarning="0">Multiple</option>
                </select>
            </div>

            <div class="col-100 form-group">
                <div class="inner-title">
                    <p>Common Symptoms</p>
                </div>
            </div>

            <div class="col-50 form-group">
                <div class="custom-checkbox">
                    <input type="checkbox" id="comman_symptons_15" name="otherProblems[]" value="15"/>
                    <label for="comman_symptons_15" class="checkbox-label">
                        <span class="checkbox-indicator"></span>
                        "Cold" or "Flu"
                    </label>
                </div>
            </div>

            <div class="col-50 form-group">
                <div class="custom-checkbox">
                    <input type="checkbox" id="comman_symptons_6" name="otherProblems[]" value="6" />
                    <label for="comman_symptons_6" class="checkbox-label">
                        <span class="checkbox-indicator"></span>
                        Chills
                    </label>
                </div>
            </div>

            <div class="col-50 form-group">
                <div class="custom-checkbox">
                    <input type="checkbox" id="comman_symptons_17" name="otherProblems[]" value="17" />
                    <label for="comman_symptons_17" class="checkbox-label">
                        <span class="checkbox-indicator"></span>
                        Cough
                    </label>
                </div>
            </div>

            <div class="col-50 form-group">
                <div class="custom-checkbox">
                    <input type="checkbox" id="comman_symptons_5"  name="otherProblems[]" value="5"/>
                    <label for="comman_symptons_5" class="checkbox-label">
                        <span class="checkbox-indicator"></span>
                        Diarrhea
                    </label>
                </div>
            </div>

            <div class="col-50 form-group">
                <div class="custom-checkbox">
                    <input type="checkbox" id="comman_symptons_14" name="otherProblems[]" value="14" />
                    <label for="comman_symptons_14" class="checkbox-label">
                        <span class="checkbox-indicator"></span>
                        Earache
                    </label>
                </div>
            </div>

            <div class="col-50 form-group">
                <div class="custom-checkbox">
                    <input type="checkbox" id="comman_symptons_7" name="otherProblems[]" value="7" />
                    <label for="comman_symptons_7" class="checkbox-label">
                        <span class="checkbox-indicator"></span>
                        Fever
                    </label>
                </div>
            </div>

            <div class="col-50 form-group">
                <div class="custom-checkbox">
                    <input type="checkbox" id="comman_symptons_12" name="otherProblems[]" value="12" />
                    <label for="comman_symptons_12" class="checkbox-label">
                        <span class="checkbox-indicator"></span>
                        Headache
                    </label>
                </div>
            </div>

            <div class="col-50 form-group">
                <div class="custom-checkbox">
                    <input type="checkbox" id="comman_symptons_19" name="otherProblems[]" value="19" />
                    <label for="comman_symptons_19" class="checkbox-label">
                        <span class="checkbox-indicator"></span>
                        Nausea, vomiting
                    </label>
                </div>
            </div>

            <div class="col-50 form-group">
                <div class="custom-checkbox">
                    <input type="checkbox" id="comman_symptons_21" name="otherProblems[]" value="21" />
                    <label for="comman_symptons_21" class="checkbox-label">
                        <span class="checkbox-indicator"></span>
                        Sinus congestion
                    </label>
                </div>
            </div>

            <div class="col-50 form-group">
                <div class="custom-checkbox">
                    <input type="checkbox" id="comman_symptons_12_skin" name="otherProblems[]" value="12" />
                    <label for="comman_symptons_12_skin" class="checkbox-label">
                        <span class="checkbox-indicator"></span>
                        Skin rash
                    </label>
                </div>
            </div>

            <div class="col-50 form-group">
                <div class="custom-checkbox">
                    <input type="checkbox" id="comman_symptons_11" name="otherProblems[]" value="11" />
                    <label for="comman_symptons_11" class="checkbox-label">
                        <span class="checkbox-indicator"></span>
                        Sore throat
                    </label>
                </div>
            </div>

            <div class="col-50 form-group">
                <div class="custom-checkbox">
                    <input type="checkbox" id="comman_symptons_16" name="otherProblems[]" value="16" />
                    <label for="comman_symptons_16" class="checkbox-label">
                        <span class="checkbox-indicator"></span>
                        Urinary problems
                    </label>
                </div>
            </div>

            

            


            

            <div class="col-100 form-group">
                <div class="inner-title">
                    <p>All Others Symptoms</p>
                </div>
            </div>

            <div class="col-50 form-group">
                <div class="custom-checkbox">
                    <input type="checkbox" id="other-symptoms-18" name="otherProblems[]" value="18"/>
                    <label for="other-symptoms-18" class="checkbox-label">
                        <span class="checkbox-indicator"></span>
                        General malaise
                    </label>
                </div>
            </div>

            <div class="col-50 form-group">
                <div class="custom-checkbox">
                    <input type="checkbox" id="other-symptoms-24" name="otherProblems[]" value="24"/>
                    <label for="other-symptoms-24" class="checkbox-label">
                        <span class="checkbox-indicator"></span>
                        Tired
                    </label>
                </div>
            </div>

            <div class="col-50 form-group">
                <div class="custom-checkbox">
                    <input type="checkbox" id="other-symptoms-23" name="otherProblems[]" value="23"/>
                    <label for="other-symptoms-23" class="checkbox-label">
                        <span class="checkbox-indicator"></span>
                        Weak
                    </label>
                </div>
            </div>

            <div class="col-50 form-group">
                <div class="custom-checkbox">
                    <input type="checkbox" id="other-symptoms-20" name="otherProblems[]" value="20"/>
                    <label for="other-symptoms-20" class="checkbox-label">
                        <span class="checkbox-indicator"></span>
                        Eye problem
                    </label>
                </div>
            </div>

            

            <div class="col-50 form-group">
                <div class="custom-checkbox">
                    <input type="checkbox" id="Gener1" name="otherProblems[]" value="1"/>
                    <label for="Gener1" class="checkbox-label">
                        <span class="checkbox-indicator"></span>
                        Chest pain
                    </label>
                </div>
            </div>

            

            <div class="col-50 form-group">
                <div class="custom-checkbox">
                    <input type="checkbox" id="other-symptoms-2" name="otherProblems[]" value="2"/>
                    <label for="other-symptoms-2" class="checkbox-label">
                        <span class="checkbox-indicator"></span>
                        Shortness of breath
                    </label>
                </div>
            </div>

            <div class="col-50 form-group">
                <div class="custom-checkbox">
                    <input type="checkbox" id="other-symptoms-3" name="otherProblems[]" value="3"/>
                    <label for="other-symptoms-3" class="checkbox-label">
                        <span class="checkbox-indicator"></span>
                        Abdominal pain
                    </label>
                </div>
            </div>

            <div class="col-50 form-group">
                <div class="custom-checkbox">
                    <input type="checkbox" id="other-symptoms-9" name="otherProblems[]" value="9"/>
                    <label for="other-symptoms-9" class="checkbox-label">
                        <span class="checkbox-indicator"></span>
                        Female problems
                    </label>
                </div>
            </div>

            <div class="col-50 form-group">
                <div class="custom-checkbox">
                    <input type="checkbox" id="other-symptoms-10" name="otherProblems[]" value="10"/>
                    <label for="other-symptoms-10" class="checkbox-label">
                        <span class="checkbox-indicator"></span>
                        Male problems
                    </label>
                </div>
            </div>

            <div class="col-50 form-group">
                <div class="custom-checkbox">
                    <input type="checkbox" id="other-symptoms-13" name="otherProblems[]" value="13"/>
                    <label for="other-symptoms-13" class="checkbox-label">
                        <span class="checkbox-indicator"></span>
                        Backache
                    </label>
                </div>
            </div>

            <div class="col-50 form-group">
                <div class="custom-checkbox">
                    <input type="checkbox" id="other-symptoms-26" name="otherProblems[]" value="26"/>
                    <label for="other-symptoms-26" class="checkbox-label">
                        <span class="checkbox-indicator"></span>
                        Foot pain
                    </label>
                </div>
            </div>
            <div class="col-100 form-group">
                <div class="custom-checkbox">
                    <input type="checkbox" id="other-symptoms-8" name="otherProblems[]" value="8"/>
                    <label for="other-symptoms-8" class="checkbox-label">
                        <span class="checkbox-indicator"></span>
                        Lightheadedness or Dizziness
                    </label>
                </div>
            </div>
            <div class="col-100 form-group">
                <div class="custom-checkbox">
                    <input type="checkbox" id="other-symptoms-25" name="otherProblems[]" value="25"/>
                    <label for="other-symptoms-25" class="checkbox-label">
                        <span class="checkbox-indicator"></span>
                        Hypertension (High blood pressure)
                    </label>
                </div>
            </div>


            <div class="col-100 form-group">
                <div class="custom-checkbox">
                    <input type="checkbox" id="other-symptoms-4" name="otherProblems[]" value="4"/>
                    <label for="other-symptoms-4" class="checkbox-label">
                        <span class="checkbox-indicator"></span>
                        Loss of consciousness
                    </label>
                </div>
            </div>

            <div class="col-100 form-group">
                <div class="inner-title">
                    <p>Describe in Detail</p>
                </div>
            </div>
            <div class="col-100 form-group">
                <textarea placeholder="Enter here" name="patientDescription" id="patientDescription" rows="5"></textarea>
            </div>


            <div class="col-100 cta">
                  <div class="recorc-cta" style="width: 100%;display: flex;justify-content: space-between;align-items: center;margin-top: 20px;">   
                        <a href="{{ $scheduleUrl }}" class="outline-button">Back</a>
                        <button class="primary-button" type="button" onclick="return validate_step()">Next</button>
                  </div>     
            </div>

    </form>
</div>
</div>
<script>
function validate_step(){

    let cheifComplaint = $('#cheifComplaint').val();
    if(cheifComplaint =="") {
        toastr.error("Please select  Option");
        return false;
    } 

    let patientDescription = $('#patientDescription').val();
    if(patientDescription =="") {
        toastr.error("Description Required");
        return false;
    } 
	
	let chief_other_problems = $('input[name="otherProblems[]"]:checked')
        .map(function() {
            return parseInt($(this).val());
        }).get()
						
    scheduleConsultation.cheifComplaint = cheifComplaint;
    scheduleConsultation.patientDescription = patientDescription;
    scheduleConsultation.chief_other_problems = chief_other_problems;
    localStorage.setItem("scheduleConsultation", JSON.stringify(scheduleConsultation));
    window.location.href='{{$next_url}}';
}
$(function(){

    $(".schedule-consultation .back-btn").attr("href", "{{ $scheduleUrl }}");
    $("#cheifComplaint").val(scheduleConsultation.cheifComplaint);
    $("#patientDescription").val(scheduleConsultation.patientDescription??'');
    console.log(scheduleConsultation.chief_other_problems);
	if(scheduleConsultation.chief_other_problems) {
		scheduleConsultation.chief_other_problems.forEach(function(val) {
			const isChecked = $('input[name="otherProblems[]"][value="' + val + '"]').prop('checked', true);;
            console.log('Value: ' + val + ' - Checked: ' + isChecked);
		});
	}
	
	
})
</script>
@endif   
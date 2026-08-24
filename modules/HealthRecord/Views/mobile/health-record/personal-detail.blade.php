<form method="POST" action="{{ route('update.personal.info', $user->id) }}" id="health-record-personal-detail-form">
        @csrf
    <div class="midical-form v1">
        <div class="form-title detail">
            <p>Enter Your Details</p>
        </div>

  
<?php $height_feet = Config::get('constants.height_feet'); ?>
<?php $height_inches = Config::get('constants.height_inches'); ?>
<?php $smokes = Config::get('constants.smoke'); ?>
<?php $drinks = Config::get('constants.drink'); ?>
<?php $blood_types = Config::get('constants.blood_type'); ?>
<?php $exercises = Config::get('constants.exercise'); ?>
<?php $exercise_durations = Config::get('constants.exercise_duration'); ?>
        <div class="form">
            <div class="form-row">

                <div class="col-50 form-group">
                    <label>Height (ft) <span class="required-ico">*</span></label>
                    <select name="heightFeet" id="heightFeet" class="">
                        <option value="">Select</option>
                        @foreach ($height_feet as $key => $feet)
                        <option value="{{ $key }}" {{ showSelectedValue($key, @$user_details->heightFeet) }}>{{ $feet }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-50 form-group">
                    <label>Height (in) <span class="required-ico">*</span></label>
                    <select name="heightInches" id="heightInches">
                        <option value="">Select</option>
                        @foreach ($height_inches as $key => $inches)
                           <option value="{{ $key }}" {{ showSelectedValue($key, @$user_details->heightInches) }}>{{ $inches }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-50 form-group">
                    <label>Do You smoke?</label>
                    <select name="smokingHabits" id="smokingHabits">
                        <option value="">Select</option>
                        @foreach ($smokes as $key => $smoke)
                             <option value="{{ $key }}" {{ showSelectedValue($key, @$user_details->smokingHabits) }}>{{ $smoke }}</option>
                         @endforeach
                    </select>
                </div>

                <div class="col-50 form-group">
                    <label>Do You Drink?</label>
                    <select name="drinkingHabits" id="drinkingHabits">
                        <option value="">Select</option>
                        @foreach ($drinks as $key => $drink)
                        <option value="{{ $key }}" {{ showSelectedValue($key, @$user_details->drinkingHabits) }}>{{ $drink }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-50 form-group">
                    <label>Weight(lbs)</label>
                    <input class="form-control" type="number" name="weight" placeholder="Weight" value="{{ @$user_details->weight }}" oninput="lengthValidation(this,'4')">
                </div>

                <div class="col-50 form-group">
                    <label>Blood Type</label>
                    <select name="bloodType" id="bloodType">
                        <option value="">Select</option>
                        @foreach ($blood_types as $key => $blood_type)
                     <option value="{{ $key }}" {{ showSelectedValue($key, @$user_details->bloodType) }}>{{ $blood_type }}</option>
                     @endforeach
                    </select>
                </div>

                <div class="col-100 form-group">
                    <label>Blood Pressure</label>
                    <input class="form-control" type="text" name="bloodPressureSystolic" placeholder="SYS" value="{{ @$user_details->bloodPressureSystolic }}">
                </div>
                <div class="col-100 form-group mt-2">
                    <input class="form-control" type="text" name="bloodPressureDiastolic" placeholder="DIA" value="{{ @$user_details->bloodPressureDiastolic }}">
                </div>

                <div class="col-100 form-group">
                    <label>Do You Exercise</label>
                    <select name="exerciseHabits" id="exerciseHabits">
                        <option value="">Select</option>
                        @foreach ($exercises as $key => $exercise)
                        <option value="{{ $key }}" {{ showSelectedValue($key, @$user_details->exerciseHabits) }}>{{ $exercise }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-100 form-group">
                    <label>How Long Do You Exercise?</label>
                    <select name="exerciseLength" id="exerciseLength">
                        <option value="">Select</option>
                        @foreach ($exercise_durations as $key => $exercise_duration)
                            @if($key)
                                <option value="{{ $key }}" {{ showSelectedValue($key, @$user_details->exerciseLength) }}>{{ $exercise_duration }}</option>
                             @endif 
                        @endforeach
                    </select>
                </div>

                <div class="col-100 form-group">
                    <label>Marital Status</label>
                    <?php $marital_statuses = Config::get('constants.marital_status'); ?>
                    <select name="maritalStatus" id="maritalStatus">
                        <option value="">Select</option>
                        @foreach ($marital_statuses as $key => $marital_status)
                            @if($key)
                                <option value="{{ $key }}" {{ showSelectedValue($key, @$user_details->maritalStatus) }}>{{ $marital_status }}</option>
                            @endif    
                        @endforeach
                    </select>
                </div>

                <div class="col-100 cta">
                    <div id="health-record-personal-detail"></div>
                    <button type="button" class="primary-button" onclick="helthRecordPersonalFormSubmit()">Next</button>
                </div>

            </div>
        </div>

       

    </div>
</form> 
<script>
let userId = {{ auth()->id() ?? 'null' }}; 
var healthPeroanlLocalValue = {};    
var healthPeroanlLocalValueChange = false;    
$(document).ready(function () {
    
    var heightFeet = @json($user_details->heightFeet ?? '');
    if(!heightFeet) {
        healthPeroanlLocalValueChange = true;
    }
    healthPeroanlLocalValue = getLocalValueStoreForm(healthPeroanlLocalValue,"health-record-personal-detail-form");
    $('#health-record-personal-detail-form input, #health-record-personal-detail-form select').on('change', function() {
        var currentValue = $(this).val();
        var name = $(this).attr('name');
        if(healthPeroanlLocalValue[name] !== currentValue) {
            console.log('Field "' + name + '" has changed');
            healthPeroanlLocalValueChange = true;
        }

    });
    console.log(healthPeroanlLocalValue);
});


function helthRecordPersonalFormSubmit() {
    if(healthPeroanlLocalValueChange) {
        let heightFeet = $("#heightFeet").val();
        if(!heightFeet) {
            toastr.error("Height is Required");
            return false;
        }
        let heightInches = $("#heightInches").val();
        if(!heightInches) {
            toastr.error("Height in inches Required");
            return false;
        }

        let url = $("#health-record-personal-detail-form").attr("action");
        const formData = $("#health-record-personal-detail-form").serialize(); 
        toastr.info('Please wait...', 'Processing', {
                timeOut: 0,
                extendedTimeOut: 0,
            });
        $.ajax({
                method: "POST",
                url:url,
                dataType: "json",
                data:formData,
                success: function(data) {
                    toastr.clear();
                    if(data.success) {
                        toastr.success(data.message);
                        nextTabHealRecoards('next_tab');
                        healthPeroanlLocalValueChange = false;
                    } else {
                        toastr.warning(data.message);
                    }
                },
            });
        return false;    
    }
    nextTabHealRecoards('next_tab');
}


</script>  
   <div class="modal-header theme-bg-color">
      <h3 class="card-title mb-0">Update Personal Information</h3>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
         <span aria-hidden="true">&times;</span>
      </button>
   </div>
   <form class="forms-sample" method="post" action="{{ route('update.personal.info', $user->id) }}" id="personl-record-form">
      <div class="modal-body" >
         {{ csrf_field() }}
         <div class="row">
            <div class="col-sm-6">
               <div class="form-group">
                  <label for="exampleSelectGender">Height</label>
                  <div class="row">
                     <div class="col">
                        <?php $height_feet = Config::get('constants.height_feet'); ?>
                        <select class="form-control theme-select" name="heightFeet">
                           @foreach ($height_feet as $key => $feet)
                           <option value="{{ $key }}" {{ showSelectedValue($key, @$user_details->heightFeet) }}>{{ $feet }}</option>
                           @endforeach
                        </select>
                     </div>
                     <div class="col">
                        <?php $height_inches = Config::get('constants.height_inches'); ?>
                        <select class="form-control theme-select" name="heightInches">
                           @foreach ($height_inches as $key => $inches)
                           <option value="{{ $key }}" {{ showSelectedValue($key, @$user_details->heightInches) }}>{{ $inches }}</option>
                           @endforeach
                        </select>
                     </div>
                  </div>
               </div>
            </div>
            <div class="col-sm-6">
               <div class="form-group">
                  <label for="exampleInputEmail3">Do you smoke?</label>
                  <?php $smokes = Config::get('constants.smoke'); ?>
                  <select class="form-control theme-select" name="smokingHabits">
                     @foreach ($smokes as $key => $smoke)
                     <option value="{{ $key }}" {{ showSelectedValue($key, @$user_details->smokingHabits) }}>{{ $smoke }}</option>
                     @endforeach
                  </select>
               </div>
            </div>
            <div class="col-sm-6">
               <div class="form-group">
                  <label for="exampleInputWeight">Weight(lbs)</label>
                  <input type="text" class="form-control" id="exampleInputWeight" name="weight" placeholder="Weight" value="{{ @$user_details->weight }}">
               </div>
            </div>
            <div class="col-sm-6">
               <div class="form-group">
                  <label for="exampleInputEmail3">Do you Drink?</label>
                  <?php $drinks = Config::get('constants.drink'); ?>
                  <select class="form-control theme-select" name="drinkingHabits">
                     @foreach ($drinks as $key => $drink)
                     <option value="{{ $key }}" {{ showSelectedValue($key, @$user_details->drinkingHabits) }}>{{ $drink }}</option>
                     @endforeach
                  </select>
               </div>
            </div>
            <div class="col-sm-6">
               <div class="form-group">
                  <label for="exampleInputEmail3">Blood Type</label>
                  <?php $blood_types = Config::get('constants.blood_type'); ?>
                  <select class="form-control theme-select" name="bloodType">
                     @foreach ($blood_types as $key => $blood_type)
                     <option value="{{ $key }}" {{ showSelectedValue($key, @$user_details->bloodType) }}>{{ $blood_type }}</option>
                     @endforeach
                  </select>
               </div>
            </div>
            <div class="col-sm-6">
               <div class="form-group">
                  <label for="exampleInputEmail3">Do you exercise?</label>
                  <?php $exercises = Config::get('constants.exercise'); ?>
                  <select class="form-control theme-select" name="exerciseHabits">
                     @foreach ($exercises as $key => $exercise)
                     <option value="{{ $key }}" {{ showSelectedValue($key, @$user_details->exerciseHabits) }}>{{ $exercise }}</option>
                     @endforeach
                  </select>
               </div>
            </div>
            <div class="col-sm-6">
               <div class="form-group">
                  <label for="exampleInputEmail3">Blood Pressure</label>
                  <div class="d-flex">
                     <div>
                        <input type="text" class="form-control" id="exampleInputWeight" name="bloodPressureSystolic"  placeholder="SYS" value="{{ @$user_details->bloodPressureSystolic }}">
                     </div>
                     <div class="slash-box mx-3 d-flex align-items-center">
                        <i class="fas fa-slash" ></i>
                     </div>
                     <div>
                        <input type="text" class="form-control" id="exampleInputWeight" name="bloodPressureDiastolic"  placeholder="DIA" value="{{ @$user_details->bloodPressureDiastolic }}">
                     </div>
                  </div>
               </div>
            </div>
            <div class="col-sm-6">
               <div class="form-group">
                  <label for="exampleInputEmail3">Exercise for how long?</label>
                  <?php $exercise_durations = Config::get('constants.exercise_duration'); ?>
                  <select class="form-control theme-select" name="exerciseLength">
                     @foreach ($exercise_durations as $key => $exercise_duration)
                     <option value="{{ $key }}" {{ showSelectedValue($key, @$user_details->exerciseLength) }}>{{ $exercise_duration }}</option>
                     @endforeach
                  </select>
               </div>
            </div>
            <div class="col-sm-6">
               <div class="form-group">
                  <label for="exampleInputEmail3">Marital Status</label>
                  <?php $marital_statuses = Config::get('constants.marital_status'); ?>
                  <select class="form-control theme-select" name="maritalStatus">
                     @foreach ($marital_statuses as $key => $marital_status)
                     <option value="{{ $key }}" {{ showSelectedValue($key, @$user_details->maritalStatus) }}>{{ $marital_status }}</option>
                     @endforeach
                  </select>
               </div>
            </div>
         </div>
      </div>
      <div class="modal-footer">
         <input type="submit" class="btn btn-primary" value="Save changes" id="submitData">
      </div>
   </form>

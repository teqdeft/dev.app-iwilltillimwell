<div class="tab-pane second-step d-none petAllSteps pets-scheduling" id="step2">
    <div class="panel-heading">
        <h2>Scheduling preferences:</h2>
    </div>
    <div class="second-stepinner">
        <div class="first-sec">
        <p> <i class="fa fa-exclamation-circle" aria-hidden="true"></i>  You are scheduling a consult within the next hour, please be sure to check your availability.</p>
        </div>
        <div class="row info">
        <div class="col-md-6">
            <h3>Select Modality</h3>
            <div class="custom-btn-second">
                <div class="custom-control custom-radio">
                    <input type="radio" id="customRadio1" name="modality" class="custom-control-input" checked value="video">
                    <label class="custom-control-label" for="customRadio1">Video </label>
                </div>
                <div class="custom-control custom-radio">
                    <input type="radio" id="customRadio2" name="modality" class="custom-control-input" value="phone">
                    <label class="custom-control-label" for="customRadio2">Phone</label>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <h3>Phone Number</h3>
            <div class="custom-btn-second-right">
                <input name="phone" id="phone_number" type="text" class="form-control ownerPhoneNumber" placeholder="Phone Number" onkeyup="lengthValidation(this,'10')">
            </div>
            <div class="errorMsg"> 
            </div>
        </div>
        <div class="cust-checkbox col-md-12">
            <div class="custom-checkbox">
                <input name="optIn" class="checkbox-custom" id="noti_6" value="true" type="checkbox">
                <label class="checkbox-custom-label" for="noti_6">  Receive a text message when the doctor starts the video call.<br>
                Message and data rates may apply. </label>
            </div>
        </div>
        </div>
    </div>
</div>
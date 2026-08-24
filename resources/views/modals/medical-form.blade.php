<div class="modal fade" id="madicalFormModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog mt-3" role="document">
        <div class="modal-content modal-lg">
            <div class="modal-header mA">
                <div class="stepContainer">
                </div>
            </div>
            <form action="{{ url('medical-form-by-user') }}" method="post">
                @csrf
                <div class="modal-body">
                    <div class="user-general_info stepCard">
                        <div class="modal-header">
                            <h5 class="modal-title" id="madicalFormTitle" >GENERAL INFORMATION</h5>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" name="fullname" placeholder="Name"
                                        value="{{ $user['name'] }}">
                                    <label>Name</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <select class="form-control" name="gender">
                                        <option value=""> Select Gender </option>
                                        <option @if($user['gender']=='m' ) selected @endif value="m"> Male </option>
                                        <option @if($user['gender']=='f' ) selected @endif value="f"> Female
                                        </option>
                                    </select>
                                    <label>Gender</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-floating mb-3 dob-cal-box">
                                    <input id="date_of_birth" class="form-control user_date_of_birth" name="dob"
                                        required="required" autocomplete="off" placeholder="mm / dd / yyyy"
                                        onkeydown="event.preventDefault()" value="{{ $user['dob'] }}">
                                    <i class="far fa-calendar-alt date-icon" aria-hidden="true"></i>
                                    <label>DOB</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" readonly name="age" placeholder="Age"
                                        value="{{ $age }}">
                                    <label>Age</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-floating mb-3">
                                    <textarea class="form-control" id="homeAddress" name="home_address"
                                        rows="5" style="height: 70px" >{{ $user['address'] }}</textarea>
                                    <label for="homeAddress">Home Address</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <input type="email" class="form-control" id="floatingEmail" name="email"
                                        placeholder="Email" value="{{ $user['email'] }}" readonly>
                                    <label for="floatingEmail">Email </label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="floatingPhone"
                                        placeholder="Phone Number" name="phone" value="{{ $user['primaryPhone'] }}">
                                    <label for="floatingPhone">Phone Number</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <input type="email" class="form-control" name="race_ethnicity"
                                        placeholder="Race/Ethnicity (**Optional)">
                                    <label>Race/Ethnicity (**Optional)</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" placeholder="Country of origin (**Optional)"
                                        name="country_origin">
                                    <label>Country of origin (**Optional)</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <h4>How did you hear about iWILL ‘Til i’mWELL?</h4>
                        </div>
                        <div class="row mb1_5">
                            <div class="col">
                                <label>Are you coming to iWILL ‘Til i’mWELL for counseling?</label>
                                <div class="form-check-inline">
                                    <input class="form-check-input" type="radio" name="counseling" id="inlineRadio1"
                                        value="yes">
                                    <label class="form-check-label" for="inlineRadio1">Yes</label>
                                </div>
                                <div class="form-check-inline">
                                    <input class="form-check-input" type="radio" name="counseling" id="inlineRadio2"
                                        value="no">
                                    <label class="form-check-label" for="inlineRadio2">No</label>
                                </div>
                            </div>
                        </div>
                        <div class="row mb1_5">
                            <div class="col">
                                <label>Are you coming to iWILL ‘Til i’mWELL for medical care?</label>
                                <div class="form-check-inline">
                                    <input class="form-check-input" type="radio" name="medical_care" id="medical_care1"
                                        value="yes">
                                    <label class="form-check-label" for="medical_care1">Yes</label>
                                </div>
                                <div class="form-check-inline">
                                    <input class="form-check-input" type="radio" name="medical_care" id="medical_care2"
                                        value="no">
                                    <label class="form-check-label" for="medical_care2">No</label>
                                </div>
                            </div>
                        </div>
                        <div class="row mb1_5">
                            <div class="col">
                                <label>Have you selected iWILL ‘Til i’mWELL’s family plan?</label>
                                <div class="form-check-inline">
                                    <input class="form-check-input" type="radio" name="family_plan" id="family_plan1"
                                        value="yes">
                                    <label class="form-check-label" for="family_plan1">Yes</label>
                                </div>
                                <div class="form-check-inline">
                                    <input class="form-check-input" type="radio" name="family_plan" id="family_plan2"
                                        value="no">
                                    <label class="form-check-label" for="family_plan2">No</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    @include('modals.counseling_behvioral')

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary displayNone " id="__previewStep" step-no = "0" >Back</button>
                    <button type="button" class="btn btn-primary "  step-no ="0" id="__nextStep">Continue</button>
                </div>
            </form>
        </div>
    </div>
</div>

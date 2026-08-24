@push('scripts')

<script> 
     let newDependentForm = $("#add-dependent-form-depend");
    if (newDependentForm[0]) {
        newDependentForm.validate({
            ignore: ":not(:visible)",
            rules: {
                fname: {
                    required: true,
                    minlength: 3,
                    maxlength: 255
                },
                lname: {
                    required: true,
                    minlength: 3,
                    maxlength: 255
                },
                email: {
                    required: true,
                    validate_email: true
                    
                },
                primaryPhone: {
                    required: true,
                    minlength: 10,
                    maxlength: 19
                },
                status: {
                    required: true,
                },
                address: {
                    required: true,
                    minlength: 3,
                    maxlength: 255
                },
                /* password: {
                    required: true,
                    minlength: 6
                },
                password_confirmation: {
                    required: true,
                    minlength: 6,
                    equalTo: "#password"
                }, */
                dob: {
                    required: true,
                },
                gender: {
                    required: true,
                },
                timezoneId: {
                    required: true,
                },
                city: {
                    required: true,
                    minlength: 3,
                    maxlength: 255
                },
                stateid: {
                    required: true,
                },
                relationship: {
                    required: true,
                },
                zipCode: {
                    required: true,
                },
                gender: {
                    required: true,
                },
            },
            messages: {
                fname: {
                    required: "The first name field is required",
                },
                lname: {
                    required: "The last name field is required",
                },
                email: {
                    required: "The email field is required",
                },
                primaryPhone: {
                    required: "The primary phone field is required",
                },
                status: {
                    required: "The status field is required",
                },
                address: {
                    required: "The address field is required",
                },
                /* password: {
                    required: "The password field is required",
                },
                password_confirmation: {
                    required: "The confirm password field is required",
                    equalTo: "The confirm password not same as password"
                }, */
                dob: {
                    required: "The date of birth field is required",
                },
                gender: {
                    required: "The gender field is required"
                },
                timezoneId: {
                    required: "The timezone field is required"
                },
                city: {
                    required: "The city field is required",
                },
                stateid: {
                    required: "The state field is required",
                },
                relatioship: {
                    required: "The relatioship field is required",
                },
                zipCode: {
                    required: "The zipcode field is required"
                },
                gender: {
                    required: "The gender field is required"
                },
            },
            errorElement: 'span',
            errorPlacement: function(error, element) {
                let type = $(element).attr("type");
                if (type === "checkbox" || type === "radio") {
                    error.insertAfter(element.next());
                } else if ($(element).is("select") && $(element).attr("class").includes('search-selection')) {
                    error.insertAfter(element.next());
                } else {
                    error.insertAfter(element);
                }
            }
        });
    }

</script> 

@endpush 


<div class="tab-pane fade add-new-dependent-content d-none"

             id="new-dependent"

             role="tabpanel"

             aria-labelledby="new-dependent-tab">



            <div class="row personal-info-value-box">

                <div class="col-md-12 grid-margin stretch-card">

                    <div class="card theme-border-0">

                        <div class="card-body px-0 pt-0">



                            <form class="row"

                                  method="POST"

                                  id="add-dependent-form-depend"

                                  action="{{ route('add-dependent') }}"

                                  enctype="multipart/form-data">

                                @csrf



                                {{-- Relationship --}}

                                <div class="col-sm-4">

                                    <div class="form-group">

                                        <label for="new-relationship">

                                            Relationship to {{ $user->name }}

                                        </label>

                                        <select class="form-control theme-select"

                                                id="new-relationship"

                                                name="relationship">

                                            @foreach (config('constants.relationship') as $key => $relation)

                                                <option value="{{ $key }}">{{ $relation }}</option>

                                            @endforeach

                                        </select>

                                    </div>

                                </div>



                                {{-- First Name --}}

                                <div class="col-sm-4">

                                    <div class="form-group">

                                        <label for="new-fname">First Name</label>

                                        <input type="text"

                                               class="form-control"

                                               id="new-fname"

                                               placeholder="First Name"

                                               name="fname"

                                               value="{{ old('fname') }}">

                                    </div>

                                </div>



                                {{-- Last Name --}}

                                <div class="col-sm-4">

                                    <div class="form-group">

                                        <label for="new-lname">Last Name</label>

                                        <input type="text"

                                               class="form-control"

                                               id="new-lname"

                                               placeholder="Last Name"

                                               name="lname"

                                               value="{{ old('lname') }}">

                                    </div>

                                </div>



                                {{-- Date of Birth --}}

                                <div class="col-sm-4">

                                    <div class="form-group">

                                        <label for="new-dob">Date of Birth</label>

                                        <div class="dob-cal-box">

                                            <input id="dependent_dob_add"

                                                   class="form-control "

                                                   name="dob"

                                                   required

                                                   autocomplete="off"

                                                   placeholder="mm / dd / yyyy"

                                                   onkeydown="event.preventDefault()"

                                                   readonly>

                                            <i class="far fa-calendar-alt date-icon"></i>

                                        </div>

                                        <span><b>Note:</b> <span class="text-dark">Please select date of birth from the calendar.</span></span>

                                    </div>

                                </div>



                                {{-- Gender --}}

                                <div class="col-sm-4">

                                    <div class="form-group">

                                        <label>Gender</label>

                                        <div class="d-flex">

                                            <div class="form-check mr-4">

                                                <label class="form-check-label">

                                                    <input type="radio"

                                                           class="form-check-input"

                                                           name="gender"

                                                           id="new-gender-male"

                                                           value="m">

                                                    Male

                                                    <i class="input-helper"></i>

                                                </label>

                                            </div>

                                            <div class="form-check">

                                                <label class="form-check-label">

                                                    <input type="radio"

                                                           class="form-check-input"

                                                           name="gender"

                                                           id="new-gender-female"

                                                           value="f">

                                                    Female

                                                    <i class="input-helper"></i>

                                                </label>

                                            </div>

                                        </div>

                                    </div>

                                </div>



                                {{-- Primary Phone --}}

                                <div class="col-sm-4">

                                    <div class="main-phone-box viewing_records_phone_box">

                                        <label for="new-primaryPhone">

                                            Primary Phone

                                            <span class="fs-12 d-none">

                                                (011 is a required prefix when dialing from the U.S.

                                                Do not add that into this field, it is automatic.)

                                            </span>

                                        </label>

                                        <div class="inputWithIcon inputIconBg">

                                            <input type="tel"

                                                   class="m-0 d-block"

                                                   id="new-primaryPhone"

                                                   name="primaryPhone"

                                                   onkeyup="validLength(this, '10')">

                                            <i class="fas fa-phone-alt" aria-hidden="true"></i>

                                            <a href="#"

                                               class="fs-12 theme-link-txt1 click-here2 d-none click-here">

                                                Click here to add a U.S. Phone Number

                                            </a>

                                        </div>

                                    </div>

                                </div>



                                {{-- Secondary Phone --}}

                                <div class="col-sm-4">

                                    <div class="form-group">

                                        <label for="new-secondaryPhone">Secondary Phone</label>

                                        <input type="tel"

                                               class="form-control"

                                               id="new-secondaryPhone"

                                               placeholder="Secondary Phone"

                                               name="secondaryPhone"

                                               onkeyup="validLength(this, '10')">

                                    </div>

                                </div>



                                {{-- Status --}}

                                <div class="col-sm-4">

                                    <div class="form-group">

                                        <label for="new-status">Status</label>

                                        <select class="form-control theme-select"

                                                id="new-status"

                                                name="status">

                                            @foreach (config('constants.user_status') as $key => $status)

                                                <option value="{{ $key }}">{{ $status }}</option>

                                            @endforeach

                                        </select>

                                    </div>

                                </div>



                                {{-- Address --}}

                                <div class="col-sm-4">

                                    <div class="form-group">

                                        <label for="new-address">Address</label>

                                        <input type="text"

                                               class="form-control"

                                               id="new-address"

                                               placeholder="Address"

                                               name="address">

                                    </div>

                                </div>



                                {{-- Address Line 2 --}}

                                <div class="col-sm-4">

                                    <div class="form-group">

                                        <label for="new-address2">Address Line 2</label>

                                        <input type="text"

                                               class="form-control"

                                               id="new-address2"

                                               placeholder="Address Line 2"

                                               name="address2">

                                    </div>

                                </div>



                                {{-- City --}}

                                <div class="col-sm-4">

                                    <div class="form-group">

                                        <label for="new-city">City</label>

                                        <input type="text"

                                               class="form-control"

                                               id="new-city"

                                               placeholder="City"

                                               name="city">

                                    </div>

                                </div>



                                {{-- State --}}

                                <div class="col-sm-4">

                                    <div class="form-group">

                                        <label for="new-state">State</label>

                                        <select class="form-control theme-select"

                                                id="new-state"

                                                name="stateid">

                                            <option value="">Please select state</option>

                                            @foreach ($states as $state)

                                                <option value="{{ $state->id }}">{{ $state->name }}</option>

                                            @endforeach

                                        </select>

                                    </div>

                                </div>



                                {{-- Zip Code --}}

                                <div class="col-sm-4">

                                    <div class="form-group">

                                        <label for="new-zipCode">Zip Code</label>

                                        <input type="text"

                                               class="form-control"

                                               id="new-zipCode"

                                               placeholder="Zip Code"

                                               name="zipCode"											   onkeyup="validLength(this,'6')"											   											   >

                                    </div>

                                </div>



                                {{-- Timezone --}}

                                <div class="col-sm-4">

                                    <div class="form-group">

                                        <label for="new-timezone">Time Zone</label>

                                        <select class="form-control theme-select"

                                                id="new-timezone"

                                                name="timezoneId">

                                            <option value="">-- SELECT TIMEZONE --</option>

                                            @foreach ($timezones as $timezone)

                                                <option value="{{ $timezone->id }}">{{ $timezone->name }}</option>

                                            @endforeach

                                        </select>

                                    </div>

                                </div>



                                {{-- Profile Image --}}

                                <div class="col-sm-4">

                                    <div class="form-group input-with-img">

                                        <label>

                                            Upload Profile Image

                                            <span class="required-ico">*</span>

                                        </label>

                                        <input type="file"

                                               class="form-control upload_img-v1"

                                               name="profile_image">

                                    </div>

                                </div>



                                <div class="col-sm-12">

                                    <button type="submit" class="btn btn-primary mb-0">Save</button>

                                </div>



                            </form>



                        </div>

                    </div>

                </div>

            </div>

        </div>{{-- /#new-dependent --}}
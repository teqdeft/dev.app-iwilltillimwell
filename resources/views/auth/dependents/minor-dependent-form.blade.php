<form class="row personal-info-value-box"
                          id="update-dependent-form-{{ $dependent->id }}"
                          action="{{ route('update-dependent', $dependent->id) }}"
                          method="POST"
                          enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="dependent-id" value="{{ $dependent->id }}">
                        <input type="hidden" name="fname" value="{{ $dependent->fname }}">
                        <input type="hidden" name="lname" value="{{ $dependent->lname }}">

                        <div class="col-md-12 grid-margin stretch-card">
                            <div class="card theme-border-0">
                                <div class="card-body px-0 pt-0">
                                    <div class="row">

                                        {{-- First Name --}}
                                        <div class="col-xl-4">
                                            <div class="inner-details-box">
                                                <label>First Name</label>
                                                <h3 class="text-primary fs-20 font-weight-medium">
                                                    {{ ucfirst($dependent->fname) }}
                                                </h3>
                                            </div>
                                        </div>

                                        {{-- Last Name --}}
                                        <div class="col-xl-4">
                                            <div class="inner-details-box">
                                                <label>Last Name</label>
                                                <h3 class="text-primary fs-20 font-weight-medium">
                                                    {{ ucfirst($dependent->lname) }}
                                                </h3>
                                            </div>
                                        </div>

                                        {{-- Date of Birth --}}
                                        <div class="col-xl-4">
                                            <div class="inner-details-box">
                                                <label>Date of Birth</label>
                                                <h3 class="text-primary fs-20 font-weight-medium">
                                                    {{ $dependent->dob }}
                                                </h3>
                                            </div>
                                        </div>

                                        {{-- Primary Phone --}}
                                        <div class="col-sm-4">
                                            <div class="main-phone-box viewing_records_phone_box">
                                                <label for="primaryPhone-{{ $dependent->id }}">
                                                    Primary Phone
                                                    <span class="fs-12 d-none">
                                                        (011 is a required prefix when dialing from the U.S.
                                                        Do not add that into this field, it is automatic.)
                                                    </span>
                                                </label>
                                                <div class="inputWithIcon">
                                                    <input type="tel"
                                                           class="form-control"
                                                           id="primaryPhone-{{ $dependent->id }}"
                                                           name="primaryPhone"
                                                           value="{{ old('primaryPhone', $dependent->primaryPhone) }}"
                                                           onkeyup="validLength(this, '10')">
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
                                                <label for="secondaryPhone-{{ $dependent->id }}">Secondary Phone</label>
                                                <input type="tel"
                                                       class="form-control"
                                                       id="secondaryPhone-{{ $dependent->id }}"
                                                       placeholder="Secondary Phone"
                                                       name="secondaryPhone"
                                                       value="{{ old('secondaryPhone', $dependent->secondaryPhone) }}"
                                                       onkeyup="validLength(this, '10')">
                                            </div>
                                        </div>

                                        {{-- Gender --}}
                                        <div class="col-xl-4">
                                            <div class="inner-details-box">
                                                <label>Gender</label>
                                                <div class="d-flex">
                                                    <div class="form-check mr-4">
                                                        <label class="form-check-label">
                                                            <input type="radio"
                                                                   class="form-check-input"
                                                                   name="gender"
                                                                   id="gender-male-{{ $dependent->id }}"
                                                                   value="m"
                                                                   @checked($dependent->gender === 'm')>
                                                            Male
                                                            <i class="input-helper"></i>
                                                        </label>
                                                    </div>
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input type="radio"
                                                                   class="form-check-input"
                                                                   name="gender"
                                                                   id="gender-female-{{ $dependent->id }}"
                                                                   value="f"
                                                                   @checked($dependent->gender === 'f')>
                                                            Female
                                                            <i class="input-helper"></i>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        {{-- Address --}}
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label for="address-{{ $dependent->id }}">Address</label>
                                                <input type="text"
                                                       class="form-control"
                                                       id="address-{{ $dependent->id }}"
                                                       placeholder="Address"
                                                       name="address"
                                                       value="{{ old('address', $dependent->address) }}">
                                            </div>
                                        </div>

                                        {{-- Address Line 2 --}}
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label for="address2-{{ $dependent->id }}">Address Line 2</label>
                                                <input type="text"
                                                       class="form-control"
                                                       id="address2-{{ $dependent->id }}"
                                                       placeholder="Address Line 2"
                                                       name="address2"
                                                       value="{{ old('address2', $dependent->address2) }}">
                                            </div>
                                        </div>

                                        {{-- City --}}
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label for="city-{{ $dependent->id }}">City</label>
                                                <input type="text"
                                                       class="form-control"
                                                       id="city-{{ $dependent->id }}"
                                                       placeholder="City"
                                                       name="city"
                                                       value="{{ old('city', $dependent->city) }}">
                                            </div>
                                        </div>

                                        {{-- State --}}
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label for="state-{{ $dependent->id }}">State</label>
                                                <select class="form-control theme-select"
                                                        id="state-{{ $dependent->id }}"
                                                        name="stateid">
                                                    <option value="">Please select state</option>
                                                    @foreach ($states as $state)
                                                        <option value="{{ $state->id }}"
                                                                @selected($state->id == $dependent->stateid)>
                                                            {{ $state->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        {{-- Zip Code --}}
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label for="zipCode-{{ $dependent->id }}">Zip Code</label>
                                                <input type="text"
                                                       class="form-control"
                                                       id="zipCode-{{ $dependent->id }}"
                                                       placeholder="Zip Code"
                                                       name="zipCode"
                                                       value="{{ old('zipCode', $dependent->zipCode) }}">
                                            </div>
                                        </div>

                                        {{-- Timezone --}}
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label for="timezone-{{ $dependent->id }}">Time Zone</label>
                                                <select class="form-control theme-select"
                                                        id="timezone-{{ $dependent->id }}"
                                                        name="timezoneId">
                                                    <option value="">-- SELECT TIMEZONE --</option>
                                                    @foreach ($timezones as $timezone)
                                                        <option value="{{ $timezone->id }}"
                                                                @selected($timezone->id == $dependent->timezoneId)>
                                                            {{ $timezone->name }}
                                                        </option>
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

                                                @if (!empty($dependent->profile_image) && file_exists(public_path('profiles/' . $dependent->profile_image)))
                                                    <div class="img-close-icon">
                                                        <div class="img-box">
                                                            <img src="{{ asset('profiles/' . $dependent->profile_image) }}"
                                                                 width="100"
                                                                 alt="Profile Image">
                                                        </div>
                                                        <a class="deleteByAjax"
                                                           data-url="{{ route('profile-img-deleted') }}"
                                                           number="{{ $dependent->id }}">X</a>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>

                                        {{-- Email (hidden by default) --}}
                                        <div class="col-sm-4 dependent-email-cnt d-none">
                                            <div class="form-group">
                                                <label for="email-{{ $dependent->id }}">Email</label>
                                                <input type="email"
                                                       class="form-control"
                                                       id="email-{{ $dependent->id }}"
                                                       placeholder="Email"
                                                       name="email">
                                            </div>
                                        </div>

                                        <div class="col-sm-12">
                                            <button type="submit" class="btn btn-primary mr-3">Save</button>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
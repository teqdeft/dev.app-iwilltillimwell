@extends('layouts.dashboard')
@section('content')
@php
    $optionData = [
        [ 'label' => 'Is your organization enrolled in medical care?',
            'name'  => 'medical_care',
            'id'    => 'medical_care',
            'value' => ['yes','no']],
        [ 'label' => 'Is your organization enrolled in mental health?',
            'name'  => 'counseling',
            'id'    => 'counseling' ],
        [ 'label' => 'Is your organization enrolled in pet care?',
            'name'  => 'pet_care',
            'id'    => 'pet_care',]

    ];
@endphp
<div class="main-panel main-panel-for-modal-page">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12 grid-margin top-header-page">
                <div class="row">
                    <div class="col-12 col-xl-6 mb-4 mb-xl-0">
                        <h3 class="font-weight-bold">Profile</h3>
                        {{-- <h6 class="font-weight-normal mb-0">General information</h6> --}}
                    </div>
                </div>
            </div>
            <div class="col-md-12 align-items-stretch">
                <div class="row">
                    <div class="col-md-12 grid-margin stretch-card">
                        <div class="card health-card">
                            <div class="card-body">
                                <div class="health-summary-box mb-4">
                                    <h4 class="card-title">General Information</h4>
                                    <form action="{{ url('share/save-user-data') }}" id="user-{{ $type }}" method="post">
                                        @csrf
                                        <input type="hidden" name="type" value="{{ $type }}" />
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-floating mb-3">
                                                    <input type="text" class="form-control" name="fullname" placeholder="Name"
                                                        value="{{ $user['name']??'' }}">
                                                    <label>Name</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-floating mb-3">
                                                    <select class="form-control" name="gender">
                                                        <option value=""> Select Gender </option>
                                                        <option {{ selectedOption($user['gender']??'','m') }} value="m"> Male </option>
                                                        <option {{ selectedOption($user['gender']??'','f') }} value="f"> Female
                                                        </option>
                                                        <option {{ selectedOption($user['gender']??'','non-binary') }} value="non-binary"> Non- Binary </option>
                                                        <option {{ selectedOption($user['gender']??'','other') }} value="other"> Other </option>
                                                    </select>
                                                    <label>Gender</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-floating mb-3 dob-cal-box">
                                                    <input id="date_of_birth" class="form-control user_date_of_birth" name="dob"
                                                        required="required" autocomplete="off" placeholder="mm / dd / yyyy"
                                                        onkeydown="event.preventDefault()" value="{{ $user['dob']??'' }}">
                                                    <i class="far fa-calendar-alt date-icon" aria-hidden="true"></i>
                                                    <label>DOB</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-floating mb-3">
                                                    <input type="text" class="form-control" readonly name="age" placeholder="Age"
                                                        value="{{ $age??'' }}">
                                                    <label>Age</label>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-floating mb-3">
                                                    <textarea class="form-control" id="homeAddress" name="home_address"
                                                        rows="5" style="height: 70px" >{{ $user['address']??'' }}</textarea>
                                                    <label for="homeAddress">Home Address</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-floating mb-3">
                                                    <input type="email" class="form-control" id="floatingEmail" name="email"
                                                        placeholder="Email" value="{{ Auth::user()->email }}" readonly>
                                                    <label for="floatingEmail">Email</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-floating mb-3">
                                                    <input type="text" class="form-control phone_number" id="floatingPhone"
                                                        placeholder="Phone Number" name="phone" value="{{ $user['primaryPhone']??'' }}" >
                                                    <label for="floatingPhone">Phone Number</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-floating mb-3">
                                                    <input type="text" class="form-control" name="race_ethnicity"
                                                        placeholder="Race/Ethnicity (**Optional)" value="{{ $userMeta['race_ethnicity']??'' }}">
                                                    <label>Race/Ethnicity (Optional)</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-floating mb-3">
                                                    <input type="text" class="form-control" placeholder="Country of origin (Optional)"
                                                        name="country_origin" value="{{ $userMeta['country_origin']??'' }}">
                                                    <label>Country of origin (Optional)</label>
                                                </div>
                                            </div>
                                            <div class="col-md-12 mb1_5">
                                                <h4>How did you hear about iWILL'til i'mWELL?</h4>
                                                <textarea class="form-control" name="About_iWILLtilimWELL"
                                                        rows="5" >{{ $userMeta['About_iWILLtilimWELL']??'' }}</textarea>
                                            </div>
                                            <!--<div class="col-md-12">
                                                <div class="form-floating mb-3">
                                                    <input type="text" class="form-control" name="user_unique_id"
                                                        placeholder="Employee ID/Member ID/Student ID" value="{{ $userMeta['user_unique_id']??'' }}">
                                                    <label>Employee ID/Member ID/Student ID</label>
                                                </div>
                                            </div>-->

                                            @foreach ($optionData as $key => $value )
                                                <div class="col-md-12 mbm-15">
                                                    <label>{{ $value['label'] }}</label>
                                                    @for ($i = 0;$i < 2;$i++)
                                                        <div class="form-check-inline">
                                                            <input class="form-check-input checkUserServices" {{ checkedIcon($services[$value['name']]??'',$optionData[0]['value'][$i]) }} type="radio" name="{{ $value['name'] }}" id="{{ $value['name'].$i }}"
                                                                value="{{ $optionData[0]['value'][$i] }}">
                                                            <label class="form-check-label" for="{{ $value['name'].$i }}">{{ ucfirst($optionData[0]['value'][$i]) }}</label>
                                                        </div>
                                                    @endfor
                                                </div>
                                            @endforeach
                                            <div class="col-sm-12 mt-3">
                                                <div class="form-group">
                                                    <button type="submit"  name="submit" class="btn btn-primary mr-10 float-right user_submit-profile-consent checkAllCheckedNo" id="submit">Next <i class="fa fa-chevron-right fa-arrow-icon"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
     @if ( checkProfileComplete() )
        <x-complete-profile-modal showAnchor="false" />
    @endif
    <x-error-messages-modal />

@endsection

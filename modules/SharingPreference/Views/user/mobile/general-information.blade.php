
@extends('mobile.layouts.dashboard')
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


<section class="record-header">
        <div class="cust-container-md">
            <div class="rec-row">
                <div class="back">
                    <a href="{{ route('mobile-dashboard')}}" class="back-btn">
                        <img src="{{ asset('assets/dashboard/assets/images/left-errow.png')}}" alt="back icon">
                    </a>
                </div>
                <div class="top-title">
                    <h2 class="title">General information</p>
                </div>
                <div class="screen-number d-n">
                   
                </div>
            </div>
        </div>
</section>

<section class="care-cordin my-setting">
    <div class="cust-container-md">
        <div class="sup-t">
            <p>Profile</p>
        </div>

        <form action="{{ url('share/save-user-data') }}" id="user-{{ $type }}" method="post">
        @csrf
        <input type="hidden" name="type" value="{{ $type }}" />
        <input type="hidden" name="request_from" value="general-information" />
            <div class="form patient-tab-content">
                <div class="form-row">

                    <div class="col-100 form-group">
                        <label>Name</label>
                        <input class="form-control" type="text" name="fullname" value="{{ $user['name']??'' }}">
                    </div> 

                   
                   

                    <div class="col-100 form-group">
                        <label>Gender</label>
                        <select class="form-control" name="gender">

                            <option value=""> Select Gender </option>
                            <option {{ selectedOption($user['gender']??'','m') }} value="m"> Male </option>
                            <option {{ selectedOption($user['gender']??'','f') }} value="f"> Female</option>
                            <option {{ selectedOption($user['gender']??'','non-binary') }} value="non-binary"> Non- Binary </option>
                            <option {{ selectedOption($user['gender']??'','other') }} value="other"> Other </option>
                                                    
                        </select>    
                    </div> 

                    <div class="col-100 form-group ">
                        <label>DOB</label>
                        <input class="form-control datepicker-ico" type="text" name="dob" id="dob" value="{{ $user['dob']??'' }}">
                    </div> 

                    

                    <div class="col-100 form-group">
                        <label>Age</label>
                        <input class="form-control" type="text" name="age" value="{{ getAgeNumber($user['dob']) }}" readonly>
                    </div> 
                     
                     
                    <div class="col-100 form-group">
                        <label>Home Address</label>
                        <input class="form-control" type="text" name="address" value="{{ $user['address']??'' }}">
                    </div>
                    <div class="col-100 form-group">
                        <label>Email</label>
                        <input class="form-control" type="email" name="address" value="{{ Auth::user()->email }}" readonly>
                    </div>  
                    <div class="col-100 form-group">
                        <label>Phone</label>
                        <input class="form-control" type="text" name="phone" value="{{ $user['primaryPhone']??'' }}" readonly>
                    </div>

                    <div class="col-100 form-group">
                        <label>Race/Ethnicity (*Optional)</label>
                        <input class="form-control" type="text" name="race_ethnicity" value="{{ $userMeta['race_ethnicity']??'' }}" >
                    </div>
                    <div class="col-100 form-group">
                        <label>Country of origin (*Optional)</label>
                        <input class="form-control" type="text" name="country_origin" value="{{ $userMeta['country_origin']??'' }}" >
                    </div>
                    <div class="col-100 form-group">
                        <label>How did you hear about imWELL?</label>
                        <textarea rows="4" type="text" name="About_iWILLtilimWELL">{{ $userMeta['About_iWILLtilimWELL']??'' }}</textarea>
                    </div>
                    <div class="col-100 form-group">
                        <label>Employee ID/Member ID/Student ID</label>
                        <input class="form-control" type="text" name="user_unique_id" value="{{ $userMeta['user_unique_id']??'' }}" >
                    </div>
                    



@if(in_array($user->planDetailsId, Config::get('constants.organization_plan')))
                    @foreach ($optionData as $key => $value )
                        <div class="col-100 form-group">
                            <label>{{ $value['label'] }}</label>
                            <div class="custom-radio-group indicate-radio">
                            @for ($i = 0;$i < 2;$i++)
                                <label class="custom-radio">
                                    <input type="radio" {{ checkedIcon($services[$value['name']]??'',$optionData[0]['value'][$i]) }} name="{{ $value['name'] }}"  value="{{ $optionData[0]['value'][$i] }}" id="{{ $value['name'].$i }}">
                                    <span class="custom-radio-button"></span>
                                        {{ ucfirst($optionData[0]['value'][$i]) }}
                                </label>
                                @endfor
                            </div>
                        </div>
                        @endforeach
@endif 
                        

                    <div class="col-100 cta">

                    <button type="submit" class="primary-button">Save</button>

                    </div>

                    
                </div>
            </div>
        </form>


    </div>
</section>



<link rel="stylesheet" href="https://code.jquery.com/ui/1.14.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="https://code.jquery.com/ui/1.14.1/jquery-ui.js"></script>
<script>
let today = new Date();
let eighteenYearsAgo = new Date();
eighteenYearsAgo.setFullYear(today.getFullYear() - <?php echo config('constants.age_limit') ?>); 
$( function() {
    $( "#dob" ).datepicker({
        changeYear: true,
        yearRange: "-90:",
        dateFormat: "mm/dd/yy",
        maxDate: eighteenYearsAgo
    });
});
</script>

<style>

.datepicker-ico {
    display: block;
    position: relative;
    border: 1px solid #8292A2 !important;
    background-image: url(../../../mobile-images/calendar-icon.png) !important;
    background-repeat: no-repeat !important;
    background-size: 20px 20px !important;
    cursor: text;
    border: 1px solid #DDDDDD !important;
    border-radius: 5px !important;
    background-position: 97% 15px !important;
}
</style>    

@include('mobile.includes.foooter-tab') 
@endsection

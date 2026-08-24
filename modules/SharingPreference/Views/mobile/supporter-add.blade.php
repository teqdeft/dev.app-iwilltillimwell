@extends('mobile.layouts.dashboard')
@section('content')
<section class="msg-special-header">
        <div class="cust-container-md">
            <div class="rec-row">

                <div class="back">
                    <a href="{{ url('share/add/setting')}}" class="back-btn">
                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M12.875 16.0417L7.33334 10.5L12.875 4.95834" stroke="#222A3D"
                                stroke-width="1.58333" stroke-linecap="round" stroke-linejoin="round"></path>
                        </svg>
                    </a>
                </div>

                <div class="top-title">
                    <h2 class="title">
                        @if($data)
                             Edit  Supporter’s   
                        @else

                        Add Supporter’s

                        @endif 
                    </h2>
                </div>

            </div>
        </div>
</section>

<section class="care-cordin my-setting">
        <div class="cust-container-md">

            <div class="sup-t">
                <p>Fill Information</p>
            </div>



           
<form @if($data)  action="{{ url('share/saveFriendContactData') }}" @else action="{{ url('share/addMailAndPhone') }}" @endif id="supporterDetails" method="POST">
@csrf
@if($data)
    <input type="hidden" value="{{ $data[0]['id'] }}" name="id" >
@endif   
            <div class="form">
                <div class="form-row">
                    <div class="col-50 form-group">
                        <label>First name <span class="required-ico">*</span> </label>
                        <input class="form-control" type="text" name="first_name" id="first_name" @if($data) value="{{$data[0]['first_name']}}" @endif>
                    </div>
                    <div class="col-50 form-group">
                        <label>Last name <span class="required-ico">*</span> </label>
                        <input class="form-control" type="text" name="last_name" id="last_name"  @if($data) value="{{$data[0]['last_name']}}" @endif>
                    </div>

                    <div class="col-100 form-group">
                        <label>Relationship <span class="required-ico">*</span></label>
                        <select id="relation" name="relation">
                                <option value="" >Relationship</option>
                               
                                <option value="Spouse" @if(isset($data[0]) && $data[0]['relation'] == 'Spouse') selected @endif>Spouse</option>
                                <option value="Mother" @if(isset($data[0]) && $data[0]['relation'] == 'Mother') selected @endif>Mother</option>
                                <option value="Father" @if(isset($data[0]) && $data[0]['relation'] == 'Father') selected @endif>Father</option>
                                <option value="Siblings" @if(isset($data[0]) && $data[0]['relation'] == 'Siblings') selected @endif>Siblings</option>
                                <option value="Friend" @if(isset($data[0]) && $data[0]['relation'] == 'Friend') selected @endif>Friend</option>
                                <option value="Others" @if(isset($data[0]) && $data[0]['relation'] == 'Others') selected @endif>Others</option>
                                <?php /* */ ?>
                        </select>
                    </div>

                    <div class="col-100 form-group">
                        <label>Email <span class="required-ico">*</span></label>
                        <input class="form-control" type="email" name="email" id="email" @if($data) value="{{$data[0]['email']}}" @endif>
                    </div>

                    <div class="col-100 form-group">
                        <label>Phone number <span class="required-ico">*</span></label>
                        <input onkeyup="lengthValidation(this,'10')" class="form-control" type="text" name="phone" id="phone" @if($data) value="{{$data[0]['phone']}}" @endif>
                    </div>

                    <div class="col-100 form-group">
                        <label>Sharing frequency</label>
                        <select id="frequency" name="frequency">

                      
                           <option value="Daily" @if(isset($data[0]) && $data[0]['frequency'] == 'Daily') selected @endif>Daily</option>
                           <option value="Weekly" @if(isset($data[0]) && $data[0]['frequency'] == 'Weekly') selected @endif>Weekly</option>
                           <option value="Monthly" @if(isset($data[0]) && $data[0]['frequency'] == 'Monthly') selected @endif>Monthly</option>
                             
                        </select>
                    </div>

                    <div class="col-100 sup-p-t">
                        <div class="inner-title">
                            <p>Information to share.</p>
                        </div>
                    </div>

                    <?php 
                    $information = "";
                    $affirmation = "";
                    if(isset($data[0])) {
                        $information = ($data[0]['information'])? json_decode($data[0]['information'],true):'';
                        $affirmation = ($data[0]['affirmation'])? json_decode($data[0]['affirmation'],true):''; 
                    }
                   
                    
                    ?>
                    @foreach ($moduleName as $moduleValue )
                    <div class="col-50">
                        <div class="custom-toggle-container">
                            <div class="custom-toggle">
                                <input type="checkbox" id="moduleName[{{ $moduleValue['name'] }}]" name="moduleName[{{ $moduleValue['name'] }}]" 
                                class="custom-toggle__checkbox" 
                                @if ( isset($information[$moduleValue['name']]) ) checked @endif
                                />
                                <label for="moduleName[{{ $moduleValue['name'] }}]" class="custom-toggle__label">
                                    <span class="custom-toggle__slider"></span>
                                </label>
                            </div>
                            <span class="custom-toggle-label">{{ $moduleValue['label'] }}</span>
                        </div>
                    </div>
                    @endforeach
                    

                    

                   

                   

                    <div class="col-100 sup-p-t">
                        <div class="inner-title">
                            <p>Information to share.</p>
                        </div>
                    </div>

                    <div class="col-100">
                        <div class="custom-toggle-container">
                            <div class="custom-toggle">
                                <input type="checkbox" id="WebNoti" class="custom-toggle__checkbox" name="affirmation[web]" portal-type="web" <?= (isset($affirmation['web']))?'checked':'' ?>/>
                                <label for="WebNoti" class="custom-toggle__label">
                                    <span class="custom-toggle__slider"></span>
                                </label>
                            </div>
                            <span class="custom-toggle-label">Affirmation Web Notification</span>
                        </div>
                    </div>

                    <div class="col-100">
                        <div class="custom-toggle-container mb-0">
                            <div class="custom-toggle">
                                <input type="checkbox" id="MobileNoti" class="custom-toggle__checkbox" name="affirmation[mobile]" portal-type="mobile" <?= (isset($affirmation['mobile']))?'checked':'' ?>/>
                                <label for="MobileNoti" class="custom-toggle__label">
                                    <span class="custom-toggle__slider"></span>
                                </label>
                            </div>
                            <span class="custom-toggle-label">Affirmation Mobile Notification</span>
                        </div>
                    </div>

                    <div class="col-100 cta">
                        <button type="submit" class="primary-button">Save</button>
                    </div>

                </div>
            </div>
</form>
        </div>
</section>

@include('mobile.includes.foooter-tab') 

<script>
$(document).ready(function() {
    $('.custom-toggle-label').on('click', function () {
        // Find the related checkbox inside the same container
        let checkbox = $(this).closest('.custom-toggle-container').find('.custom-toggle__checkbox');
        checkbox.prop('checked', !checkbox.prop('checked')).trigger('change');
    });
});
</script>
@endsection
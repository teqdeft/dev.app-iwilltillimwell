 <form class="ps-pills-content supporterDetailsClass" action="{{ url('share/saveFriendContactData') }}" id="supporterDetailsEdit" method="POST">
    @csrf
    <input type="hidden" value="{{ $data[0]['id'] }}" name="id" >
    <div class="send-friend_Add">
        <h4 class="h4-title">Fill the supporter’s information</h4>
        <div class="form-row">
            <div class="col-md-4 col-sm-12 inputContainers">
                <div class="mb-3">
				<label>Supporter’s First Name</label>
                <input name="first_name" placeholder="Enter a first name" class="form-control" value="{{ $data[0]['first_name'] }}">
                
                </div>
            </div>
            <div class="col-md-4 col-sm-12 inputContainers">
                <div class="mb-3">
				<label>Supporter’s Last Name</label>
                <input name="last_name" placeholder="Enter a last name" class="form-control" value="{{ $data[0]['last_name'] }}" >
                
                </div>
            </div>
            <div class="col-md-4 col-sm-12 inputContainers">
                <div class="mb-3">
                <label>Select Your Relationship</label>
				<select style="padding-top: 10px; color: #959595;" class="form-control"  id="exampleFormControlSelect1" name="relation">
                    <option value="" >Relationship</option>
                    <option value="Spouse" @if ( $data[0]['relation'] == 'Spouse' )
                        selected
                    @endif >Spouse</option>
                    <option value="Mother" @if ( $data[0]['relation'] == 'Mother' )
                        selected
                    @endif >Mother</option>
                    <option @if ( $data[0]['relation'] == 'Father' )
                        selected
                    @endif value="Father" >Father</option>
                    <option @if ( $data[0]['relation'] == 'Siblings' )
                        selected
                    @endif value="Siblings" >Siblings</option>
                    <option  @if ( $data[0]['relation'] == 'Friend' )
                        selected
                    @endif value="Friend" >Friend</option>
                    <option  @if ( $data[0]['relation'] == 'Others' )
                        selected
                    @endif value="Others" >Others</option>
                </select>
                
                </div>
            </div>
            <div class="col-md-4 col-sm-12 inputContainers">
                <div class="mb-3">
                <label>Supporter’s Email (Ex: xyz@domain.com) </label>
				<input name="email" placeholder="Enter a new mail" class="form-control" value="{{ $data[0]['email'] }}">
                
                </div>
            </div>
            <div class="col-md-4 col-sm-12 inputContainers">
                <div class="mb-3">
                <label>Supporter’s Phone </label>
				<input name="phone" id="floatingPhonelist{{ $data[0]['id'] }}" suppId="{{ $data[0]['id'] }}" placeholder="Enter a new phone" class="form-control floatingPhonelist" value="{{ $data[0]['phone'] }}" id="floatingPhone" onkeyup="validLength(this,'10')">
                
                </div>
            </div>
            <div class="col-md-4 col-sm-12 inputContainers">
                <div class="mb-3">
                <label>Select Frequency</label>
				<select style="padding-top: 10px;     color: #959595;" class="form-control"  id="exampleFormControlSelect1" name="frequency">
                    <option  value="" >Sharing Frequency</option>
                    <option @if ( $data[0]['frequency'] == 'Daily' )
                        selected
                    @endif value="Daily" >Daily</option>
                    <option @if ( $data[0]['frequency'] == 'Weekly' )
                        selected
                    @endif value="Weekly" >Weekly</option>
                    <option @if ( $data[0]['frequency'] == 'Monthly' )
                        selected
                    @endif value="Monthly" >Monthly</option>
                </select>
                
                </div>
            </div>
        </div>
    </div>
    <div class="module-list_area">
        <h4 class="h4-title">Choose the information that you want to share with a counselor, family member or friend.</h4>
        <ul class="list-ps">
            <?php $information = ($data[0]['information'])? json_decode($data[0]['information'],true):'' ?>
            @foreach ($moduleName as $moduleValue )
            <li>
                <div class="affirmation-container">
                <div class="servicesStatus ">
                    <label class="switch">
                    <input type="checkbox" name="moduleName[{{ $moduleValue['name'] }}]" @if ( isset($information[$moduleValue['name']]) )
                        checked
                    @endif class="moduleShareCheck">
                    <span class="slider round"></span>
                    </label>
                </div>
                <div class="affirmation-action_check">
                    <p>{{ $moduleValue['label'] }}</p>
                </div>
                </div>
            </li>
            @endforeach
        </ul>
    </div>
    <div class="quick-link-box">
        <div class="row">
            <div class="col-12">
                <h4 class="h4-title">Affirmation</h4>
                {{--
                <h3 class="font-weight-bold"><i class="far fa-hand-point-right"></i> Affirmation</h3>
                --}}
            </div>
            <?php $affirmation = ($data[0]['affirmation'])? json_decode($data[0]['affirmation'],true):''; ?>
            <div class="col-md-12 col-xl-6 mb-3 stretch-card transparent module-list_area">
                <ul class="list-ps">
                <li>
                    <div class="affirmation-container">
                        <div class="servicesStatus ">
                            <label class="switch">
                            <input type="checkbox" name="affirmation[web]" class="affirmationOnOffEdit" portal-type="web" <?= (isset($affirmation['web']))?'checked':'' ?> >
                            <span class="slider round"></span>
                            </label>
                        </div>
                        <div class="affirmation-action_check">
                            <p>Affirmation Web Notification</p>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="affirmation-container">
                        <div class="servicesStatus ">
                            <label class="switch">
                            <input type="checkbox" name="affirmation[mobile]" portal-type="mobile" class="affirmationOnOffEdit" <?= (isset($affirmation['mobile']))?'checked':'' ?> >
                            <span class="slider round"></span>
                            </label>
                        </div>
                        <div class="affirmation-action_check">
                            <p>Affirmation Mobile Notification </p>
                        </div>
                    </div>
                </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="ps-btn-btm mb-2">
        <input type="submit" class="btn btn-primary" value="Save" >
    </div>
</form>

<script>

   $('.floatingPhonelist').each(function(){
        var id = $(this).attr('suppId');
        var phoneMaskList = IMask(
        document.getElementById(`floatingPhonelist${id}`), {
            mask: '+1(000)-000-0000'
        });
    })


     $.validator.addMethod('emailCheck', function (value) {
            return /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test(value);
        }, 'Please enter a valid email');

        $.validator.addMethod('phoneCheck', function (value) {
            return /^[\+][0-9-_.]{5,20}$/.test(value);
        }, 'Please enter a valid phone number');

        $.validator.addMethod('phoneMaxCheck', function (value) {
            let phone = value.replace('+1','').replace('(','').replace(')','').replaceAll('-','');
            if( phone.length == 10 ){
                return true;
            }
        }, 'Please enter a valid phone number');

        jQuery.validator.addMethod("alphaCheck", function(value, element) {
        return this.optional(element) || onlyAlpha(value);
        }, "Please enter only letters");


    $('#supporterDetailsEdit').validate({
        rules: {
            first_name: {
                required: true,
            },
            last_name: {
                required: true,
            },
            email: {
                required: true,
                emailCheck:true,
            },
            phone: {
                required: true,
                phoneMaxCheck:true
            },
            relation: {
                required: true,
            },
            frequency: {
                required: true,
            }
        },
        messages:{
            mail:{
                pattern:"Please enter a valid email"
            },
            phone:{
                pattern:"Please enter a valid phone number"
            }
        },
        errorElement: 'span',
        errorPlacement: function(error, element) {
            let type = $(element).attr("type");
            let id = $(element).attr("id");
            if (type === "checkbox" || type === "radio") {
                error.css({'margin-left':'11px'});
                error.insertAfter(element.parent().parent());
            } else if (id == "valid_to" || id == "valid_from") {
                error.insertAfter(element.parent());
            } else if (type === "file") {
                error.insertAfter(element.next());
            } else if ($(element).is("select")) {
                error.css({'position':'relative','top':'0px'})
                error.insertAfter(element.next());
            } else {

                error.insertAfter(element);
            }
        }
    });

</script>

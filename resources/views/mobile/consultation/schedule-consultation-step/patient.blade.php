@if (Request::segment(3) == '' || Request::segment(3) == 'step-1')
<div id="patient-tab" class="tab-content active">
    <div class="patient-tab-content">
        <div class="pat-title">
            <p>Who Is This Session For?</p>
        </div>
        <form>
           
            <div class="consut-dr">
                <div class="custom-radio-group">
                    <label class="custom-radio">
                        <div class="gr-p">
                            <div class="image">
                                <img src="{{ asset('assets/dashboard/assets/images/dummy-image.svg')}}" alt="icon">
                            </div>
                            <span>{{ Auth::user()->name }}</span> 
                        </div>
                        <input type="radio" name="patient" value="{{ Auth::user()->userid }}">
                        <span class="custom-radio-button"></span>
                    </label>
                </div>
            </div>
            @if ($dependents)
                @foreach ($dependents as $dependent)

                <?php $relationship = Config::get('constants.relationship'); ?>

                
                    <div class="consut-dr">
                        <div class="custom-radio-group">
                            <label class="custom-radio">
                                <div class="gr-p">
                                    <div class="image">
                                        <img src="{{ asset('assets/dashboard/assets/images/dummy-image.svg')}}" alt="icon">
                                    </div>
                                    <span>{{ $dependent->name }}<span class="error">
                            ({{ ($dependent->relationship!=0) ? $relationship[$dependent->relationship] : "" }})
                            </span></span> 
                                          
                                </div>
                                <input type="radio" name="patient" value="{{ $dependent->userid }}">
                                <span class="custom-radio-button"></span>
                            </label>
                        </div>
                        
                    </div>
                    <div class="new-cumtom">
                        
                            @if ($dependent->age > Config::get('constants.minor_age'))
                                <p class="error">*Dependent is over 18 and must manage their own records.</p>
                            @endif  
                        </div>
                @endforeach
            @endif


            <div class="col-100 cta">
                <button onclick="nextTabBookingP('step-2')" type="button" class="primary-button">Next</button>
            </div>
        </form>
    </div>

<script>
$(document).on("change", "input[type=radio][name=patient]", function(e) {
    
        let userid = $(this).val();
        let modality = $("#modality").val();
        let action = '<?php echo request("action")?>';
		showLoaderPageLoad('show');
        toastr.info('Please wait...', 'Processing', {
                timeOut: 0,
                extendedTimeOut: 0,
            }); 
        $.ajax({
            method: "POST",
            url: SITE_URL + "/create-consultation",
            dataType: "json",
            data: {
                "_token": $('meta[name="csrf-token"]').attr('content'),
                "userid": userid,
                "modality": modality,
                "action": action,
            },
            success: function(data) {
				toastr.clear();
				showLoaderPageLoad('hide');
                if (data.original.status) {
                    let consult_id = data.original.consultation_id;
                    
					location.href = SITE_URL + "/schedule-consultation/" + modality + "/step-2/" + consult_id + "?action=<?php echo request('action')?>";
					
                } else {
					toastr.error(data.original.message || "Something went wrong.");
					$('input[type=radio][name=patient]').prop('checked', false);

				}
            },
        });
});
function nextTabBookingP(action) {
    toastr.error("Please select Patient");
}    
localStorage.removeItem("scheduleConsultation");
console.log("//////////////");
console.log(localStorage.getItem("scheduleConsultation"));

</script>
</div>
@endif
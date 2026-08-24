@if(Request::segment(3) == 'step-6')

@php
    $scheduleUrl = url('/schedule-consultation/' . Request::segment(2) . '/step-5/' . Request::segment(4)) . '?action=' . request('action');
    $nextUrl = url('/schedule-consultation/' . Request::segment(2) . '/step-7/' . Request::segment(4)) . '?action=' . request('action');
@endphp

<div id="schedule-tab" class="tab-content">
    
    <div class="patient-tab-content">
        <div class="pat-title">
            <p>Select a Convenient Time for 
						@if (request()->is('schedule-consultation/phone/*'))
							Phone
						@elseif (request()->is('schedule-consultation/video/*'))
							Video
						@endif
					Consultation</p>
        </div>
        <?php $consultation_id = $consultation ? $consultation->id : "" ?>   
        <form action="{{ route('update.consultation', $consultation_id) }}" method="POST" id="schedule-form">
			@csrf	
            <input type="hidden" value="<?php echo request('action')?>" name="action_type" />
			<input type="hidden" name="next-step" value="step-7">
            <div class="consut-dr v2">
                <div class="custom-radio-group">
                    <label class="custom-radio">
                        <div class="gr-p">
                            <span>Consultation within 2 hours</span>
                        </div>
                        <input type="radio" name="whenScheduled" value="now">
                        <span class="custom-radio-button"></span>
                    </label>
                </div>
            </div>

            <div class="consut-dr v2">
                <div class="custom-radio-group">
                    <label class="custom-radio">
                        <div class="gr-p">
                            <span>
                                Schedule a consultation in the future
                            </span>
                        </div>
                        <input type="radio" name="whenScheduled" value="future">
                        <span class="custom-radio-button"></span>

                    </label>
                </div>
            </div>

            <div class="show-future" style="display:none;">
                <div class="col-100 form-group">
                    <div class="inner-title mb-0">
                        <p>Select Date</p>
                    </div>
                </div>

                <div class="col-100 form-group">
                    <label>Date</label>
                    <input class="form-control" type="date" name="schedule_date" id="schedule_date" value="{{ date('Y-m-d') }}" onchange="whenScheduledView()">
                </div>

                <div class="col-100 form-group">
                    <div class="inner-title mb-0">
                        <p>Select Time</p>
                    </div>
                </div>

                <div class="col-100 form-group">
                    <label>From</label>
                    <select class="form-control" name="schedule_from" id="schedule_from" onchange="whenScheduledView()">
						<?php  
							for ($i = 1; $i <= 24; $i++) { 
								$hour = $i % 12;
								$hour = $hour == 0 ? 12 : $hour;
								$period = ($i < 12) ? "AM" : "PM"; 
								$time = $hour . ":00 " . $period;
								$value = str_pad($i, 2, "0", STR_PAD_LEFT) . ":00 " . $period;
								
						?>
								<option value="{{ trim($value) }}">{{ trim($time) }}</option>

								<?php 
									$time = $hour . ":30 " . $period;
									 $value = str_pad($i, 2, "0", STR_PAD_LEFT) . ":30 " . $period;
								?>
								<option value="{{ trim($value) }}">{{ trim($time) }}</option>

						<?php } ?>
					</select>
                </div>

                <div class="col-100 form-group">
                    <label>To</label>
                    <input class="form-control" type="text" name="schedule_to"  id="schedule_to"  disabled>
                </div>
				
                <div class="col-100 form-group">
                    <label>Time Zone</label>
                    
					<select class="form-control" name="timezoneOffset" id="timezoneOffset">
						<option value=""> -- SELECT TIME ZONE --</option>
						<option value="-4">Atlantic Standard Time (UTC-04:00)</option>
						<option value="-5">Eastern Standard Time (UTC-05:00)</option>
						<option value="-6">Central Standard Time (UTC-06:00)</option>
						<option value="-7">Mountain Standard Time (UTC-07:00)</option>
						<option value="-8">Pacific Standard Time (UTC-08:00)</option>
						<option value="-9">Alaska Standard Time (UTC-09:00)</option>
						<option value="-10">Hawaii-Aleutian Standard Time (UTC-10:00)</option>
						<option value="-11">Samoa Standard Time (UTC-11:00)</option>
						<option value="10">Chamorro Standard Time (UTC+10:00)</option>
					</select>
					
                </div>

                <div class="appoint-detail">
                    <div class="apoit-title">
                        <p>Appointment Details</p>
                    </div>
                    <div class="apoint-row">
                        
                    </div>
                </div>
            </div>

            
            <div class="col-100 form-group">
                <div class="inner-title mb-0">
                    <p>What Language Should the Physician Speak?</p>
                </div>
            </div>

            <div class="col-100 form-group">
                <div class="custom-radio-group indicate-radio">
                    <label class="custom-radio">
                        English
                        <input type="radio" name="translate" value="English" checked>
                        <span class="custom-radio-button"></span>
                    </label>
                    <label class="custom-radio">
                        Español
                        <input type="radio" name="translate" value="Spanish">
                        <span class="custom-radio-button"></span>
                    </label>
                </div>
            </div>

            <div class="col-100 cta">
                <div class="recorc-cta" style="width: 100%;display: flex;justify-content: space-between; align-items: center;margin-top: 20px;">   
                    <a href="{{ $scheduleUrl }}" class="outline-button">Back</a>
                    <button class="primary-button" type="button" onclick="return ScheduleFormSubmit()">Next</button>
                </div>    
            </div>

        </form>

    </div>
    
</div>

<script>
$(document).ready(function() {
    $('input[name="whenScheduled"]').change(function() {
		console.log("whenScheduled changed");
		$(".show-future").hide();
        let selectedValue = $('input[name="whenScheduled"]:checked').val(); 
		if(selectedValue=="future") {
			$(".show-future").show();
		}
     });
     $(".schedule-consultation .back-btn").attr("href", "{{ $scheduleUrl }}");
	 if(scheduleConsultation.translate){
		$('input[name="translate"][value="'+scheduleConsultation.translate+'"]').prop('checked', true);
	}
	if(scheduleConsultation.whenScheduled){
		$('input[name="whenScheduled"][value="' + scheduleConsultation.whenScheduled + '"]').prop('checked', true).trigger("change");
		if(scheduleConsultation.whenScheduled=="future") {
			$("#schedule_date").val(scheduleConsultation.schedule_date);
			$("#schedule_from").val(scheduleConsultation.schedule_from);
			$("#schedule_to").val(scheduleConsultation.schedule_to);
			$("#timezoneOffset").val(scheduleConsultation.timezoneOffset);
			whenScheduledView();
		}
		
	}
});
function ScheduleFormSubmit() {
	
	let whenScheduled = $('input[name="whenScheduled"]:checked').val();
	if (whenScheduled === "" || whenScheduled == null  || whenScheduled == undefined || !whenScheduled) {
		toastr.error("Please select your schedule");
		return false;
	}
	let translate = $('input[name="translate"]:checked').val();
	if (translate === "" || translate == null  || translate == undefined || !translate) {
		 toastr.error("Please select language");
		 return false;
	}
	
	scheduleConsultation.whenScheduled = whenScheduled;
	scheduleConsultation.translate = translate;
	scheduleConsultation.schedule_date = $("#schedule_date").val();
	scheduleConsultation.schedule_from = $("#schedule_from").val();
	scheduleConsultation.schedule_to = $("#schedule_to").val();
	scheduleConsultation.timezoneOffset = $("#timezoneOffset").val();
	localStorage.setItem("scheduleConsultation", JSON.stringify(scheduleConsultation));
	window.location.href='<?php echo $nextUrl?>';
}
function whenScheduledView() {
	
let calSelectedDate = $("#schedule_date").val();
let schedule_from = $("#schedule_from").val();
let twoHoursLater = getTwoHoursLater(schedule_from);
$("#schedule_to").val(twoHoursLater);
$(".apoint-row").html('<div class="date"><div class="cel-v"><p>Date</p></div><div class="value"><p>'+calSelectedDate+'</p></div></div><div class="time"><div class="cel-v"><p>Time</p></div><div class="value"><p>'+schedule_from+' TO '+twoHoursLater+'</p></div></div>');

	

}

function getTwoHoursLater(timeStr) {
	const match = timeStr.match(/^(\d{1,2}):(\d{2})\s?(AM|PM)$/i);
    if (!match) return "Invalid time";

    let hour = parseInt(match[1], 10);
    let minute = parseInt(match[2], 10);
    const period = match[3].toUpperCase();

    // Convert to 24-hour format
    if (period === "PM" && hour !== 12) hour += 12;
    if (period === "AM" && hour === 12) hour = 0;

    // Create a Date object and add 2 hours
    const date = new Date();
    date.setHours(hour);
    date.setMinutes(minute);
    date.setSeconds(0);
    date.setMilliseconds(0);

    date.setHours(date.getHours() + 2);

    // Convert back to 12-hour format
    let newHour = date.getHours();
    let newMinute = date.getMinutes();
    const newPeriod = newHour >= 12 ? "PM" : "AM";

    newHour = newHour % 12;
    if (newHour === 0) newHour = 12;
    if (newMinute < 10) newMinute = "0" + newMinute;

    return `${newHour}:${newMinute} ${newPeriod}`;
}

whenScheduledView();
</script>   

@endif
@if(Request::segment(3) == 'step-6')

@php
    $scheduleUrl = url('/schedule-consultation/' . Request::segment(2) . '/step-5/' . Request::segment(4)) . '?action=' . request('action');
    $nextUrl = url('/schedule-consultation/' . Request::segment(2) . '/step-7/' . Request::segment(4)) . '?action=' . request('action');
@endphp
<div role="tabpanel" class="tab-pane {{ (Request::segment(3) == 'step-6') ? 'active' : '' }}" id="schedule">
         <form action="{{ route('update.consultation', $consultation_id) }}" method="POST" id="schedule-form">
             @csrf
             <div class="design-process-content schedule-main-v1">
              
                 <div class="diagnostic-phone-box cw-50">
				    <h4 class="mb-2">
						Select a Convenient Time for 
							@if (request()->is('schedule-consultation/phone/*'))
								Phone
							@elseif (request()->is('schedule-consultation/video/*'))
								Video
							@endif
						Consultation
					 </h4>
                     <div class="inner-diagnostic-phone-box">
                         <div class="d-flex flex-wrap">
                             <div class="inner-diagnostic-phone-radio mr-4">
                                 <div class="form-check">
                                     <label class="form-check-label" onclick="show4();">
                                         <input type="radio" class="form-check-input" name="whenScheduled"
                                             id="optionsRadios1" value="now">
                                         Consultation within 2 hours
                                         <i class="input-helper"></i></label>
                                 </div>
                             </div>
                             <div class="inner-diagnostic-phone-radio">
                                 <div class="form-check">
                                     <label class="form-check-label" onclick="show3();">
                                         <input type="radio" class="form-check-input" name="whenScheduled"
                                             id="optionsRadios2" value="future">
                                         Schedule a consultation in the future
                                         <i class="input-helper"></i></label>
                                 </div>
                             </div>
                         </div>
                     </div>
                 </div>
                 <div class="date-time-range-box cw-100">
                     
                     <div class="inner-date-time-range-box">
                         <h4>The physician will have a two hour window to reach you. Make
                             sure you select a time range when you will be available.</h4>
                         <div class="range-calendar-box">
                             <div class="inner-range-calendar-box">
                                 <div class="wrapper mb-5">
                                     <div class="row">
                                         <div class="col-sm-12 col-lg-6">
                                             <div class="container-calendar">
                                                 <div id="schedule-consultation" data-date=""></div>
                                                 <input type="hidden" name="cal-selected-date"
                                                     class="cal-selected-date" />
                                                 <table class="table-calendar" id="calendar" data-lang="en">
                                                     <thead id="thead-month"></thead>
                                                     <tbody id="calendar-body"></tbody>
                                                 </table>
                                             </div>
                                         </div>
                                         <div class="col-sm-12 col-lg-6">
                                             <div class="time-range-box time-range">
                                                 <div class="inner-time-range-box">
													<div class="range-box">
														<h4>Select A Time Range</h4>
													</div>
													<div class="range-title">
															<p>From</p>
													</div>
                                                     <div class="from-date-box">
														
                                                         <div class="form-group">
                                                             <select
                                                                 class="form-control theme-select mx-select select-schedule-time"
                                                                 name="selected-time">
                                                                 <option value="12:00 AM">
                                                                     12:00AM</option>
                                                                 <option value="12:30 AM">
                                                                     12:30AM</option>
                                                                 <option value="1:00 AM">
                                                                     1:00AM</option>
                                                                 <option value="1:30 AM">
                                                                     1:30AM</option>
                                                                 <option value="2:00 AM">
                                                                     2:00AM</option>
                                                                 <option value="2:30 AM">
                                                                     2:30AM</option>
                                                                 <option value="3:00 AM">
                                                                     3:00AM</option>
                                                                 <option value="3:30 AM">
                                                                     3:30AM</option>
                                                                 <option value="4:00 AM">
                                                                     4:00AM</option>
                                                                 <option value="4:30 AM">
                                                                     4:30AM</option>
                                                                 <option value="5:00 AM">
                                                                     5:00AM</option>
                                                                 <option value="5:30 AM">
                                                                     5:30AM</option>
                                                                 <option value="6:00 AM">
                                                                     6:00AM</option>
                                                                 <option value="6:30 AM">
                                                                     6:30AM</option>
                                                                 <option value="7:00 AM">
                                                                     7:00AM</option>
                                                                 <option value="7:30 AM">
                                                                     7:30AM</option>
                                                                 <option value="8:00 AM">
                                                                     8:00AM</option>
                                                                 <option value="8:30 AM">
                                                                     8:30AM</option>
                                                                 <option value="9:00 AM">
                                                                     9:00AM</option>
                                                                 <option value="9:30 AM">
                                                                     9:30AM</option>
                                                                 <option value="10:00 AM">
                                                                     10:00AM</option>
                                                                 <option value="10:30 AM">
                                                                     10:30AM</option>
                                                                 <option value="11:00 AM">
                                                                     11:00AM</option>
                                                                 <option value="11:30 AM">
                                                                     11:30AM</option>
                                                                 <option value="12:00 PM">
                                                                     12:00PM</option>
                                                                 <option value="12:30 PM">
                                                                     12:30PM</option>
                                                                 <option value="1:00 PM">
                                                                     1:00PM</option>
                                                                 <option value="1:30 PM">
                                                                     1:30PM</option>
                                                                 <option value="2:00 PM">
                                                                     2:00PM</option>
                                                                 <option value="2:30 PM">
                                                                     2:30PM</option>
                                                                 <option value="3:00 PM">
                                                                     3:00PM</option>
                                                                 <option value="3:30 PM">
                                                                     3:30PM</option>
                                                                 <option value="4:00 PM">
                                                                     4:00PM</option>
                                                                 <option value="4:30 PM">
                                                                     4:30PM</option>
                                                                 <option value="5:00 PM">
                                                                     5:00PM</option>
                                                                 <option value="5:30 PM">
                                                                     5:30PM</option>
                                                                 <option value="6:00 PM">
                                                                     6:00PM</option>
                                                                 <option value="6:30 PM">
                                                                     6:30PM</option>
                                                                 <option value="7:00 PM">
                                                                     7:00PM</option>
                                                                 <option value="7:30 PM">
                                                                     7:30PM</option>
                                                                 <option value="8:00 PM">
                                                                     8:00PM</option>
                                                                 <option value="8:30 PM">
                                                                     8:30PM</option>
                                                                 <option value="9:00 PM">
                                                                     9:00PM</option>
                                                                 <option value="9:30 PM">
                                                                     9:30PM</option>
                                                                 <option value="10:00 PM">
                                                                     10:00PM</option>
                                                                 <option value="10:30 PM">
                                                                     10:30PM</option>
                                                                 <option value="11:00 PM">
                                                                     11:00PM</option>
                                                                 <option value="11:30 PM">
                                                                     11:30PM</option>
                                                             </select>
                                                         </div>
                                                     </div>
                                                     <div class="rgt-date-timezone-box">
													 <div class="range-title">
														<p>To</p>
													 </div>
                                                         <div class="to-date-box">
                                                             <div class="to-date-inner-box">
                                                                 <p><strong class="scheduled-to-time">2:00AM</strong></p>
                                                             </div>
                                                         </div>
                                                         
														<div class="range-title">
															<p>Time Zone</p>
														</div>
														
                                                         <div class="timezone-box">
                                                             <div class="inner-timezone-box">
                                                                 <div class="form-group">
                                                                     <select class="form-control theme-select mx-select"
                                                                         name="timezoneOffset">
                                                                         <option value="">
                                                                             -- SELECT
                                                                             TIMEZONE --
                                                                         </option>
                                                                         @foreach($timezones
                                                                         as $timezone)
                                                                         <option value="{{ $timezone->offset }}">
                                                                             {{ $timezone->name }}
                                                                         </option>
                                                                         @endforeach
                                                                     </select>
                                                                 </div>
                                                             </div>
                                                         </div>
                                                     </div>
                                                 </div>
                                             </div>
                                         </div>
                                     </div>
                                 </div>
                                 <div class="date-timezone-value-box">
                                     <div class="inner-timezone-value-box">
                                         <blockquote class="blockquote blockquote-primary">
                                             <footer class="blockquote-footer text-center fs-22">
                                                 Scheduled For:<span class="get-date-value-box text-dark">
                                                     <label class="scheduled-date"></label>
                                                 </span> between <span
                                                     class="time-from-box text-dark scheduled-from-time">12:00AM
                                                 </span> and <span
                                                     class="time-to-box text-dark scheduled-to-time">2:00AM
                                                 </span></footer>
                                         </blockquote>
                                     </div>
                                 </div>
                             </div>
                         </div>
                     </div>
                 </div>
                 <div class="language-main-box cw-50">
                     
                     <h4>What Language Should the Physician Speak?</h4>
                     <div class="language-inner-box pl-3">
                         <div class="d-flex flex-wrap">
                             <div class="language-inner-box-radio mr-5">
                                 <div class="form-check">
                                     <label class="form-check-label">
                                         <input type="radio" class="form-check-input" name="translate"
                                             id="optionsRadios3" value="English" checked>
                                         English
                                         <i class="input-helper"></i></label>
                                 </div>
                             </div>
                             <div class="language-inner-box-radio">
                                 <div class="form-check">
                                     <label class="form-check-label">
                                         <input type="radio" class="form-check-input" name="translate"
                                             id="optionsRadios4" value="Spanish">
                                         Español
                                         <i class="input-helper"></i></label>
                                 </div>
                             </div>
                         </div>
                     </div>
                 </div>
                 <input type="hidden" name="next-step" value="step-7" />
                 <div class="d-flex justify-content-between btn-group-box mt-5 cw-50">
                     
					<a href="{{ $scheduleUrl }}" class="outline-button back-btn"><i class="fa fa-chevron-left fa-arrow-icon fa-arrow-icon-back"></i> Back</a>
					
					 <button type="button" onclick="return ScheduleFormSubmit()" class="btn btn-primary mr-3">Next <i class="fa fa-chevron-right fa-arrow-icon"></i></button>
					 </form> 
					 
					 
						 
						 
					 </li>
					 
				 </div>
 </div>

 </div>
 
 
 
<script>
var selectedValue = "";
$(document).ready(function() {
    $('input[name="whenScheduled"]').change(function() {
		console.log("whenScheduled changed");
		$(".show-future").hide();
        selectedValue = $('input[name="whenScheduled"]:checked').val(); 
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
	
	if(selectedValue=="future") {
		scheduleConsultation.schedule_date = $(".scheduled-date").html().trim();
	}
	scheduleConsultation.schedule_from = $("#schedule_from").val();
	scheduleConsultation.schedule_to = $("#schedule_to").val();
	scheduleConsultation.timezoneOffset = $("#timezoneOffset").val();
	localStorage.setItem("scheduleConsultation", JSON.stringify(scheduleConsultation));
	window.location.href='<?php echo $nextUrl?>';
	
	console.log(scheduleConsultation);
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
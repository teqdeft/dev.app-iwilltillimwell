@if(Request::segment(3) == 'step-6')
@php
    $scheduleUrl = url('/schedule-consultation/' . Request::segment(2) . '/step-5/' . Request::segment(4)) . '?action=' . request('action');
    $next_url = url('/schedule-consultation/' . Request::segment(2) . '/step-7/' . Request::segment(4)) . '?action=' . request('action');
@endphp

<div id="doctors-list" class="tab-content">
	<section class="dr-list-web">
		<div class="patient-tab-content v2 h-100 electr">
			<div class="pat-title">
				<p>Select an Appointment Slot from the Providers Listed Below</p>
			</div>
			<div class="dr-detail-main">
				<div class="form-row">
					<div class="top-50">
						<div class="col-50 form-group">
							<label> Select an Appointment Date</label>
							<input class="form-control" type="text" name="appointment-date" id="appointment-date" value="<?php echo date('Y-m-d')?>" onchange="getDoctolreList()" readonly>
						</div>

						<div class="col-50 form-group">
							<label>Preferred Doctor Gender</label>
							<select name="doctor-gender" id="doctor-gender" onchange="getDoctolreList();">
																			<option value="">Select</option>
																			<option value="m">Male</option>
																			<option value="f">Female</option>
																			
							</select>
						</div>
					</div>
					<div class="col-100 form-group">
						<div class="dr-form-title">
							<p>Select Your Doctor</p>
						</div>
					</div>
					<div id="doctorContainer" class="doc-cont-loader dr-list-row">
						<div class="data"></div>
					</div>
					
					<div class="col-100 cta">
						<div class="recorc-cta"
							style="width: 100%; display: flex; justify-content: space-between; align-items: center;">
							
							<a href="{{$scheduleUrl}}" class="outline-button"><i class="fa fa-chevron-left fa-arrow-icon fa-arrow-icon-back"></i> Back</a>
							
							<?PHP /*
							<button class="primary-button" type="submit" onclick="return next_screenfun()">Next <i class="fa fa-chevron-right fa-arrow-icon"></i></button>
							*/ ?>
						</div>
					</div>
				
					<?php /*
					<div class="recorc-cta" style="width: 100%; display: flex; justify-content: space-between; align-items: center;">   
						<a href="{{$scheduleUrl}}" class="outline-button"><i class="fa fa-chevron-left fa-arrow-icon fa-arrow-icon-back"></i> Back</a>
					</div>
					*/ ?>

				</div>
			</div>
		</div>
	</section>
</div>






@push('scripts')

<link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>

<script>
    $(function () {
      $("#appointment-date").datepicker({
        changeYear: true,
        dateFormat: "yy-mm-dd",
        minDate: 0,
		maxDate: 20,
		beforeShowDay: function (date) {
			
			const day = date.getDay();
			if (day === 0 || day === 6) {
			  return [false, '', 'Weekend disabled'];
			}
			return [true, ''];
			
		}
      });
    });
</script>
@endpush


<script>
var next_screen = false;
$(function(){
    $(".schedule-consultation .back-btn").attr("href", "{{ $scheduleUrl }}");
	getDoctolreList(); 
    
});
function getDoctolreList() {
	
	showLoaderPageLoad('show');	
	 $('#doctorContainer .loader').show();
	 $('#doctorContainer .data').hide();
	let doctorgender = $("#doctor-gender").val();
	let appointmentdate = $("#appointment-date").val();
	$.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
	 $.ajax({
            url: '{{ url("get-doctors-list")}}',
            type: 'POST',
            data: {
                action: 'get-doctors-list',
                doctorgender: doctorgender,
                appointmentdate: appointmentdate,
                consultation_type: scheduleConsultation.action,
                scheduleConsultation: scheduleConsultation
            },
            success: function (response) {
				showLoaderPageLoad('hide');	
				if(response.status === 'success') {
                    $('#doctorContainer .data').html(response.html);
                }
                $('#doctorContainer .loader').hide();
				$('#doctorContainer .data').show();
            },
            error: function (xhr) {
				showLoaderPageLoad('hide');	
                console.log('Error:', xhr.responseText);
            }
    });
}
$(document).on('click', '.read-more-bio', function () {
    const container = $(this).closest('.bio-section'); 
    container.find('.short-bio').hide();               
    container.find('.full-bio').show();                
});
function saveDoctore(provider_id,time_slot_id,price,startTime) {
	
		
	$(".slot-row button").removeClass('active');
	$(".time-slot-"+time_slot_id).addClass("active");
	scheduleConsultation.primarycare.provider_id = provider_id;
	scheduleConsultation.primarycare.time_slot_id = time_slot_id;
	scheduleConsultation.price = price;
	scheduleConsultation.startTime = startTime;
    localStorage.setItem("scheduleConsultation", JSON.stringify(scheduleConsultation));
	document.body.style.pointerEvents = "none";
	next_screen = true;
	next_screenfun();
}
function savePrescription() {
	
}
function next_screenfun() {
	
	if(next_screen) {
		window.location.href='<?php echo $next_url?>';
	} else {
		toastr.error("Please select a time.");
	}
}
</script>

@endif
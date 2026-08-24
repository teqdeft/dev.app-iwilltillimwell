@if(Request::segment(3) == 'step-6')
@php
    $scheduleUrl = url('/schedule-consultation/' . Request::segment(2) . '/step-5/' . Request::segment(4)) . '?action=' . request('action');
    $next_url = url('/schedule-consultation/' . Request::segment(2) . '/step-7/' . Request::segment(4)) . '?action=' . request('action');
@endphp
<div id="doctors-list" class="tab-content">

    

<div class="patient-tab-content v2 h-100 electr">
                            <div class="pat-title">
                                <p>Select an Appointment Slot from the Providers Listed Below</p>
                            </div>

                            <div class="">
                                <form class="form-row">

                                    <!-- <div class="top">
                                        <p>
                                            <span>
                                                <img src="./assets/images/calender-icon.svg" alt="icon" />                                              
                                            </span>
                                            <span>
                                                Select appointment date
                                            </span>
                                        </p>
                                    </div> -->
                                    
                                    <div class="col-100 form-group">
                                        <label>Select Appointment Date</label>
                                        <input class="form-control" type="text" name="appointment-date" id="appointment-date" value="<?php echo date('Y-m-d')?>" onchange="getDoctolreList()">
                                    </div>

                                    <div class="col-100 form-group">
                                        <label>Preferred Doctor Gender</label>
                                        <select name="doctor-gender" id="doctor-gender" onchange="getDoctolreList();">
                                            <option value="">Select</option>
                                            <option value="m">Male</option>
                                            <option value="f">Female</option>
                                            
                                        </select>
                                    </div>

                                    <div class="col-100 form-group">
                                        <label>Select Your Doctor</label>
                                    </div>
									<div id="doctorContainer" class="doc-cont-loader">
									
										
										<div class="data"></div>
									</div>
                                   

                                    
                                    
                                  

                                    <div class="col-100 cta">
                                    <div class="recorc-cta" style="width: 100%; display: flex; justify-content: space-between; align-items: center;">   
                                            <a href="{{$scheduleUrl}}" class="outline-button showLoaderPageLoad">Back</a>
                                            <button type="button" class="primary-button" onclick="savePrescription()">Next</button>
                                    </div>    
                                </div>


                                </form>
                            </div>

                        </div>

</div>

<link rel="stylesheet" href="https://code.jquery.com/ui/1.14.1/themes/base/jquery-ui.css">
  <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
  <script src="https://code.jquery.com/ui/1.14.1/jquery-ui.js"></script>
  
<?php 
/* $url = "https://staging.getlyric.com/iwil/attachment/streamPhysicianProfile/inline/2425689";
$headers = @get_headers($url);
if($headers && strpos($headers[0], '200') !== false) {
    echo "URL is reachable";
} else {
    echo "URL is not reachable";
} */
?>  
<script>
$(function(){
    $(".schedule-consultation .back-btn").attr("href", "{{ $scheduleUrl }}");
	getDoctolreList('load-time'); 
    $( "#appointment-date" ).datepicker({
        changeYear: true,
        dateFormat: "yy-mm-dd",
		minDate: 0,
		maxDate: 14,
		beforeShowDay: function (date) {
			
			const day = date.getDay();
			if (day === 0 || day === 6) {
			  return [false, '', 'Weekend disabled'];
			}
			return [true, ''];
			
		}
       
    });
});
function getDoctolreList(request_from=null) {
	
	if(request_from!="load-time") {
		showLoaderPageLoad('show');
	}
	
	 //$('#doctorContainer .loader').show();
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
				if(response.status === 'success') {
                    $('#doctorContainer .data').html(response.html);
                }
                 hideLoader();
				$('#doctorContainer .data').show();
            },
            error: function (xhr) {
				hideLoader();
                console.log('Error:', xhr.responseText);
            }
    });
}

$(document).on('click', '.read-more-bio', function () {
    const container = $(this).closest('.bio-section'); 
    container.find('.short-bio').hide();               
    container.find('.full-bio').show();          
});

$(document).on('click', '.read-more-bio-less', function () {
    const container = $(this).closest('.bio-section'); 
    container.find('.short-bio').show();               
    container.find('.full-bio').hide();          
});

function saveDoctore(provider_id,time_slot_id,price,startTime) {
	
	$(".time-slot-"+time_slot_id).addClass("active");
	showLoaderPageLoad('show');
	scheduleConsultation.primarycare.provider_id = provider_id;
	scheduleConsultation.primarycare.time_slot_id = time_slot_id;
	scheduleConsultation.price = price;
	scheduleConsultation.startTime = startTime;
    localStorage.setItem("scheduleConsultation", JSON.stringify(scheduleConsultation));
	
	window.location.href='<?php echo $next_url?>';
	
}

</script>
@endif
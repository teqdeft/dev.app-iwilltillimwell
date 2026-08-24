@if (
    (Request::segment(3) === 'step-8' && request('action') === 'urgentcare') ||
    (Request::segment(3) === 'step-8' && request('action') === 'psychiatry') ||
    (Request::segment(3) === 'step-7' && request('action') === 'dermatology') ||
    (Request::segment(3) === 'step-8' && request('action') === 'psychology') ||
    (Request::segment(3) === 'step-8' && request('action') === 'primarycare')
)
@php
$scheduleUrl = '';
$nextUrl = '';
	 
$scheduleUrl = url('/schedule-consultation/' . Request::segment(2) . '/step-7/' . Request::segment(4)) . '?action=' . request('action');
$paymentUrl = url('/schedule-consultation/' . Request::segment(2) . '/step-8/' . Request::segment(4)) . '?action=' . request('action').'&current-tabs=payment';
$nextUrl = url('/schedule-consultation/' . Request::segment(2) . '/step-9/' . Request::segment(4)) . '?action=' . request('action');

@endphp

@if(request('current-tabs') === 'payment')
	
@php 
	 $scheduleUrl = url('/schedule-consultation/' . Request::segment(2) . '/step-8/' . Request::segment(4)) . '?action=' . request('action').'';
@endphp

			@include('consultation.schedule-consultation-step.payment-confirm')
@else 
		
	<div id="pharmacy-tab" class="tab-content pharmacy-main-new">  
	<div class="patient-tab-content pharmacy-detail">

                            <div class="pat-title">
                                <p>Verify Pharmacy Details</p>
                            </div>
                            
                            <div class="pat-content">
                                <p class="mb-3">If a doctor determines that a prescription is needed, we can send it to the pharmacy of your choice.</p>
                                <p>If the pharmacy listed below is not correct for this consultation, click the "Search" button to find the correct one.</p>
                            </div>

                            <div class="pref-phar pref-phar-v1">
                                
                                <div class="botm">
                                    
									@if(auth()->user()->user_pharmcay)
									 <blockquote class="blockquote" style="padding: 1.25rem;border: 1px solid #CED4DA;">
										 <p class="lead text-left mb-3" style="line-height: 26px;margin-bottom: 12px;">
											 <strong>Preferred Pharmacy</strong>
										 </p>
										 <address class="fs-16">
											 <strong>{{ auth()->user()->user_pharmcay->name }}</strong><br>
											 {{ auth()->user()->user_pharmcay->address }}.<br>
											 {{ auth()->user()->user_pharmcay->city }},
											 {{ $pharmacy_state->abbreviation??'' }}
											 {{ auth()->user()->user_pharmcay->zipCode }}<br>
											 <abbr title="Phone">P:</abbr>
											 {{ auth()->user()->user_pharmcay->phone }}
										 </address>
									 </blockquote>
									 @else
									 <blockquote class="blockquote" style="padding: 1.25rem;border: 1px solid #CED4DA;">
										 <p class="lead text-left" style="line-height: 26px;margin-bottom: 12px;">
											 Preferred Pharmacy
										 </p>
										 <p class="mb-0"><strong>You have not selected a preferred pharmacy.</strong> </p>
									 </blockquote>
									 @endif
			 
                                </div>
                            </div>

                            <div class="pharmacy-form">
                               <form class="forms-sample" method="post" id="search-pharmacy">
							   @csrf
                                    <div class="col-100 form-group">
                                        <label>Name</label>
                                        <input class="form-control" type="text" name="name" placeholder="Your Name">
                                    </div>
                                    <div class="col-100 form-group">
                                        <label>Address</label>
                                        <input class="form-control" type="text" name="address" placeholder="Your Address" value="CVS 75070">
                                    </div>
                                    <div class="col-100 form-group">
                                        <label>City</label>
                                        <input class="form-control" type="text" name="city" placeholder="Your City" value="{{ $user ? $user->city : ''  }}">
                                    </div>
                                    <div class="col-100 form-group">
                                        <label>State</label>
                                        <select class="form-control"
                                             name="stateid">
                                             <option value="">Please select state
                                             </option>
                                             @foreach ($states as $state)
                                             <option value="{{ $state->id }}"
                                                 {{ $user ? ($state->id == $user->stateid) ? 'selected' : '' : '' }}>
                                                 {{ $state->name }}</option>
                                             @endforeach
                                        </select>     
                                    </div>
                                    <div class="col-100 form-group">
                                        <label>Zip Code</label>
                                        <input class="form-control" type="text" name="zipCode" value="75070" placeholder="Your Zip Code">
                                    </div>
                                    <div class="col-100 cta">
                                        <button type="button" class="primary-button search-pharmacy-btn-user btn btn-primary mr-3">Search</button>
                                    </div>
									
                                </form>
                            </div>
							<div class="location-custom-main">
								<div class="pre-pharmacy-location" id="showPharmacies"></div>    
									<div class="map-main">
									
		<?php
		if(auth()->user()->user_pharmcay && auth()->user()->user_pharmcay->latitude) {
		$url = "https://maps.google.com/maps?q=".auth()->user()->user_pharmcay->latitude.", ".auth()->user()->user_pharmcay->longitude."&z=15&output=embed";
		} else {
		$url = "https://maps.google.com/maps?q=37.315595, -121.872375&z=15&output=embed";
		}                       
		?>
									 
									  <iframe  src="<?= $url; ?>" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
									</div>
							</div>
							
							
							

    </div>
	
	<div class="col-100 cta">
		<div class="recorc-cta" style="width: 100%; display: flex; justify-content: space-between; align-items: center;">
			<a href="javascript:void(0)" class="outline-button back-btn"><i class="fa fa-chevron-left fa-arrow-icon fa-arrow-icon-back"></i> Back</a>
		</div>
	</div>
	
</div>
	
	@endif



<script>
var usePharmcyid = "";

$(function(){

	$(".search-pharmacy-btn-user").click(function(e) {
        e.preventDefault();
         $(this).attr("disabled", "disabled");
         $("#showPharmacies").html("<div class='pre-pharmacy-location'><div class='loca-phar-card' style='display: block;padding-bottom: 20px;'>Please wait...</div></div>");
       let formData = $('#search-pharmacy').serializeArray();

        formData.push(
            { name: "userid", value: 1 },
            { name: "modality", value: 1 },
            { name: "_token", value: $('#csrf-token').attr('content') }
        );

        $.ajax({
            method: "POST",
            url: SITE_URL + "/search-pharmacy",
            data: formData,
            success: function(response) {

            $("#showPharmacies").html(response.data);
           $(".search-pharmacy-btn-user").removeAttr("disabled");
            $(".btn-loading").hide();

            },
        });
    });
    $(".back-btn").attr("href", "{{ $scheduleUrl }}");
	setTimeout(function() {
		$('.search-pharmacy-btn-user').trigger("click");
	}, 2000);
	
});

function savePrescription() {
	
	window.location.href='<?php echo $nextUrl?>';
}


$(document).on("click", "#update-user-pharmacy-web", function(e) {
        let pharmacyName = $(this).parents("tr").find("#pharmacy-name").text();
        let pharmacyAddress = $(this).parents("tr").find("#pharmacy-address").text();
        let pharmacyCity = $("#pharmacy-city").text();
        let pharmacyZipCode = $(this).parents("tr").find("#pharmacy-zipcode").text();
        let pharmacystateId = $(this).parents("tr").find("#pharmacy-state").attr("stateid");
        let pharmacyphone = $(this).parents("tr").find("#pharmacy-phone").attr("phone");
        let selectedPharmacyId = $(this).parents("tr").find("#pharmacy-id").val();
        let latitude = $(this).parents("tr").find("#latitude").val();
        let longitude = $(this).parents("tr").find("#longitude").val();
        console.log(pharmacystateId);
        $.ajax({
            method: "POST",
            url: SITE_URL + "/update-pharmacy",
            dataType: "json",
            data: {
                "_token": $('#csrf-token')[0].content,
                "name": pharmacyName,
                "address": pharmacyAddress,
                "city": pharmacyCity,
                "zipCode": pharmacyZipCode,
                "stateid": pharmacystateId,
                "phone": pharmacyphone,
                "sureScriptPharmacy_id": selectedPharmacyId,
                "latitude":latitude,
                "longitude":longitude
            },
            success: function(res) {
                if (res.success) {
                    toastr.success(res.success);
					usePharmcy(selectedPharmacyId)
                    //window.location.reload();
                } else {
                    toastr.error(res.error);
                }
            },
        });
});
function usePharmcy(sureScriptPharmacy_id){
	usePharmcyid = "yes";
	scheduleConsultation.sureScriptPharmacy_id = sureScriptPharmacy_id;
	localStorage.setItem("scheduleConsultation", JSON.stringify(scheduleConsultation));
	scheduleConsultationNow();
}
function scheduleConsultationNow() {
	console.log(usePharmcyid);
	if (usePharmcyid=="") {
		toastr.error("Please Select Pharmacy");
		return false;
	}
	
	let scheduleConsultation = JSON.parse(localStorage.getItem("scheduleConsultation"));
	if(scheduleConsultation.price > 0) {
		//console.log(" +++ "+scheduleConsultation.price);
		window.location.href='<?php echo $paymentUrl?>';
	} else {
		//console.log(" --- "+scheduleConsultation.price);
		CallAjaxNow(scheduleConsultation);
	}
			
}

function CallAjaxNow(scheduleConsultations) {
	
	$("#scheduleConsultationbutton").hide();
	toastr.info('Please wait...', 'Processing', {
                timeOut: 0,
                extendedTimeOut: 0,
    });
	let scheduleConsultation = JSON.parse(localStorage.getItem("scheduleConsultation"));
	$.ajax({
		url: '{{ url("createConsultationSubmit")}}', // <-- set your route here
		method: 'POST',
		data: {
			scheduleConsultation: scheduleConsultation,
			_token: '{{ csrf_token() }}' // important for Laravel POST
		},
		success: function(response) {
			toastr.clear();
			if (response.success) {
				toastr.success(response.message);	
				window.location.href='<?php echo $nextUrl?>';
			} else {
				$("#scheduleConsultationbutton").show();
				toastr.error(response.message);
			}
		},
		error: function(xhr) {
			toastr.clear()
			$("#scheduleConsultationbutton").show();
			toastr.error(xhr.responseJSON?.message || 'An unexpected error occurred.');
		}
	});
}	
</script>
@endif
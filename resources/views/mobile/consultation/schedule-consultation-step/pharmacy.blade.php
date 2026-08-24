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

	@include('mobile.consultation.schedule-consultation-step.payment-confirm')
@else 
<div id="pharmacy-tab" class="tab-content"> 
	
@if(request('action') === 'dermatology')
	
	@php 
		$scheduleUrl = url('/schedule-consultation/' . Request::segment(2) . '/step-6/' . Request::segment(4)) . '?action=' . request('action').'';
	@endphp

@endif	
	

	<div class="patient-tab-content pharmacy-detail">

                            <div class="pat-title">
                                <p>Verify Pharmacy Details</p>
                            </div>
                            
                            <div class="pat-content">
                                <p>If a doctor determines that a prescription is needed, we can send it to the pharmacy of your choice.</p>
                                <p>If the pharmacy listed below is not correct for this consultation, click the "Search" button to find the correct one.</p>
                            </div>

                            <div class="pref-phar">
                                
                                <div class="botm">
                                    
									@if(auth()->user()->user_pharmcay)
									 <blockquote class="blockquote" style="padding: 1.25rem;border: 1px solid #CED4DA;">
										 <p class="lead text-left" style="line-height: 26px;margin-bottom: 12px;">
											 Preferred Pharmacy
										 </p>
										 <address class="fs-16">
											 <strong>{{ auth()->user()->user_pharmcay->name }}</strong><br>
											 {{ auth()->user()->user_pharmcay->address ?? '' }}.<br>
											 {{ auth()->user()->user_pharmcay->city ?? '' }},
											 {{ $pharmacy_state->abbreviation ??'' }}
											 {{ auth()->user()->user_pharmcay->zipCode ?? '' }}<br>
											 <abbr title="Phone">P:</abbr>
											 {{ auth()->user()->user_pharmcay->phone ?? '' }}
										 </address>
									 </blockquote>
									 @else
									 <blockquote class="blockquote" style="padding: 1.25rem;border: 1px solid #CED4DA;">
										 <p class="lead text-left" style="line-height: 26px;margin-bottom: 12px;">
											 Preferred Pharmacy
										 </p>
										 <p class="mb-0"><strong>You have not selected a preferred
												 pharmacy.</strong> </p>
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
										<div class="recorc-cta" style="width: 100%;display: flex;justify-content: space-between;align-items: center;margin-top: 20px;">
											<a href="{{ $scheduleUrl }}" class="outline-button back-btn showLoaderPageLoad">Back</a>
											<button type="submit" class="primary-button search-pharmacy-btn">Search</button>
										
										</div>
                                    </div>
									
                                </form>
                            </div>

                            <div class="pre-pharmacy-location" id="showPharmacies">


                                    
                                    </div>
                                    
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
							
							
							<?php /*
                            <div class="col-100 cta" style="width: 100%;display: block;">
                                <?php $consultation_id = $consultation ? $consultation->id : "" ?>                                
                                <form action="{{ route('update.consultation', $consultation_id) }}" method="POST" id="select-consulation">   
                                    @csrf        
                                    <input type="hidden" value="<?php echo request('action')?>" name="action_type" />
                                    <input type="hidden" name="next-step" value="step-8">           
                                    <input type="hidden" name="step" value="7">      
                                    <input type="hidden" name="sureScriptPharmacy_id" value="{{ auth()->user()->user_pharmcay ? auth()->user()->user_pharmcay->sureScriptPharmacy_id :  config('constants.sureScriptPharmacy_id')  }}" />    
                                
                        
                                        <div class="form-row">
                                        <div class="col-100 cta">
                                                <div class="recorc-cta" style="width: 100%;display: flex;justify-content: space-between;align-items: center;margin-top: 20px;">  
                                                    <a href="{{ $scheduleUrl }}" class="outline-button">Back</a>
													
													<button type="button" id="scheduleConsultationbutton" class="primary-button" onclick="scheduleConsultationNow()">Next</button>
													
													
													
                                                </div>
                                        </div>
                                        </div> 

                                </form>    
                            </div>
							*/ ?>

    </div>
	
</div>

@endif




<script>
var usePharmcyid = "";
$(function(){
	$(".search-pharmacy-btn").click(function(e) {
        e.preventDefault();
        $(this).attr("disabled", "disabled");
        $("#showPharmacies").html("<div class='pre-pharmacy-location'><div class='loca-phar-card' style='display: block;padding-bottom: 20px;'>Please wait...</div></div>");
        $action = SITE_URL + "/search-pharmacy/";
        $.post($action, $('#search-pharmacy').serialize(), function(response) {
            console.log(response);
            $("#showPharmacies").html(response.data);
            $(".search-pharmacy-btn").removeAttr("disabled");
            $(".btn-loading").hide();
        });

        return false;
    });

    $(".schedule-consultation .back-btn").attr("href", "{{ $scheduleUrl }}");
	
	setTimeout(function() {
		$('.search-pharmacy-btn').trigger("click");
	}, 2000);
	
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
function securePaynow() {
	let card_number = $("#card_number").val();
	if(!card_number) {
		toastr.error("Credit Card Number Required");
		return false;
	}
	let cvv = $("#cvv").val();
	let exp_year = $("#exp_year").val();
	let exp_month = $("#exp_month").val();
	if(!cvv) {
		toastr.error("Credit Card Number Required");
		return false;
	}
	
	$.ajax({
		url: '{{ url("createConsultationPayment")}}', 
		method: 'POST',
		data: {
			card_number: card_number,
			exp_year: exp_year,
			exp_month: exp_month,
			cvv: cvv,
			_token: '{{ csrf_token() }}' // important for Laravel POST
		},
		success: function(response) {
			toastr.clear();
			if (response.success) {
				toastr.success(response.message);	
				//window.location.href='<?php echo $nextUrl?>';
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


$(document).on("click", "#update-user-pharmacy-app", function(e) {
		toastr.info('Please wait...', 'Processing', {
                timeOut: 0,
                extendedTimeOut: 0,
		});
        let pharmacyName = $(this).parents(".loca-phar-card").find("#pharmacy-name").text();
        let pharmacyAddress = $(this).parents(".loca-phar-card").find("#pharmacy-address").text();
        let pharmacyCity = $("#pharmacy-city").text();
        let pharmacyZipCode = $(this).parents(".loca-phar-card").find("#pharmacy-zipcode").text();
        let pharmacystateId = $(this).parents(".loca-phar-card").find("#pharmacy-state").attr("stateid");
        let pharmacyphone = $(this).parents(".loca-phar-card").find("#pharmacy-phone").attr("phone");
        let selectedPharmacyId = $(this).parents(".loca-phar-card").find("#pharmacy-id").val();
        let latitude = $(this).parents(".loca-phar-card").find(".loca-phar-card").val();
        let longitude = $(this).parents(".loca-phar-card").find(".loca-phar-card").val();
        console.log(pharmacystateId);
        $.ajax({
            method: "POST",
            url: SITE_URL + "/update-pharmacy",
            dataType: "json",
            data: {
                "_token":'{{ csrf_token() }}',
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

</script>
@endif
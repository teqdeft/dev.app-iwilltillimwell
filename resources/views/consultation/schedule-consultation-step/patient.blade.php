@if (Request::segment(3) == '' || Request::segment(3) == 'step-1')
<div role="tabpanel"
	class="tab-pane {{ (Request::segment(3) == '' || Request::segment(3) == 'step-1' ) ? 'active' : '' }}"
	id="discover">
	<div class="design-process-content">
		<h3 class="semi-bold">Who Is This Session For?</h3>
		<div class="table-responsive pt-3">
			<table class="table table-bordered">
                <thead>
                    <tr>
						<th width="80px">#</th>
						<th width="110px">Profile</th>
                        <th>Name</th>
					</tr>
                </thead>
                <tbody class="select-">

                                                     <tr>

                                                         <a href="#">

                                                             <td>

                                                                 <div class="form-check form-check-primary">

                                                                     <label class="form-check-label">

                                                                         <input type="radio" class="form-check-input"

                                                                             name="patient" id="ExampleRadio1"

                                                                             value="{{ Auth::user()->userid }}">

                                                                         <i class="input-helper"></i></label>

                                                                 </div>

                                                             </td>
															 
															 <td>
																<div class="profile-consultant">
																
																@if(!empty(Auth::user()->profile_image) && file_exists(public_path('profiles/' . Auth::user()->profile_image)))
																	
																<img src="{{ asset('profiles/' . Auth::user()->profile_image) }}" width="100" alt="Profile Image">
																
																@else  
																	
																<img src="{{ asset('assets/dashboard/assets/images/dummy-image.svg')}}" alt="image" />
																	
																@endif 
																
																	
																	
																</div>	
															 </td>

                                                             <td>

                                                                 <div class="radiotext">

                                                                     <label

                                                                         for='ExampleRadio1'>{{ ucfirst(Auth::user()->fname) }} {{ ucfirst(Auth::user()->lname) }}</label>

                                                                 </div>

                                                             </td>

                                                         </a>

                                                     </tr>

                                                     @if ($dependents)

                                                     @foreach ($dependents as $dependent)

                                                     <tr>

                                                         <?php $relationship = Config::get('constants.relationship'); ?>

                                                         @if ($dependent->age < Config::get('constants.minor_age'))

															 
															 
														<td>

                                                             <div class="form-check form-check-primary">

                                                                 <label class="form-check-label">

                                                                     <input type="radio" class="form-check-input"

                                                                         name="patient" id="ExampleRadio{{ $dependent->userid }}"

                                                                         value="{{ $dependent->userid }}">

                                                                     <i class="input-helper"></i></label>

                                                             </div>

                                                        </td>
															
															<td>
																<div class="profile-consultant" for='ExampleRadio{{ $dependent->userid }}'>
																	
																@if(!empty($dependent->profile_image) && file_exists(public_path('profiles/' . $dependent->profile_image)))
																	
																<img src="{{ asset('profiles/' . $dependent->profile_image) }}" width="100" alt="Profile Image">
																
																@else  
																	
																<img src="{{ asset('assets/dashboard/assets/images/dummy-image.svg')}}" alt="image" />
																	
																@endif
																	
																</div>
															</td>
															 
                                                             <td>

                                                                 <div class="radiotext">

                                                                     <label for='ExampleRadio{{ $dependent->userid }}'>
																	 {{ ucfirst($dependent->fname) }} 
																	 {{ ucfirst($dependent->lname) }}

                                                                         <span

                                                                             class="fs-12 text-danger">({{ ($dependent->relationship!=0) ? $relationship[$dependent->relationship] : "" }})

                                                                         </span></label>

                                                                 </div>

                                                             </td>

                                                             @else

                                                             <td>

                                                                 <div class="form-check form-check-primary">

                                                                     <label class="form-check-label">

                                                                         <input type="radio" class="form-check-input"

                                                                             name="ExampleRadio1" id="ExampleRadio{{ $dependent->userid }}"

                                                                             disabled>

                                                                         <i class="input-helper"></i></label>

                                                                 </div>

                                                             </td>
															<td>
																
																<div class="profile-consultant">
																	
																	@if(!empty($dependent->profile_image) && file_exists(public_path('profiles/' . $dependent->profile_image)))
																	
																<img src="{{ asset('profiles/' . $dependent->profile_image) }}" width="100" alt="Profile Image">
																
																@else  
																	
																<img src="{{ asset('assets/dashboard/assets/images/dummy-image.svg')}}" alt="image" />
																	
																@endif
																
																</div>
																
															</td>
                                                             <td>

                                                                 <div class="radiotext">

                                                                     <label for='ExampleRadio{{ $dependent->userid }}'>
																	 {{ ucfirst($dependent->fname) }}
																	 
																	 {{ ucfirst($dependent->lname) }}

                                                                         <span

                                                                             class="fs-12 text-danger">({{ ($dependent->relationship!=0) ? $relationship[$dependent->relationship] : "" }})

                                                                         </span></label>

                                                                     <label class="text-danger d-block fs-12">*

                                                                         Dependent is over 18 and must manage their own

                                                                         records.</label>

                                                                 </div>

                                                             </td>

                                                             @endif

                                                     </tr>

                                                     @endforeach

                                                     @endif

            </tbody>
        </table>
<script>
$(document).on("change", "input[type=radio][name=patient]", function(e) {
	
	let userid = $(this).val();
        let modality = $("#modality").val();
        let action = '<?php echo request("action")?>';

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
</script>

		</div>
	</div>
	
	
	<div class="d-flex justify-content-between btn-group-box mt-5 ">
	
		<a class="outline-button back-btn" 
		   href="{{ url('consultation-type?action=' . request('action')) }}">
			<i class="fa fa-chevron-left fa-arrow-icon fa-arrow-icon-back"></i> 
			Back
		</a>
		
		<a class="btn btn-primary mr-3 next-button-ehr-phone disabled" id="submit-policy" href="javascript:void(0)" disabled="disabled">Next <i class="fa fa-chevron-right fa-arrow-icon"></i></a>
		
	</div>
</div>
@endif
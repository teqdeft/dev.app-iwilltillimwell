<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap" rel="stylesheet">
	
	<link rel="shortcut icon" href="{{ asset('assets/images/imwell-favi.png') }}" />
	
     <link rel="stylesheet" href="{{ asset('assets/dashboard/htmlv/assets/css/style.css') }}">

<style>
* {
	-webkit-print-color-adjust: exact !important; 
	color-adjust: exact !important;
	print-color-adjust: exact !important;
	}
	body {
		background: #fff !important;
	}
@media print {
  body {
    zoom: 0.7; 
  }
  #printBtn {
    display: none !important;
  }
  a[href]:after {
    content: none !important;
  }
}



</style>

</head>

<body>
    <div class="consultation-print">
	
		
		<div class="print-header">
			
			
			<div class="back-btn-action" <?php if(!ismobile()) {?> style="display:none;" <?php } ?>>
				<a href="{{ url('my-consultations')}}" class="back-btn" id="backButton">Back</a>
			</div>	
			
			
			<div class="print-btn">
				<button class="print-btn" id="printBtn" onclick="printPage()">&#x1F5A8; Print</button>
			</div>
			
		</div>
		
        <div class="consul-print-logo">
            
			<img src="{{ url('assets/assets/images/sg-iwilltilimwell-h-headerbar-logomark.png')}}"
                alt="logo">
			
        </div>
        <div class="consul-print-main-title">
            <p>Consultation Summary & Treatment Plan</p>
        </div>

        <!-- consu detail -->
        <div class="consu-top-row">

            <div class="top-card">
                <div class="title">
                    <p>Patient</p>
                </div>
                <div class="cosul-card-main-v1">
                    <div class="cosul-card">
                        <div class="name">
                            <p>Name</p>
                        </div>
                        <div class="value">
                            <p>
							{{ $consultations[0]['patient']['firstName'] }}
							{{ $consultations[0]['patient']['middleName'] }}
							{{ $consultations[0]['patient']['lastName'] }}
							
							</p>
                        </div>
                    </div>
                    <div class="cosul-card">
                        <div class="name">
                            <p>Age</p>
                        </div>
                        <div class="value">
                            <p>{{calculateAge($consultations[0]['patient']['dob'])}}</p>
                        </div>
                    </div>
                    <div class="cosul-card">
                        <div class="name">
                            <p>Sex</p>
                        </div>
                        <div class="value">
                            <p>{{ getGender($consultations[0]['patient']['gender']) }}</p>
                        </div>
                    </div>
					
                    <div class="cosul-card">
                        <div class="name">
                            <p>Date of Birth</p>
                        </div>
                        <div class="value">
                            <p>{{ $consultations[0]['patient']['dob'] }}</p>
                        </div>
                    </div>
					<?php /**/ ?>
                </div>
            </div>

            <div class="top-card">
                <div class="title">
                    <p>Consultation</p>
                </div>
                <div class="cosul-card-main-v1 v2">
                    <div class="cosul-card">
                        <div class="name">
                            <p>Provider</p>
                        </div>
                        <div class="value">
                            <p></p>
                        </div>
                    </div>
                    <div class="cosul-card">
                        <div class="name">
                            <p>Date:</p>
                        </div>
                        <div class="value">
                            <p>
								{{ ConsultantDateFormat($consultations[0]['whenCreated'])}}
							</p>
                        </div>
                    </div>
                    <div class="cosul-card">
                        <div class="name">
                            <p>Encounter</p>
                        </div>
                        <div class="value">
                            <p>{{$consultations[0]['friendlySubTypeName']}} | {{ucfirst($consultations[0]['modality'][0])}}</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <!-- intake card -->

        <div class="intake-main">
            <div class="intake-title">
                <p>Intake</p>
            </div>
            <div class="intake-card-main">
                <div class="intake-card bb-1">
                    <div class="card-title mt-0">
                        <p>Reason for Consultation</p>
                    </div>
                    <div class="card-text">
                        			<p>Had a respiratory illness. Thought it was viral but the amoxicillin cleared it up immediately but the cough lingered. The cough is now so bad and consistent (even with OTC muscinex) that the dry cough has changed to a productive cough with light green mucous. That means that the infection is coming back. I'm wondering if I should go in to let a provider listen to my lungs AND/OR get a chest X-ray.</p>
                    </div>
                </div>
				
				@isset($consultations[0]['soap']['bh'])

				@php
					$questions_list = $consultations[0]['soap']['bh'][0]['questions'];
				@endphp
		
					<div class="intake-question bb-1">

						<div class="card-title">
							<p>Intake Questionnaire</p>
						</div>
						@php 
							$counter = 1;
						@endphp
						@foreach($questions_list as $list)
							
							<div class="q-card">
								<div class="q-title">
									<p>{{$counter++}}.{{$list['question']}}</p>
								</div>
							</div>
							
						@endforeach
					
					</div>
				
				
               @endisset

					
                <div class="allergies">

                    <div class="all-card">
                        <div class="all-title">
                            <p>Allergies/Intolerance</p>
                        </div>
                        <div class="all-text">
                            <p>Sulfamethoxazole</p>
                        </div>
                    </div>

                    <div class="all-card">
                        <div class="all-title">
                            <p>Vitals</p>
                        </div>
                        <div class="detail-gies">
                            <div class="height">
                                <p>
									<span class="title">Height:</span>
									<span class="value"> 
										{{ $consultation['soap']['vitals']['height']['feet'] ?? '-' }}' {{ $consultation['soap']['vitals']['height']['inches'] ?? '-' }}"</span>
								</p>
                            </div>
                            <div class="height">
                                <p>
									<span class="title">Weight:</span>
									<span class="value"> {{ $consultation['soap']['vitals']['height']['lbs'] ?? '-' }}lbs</span></p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>

        <div class="intake-main">
            <div class="intake-title">
                <p>Assessment & Treatment Plan</p>
            </div>
            <div class="intake-card-main">
                <div class="intake-card">
                    <div class="card-title mt-0">
                        <p>Assessment</p>
                    </div>
                    <div class="card-text bb-1">
                        <p>Acute bronchitis due to Mycoplasma pneumoniae</p>
                    </div>
                </div>

                <div class="intake-card">
                    <div class="card-title">
                        <p>Plan</p>
                    </div>
                    <div class="card-text">
                        <p>Will treat for bronchitis, suspected Mycoplasma with Azithromycin for 5 days. Will also
                            prescribe albuterol inhaler. Enclosed is a video for patient education on inhaler
                            instructions, https://www.youtube.com/watch?v=fHYTz-ZoRLw. Will also prescribe Medrol dose
                            pack. Instructed patient of need to obtain a chest xray to rule out pneumonia based on her
                            symptoms. Patient advised to follow up in person at local urgent care or ER if no
                            improvement or symptoms worsen. Patient verbalized understanding.</p>
                    </div>
                </div>
            </div>
        </div>
		
		<?php /*	
        <div class="intake-main">
            <div class="intake-title">
                <p>Prescriptions</p>
            </div>
            <div class="intake-card-main">
                <div class="medicines-main-v1">
                    <div class="card-title mt-0">
                        <p>Medicines</p>
                    </div>
                    <div class="print-medicines-detail">
                        
                        <div class="medi-detail">
                            <div class="detail-100 w-500">
                                <p>Paracetamol 500mg</p>
                            </div>
                            <div class="detail-25">

                                <div class="medi-col-25">
                                    <div class="lable-name">
                                        <p>Strength</p>
                                    </div>
                                    <div class="lable-value">
                                        <p>90 mcg/inh</p>
                                    </div>
                                </div>

                                <div class="medi-col-25">
                                    <div class="lable-name">
                                        <p>Dosage</p>
                                    </div>
                                    <div class="lable-value">
                                        <p>Aerosol</p>
                                    </div>
                                </div>

                                <div class="medi-col-25">
                                    <div class="lable-name">
                                        <p>Quantity</p>
                                    </div>
                                    <div class="lable-value">
                                        <p>1</p>
                                    </div>
                                </div>

                                <div class="medi-col-25">
                                    <div class="lable-name">
                                        <p>Refills</p>
                                    </div>
                                    <div class="lable-value">
                                        <p>0</p>
                                    </div>
                                </div>

                            </div>
                            <div class="detail-100">
                                <div class="lable-name">
                                    <p>Directions</p>
                                </div>
                                <div class="lable-value">
                                    <p>1 tablet everyday for 1 week in morning, noon after food.</p>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
		*/ ?>
        <div class="intake-main">
            <div class="intake-title">
                <p>Pharmacy</p>
            </div>
            <div class="intake-card-main">
                <div class="intake-card">
                    <div class="card-title mt-0">
                        <p>Location</p>
                    </div>
                    <div class="card-text bb-1">
                        <p>
							@isset($consultations[0]['pharmacy'])
							
								{{$consultations[0]['pharmacy']['pharmacy_name']}}, 
								{{$consultations[0]['pharmacy']['pharmacy_address']}}, 
								{{$consultations[0]['pharmacy']['pharmacy_city']}},
								{{ data_get($consultations, '0.pharmacy.pharmacy_state.name', $consultations[0]['pharmacy']['pharmacy_state'] ?? 'N/A') }}
								{{ $consultations[0]['pharmacy']['pharmacy_phone'] }}

							@endisset	
						</p>
                    </div>
                </div>
            </div>
        </div>

    </div>

<script>
function printPage() {
	
    const backButton = document.getElementById("backButton");
    const btn = document.getElementById("printBtn");
    btn.style.display = "none";
    backButton.style.display = "none";

    try {
        window.print();
    } finally {
        setTimeout(() => {
            btn.style.display = "block";
            backButton.style.display = "block";
        }, 100);
    }
}
</script>
</body>
</html>
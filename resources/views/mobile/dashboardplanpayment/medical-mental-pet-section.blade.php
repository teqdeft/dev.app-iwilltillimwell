<?php 

		// new section add 12 25 25

	?>

	

	<section class="consult-detail new_v1">

	<div class="tab-container dash_choose_consult">

            <div class="tab-header">

                <!-- Tab Buttons -->

                <div class="tab-buttons patient-details">

                    @if(org_can('medical_care') || org_can('health_record'))
                    <button class="tab-link {{ request()->get('active-tab') == 'medical-tab' || !request()->has('active-tab') ? 'active' : '' }}" data-tab="medical-tab">

                        <span>

                            Medical Care

                        </span>

                    </button>

                    @endif
@if(org_can('mental_health'))
                    <button class="tab-link {{ request()->get('active-tab') == 'mental-tab' ? 'active' : '' }}" data-tab="mental-tab">

                        <span>

                            Mental Health Care

                        </span>

                    </button>

                    @endif
@if(org_can('pets'))
                    <button class="tab-link {{ request()->get('active-tab') == 'pet-tab' ? 'active' : '' }}" data-tab="pet-tab">

                        <span>

                            Pet Care 

                        </span>

                    </button>
                @endif

                </div>

            </div>



@php



				

$data_medical[] = [

					'id'=>'1',

					'name'=>'Urgent Care',

					'ico'=>'urgentcare.svg',

					'slug'=>'consultation-type?action=urgentcare',

					'service_status'=>'active'

				   ];					

$data_medical[] = [

					'id'=>'2',

					'name'=>'Primary Care',

					'sub_name'=>'$25 Co-pay per visit',

					'ico'=>'primary-care.svg',

					'slug'=>'consultation-type?action=primarycare',

					'service_status' => $primarycare ? 'active' : '',

					'alert_function'=>'upgrade-alert'

				];

$data_medical[] = [

					'id'=>'3',

					'name'=>'Dermatology',

					'sub_name'=>'$60.00 / Visit after 3rd Consult',

					'ico'=>'dermatology.svg',

					'slug'=>'consultation-type?action=dermatology',

					'service_status' => $dermatology ? 'active' : '',

					'alert_function'=>'upgrade-alert'

				];

				

				

				

$data_medical[] = [

					'id'=>'4',

					'name'=>'Semaglutide',

					'ico'=>'semaglutide.svg',

					'slug'=>'lab-report',

					'service_status'=>'',

					'alert_function'=>'dash-semaglutide-alert'

				];

				

$data_medical[] = [

					'id'=>'5','name'=>'Musculoskeletal',

					'ico'=>'msk.svg',

					'slug'=>'lab-report',

					'service_status'=>'',

					'alert_function'=>'dash-semaglutide-alert'

				];

							

// Organisation members get two separate cards - Crisis Management
	// first - each opening only its own panel.
	if( org_current() ){
		$data_mental[] = [
			'id'=>'23',
			'name'=>'Crisis Management',
			'sub_name'=>'',
			'ico'=>'crisis-management.svg',
			'slug'=>'in-the-moment-care?care=crisis',
			'service_status'=>'active',
			'tag'=>'Immidiate Care'
		];
		$data_mental[] = [
			'id'=>'1',
			'name'=>'In-The-Moment Care',
			'sub_name'=>'',
			'ico'=>'in-the-moment-care.svg',
			'slug'=>'in-the-moment-care?care=itmc',
			'service_status'=>'active',
			'tag'=>'Immidiate Care'
		];
	} else {
		$data_mental[] = [
			'id'=>'1',
			'name'=>'In-The-Moment Care & Crisis Management ',
			'sub_name'=>'',
			'ico'=>'in-the-moment-care.svg',
			'slug'=>'in-the-moment-care',
			'service_status'=>'active',
			'tag'=>'Immidiate Care'
		];
	}

$data_mental[] = [

					'id'=>'2',

					'name'=>'Behavioral Health',

					'sub_name'=>'Find a Therapist',

					'ico'=>'behavioral-health.svg',

					'slug'=>'talk-to-therapist',

					'service_status'=>'active',

					'tag'=>'Short-Term Therapy'

				];

// Paid per-visit consultations are not part of an organisation plan.
	if( !org_current() ){
$data_mental[] = [

					'id'=>'3',

					'name'=>'Psychologist',

					'sub_name'=>'$100/Visit',

					'ico'=>'psychology.svg',

					'slug'=>'consultation-type?action=psychology',

					'service_status'=>$psychology ? 'active' : '',

					'alert_function'=>'upgrade-alert',

					'tag'=>'Long-Term Therapy'

				];

$data_mental[] = [

					'id'=>'4',

					'name'=>'Psychiatrist',

					'sub_name'=>'Psychiatrist',

					'ico'=>'psychiatry.svg',

					'slug'=>'consultation-type?action=psychiatry',

					'service_status'=>$psychiatry ? 'active' : '',

					'alert_function'=>'upgrade-alert',

					'tag'=>'Long-Term Therapy'

				];
	}

								

$data_pet[] = [

				'id'=>'1',

				'name'=>'Talk To A Vet',

				'ico'=>'talk-to-a-vet.svg',

				'slug'=>'pet-health?action=talk-to-veterinarian',

				'service_status'=>$telepets ? 'active' : '',

				'alert_function'=>'upgrade-alert'

			];

				

@endphp



            <div class="tab-content-detail">

                <!-- Tab Content -->

                @if(org_can('medical_care') || org_can('health_record'))
                <div id="medical-tab" class="tab-content {{ request()->get('active-tab') == 'medical-tab' || !request()->has('active-tab') ? 'active' : '' }}">

				

				

					@include('mobile.dashboardplanpayment.medical-mental-pet', [

						'active_class' => 'active',

						'tab_name' => 'medical-tab',

						'data' => $data_medical

					])	

					 

                </div>
                @endif



                @if(org_can('mental_health'))
                <div id="mental-tab" class="tab-content {{ request()->get('active-tab') == 'mental-tab' ? 'active' : '' }}">

					

					@include('mobile.dashboardplanpayment.medical-mental-pet', [

						'active_class' => '',

						'tab_name' => 'mental-tab',

						'data' => $data_mental

					])

                    

				</div>
                @endif



                @if(org_can('pets'))
                <div id="pet-tab" class="tab-content {{ request()->get('active-tab') == 'pet-tab' ? 'active' : '' }}">



                  @include('mobile.dashboardplanpayment.medical-mental-pet', [

						'active_class' => '',

						'tab_name' => 'pet-tab',

						'data' => $data_pet

					])

				 

                </div>
                @endif



            </div>



        </div>

        </section>

	

	<?php 

		// new section add

	?>
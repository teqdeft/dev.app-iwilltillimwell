<div class="dash-section">
	<div class="vis_dash2v_row">
		<div class="service_col">
			<div class="dashboard-title"><div class="title"><p>My Mental Health</p></div></div>
			<div class="dash-row-v1">
			@php 
			
				$data[] = ['id'=>'11','name'=>'My Moods','ico'=>'my-moods.svg','slug'=>'my-mood-feeling'];	
				$data[] = ['id'=>'12','name'=>'My Journal','ico'=>'my-journal.svg','slug'=>'journal'];	
				$data[] = ['id'=>'13','name'=>'My Safety Plan','ico'=>'my-safety.svg','slug'=>'my-safety-plan'];	
				$data[] = ['id'=>'14','name'=>'My Thought Analysis','ico'=>'my-thought-analysis.svg','slug'=>'cbt-therapy'];	
				$data[] = ['id'=>'15','name'=>'Mental Health Screenings','ico'=>'mental-health-screenings.svg','slug'=>'mental-health-screening'];	
				$data[] = ['id'=>'16','name'=>'My Screenings History','ico'=>'my-screening-history.svg','slug'=>'my-screening-history-graph'];	
				$data[] = ['id'=>'17','name'=>'Personal Analysis','ico'=>'personal-analysis.svg','slug'=>'my-mood-feeling-history-graph'];	
				// Group Dashboard is an external sheet that does not apply to
				// organisation members, so it is hidden for them only.
				if( !(function_exists('org_current') && org_current()) ){
					$data[] = ['id'=>'18','name'=>'Group Dashboard','ico'=>'group-dashboard.svg','slug'=>'https://script.google.com/macros/s/AKfycbw1lV3BByxySHBAWQSud4vSP4sTI0DNKmZrHZ5nBdlybbee8SBgytQ7v6adqLfS1hPL/exec'];
				}
				
			@endphp	
				@include('user.dashboard.dashboard-layout-loop',['dash_layout'=>'left','data'=>$data])
			</div>
		</div>
		<div class="consul_col">
			<div class="dashboard-title"><div class="title"><p>Schedule Your Consultation</p></div></div>
			<div class="dash-row-v1">
			@php
				$imwellOrgMember = function_exists('org_current') && org_current();

				// Organisation members get Crisis Management first, then
				// In-The-Moment Care. Each card opens only its own panel.
				if( $imwellOrgMember ){
					$schedule[] = [
									'id'=>'23',
									'name'=>'Crisis Management',
									'sub_name'=>'',
									'tag'=>'Immidiate Care',
									'ico'=>'crises.svg',
									'slug'=>'in-the-moment-care?care=crisis'
								];
				}

				$schedule[] = [
								'id'=>'19',
								'name'=>'In-The-Moment Care',
								'sub_name'=>'',
								'tag'=>'Immidiate Care',
								'ico'=>'crises.svg',
								'slug'=> $imwellOrgMember ? 'in-the-moment-care?care=itmc' : 'in-the-moment-care'
							];

				$schedule[] = [
								'id'=>'20',
								'name'=>'Behavioral Health',
								'ico'=>'behavioral-health.svg',
								'slug'=>'behavioral-health',
								'sub_name'=>'Find a Therapist'
							   ];

				// Paid per-visit consultations are not part of an organisation's
				// plan, so these two cards are hidden for org members only.
				if( !$imwellOrgMember ){
					$schedule[] = [
									'id'=>'21',
									'name'=>'Psychologist',
									'ico'=>'psychology-web.svg',
									'slug'=>'consultation-type?action=psychology',
									'sub_name'=>'$100.00 / Visit',
									'book_now'=>'yes'
								];

					$schedule[] = [
									'id'=>'22',
									'name'=>'Psychiatrist',
									'ico'=>'psychiatry-web.svg',
									'slug'=>'consultation-type?action=psychiatry',
									'sub_name'=>'$100.00 / Visit',
									'book_now'=>'yes'
								];
				}


			@endphp
				@include('user.dashboard.dashboard-layout-loop',['dash_layout'=>'right','data'=>$schedule])
			</div>
		</div>			
	</div>
</div>
<div class="dash-section">
	<div class="vis_dash2v_row">
		<div class="service_col">
			<div class="dashboard-title"><div class="title"><p>My Medical Care</p></div></div>
			<div class="dash-row-v1">
			@php 
				$data[] = ['id'=>'1','name'=>'My Health Record','ico'=>'my-health-records.svg','slug'=>'personal-record'];	
				$data[] = ['id'=>'2','name'=>'Message a Specialist','ico'=>'message-a-specialist.svg','slug'=>'message-a-specialist'];	
				$data[] = ['id'=>'3','name'=>'Lab Requests','ico'=>'lab-requests.svg','slug'=>'lab-report'];	
				$data[] = ['id'=>'4','name'=>'Care Coordination','ico'=>'care-coordination.svg','slug'=>'care-coordination'];	
			@endphp	
				@include('user.dashboard.dashboard-layout-loop',['dash_layout'=>'left','data'=>$data])
			</div>
		</div>
		<div class="consul_col">
			<div class="dashboard-title"><div class="title"><p>Schedule Your Consultation</p></div></div>
			<div class="dash-row-v1">
			@php 
				$schedule[] = [
								'id'=>'5',
								'name'=>'Urgent Care',
								'ico'=>'urgent-care.svg',
								'slug'=>'consultation-type?action=urgentcare',
								'book_now'=>'yes'
								];	
				
				$schedule[] = [
								'id'=>'6',
								'name'=>'Primary Care',
								'sub_name'=>'$25 Co-pay per visit',
								'ico'=>'primary-care-web.svg',
								'slug'=>'consultation-type?action=primarycare',
								'book_now'=>'yes'
							  ];
				
				$schedule[] = [
								'id'=>'7',
								'name'=>'Dermatology',
								'sub_name'=>'$60.00/ Visit after 3rd Consult',
								'ico'=>'dermatology-web.svg',
								'slug'=>'consultation-type?action=dermatology',
								'book_now'=>'yes'
							  ];
				
				$schedule[] = [
								'id'=>'8',
								'name'=>'Semaglutide',
								'ico'=>'semaglutide.svg',
								'slug'=>'',
								'extra_class'=>'msk_vs12',
								'ds_status'=>'true',
								'book_now'=>'yes'
							];	
				
				$schedule[] = [
								'id'=>'9',
								'name'=>'Musculoskeletal',
								'ico'=>'msk.svg',
								'slug'=>'',
								'extra_class'=>'msk_vs12',
								'ds_status'=>'true',
								'book_now'=>'yes'
							];	
			@endphp
			@include('user.dashboard.dashboard-layout-loop',['dash_layout'=>'right','data'=>$schedule])
			</div>
		</div>			
	</div>
</div>
					
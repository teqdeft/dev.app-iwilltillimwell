@extends("mobile.layouts.group-organizations")
@section("content")

<style>
body { background: #eeeff4 !important;}
</style>

<section class="user-detail-hi">
	<div class="cust-container-md">
		<div class="affirmation-user-dehs">
			<div class="say-hy">
				<p>Hi {{ ucfirst(Auth::user()->fname) }} {{ ucfirst(Auth::user()->lname) }}! <span> 
					<img src="{{asset('assets/dashboard/htmlv/assets/images/gretha-wilson.svg')}}" > </span> 
				</p>
			</div>
			<div class="today-affermation">
			</div>
		</div>
	</div>  
</section>
<section class="main-dashboard gp-dash-v1">
	<div class="cust-container-md">
		<div class="dash-section">
			<div class="dashboard-title">
				<div class="title">
					<p>Statistics</p>
				</div>
			</div>
        </div>
		@include('group-organizations.dashboard-list')
	</div>	
</section>
<section class="main-dashboard">
	<div class="cust-container-md">
		<div class="dash-section">
			
			<div class="dashboard-title">
				<div class="title">
					<p>Quick Link</p>
				</div>
			</div>	
			<div class="dash-row">
@php 

	$dashboard_tabs[] = ['name'=>'Members Stats','link'=>'group-organizations/ref-member-list','ico_name'=>'members.svg'];
	$dashboard_tabs[] = ['name'=>'Comission Policies','link'=>'group-organizations/my-current-plan','ico_name'=>'members.svg'];
	$dashboard_tabs[] = ['name'=>'Promo Code List','link'=>'group-organizations/coupon-list','ico_name'=>'promocode.svg'];
	//$dashboard_tabs[] = ['name'=>'Order List','link'=>'group-organizations/order-history','ico_name'=>'comission.svg'];
	$dashboard_tabs[] = ['name'=>'Commission History','link'=>'group-organizations/order-history','ico_name'=>'comission.svg'];
	$dashboard_tabs[] = ['name'=>'Withdrawal List','link'=>'group-organizations/withdrawal-list','ico_name'=>'withdrawal-list.svg'];
	$dashboard_tabs[] = ['name'=>'Withdrawal Request','link'=>'group-organizations/withdrawal-add','ico_name'=>'withdrawal-now.svg'];
	
@endphp			
			
				@foreach ($dashboard_tabs as $tab)
					<a href="{{ url($tab['link']) }}">
						<div class="dash-menu-card">
							<div class="icon">
								<img 
									src="{{ asset('assets/group-organizations/mobile/' . $tab['ico_name']) }}" 
									alt="{{ $tab['name'] }}"
								>
							</div>
							<div class="title">
								<p>{{ $tab['name'] }}</p>
							</div>
						</div>
					</a>
				@endforeach
				
			</div>	
		</div>	
	</div>	
</section>
@include('mobile.includes.foooter-tab')		
@endsection

<div class="dash-left">
		@include('user.dashboard.dashboard-aff-consultation-section')

		@if(org_can('medical_care'))
		@include('user.dashboard.dashboard-medical-care-slider')
		@endif

		@if(org_can('medical_care') || org_can('counseling'))
		@include('user.dashboard.dashboard-medical-care')
		@endif
		<?php /*
		@include('user.dashboard.dashboard-mental-health')
		*/ ?>

		@if(org_can('pets'))
		@include('user.dashboard.dashboard-pet-health')
		@endif

		@if(org_can('medical_care'))
		@include('user.dashboard.dashboard-prescriptions-ab')
		@endif

</div>

@if(org_current())
	{{-- Organisation members never see services their admin switched off,
	     so locked cards are hidden rather than greyed out. Scoped to org
	     members only - every other user keeps the existing behaviour. --}}
	<style>
		.dash-menu-card.service-disabled,
		.dash-menu-card.service-disabled + .dash-menu-card-tooltip,
		.service-disabled { display: none !important; }
	</style>
@endif
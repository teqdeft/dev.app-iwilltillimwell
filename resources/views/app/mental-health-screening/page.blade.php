@extends('layouts.v1.dashboard')
@section('content')
<div class="content-wrapper">
	
	<div class="row">
			<div class="col-12 col-xl-6 mb-4 mb-xl-0">
				<div class="patient-details">
					<div class="media">
						<div class="title-heading-icon-box-cus"><i class="fas fa-user-md"></i></div>
						<div class="media-body"><h3 class="font-weight-bold">Mental Health Screening</h3></div>
					</div>	
				</div>	
			</div>	
	</div>
	
	<div class="row">
		<section class="specilist-list-web">
		  <div class="cust-container-md">
			 <div class="title">
				<p>What type of screening would you like to start with.</p>
			 </div>

			 <div class="list-row">

				<div class="list-card">
				   <a href="{{ url('anxiety/my-organization/give-consent') }}">
					  <div class="icon">
						 <img src="{{ asset('msgspec/AnxietyScreenings-v1.svg') }}" alt="image">
					  </div>
					  <div class="detail">
						 <p>Anxiety Screenings</p>
					  </div>
				   </a>
				</div>

				<div class="list-card">
				   <a href="{{ url('depression/my-organization/give-consent') }}">
					  <div class="icon">
						 <img src="{{ asset('msgspec/DepressionScreenings-v1.svg') }}" alt="image">
					  </div>
					  <div class="detail">
						 <p>Depression Screenings</p>
					  </div>
				   </a>
				</div>

				<div class="list-card">
				   <a href="{{ url('abuse/my-organization/give-consent') }}">
					  <div class="icon">
						 <img src="{{ asset('msgspec/AlcoholSubstanceAbuse-v1.svg') }}" alt="image">
					  </div>
					  <div class="detail">
						 <p>Alcohol &amp; Substance Abuse</p>
					  </div>
				   </a>
				</div>

			 </div>

		  </div>
	   </section>
	</div>	
	
</div>	
@endsection
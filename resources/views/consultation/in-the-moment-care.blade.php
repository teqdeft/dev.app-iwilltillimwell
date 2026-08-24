@extends('layouts.dashboard')
@section('content')
<div class="main-panel separate_mental_health">
<div class="content-wrapper">

   <div class="row">
		<div class="media">
			<div class="col-md-12 grid-margin media-body">
			
				<h3 class="moment_title">In-the-Moment Care & Crisis Management</h3>
								
			 </div>
   </div>
   
   <div class="row">
      <div class="col-12 grid-margin stretch-card">				
	  @include('consultation.in-the-moment-care-form')
       
      </div>
   </div>
</div>
</div>
</div>
</div>

@include('mobile.consultation.talk-therapist-popup')
@endsection

@extends('layouts.group-organizations')
@section('content')

	<div class="content-wrapper">
		
		<div class="row">
            <div class="col-md-12 grid-margin">
                <div class="row">
                    <div class="col-12 col-xl-12 mb-12 mb-xl-0">
                        <div class="patient-details ">
                            <div class="media pc-media-box">
                                <div class="title-heading-icon-box-cus">
                                    <i class="far fa-user"></i>
                                </div>  
                                <div class="media-body theme-title-box">
                                     <h3 class="font-weight-bold">Withdrawal Request</h3>
                                </div>   
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
		
		@include('group-organizations.withdrawal.withdrawal-form')
		
		
	</div>
	
@endsection
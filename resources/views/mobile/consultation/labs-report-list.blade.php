@extends('mobile.layouts.dashboard')
@section('content')

    <section class="msg-special-header">
        <div class="cust-container-md">
            <div class="rec-row">

                <div class="back">
                    <a href="{{ route('mobile-dashboard')}}" class="back-btn">
                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M12.875 16.0417L7.33334 10.5L12.875 4.95834" stroke="#222A3D"
                                stroke-width="1.58333" stroke-linecap="round" stroke-linejoin="round"></path>
                        </svg>
                    </a>
                </div>

                <div class="top-title">
                    <h2 class="title">Lab Report</h2>
                </div>

            </div>
        </div>
    </section>
	<section class="specilist-list inbox">
		<div class="cust-container-lg">
			<?php 
				echo "<pre>";
				print_r($data);
				echo "</pre>";
			?>
			@if(isset($data) && isset($data['success']) && !empty($data['labOrders']))
				
			
			@else
			<div class="inbox-row inbox-div-response" style=" min-height: 50vh;max-height: max-content;">
				<div class="midical-form">
					<div class="form">
						<div class="form-row">
							<div class="col-100">
								<div class=""><p class="textAlign">Sorry No Report</p></div> 
							</div>
						</div>    
					</div>    
				</div>
			</div>
			@endif
		</div>
	</section>
	
    

  	
@include('mobile.includes.foooter-tab')      
@endsection
@extends('layouts.dashboard')
@section('content')
@if(!LoginUserBToBVerification())
 <div class="main-panel">
    <div class="content-wrapper">
		<div class="row">
        <div class="col-12 grid-margin stretch-card btob-admin">
                <div class="card card-body">
                 {{ LoginUserBToBVerificationMSG() }}
             </div>
        </div>
    </div>            
    @else
<div class="main-panel main-panel-for-modal-page">
    <div class="content-wrapper">
        <div class="row">
           <div class="col-md-12 grid-margin stretch-card">
                 <div class="card">
                    <div class="card-body">
                         <div class="row">  
                                <div class="col-md-12">
                                    <div class="history-screening-head">
									
									<div class="graph-detail-v12">
										<div class="screen-main-title">
											<h3>My Screening History ({{ $screenHead }})</h3>
										</div>
										<div class="graphData">
										 
											@php

												$startDate = now()->startOfDay()->format('Y-m-d');
												$endDate   = now()->endOfDay()->format('Y-m-d');
												$daily   = url('my-screening-history-graph') . "?startDate={$startDate}&endDate={$endDate}&action=daily";
												$startDate = \Carbon\Carbon::today()->subDays(7)->format('Y-m-d');
												$weekly  = url('my-screening-history-graph') . "?startDate={$startDate}&endDate={$endDate}&action=weekly";
												
												$startDate = \Carbon\Carbon::today()->subDays(30)->format('Y-m-d');
												$monthly = url('my-screening-history-graph') . "?startDate={$startDate}&endDate={$endDate}&action=monthly";
												
												
												$startDate = \Carbon\Carbon::now()->startOfYear()->format('Y-m-d');  
												$endDate   = \Carbon\Carbon::now()->endOfMonth()->format('Y-m-d');
												
												
												$yearly  = url('my-screening-history-graph') . "?startDate={$startDate}&endDate={$endDate}&action=yearly";
												$action = request('action', 'daily');
												
											@endphp


												
											<div class="graph-nave all-consultations-box">
												<ul class="nav nav-tabs" role="tablist" id="myTab">
													<li class="nav-item ">
														<a class="nav-link  {{ $action == 'daily' ? 'active' : '' }}" href="{{$daily}}">Daily</a>
													</li>
													<li class="nav-item ">
														<a class="nav-link {{ $action == 'weekly' ? 'active' : '' }}" href="{{$weekly}}">Weekly</a>
													</li>
													<li class="nav-item ">
														<a class="nav-link {{ $action == 'monthly' ? 'active' : '' }}" href="{{$monthly}}">Monthly</a>
													</li>
													<li class="nav-item ">
														<a class="nav-link {{ $action == 'yearly' ? 'active' : '' }}" href="{{$yearly}}">Yearly</a>
													</li>
												</ul>
											</div>	
												
                                         </div>
									</div>
										
										
										
										<div class="graph-main-vs1">
										
										<div class="moodheaderGraph">

											<div class="colorTypeContainer v1-main">
												<ul class="defineColor mb-0">
												
													<li>
														<span class="lineColorName">0 To 4</span>
														<span class="lineTitleName">Minimal Anxiety</span>
													</li>
													<li>
														<span class="lineColorName">5 To 9</span>
														<span class="lineTitleName">Mild Anxiety</span>
													</li>
													<li>
														<span class="lineColorName">10 To 14</span>
														<span class="lineTitleName">Moderate Anxiety</span>
													</li>
													<li>
														<span class="lineColorName">15 and 21</span>
														<span class="lineTitleName">Severe Anxiety</span>
													</li>
													
												</ul>

											</div>           
										</div>

										
									</div>
										
                                    </div>
                                </div>

                                <div class="col-md-12">

                                    
									<?php /*	
                                    <div class="graphHeader mb-4" style="clear: both; text-align: center;"></div>           
                                    */ ?>
									<div id="wrapper" class="chart_wrapper">
									
									   
										@include('graph.chart.anxiety-severity-chart')
										@include('graph.chart.anxiety-depression-chart')
										@include('graph.chart.alcohol-substance-chart')
										
										  
									</div>                    
                             </div>   
							 <?php /*
                             @include('graph.my-screening-history-table')
                             */ ?>
                             

                    </div>
                 </div>  
           </div> 
</div>
</div>
</div>		   

        

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js" defer></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
<script>
$(function() {
  $('input[name="daterange"]').daterangepicker({
    opens: 'left'
  }, function(start, end, label) {
    let searchStr = start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD');
    window.location.href = `${SITE_URL}/my-screening-history-graph?startDate=${start.format('YYYY-MM-DD')}&endDate=${end.format('YYYY-MM-DD')}`;
  });
});
</script>
<style>
.moodheaderGraph {
    text-align: center;
    margin-bottom: 15px;
    float: left;
    width: 100%;
}
ul.defineColor {
    list-style-type: none;
    display: flex;
    justify-content: center;
    padding: 0;
}
ul.defineColor li {
    display: flex;
    margin: 9px;
}
ul.defineColor li span.lineColorName {
    width: 35px;
    height: 15px;
    margin-top: 8px;
    margin-right: 7px;
}
</style>
@include('graph.my-screening-history-script')
@endif
@endsection

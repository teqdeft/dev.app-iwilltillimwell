@extends("mobile.layouts.dashboard")
@section('content')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
<section class="record-header">
        <div class="cust-container-md">
            <div class="rec-row">
                <div class="back">
                    <a href="{{ route('mobile-dashboard')}}" class="back-btn">
                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M12.875 16.0417L7.33334 10.5L12.875 4.95834" stroke="#222A3D"
                                stroke-width="1.58333" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </a>
                </div>
                <div class="top-title">
                    <h2 class="title">Screening History.</p>
                </div>
                <div class="screen-number d-n">

                    
                </div>
            </div>
        </div>
</section>
@if(LoginUserBToBVerification())
<section class="cbd-therapy-main">
    <div class="cust-container-md">
    
        <div class="mood-history-his-v2 v1">

			<div class="main-title">
				<p>My Screening History (  {{ $screenHead }} )</p>
			</div>

            <div class="app-chart-filter">
				
				
				
				<div class="graphData">
				 
					@php

						$startDate = now()->startOfDay()->format('Y-m-d');
						$endDate   = now()->endOfDay()->format('Y-m-d');
						$daily   = url('my-screening-history-graph') . "?startDate={$startDate}&endDate={$endDate}&action=daily";
						$startDate = \Carbon\Carbon::today()->subDays(7)->format('Y-m-d');
						$weekly  = url('my-screening-history-graph') . "?startDate={$startDate}&endDate={$endDate}&action=weekly";
						
						$startDate = \Carbon\Carbon::today()->subDays(30)->format('Y-m-d');
						$monthly = url('my-screening-history-graph') . "?startDate={$startDate}&endDate={$endDate}&action=monthly";
						
						$startDate = \Carbon\Carbon::today()->subYear()->format('Y-m-d');
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
				
				
				<div class="moodheaderGraph">

					<div class="colorTypeContainer  v1-main">
						<ul class="defineColor mb-0">
							<li>
								<span class="lineTitleName">Minimal Anxiety</span>
								<span class="lineColorName">0 To 4</span>
								
							</li>
							<li>
								<span class="lineTitleName">Mild Anxiety</span>
								<span class="lineColorName">5 To 9</span>
								
							</li>
							<li>
								<span class="lineTitleName">Moderate Anxiety</span>
								<span class="lineColorName">10 To 14</span>
								
							</li>
							<li>
								<span class="lineTitleName">Severe Anxiety</span>
								<span class="lineColorName">15 To 21</span>
								
							</li>
						</ul>
					</div>  
					
				</div>
				
            </div>
			
        </div>
		
        <div class="mood-history-his-v2">
        
			@include('graph.chart.mobile.anxiety-severity-chart')
			@include('graph.chart.mobile.anxiety-depression-chart')
			@include('graph.chart.mobile.alcohol-substance-chart')
         

           
			<?php /*
            <div class="main-title"><p>My Screening History</p></div>
            @if ($screening)
                @if ($dataByTitle)
                    @foreach ($headSetByName as $hedValue => $hedKey )
                        @if( isset($dataByTitle[$hedKey]['quizResult'] ))
                            <div class="history-card">
                                <div class="car-tit"><p>{{ $hedKey }}</p></div>
                                <div class="his-card">
                                                                <table class="table table-bordered table-striped  user-table-box user_subs_table"
                                                                    id="quizTest" border="1">
                                                                    @if(isset($dataByTitle[$hedKey]) && !empty($dataByTitle[$hedKey]) )
                                                                    <tr>
                                                                        <th>Date</th>
                                                                        @foreach ($dataByTitle[$hedKey]['date'] as $key => $value )
                                                                        
                                                                        <th>{{ $value }}</th>
                                                                        
                                                                        @endforeach
                                                                    </tr>
                                                                    @foreach ($dataByTitle[$hedKey]['quizResult'] as $numberKey =>
                                                                    $numberValue
                                                                    )
                                                                    @foreach ($numberValue as $key => $value )
                                                                    <tr>
                                                                        <td>{{ $key }}</td>
                                                                        @foreach ($dataByTitle[$hedKey]['date'] as $dateKey => $dateValue )
                                                                        @if ( isset($value[$dateValue]['x']) )
                                                                        <td>X</td>
                                                                        @else
                                                                        <td></td>
                                                                        @endif
                                                                        @endforeach
                                                                    </tr>
                                                                    @endforeach
                                                                    @endforeach
                                                                    @endif
                                                                </table>
                                </div>
                           </div>
                        @endif
                    @endforeach                             
                @endif        
            @else
            <div class="emptyContainer"><h4>No record in {{ $screenHead  }} </h4></div>
            @endif
			*/ ?>
			
        </div> 
        
    </div> 
</section>
    
<style>
        .highcharts-figure,
        .highcharts-data-table table {
            min-width: 360px;
            max-width: 800px;
            margin: 1em auto;
        }

        .highcharts-data-table table {
            font-family: Verdana, sans-serif;
            border-collapse: collapse;
            border: 1px solid #ebebeb;
            margin: 10px auto;
            text-align: center;
            width: 100%;
            max-width: 500px;
        }

        .highcharts-data-table caption {
            padding: 1em 0;
            font-size: 1.2em;
            color: #555;
        }

        .highcharts-data-table th {
            font-weight: 600;
            padding: 0.5em;
        }

        .highcharts-data-table td,
        .highcharts-data-table th,
        .highcharts-data-table caption {
            padding: 0.5em;
        }

        .highcharts-data-table thead tr,
        .highcharts-data-table tr:nth-child(even) {
            background: #f8f8f8;
        }

        .highcharts-data-table tr:hover {
            background: #f1f7ff;
        }

        .highcharts-description {
            margin: 0.3rem 10px;
        }

        .mood-history-his-v2 .history-card .his-card {
            position: relative;
            width: 100%;
            overflow: auto;
            padding-bottom: 10px;
        }

        .mood-history-his-v2 .history-card .table {
            position: relative;
            width: 100%;
            border-collapse: collapse;
        }

        .mood-history-his-v2 .history-card .table td {
            width: max-content !important;
            word-wrap: normal;
            max-width: 189px;
            overflow: hidden;
            white-space: normal;
            text-overflow: ellipsis;
            border: 0.5px solid gray;
            text-align: center;
            margin: 0 !important;
            padding: 2px 6px;
        }

        .mood-history-his-v2 .history-card .table th {
            padding: 5px 15px;
        }

        ul.defineColor {
            list-style-type: none;
            display: grid;
            justify-content: center;
            padding: 0;
            grid-template-columns: 48% 48%;
            gap: 4%;
            padding-bottom: 18px;
        }

        ul.defineColor li {
            display: flex;
            justify-content: flex-start;
            align-items: center;
        }

        ul.defineColor li span.lineColorName {
            width: 35px;
            height: 15px;
            margin-top: 0px;
            margin-right: 7px;
            display: flex;
        }
        
        .cbd-therapy-main .com-chart {
            margin-bottom: 30px;
            border-bottom: 1px solid #8080808a;
            padding-bottom: 16px;
        }
        g.highcharts-exporting-group {
    display: none;
}


.daterangepicker .drp-calendar {
    display: none;
    max-width: 98% !important;
}

.daterangepicker {
    position: absolute;
    color: inherit;
    background-color: #fff;
    border-radius: 4px;
    border: 1px solid #ddd;
    width: 92%;
    max-width: none;
    padding: 0;
    margin-top: 7px;
    top: 100px;
    left: 20px;
    z-index: 3001;
    display: none;
    font-family: arial;
    font-size: 15px;
    line-height: 1em;
}

.daterangepicker .drp-buttons .btn {
    margin-left: 15px;
    font-size: 12px;
    font-weight: 400;
    padding: 6px 12px;
    background: #8462a8;
    border: 0;
    color: #fff;
    border-radius: 5px;
}

.daterangepicker .drp-buttons {
    clear: both;
    text-align: right;
    padding: 8px;
    border-top: 1px solid #ddd;
    display: none;
    line-height: 12px;
    vertical-align: middle;
    margin-bottom: 10px;
    padding-top: 17px;
}
</style>

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

@include('graph.my-screening-history-script')
@include('mobile.includes.foooter-tab')
@else 
    
<section class="written-journal">
    <div class="cust-container-md">
    {{ LoginUserBToBVerificationMSG() }}
    </div>
</section>

@endif
@endsection

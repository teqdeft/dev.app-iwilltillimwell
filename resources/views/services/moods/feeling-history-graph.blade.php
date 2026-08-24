@extends('layouts.dashboard')
@section('content')

<?php
$defualtStartDate = date('m/d/Y', strtotime("-3 months", strtotime(date('m/d/Y'))));
$defualtEndDate = date('m/d/Y');
$defDateStr =  $defualtStartDate . ' - ' . $defualtEndDate;
$graph_data['start_date'] = date('Y-m-d',strtotime($defualtStartDate));
$graph_data['end_date'] = date('Y-m-d',strtotime($defualtEndDate));
if(isset($_GET['startDate']) && isset($_GET['endDate'])) {
    $defDateStr = date('m/d/Y', strtotime($_GET['startDate'])).' - '.date('m/d/Y', strtotime($_GET['endDate']));		
	$graph_data['start_date'] = $_GET['startDate'];	
	$graph_data['end_date'] = $_GET['endDate'];
}

?>
<div class="main-panel">
    <div class="content-wrapper">

    @if(!LoginUserBToBVerification())
    <div class="row">
        <div class="col-12 grid-margin stretch-card btob-admin">
                <div class="card card-body">
                 {{ LoginUserBToBVerificationMSG() }}
             </div>
        </div>
    </div>        
    @else 

    <div class="row">
        <div class="col-12 grid-margin stretch-card">
            <div class="card card-body">
                <div class="card--white full-height log-view">
                <div class="cust-head-center-wrap">
                        <span class="top-heading">Mood History ( {{ $screenHead }} )</span> 
                        <div class="col-md-12">
                              <div class="graphButtonContent">
                                    <div class="graphData">
                                    <input type="text" class="form-control selectedMonthGraph" data-type="mood" name="daterange" value="<?= $defDateStr ?>" />
                                    </div>
                              </div>  
                        </div>  
                    <div class="row">






<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js" defer></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

<script>
$(document).ready(function () {
  if ($('input[name="daterange"]').length) {
    $('input[name="daterange"]').daterangepicker({
      opens: 'left',
	  maxDate: moment() 
    }, function (start, end, label) {
        let searchStr = start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD');
        window.location.href = `${SITE_URL}/my-mood-feeling-history-graph?startDate=${start.format('YYYY-MM-DD')}&endDate=${end.format('YYYY-MM-DD')}`;
    });
  } else {
    console.error("Date range input not found!");
  }
});
</script>


    <section class="cbd-therapy-main">
        <div class="cust-container-md">
            <div class="mood-history-his-v2 v1">

                <div class="charts-v1">					
				<?php					
					/*
                    <div style="vertical-align: middle;" id="chartdiv"></div>					
				*/ 
				?>															
				@include('user.dashboard.personal-analytics-graph')
                </div>

            </div>
        </div>
    </section>


    
    
   

    <style>
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
#chartdiv {
    width: 100%;
    height: 500px;
}
#chartdiv .amcharts-chart-div svg {
    background: #8462a8a8;
    overflow: hidden;
} 

#chartdiv .amcharts-chart-div a {
    display: none !important;
}

#chartdiv .amcharts-export-menu {
    display: none !important;
}
</style>






                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>
    @endif
    </div>
    @include('graph.my-mood-history-script')
@endsection

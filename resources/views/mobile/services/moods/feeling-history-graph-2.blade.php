@extends("mobile.layouts.dashboard")
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
                    <h2 class="title">Feeling History</h2>
                </div>
            </div>
        </div>
</section>
@if(LoginUserBToBVerification())
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

<script>
$(document).ready(function () {
  if ($('input[name="daterange"]').length) {
    $('input[name="daterange"]').daterangepicker({
        opens: 'left',
	    maxDate: moment().endOf('month'),
		autoUpdateInput: false, 
		showNonCurrentMonths: false,
		alwaysShowCalendars: true,
    }, function (start, end, label) {
        let searchStr = start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD');
        window.location.href = `${SITE_URL}/my-mood-feeling-history-graph?startDate=${start.format('YYYY-MM-DD')}&endDate=${end.format('YYYY-MM-DD')}`;
    });
  } else {
    console.error("Date range input not found!");
  }
  console.log("---------------");
  console.log(moment().format('YYYY-MM-DD'));
});
</script>
    


    <section class="cbd-therapy-main">
        <div class="cust-container-md">
            <div class="mood-history-his-v2 v1">

                <div class="main-title">
                    <p>Mood History ( {{ $screenHead }} )</p>
                </div>

                <?php
                $defualtStartDate = date('m/d/Y', strtotime("-12 months", strtotime(date('m/d/Y'))));
                $defualtEndDate = date('m/d/Y');
                $defDateStr =  $defualtStartDate . ' - ' . $defualtEndDate;
				
				$graph_data['start_date'] = date('Y-m-d',strtotime($defualtStartDate));
				$graph_data['end_date'] = date('Y-m-d',strtotime($defualtEndDate));
				
				
                if(isset($_GET['startDate']) && isset($_GET['endDate']))
                    {
                       $defDateStr = date('m/d/Y', strtotime($_GET['startDate'])).' - '.date('m/d/Y', strtotime($_GET['endDate']));
					   
					    $graph_data['start_date'] = $_GET['startDate'];
						$graph_data['end_date'] = $_GET['endDate'];
	
                    }
					
					
                 ?>
                <div class="form-row date">
                    <div class="col-100 form-group">
                        <input type="text" class="form-control selectedMonthGraph" data-type="mood" name="daterange" value="<?= $defDateStr ?>" />
                    </div>
                </div>
                
                <div class="charts-v1">
					<?php /*
                    <div style="vertical-align: middle;" id="chartdiv"></div>
					*/ ?>
					@include('user.dashboard.personal-analytics-graph')
                </div>

            </div>
        </div>
    </section>

    <style>

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

@include('graph.my-mood-history-script')
@else 
<section class="written-journal">
    <div class="cust-container-md">
        {{ LoginUserBToBVerificationMSG() }}
    </div>
</section>               
@endif
@include('mobile.includes.foooter-tab')
@endsection
<?php /*
@extends("mobile.layouts.dashboard")
@section("content")

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
                    <h2 class="title">Mood Feeling History.</p>
                </div>
                <div class="screen-number d-n">

                </div>
            </div>
        </div>
</section>

@include('mobile.includes.foooter-tab')
@endsection
*/ ?>

@extends("mobile.layouts.dashboard")
@section('content')

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
                    <h2 class="title">Feeling History.</p>
                </div>
                <div class="screen-number d-n">

                </div>
            </div>
        </div>
</section>

<section class="consul-my-v1 whats-mood">
<div class="main-panel main-panel-for-modal-page panel-mood-histry">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12 grid-margin">
                <div class="row">
                    <div class="col-md-12 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body moods-log-table">
                                <div class="card--white full-height log-view">
                                    <div class="cust-head-center-wrap">

                                        <button type="button"
                                            class="back-arrow btn btn-primary returnUserMood"></button>
                                        <span class="top-heading">Mood History ( {{ $screenHead }} )</span>

                                        <div class="col-md-12">
                                            <div class="graphButtonContent">
                                                <div class="graphData">
                                                    <?php
                                                        $defualtStartDate = date('m/d/Y', strtotime("-3 months", strtotime(date('m/d/Y'))));
                                                        $defualtEndDate = date('m/d/Y');
                                                        $defDateStr =  $defualtStartDate . ' - ' . $defualtEndDate;
                                                        if(isset($_GET['startDate']) && isset($_GET['endDate']))
                                                        {
                                                            $defDateStr = date('m/d/Y', strtotime($_GET['startDate'])).' - '.date('m/d/Y', strtotime($_GET['endDate']));
                                                        }
                                                    
                                                    ?>
                                                      <input type="text" class="form-control selectedMonthGraph" data-type="mood" name="daterange" value="<?= $defDateStr ?>" />
                                                    
                                                </div>
                                            </div>
                                        </div>


                                        <div>
                                            <div class="moodheaderGraph">
                                                <div class="colorTypeContainer" >
                                                    <ul class="defineColor">
                                                        <li><span class="lineColorName" style="background:#cce5ff;" ></span><span class="lineTitleName" >SURPRISED</span></li>
                                                        <li><span class="lineColorName" style="background:#e2e3e5;" ></span><span class="lineTitleName" >DISGUSTED</span></li>
                                                        <li><span class="lineColorName" style="background:#fff3cd;" ></span><span class="lineTitleName" >SAD</span></li>
                                                        <li><span class="lineColorName" style="background:#d4edda;" ></span><span class="lineTitleName" >HAPPY</span></li>
                                                        <li><span class="lineColorName" style="background:#f8d7da;" ></span><span class="lineTitleName" >ANGRY</span></li>
                                                        <li><span class="lineColorName" style="background:#d1ecf1;" ></span><span class="lineTitleName" >FEARFUL</span></li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <canvas id="myChart"></canvas>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
 </section>   
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js" defer></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
        <script>
$(function() {
  $('input[name="daterange"]').daterangepicker({
    opens: 'left'
  }, function(start, end, label) {
      let searchStr = start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD');
      window.location.href = `${SITE_URL}/mood-history?startDate=${start.format('YYYY-MM-DD')}&endDate=${end.format('YYYY-MM-DD')}`;
  });
});
</script>
    <script>
    var chatData = JSON.parse(`<?= $chartData ?>`);
    const labels = chatData.label;

    const data = {
        labels: labels,
        datasets: [{
            label: '',
            backgroundColor: chatData.backgroundColor,
            borderColor: chatData.borderColor,
            data: chatData.data,
        }]
    };

    const config = {
        type: 'bar',
        data: data,
        options: {
            plugins: {
                legend: {
                    display: false,
                }
            },
            legend: {
               display: true,
                position: 'top',
                fontColor: 'white',
                fontSize: 20,
                labels: {
                    fontColor: 'white',
                    fontSize: 20
                }
            },
            responsive: true,
            scales: {
                y: {
                    ticks: {
                        beginAtZero: true,
                        stepSize: 1,
                        callback: function(value, index, values) {
                            switch (value) {
                                case 0:
                                    return '';
                                case 1:
                                    return `SURPRISED`;
                                case 2:
                                    return 'DISGUSTED';
                                case 3:
                                    return 'SAD';
                                case 4:
                                    return 'HAPPY';
                                case 5:
                                    return 'ANGRY';
                                case 6:
                                    return 'FEARFUL';
                            }
                        }
                    },
                    gridLines: {
                        color: 'white'
                    },
                    min: 0,
                    max: 6
                }
            }
        }
    };

    const myChart = new Chart(
        document.getElementById('myChart'),
        config
    );
    </script>
    @endsection

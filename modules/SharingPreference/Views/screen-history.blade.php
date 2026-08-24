@include('Layout::user.part.head')
<div class="main-panel main-panel-for-modal-page w100">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            @if ($screening)
                            <div class="col-md-12">
                                <div class="moodheaderGraph">
                                    <h3> {{ $name }} Screening History (
                                        {{ $screenHead }}
                                        )
                                    </h3>
                                    <div class="colorTypeContainer">
                                        <ul class="defineColor mb-0">
                                            <li><span class="lineColorName" style="background:#d4edda;"></span><span
                                                    class="lineTitleName">Minimal Anxiety</span></li>
                                            <li><span class="lineColorName" style="background:#fff3cd;"></span><span
                                                    class="lineTitleName">Mild Anxiety</span></li>
                                            <li><span class="lineColorName" style="background:#d1ecf1;"></span><span
                                                    class="lineTitleName">Moderate Anxiety</span></li>
                                            <li><span class="lineColorName" style="background:#f8d7da;"></span><span
                                                    class="lineTitleName">Severe Anxiety</span></li>
                                        </ul>

                                    </div>
                                </div>
                                <div class="graphHeader mb-4" style="clear: both; text-align: center;">
                                    <h4>GAD - 7 Anxiety Severity</h4>
                                </div>
                                <div id="wrapper" class="chart_wrapper">
                                    <canvas id="myChart" height="100px" style="margin-bottom:3em;"></canvas>
                                    <div class="colorTypeContainer">
                                        <ul class="defineColor">
                                            <li><span class="lineColorName" style="background:#d4edda;"></span><span
                                                    class="lineTitleName">Mild Depression</span></li>
                                            <li><span class="lineColorName" style="background:#fff3cd;"></span><span
                                                    class="lineTitleName">Moderate Depression</span></li>
                                            <li><span class="lineColorName" style="background:#d1ecf1;"></span><span
                                                    class="lineTitleName">Moderately Severe Depression</span></li>
                                            <li><span class="lineColorName" style="background:#f8d7da;"></span><span
                                                    class="lineTitleName">Severe Depression</span></li>
                                        </ul>
                                    </div>
                                    <div class="graphHeader mb-4" style="clear: both; text-align: center;">
                                        <h4>PHQ - 9 Depression Severity</h4>
                                    </div>
                                    <canvas id="myChart2" height="100px" style="margin-bottom:3em;"></canvas>
                                    <div class="colorTypeContainer">
                                        <ul class="defineColor">
                                            <li><span class="lineColorName" style="background:#d4edda;"></span><span
                                                    class="lineTitleName">No Risk and Possible Dependence</span></li>
                                            <li><span class="lineColorName" style="background:#f8d7da;"></span><span
                                                    class="lineTitleName">Risk and Possible Dependence</span></li>
                                        </ul>
                                    </div>
                                    <div class="graphHeader mb-4" style="clear: both; text-align: center;">
                                        <h4>Alcohol and Substance Abuse</h4>
                                    </div>
                                    <canvas id="myChart3" height="100px" style="margin-bottom:3em;"></canvas>
                                </div>
                            </div>
                            <div class="col-md-12">
                                @if ($dataByTitle)
                                <div class="quizTableGraph">
                                    <h3> My Screening History </h3>
                                    @foreach ($headSetByName as $hedValue => $hedKey )
                                    @if( isset($dataByTitle[$hedKey]['quizResult'] ))
                                    <div class="headerContainer">
                                        <h4>{{ $hedKey }}</h4>
                                        <div class="table-responsive">
                                            <table class="table table-bordered  user-table-box user_subs_table"
                                                id="quizTest">
                                                @if(isset($dataByTitle[$hedKey]) && !empty($dataByTitle[$hedKey]) )
                                                <tr>
                                                    <td>Date</td>
                                                    @foreach ($dataByTitle[$hedKey]['date'] as $key => $value )
                                                    <td>{{ $value }}</td>
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
                                </div>
                                @endif
                            </div>
                            @else
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="emptyContainer">
                                    <h4>No record in {{ $screenHead  }} </h4>
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <!-- <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script> -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.5.1/chart.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/chartjs-adapter-date-fns/dist/chartjs-adapter-date-fns.bundle.min.js">
        </script>
        <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.0.0"></script>
        <script>
        var screenAllData = JSON.parse('<?= $screeningData; ?>');
        var color = JSON.parse('<?= $color; ?>');
        var anxietyDataX = [];
        var anxietyDataY = [];
        var depressionDataX = [];
        var depressionDataY = [];
        var abuseDataX = [];
        var abuseDataY = [];
        $.each(screenAllData, function(key, value) {
            $.each(value, function(i, v) {
                if (key == 'anxiety') {
                    anxietyDataX.push(i);
                    anxietyDataY.push(v);
                } else if (key == 'depression') {
                    depressionDataX.push(i);
                    depressionDataY.push(v);
                } else if (key == 'abuse') {
                    abuseDataX.push(i);
                    abuseDataY.push(v);
                }
            })
        })

        const genericOptions = {
            fill: false,
            interaction: {
                intersect: false
            }
        };

        const plugin = {
            id: 'myChart',
            beforeDraw: (chart, agrs, pluginOptions) => {
                const {
                    ctx,
                    chartArea: {
                        top,
                        bottom,
                        left,
                        right,
                        width
                    },
                    scales: {
                        x,
                        y
                    }
                } = chart;

                addColor(5, 1, '#f8d7da');
                addColor(4, 1, '#f8d7da');
                addColor(3, 1, '#d1ecf1');
                addColor(2, 1, '#fff3cd');
                addColor(1, 2, '#d4edda');

                function addColor(start, end, color) {
                    ctx.fillStyle = color;
                    ctx.fillRect(left, y.getPixelForValue(start), width, y.getPixelForValue(end));
                }
            }
        };




        var ctx = document.getElementById("myChart");
        var myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: anxietyDataX,
                datasets: [{
                    label: '',
                    data: anxietyDataY,
                    backgroundColor: '#f8d7da',
                    borderColor: '#fff',
                    fill: false,
                    pointRadius: 6,
                    pointBackgroundColor: ['#004085'],
                    pointBorderColor: ['#fefefe'],
                }]
            },
            plugins: [plugin],
            options: {
                plugins: {
                    legend: {
                        position: 'top',
                        display: false
                    },
                },
                elements: {
                    point: {
                        radius: 0
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
                            stepSize: 0.5,
                            callback: function(value, index, values) {
                                if (value == 0.5) {
                                    return "Minimal Anxiety 0 - 4";
                                } else if (value == 1.5) {
                                    return "Mild Anxiety 5 - 9";
                                } else if (value == 2.5) {
                                    return "Moderate Anxiety 10 - 14";
                                } else if (value == 3.5) {
                                    return "Severe Anxiety Greater than 15";
                                }
                            }
                        },
                        gridLines: {
                            display: false,
                        },
                        min: 0,
                        max: 4
                    }
                }
            }
        });

        var ctx = document.getElementById("myChart2");
        var myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: depressionDataX,
                datasets: [{
                    label: '',
                    data: depressionDataY,
                    backgroundColor: '#f8d7da',
                    borderColor: '#fff',
                    fill: false,
                    pointRadius: 6,
                    pointBackgroundColor: ['#004085'],
                    pointBorderColor: ['#fefefe'],
                }]
            },
            plugins: [plugin],
            options: {
                plugins: {
                    legend: {
                        position: 'top',
                        display: false
                    },
                },
                elements: {
                    point: {
                        radius: 0
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
                            stepSize: 0.5,
                            callback: function(value, index, values) {
                                if (value == 0.5) {
                                    return "Mild Depression 0 - 5";
                                } else if (value == 1.5) {
                                    return "Moderate Depression 6 - 10";
                                } else if (value == 2.5) {
                                    return "Moderately Severe Depression 11 - 15";
                                } else if (value == 3.5) {
                                    return "Severe Depression Greater than 16";
                                }
                            }
                        },
                        gridLines: {
                            display: false,
                        },
                        min: 0,
                        max: 4
                    }
                }
            }
        });

        const pluginUncope = {
            id: 'myChart3',
            beforeDraw: (chart, agrs, pluginOptions) => {
                const {
                    ctx,
                    chartArea: {
                        top,
                        bottom,
                        left,
                        right,
                        width
                    },
                    scales: {
                        x,
                        y
                    }
                } = chart;
                addColor(2, 1, '#f8d7da');
                addColor(1, 1, '#d4edda');

                function addColor(start, end, color) {
                    ctx.fillStyle = color;
                    ctx.fillRect(left, y.getPixelForValue(start), width, y.getPixelForValue(end));
                }
            }
        };

        var ctx = document.getElementById("myChart3");
        var myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: abuseDataX,
                datasets: [{
                    label: '',
                    data: abuseDataY,
                    backgroundColor: '#f8d7da',
                    borderColor: '#fff',
                    fill: false,
                    pointRadius: 6,
                    pointBackgroundColor: ['#004085'],
                    pointBorderColor: ['#fefefe'],
                }]
            },
            plugins: [pluginUncope],
            options: {
                plugins: {
                    legend: {
                        position: 'top',
                        display: false
                    },
                },
                elements: {
                    point: {
                        radius: 0
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
                            stepSize: 0.5,
                            callback: function(value, index, values) {
                                if (value == 0.5) {
                                    return "No Risk or Possible Dependence";
                                } else if (value == 1.5) {
                                    return "Risk or Possible Dependence";
                                }
                            }
                        },
                        gridLines: {
                            display: false,
                        },
                        min: 0,
                        max: 2
                    }
                }
            }
        });
        </script>

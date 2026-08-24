@include('Layout::user.part.head')
<div class="main-panel main-panel-for-modal-page w100">
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
                                        <span class="top-heading">{{ $name }} Mood History</span>

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
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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

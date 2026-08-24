@extends('services.dashboard')
@section('content')
<div class="main-panel main-panel-for-modal-page">
    <div class="content-wrapper">
      
        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="col-md-12">
                            <div class="graphButtonContent">
                                <div class="graphButton">
                                    <a href="{{ url('affiliate/dashboard') }}" class="btn btn-primary @if ( !isset($_GET['graph']) )
                                        active
                                    @endif ">Month</a>
                                    <a href="{{ url('affiliate/dashboard?graph=Week') }}" class="btn btn-primary @if ( isset($_GET['graph']) && $_GET['graph'] == 'Week' )
                                        active
                                    @endif ">Week</a>
                                    <a href="{{ url('affiliate/dashboard?graph=Year') }}" class="btn btn-primary @if ( isset($_GET['graph']) && $_GET['graph'] == 'Year' )
                                        active
                                    @endif">Year</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="moodheaderGraph">
                                <h3> My Emotional History ( 
                                        @php $type = ''; @endphp
                                        @if (isset($_GET['graph']))
                                            @php $type = $_GET['graph']; @endphp
                                        @endif
                                        {{ graphDataBydate($type) }}
                                    ) </h3>
                            </div>
                            <div id="chart">
                            </div>
                            <div id="chartEmo">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<script src="https://unpkg.com/frappe-charts@1.6.1/dist/frappe-charts.min.umd.js"></script>

     <script>
         @if ( isset($physically) && !empty($physically) )
            var frappeData = JSON.parse('<?= $physically ?>');

            var dataSetsGraph = [];
        
            const data = {
                labels: frappeData.labals,
                datasets: frappeData.graphData
            }
            
            new frappe.Chart("#chart", {
                title: "Mood Monitor",
                data: data,
                type: 'axis-mixed', // or 'bar', 'line', 'scatter', 'pie', 'percentage'
                height: 600,
                colors: frappeData.graphColor,
                lineOptions: {
                    dotSize: 8 // default: 4
                },
            })

             
         @endif

         @if ( isset($emotionally) && !empty($emotionally) )
            var frappeDataemotionally = JSON.parse('<?= $emotionally ?>');
            const dataemotionally = {
                labels: frappeDataemotionally.labals,
                datasets: frappeDataemotionally.graphData
            }
            new frappe.Chart("#chartEmo", {
                title: "Emotionally Feel",
                data: dataemotionally,
                type: 'axis-mixed', // or 'bar', 'line', 'scatter', 'pie', 'percentage'
                height: 600,
                colors: frappeDataemotionally.graphColor,
                lineOptions: {
                    dotSize: 8 // default: 4
                },
            })

             
         @endif
            
    </script>





@endsection
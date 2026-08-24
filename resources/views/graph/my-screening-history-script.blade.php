<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>
<?php 
$action = request('action', 'daily');
$data = json_decode($screeningData);
$anxiety = [];
$depression = [];
$abuse = [];
if($data){
    $anxiety =$data->anxiety ?? [];
    $depression  = $data->depression ?? [];
    $abuse = $data->alcohol ?? [];
}



$anxiety_categories = $categories = json_encode(array_keys((array)$anxiety));
$depression_categories = json_encode(array_keys((array)$depression));
$alcohol_categories = json_encode(array_keys((array)$abuse));

function getColor($value) {
    if ($value >= 3.5) {
        return "#d4edda"; // Light green
    } elseif ($value >= 2.5) {
        return "#fff3cd"; // Light yellow
    } elseif ($value >= 1.5) {
        return "#d1ecf1"; // Light blue
    } else {
        return "#f8d7da"; // Light red
    }
}


$anxiety_categories = getExtraDaysForGraph($anxiety_categories);
$depression_categories = getExtraDaysForGraph($depression_categories);
$alcohol_categories = getExtraDaysForGraph($alcohol_categories);

if($action=="yearly") {
	
	$graph_data = getSeperateDataOfGraphYearly($action,$userAnswer);
	/* echo "<pre>";
	print_r($graph_data);
	echo "</pre>"; */
	$anxiety = $graph_data['anxiety'];
	$depression = $graph_data['depression'];
	$abuse = $graph_data['alcohol'];
	$anxiety_categories = json_encode(array_keys((array)$anxiety));
	$depression_categories = json_encode(array_keys((array)$depression));
	$alcohol_categories = json_encode(array_keys((array)$abuse));
	
	/* $data_anxiety = DataCovertAccordingYearly($anxiety);
	$anxiety_categories = json_encode($data_anxiety['keys']);
	$anxiety = $data_anxiety['values'];
	
	$data_depression = DataCovertAccordingYearly($depression);
	$depression_categories = json_encode($data_depression['keys']);
	$depression = $data_depression['values'];
	
	$data_alcohol = DataCovertAccordingYearly($abuse);
	$alcohol_categories = json_encode($data_alcohol['keys']);
	$abuse = $data_alcohol['values']; */
	
} else if($action=="monthly") {
	
	$graph_data = getSeperateDataOfGraphMonthly($action,$userAnswer);
	$anxiety = $graph_data['anxiety'];
	$depression = $graph_data['depression'];
	$abuse = $graph_data['alcohol'];
	$anxiety_categories = json_encode(array_keys((array)$anxiety));
	$depression_categories = json_encode(array_keys((array)$depression));
	$alcohol_categories = json_encode(array_keys((array)$abuse));
	
} else if($action=="weekly") {
	

	$graph_data = getSeperateDataOfGraph($action,$userAnswer);
	
	$anxiety = $graph_data['anxiety'];
	$depression = $graph_data['depression'];
	$abuse = $graph_data['alcohol'];
	
	
	
	$anxiety_categories = json_encode(array_keys((array)$anxiety));
	$depression_categories = json_encode(array_keys((array)$depression));
	$alcohol_categories = json_encode(array_keys((array)$abuse));
	
} else if($action=="daily") {
	
	
	
	$graph_data = getHourlyGraphAvg($action,$userAnswer);
	
	 
	
	$anxiety = $graph_data['anxiety'];
	$depression = $graph_data['depression'];
	$abuse = $graph_data['alcohol'];
	
	
	$anxiety_categories = json_encode(array_keys((array)$anxiety));
	$depression_categories = json_encode(array_keys((array)$depression));
	$alcohol_categories = json_encode(array_keys((array)$abuse));
	
}
?>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.2.0"></script>
<script>
function anxietyGraph(graph_id, months_category, anxietyData) {
  const anxietyvalues = Object.values(anxietyData);
  const pointColors = anxietyvalues.map(() => "#f8d7da");

  const UtilsHeader = {
    months({ count }) {
      return months_category.slice(0, count);
    },
    CHART_COLORS: {
      theme_color: '#5e2e8a',
      blue: 'rgb(54, 162, 235)',
      green: '#008000'
    },
    transparentize(color, opacity) {
      const alpha = opacity !== undefined ? 1 - opacity : 1;
      return color.replace('rgb', 'rgba').replace(')', `, ${alpha})`);
    }
  };

  const labels = UtilsHeader.months({ count: 25 });

  const data = {
    labels: labels,
    datasets: [
      {
        label: '',
        data: anxietyvalues,
        borderColor: UtilsHeader.CHART_COLORS.green,
        backgroundColor: UtilsHeader.transparentize(UtilsHeader.CHART_COLORS.green, 0.5),
        borderRadius: { topLeft: 5, topRight: 5, bottomLeft: 0, bottomRight: 0 },
        order: 1
      },
      {
        label: '',
        data: anxietyvalues,
        borderColor: UtilsHeader.CHART_COLORS.theme_color,
        backgroundColor: UtilsHeader.transparentize(UtilsHeader.CHART_COLORS.theme_color, 0.5),
        pointBackgroundColor: pointColors,
        pointBorderColor: pointColors,
        pointRadius: 3,
        pointHoverRadius: 3,
        type: 'line',
        order: 0
      }
    ]
  };

  const config = {
    type: 'bar',
    data: data,
    options: {
      responsive: true,
      plugins: {
        legend: { display: false },
        title: { display: false },
        datalabels: {
          display: function(context) {
            return context.datasetIndex === 0;
          },
          color: '#000',
          font: { weight: 'bold', size: 10 },
          anchor: 'end',
          align: 'end',
          formatter: value => value === 0 ? '' : value,
          clip: false,
          clamp: true
        }
      },
      scales: {
        y: {
          ticks: {
            callback: function(value) {
              const allowed = [0, 5, 10, 15, 20, 25, 30];
              return allowed.includes(value) ? value : '';
            }
          },
          min: 0,
          max: 30
        }
      }
    },
    plugins: [ChartDataLabels]
  };

  const ctx = document.getElementById(graph_id).getContext('2d');
  new Chart(ctx, config);
} 

let anxietyData = @json($anxiety);
let depressionData = @json($depression);
let abuseData = @json($abuse);
anxietyGraph('myChartAnxietySeverity',<?php echo $anxiety_categories?>,anxietyData);
anxietyGraph('myChartDepressionSeverity',<?php echo $depression_categories?>,depressionData);
anxietyGraph('myChartalcoholSeverity',<?php echo $alcohol_categories?>,abuseData);
</script>
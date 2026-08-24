<div class="dash-card pers-chart-details">
	<div class="card-title"><p>Personal Analytics</p></div>
	<div class="content">
		<div class="adult-info">
		
		

    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/variable-pie.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>
    <script src="https://code.highcharts.com/themes/adaptive.js"></script>

   
<?php 
$chart_info = getGraphChartData($graph_data);

/* echo "<pre>";
print_r($chart_info);
echo "</pre>"; */

?>


	<?php 
	if (count(array_unique($chart_info)) === 1 && reset($chart_info) == 0) {
		?>
		<p>No data available</p>
		<?php 
	} else {
	?>
    <figure class="highcharts-figure">
        <div id="container"></div>
    </figure>

    <script>
        
        Highcharts.chart('container', {
            chart: {
                type: 'variablepie'
            },
            title: {
                text: ''
            },
            tooltip: {
				enabled: false, 
				headerFormat: '<span style="font-size: 13px;color:white;">{point.name}</span><br/>',
				
				pointFormat: '<span style="color:white;background-color:red;"><b>{point.percentage:.1f}%</b></span>'
			},
			exporting: {
				enabled: false
			},
			plotOptions: {
				variablepie: {
					dataLabels: {
						enabled: true,
						format: '{point.name}<br/>{point.percentage:.1f} %',
						style: {
							fontSize: '12px'
						}
					}
				}
			},
            series: [{
                minPointSize: 10,
                innerSize: '20%',
                zMin: 0,
                name: 'countries',
                borderRadius: 5,
                data: [
						{
							name: 'Happy',
							y: <?php echo $chart_info['happy']?>,
							z: 100
						}, 
						{
							name: 'Sad',
							y: <?php echo $chart_info['sad']?>,
							z: 100
						}, 
						{
							name: 'Disgust',
							y: <?php echo $chart_info['disgust']?>,
							z: 100
						}, 
						{
							name: 'Anger',
							y: <?php echo $chart_info['anger']?>,
							z: 100
						}, 
						{
							name: 'Fear',
							y: <?php echo $chart_info['fear']?>,
							z: 100
						}, 
						{
							name: 'Surprise',
							y: <?php echo $chart_info['surprise']?>,
							z: 100
						}
				
				],
                colors: [
                    '#FFA500',
                    '#4A4E69',
                    '#556B2F',
                    '#8B0000',
                    '#1C1F26',
                    '#FF69B4'
                ]
            }]
        });
    </script>
	
	<?php } ?>

		
		
		
		
		
		</div>
	</div>
</div>
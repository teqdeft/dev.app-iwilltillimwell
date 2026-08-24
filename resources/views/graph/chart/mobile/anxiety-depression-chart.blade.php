<?php /*
<ul class="defineColor mb-0">
    <li><span class="lineColorName" style="background:#d4edda;"></span><span class="lineTitleName">Mild Depression</span></li>
    <li><span class="lineColorName" style="background:#fff3cd;"></span><span class="lineTitleName">Moderate Depression</span></li>
    <li><span class="lineColorName" style="background:#d1ecf1;"></span><span class="lineTitleName">Moderately Severe Depression</span></li>
    <li><span class="lineColorName" style="background:#f8d7da;"></span><span class="lineTitleName">Severe Depression</span></li>
</ul>
<div id="container2" class="com-chart"></div>
@include('graph.my-screening-history-table', ['chart_name' => '1'])
*/ ?>
<div id="container2" class="v1-main">
	<div class="chart-title">
		<h3>Depression</h3>
	</div>
	<div class="chart-main app-chart-filter depression">
	
		<div class="colorTypeContainer  v1-main">
						<ul class="defineColor mb-0">
							<li>
								<span class="lineTitleName">None Minimal</span>
								<span class="lineColorName">0 To 4</span>
								
							</li>
							<li>
								<span class="lineTitleName">Mild</span>
								<span class="lineColorName">5 To 9</span>
								
							</li>
							<li>
								<span class="lineTitleName">Moderate</span>
								<span class="lineColorName">10 To 14</span>
								
							</li>
							<li>
								<span class="lineTitleName">Moderately</span>
								<span class="lineColorName">15 and 19</span>
								
							</li>
							<li>
								<span class="lineTitleName">Severe</span>
								<span class="lineColorName">20 and 27</span>
								
							</li>
						</ul>
					</div> 
					
		<canvas id="myChartDepressionSeverity" width="600" height="400"></canvas>
	</div>
</div>
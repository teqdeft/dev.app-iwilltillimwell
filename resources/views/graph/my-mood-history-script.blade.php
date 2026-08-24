<script src="https://www.amcharts.com/lib/3/amcharts.js"></script>
<script src="https://www.amcharts.com/lib/3/serial.js"></script>
<script src="https://www.amcharts.com/lib/3/plugins/export/export.min.js"></script>
<link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css" media="all" />
<script src="https://www.amcharts.com/lib/3/themes/dark.js"></script>
<script>
        var chart = AmCharts.makeChart("chartdiv", {
            "theme": "dark",
            "type": "serial",
            "startDuration": 2,
            "dataProvider": [{
                "country": "SURPRISED",
                "visits": <?php echo getGraphPercentage($data,'surprised')?>,
                "color": "#00e1b8"
            }, {
                "country": "DISGUSTED",
                "visits": <?php echo getGraphPercentage($data,'disgusted')?>,
                "color": "#2fa70a"
            }, {
                "country": "SAD",
                "visits": <?php echo getGraphPercentage($data,'sad')?>,
                "color": "#2b3259"
            }, {
                "country": "HAPPY",
                "visits": <?php echo getGraphPercentage($data,'happy')?>,
                "color": "#ead005"
            }, {
                "country": "ANGRY",
                "visits": <?php echo getGraphPercentage($data,'angry')?>,
                "color": "#913030"
            }, 
            {
                "country": "FEARFUL",
                "visits": <?php echo getGraphPercentage($data,'fear')?>,
                "color": "#773da0"
            }
        
        ],

            "graphs": [{
                "balloonText": "[[category]]: <b>[[value]]</b>",
                "fillColorsField": "color",
                "fillAlphas": 1,
                "lineAlpha": 0.1,
                "type": "column",
                "valueField": "visits"
            }],
            "depth3D": 20,
            "angle": 30,
            "chartCursor": {
                "categoryBalloonEnabled": false,
                "cursorAlpha": 0,
                "zoomable": false
            },
            "categoryField": "country",
            "categoryAxis": {
                "gridPosition": "start",
                "labelRotation": 90
            },
            "export": {
                "enabled": true
            }

        });
</script>
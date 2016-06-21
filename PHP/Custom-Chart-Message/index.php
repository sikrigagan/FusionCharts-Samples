<!doctype html>

<?php
   include("fusioncharts/fusioncharts.php");
   ?>

<html>
   <head>
  	<title>FusionCharts | Configure Chart Message</title>
  	<!-- FusionCharts package JS files -->
  	<script src="http://static.fusioncharts.com/code/latest/fusioncharts.js"></script>
  	<script src="http://static.fusioncharts.com/code/latest/fusioncharts.charts.js"></script>
   </head>
	 <body>
   
  	<?php
		// chart object
     	$columnChart = new FusionCharts("Column2D", "chart1" , "100%", "350", "chart-container", "json",
            '{
                "chart": {
                    "caption": "Monthly revenue for last year",
                    "subCaption": "Harry’s SuperMart",
                    "xAxisName": "Month",
                    "yAxisName": "Revenues (In USD)",
                    "numberPrefix": "$",
                    "paletteColors": "#0075c2",
                    "bgColor": "#ffffff",
                    "borderAlpha": "20",
                    "canvasBorderAlpha": "0",
                    "usePlotGradientColor": "0",
                    "plotBorderAlpha": "10",
                    "placeValuesInside": "1",
                    "rotatevalues": "1",
                    "valueFontColor": "#ffffff",
                    "showXAxisLine": "1",
                    "xAxisLineColor": "#999999",
                    "divlineColor": "#999999",
                    "divLineIsDashed": "1",
                    "showAlternateHGridColor": "0",
                    "subcaptionFontSize": "14",
                    "subcaptionFontBold": "0"
                },
                "data": []
            }'
    );
  	?>
  	
  	<div id="chart-container"></div>
  	<script type="text/javascript">
  		FusionCharts.ready(function () {
  		
  		// using configure method to define custom chart message - dataEmptyMessage
  		FusionCharts.items['chart1'].configure({
  			dataEmptyMessage: "This is custom data empty message"
  		});
  		
  		// calling render method to render the chart
  		FusionCharts.items['chart1'].render();
  		
  		});
  	</script>
   </body>
</html>

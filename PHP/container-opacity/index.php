<!doctype html>

<?php
   include("fusioncharts/fusioncharts.php");
   ?>

<html>
   <head>
  	<title>FusionCharts | Configure Container Opacity</title>
  	<!-- FusionCharts package JS files -->
  	<script src="http://static.fusioncharts.com/code/latest/fusioncharts.js"></script>
  	<script src="http://static.fusioncharts.com/code/latest/fusioncharts.charts.js"></script>

  	<style>
  		body {
		    background-color: #F36E65;
  		    opacity: 1;
		}
  	</style>
   </head>
	 <body>
   
  	<?php
		// chart object
     	$columnChart = new FusionCharts("Column2D", "chart1" , "100%", "350", "chart-container", "xml", '<chart caption="Monthly revenue for last year" subcaption="Harry&#39;s SuperMart" xaxisname="Month" yaxisname="Revenues (In USD)" numberprefix="$" palettecolors="#0075c2" borderalpha="20" canvasborderalpha="0" useplotgradientcolor="0" plotborderalpha="10" placevaluesinside="1" rotatevalues="1" valuefontcolor="#ffffff" showxaxisline="1" xaxislinecolor="#999999" divlinecolor="#999999" divlineisdashed="1" showalternatehgridcolor="0" subcaptionfontbold="0" subcaptionfontsize="14" bgalpha="0" canvasbgalpha="0" ><set label="Jan" value="420000" /><set label="Feb" value="810000" /><set label="Mar" value="720000" /><set label="Apr" value="550000" /><set label="May" value="910000" /><set label="Jun" value="510000" /><set label="Jul" value="680000" /><set label="Aug" value="620000" /><set label="Sep" value="610000" /><set label="Oct" value="490000" /><set label="Nov" value="900000" /><set label="Dec" value="730000" /><trendlines><line startvalue="700000" color="#1aaf5d" valueonright="1" displayvalue="Monthly Target" /></trendlines></chart>');
  	?>
  	
  	<div id="chart-container"></div>
  	<script type="text/javascript">
  		FusionCharts.ready(function () {
  		
  		// using configure method to define container opacity - containerBackgroundOpacity
  		FusionCharts.items['chart1'].configure({
  			containerBackgroundOpacity: "0"
  		});
  		
  		// calling render method to render the chart
  		FusionCharts.items['chart1'].render();
  		
  		});
  	</script>
   </body>
</html>

<!doctype html>

<?php
   include("fusioncharts/fusioncharts.php");
?>

<html>
   <head>
  	<title>FusionCharts | Simple Chart with XML Data Format</title>
  	<meta charset="UTF-8">
  	<script src="http://static.fusioncharts.com/code/latest/fusioncharts.js"></script>
  	<script src="http://static.fusioncharts.com/code/latest/fusioncharts.charts.js"></script>
   </head>
   <body>
  	<?php
    	$columnChart = new FusionCharts("Column2D", "myFirstChart" , "100%", "350", "chart-1", "xml",
            '<chart caption="Monthly revenue for last year" subcaption="Harry’s SuperMart" xaxisname="Month" yaxisname="Revenues (In USD)" numberprefix="$" palettecolors="#0075c2" bgcolor="#ffffff" borderalpha="20" canvasborderalpha="0" useplotgradientcolor="0" plotborderalpha="10" placevaluesinside="1" rotatevalues="1" valuefontcolor="#ffffff" showxaxisline="1" xaxislinecolor="#999999" divlinecolor="#999999" divlineisdashed="1" showalternatehgridcolor="0" subcaptionfontsize="14" subcaptionfontbold="0" plotSpacePercent="30" ><set label="Jan" value="420000" /><set label="Feb" value="810000" /><set label="Mar" value="720000" /><set label="Apr" value="550000" /><set label="May" value="910000" /><set label="Jun" value="510000" /><set label="Jul" value="680000" /><set label="Aug" value="620000" /><set label="Sep" value="610000" /><set label="Oct" value="490000" /><set label="Nov" value="900000" /><set label="Dec" value="730000" /></chart>'
    );

     	$columnChart->render();
  	?>
  	<div id="chart-1"></div>
   </body>
</html>
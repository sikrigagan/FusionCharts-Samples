<!doctype html>

<?php
	// including FusionCharts PHP wrapper
	include("fusioncharts/fusioncharts.php");
	
	// establishing DB connection
	$host= "host=localhost";
	$port= "port=5432";
	
  // add values for below variables according to your system
  $dbname="dbname=";
	$dbuser="user=";
	$dbpwd="password=";

	// connection string (pg_connect() is native PHP method for Postgres)
  $dbconn=pg_connect("$host $port $dbname $dbuser $dbpwd");

	// validating DB connection
  if(!$dbconn) {
		exit("There was an error establishing database connection");
	}

?>

<html>
   <head>
      <title>PHP - FusionCharts | Single Series Charts with Postgres</title>
      <!-- including style and font css -->
      <link href='https://fonts.googleapis.com/css?family=Quicksand:400' rel='stylesheet' type='text/css'>
      <style>
      	* {
      		margin: 0;
      		padding: 0;
      		background-color: #50585F;
      	}
      </style>
      <!-- FusionCharts core package JS files -->
      <script src="http://static.fusioncharts.com/code/latest/fusioncharts.js"></script>
      <script src="http://static.fusioncharts.com/code/latest/fusioncharts.charts.js"></script>
      <script src="http://static.fusioncharts.com/code/latest/themes/fusioncharts.theme.fint.js"></script>
   </head>
   <body>

<?php
  
  pg_query($dbconn, "SELECT DISTINCT browser, shareval FROM browsershare; ");

  $result = pg_query($dbconn, "SELECT DISTINCT browser, shareval FROM browsershare; ") or exit("Error with quering database");

  if ($result) {
    
  // creating an associative array to store the chart attributes    	
	$arrData = array(
        "chart" => array(
          	"theme"=> "fint",
          	"caption"=> "Browser Market Share",
          	"subcaption"=> "February 2016",
          	"captionFontSize"=> "24",
          	"paletteColors"=> "#A2A5FC, #41CBE3, #EEDA54, #BB423F #,F35685",
            "baseFont"=> "Quicksand, sans-serif",
            "baseFontColor"=> "#FFFFFF",
            "baseFontSize"=> "14",
            "numberSuffix"=> "%",
            "showBorder"=> "0",
            "startingAngle"=> "0",
            "showPercentValues"=> "0",
            "showPercentInTooltip"=> "0",
            "decimals"=> "1",
      			"labelFontColor"=> "#FFFFFF",
      			"labelFontSize"=> "14",
      			"bgColor"=> "#50585F",
            "bgAlpha"=> "100",
            "doughnutRadius"=> "50",
            "enableSmartLabels"=> "1",
			      "smartLineColor"=> "#FCFDFD",
            "smartLineThickness"=> "1",
            
            // legend customization
            "showLegend"=> "1",
            "legendBorderAlpha"=> '0',
            "legendShadow"=> '0',
            "legendItemFontSize"=> '10',
            "legendItemFontColor"=> "#FFFFFF",
            
            // tool-tip customization
            "toolTipBgColor"=> "#000000",
            "toolTipBgAlpha"=> "70",
      			"toolTipPadding"=> "10",
      			"toolTipBorderColor"=> "#FFFFFF",
      			"toolTipBorderThickness"=> "1",
      			"toolTipBorderRadius"=> "2",
          )
    );

	$arrData["data"] = array();

	// iterating over each data and pushing it into $arrData array
	while($row = pg_fetch_array($result)) {
		array_push($arrData["data"], array(
			"label" => $row["browser"],
			"value" => $row["shareval"]
			)
		);
	}	

  $jsonEncodedData = json_encode($arrData);
	
	// creating FusionCharts instance
	$doughnutChart = new FusionCharts("doughnut2d", "browserShareChart" , '100%', 450, "doughnut-chart", "json", $jsonEncodedData);
    
  // FusionCharts render method
  $doughnutChart->render();
	
	// closing database connection      
  pg_close($dbconn);
           
  }

?>
 	<!-- creating chart container --> 	
 	<div id="doughnut-chart">A beautiful donut chart is on its way!</div>
   </body>
</html>
<!doctype html>

<?php 
include("fusioncharts/fusioncharts.php");

$host_db = "localhost";  // MySQl host
$user_db = "";  // MySQL username
$pass_db = "";  // MySQL password
$name_db = "";  // MySQL database name


$dbhandle = new mysqli($host_db, $user_db, $pass_db, $name_db);


if ($dbhandle->connect_error) {
  exit("There was an error with your connection: ".$dbhandle->connect_error);
}
?>

<html>
   <head>
      <title>PHP - FusionCharts | Single Series Charts with MySQL</title>
      <!-- including style and font css -->
      <link href='https://fonts.googleapis.com/css?family=Quicksand:400' rel='stylesheet' type='text/css'>
      <style>
      	* {
      		margin: 0;
      		padding: 0;
      		background-color: #50585F;
      	}
      </style>
      <!-- FusionCharts core package JavaScript files -->
      <script src="http://static.fusioncharts.com/code/latest/fusioncharts.js"></script>
      <script src="http://static.fusioncharts.com/code/latest/themes/fusioncharts.theme.fint.js"></script>
   </head>
   <body>

<?php
  

  $strQuery = "SELECT DISTINCT browser, shareval FROM browsershare_feb2016; ";

  $result = $dbhandle->query($strQuery) or exit("Error code ({$dbhandle->errno}): {$dbhandle->error}");

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
	while($row = mysqli_fetch_array($result)) {
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
  $dbhandle->close();
           
  }

 
?>
 	<!-- creating chart container --> 	
 	<div id="doughnut-chart">A beautiful donut chart is on its way!</div>
   </body>
</html>

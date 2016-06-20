<?php 

include("fusioncharts/fusioncharts.php");

$hostdb = "localhost";  // MySQl host
$userdb = "";  // MySQL username
$passdb = "";  // MySQL password
$namedb = "";  // MySQL database name


$dbhandle = new mysqli($hostdb, $userdb, $passdb, $namedb);


if ($dbhandle->connect_error) {
  exit("There was an error with your connection: ".$dbhandle->connect_error);
}
?>

<html>
   <head>
      <title>FusionCharts | Multi-Series Chart using PHP and MySQL</title>
        <script src="http://static.fusioncharts.com/code/latest/fusioncharts.js"></script>
        <script src="http://static.fusioncharts.com/code/latest/fusioncharts.charts.js"></script>
        <script src="http://static.fusioncharts.com/code/latest/themes/fusioncharts.theme.fint.js"></script>
   </head>
   <body>
   
<?php
  

  $strQuery = "SELECT DISTINCT month, year_a, year_b FROM visitor_data; ";

 	$result = $dbhandle->query($strQuery) or exit("Error code ({$dbhandle->errno}): {$dbhandle->error}");

  if ($result) {
        	
	$arrData = array(
        "chart" => array(
        	  "caption"=> "Comparison of Yearly Visitors",
            "xAxisname"=> "Month",
            "yAxisName"=> "Revenues (In USD)",
            "numberPrefix"=> "$",
            "plotFillAlpha"=> "80",
        	  "showValues"=> "1",
        	  "placeValuesInside"=> "1",
        	  "usePlotGradientColor"=> "0",
        	  "rotateValues"=> "1",
        	  "valueFontColor"=> "#FFFFFF",
        	  "showHoverEffect"=> "1",
            "rotateValues"=> "1",
            "showXAxisLine"=> "1",
            "xAxisLineThickness"=> "1",
            "xAxisLineColor"=> "#999999",
            "showAlternateHGridColor"=> "0",
            "legendBgAlpha"=> "0",
            "legendBorderAlpha"=> "0",
            "legendShadow"=> "0",
            "legendItemFontSize"=> "10",
            "legendItemFontColor"=> "#666666",
            "theme"=> "fint"
          	)
         	);

        	// creating array for categories object
        	
        	$categoryArray=array();
        	$dataseries1=array();
        	$dataseries2=array();
        	
          // pushing category array values
        	while($row = mysqli_fetch_array($result)) {				
				    array_push($categoryArray, array(
					  "label" => $row["month"]
					)
				);

				array_push($dataseries1, array(
					"value" => $row["year_a"]
					) 
				);
			
				array_push($dataseries2, array(
					"value" => $row["year_b"]
					)
				);
    
    	}
        	
    	$arrData["categories"]=array(array("category"=>$categoryArray));

			// creating dataset object
			$arrData["dataset"] = array(array("seriesName"=> "2014", "data"=>$dataseries1), array("seriesName"=> "2015", "data"=>$dataseries2));
		
			
				

      $jsonEncodedData = json_encode($arrData);
            			
			// chart object
      $msChart = new FusionCharts("mscolumn2d", "chart1" , "100%", "400", "chart-container", "json", $jsonEncodedData);
      
      $msChart->render();
			 
      // closing db connection
      $dbhandle->close();
           
   }
 
?>

<center>
 <div id="chart-container">Chart will render here!</div></center>
   </body>
</html>

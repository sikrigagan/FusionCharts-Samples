<?php

// including FusionCharts PHP Wrapper
include("fusioncharts/fusioncharts.php"); 

// add values for below variables according to your database
$hostdb   = "localhost"; // MySQl host
$userdb   = ""; // MySQL username
$passdb   = ""; // MySQL password
$namedb   = ""; // MySQL database name

// establish connection with DB
$dbhandle = new mysqli($hostdb, $userdb, $passdb, $namedb);

// validating DB connection
if ($dbhandle->connect_error) {
    exit("There was an error with your connection: " . $dbhandle->connect_error);
}

?>

<html>
   <head>
      <title>FusionCharts | Creating Multi-level Drill Down Charts with PHP and MySQL</title>
      <!-- including FusionCharts core package JS files -->
      <script src="http://static.fusioncharts.com/code/latest/fusioncharts.js"></script> 
      <script src="http://static.fusioncharts.com/code/latest/fusioncharts.charts.js"></script> 

      <!-- including theme file -->
      <script type="text/javascript" src="fusioncharts/js/elegant.js"></script>

      <!-- including font css from google fonts -->
      <link href='https://fonts.googleapis.com/css?family=Open+Sans:300' rel='stylesheet' type='text/css'> 
  </head>
  
<?php

// SQL query for parent chart
$strQuery = "SELECT Year, Sales FROM yearly_sales";

// execute query, or else return the error message
$result = $dbhandle->query($strQuery) or exit("Error code ({$dbhandle->errno}): {$dbhandle->error}");

// if the query returns a valid response, preparing the associative JSON array
if ($result) {

    //`$arrData` holds the chart options and data
    $arrData = array(
        "chart" => array(
            "caption" => "YoY Sales - KFC",
            "xAxisName"=> "Year",
            "yAxisName"=> "Sales",
            "paletteColors"=> "#008ee4",
            "yAxisMaxValue"=> "50000",
            "baseFont"=> "Open Sans",
            "theme" => "elegant"
            
        )
    );
    
    // create an array for parent chart
    $arrData["data"] = array();
    
    // Push data in array
    while ($row = mysqli_fetch_array($result)) {
        array_push($arrData["data"], array(
            "label" => $row["Year"],
            "value" => $row["Sales"],
			
			// create link for yearly drilldown as "2011"
            "link" => "newchart-json-" . $row["Year"]
        ));
        
    }
    
    // data for linked chart will start from here, SQL query from quarterly_sales table 
    $year = 2011;
    $strQuarterly = "SELECT  Quarter, Sales, Year FROM quarterly_sales WHERE 1";
    $resultQuarterly = $dbhandle->query($strQuarterly) or exit("Error code ({$dbhandle->errno}): {$dbhandle->error}");
    
    	// if the query returns a valid response, preparing the associative JSON array for child chart
        if ($resultQuarterly) {
        $arrData["linkeddata"] = array(); // `linkeddata` is responsible for feeding data and chart options to child charts.

		$arrDataMonth[2011]["linkeddata"] = array();
		$arrDataMonth[2012]["linkeddata"] = array();
		$arrDataMonth[2013]["linkeddata"] = array();
		$arrDataMonth[2014]["linkeddata"] = array();
		$arrDataMonth[2015]["linkeddata"] = array();
		$arrDataMonth[2016]["linkeddata"] = array();
        $i = 0;		
        if ($resultQuarterly) {
            while ($row = mysqli_fetch_array($resultQuarterly)) {
				
				// collect the year for which quarterly drilldown will be created
                $year = $row['Year'];
				
				// create the monthly drilldown data				
				$arrMonthHeader[$year][$row["Quarter"]] = array();
				$arrMonthData[$year][$row["Quarter"]] = array();
				
				// retrieve monthly data based on year and quarter
				$strMonthly = "SELECT  * FROM monthly_sales WHERE `Year` = '".$year."' and `Quarter` = '".$row["Quarter"]."' Order by FIELD( `Month`, 'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec' )"  ;						
				$resultMonthly = $dbhandle->query($strMonthly) or exit("Error code ({$dbhandle->errno}): {$dbhandle->error}");
				
				// loop through monthly results 
				 while ($rowMonthly = mysqli_fetch_assoc($resultMonthly)) {
						
						// create the monthly data for each quarter
						if($rowMonthly['Quarter'] == $row["Quarter"])
						{
							array_push($arrMonthData[$year][$row["Quarter"]], array(
									"label" => $rowMonthly["Month"],
									"value" => $rowMonthly["Sales"]
								));
						}
					}
					
					// create the data for monthly drilldown
					$arrMonthHeader[$year][$row["Quarter"]] = array(
										
										// create the unique link id's provided from quarterly data as "2011Q1"
										"id" => $year . $row['Quarter'],
										
										// create the data for the monthly charts for each quarter
										"linkedchart" => array(
											"chart" => array(
												
												// create dynamic caption based on the year and quarter
												"caption" => "MoM Sales - KFC for Quarter ".$row["Quarter"]." of $year",
												"xAxisName"=> "Month",
												"yAxisName"=> "Sales",
												"paletteColors"=> "#f5555C",
												"baseFont"=> "Open Sans",
												"theme" => "elegant"
											),
										"data" => $arrMonthData[$year][$row["Quarter"]]	
										)					
									);
					 
					 // finally push the data created into linkeddata node. Now our linked data for monthly drilldown for each quarter is ready
					 array_push($arrDataMonth[$year]["linkeddata"],$arrMonthHeader[$year][$row["Quarter"]]);
				
				// create the linkeddata for quarterly drilldown	
				// if the linnkeddata for a quarter of a year is ready and the year matches 
				 if (isset($arrData["linkeddata"][$i-1]) && $arrData["linkeddata"][$i-1]["id"] == $year) {					
					if($row["Quarter"] == 'Q4'){
						array_push($arrData["linkeddata"][$i-1]["linkedchart"]["data"], array(
							"label" => $row["Quarter"],
							"value" => $row["Sales"],
							
							// create the link for quarterly drilldown as "newchart-json-2011Q1"
							"link" => "newchart-json-" . $year . $row["Quarter"]
						));

					// if we've reached the last quarter, append the data created for monthly drilldown
					 $arrData["linkeddata"][$i-1]["linkedchart"] = array_merge($arrData["linkeddata"][$i-1]["linkedchart"],$arrDataMonth[$year]);
					}					
					else{
						array_push($arrData["linkeddata"][$i-1]["linkedchart"]["data"], array(
							"label" => $row["Quarter"],
							"value" => $row["Sales"],
							
							// create the link for quarterly drilldown as "newchart-json-2011Q1"
							"link" => "newchart-json-" . $year . $row["Quarter"]
						));
					
					}
                }
				
				// inititate the linked data for quarterly drilldown
				else {
					
                    array_push($arrData["linkeddata"], array(
                        "id" => "$year",
                        "linkedchart" => array(
                            "chart" => array(
								
								// create dynamic caption based on the year
                                "caption" => "QoQ Sales - KFC for $year",
                                "xAxisName"=> "Quarter",
                                "yAxisName"=> "Sales",
                                "paletteColors"=> "#6baa01",
                                "baseFont"=> "Open Sans",
                                "theme" => "elegant"
                            ),
                            "data" => array(
                                array(
                                    "label" => $row["Quarter"],
                                    "value" => $row["Sales"],
									
									// create the link for quarterly drilldown as "newchart-json-2011Q1"
									"link" => "newchart-json-" . $year . $row["Quarter"]
                                )
                            )
                        )
						
                    ));

                    $i++;
                }
			
				
				
				
            }
			 
        }
			
       
		$jsonEncodedData = json_encode($arrData);
        
        $columnChart = new FusionCharts("column2d", "drillDownChart" , "100%", "500", "linked-chart", "json", "$jsonEncodedData"); 
        
        $columnChart->render();    // Render Method
             
        $dbhandle->close(); // Closing DB connection
     
    }
}
?> 

     <body>
     <!-- DOM element for Chart -->
     <?php echo "<script type=\"text/javascript\" >
			   FusionCharts.ready(function () {
			FusionCharts('drillDownChart').configureLink({     
			overlayButton: {            
			message: 'Back',
			padding: '13',
			fontSize: '16',
			fontColor: '#F7F3E7',
			bold: '0',
			bgColor: '#22252A',           
			borderColor: '#D5555C' } });
			 });
			</script>" 
?>
         <div><center><div id="linked-chart">Awesome Chart on its way!</div></center></div>
         
      </body>
</html>
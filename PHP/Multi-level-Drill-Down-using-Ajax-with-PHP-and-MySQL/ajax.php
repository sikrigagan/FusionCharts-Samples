 <?php
//including FusionCharts PHP Wrapper
include("fusioncharts/fusioncharts.php"); 
$hostdb   = "localhost"; // MySQl host
$userdb   = ""; // MySQL username
$passdb   = ""; // MySQL password
$namedb   = ""; // MySQL database name

//Establish connection with the database
$dbhandle = new mysqli($hostdb, $userdb, $passdb, $namedb);

//Validating DB Connection
if ($dbhandle->connect_error) {
    exit("There was an error with your connection: " . $dbhandle->connect_error);
}


//SQL Query for the Parent chart.
$strQuery = "SELECT Year, Sales FROM yearly_sales";

//Execute the query, or else return the error message.
$result = $dbhandle->query($strQuery) or exit("Error code ({$dbhandle->errno}): {$dbhandle->error}");

//If the query returns a valid response, preparing the JSON array.
if ($result) {
    //`$arrData` holds the Chart Options and Data.
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
    
    //Create an array for Parent Chart.
    $arrData["data"] = array();
    
    // Push data in array.
    while ($row = mysqli_fetch_array($result)) {
        array_push($arrData["data"], array(
            "label" => $row["Year"],
            "value" => $row["Sales"],
			//Create link for yearly drilldown as "2011"
            "link" => "newchart-json-" . $row["Year"]
        ));
        
    }
    
    //Data for Linked Chart will start from here, SQL query from quarterly_sales table 
    $year = 2011;
    $strQuarterly = "SELECT  Quarter, Sales, Year FROM quarterly_sales WHERE 1";
    $resultQuarterly = $dbhandle->query($strQuarterly) or exit("Error code ({$dbhandle->errno}): {$dbhandle->error}");
    
    //If the query returns a valid response, preparing the JSON array.
        if ($resultQuarterly) {
        $arrData["linkeddata"] = array(); //"linkeddata" is responsible for feeding data and chart options to child charts.
		$arrDataMonth[2011]["linkeddata"] = array();
		$arrDataMonth[2012]["linkeddata"] = array();
		$arrDataMonth[2013]["linkeddata"] = array();
		$arrDataMonth[2014]["linkeddata"] = array();
		$arrDataMonth[2015]["linkeddata"] = array();
		$arrDataMonth[2016]["linkeddata"] = array();
        $i = 0;		
        if ($resultQuarterly) {
            while ($row = mysqli_fetch_array($resultQuarterly)) {
				//Collect the Year for which Quarterly drilldown will be created
                $year = $row['Year'];
				
				//Create the monthly drilldown data				
				$arrMonthHeader[$year][$row["Quarter"]] = array();
				$arrMonthData[$year][$row["Quarter"]] = array();
				
				// Retrieve monthly data based on year and quarter
				$strMonthly = "SELECT  * FROM monthly_sales WHERE `Year` = '".$year."' and `Quarter` = '".$row["Quarter"]."' Order by FIELD( `Month`, 'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec' )"  ;						
				$resultMonthly = $dbhandle->query($strMonthly) or exit("Error code ({$dbhandle->errno}): {$dbhandle->error}");
				
				//Loop through monthly results 
				 while ($rowMonthly = mysqli_fetch_assoc($resultMonthly)) {
						//Create the monthly data for each quarter
						if($rowMonthly['Quarter'] == $row["Quarter"])
						{
							array_push($arrMonthData[$year][$row["Quarter"]], array(
									"label" => $rowMonthly["Month"],
									"value" => $rowMonthly["Sales"]
								));
						}
					}
					//Create the data for monthly drilldown
					$arrMonthHeader[$year][$row["Quarter"]] = array(
										//Create the unique link id's provided from quarterly data as "2011Q1"
										"id" => $year . $row['Quarter'],
										//Create the data for the monthly charts for each quarter
										"linkedchart" => array(
											"chart" => array(
												//Create dynamic caption based on the year and quarter
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
					 //Finally push the data created into linkeddata node. Now our linked data for monthly drilldown for each quarter is ready
					 array_push($arrDataMonth[$year]["linkeddata"],$arrMonthHeader[$year][$row["Quarter"]]);
				
				//Create the linkeddata for quarterly drilldown	
				//If the linnkeddata for a quarter of a year is ready and the year matches 
				 if (isset($arrData["linkeddata"][$i-1]) && $arrData["linkeddata"][$i-1]["id"] == $year) {					
					if($row["Quarter"] == 'Q4'){
						array_push($arrData["linkeddata"][$i-1]["linkedchart"]["data"], array(
							"label" => $row["Quarter"],
							"value" => $row["Sales"],
							//Create the link for quarterly drilldown as "newchart-json-2011Q1"
							"link" => "newchart-json-" . $year . $row["Quarter"]
						));	
					//If we've reached the last quarter, append the data created for monthly drilldown
					 $arrData["linkeddata"][$i-1]["linkedchart"] = array_merge($arrData["linkeddata"][$i-1]["linkedchart"],$arrDataMonth[$year]);
					}					
					else{
						array_push($arrData["linkeddata"][$i-1]["linkedchart"]["data"], array(
							"label" => $row["Quarter"],
							"value" => $row["Sales"],
							//Create the link for quarterly drilldown as "newchart-json-2011Q1"
							"link" => "newchart-json-" . $year . $row["Quarter"]
						));
					
					}
                }
				//Inititate the linked data for quarterly drilldown
				else {
					
                    array_push($arrData["linkeddata"], array(
                        "id" => "$year",
                        "linkedchart" => array(
                            "chart" => array(
								//Create dynamic caption based on the year
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
									//Create the link for quarterly drilldown as "newchart-json-2011Q1"
									"link" => "newchart-json-" . $year . $row["Quarter"]
                                )
                            )
                        )
						
                    ));

                    $i++;
                }
			
				
				
				
            }
			 
        }
			
       // convert the array created into JSON
		$jsonEncodedData = json_encode($arrData);
        
        echo $jsonEncodedData;
     
    }
}
?> 

  

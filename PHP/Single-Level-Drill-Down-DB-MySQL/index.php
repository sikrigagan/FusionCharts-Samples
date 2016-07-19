 <?php

//including FusionCharts PHP Wrapper
include("fusioncharts/fusioncharts.php");


// add values for below variables according to your database 
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

?>

<html>
   <head>
      <title>FusionCharts | Creating Single-level Drill Down Charts with PHP and MySQL</title>
      <!-- including FusionCharts core package JS files -->
      <script src="http://static.fusioncharts.com/code/latest/fusioncharts.js"></script> 
      <script src="http://static.fusioncharts.com/code/latest/fusioncharts.charts.js"></script> 

      <!-- including theme file -->
      <script type="text/javascript" src="js/elegant.js"></script>

      <!-- including font css from google fonts -->
      <link href='https://fonts.googleapis.com/css?family=Open+Sans:300' rel='stylesheet' type='text/css'>
      
  </head>
  
<?php

// SQL query for parent chart
$strQuery = "SELECT Year, Sales FROM yearly_sales";

// execute the query, or else return the error message.
$result = $dbhandle->query($strQuery) or exit("Error code ({$dbhandle->errno}): {$dbhandle->error}");

// if the query returns a valid response, preparing the associative JSON array.
if ($result) {

    // `$arrData` holds chart options and data.
    $arrData = array(
        "chart" => array(
            "caption" => "YoY Sales - KFC",
            "xAxisName"=> "Year",
            "yAxisName"=> "Sales",
            "paletteColors"=> "#1FD6D1",
            "yAxisMaxValue"=> "50000",
            "baseFont"=> "Open Sans",
            "theme" => "elegant"
        )
    );
    
    // create an array for parent chart.
    $arrData["data"] = array();
    
    // push data in array.
    while ($row = mysqli_fetch_array($result)) {
        array_push($arrData["data"], array(
            "label" => $row["Year"],
            "value" => $row["Sales"],
            "link" => "newchart-json-" . $row["Year"]
        ));
    }
    
    // data for linked chart will start from here, SQL query from quarterly_sales table 
    $year = 2011;
    $strQuarterly = "SELECT  Quarter, Sales, Year FROM quarterly_sales WHERE 1";
    $resultQuarterly = $dbhandle->query($strQuarterly) or exit("Error code ({$dbhandle->errno}): {$dbhandle->error}");
    
        // if the query returns a valid response, preparing the associative JSON array for child chart.
        if ($resultQuarterly) {
        $arrData["linkeddata"] = array(); // `linkeddata` is responsible for feeding data and chart options to child charts.

        $i = 0;
        if ($resultQuarterly) {
            while ($row = mysqli_fetch_array($resultQuarterly)) {
                $year = $row['Year'];
                if (isset($arrData["linkeddata"][$i-1]) && $arrData["linkeddata"][$i-1]["id"] == $year) {
                    array_push($arrData["linkeddata"][$i-1]["linkedchart"]["data"], array(
                        "label" => $row["Quarter"],
                        "value" => $row["Sales"]
                    ));
                } else {
                    array_push($arrData["linkeddata"], array(
                        "id" => "$year",
                        "linkedchart" => array(
                            "chart" => array(
                                "caption" => "QoQ Sales - KFC for $year",
                                "xAxisName"=> "Quarter",
                                "yAxisName"=> "Sales",
                                "paletteColors"=> "#D5555C",
                                "baseFont"=> "Open Sans",
                                "theme" => "elegant"
                            ),
                            "data" => array(
                                array(
                                    "label" => $row["Quarter"],
                                    "value" => $row["Sales"]
                                )
                            )
                        )
                    ));

                    $i++;
                }
            }
        }
        
            
        $jsonEncodedData = json_encode($arrData, JSON_PRETTY_PRINT);
        
        $columnChart = new FusionCharts("column2d", "drillDownChart" , "100%", "500", "linked-chart", "json", "$jsonEncodedData"); 
        
        $columnChart->render();    // Render Method
             
        $dbhandle->close(); // closing DB Connection
     
    }
}
?> 

     <body>

     
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
			borderColor: '#D5555C'         }     });
			 });
			</script>" 
    ?>
     
     <!-- DOM element for Chart -->    
     <center><div id="linked-chart">Awesome Chart on its way!</div></center>
         
     </body>
</html>
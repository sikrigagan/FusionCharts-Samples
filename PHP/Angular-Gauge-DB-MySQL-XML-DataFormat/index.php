<!DOCTYPE HTML>
<?php
    // Include the `fusioncharts.php` file that contains functions to embed the charts.
    include("fusioncharts/fusioncharts.php");

    //Connecting to the database.
    $conn_error = 'Could not connect.';

    $mysql_host = 'localhost'; // MySQl host
    $mysql_user = ''; // MySQL username
    $mysql_pass = ''; // MySQL password
    $mysql_db   = ''; // MySQL database name

    $con = mysqli_connect($mysql_host,$mysql_user,$mysql_pass,$mysql_db);
        if (!$con)
            {
                echo $conn_error;
            
            }
?>
<html>

    <head>
        <title>FusionCharts | Creating Angular Gauuge with PHP and MySQL using XML Data</title>

        <!-- including FusionCharts core package JS files -->
        <script src="http://static.fusioncharts.com/code/latest/fusioncharts.js"></script>
        <script src="http://static.fusioncharts.com/code/latest/fusioncharts.widgets.js"></script>
        <script src="http://static.fusioncharts.com/code/latest/themes/fusioncharts.theme.fint.js"></script>
       
    </head>
    <body>
        <?php
            
          $arrData = array(
            
                "caption" => "Top 5 Stores by Sales",
                "subcaption" => "Last month",
                "yaxisname" => "Sales (In USD)",
                "numberprefix" => "$",
                "palettecolors" => "#0075c2",
                "bgcolor" => "#ffffff",
                "showborder" => "0",
                "showcanvasborder" => "0",
                "useplotgradientcolor" => "0",
                "plotborderalpha" => "10",
                "placevaluesinside" => "1",
                "valuefontcolor" => "#ffffff",
                "showaxislines" => "1",
                "axislinealpha" => "25",
                "divlinealpha" => "10",
                "aligncaptionwithcanvas" => "0",
                "showalternatevgridcolor" => "0",
                "captionfontsize" => "14",
                "subcaptionfontsize" => "14",
                "subcaptionfontbold" => "0",
                "tooltipcolor" => "#ffffff",
                "tooltipborderthickness" => "0",
                "tooltipbgcolor" => "#000000",
                "tooltipbgalpha" => "80",
                "tooltipborderradius" => "2",
                "tooltippadding" => "5"
            
        );

            // creating XML elements
            $xml = new SimpleXMLElement('<xml/>');

            $chart      = $xml->addChild('chart');
            $colorrange = $chart->addChild('colorrange');
            $dials      = $chart->addChild('dials');

            foreach ($arrData as $key => $value) {
           
                $chart->addAttribute($key,$value);

            }

            // fetching data from database
            $query = "SELECT * FROM `angular_data`";
            $query_run = mysqli_query($con,$query);
            while ($query_row = mysqli_fetch_assoc($query_run)) {         
                $minvalue = $query_row['minvalue'];
                $maxvalue = $query_row['maxvalue'];
                $code     = $query_row['code'];
                $value    = $query_row['value'];
                    
                $color = $colorrange->addChild('color');     
                $color->addAttribute('minvalue',"$minvalue");
                $color->addAttribute('maxvalue',"$maxvalue");
                $color->addAttribute('code',"$code");

                $dial = $dials->addChild('dial');
                $dial->addAttribute('value',"$value");
            }

            $xml_data = $xml->asXML();
           
            // minifying the xml code
            $xml_data = preg_replace("/\r\n|\r|\n|\<[\?\/]{0,1}xml[^>]*>/",'',$xml_data);

            // creaing chart objecy
            $angulargauge = new FusionCharts("angulargauge", "myFirstChart" , 600, 300, "chart-1", "xml",$xml_data);

            // calling render method to render the chart
            $angulargauge->render();
        ?>
    <div id="chart-1">Fusion Charts will render here</div>
   </body>
</html>
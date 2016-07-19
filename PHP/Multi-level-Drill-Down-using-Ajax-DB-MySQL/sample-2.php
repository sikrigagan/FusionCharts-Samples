<!doctype html>
<html>
<head>
<title>FusionCharts | Multi-level Drilldown using Ajax with PHP and MySQL</title>
<!-- including FusionCharts JS files -->
<script type="text/javascript" src="http://static.fusioncharts.com/code/latest/fusioncharts.js"></script>
<script type="text/javascript" src="http://static.fusioncharts.com/code/latest/fusioncharts.charts.js"></script>
<script type="text/javascript" src="fusioncharts/js/elegant.js"></script>

<link href='https://fonts.googleapis.com/css?family=Open+Sans:300' rel='stylesheet' type='text/css'>

<script type="text/javascript">

//Create FuionCharts object and render on runtime
function render() {
    var xmlhttp = new XMLHttpRequest();
    var data;
    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            data = xmlhttp.responseText;
            new FusionCharts({
              type: "column2d",
              renderAt: "chartContainer",
              width: '100%',
              height: '500',
              dataFormat: 'json',
              dataSource: data
            }).render();
        }
    };
    xmlhttp.open("GET", "ajax.php", true);
    xmlhttp.send();
    
}

</script>
</head>
<body>
  <input type="submit" onclick="render()" value="Render"></input>
  <div id="chartContainer"></div>
</body>
</html>
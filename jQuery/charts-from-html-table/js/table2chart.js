$('#convert').click(function() {
    $('#dataTable').convertToFusionCharts({
        type: "mscolumn2d",
        width: "100%",
        height: "400",
        dataFormat: "htmltable",
        renderAt: "chart-container"
    }, {
        "chartAttributes": {
            caption: "Units Sold",
            subCaption: "2014 VS 2015",
            xAxisName: "Month",
            yAxisName: "Units",
            theme: "fint",
            showBorder: "0"
        }
    });
    this.disabled=true;
    $('#convert').hide();
    $('#dataTable').hide();
});
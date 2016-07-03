FusionCharts.register('theme', {
  name: 'dataVal',
  theme: {
    base: {
      chart: {
        paletteColors: '#1E9382, #70A758, #EFF1C2, #F0563D, #2E313D',
        baseFontColor: '#36474D',
        baseFont: 'Helvetica Neue, Arial',
        captionFontSize: '14',
        subcaptionFontSize: '14',
        subcaptionFontBold: '0',
        showBorder: '0',
        bgColor: '#ffffff',
        showShadow: '0',
        canvasBgColor: '#ffffff',
        canvasBorderAlpha: '0',
        useplotgradientcolor: '0',
        useRoundEdges: '0',
        showPlotBorder: '0',
        showAlternateHGridColor: '0',
        showAlternateVGridColor: '0',
        toolTipBorderThickness: '0',
        toolTipBgColor: '#EFF1C2',
        toolTipBgAlpha: '90',
        toolTipBorderRadius: '2',
        toolTipPadding: '5',
        divlineAlpha: '100',
        divlineColor: '#36474D',
        divlineThickness: '1',
        divLineIsDashed: '1',
        divLineDashLen: '1',
        divLineGapLen: '1',
        showHoverEffect: '1',
        valueFontSize: '11',
        showXAxisLine: '1',
        xAxisLineThickness: '1',
        xAxisLineColor: '#36474D'
      }
    },
    line: {
      chart: {
        paletteColors: '#1E9382',
        lineThickness: '2',
        anchorRadius: '5'
      },
      data: function(index, item) {
        var anchorColor = '#1E9382';
        if (item.value < 662500) {
          anchorColor = '#FF4444';
        }

        return {
          anchorBgColor: anchorColor
        }
      }
    }
  }
});
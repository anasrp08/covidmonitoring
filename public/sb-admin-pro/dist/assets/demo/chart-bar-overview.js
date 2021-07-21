// Set new default font family and font color to mimic Bootstrap's default styling
(Chart.defaults.global.defaultFontFamily = "Metropolis"),
'-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = "#858796";

function number_format(number, decimals, dec_point, thousands_sep) {
    // *     example: number_format(1234.56, 2, ',', ' ');
    // *     return: '1 234,56'
    number = (number + "").replace(",", "").replace(" ", "");
    var n = !isFinite(+number) ? 0 : +number,
        prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
        sep = typeof thousands_sep === "undefined" ? "," : thousands_sep,
        dec = typeof dec_point === "undefined" ? "." : dec_point,
        s = "",
        toFixedFix = function(n, prec) {
            var k = Math.pow(10, prec);
            return "" + Math.round(n * k) / k;
        };
    // Fix for IE parseFloat(0.55).toFixed(0) = 0;
    s = (prec ? toFixedFix(n, prec) : "" + Math.round(n)).split(".");
    if (s[0].length > 3) {
        s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
    }
    if ((s[1] || "").length < prec) {
        s[1] = s[1] || "";
        s[1] += new Array(prec - s[1].length + 1).join("0");
    }
    return s.join(dec);
}
Chart.helpers.merge(Chart.defaults.global.plugins.datalabels, {
    color: '#000'
  });
//   Chart.plugins.register(ChartDataLabels);

var barChart={
    comp:function(ctx,title){
return new Chart(ctx, {
    
    data: {
      
        labels: '',
        datasets: [
            {
                type: "line",
                fill: false,
                label: "Total Case ",  
                borderColor: "#4CAF50",
                stepped: true,
                padding:50,
                data: '',
                datalabels: {
                    color: 'white',
                    align: 'end',
                    anchor: 'start'
                  },
                  backgroundColor: '#4CAF50 ', 
            },
            {
            type: "bar",
            label: "Total Case ", 
            datalabels: {
                color: 'white',
                align: 'end',
                anchor: 'start',
                font: {
                    weight: 'bold'
                  },
              },
              backgroundColor:[],
            // hoverBackgroundColor: "rgba(0, 97, 242, 0.9)",
            // borderColor: "#303F9F",
            data: ''
        },
        
    ]
    },
    options: { 
        plugins: {
            datalabels: {
                backgroundColor: function(context) {
                    return context.dataset.backgroundColor;
                  },
                  borderRadius: 4,
                color: 'white',
                padding: 6
            }
            // datalabels: {
            //     backgroundColor: function(context) {
            //       return context.dataset.backgroundColor;
            //     },
            //     borderRadius: 4,
            //     color: 'white',
            //     font: {
            //       weight: 'bold'
            //     },
            //     formatter: Math.round,
            //     padding: 6
            //   }
        },
        responsive: true,
                    title: {
                        display: true,
                        text: title
                    },
        // maintainAspectRatio: false,
        layout: {
            padding: {
                left: 10,
                right: 25,
                top: 25,
                bottom: 0
            }
        },
        scales: {
            xAxes: [{
                // time: {
                //     unit: "month"
                // },
                // gridLines: {
                //     display: true,
                //     // drawBorder: true
                // },
                title: {
                    display: true,
                    text: 'Date'
                  },
                //   barPercentage: 0.5,
                //   barThickness: 6
                // ticks: {
                //     maxTicksLimit: 5
                // },
                // maxBarThickness: 25
            }],
            yAxes: [{
                ticks: {
                    beginAtZero:true,
                    min: 0,
                    max: '',
                    // maxTicksLimit: 5,
                    // padding: 5,      
                    stepSize: 20,
                    // Include a dollar sign in the ticks
                    callback: function(value, index, values) {
                        return  number_format(value);
                    }
                },
                title: {
                    display: true,
                    text: 'Value'
                  },
                // gridLines: {
                //     color: "rgb(234, 236, 244)",
                //     zeroLineColor: "rgb(234, 236, 244)",
                //     drawBorder: false,
                //     borderDash: [2],
                //     zeroLineBorderDash: [2]
                // }
            }, 
        ]
        },
        legend: {
            display: false
        },
        tooltips: {
            titleMarginBottom: 10,
            titleFontColor: "#6e707e",
            titleFontSize: 14,
            backgroundColor: "rgb(255,255,255)",
            bodyFontColor: "#858796",
            borderColor: "#dddfeb",
            borderWidth: 1,
            xPadding: 15,
            yPadding: 15,
            displayColors: false,
            caretPadding: 10,
            callbacks: {
                label: function(tooltipItem, chart) {
                    var datasetLabel =
                        chart.datasets[tooltipItem.datasetIndex].label || "";
                    return datasetLabel + ":" + number_format(tooltipItem.yLabel);
                }
            }
        }
    }
});
    },
    updateData:function(chart, dataBar,dataLine,labels,maxValues){
        chart.config.options.scales.yAxes[0].ticks.max = maxValues
            chart.data.labels = labels
            // backgroundColor: "rgba(0, 97, 242, 1)",
            chart.data.datasets[1].backgroundColor = "rgba(0, 97, 242, 1)"
            chart.data.datasets[0].data = dataLine
            chart.data.datasets[1].data = dataBar
            // chart.data.datasets[2].data = sisaSaldo
            // chart.data.datasets[1].backgroundColor[2] = 'rgb(255, 99, 132)';
            chart.update();
            // chart.data.datasets[0].data = data
            // chart.update();
         
    },
    updateDataMaxColor:function(chart, dataBar,dataLine,labels,maxValues){
        chart.config.options.scales.yAxes[0].ticks.max = maxValues
            chart.data.labels = labels
            // backgroundColor: "rgba(0, 97, 242, 1)",
            chart.data.datasets[1].backgroundColor = ["rgba(0, 97, 242, 1)"]
            chart.data.datasets[0].data = dataLine
            chart.data.datasets[1].data = dataBar
            // chart.data.datasets[2].data = sisaSaldo
            // chart.data.datasets[1].backgroundColor[2] = 'rgb(255, 99, 132)';
            chart.update();
            // chart.data.datasets[0].data = data
            // chart.update();
         
    }
}
// Bar Chart Example


 

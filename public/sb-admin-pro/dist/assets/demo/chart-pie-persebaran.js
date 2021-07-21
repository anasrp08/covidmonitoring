(Chart.defaults.global.defaultFontFamily = "Metropolis"),
'-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = "#858796";
var pieChart = {

    comp: function (ctx, title, meta,id) {
        return new Chart(ctx, {
            type: "pie",
            data: {
                labels: '',
                datasets: [{
                    // backgroundColor: ["#3e95cd", "#9c27b0", "#3cba9f", "#ffeb3b", "#ff5722"], 
                    backgroundColor: '',
                    // hoverBackgroundColor: [
                    //     "rgba(0, 97, 242, 0.9)",
                    //     "rgba(0, 172, 105, 0.9)",
                    //     "rgba(88, 0, 232, 0.9)"
                    // ],
                    data: ''
                }]

            },
            options: {
                plugins: {
                    datalabels: {
                        backgroundColor: function(context) {
                          return context.dataset.backgroundColor;
                        },
                        borderColor: 'white',
                        borderRadius: 25,
                        borderWidth: 2,
                        color: 'white',
                        display: true,
                        anchor: 'end',
                        // function(context) {
                        //   var dataset = context.dataset;
                        //   var count = dataset.data.length;
                        //   var value = dataset.data[context.dataIndex];
                        //   return value > count * 1.5;
                        // },
                        font: {
                          weight: 'bold'
                        },
                        padding: 10,
                    }
                },
                hover: { 
                    onHover: function(e, el) {
                        $(id).css("cursor", el[0] ? "pointer" : "default");
                      }
                
                  },
                responsive: true,
                title: {
                    display: true,
                    text: title,
                    padding:30
                },
                legend: {
                    position: 'bottom',
                  
                    labels: {
                        padding: 30  ,
                        textAlign:'right',
                      },
                     
                },
                tooltips: {
                    callbacks: {
                        title: function (tooltipItem, data) {
                            return data['labels'][tooltipItem[0]['index']];
                        },
                        label: function (tooltipItem, data) {
                            // console.log(data)
                            var jumlah = data['datasets'][0]['data'][tooltipItem['index']]

                            // var formattedjumlah = thousands_separators(jumlah)

                            var data = "Jumlah: " + jumlah
                            return data
                            // return data['datasets'];
                        },
                        afterLabel: function (tooltipItem, data) {
                            var dataset = data['datasets'][0];
                            var datasetSum = dataset['data']
                            // console.log(dataset)
                            var percent = Math.round((dataset['data'][tooltipItem['index']] /
                                dataset["_meta"][meta]['total']) * 100)
                            return "Presentase: " + '(' + percent + '%)';
                            // return data;
                        }
                    },

                    titleFontSize: 16,
                    bodyFontSize: 14,
                    displayColors: true
                },
                // plugins: [ChartDataLabels],
                //             plugins: {
                //     // Change options for ALL labels of THIS CHART
                //     datalabels: {
                //         color: '#36A2EB'
                //     }
                // }

            }
        });
    },
    updateData: function (chart, labels, data, color) {
        chart.data.labels = labels
        chart.data.datasets[0].backgroundColor = color
        chart.data.datasets[0].data = data
        chart.update();

    }
}

// Set new default font family and font color to mimic Bootstrap's default styling


// Pie Chart Example

// function createPieChart(ctx, title, meta) {
// return new Chart(ctx, {
//     type: "pie",
//     data: {
//         labels: '',
//         datasets: [{
//             // backgroundColor: ["#3e95cd", "#9c27b0", "#3cba9f", "#ffeb3b", "#ff5722"], 
//             backgroundColor: '',
//             // hoverBackgroundColor: [
//             //     "rgba(0, 97, 242, 0.9)",
//             //     "rgba(0, 172, 105, 0.9)",
//             //     "rgba(88, 0, 232, 0.9)"
//             // ],
//             data: ''
//         }]

//     },
//     options: {
//         responsive: true,
//         title: {
//             display: true,
//             text: title
//         },
//         legend: {
//             position: 'left',
//         },
//         tooltips: {
//             callbacks: {
//                 title: function (tooltipItem, data) {
//                     return data['labels'][tooltipItem[0]['index']];
//                 },
//                 label: function (tooltipItem, data) {
//                     // console.log(data)
//                     var jumlah = data['datasets'][0]['data'][tooltipItem['index']]

//                     // var formattedjumlah = thousands_separators(jumlah)

//                     var data = "Jumlah: " + jumlah
//                     return data
//                     // return data['datasets'];
//                 },
//                 afterLabel: function (tooltipItem, data) { 
//                     var dataset = data['datasets'][0]; 
//                     var datasetSum=dataset['data']
//                     // console.log(datasetSum.reduce)
//                   var percent = Math.round((dataset['data'][tooltipItem['index']] /
//                       dataset["_meta"][meta]['total']) * 100)
//                   return "Presentase: " + '(' + percent + '%)';
//                     // return data;
//                 }
//             },

//             titleFontSize: 16,
//             bodyFontSize: 14,
//             displayColors: true
//         },
//         // plugins: [ChartDataLabels],
//         //             plugins: {
//         //     // Change options for ALL labels of THIS CHART
//         //     datalabels: {
//         //         color: '#36A2EB'
//         //     }
//         // }

//     }
// });
// }

// Stacked Chart

var stackedOptions = {
    colors : ['#ED4C5C', '#ed4c5c80','#ed4c5c4d'],
    chart: {
      type: 'bar',
      stacked:true,
      toolbar: {
        show: false
      },
      height:500,

    },
    plotOptions: {
      bar: {
        columnWidth: '30',
        borderRadius: 17
      }
    },
    series: [
        {
          name: "PRODUCT A",
          data: [64, 55, 81, 67, 72, 53, 67, 87, 90, 84]
        },
        {
          name: "PRODUCT B",
          data: [63, 73, 54, 88, 73, 67, 87, 55, 65, 93]
        },
        {
          name: "PRODUCT C",
          data: [90, 70, 85, 75, 51, 84, 56, 77, 88, 92]
        }
      ],
    xaxis: {
      categories: ["5/12","7/12","9/12","11/12","13/12","15/12","17/12","19/12","21/12","23/12"]
    },
    legend: {
        position: "top",
        offsetX: 50
    },
    responsive: [
      {
        breakpoint: 769,
        options: {
          plotOptions: {
            bar: {
              borderRadius: 12
            }
          }
        }
      },
      {
        breakpoint: 577,
        options: {
          plotOptions: {
            bar: {
              borderRadius: 9
            }
          }
        }
      },
      {
        breakpoint: 481,
        options: {
          chart:{
              height: 350
          },
          plotOptions: {
            bar: {
              columnWidth: '50',
              borderRadius: 5
            }
          }
        }
      }
    ]

  }
  
  var stackedChart = new ApexCharts(document.querySelector("#stackedcol-chart"), stackedOptions);
  stackedChart.render();

  // Line Chart

  var lineOptions = {

    colors:["#F48020"],
    series: [
      {
        name: "Product",
        data: [20, 5, 50, 90, 20, 80, 30, 91, 80]
      }
    ],
    chart: {
      height: 500,
      type: "line",
      toolbar: {
        show: false
      },
    },
    grid: {
      xaxis: {
        lines: {
            show: true
        }
      },   
      yaxis: {
          lines: {
              show: true
          }
      },
    },
    xaxis: {
      categories: [
        "",
        "20K",
        "40K",
        "60K",
        "80K",
        "100K",
        "140K",
        "160K",
        "200K"
      ]
    }
  }

  var lineChart = new ApexCharts(document.querySelector("#line-chart"), lineOptions);
  lineChart.render();

  // Radial Chart

  var radialOptions = {
    colors : ['#ED4C5C', '#FFC700','#286CD1'],
    series:[90, 50, 30],
    chart: {
      type: 'radialBar',
      toolbar: {
        show: false
      },
      height:500,

    },
    plotOptions: {
      radialBar: {
        customScale: 0.8,
        dataLabels: {
          name: {
            fontSize: "22px"
          },
          value: {
            fontSize: "16px"
          },
          total: {
            show: true,
            label: "Comments",
            formatter: function(w) {
              return "80%";
            }
          }
        },
        hollow: {
          margin: 15,
          size: "60%",
        } 
      }
    },
    labels: ["Apples", "Oranges", "Bananas", "Berries"],
    responsive: [
      {
        breakpoint: 381,
          options: {
            plotOptions:{
              radialBar:{
                hollow: {
                  margin: 15,
                },
                track:{
                  strokeWidth: '50%',
                  startAngle: undefined,
                  endAngle: 60,
                }
              }
            }
          }
      },
      {
        breakpoint: 417,
        options:{
          chart: {
            height: 335,
          },
        }
      },
    ]  
  }
  
  var radialChart = new ApexCharts(document.querySelector("#radial-chart"), radialOptions);
  radialChart.render();

  // donut Chart

  var donutOptions = {
    colors : ['#FFC700', '#243E8B', '#D3E5FF','#ED4C5C',],
    series:[43, 8 , 24 , 24 ],
    chart: {
      type: 'donut',
      height:500,

    },
    labels: ["Comments", "Replies", "Shares"],
    legend: {
      position: 'bottom'
    },
    responsive: [
      {
        breakpoint: 490,
          options: {
            chart:{
                height: 350
            }
          }
      },
    ]  
  }
  
  var donutChart = new ApexCharts(document.querySelector("#donut-chart"), donutOptions);
  donutChart.render();

  // Horizontal Bar Chart

  var horizonOptions = {
    colors:["#FFC700"],
    series: [
      {
        name: "basic",
        data: [400, 430, 448, 470, 540, 580, 1100]
      }
    ],
    chart: {
      type: "bar",
      height: 500,
      toolbar: {
        show: false
      },
    },
    plotOptions: {
      bar: {
        horizontal: true,
        barHeight: '20',
        borderRadius: 5
      }
    },
    dataLabels: {
      enabled: false
    },
    xaxis: {
      categories: [
        "Mon,11",
        "Mon,14",
        "Mon,15",
        "Mon,17",
        "Mon,18",
        "Mon,20",
        "Mon,21",
      ]
    },
    
  }
  
  var horizonBarChart = new ApexCharts(document.querySelector("#horizonbar-chart"), horizonOptions);
  horizonBarChart.render();

  // Donut Chart 2

  var donut2Options = {
    colors : ['#F48020', '#20A0FF', '#FFC700',],
    series:[70, 13, 17 ],
    chart: {
      type: 'donut',
      height:500,

    },
    labels: ["Food 70%", "Rent 13%", "Others 17%"],
    legend: {
      position: 'bottom'
    },
    responsive: [
      {
        breakpoint: 490,
          options: {
            chart:{
                height: 350
            }
          }
      },
    ]   
  }
  
  var donutChart2 = new ApexCharts(document.querySelector("#donut-chart-2"), donut2Options);
  donutChart2.render();

  // Radar Chart

  var radarOptions = {
    series: [
      {
        name: "Series Blue",
        data: [80, 50, 30, 40, 100, 20]
      },
      {
        name: "Series Green",
        data: [20, 30, 40, 80, 20, 80]
      },
      {
        name: "Series Orange",
        data: [44, 76, 78, 13, 43, 10]
      }
    ],
    chart: {
      height: 500,
      type: "radar",
      dropShadow: {
        enabled: true,
        blur: 1,
        left: 1,
        top: 1
      },
      toolbar: {
        show: false
      }
    },
    stroke: {
      width: 0
    },
    fill: {
      opacity: .8
    },
    markers: {
      size: 0
    },
    xaxis: {
      categories: ["2011", "2012", "2013", "2014", "2015", "2016"]
    }
  }
  
  var radarChart = new ApexCharts(document.querySelector("#radar-chart"), radarOptions);
  radarChart.render();

  // Bar Chart

  var barOptions = {
    colors:["#243E8B"],
    series: [
      {
        name: "basic",
        data: [800, 730, 448, 470, 740, 580, 890, 1100, 1200, 1380]
      }
    ],
    chart: {
      type: "bar",
      height: 500,
      toolbar: {
        show: false
      },
    },
    dataLabels: {
      enabled: false
    },
    plotOptions: {
      bar: {
        borderRadius: 17
      }
    },
    xaxis: {
      categories: ["5/12","7/12","9/12","11/12","13/12","15/12","17/12","19/12","21/12","23/12"]
    },
    responsive: [
      {
        breakpoint: 381,
        options: {
          plotOptions: {
            bar: {
              borderRadius: 9
            }
          }
        }
      },
      {
        breakpoint: 481,
        options: {
          plotOptions: {
            bar: {
              borderRadius: 12
            }
          }
        }
      },
    ]   
  }
  
  var barChart = new ApexCharts(document.querySelector("#bar-chart"), barOptions);
  barChart.render();



                    
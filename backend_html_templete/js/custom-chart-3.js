// Bar Chart

const ctx = document.getElementById("bar-chart");
const DISPLAY = true;
const BORDER = true;
const CHART_AREA = true;
const TICKS = true;

// const chartAreaBorder = {
//   id: 'chartAreaBorder',
//   beforeDraw(chart, args, options) {
//     const {ctx, chartArea: {left, top, width, height},scales:{x,y}} = chart;
//     ctx.save();
//     ctx.strokeStyle = "red";
//     ctx.lineWidth = options.borderWidth;
//     ctx.setLineDash( [5,10]);
//     ctx.lineDashOffset = options.borderDashOffset;
//     const art = [10,20,30,40,50,60];
//     art.map((item,index)=>{
//       ctx.strokeRect(left, y.getPixelForValue(10*(index)), width, 0);
//     })

//     ctx.restore();
//   }
// };

new Chart(ctx, {
  type: "bar",
  data: {
    labels: ["", "", "", "", "", "", "", "", "", "", "", "", ""],
    datasets: [{
      label: "My First Dataset",
      barThickness: 6,
      data: [25, 35, 55, 20, 30, 15, 12, 35, 21, 52, 45, 30, 10, 50, 45],
      backgroundColor: ["#5f38f9"],
      borderColor: ["#5f38f9"],
      borderWidth: 0,
      borderSkipped: false,
    }, ],
  },
  options: {
    plugins: {
      legend: {
        display: false,
      },
    },
    scales: {
      x: {
        border: {
          display: false,
        },
        grid: {
          display: false,
          drawOnChartArea: false,
          drawBorder: false,
        },
        ticks: {
          display: false,
        },
      },
      y: {
        border: {
          dash: [5, 5],
        },
        grid: {
          tickBorderDash: [2, 2],
        },
      },
    },
    elements: {
      bar: {
        borderRadius: 4,
      },
    },
  },
  // plugins: [chartAreaBorder]
});

const ctx4 = document.getElementById("bar-chart-2");

new Chart(ctx4, {
  type: "bar",
  data: {
    labels: [
      "",
      "",
      "",
      "",
      "",
      "",
      "",
      "",
      "",
      "",
      "",
      "",
      "",
      "",
      "",
      "",
      "",
      "",
      "",
      "",
      "",
      "",
      "",
    ],
    datasets: [{
      label: "My First Dataset",
      barThickness: 4,
      data: [
        25, 35, 55, 20, 30, 15, 12, 35, 21, 52, 45, 30, 10, 50, 45, 25, 35,
        20, 50, 10, 60, 15, 45, 35, 55,
      ],
      backgroundColor: ["#478ffc"],
      borderColor: ["#478ffc"],
      borderWidth: 0,
      borderSkipped: false,
    }, ],
  },
  options: {
    plugins: {
      legend: {
        display: false,
      },
    },
    scales: {
      x: {
        border: {
          display: false,
        },
        grid: {
          display: false,
          drawOnChartArea: false,
          drawBorder: false,
        },
        ticks: {
          display: false,
        },
      },
      y: {
        border: {
          display: false,
        },
        grid: {
          display: false,
          drawBorder: false,
        },
        ticks: {
          display: false,
        },
      },
    },
    elements: {
      bar: {
        borderRadius: 4,
      },
    },
  },
});

// Area Chart

const ctx2 = document.getElementById("area-chart").getContext("2d");

const gradient = ctx2.createLinearGradient(0, 0, 0, 400);

gradient.addColorStop(0, "rgba(95,56,249,.05)");
gradient.addColorStop(0.1, "rgba(95,56,249,.1)");
gradient.addColorStop(0.5, "rgba(95,56,249,.8)");

new Chart(ctx2, {
  type: "line",
  data: {
    labels: ["", "", "", "", "", ""],
    datasets: [{
      label: "Dataset",
      data: [0, 50, 40, 60, 50, 40, 80, 90, 50, 40, 30, 80],
      borderColor: "#5f38f9",
      backgroundColor: gradient,
      fill: true,
      pointStyle: "false",
      pointBackgroundColor: "transparent",
      pointBorderColor: "transparent",
    }, ],
  },
  options: {
    plugins: {
      legend: {
        display: false,
      },
    },
    scales: {
      x: {
        border: {
          display: false,
        },
        grid: {
          display: false,
        },
        ticks: {
          display: false,
        },
      },
      y: {
        border: {
          display: false,
        },
        grid: {
          display: false,
        },
        ticks: {
          display: false,
        },
      },
    },
    tension: 0.4,
  },
});

const ctx3 = document.getElementById("area-chart-2").getContext("2d");

const gradientBg = ctx3.createLinearGradient(0, 0, 0, 400);

gradientBg.addColorStop(0, "rgba(35,169,200,.1)");
gradientBg.addColorStop(0.1, "rgba(35,169,200,.5)");
gradientBg.addColorStop(0.97, "#3567B6");

new Chart(ctx3, {
  type: "line",
  data: {
    labels: ["", "", "", "", "", "", ""],
    datasets: [{
      label: "Dataset",
      data: [50, 80, 40, 30, 10, 30, 50, 80, 50, 40, 30, 80],
      borderColor: "#23A9C8",
      backgroundColor: gradientBg,
      fill: true,
      pointStyle: "circle",
      pointBackgroundColor: "#3567B6",
      pointBorderWidth: 3,
      pointBorderColor: "#ffffff",
      pointRadius: 5,
      pointHoverRadius: 8,
    }, ],
  },
  options: {
    plugins: {
      legend: {
        display: false,
      },
    },
    scales: {
      x: {
        border: {
          display: false,
        },
        grid: {
          display: false,
          drawBorder: false,
        },
        ticks: {
          display: false,
        },
      },
      y: {
        border: {
          display: false,
        },
        grid: {
          display: false,
          drawBorder: false,
        },
        ticks: {
          display: false,
        },
        beginAtZero: true
      },
    },
  },
});

// Line Chart

const ctx5 = document.getElementById("line-chart");

var myChart = new Chart(ctx5, {
  type: "line",
  data: {
    labels: [
      "Jan",
      "Feb",
      "Mar",
      "Apr",
      "May",
      "Jun",
      "Jul",
      "Aug",
      "Sep",
      "Oct",
      "Nov",
      "Dec",
    ],
    datasets: [{
        label: "New Visits",
        data: [400, 250, 100, 150, 300, 400, 500, 700, 650, 500, 750, 500],
        borderColor: "#5f38f9",
        backgroundColor: "#5f38f9",
        pointStyle: "circle",
        pointBorderWidth: 3,
        pointBorderColor: "#ffffff",
        pointRadius: 5,
        pointHoverRadius: 15,
      },
      {
        label: "Unique Visits",
        data: [300, 200, 50, 150, 250, 200, 350, 250, 650, 500, 750, 400],
        borderColor: "#f2bc16",
        backgroundColor: "#f2bc16",
        pointStyle: "circle",
        pointBorderWidth: 3,
        pointBorderColor: "#ffffff",
        pointRadius: 5,
        pointHoverRadius: 15,
      },
    ],
  },
  options: {
    plugins: {
      legend: {
        position: "top",
        align: "cennter",
        labels: {
          boxWidth: 5,
          boxHeight: 5,
          useBorderRadius: true,
          borderRadius: 3,
        },
      },
    },
    scales: {
      x: {
        border: {
          display: false,
          dash: [5, 5],
        },
        grid: {
          tickBorderDash: [2, 2],
        },
      },
      y: {
        border: {
          display: false,
          dash: [5, 5],
        },
        grid: {
          tickBorderDash: [5, 5],
        },
      },
    },
    tension: 0.4,
    maintainAspectRatio: false
  },
});

// donut Chart

var donutOptions = {
  colors: ["#5f38f9", "#478ffc", "#2dc58c", "#f2bc16"],
  series: [43, 8, 24, 16],
  chart: {
    type: "donut",
    height: 240,
  },
  labels: ["Comments", "Replies", "Shares", "Likes"],
  legend: {
    position: "right",
  },
  responsive: [{
    breakpoint: 490,
    options: {
      chart: {
        height: 350,
      },
    },
  }, ],
};

var donutChart = new ApexCharts(
  document.querySelector("#donut-chart"),
  donutOptions
);
donutChart.render();

// Resize Chart

window.addEventListener('beforeprint', () => {
  // myChart.resize(600, 600);
  console.log("100")
});

window.onbeforeprint = (event) => {
  console.log('Before print');
};

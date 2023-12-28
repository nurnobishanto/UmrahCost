var dom = document.getElementById('stackedcol-chart-2');
var myChart = echarts.init(dom, null, {
  renderer: 'canvas',
  useDirtyRect: false
});
var app = {};

var option;

option = {
  color: [ '#ED4C5C', '#ed4c5c80','#ed4c5c4d' ] , 
  series: [
    
  ],
  tooltip: {
    trigger: 'axis',
    axisPointer: {
      type: 'shadow'
    }
  },
  legend: {},
  grid: {
    left: '3%',
    right: '4%',
    bottom: '3%',
    containLabel: true
  },
  xAxis: [
    {
      type: 'category',
      data: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun']
    }
  ],
  yAxis: [
    {
      type: 'value'
    }
  ],
  series: [
    // {
    //   name: 'Direct',
    //   type: 'bar',
    //   emphasis: {
    //     focus: 'series'
    //   },
    //   data: [320, 332, 301, 334, 390, 330, 320]
    // },
    {
      name: 'Email',
      type: 'bar',
      stack: 'Ad',
      emphasis: {
        focus: 'series'
      },
      data: [120, 132, 101, 134, 90, 230, 210]
    },
    {
      name: 'Union Ads',
      type: 'bar',
      stack: 'Ad',
      emphasis: {
        focus: 'series'
      },
      data: [220, 182, 191, 234, 290, 330, 310]
    },
    {
      name: 'Video Ads',
      type: 'bar',
      stack: 'Ad',
      emphasis: {
        focus: 'series'
      },
      data: [150, 232, 201, 154, 190, 330, 410]
    },
    // {
    //   name: 'Search Engine',
    //   type: 'bar',
    //   data: [862, 1018, 964, 1026, 1679, 1600, 1570],
    //   emphasis: {
    //     focus: 'series'
    //   },
    //   markLine: {
    //     lineStyle: {
    //       type: 'dashed'
    //     },
    //     data: [[{ type: 'min' }, { type: 'max' }]]
    //   }
    // },
    // {
    //   name: 'Baidu',
    //   type: 'bar',
    //   barWidth: 5,
    //   stack: 'Search Engine',
    //   emphasis: {
    //     focus: 'series'
    //   },
    //   data: [620, 732, 701, 734, 1090, 1130, 1120]
    // },
    // {
    //   name: 'Google',
    //   type: 'bar',
    //   stack: 'Search Engine',
    //   emphasis: {
    //     focus: 'series'
    //   },
    //   data: [120, 132, 101, 134, 290, 230, 220]
    // },
    // {
    //   name: 'Bing',
    //   type: 'bar',
    //   stack: 'Search Engine',
    //   emphasis: {
    //     focus: 'series'
    //   },
    //   data: [60, 72, 71, 74, 190, 130, 110]
    // },
    // {
    //   name: 'Others',
    //   type: 'bar',
    //   stack: 'Search Engine',
    //   emphasis: {
    //     focus: 'series'
    //   },
    //   data: [62, 82, 91, 84, 109, 110, 120]
    // }
  ]
};


if (option && typeof option === 'object') {
  myChart.setOption(option);
}

window.addEventListener('resize', myChart.resize);

// Line Chart

var lineDom = document.getElementById('line-chart-2');
var myLineChart = echarts.init(lineDom, null, {
  renderer: 'canvas',
  useDirtyRect: false
});
var app = {};

var lineOption;

lineOption = {
  xAxis: {},
  yAxis: {},
  series: [
    {
      data: [
        [10, 40],
        [50, 100],
        [40, 20],
        [35,85]
      ],
      type: 'line'
    }
  ]
};

if (lineOption && typeof lineOption === 'object') {
  myLineChart.setOption(lineOption);
}

window.addEventListener('resize', myLineChart.resize);

// Pie Chart

var myPieChart = echarts.init(document.getElementById('pie-chart-2'), null, {
  renderer: 'canvas',
  useDirtyRect: false
});
var app = {};

var pieOption;

pieOption = {
  title: {
    text: 'Referer of a Website',
    subtext: 'Fake Data',
    left: 'center'
  },
  tooltip: {
    trigger: 'item'
  },
  legend: {
    orient: 'horizontal',
    left: 'center',
    top: '12%'
  },
  series: [
    {
      name: 'Access From',
      type: 'pie',
      radius: '50%',
      data: [
        { value: 1048, name: 'Search Engine' },
        { value: 735, name: 'Direct' },
        { value: 580, name: 'Email' },
        { value: 484, name: 'Union Ads' },
        { value: 300, name: 'Video Ads' }
      ],
      emphasis: {
        itemStyle: {
          shadowBlur: 10,
          shadowOffsetX: 0,
          shadowColor: 'rgba(0, 0, 0, 0.5)'
        }
      }
    }
  ]
};

if (pieOption && typeof pieOption === 'object') {
  myPieChart.setOption(pieOption);
}

window.addEventListener('resize', myPieChart.resize);

// Angle Pie Chart

var myAnglePieChart = echarts.init(document.getElementById('angle-pie-chart-2'), null, {
  renderer: 'canvas',
  useDirtyRect: false
});
var app = {};

var anglePieOption;

anglePieOption = {
  legend: {
    top: 'bottom'
  },
  toolbox: {
    show: true,
    feature: {
      mark: { show: true },
      dataView: { show: true, readOnly: false },
      restore: { show: true },
      saveAsImage: { show: true }
    }
  },
  series: [
    {
      name: 'Nightingale Chart',
      type: 'pie',
      radius: [20, 150],
      center: ['50%', '50%'],
      roseType: 'area',
      itemStyle: {
        borderRadius: 8
      },
      data: [
        { value: 40, name: 'rose 1' },
        { value: 38, name: 'rose 2' },
        { value: 32, name: 'rose 3' },
        { value: 30, name: 'rose 4' },
        { value: 28, name: 'rose 5' },
        { value: 26, name: 'rose 6' },
        { value: 22, name: 'rose 7' },
        { value: 18, name: 'rose 8' }
      ],
    }
  ]
};

if (anglePieOption && typeof anglePieOption === 'object') {
  myAnglePieChart.setOption(anglePieOption);
}

window.addEventListener('resize', myAnglePieChart.resize);


// Rader Chart

var myRaderChart = echarts.init(document.getElementById('radar-chart-2'), null, {
  renderer: 'canvas',
  useDirtyRect: false
});
var app = {};

var raderOption;

raderOption = {
  title: {
    text: 'Basic Radar Chart'
  },
  legend: {
    data: ['Allocated Budget', 'Actual Spending']
  },
  radar: {
    // shape: 'circle',
    indicator: [
      { name: 'Sales', max: 6500 },
      { name: 'Administration', max: 16000 },
      { name: 'Information Technology', max: 30000 },
      { name: 'Customer Support', max: 38000 },
      { name: 'Development', max: 52000 },
      { name: 'Marketing', max: 25000 }
    ],
    radius: "45%"
  },
  series: [
    {
      name: 'Budget vs spending',
      type: 'radar',
      data: [
        {
          value: [4200, 3000, 20000, 35000, 50000, 18000],
          name: 'Allocated Budget'
        },
        {
          value: [5000, 14000, 28000, 26000, 42000, 21000],
          name: 'Actual Spending'
        }
      ]
    }
  ]
};

if (raderOption && typeof raderOption === 'object') {
  myRaderChart.setOption(raderOption);
}

window.addEventListener('resize', myRaderChart.resize);

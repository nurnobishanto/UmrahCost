<script>
    // total-revenue chart
    var totalRevenueDataArray = {!! json_encode($totalRevenueOfThisYear) !!}

    var totalRevenueOptions = {
        colors: ["#F48020"],
        series: [{
            name: "Total Revenue",
            data: totalRevenueDataArray
        }],
        chart: {
            height: 400,
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
                "January",
                "February",
                "March",
                "April",
                "May",
                "June",
                "July",
                "August",
                "September",
                "October",
                "November",
                "December"
            ]
        }
    }

    var totalRevenueChart = new ApexCharts(document.querySelector("#total-revenue-chart"), totalRevenueOptions);
    totalRevenueChart.render();



    // bestClient chart
    var bestClientDataArray = {!! json_encode($bestClientServiceChargeOfThisYear) !!};
    var bestClientNameOfThisYear = {!! json_encode($bestClientNameOfThisYear) !!};

    var bestClientOptions = {
        colors: ["#243E8B"],
        series: [{
            name: "Total Spend",
            data: bestClientDataArray
        }],
        chart: {
            type: "bar",
            height: 400,
            toolbar: {
                show: false
            },
        },
        dataLabels: {
            enabled: false
        },
        plotOptions: {
            bar: {
                borderRadius: 0
            }
        },
        xaxis: {
            categories: bestClientNameOfThisYear
        },
        responsive: [{
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

    var bestClientChart = new ApexCharts(document.querySelector("#best-client-chart"), bestClientOptions);
    bestClientChart.render();
</script>

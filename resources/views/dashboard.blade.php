@extends('layouts.app')

@section('tittle','Dashboard')

@section('content')

    <div class="row">

        <div class="col-6">
            <div class="card card-body">
                <div class="row">
                    <div><h5 class="card-title text-center text-black">Valor Mês atual</h5></div>
                    <div id="valuesExpired" class="valuesExpired d-flex justify-content-center"></div>
                </div>
            </div>
        </div>


        <div class="col-6">
            <div class="card card-body">
                <div class="row">
                    <div><h5 class="card-title text-center text-black">Valores por Cartão</h5></div>
                    <div id="idgrafico" class="idgrafico d-flex justify-content-center"></div>
                </div>
            </div>
        </div>

    </div>

    <script>

        document.addEventListener('DOMContentLoaded', function () {
            var data_aux = @json($data_aux);
            console.log(data_aux);
            var options = {
                series: data_aux['value'],
                chart: {
                    width: 380,
                    type: 'polarArea'
                },
                labels: data_aux['name'],
                fill: {
                    opacity: 1
                },
                stroke: {
                    width: 1,
                    colors: undefined
                },
                yaxis: {
                    show: false
                },
                legend: {
                    position: 'bottom'
                },
                plotOptions: {
                    polarArea: {
                        rings: {
                            strokeWidth: 0
                        },
                        spokes: {
                            strokeWidth: 0
                        },
                    }
                },
                theme: {
                    monochrome: {
                        enabled: true,
                        shadeTo: 'light',
                        shadeIntensity: 0.6
                    }
                }
            };

            var chart = new ApexCharts(document.querySelector("#valuesExpired"), options);
            chart.render();


            var options = {
                series: [{
                    name: 'Net Profit',
                    data: [44, 55, 57, 56, 61, 58, 63, 60, 66]
                }, {
                    name: 'Revenue',
                    data: [76, 85, 101, 98, 87, 105, 91, 114, 94]
                }, {
                    name: 'Free Cash Flow',
                    data: [35, 41, 36, 26, 45, 48, 52, 53, 41]
                }],
                chart: {
                    type: 'bar',
                    height: 350
                },
                plotOptions: {
                    bar: {
                        horizontal: false,
                        columnWidth: '55%',
                        endingShape: 'rounded'
                    },
                },
                dataLabels: {
                    enabled: false
                },
                stroke: {
                    show: true,
                    width: 2,
                    colors: ['transparent']
                },
                xaxis: {
                    categories: ['Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct'],
                },
                yaxis: {
                    title: {
                        text: '$ (thousands)'
                    }
                },
                fill: {
                    opacity: 1
                },
                tooltip: {
                    y: {
                        formatter: function (val) {
                            return "$ " + val + " thousands"
                        }
                    }
                }
            };

            var chart = new ApexCharts(document.querySelector("#idgrafico"), options);
            chart.render();
        });
    </script>

@endsection


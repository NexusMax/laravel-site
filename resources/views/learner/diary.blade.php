<?php

use App\User;

use Jenssegers\Date\Date;

Date::setLocale('ru');
?>
@extends('layouts.learner')

@section('content')
    <main class="dashboard-main">
        <div class="dashboard container">
            <div class="row">
                <div class="dashboard-wrapper">

                    @include('partials.left-menu',[])
                    <div class="db-container">
                        <div class="diary-top d-flex-wrap">
                            <span class="account-title">Дневник</span>
                            <a href="diary-recommend.html" class="recommend-button">Рекомендации</a>
                        </div>
                        <div class="row row-diary">
                            <!--
                            <div class="col-lg-9 col-md-8">
                                <span>Состояние организма во время и после тренировки</span>
                                <canvas id="line-chart" width="600" height="350"></canvas>

                                <div class="row chart-legends">
                                    <div class="col-md-6">
                                        <input id="chart-1" type="checkbox">
                                        <label for="chart-1" class="color1">Утомляемость после <br> тренировки</label>
                                    </div>
                                    <div class="col-md-6">
                                        <input id="chart-2" type="checkbox">
                                        <label for="chart-2" class="color2">Сложность выполнения тренировки</label>
                                    </div>
                                </div>
                            </div>
                            -->
                            <!--
                                                        <div class="col-lg-3 col-md-4">
                                                            <div class="dropdown dropdown-statistics">
                                                                <button type="button" data-toggle="dropdown" class="dropdown-toggle">
                                                                    <em>Статистика</em>
                                                                    <img src="/../../img/icons/icon-arrow.png" alt="">
                                                                </button>
                                                                <ul class="dropdown-menu">
                                                                    <li><a href="#">За неделю</a></li>
                                                                    <li><a href="#">За месяц</a></li>
                                                                    <li><a href="#">За год</a></li>
                                                                </ul>
                                                            </div>
                                                            <div class="statistics-wrapper">
                                                                <div class="statistics-row">
                                                                    <em>30.01.18 - очень легко</em>
                                                                    <i>30.01.18 - <mark>утомления нет</mark></i>
                                                                </div>
                                                                <div class="statistics-row">
                                                                    <em>28.01.18 - очень легко</em>
                                                                    <i>28.01.18 - <mark>утомления нет</mark></i>
                                                                </div>
                                                                <div class="statistics-row">
                                                                    <em>26.01.18 - очень легко</em>
                                                                    <i>26.01.18 - <mark>утомления нет</mark></i>
                                                                </div>
                                                                <div class="statistics-row">
                                                                    <em>24.01.18 - очень легко</em>
                                                                    <i>24.01.18 - <mark>утомления нет</mark></i>
                                                                </div>
                                                                <div class="statistics-row">
                                                                    <em>22.01.18 - очень легко</em>
                                                                    <i>22.01.18 - <mark>утомления нет</mark></i>
                                                                </div>
                                                                <div class="statistics-row">
                                                                    <em>20.01.18 - очень легко</em>
                                                                    <i>20.01.18 - <mark>утомления нет</mark></i>
                                                                </div>
                                                                <div class="statistics-row">
                                                                    <em>18.01.18 - очень легко</em>
                                                                    <i>18.01.18 - <mark>утомления нет</mark></i>
                                                                </div>
                                                                <div class="statistics-row">
                                                                    <em>16.01.18 - очень легко</em>
                                                                    <i>16.01.18 - <mark>утомления нет</mark></i>
                                                                </div>
                                                            </div>
                                                        </div>
                                -->
                        </div>
                        <div class="row row-diary">
                            <div class="col-lg-9 col-md-8">
                                <span>Уровень физической подготовленности</span>
                                <canvas id="line-physical" width="600" height="350"></canvas>
                                <div class="row chart-legends">
                                    <div class="col-md-4">
                                        <input id="chart-3" type="checkbox">
                                        <label for="chart-3" class="color1">Проба Руфье</label>
                                    </div>
                                    <div class="col-md-4">
                                        <input id="chart-4" type="checkbox">
                                        <label for="chart-4" class="color2">Гибкость</label>
                                    </div>
                                    <div class="col-md-4">
                                        <input id="chart-5" type="checkbox">
                                        <label for="chart-5" class="color3">Отжимания</label>
                                    </div>
                                </div>
                                <div class="row chart-legends">
                                    <div class="col-md-4">
                                        <input id="chart-6" type="checkbox">
                                        <label for="chart-6" class="color4">Сит-апы</label>
                                    </div>
                                    <div class="col-md-4">
                                        <input id="chart-7" type="checkbox">
                                        <label for="chart-7" class="color5">Приседания</label>
                                    </div>
                                    <div class="col-md-4">
                                        <input id="chart-8" type="checkbox">
                                        <label for="chart-8" class="color6">Планка</label>
                                    </div>
                                </div>
                                <div class="row chart-legends">
                                    <div class="col-md-4">
                                        <input id="chart-9" type="checkbox">
                                        <label for="chart-9" class="color7">Ласточка</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-4">
                                <div class="dropdown dropdown-statistics">
                                    <button type="button" data-toggle="dropdown" class="dropdown-toggle">
                                        <em>Статистика</em>
                                        <img src="/../../img/icons/icon-arrow.png" alt="">
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li><a href="#">За неделю</a></li>
                                        <li><a href="#">За месяц</a></li>
                                        <li><a href="#">За год</a></li>
                                    </ul>
                                </div>
                                <div class="statistics-wrapper">
                                    <div class="statistics-row">
                                        <em>30.01.18 - средний уровень</em>
                                        <i>30.01.18 -
                                            <mark>уровень ниже среднего</mark>
                                        </i>
                                    </div>
                                    <div class="statistics-row">
                                        <em>28.01.18 - очень легко</em>
                                        <i>28.01.18 -
                                            <mark>уровень ниже среднего</mark>
                                        </i>
                                    </div>
                                    <div class="statistics-row">
                                        <em>26.01.18 - очень легко</em>
                                        <i>26.01.18 -
                                            <mark>уровень ниже среднего</mark>
                                        </i>
                                    </div>
                                    <div class="statistics-row">
                                        <em>24.01.18 - очень легко</em>
                                        <i>24.01.18 -
                                            <mark>уровень ниже среднего</mark>
                                        </i>
                                    </div>
                                    <div class="statistics-row">
                                        <em>22.01.18 - очень легко</em>
                                        <i>22.01.18 -
                                            <mark>уровень ниже среднего</mark>
                                        </i>
                                    </div>
                                    <div class="statistics-row">
                                        <em>20.01.18 - очень легко</em>
                                        <i>20.01.18 -
                                            <mark>уровень ниже среднего</mark>
                                        </i>
                                    </div>
                                    <div class="statistics-row">
                                        <em>18.01.18 - очень легко</em>
                                        <i>18.01.18 -
                                            <mark>уровень ниже среднего</mark>
                                        </i>
                                    </div>
                                    <div class="statistics-row">
                                        <em>16.01.18 - очень легко</em>
                                        <i>16.01.18 -
                                            <mark>уровень ниже среднего</mark>
                                        </i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--
                        <div class="row row-diary">
                            <div class="col-lg-9 col-md-8">
                                <span>Уровень физической подготовленности</span>
                                <canvas id="line-chart3" width="600" height="350"></canvas>
                                <div class="row chart-legends">
                                    <div class="col-md-4">
                                        <input id="chart-10" type="checkbox">
                                        <label for="chart-10" class="color1">Обхват плеч</label>
                                    </div>
                                    <div class="col-md-4">
                                        <input id="chart-11" type="checkbox">
                                        <label for="chart-11" class="color2">Обхват груди</label>
                                    </div>
                                    <div class="col-md-4">
                                        <input id="chart-12" type="checkbox">
                                        <label for="chart-12" class="color3">Вес</label>
                                    </div>
                                </div>
                                <div class="row chart-legends">
                                    <div class="col-md-4">
                                        <input id="chart-13" type="checkbox">
                                        <label for="chart-13" class="color4">Обхват талии</label>
                                    </div>
                                    <div class="col-md-4">
                                        <input id="chart-14" type="checkbox">
                                        <label for="chart-14" class="color5">Обхват руки левая</label>
                                    </div>
                                    <div class="col-md-4">
                                        <input id="chart-15" type="checkbox">
                                        <label for="chart-15" class="color6">Обхват руки правая</label>
                                    </div>
                                </div>
                                <div class="row chart-legends">
                                    <div class="col-md-4">
                                        <input id="chart-16" type="checkbox">
                                        <label for="chart-16" class="color7">Обхват руки по бицепсу</label>
                                    </div>
                                    <div class="col-md-4">
                                        <input id="chart-17" type="checkbox">
                                        <label for="chart-17" class="color8">Обхват таза</label>
                                    </div>
                                    <div class="col-md-4">
                                        <input id="chart-18" type="checkbox">
                                        <label for="chart-18" class="color9">Обхват бедра левого</label>
                                    </div>
                                </div>
                                <div class="row chart-legends">
                                    <div class="col-md-4">
                                        <input id="chart-19" type="checkbox">
                                        <label for="chart-19" class="color10">Обхват бедра правого</label>
                                    </div>
                                    <div class="col-md-4">
                                        <input id="chart-20" type="checkbox">
                                        <label for="chart-20" class="color11">Обхват бедера правого по самой широкой
                                            части</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-4">
                                <div class="dropdown dropdown-statistics">
                                    <button type="button" data-toggle="dropdown" class="dropdown-toggle">
                                        <em>Статистика</em>
                                        <img src="/../../img/icons/icon-arrow.png" alt="">
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li><a href="#">За неделю</a></li>
                                        <li><a href="#">За месяц</a></li>
                                        <li><a href="#">За год</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        -->
                    </div>


                </div>
            </div>


            @include('partials.events',[
                'itemsEvents' => $itemsEvents
            ])
        </div>
    </main>
    <script src="/libs/jquery/jquery-1.11.2.min.js"></script>
    <script src="/libs/bootstrap/js/bootstrap.min.js"></script>
    <script src="/libs/wow.min.js"></script>
    <script src="/libs/chart.min.js"></script>
    <script src="/libs/animate/animate-css.js"></script>
    <script src="/libs/owlcarousel2/dist/owl.carousel.min.js"></script>
    <script src="https://use.fontawesome.com/bad8fea332.js"></script>
    <script src="/js/common.js"></script>

    <script>
        $(".dropdown-menu li a").on('click', function (e) {
            e.preventDefault();
            var selText = $(this).text();
            $(this).parents('.dropdown-statistics').find('.dropdown-toggle em').html(selText);
        });
    </script>

    <script>
        Chart.pluginService.register({
            beforeDraw: function (chart) {
                if (chart.config.options.chartArea && chart.config.options.chartArea.backgroundColor) {
                    var ctx = chart.chart.ctx;
                    var chartArea = chart.chartArea;

                    ctx.save();
                    ctx.fillStyle = chart.config.options.chartArea.backgroundColor;
                    ctx.fillRect(chartArea.left, chartArea.top, chartArea.right - chartArea.left, chartArea.bottom - chartArea.top);
                    ctx.restore();
                }
            }
        });
        /*new Chart(document.getElementById("line-chart"), {
            type: 'line',
            backgroundColor: 'rgb(0, 0, 0)',
            data: {
                labels: [0, 10, 12, 14, 16, 18, 20, 22, 24, 26, 28, 30],
                datasets: [{
                    data: [86,114,106,106,107,111,133,221,783,2478],
                    label: "Утомляемость после тренировки",
                    borderColor: "#a8b3ba",
                    fill: false
                },
                    {
                        data: [282,350,411,502,635,809,947,1402,3700,5267],
                        label: "Сложность выполнения тренировки",
                        borderColor: "#21b99b",
                        fill: false
                    }
                ]
            },
            options: {
                legend: {
                    display: false,
                    position: 'bottom',
                    labels: {
                        fontColor: 'rgb(0, 0, 0)'
                    }
                },
                scales: {
                    yAxes: [{
                        ticks: {
                            display: false
                        },
                        gridLines : {
                            display : false
                        }
                    }],
                    xAxes: [{
                        gridLines : {
                            borderDash : [5]
                        }
                    }]
                },
                chartArea: {
                    backgroundColor: 'rgba(251, 251, 251, 1)'
                }
            }
        });
*/

        new Chart(document.getElementById("line-physical"), {
            type: 'line',
            backgroundColor: 'rgb(0, 0, 0)',
            data: {
                labels: [0, 10, 12, 14, 16, 18, 20, 22, 24, 26, 28, 30],
                datasets: @php echo $physicalChart @endphp
            },
            options: {
                legend: {
                    display: false,
                    position: 'bottom',
                    labels: {
                        fontColor: 'rgb(0, 0, 0)'
                    }
                },
                scales: {
                    yAxes: [{
                        ticks: {
                            display: false
                        },
                        gridLines: {
                            display: false
                        }
                    }],
                    xAxes: [{
                        gridLines: {
                            borderDash: [5]
                        }
                    }]
                },
                chartArea: {
                    backgroundColor: 'rgba(251, 251, 251, 1)'
                }
            }
        });

        /*new Chart(document.getElementById("line-chart3"), {
            type: 'line',
            backgroundColor: 'rgb(0, 0, 0)',
            data: {
                labels: [0, 10, 12, 14, 16, 18, 20, 22, 24, 26, 28, 30],
                datasets: [{
                    data: [500, 200, 100, 1564, 300, 300, 133, 221, 783, 2478],
                    label: "Утомляемость после тренировки",
                    borderColor: "#f33",
                    fill: false
                }
                ]
            },
            options: {
                legend: {
                    display: false,
                    position: 'bottom',
                    labels: {
                        fontColor: 'rgb(0, 0, 0)'
                    }
                },
                scales: {
                    yAxes: [{
                        ticks: {
                            display: false
                        },
                        gridLines: {
                            display: false
                        }
                    }],
                    xAxes: [{
                        gridLines: {
                            borderDash: [5]
                        }
                    }]
                },
                chartArea: {
                    backgroundColor: 'rgba(251, 251, 251, 1)'
                }
            }
        });*/
    </script>
@endsection
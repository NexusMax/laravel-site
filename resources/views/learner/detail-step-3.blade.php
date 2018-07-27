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
                    <div class="db-content">

                        <form action="{{ route('step',['step' => 4]) }}" class="account-form" method="POST" enctype="multipart/form-data" id="myaccount-form-inf">
                            {{ csrf_field() }}
                        <div class="db-container">
                            <div class="detail-info-progressbar">
                                <div class="progress-line">
                                    <div class="progressbar" style="width: 50%;"></div>
                                </div>
                                <a href="{{ route('detail') }}" class="detail-info-step check">
                                    <div class="detail-info-icon">
                                        <img src="/../..//../..//../../img/icons/fingerprint.svg"
                                             class="svg svg-default" alt="">
                                        <img src="/../..//../..//../../img/icons/tick.svg" class="svg svg-check" alt="">
                                    </div>
                                    <span>Персональные данные</span>
                                </a>
                                <a href="{{ route('step',['step' => 2 ]) }}"  class="detail-info-step check">
                                    <div class="detail-info-icon">
                                        <img src="/../..//../..//../../img/icons/target.svg"
                                             class="svg svg-rotate svg-default" alt="">
                                        <img src="/../..//../..//../../img/icons/tick.svg" class="svg svg-check" alt="">
                                    </div>
                                    <span>Цель</span>
                                </a>
                                <a href="{{ route('step',['step' => 3 ]) }}"  class="detail-info-step active">
                                    <div class="detail-info-icon">
                                        <img src="/../..//../..//../../img/icons/muscles.svg" class="svg svg-default"
                                             alt="">
                                        <img src="/../..//../..//../../img/icons/tick.svg" class="svg svg-check" alt="">
                                    </div>
                                    <span>Физическое состояние</span>
                                </a>
                                <a href="{{ route('step',['step' => 4 ]) }}"  class="detail-info-step">
                                    <div class="detail-info-icon">
                                        <img src="/../..//../..//../../img/icons/cardiogram.svg" class="svg svg-default"
                                             alt="">
                                        <img src="/../..//../..//../../img/icons/tick.svg" class="svg svg-check" alt="">
                                    </div>
                                    <span>Здоровье</span>
                                </a>
                                <a href="{{ route('step',['step' => 5 ]) }}"  class="detail-info-step">
                                    <div class="detail-info-icon">
                                        <img src="/../..//../..//../../img/icons/fitness.svg" class="svg svg-default"
                                             alt="">
                                        <img src="/../..//../..//../../img/icons/tick.svg" class="svg svg-check" alt="">
                                    </div>
                                    <span>Телосложение</span>
                                </a>
                            </div>
                            <div class="physical-state-row">
                                <span class="account-title">Физическое состояние</span>
                                <div class="physical-state-text">
                                    <em>Уровень физической подготовленности</em>
                                    <p>(вы можете определить свой уровень, пройдя специальный тест)</p>
                                </div>
                                <div class="level-range-wrapper d-flex-wrap">
                                    <div class="level-range">
                                        <input type="text" id="range-level" value="" name="physicallevel"/>
                                    </div>
                                    <a href="{{route('physical-step') }}" class="btn-gray">Определить
                                        уровень</a>
                                </div>
                            </div>
                            <div class="physical-state-row">
                                <div class="physical-state-text">
                                    <em>Кол-во тренировок в неделю</em>
                                    <p>выберите не менее двух дней для тренировок</p>
                                </div>
                                <div class="train-days">
                                    <div class="train-days-col">
                                        <input id="train-day1" type="checkbox" name="day[]" value="1" @if (in_array("1",$physical_days)) checked @endif>
                                        <label for="train-day1">ПН</label>
                                    </div>
                                    <div class="train-days-col">
                                        <input id="train-day2" type="checkbox" name="day[]" value="2" @if (in_array("2",$physical_days)) checked @endif>
                                        <label for="train-day2">ВТ</label>
                                    </div>
                                    <div class="train-days-col">
                                        <input id="train-day3" type="checkbox" name="day[]" value="3" @if (in_array("3",$physical_days)) checked @endif>
                                        <label for="train-day3">СР</label>
                                    </div>
                                    <div class="train-days-col">
                                        <input id="train-day4" type="checkbox" name="day[]" value="4" @if (in_array("4",$physical_days)) checked @endif>
                                        <label for="train-day4">ЧТ</label>
                                    </div>
                                    <div class="train-days-col">
                                        <input id="train-day5" type="checkbox" name="day[]" value="5" @if (in_array("5",$physical_days)) checked @endif>
                                        <label for="train-day5">ПТ</label>
                                    </div>
                                    <div class="train-days-col">
                                        <input id="train-day6" type="checkbox" name="day[]" value="6" @if (in_array("6",$physical_days)) checked @endif>
                                        <label for="train-day6">СБ</label>
                                    </div>
                                    <div class="train-days-col">
                                        <input id="train-day7" type="checkbox" name="day[]" value="7" @if (in_array("7",$physical_days)) checked @endif>
                                        <label for="train-day7">ВС</label>
                                    </div>
                                </div>
                            </div>
                            <div class="physical-state-row">
                                <div class="physical-state-text">
                                    <em style="margin-bottom: 45px;">Тренировочный стаж</em>
                                </div>
                                <div class="level-range-wrapper d-flex-wrap">
                                    <div class="level-range">
                                        <span class="irs-middle">3 года</span>
                                        <input type="text" id="range-experience" value="" name="physicalexpyears"/>
                                    </div>
                                </div>
                            </div>
                        </div>

                            <div class="next-step-button">
                                <input class="btn" value="Далее" type="submit">
                            </div>
                        </form>
                    </div>


                </div>
            </div>


            @include('partials.events',[
                'itemsEvents' => $itemsEvents
            ])
        </div>
    </main>

    <script type="text/javascript">
        var healhvalue = 1;

        @if ($extraFields->physical_level)
            var rangevalue = {{$extraFields->physical_level}} - 1 + 0.1;
        @else
            var rangevalue = 1;
        @endif

        @if ($extraFields->physical_exp_years)
            var expvalue = {{$extraFields->physical_exp_years}} + 0.1;
        @else
            var expvalue = 1;
        @endif
    </script>

@endsection
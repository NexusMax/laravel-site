<?php

use App\User;

use Jenssegers\Date\Date;

Date::setLocale('ru');
?>
@extends('layouts.learner')

@section('content')
    <main class="dashboard-main">
        <div class="dashboard container">
            <div class="testing-top">
                <a href="{{route('step',['step' => 4])}}" class="button-back">
                    <i class="fa fa-long-arrow-left"></i>
                    Назад к анкете
                </a>
                <span class="account-title">Тест на определения уровня физической подготовленности</span>
            </div>

            <form action="{{ route('health') }}" class="account-form" method="POST"
                  enctype="multipart/form-data" id="myaccount-form-inf">
                <div class="db-container">
                    <div class="tests-content tests-content-health">
                        <h2>Контрекс 1</h2>
                        <p>Экспресс-система «Контрэкс-1» разработана проф. С. А. Душаниным и предназначена для
                            самоконтроля
                            физического состояния. Внимательно ознакомтесь с условиями изверения параметров физического
                            состояния.</p>

                        {{ csrf_field() }}

                        <div class="row test-health-row">
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="account-data-form-row">
                                            <label for="test1">Рост</label>
                                            <input id="test1" type="number" name="growth"
                                                   value="{{$healthMetricsLast->growth}}">
                                            <span>см</span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="account-data-form-row">
                                            <label for="test2">Масса тела</label>
                                            <input id="test2" type="number" name="height"
                                                   value="{{$healthMetricsLast->height}}">
                                            <span>кг</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <mark>Артериальное давление</mark>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="account-data-form-row">
                                            <label for="test3" class="light-text">Систолическое</label>
                                            <input id="test3" type="number" name="pressuresys"
                                                   value="{{$healthMetricsLast->pressure_sys}}">
                                            <span>мм.рт.ст.</span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="account-data-form-row">
                                            <label for="test4" class="light-text">Диастолическое</label>
                                            <input id="test4" type="number" name="pressuredia"
                                                   value="{{$healthMetricsLast->pressure_dia}}">
                                            <span>мм.рт.ст.</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row test-health-row">
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="account-data-form-row">
                                            <label for="test5">Курение</label>
                                            <p>Укажите среднее кол-во сигарет, выкуриваемое вами за день</p>
                                            <input id="test5" type="number" name="smoking"
                                                   value="{{$healthMetricsLast->smoking}}">
                                            <span>сигарет в день</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="account-data-form-row">
                                            <label for="test6">Алкоголь</label>
                                            <p>Укажите среднее кол-во алкоголя, употребляемое вами в неделю.
                                                Эпизодический прием алкоголя не учитывается.</p>
                                            <input id="test6" type="number" name="alcohol"
                                                   value="{{$healthMetricsLast->alcohol}}">
                                            <span>г</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row test-health-row">
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-10">
                                        <div class="account-data-form-row">
                                            <label for="test7">Пульс в покое</label>
                                            <p>После 5 минут отдыха в положении сидя измерьте пульс за одну минуту. Для
                                                корректности результатов не выполняйте силовых нагрузок перед
                                                измерением.</p>
                                            <input id="test7" type="number" name="pulserest"
                                                   value="{{$healthMetricsLast->pulse_rest}}">
                                            <span>уд./мин.</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="account-data-form-row">
                                            <label for="test8">Восстанавливаемость пульса</label>
                                            <p>После измерения “пульса в покое”, сделайте 20 глубоких приседаний в
                                                течение 40 сек и вновь сядьте. Через 2 минуты вновь измерить пульс за 10
                                                сек и результат умножить на 6.</p>
                                            <input id="test8" type="number" name="pulseregen"
                                                   value="{{$healthMetricsLast->pulse_regen}}">
                                            <span>уд./мин.</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="test-health-row">
                            <div class="account-data-form-row">
                                <label for="test5">Общая выносливость</label>
                                <p>Выберите один из вариантов. Под общей выносливостью подразумевается систематичность
                                    выполнения упражнений на развитие выносливости (ходьба, бег, плавание, езда на
                                    велосипеде, гребля, бег на лыжах и др.) в течении не менее 15 минут в день на
                                    протяжении 8–10 недель при частоте пульса не ниже 140 удуров в минуту (во время
                                    выполнения упражнений)</p>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="sex-input radio-input-wrapper">
                                            <input id="endurance1" type="radio" name="stamina[]" value="1"
                                                   @if ($healthMetricsLast->stamina == '1') checked @endif>
                                            <label for="endurance1">Ежедневно</label>
                                        </div>
                                        <div class="sex-input radio-input-wrapper">
                                            <input id="endurance2" type="radio" name="stamina[]" value="2"
                                                   @if ($healthMetricsLast->stamina == '2') checked @endif>
                                            <label for="endurance2">2 раза в неделю</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="sex-input radio-input-wrapper">
                                            <input id="endurance3" type="radio" name="stamina[]" value="3"
                                                   @if ($healthMetricsLast->stamina == '3') checked @endif>
                                            <label for="endurance3">4 раза в неделю</label>
                                        </div>
                                        <div class="sex-input radio-input-wrapper">
                                            <input id="endurance4" type="radio" name="stamina[]" value="4"
                                                   @if ($healthMetricsLast->stamina == '4') checked @endif>
                                            <label for="endurance4">1 раз в неделю</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="sex-input radio-input-wrapper">
                                            <input id="endurance5" type="radio" name="stamina[]" value="5"
                                                   @if ($healthMetricsLast->stamina == '5') checked @endif>
                                            <label for="endurance5">3 раза в неделю</label>
                                        </div>
                                        <div class="sex-input radio-input-wrapper">
                                            <input id="endurance6" type="radio" name="stamina[]" value="6"
                                                   @if ($healthMetricsLast->stamina == '6') checked @endif>
                                            <label for="endurance6">ни одного раза</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>


                <div class="next-step-button">
                    <input type="submit" class="btn" value="Далее">
                </div>
            </form>


            @include('partials.events',[
                'itemsEvents' => $itemsEvents
            ])
        </div>
    </main>
@endsection
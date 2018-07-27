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
                <a href="{{route('step',['step' => 3])}}" class="button-back">
                    <i class="fa fa-long-arrow-left"></i>
                    Назад к анкете
                </a>
                <span class="account-title">Тест на определения уровня физической подготовленности</span>
            </div>

            <form action="{{ route('physical-step',['step' => 4]) }}" class="account-form" method="POST"
                  enctype="multipart/form-data" id="myaccount-form-inf">
                {{ csrf_field() }}

                <div class="db-container">
                    <div class="tests-content">
                        <div class="detail-info-progressbar tests-progressbar">
                            <div class="progress-line">
                                <div class="progressbar" style="width: 0;"></div>
                            </div>
                            <a href="{{route('physical-step',['step' => 1])}}" class="detail-info-step check">
                                <div class="detail-info-icon">
                                    <mark>1</mark>
                                    <img src="/../img/icons/tick.svg" class="svg svg-check" alt="">
                                </div>
                                <span>Индекс Руфье</span>
                            </a>
                            <a href="{{route('physical-step',['step' => 2])}}" class="detail-info-step check">
                                <div class="detail-info-icon">
                                    <mark>2</mark>
                                    <img src="/../img/icons/tick.svg" class="svg svg-check" alt="">
                                </div>
                                <span>Гибкость</span>
                            </a>
                            <a href="{{route('physical-step',['step' => 3])}}" class="detail-info-step active">
                                <div class="detail-info-icon">
                                    <mark>3</mark>
                                    <img src="/../img/icons/tick.svg" class="svg svg-check" alt="">
                                </div>
                                <span>Отжимания</span>
                            </a>
                            <a href="{{route('physical-step',['step' => 4])}}" class="detail-info-step">
                                <div class="detail-info-icon">
                                    <mark>4</mark>
                                    <img src="/../img/icons/tick.svg" class="svg svg-check" alt="">
                                </div>
                                <span>Сит-апы</span>
                            </a>
                            <a href="{{route('physical-step',['step' => 5])}}" class="detail-info-step">
                                <div class="detail-info-icon">
                                    <mark>5</mark>
                                    <img src="/../img/icons/tick.svg" class="svg svg-check" alt="">
                                </div>
                                <span>Приседания</span>
                            </a>
                            <a href="{{route('physical-step',['step' => 6])}}" class="detail-info-step">
                                <div class="detail-info-icon">
                                    <mark>6</mark>
                                    <img src="/../img/icons/tick.svg" class="svg svg-check" alt="">
                                </div>
                                <span>Планка</span>
                            </a>
                            <a href="{{route('physical-step',['step' => 7])}}" class="detail-info-step">
                                <div class="detail-info-icon">
                                    <mark>7</mark>
                                    <img src="/../img/icons/tick.svg" class="svg svg-check" alt="">
                                </div>
                                <span>Ласточка</span>
                            </a>
                        </div>
                        <h2>Отжимания</h2>
                        <p>Этот тип нагрузки позволяет измерить силу и прочность грудных мышц, плеч и трицепсов, а также
                            выносливость этих мышечных групп. Необходимое оборудование: таймер для отсчитывания 1 минуты
                            на выполнение упражнения.</p>
                        <div class="videoWrapper">
                            <iframe width="560" height="349" src="http://www.youtube.com/embed/n_dZNLr2cME?rel=0&hd=1"
                                    frameborder="0" allowfullscreen></iframe>
                        </div>
                        <h3>Как провильно зафиксировать данные для расчета индекса Руфье</h3>
                        <p>Для расчета необходимо определить три пробы Руфье. У испытуемого, находящегося в положении
                            лежа на спине в течение 5 мин, определяют число пульсаций за 15 с (P1); затем в течение 45 с
                            испытуемый выполняет 30 приседаний. После окончания нагрузки испытуемый ложится, и у него
                            вновь подсчитывается число пульсаций за первые 15 с (Р2), а потом — за последние 15 с первой
                            минуты периода восстановления (Р3).</p>

                        <div class="row test-form-wrap">
                            <div class="col-sm-4"></div>
                            <div class="col-sm-4">
                                <div class="account-data-form-row">
                                    <label for="test3">Количество</label>
                                    <input id="test3" type="number" value="{{$physicalMetricsLast->pushups}}" name="pushups">
                                    <span>раз./мин.</span>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>
                <div class="next-step-button">
                    <input type="submit" class="btn" value="Далее">
                </div>
            </form>
        </div>


        @include('partials.events',[
            'itemsEvents' => $itemsEvents
        ])
        </div>
    </main>
@endsection
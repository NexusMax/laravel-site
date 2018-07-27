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

            <form action="{{ route('physical-step',['step' => 5]) }}" class="account-form" method="POST"
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
                        <a href="{{route('physical-step',['step' => 3])}}" class="detail-info-step check">
                            <div class="detail-info-icon">
                                <mark>3</mark>
                                <img src="/../img/icons/tick.svg" class="svg svg-check" alt="">
                            </div>
                            <span>Отжимания</span>
                        </a>
                        <a href="{{route('physical-step',['step' => 4])}}" class="detail-info-step active">
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

                    <h2>Сит-апы</h2>
                    <p>Этот вид нагрузки помогает измерить силу и выносливость мышц живота. Преимущество этого упражнения — в том, что оно может быть выполнено в любом месте. Необходимое оборудование: таймер для отсчитывания одной полной минуты.</p>
                    <div class="videoWrapper">
                        <iframe width="560" height="349" src="http://www.youtube.com/embed/n_dZNLr2cME?rel=0&hd=1" frameborder="0" allowfullscreen></iframe>
                    </div>
                    <p>Цель: выполнить максимально возможное количество скручиваний за 1 минуту.</p>

                    <div class="row test-form-wrap">
                        <div class="col-sm-4"></div>
                        <div class="col-sm-4">
                            <div class="account-data-form-row">
                                <label for="test3">Количество</label>
                                <input id="test3" type="number" value="{{$physicalMetricsLast->twisting}}" name="twisting">
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

            @include('partials.events',[
                'itemsEvents' => $itemsEvents
            ])
        </div>
    </main>
@endsection
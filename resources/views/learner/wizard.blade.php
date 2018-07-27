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
                        <div class="db-container">
                            <div class="top-info-wrapper">
                                <div class="top-info-col">
                                    <div class="top-info-img">
                                        <img src="/../../img/icons/man.svg" class="svg" alt="">
                                    </div>
                                    <div class="top-info-text">
                                        <div class="top-info-anthropometric-data">
                                            <div class="top-info-text-col">
                                                <span>173</span>
                                                <em>рост</em>
                                            </div>
                                            <div class="top-info-text-col">
                                                <span>76</span>
                                                <em>вес</em>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="top-info-col">
                                    <div class="top-info-img">
                                        <img src="/../../img/icons/target.svg" class="svg svg-rotate" alt="">
                                    </div>
                                    <div class="top-info-text">
                                        <span>Форма и рельеф</span>
                                        <em>результат</em>
                                    </div>
                                </div>
                                <div class="top-info-col">
                                    <div class="top-info-img">
                                        <img src="/../../img/icons/calendar.svg" class="svg" alt="">
                                    </div>
                                    <div class="top-info-text">
                                        <span>Пн Чт</span>
                                        <em>дни недели</em>
                                    </div>
                                </div>
                                <div class="top-info-col">
                                    <div class="top-info-img">
                                        <img src="/../../img/icons/muscles.svg" class="svg" alt="">
                                    </div>
                                    <div class="top-info-text">
                                        <span>Среднее</span>
                                        <em>физическое состояние</em>
                                    </div>
                                </div>
                            </div>
                            <div class="number-test constructor-steps">
                                <a href="constructor.html" class="active">1</a>
                                <a href="constructor-step2.html">2</a>
                                <a href="constructor-step3.html">3</a>
                                <a href="constructor-step4.html">4</a>
                            </div>
                            <div class="constructor-steps-wrapper constructor-step1" style="min-height: 45vh;">
                                <div class="constructor-steps-top">
                                    <span>Быстрый Сфинкс, full body</span>
                                    <img src="/../../img/icons/pencil.svg" class="svg" alt="">
                                </div>
                                <div class="constructor-step1-row">
                                    <div class="constructor-step1-col">
                                        <div class="dropdown dropdown-constructor">
                                            <button type="button" data-toggle="dropdown" class="dropdown-toggle"
                                                    aria-expanded="true">
                                                <span class="constructor-label">День недели</span>
                                                <em></em>
                                                <img src="/../../img/icons/icon-arrow.png" alt="">
                                                <img src="/../../img/icons/pencil.svg" class="svg" alt="">
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li><a href="#">Понедельник</a></li>
                                                <li><a href="#">Вторник</a></li>
                                                <li><a href="#">Среда</a></li>
                                                <li><a href="#">Четверг</a></li>
                                                <li><a href="#">Пятница</a></li>
                                                <li><a href="#">Суббота</a></li>
                                                <li><a href="#">Воскресеьне</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="constructor-step1-col">
                                        <div class="constructor-step-wrap">
                                            <span class="constructor-label">Время начала тренировки</span>
                                            <img src="/../../img/icons/icon-arrow.png" alt="">
                                            <input type="time">
                                        </div>
                                    </div>
                                    <div class="constructor-step1-col">
                                        <div class="dropdown dropdown-constructor">
                                            <button type="button" data-toggle="dropdown" class="dropdown-toggle"
                                                    aria-expanded="true">
                                                <span class="constructor-label">Тренировки</span>
                                                <em></em>
                                                <img src="/../../img/icons/icon-arrow.png" alt="">
                                                <img src="/../../img/icons/pencil.svg" class="svg" alt="">
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-training">
                                                <div class="select-training">
                                                    <ul>
                                                        <li><a href="#" class="active">Грудь</a></li>
                                                        <li><a href="#">Плечи</a></li>
                                                        <li><a href="#">Руки</a></li>
                                                        <li><a href="#">Ноги</a></li>
                                                        <li><a href="#">Спина</a></li>
                                                        <li><a href="#">Все тело</a></li>
                                                    </ul>
                                                    <div class="icon-plus">+</div>
                                                    <ul>
                                                        <li><a href="#">Грудь</a></li>
                                                        <li><a href="#">Плечи</a></li>
                                                        <li><a href="#" class="active">Руки</a></li>
                                                        <li><a href="#">Ноги</a></li>
                                                        <li><a href="#">Спина</a></li>
                                                        <li><a href="#">Все тело</a></li>
                                                    </ul>
                                                    <div class="icon-plus">+</div>
                                                    <ul>
                                                        <li><a href="#">Грудь</a></li>
                                                        <li><a href="#">Плечи</a></li>
                                                        <li><a href="#">Руки</a></li>
                                                        <li><a href="#">Ноги</a></li>
                                                        <li><a href="#" class="active">Спина</a></li>
                                                        <li><a href="#">Все тело</a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="constructor-step1-col">
                                        <div class="dropdown dropdown-constructor">
                                            <button type="button" data-toggle="dropdown" class="dropdown-toggle"
                                                    aria-expanded="true">
                                                <span class="constructor-label">Продолжительность тренировки</span>
                                                <em></em>
                                                <img src="/../../img/icons/icon-arrow.png" alt="">
                                                <img src="/../../img/icons/pencil.svg" class="svg" alt="">
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li><a href="#">30 мин</a></li>
                                                <li><a href="#">1 час</a></li>
                                                <li><a href="#">1 час 30 мин</a></li>
                                                <li><a href="#">2 часа</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="constructor-step1-col">
                                        <div class="dropdown dropdown-constructor">
                                            <button type="button" data-toggle="dropdown" class="dropdown-toggle"
                                                    aria-expanded="true">
                                                <span class="constructor-label">Формат</span>
                                                <em></em>
                                                <img src="/../../img/icons/icon-arrow.png" alt="">
                                                <img src="/../../img/icons/pencil.svg" class="svg" alt="">
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li><a href="#">С оборудованием</a></li>
                                                <li><a href="#">Без оборудования</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>
            </div>


            @include('partials.events',[
                'itemsEvents' => $itemsEvents
            ])
        </div>
    </main>
@endsection
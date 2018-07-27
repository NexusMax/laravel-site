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
                            <div class="acc-title">
                                <span class="account-title">Текущие тренировки</span>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <a href="training-unit.html" class="training-col">
                                        <div class="training-col-heading"
                                             style="background-image: url('/../../img/events3.png');">
                                            <div class="training-buttons">
                                                <div class="training-button-wrap" title="В архив">
                                                    <img src="/../../img/icons/book.svg" class="svg" alt="">
                                                </div>
                                                <div class="training-button-wrap" title="Распечатать">
                                                    <img src="/../../img/icons/printer.svg" class="svg" alt="">
                                                </div>
                                                <div class="training-button-wrap" title="Копировать">
                                                    <img src="/../../img/icons/copy.svg" class="svg" alt="">
                                                </div>
                                                <div class="training-button-wrap" title="Редактировать">
                                                    <img src="/../../img/icons/edit.svg" class="svg" alt="">
                                                </div>
                                            </div>
                                            <span>Быстрый Сфинкс, <br>full body</span>
                                        </div>
                                        <div class="training-col-body">
                                            <div class="training-body-top d-flex-wrap">
                                                <span>Понедельник</span>
                                                <span>18:30</span>
                                            </div>
                                            <div class="training-body-row">
                                                <span>Грудь + Руки</span>
                                            </div>
                                            <div class="training-body-row">
                                                <span>1 час 30 мин</span>
                                            </div>
                                            <div class="training-body-row">
                                                <span>Без оборудования</span>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-md-6">
                                    <a href="#" class="training-col">
                                        <div class="training-col-heading"
                                             style="background-image: url('/../../img/events3.png');">
                                            <div class="training-buttons">
                                                <div class="training-button-wrap" title="В архив">
                                                    <img src="/../../img/icons/book.svg" class="svg" alt="">
                                                </div>
                                                <div class="training-button-wrap" title="Распечатать">
                                                    <img src="/../../img/icons/printer.svg" class="svg" alt="">
                                                </div>
                                                <div class="training-button-wrap" title="Копировать">
                                                    <img src="/../../img/icons/copy.svg" class="svg" alt="">
                                                </div>
                                                <div class="training-button-wrap" title="Редактировать">
                                                    <img src="/../../img/icons/edit.svg" class="svg" alt="">
                                                </div>
                                            </div>
                                            <span>Отжимания сфинкс</span>
                                        </div>
                                        <div class="training-col-body">
                                            <div class="training-body-top d-flex-wrap">
                                                <span>Понедельник</span>
                                                <span>18:30</span>
                                            </div>
                                            <div class="training-body-row">
                                                <span>Руки</span>
                                            </div>
                                            <div class="training-body-row">
                                                <span>30 мин</span>
                                            </div>
                                            <div class="training-body-row">
                                                <span>Без оборудования</span>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <a href="#" class="training-col">
                                        <div class="training-col-heading"
                                             style="background-image: url('/../../img/events3.png');">
                                            <div class="training-buttons">
                                                <div class="training-button-wrap" title="В архив">
                                                    <img src="/../../img/icons/book.svg" class="svg" alt="">
                                                </div>
                                                <div class="training-button-wrap" title="Распечатать">
                                                    <img src="/../../img/icons/printer.svg" class="svg" alt="">
                                                </div>
                                                <div class="training-button-wrap" title="Копировать">
                                                    <img src="/../../img/icons/copy.svg" class="svg" alt="">
                                                </div>
                                                <div class="training-button-wrap" title="Редактировать">
                                                    <img src="/../../img/icons/edit.svg" class="svg" alt="">
                                                </div>
                                            </div>
                                            <span>Выпады шагом назад</span>
                                        </div>
                                        <div class="training-col-body">
                                            <div class="training-body-top d-flex-wrap">
                                                <span>Четверг</span>
                                                <span>19:30</span>
                                            </div>
                                            <div class="training-body-row">
                                                <span>Ноги</span>
                                            </div>
                                            <div class="training-body-row">
                                                <span>45 мин</span>
                                            </div>
                                            <div class="training-body-row">
                                                <span>Без оборудования</span>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-md-6">
                                    <a href="#" class="training-col">
                                        <div class="training-col-heading"
                                             style="background-image: url('/../../img/events3.png');">
                                            <div class="training-buttons">
                                                <div class="training-button-wrap" title="В архив">
                                                    <img src="/../../img/icons/book.svg" class="svg" alt="">
                                                </div>
                                                <div class="training-button-wrap" title="Распечатать">
                                                    <img src="/../../img/icons/printer.svg" class="svg" alt="">
                                                </div>
                                                <div class="training-button-wrap" title="Копировать">
                                                    <img src="/../../img/icons/copy.svg" class="svg" alt="">
                                                </div>
                                                <div class="training-button-wrap" title="Редактировать">
                                                    <img src="/../../img/icons/edit.svg" class="svg" alt="">
                                                </div>
                                            </div>
                                            <span>Сит-ап с касанием пяток</span>
                                        </div>
                                        <div class="training-col-body">
                                            <div class="training-body-top d-flex-wrap">
                                                <span>Четверг</span>
                                                <span>18:00</span>
                                            </div>
                                            <div class="training-body-row">
                                                <span>Ноги</span>
                                            </div>
                                            <div class="training-body-row">
                                                <span>15 мин</span>
                                            </div>
                                            <div class="training-body-row">
                                                <span>Без оборудования</span>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="acc-title">
                                <span class="account-title">Архив тренировок</span>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <a href="#" class="training-col">
                                        <div class="training-col-heading"
                                             style="background-image: url('/../../img/events3.png');">
                                            <div class="training-buttons">
                                                <div class="training-button-wrap" title="Вернуть в текущие">
                                                    <img src="/../../img/icons/undo.svg" class="svg" alt="">
                                                </div>
                                                <div class="training-button-wrap" title="Распечатать">
                                                    <img src="/../../img/icons/printer.svg" class="svg" alt="">
                                                </div>
                                                <div class="training-button-wrap" title="Копировать">
                                                    <img src="/../../img/icons/copy.svg" class="svg" alt="">
                                                </div>
                                                <div class="training-button-wrap" title="Редактировать">
                                                    <img src="/../../img/icons/edit.svg" class="svg" alt="">
                                                </div>
                                            </div>
                                            <span>Быстрый Сфинкс, <br>full body</span>
                                        </div>
                                        <div class="training-col-body">
                                            <div class="training-body-top d-flex-wrap">
                                                <span>Понедельник</span>
                                                <span>18:30</span>
                                            </div>
                                            <div class="training-body-row">
                                                <span>Грудь + Руки</span>
                                            </div>
                                            <div class="training-body-row">
                                                <span>1 час 30 мин</span>
                                            </div>
                                            <div class="training-body-row">
                                                <span>Без оборудования</span>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-md-6">
                                    <a href="#" class="training-col">
                                        <div class="training-col-heading"
                                             style="background-image: url('/../../img/events3.png');">
                                            <div class="training-buttons">
                                                <div class="training-button-wrap" title="Вернуть в текущие">
                                                    <img src="/../../img/icons/undo.svg" class="svg" alt="">
                                                </div>
                                                <div class="training-button-wrap" title="Купить">
                                                    <img src="/../../img/icons/padlock.svg" class="svg" alt="">
                                                </div>
                                            </div>
                                            <span>Как правильно расчитать нагрузку</span>
                                        </div>
                                        <div class="training-col-body">
                                            <div class="training-body-top d-flex-wrap">
                                                <span>Антон Суржан</span>
                                                <span>18.10.2017</span>
                                            </div>
                                            <div class="training-body-row">
                                                <span>Уровень доступа: Премиум контент</span>
                                            </div>
                                            <div class="training-body-row">
                                                <p>Lorem ipsum dolor sit ame consecte tur adipiscing ipsum dolor
                                                    elit. </p>
                                            </div>
                                        </div>
                                    </a>
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
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
                            <div class="calendar-main-wrapper">
                                <div id="calendar"></div>
                                <div class="detail-train-popup">
                                    <div class="train-popup-heading">
                                        <span>Быстрый Сфинкс</span>
                                        <a href="#" class="edit-train">
                                            <img src="img/icons/edit.svg" class="svg" alt="">
                                        </a>
                                    </div>
                                    <div class="train-popup-body">
                                        <span>Суббота, 20 января</span>
                                        <span>Время: 19:00 - 20:30</span>
                                        <span>Длительность: 1 час 30 мин</span>
                                    </div>
                                </div>
                            </div>
                            <div class="calendar-hints">
                                <div class="calendar-hint-block">
                                    <div class="hint-square color1"></div>
                                    <span>- Тренировки</span>
                                </div>
                                <div class="calendar-hint-block">
                                    <div class="hint-square color2"></div>
                                    <span>- Обновление информации</span>
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
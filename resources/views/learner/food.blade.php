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
                            <div class="rates-top-wrapper d-flex-wrap">
                                <span class="account-title">Питание</span>
                                <mark>Масса тела: <span class="account-title">70 кг</span></mark>
                            </div>
                            <div class="rates-wrapper food-wrapper">
                                <p>Pri <span>2000 калорий в день</span> consectetuer eu. Graeco periculis ad eum, vix
                                    tamquam omittam cu. At hinc summo tritani quo. Id percipit intellegebat eam, qui ex
                                    augue euismod. Sit an quando audire civibus. Ei cum nihil prodesset necessitatibus,
                                    adhuc legere voluptua pro ex. Cu vel denique prodesset scripserit.</p>
                                <div class="download-wrapper d-flex-wrap">
                                    <div class="file-name">
                                        <img src="/../../img/icons/download.svg" class="svg" alt="">
                                        <span>Название файла.pdf</span>
                                    </div>
                                    <a href="/../../img/avatar.png" class="btn-gray" download>Скачать</a>
                                </div>
                                <ul class="food-tabs">
                                    <li class="active">
                                        <a href="#">Завтрак</a>
                                    </li>
                                    <li>
                                        <a href="#">Перекус 1</a>
                                    </li>
                                    <li>
                                        <a href="#">Обед</a>
                                    </li>
                                    <li>
                                        <a href="#">Перекус 2</a>
                                    </li>
                                    <li>
                                        <a href="#">Ужин</a>
                                    </li>
                                    <li>
                                        <a href="#">Поздний ужин</a>
                                    </li>
                                </ul>
                                <p>Рекомендации по порции: вес - <span>350 г</span>, белки/жиры/углеводы - <span>60/50/70 в 100 г</span>,
                                    калории - <span>500 в 100 г</span></p>
                                <div class="table-food-wrapper">
                                    <p><span>Вариант 1</span></p>
                                    <table class="food-table">
                                        <tbody>
                                        <tr>
                                            <td>Продукт 1 / Продукт 2 / Продукт 3</td>
                                            <td>~ 200 г</td>
                                        </tr>
                                        <tr>
                                            <td>Продукт 4 / Продукт 5 / Продукт 6 / Продукт 7</td>
                                            <td>~ 100 г</td>
                                        </tr>
                                        <tr>
                                            <td>Продукт 8 / Продукт 9</td>
                                            <td>~ 50 г</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="table-food-wrapper">
                                    <p><span>Вариант 2</span></p>
                                    <table class="food-table">
                                        <tbody>
                                        <tr>
                                            <td>Продукт 1 / Продукт 2 / Продукт 3</td>
                                            <td>~ 200 г</td>
                                        </tr>
                                        <tr>
                                            <td>Продукт 4 / Продукт 5 / Продукт 6 / Продукт 7</td>
                                            <td>~ 100 г</td>
                                        </tr>
                                        <tr>
                                            <td>Продукт 8 / Продукт 9</td>
                                            <td>~ 50 г</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="table-food-wrapper">
                                    <p><span>Список рекомендуемых продуктов</span></p>
                                    <div class="table-overflow">
                                        <table class="food-table food-table-recommend">
                                            <thead>
                                            <tr>
                                                <td>Продукт</td>
                                                <td>белки <br> в 100 г</td>
                                                <td>жиры <br> в 100 г</td>
                                                <td>углеводы <br> в 100 г</td>
                                                <td>калорий <br> в 100 г</td>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <td>Продукт 1</td>
                                                <td>22</td>
                                                <td>33</td>
                                                <td>55</td>
                                                <td>44</td>
                                            </tr>
                                            <tr>
                                                <td>Продукт 2</td>
                                                <td>22</td>
                                                <td>33</td>
                                                <td>55</td>
                                                <td>44</td>
                                            </tr>
                                            <tr>
                                                <td>Продукт 3</td>
                                                <td>22</td>
                                                <td>33</td>
                                                <td>55</td>
                                                <td>44</td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="next-step-button">
                            <a href="/../../img/avatar.png" class="btn-gray btn-food" download>Скачать план питания</a>
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


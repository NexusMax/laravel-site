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
                        <form action="{{ route('step',['step' => 2]) }}" class="account-form" method="POST" enctype="multipart/form-data" id="myaccount-form-inf">
                        <div class="db-container">
                            <div class="detail-info-progressbar">
                                <div class="progress-line">
                                    <div class="progressbar"></div>
                                </div>
                                <a href="{{ route('detail') }}" class="detail-info-step active">
                                    <div class="detail-info-icon">
                                        <img src="/../../img/icons/fingerprint.svg" class="svg svg-default" alt="">
                                        <img src="/../../img/icons/tick.svg" class="svg svg-check" alt="">
                                    </div>
                                    <span>Персональные данные</span>
                                </a>
                                <a href="{{ route('step',['step' => 2 ]) }}" class="detail-info-step">
                                    <div class="detail-info-icon">
                                        <img src="/../../img/icons/target.svg" class="svg svg-rotate svg-default"
                                             alt="">
                                        <img src="/../../img/icons/tick.svg" class="svg svg-check" alt="">
                                    </div>
                                    <span>Цель</span>
                                </a>
                                <a href="{{ route('step',['step' => 3 ]) }}" class="detail-info-step">
                                    <div class="detail-info-icon">
                                        <img src="/../../img/icons/muscles.svg" class="svg svg-default" alt="">
                                        <img src="/../../img/icons/tick.svg" class="svg svg-check" alt="">
                                    </div>
                                    <span>Физическое состояние</span>
                                </a>
                                <a href="{{ route('step',['step' => 4 ]) }}" class="detail-info-step">
                                    <div class="detail-info-icon">
                                        <img src="/../../img/icons/cardiogram.svg" class="svg svg-default" alt="">
                                        <img src="/../../img/icons/tick.svg" class="svg svg-check" alt="">
                                    </div>
                                    <span>Здоровье</span>
                                </a>
                                <a href="{{ route('step',['step' => 5 ]) }}" class="detail-info-step">
                                    <div class="detail-info-icon">
                                        <img src="/../../img/icons/fitness.svg" class="svg svg-default" alt="">
                                        <img src="/../../img/icons/tick.svg" class="svg svg-check" alt="">
                                    </div>
                                    <span>Телосложение</span>
                                </a>
                            </div>
                            <div class="personal-data">


                                    {{ csrf_field() }}

                                    <span class="account-title">Персональные данные</span>
                                    <div class="row account-detail-row">
                                        <div class="col-sm-4">
                                            <div class="account-data-form-row">
                                                <label for="acc-data1">Имя</label>
                                                <input id="acc-data1" name="firstname" type="text" value="{{$user->name}}"
                                                       placeholder="Введите имя">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="account-data-form-row">
                                                <label for="acc-data2">Фамилия</label>
                                                <input id="acc-data2" name="lastname" type="text" value="{{$user->lastname}}"
                                                       placeholder="Введите фамилию">
                                            </div>
                                        </div>

                                    </div>
                                    <div class="row account-detail-row">
                                        <div class="col-sm-4">
                                            <div class="account-data-form-row">
                                                <label for="acc-data4">Ник</label>
                                                <input id="acc-data4" type="text" name="nickname" value="{{$extraFields->nickname}}"
                                                       placeholder="Введите ник">
                                            </div>
                                        </div>

                                        <div class="col-sm-4">

                                        </div>



                                    </div>
                                    <div class="row account-detail-row">
                                        <div class="col-sm-4">
                                            <div class="account-data-form-row">
                                                <label for="acc-data6">Рост</label>
                                                <input id="acc-data6" type="number" name="growth" value="{{$extraFields->growth}}"
                                                       placeholder="Какой у вас рост?">
                                                <span>см</span>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="account-data-form-row">
                                                <label for="acc-data7">Вес</label>
                                                <input id="acc-data7" type="number" name="weight" value="{{$extraFields->weight}}"
                                                       placeholder="Какой у вас вес?">
                                                <span>кг</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row account-detail-row">
                                        <div class="col-xs-12">
                                            <div class="account-data-form-row">
                                                <label>Пол</label>
                                                <div class="sex-wrapper">
                                                    <div class="sex-input radio-input-wrapper">
                                                        <input id="male1" type="radio" name="gender" value="0" @if ($user->gender == 0) checked @endif>
                                                        <label for="male1">Мужчина</label>
                                                    </div>
                                                    <div class="sex-input radio-input-wrapper">
                                                        <input id="female1" type="radio" name="gender" value="1" @if ($user->gender == 1) checked @endif>
                                                        <label for="female1">Женщина</label>
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

                    </div>


                </div>
            </div>


            @include('partials.events',[
                'itemsEvents' => $itemsEvents
            ])
        </div>
    </main>
@endsection
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
                        <form action="{{ route('step',['step' => 6]) }}" class="account-form" method="POST" enctype="multipart/form-data" id="myaccount-form-inf">
                            {{ csrf_field() }}
                            <div class="db-container">
                                <div class="detail-info-progressbar">
                                    <div class="progress-line">
                                        <div class="progressbar" style="width: 100%;"></div>
                                    </div>
                                    <a href="{{ route('detail') }}" class="detail-info-step check">
                                        <div class="detail-info-icon">
                                            <img src="/../../img/icons/fingerprint.svg" class="svg svg-default" alt="">
                                            <img src="/../../img/icons/tick.svg" class="svg svg-check" alt="">
                                        </div>
                                        <span>Персональные данные</span>
                                    </a>
                                    <a href="{{ route('step',['step' => 2 ]) }}"  class="detail-info-step check">
                                        <div class="detail-info-icon">
                                            <img src="/../../img/icons/target.svg" class="svg svg-rotate svg-default"
                                                 alt="">
                                            <img src="/../../img/icons/tick.svg" class="svg svg-check" alt="">
                                        </div>
                                        <span>Цель</span>
                                    </a>
                                    <a href="{{ route('step',['step' => 3 ]) }}"  class="detail-info-step check">
                                        <div class="detail-info-icon">
                                            <img src="/../../img/icons/muscles.svg" class="svg svg-default" alt="">
                                            <img src="/../../img/icons/tick.svg" class="svg svg-check" alt="">
                                        </div>
                                        <span>Физическое состояние</span>
                                    </a>
                                    <a href="{{ route('step',['step' => 4 ]) }}"  class="detail-info-step check">
                                        <div class="detail-info-icon">
                                            <img src="/../../img/icons/cardiogram.svg" class="svg svg-default" alt="">
                                            <img src="/../../img/icons/tick.svg" class="svg svg-check" alt="">
                                        </div>
                                        <span>Здоровье</span>
                                    </a>
                                    <a href="{{ route('step',['step' => 5 ]) }}"  class="detail-info-step active">
                                        <div class="detail-info-icon">
                                            <img src="/../../img/icons/fitness.svg" class="svg svg-default" alt="">
                                            <img src="/../../img/icons/tick.svg" class="svg svg-check" alt="">
                                        </div>
                                        <span>Телосложение</span>
                                    </a>
                                </div>
                                <div class="physical-state-row">
                                    <span class="account-title">Телосложения</span>
                                    <div class="physical-state-text">
                                        <em>Тип телосложения</em>
                                    </div>
                                    @if ($user->gender ==1)
                                    <div class="sex-wrapper typebody-wrapper row">
                                        <div class="col-sm-4">
                                            <div class="sex-input radio-input-wrapper">
                                                <input id="lbl4" type="radio" name="bodytype" value="1" @if ($extraFields->body_type == 1) checked @endif>
                                                <label for="lbl4">
                                                    <img src="/../../img/icons/w1.svg" class="svg" alt="">
                                                    Эктоморф
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="sex-input radio-input-wrapper">
                                                <input id="lbl5" type="radio" name="bodytype" value="2" @if ($extraFields->body_type == 2) checked @endif>
                                                <label for="lbl5">
                                                    <img src="/../../img/icons/w2.svg" class="svg" alt="">
                                                    Мезоморф
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="sex-input radio-input-wrapper">
                                                <input id="lbl6" type="radio" name="bodytype" value="3" @if ($extraFields->body_type == 3) checked @endif>
                                                <label for="lbl6">
                                                    <img src="/../../img/icons/w3.svg" class="svg" alt="">
                                                    Эндоморф
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    @endif

                                    @if($user->gender==0)
                                    <div class="sex-wrapper typebody-wrapper row">
                                        <div class="col-sm-4">
                                            <div class="sex-input radio-input-wrapper">
                                                <input id="lbl7" type="radio" name="bodytype" value="1" @if ($extraFields->body_type == 1) checked @endif>
                                                <label for="lbl7">
                                                    <img src="/../../img/icons/m1.svg" class="svg" alt="">
                                                    Эктоморф
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="sex-input radio-input-wrapper">
                                                <input id="lbl8" type="radio" name="bodytype" value="2" @if ($extraFields->body_type == 2) checked @endif>
                                                <label for="lbl8">
                                                    <img src="/../../img/icons/m2.svg" class="svg" alt="">
                                                    Мезоморф
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="sex-input radio-input-wrapper">
                                                <input id="lbl9" type="radio" name="bodytype" value="3" @if ($extraFields->body_type == 3) checked @endif>
                                                <label for="lbl9">
                                                    <img src="/../../img/icons/m3.svg" class="svg" alt="">
                                                    Эндоморф
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- endif man -->
                                    @endif
                                </div>
                                <div class="physical-state-row">
                                    <div class="physical-state-text">
                                        <em>Обхват запястья</em>
                                    </div>
                                    <div class="sex-wrapper typebody-wrapper-bottom row">
                                        <div class="col-md-4">
                                            <div class="sex-input radio-input-wrapper">
                                                <input id="lbl1" type="radio" name="wristsize" value="1" @if ($extraFields->wrist_size == 1) checked @endif>
                                                <label for="lbl1">менее 18 см</label>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="sex-input radio-input-wrapper">
                                                <input id="lbl2" type="radio" name="wristsize" value="2" @if ($extraFields->wrist_size == 2) checked @endif>
                                                <label for="lbl2">18-20 см</label>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="sex-input radio-input-wrapper">
                                                <input id="lbl3" type="radio" name="wristsize" value="3" @if ($extraFields->wrist_size == 3) checked @endif>
                                                <label for="lbl3">более 20 см</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="next-step-button">
                                <input type="submit" class="btn" value="Узнать результат">
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
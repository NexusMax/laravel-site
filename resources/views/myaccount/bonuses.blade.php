<?php

?>
@extends('layouts.app')

@section('content')
 

<section class="h-events" style="background-image: url('/../../img/dasha.png')">
    <div class="container">
        <div class="row">
            <h1 class="title wow fadeInUp">Бонусная программа Sport<span class="color-casta">Casta</span></h1>
            
        </div>
    </div>
</section>

<section class="content article-content-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-lg-9">
                <div class="article-content">
                    <h2>Как накапливать бонусы</h2>
                    <p>Выполняя различные действия на сайте, ты зарабатываешь определенное количество бонусов.</p>
                    <p>100 sc (бонусов SportCasta) эквивалентны 1 $</p>
                    <ol>
                        <li>Регистрация на сайте – 100 sc ;</li>
                        <li>Расшаривание информации с сайта на личных страницах в соцсетях – 20 sc за каждый пост;</li>
                        <li>Приобретая участие в онлайн-вебинаре, ты получаешь возврат в размере 10% от его стоимости на лицевой счет в виде бонусов sc;</li>
                        <li>Заполнение личного профиля на сайте: чем лучше заполнен – тем больше бонусов. За каждое действие начисляется 10 sc;</li>
                        <li>Реферальная программа. В личном кабинете ты найдешь свою реферальную ссылку. Копируй и отправляй ее своим друзьям. Как только твой друг переходит по этой ссылке на сайт, тебе сразу начисляется 50 sc.</li>
                    </ol>
                    <img src="/img/vova.png" alt="Вова" width="1166" height="500">
                    <h2>Как использовать бонусы</h2>
                    <p>Бонусы sc - это внутренняя валюта сообщества SPORTCASTA и ты можешь использовать их для оплаты премиум-контента (приобретая подписку) и онлайн-вебинаров.</p>
                    <h2>Срок действия бонусов</h2>
                    <p>Твои бонусы sc никогда не потеряют свою актуальность и будут действительны в течение всего срока твоего пребывания в сообществе SPORTCASTA.</p>

                </div>
            </div>
            <div class="col-lg-3">
                @include('partials.sidebar', [
                    'categories' => $categories,
                    'popularItems' => $popularItems
                ])
            </div>
        </div>
    </div>
</section>


@endsection
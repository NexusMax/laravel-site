<?php
use App\Items;
use App\ItemsEvents;

$popularItems = Items::with('category')
    ->with('user')
//            ->where('role_id', $this->currentRole)
    ->where('published', 1)
    ->orderBy('views', 'desc')
    ->limit(6)
    ->get();

$itemsEvents = ItemsEvents::where('published', 1)
    // ->where('role_id', $this->currentRole)
    ->where('created_at', '<', date('Y-m-d H-i-s', strtotime('+1 month')))
    ->where('created_at', '>', date('Y-m-d H-i-s', time()))
    ->orderBy('created_at', 'asc')
    ->limit(6)
    ->get();

?>
@extends('layouts.app')

@section('content')

    <section class="h-events" style="background-image: url('/../img/events_bg.jpg')">
        <div class="container">
            <div class="row">
                <h2 class="title wow fadeInUp">{!! 'К сожалению ничего не найдено' !!}</h2>
                    {{ Breadcrumbs::render('404') }}
            </div>
        </div>
    </section>

    <section class="events-wrapper clearfix">
        <div class="container">
            <div class="row clearfix">
                <div id="pjax-container">

                        <div class="col-lg-12" style="text-align: center;">
                            <h1>Ничего не найдено (404)</h1>
                        </div>

                </div>
            </div>
        </div>
    </section>


    @if(!empty($itemsEvents))
        @include('partials.events',[
            'itemsEvents' => $itemsEvents
        ])
    @endif


    @if(!empty($popularItems))

        <section class="s-new">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-md-12">
                        <h3 class="titleh3 wow fadeInUp s-new_title">Популярные материалы</h3>
                        <p class="s-team_descr">В открытом доступе вы найдете много статей и полезного видео-контента из области спорта, диетологии, медицины и психологии.</p>
                        <div class="s-new_slider">
                            <div class="owl-carousel owl-carousel2 owl-theme">
                                @include('partials.slider-item',['items' => $popularItems])
                            </div>
                        </div>
                    </div>
                    @guest
                    <div class="col-lg-12 col-md-12">
                        <div class="btn-wrapper">
                            <a href="#" data-mfp-src="#popup-special_propos" class="popup-with-form btn s-new_btn wow fadeIn">Подписка на обновления</a>
                        </div>
                    </div>
                    @endguest
                </div>
            </div>
        </section>

    @endif

@endsection
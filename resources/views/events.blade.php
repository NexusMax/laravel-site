<?php

use Jenssegers\Date\Date;
Date::setLocale('ru');
?>

@extends('layouts.app')

@section('content')
<div id="pjax-main">
    @include('partials.pagelogo', ['title' => $title, 'background' => '/../img/events_bg.jpg', 'breadcrumbs' => $events[0]])

    <div class="events-wrapper clearfix">
        <div class="container">
            <div class="row clearfix">
                <div id="pjax-container">
                <div class="training-content">
                    <ul class="tabs box-shadow">
                        <li class="tab {{ Request::route()->getName() === 'events' ? 'active' : '' }}"><a href="{{ route('events') }}">Все события</a></li>
                        <li class="divider"></li>
                        <li class="tab {{ Request::route()->getName() === 'events/current' ? 'active' : '' }}"><a href="{{ route('events/current') }}">Текущие</a></li>
                        <li class="divider"></li>
                        <li class="tab {{ Request::route()->getName() === 'events/future' ? 'active' : '' }}"><a href="{{ route('events/future') }}">Ближайшие</a></li>
                        <li class="divider"></li>
                        <li class="tab {{ Request::route()->getName() === 'events/past' ? 'active' : '' }}"><a href="{{ route('events/past') }}">Прошедшие</a></li>
                    </ul>

                    @include('partials.search')

                    @foreach($events as $key)

                    <?php
                        $end_at = new Date($key['end_at']);
                        $created_at = new Date($key['created_at']);
                    ?>

                    <div class="training-item wow slideInLeft clearfix box-shadow">
                        <div class="img-wrapper">
                            <div class="mask">
                                <a href="{{ route('events/view', ['alias' => $key['alias']]) }}"><img src="/img/{{ $key['img'] }}" alt="{{ $key['name'] }}"></a>
                                @if($key['without_date'])
                                    <span class="events-date"><i class="skoro">Скоро</i></span>
                                @else
                                    <span class="events-month">{{ $created_at->format('F') }}</span>
                                    <span class="events-date">{{ $created_at->format('d') }}</span>
                                    <span class="events-day">{{ $created_at->format('l') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="training-item_text">
                            <a href="{{ route('events/view', ['alias' => $key['alias']]) }}"><div class="title">{{ $key['name'] }}</div></a>
                            @if(!$key['without_date'])
                            <div class="cat"><strong> Время:</strong> {{ $created_at->format('H:i')  }} - {{ $end_at->format('H:i') }}</div>
                            @endif
                            <p>{!! strip_tags(mb_substr($key['intro'], 0 , 120)) . '...' !!}</p>
                            <a href="{{ route('events/view', ['alias' => $key['alias']]) }}">Узнать больше <i class="fa fa-long-arrow-right" aria-hidden="true"></i></a>
                        </div>
                    </div>
                    @endforeach

                    {{ $events->links('vendor.pagination.default') }}


                </div>
                </div>

                <aside class="training-sidebar training-sidebar">
                    <div class="title">Календарь событий</div>
                    <div class="calendar"></div>
                    <script>
                        window.onload = function(){
                            calendar();

                            $(document).on('pjax:end', function(){
                                calendar();
                            });
                        };

                        function calendar(){
                            $('.calendar').eCalendar({
                                events: [
                                        @foreach($allEvents as $key)
                                    {
                                        datetime: new Date(
                                            '{{ date('Y', strtotime($key['created_at'])) }}',
                                            '{{ date('m', strtotime($key['created_at'])) - 1 }}',
                                            '{{ date('d', strtotime($key['created_at'])) }}'
                                        ),
                                        url: '{{ route('events', ['sort_date' => date('Y-m-d', strtotime($key['created_at']))]) }}'
                                    },
                                    @endforeach
                                ]
                            });
                        }
                    </script>

                    @guest
                    <?php $segment = Request::segment(1) ?>
                    <a href="#popup-special_propos" target="popup" data-mfp-src="#popup-special_propos" class="btn popup-with-form">Следить за SportCasta</a>
                    @endguest
                </aside>


            </div>
        </div>
    </div>
</div>
@endsection
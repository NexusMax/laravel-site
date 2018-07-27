<?php
use App\Items;
use Jenssegers\Date\Date;
use App\Orders;
?>

@extends('layouts.app')

@section('content')

<div id="pjax-main" class="training-page">

        @include('partials.pagelogo', ['title' => isset($category) ? $category['name'] : '', 'background' => '/../img/training_bg.jpg', 'breadcrumbs' => isset($category) ? $category : ''])
        <div id="pjax-container">
        <div class="training-wrapper clearfix">
            <div class="container">
                <div class="row clearfix">
                    @section('item-content')
                    <div class="training-content">
                        <div id="training">
                        @if(!empty($category) && !Request::is('*chastyye-voprosy*') && !Request::is('*biblioteka*'))
                            <ul class="tabs box-shadow">
                                <li class="tab {{ Request::route()->getName() === 'training/category' ? 'active' : '' }}"><a href="{{ route('training/category', ['alias' => $category['alias']] ) }}">Все материалы</a></li>
                                <li class="divider"></li>
                                <li class="tab {{ Request::route()->getName() === 'training/article' ? 'active' : '' }}"><a href="{{ route('training/article', ['alias' => $category['alias']]) }}">Статьи</a></li>
                                <li class="divider"></li>
                                <li class="tab {{ Request::route()->getName() === 'training/briefcases' ? 'active' : '' }}"><a href="{{ route('training/briefcases', ['alias' => $category['alias']]) }}">Кейсы</a></li>
                                <li class="divider"></li>
                                <li class="tab {{ Request::route()->getName() === 'training/video' ? 'active' : '' }}"><a href="{{ route('training/video', ['alias' => $category['alias']]) }}">Видео</a></li>
                            </ul>
                        @elseif(Request::is('*biblioteka*'))
                                <ul class="tabs box-shadow">
                                    <li class="tab {{ Request::route()->getName() === 'training/category' ? 'active' : '' }}"><a href="{{ route('training/category', ['alias' => $category['alias']] ) }}">Книги</a></li>
                                    <li class="divider"></li>
                                    <li class="tab {{ Request::route()->getName() === 'training/tutorials' ? 'active' : '' }}"><a href="{{ route('training/tutorials', ['alias' => $category['alias']]) }}">Учебники</a></li>
                                    <li class="divider"></li>
                                    <li class="tab {{ Request::route()->getName() === 'training/paper' ? 'active' : '' }}"><a href="{{ route('training/paper', ['alias' => $category['alias']]) }}">Статьи</a></li>
                                    <li class="divider"></li>
                                    <li class="tab {{ Request::route()->getName() === 'training/benefits' ? 'active' : '' }}"><a href="{{ route('training/benefits', ['alias' => $category['alias']]) }}">Пособия</a></li>
                                </ul>
                        @endif

                        @include('partials.search')

                        @if(!empty($items))

                        @foreach($items as $key)
                        <div class="training-item wow fadeInUp clearfix box-shadow">
                            <div class="img-wrapper @if($key['category']['id'] === 5 && !Request::is('*paper*')) biblioteka-img @endif">
                                @if($key['category']['id'] !== 5 || Request::is('*paper*'))

                                    <div class="mask">
                                        @if(!empty($key['video']))
                                            <img style="object-fit: none;" src="https://img.youtube.com/vi/{{ $key['video'] }}/0.jpg" alt="{{ $key['name'] }}">
                                        @elseif(!empty($key['img']) && file_exists('img/'.$key['img']))
                                            <a href="{{ route('training/view', ['alias' => $key['category']['alias'] ,'view' => $key['alias']]) }}">
                                                <img src="/img/{{ $key['img'] }}" alt="{{ $key['name'] }}">
                                            </a>
                                        @else
                                            <a href="{{ route('training/view', ['alias' => $key['category']['alias'], 'view' => $key['alias']]) }}">
                                                <img src="/vendor/img/no-image-slide.png" alt="{{ $key['name'] }}">
                                            </a>
                                        @endif
                                        @if(Items::isPrivate($key['type']))
                                            @if(Auth::guest())
                                                <img src="/img/lock.png" alt="{{ $key['name'] }} приватная" class="lock">
                                            @elseif(!Orders::payed())
                                                <img src="/img/lock.png" alt="{{ $key['name'] }} приватная" class="lock">
                                            @endif
                                        @endif
                                    </div>

                                @else

                                    <div class="zoom-gallery">
                                        @if(!empty($key['img']) && file_exists('img/'.$key['img']))

                                        <div class="main-img">
                                            <a href="/img/{{ $key['img'] }}" data-source="/img/{{ $key['img'] }}">
                                                <img src="/img/{{ $key['img'] }}" alt="{{ $key['name'] }}">
                                            </a>
                                    </div>
                                        @else
                                            <div class="main-img">
                                            <img src="/vendor/img/no-image-slide.png" alt="{{ $key['name'] }}">
                                            </div>
                                        @endif


                                    @if(!empty($key['gallery']['photos']))

                                            <div class="all-img">
                                                <div class="owl-carousel11 owl-theme">
                                                @foreach($key['gallery']['photos'] as $photo)
                                                    <div class="item">
                                                        <a href="{{ '/albums/' . $photo['image'] }}" data-source="{{ '/albums/' . $photo['image'] }}">
                                                            <img src="{{ '/albums/' . $photo['image'] }}" alt="{{ $key['name'] }}">
                                                        </a>
                                                    </div>
                                                @endforeach
                                                </div>



                                            </div>

                                    @endif
                                    </div>
                                @endif




                            </div>
                            <div class="training-item_text">
                                @if($key['category']['id'] !== 5 || Request::is('*paper*'))
                                <a href="{{ route('training/view', ['alias' => $key['category']['alias'] ,'view' => $key['alias']]) }}"><div class="title">{{ $key['name'] }}</div></a>
                                @else
                                <div class="title">{{ $key['name'] }}</div>
                                @endif

                                @if($key['category']['id'] !== 5 || Request::is('*paper*'))
                                <div class="cat"><strong> Категория:</strong> {{ $key['category']['name'] }}</div>
                                <?php $created_at = new Date($key['created_at']); ?>
                                <div class="cat"><strong> {{ $key['user']['name'] }} {{ $key['user']['lastname'] }}</strong> - {{ $created_at->format('d.m.Y') }}</div>
                                @endif
                             

                                @if($key['category']['id'] !== 5 || Request::is('*paper*'))
                                <div class="cat"><strong> Уровень доступа:</strong> {{ Items::getNamePermission($key['type']) }}</div>
                                <p>{!! strip_tags(mb_substr($key['intro'], 0 , 80)) . '...' !!}</p>
                                <a href="{{ route('training/view', ['alias' => $key['category']['alias'] ,'view' => $key['alias']]) }}">Читать <i class="fa fa-long-arrow-right" aria-hidden="true"></i></a>
                                @else
                                <p>{!! mb_substr($key['intro'], 0 , 500) !!}</p>

                                @foreach($key['files'] as $fileKey)
                                    <?php
                                        $str_end = '';
                                        preg_match('/(\.[\w]+)$/', $fileKey['path'], $str_end);
                                    ?>
                                    <a href="{{ route('training/file', ['alias' => $fileKey['id']]) }}">Скачать книгу ({{ $str_end[1] }})<i class="fa fa-download" aria-hidden="true"></i></a>
                                @endforeach
                                @endif


                            </div>
                        </div>
                        @endforeach

                        {{--@if(!Auth::guest())--}}
                        {{ $items->links('vendor.pagination.default') }}
                        {{--@endif--}}

                        @endif

                        </div>
                    </div>
                    @show

                    @include('partials.sidebar', [
                        'categories' => $categories,
                        'popularItems' => $popularItems
                    ])
                </div>
            </div>

        </div>
        </div>
        @guest
        @include('partials.moreinf', ['title' => 'Хотите получить доступ ко всем материалам?'])
        @endguest

        </div>

@endsection

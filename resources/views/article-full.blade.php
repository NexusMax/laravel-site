<?php
use App\Items;
use App\Orders;
use Jenssegers\Date\Date;
use App\Shared;

$hr = mb_strpos($item['fulltext'], '<!-- pagebreak -->');
$count = mb_strlen($item['fulltext']);

if($hr){
    $half = $hr;
}else{
    ($count/2)%2 == 0 ? $half = (($count)/2)/2 : $half = (($count+1)/2)/2;
}

$haw = '<!--<span id="popup-half"></span>-->';

?>
@extends('layouts.app')

@section('content')


    @include('partials.pagelogo', [
        'title' => $item['name'],
        'background' => '/../../img/article-full-h.jpg',
        'breadcrumbs' => $item,
        'item' => Request::is('*events*') ? '' : $item,
    ])

    <section class="content article-content-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-lg-9">

                    @if(Auth::guest() && Items::isPrivate($item['type']))
                        <div class="article-content">{!! mb_substr($item['fulltext'], 0, $half) . ' <a class="read-more" href="#read-more">читать далее</a>' !!}</div>
                    @elseif(!Auth::guest() && Items::isPrivate($item['type']) && !Orders::payed())
                        @if(Auth::user()->roleName()->first()->roleName->slug === 'superadmin')
                            <div class="article-content">
                            {!! $item['fulltext'] !!}
                            @if(!empty($item['video']))
                                <div class="container-video">
                                    <div id="js-player" data-plyr-provider="youtube" data-plyr-embed-id="{{ $item['video'] }}"></div>
                                </div>
                            @endif
                            </div>

                            <?php if(!empty($item->user->expert)): ?>

                            <div class="article-user-expert">
                                <p>Автор: <a href="{{ route('experts/category', ['alias' => $item->user->expert->category->alias]) }}">{{ $item->user->name . ' ' . $item->user->lastname }}</a></p>
                                <ul>
                                    @if(!empty($item->user->expert->link_fb))
                                        <li><a target="_blank" href="{{ $item->user->expert->link_fb }}"><i class="fa fa-facebook"></i></a></li>
                                    @endif
                                    @if(!empty($item->user->expert->link_in))
                                        <li><a target="_blank" href="{{ $item->user->expert->link_in }}"><i class="fa fa-instagram"></i></a></li>
                                    @endif
                                </ul>
                            </div>

                            <?php endif; ?>

                            <div class="articel-share-row">
                                <h3>Понравилась статья? Поделитесь с друзьями и <a href="#">получите бонусы</a></h3>

                                <form action="{{ route('training/social') }}" id="social-form" method="post">
                                    {{ csrf_field() }}
                                </form>
                                <div id="vk_like"></div>

                                <div class="articel-share-row_soc">
                                    <ul>
                                        <li><a href="#" id="share-fb" data-id="{{ $item['id'] }}"><img src="/../../img/icons/fb.png" alt="{{ $item['name'] . 'facebook' }}"></a><span class="fb-span">{{ Shared::getCount('facebook', $shared) }}</span></li>
                                        <li><a href="#" id="share-tw" data-id="{{ $item['id'] }}"><img src="/../../img/icons/tw.png" alt="{{ $item['name'] . 'twitter' }}"></a><span class="tw-span">{{ Shared::getCount('twitter', $shared) }}</span></li>
                                        <?php //if(!in_array(geoip()->getLocation($ip = null)['country'], ['Ukraine', 'ukraine', 'local'])): ?>
                                        {{--<li><a href="#" id="share-vk" data-id="{{ $item['id'] }}"><img src="/../../img/icons/ggl.png" alt="{{ $item['name'] . 'vk' }}"></a><span class="vk-span">{{ Shared::getCount('vk', $shared) }}</span></li>--}}
                                        <?php //endif; ?>
                                        <script type="in/Login"> </script>
                                        <li><a href="#" id="share-gg" class="g-plus" data-id="{{ $item['id'] }}"><i class="fa fa-google-plus" aria-hidden="true"></i></a><span class="gg-span">{{ Shared::getCount('google', $shared) }}</span></li>
                                        <li><a href="#" id="share-tl" data-id="{{ $item['id'] }}"><i class="fa fa-telegram" aria-hidden="true"></i></a><span class="tl-span">{{ Shared::getCount('telegram', $shared) }}</span></li>
                                    </ul>
                                </div>
                            </div>
                        @else
                            <div class="article-content">{!! mb_substr($item['fulltext'], 0, $half) . ' <a class="read-more" href="#read-more">читать далее</a>' !!}</div>
                        @endif

                    @else
                        
                        <div class="article-content">
                            @if(Auth::guest())
                                <?php  
                                    $start = mb_substr($item['fulltext'], 0, $half); 
                                    $end = mb_substr($item['fulltext'], $half, $count);
                                ?>
                                {!! $start .  $end !!}
                            @else
                                {!! $item['fulltext'] !!}
                            @endif
                            @if(!empty($item['video']))
                                    <div class="container-video">
                                        <div id="js-player" data-plyr-provider="youtube" data-plyr-embed-id="{{ $item['video'] }}"></div>
                                    </div>

                            @endif
                        </div>
                            <?php if(!empty($item->user->expert)): ?>

                            <div class="article-user-expert">
                                <p>Автор: <a href="{{ route('experts/category', ['alias' => $item->user->expert->category->alias]) }}">{{ $item->user->name . ' ' . $item->user->lastname }}</a></p>
                                <ul>
                                    @if(!empty($item->user->expert->link_fb))
                                    <li><a target="_blank" href="{{ $item->user->expert->link_fb }}"><i class="fa fa-facebook"></i></a></li>
                                    @endif
                                    @if(!empty($item->user->expert->link_in))
                                    <li><a target="_blank" href="{{ $item->user->expert->link_in }}"><i class="fa fa-instagram"></i></a></li>
                                    @endif
                                </ul>
                            </div>

                            <?php endif; ?>
                        <div class="articel-share-row">
                            <h3>Понравилась статья? Поделитесь с друзьями и <a href="#">получите бонусы</a></h3>

                            <form action="{{ route('training/social') }}" id="social-form" method="post">
                                {{ csrf_field() }}
                            </form>
                            <div id="vk_like"></div>

                            <div class="articel-share-row_soc">
                                <ul>
                                    <li><a href="#" id="share-fb" data-id="{{ $item['id'] }}"><img src="/../../img/icons/fb.png" alt="{{ $item['name'] . 'facebook' }}"></a><span class="fb-span">{{ Shared::getCount('facebook', $shared) }}</span></li>
                                    <li><a href="#" id="share-tw" data-id="{{ $item['id'] }}"><img src="/../../img/icons/tw.png" alt="{{ $item['name'] . 'twitter' }}"></a><span class="tw-span">{{ Shared::getCount('twitter', $shared) }}</span></li>
                                <?php //if(!in_array(geoip()->getLocation($ip = null)['country'], ['Ukraine', 'ukraine', 'local'])): ?>
                                    {{--<li><a href="#" id="share-vk" data-id="{{ $item['id'] }}"><img src="/../../img/icons/ggl.png" alt="{{ $item['name'] . 'vk' }}"></a><span class="vk-span">{{ Shared::getCount('vk', $shared) }}</span></li>--}}
                                    <?php //endif; ?>
                                     <script type="in/Login"> </script>
                                    <li><a href="#" id="share-gg" class="g-plus" data-id="{{ $item['id'] }}"><i class="fa fa-google-plus" aria-hidden="true"></i></a><span class="gg-span">{{ Shared::getCount('google', $shared) }}</span></li>
                                    <li><a href="#" id="share-tl" data-id="{{ $item['id'] }}"><i class="fa fa-telegram" aria-hidden="true"></i></a><span class="tl-span">{{ Shared::getCount('telegram', $shared) }}</span></li>
                                </ul>
                            </div>
                            
                        </div>

                    @endif

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

    @if(Auth::guest())
        @if(Items::isPrivate($item['type']))
            @include('partials.moreinf', ['title' => 'Для просмотра полной статьи необходимо авторизоваться'])
        @else
            @include('partials.moreinf', ['title' => 'Еще больше контента после авторизации'])
        @endif
    @else

        @if( Items::isPrivate($item['type']) && !Orders::payed() && (Auth::user()->roleName()->first()->roleName->slug !== 'superadmin'))
            <?php

                if(Auth::user()->gender === 0){
                    $gender = 'Уважаемый';
                }else{
                    $gender = 'Уважаемая';
                }
            ?>
            @include('partials.payed', ['title' => Auth::user()->name . ', Ваша бесплатная подписка истекла'])
        @else

            @if(!empty($items))
                <section class="interesting-articles">
                    <div class="container">
                        <div class="row">
                            <h3>вам так же будет интересно</h3>
                            <div class="wrapper full-article-interesting">
                                @foreach($items as $key)
                                    <div class="oc2_item">
                                        <a href="{{ route('training/view', ['alias' => $key['category']['alias'], 'view' => $key['alias']]) }}">
                                        <div class="mask">
                                            <img src="/img/{{ $key['img'] }}" alt="{{ $key['name'] }}">
                                        </div>
                                        </a>
                                        <div class="oc2-item_block">
                                            <a href="{{ route('training/view', ['alias' => $key['category']['alias'], 'view' => $key['alias']]) }}">
                                            <span class="oc2-capture">
                                                {{ strip_tags(mb_substr($key['name'], 0 , 33)) . '...' }}
                                            </span>
                                            </a>
                                            <p class="oc2-name">{{ $key['user']['name'] . ' ' . $key['user']['lastname'] }}</p>
                                            <?php $created_at = new Date($key['created_at']); ?>
                                            <p class="oc2-date">{{ $created_at->format('d.m.Y') }}</p>
                                            <p class="oc2-cat"><strong>Категория:</strong> {{ $key['category']['name'] }}</p>
                                            <p class="oc2-access"><strong>Уровень досутпа:</strong> {{ Items::getNamePermission($key['type']) }}</p>
                                            <p class="oc2-descr">{!! strip_tags(mb_substr($key['intro'], 0 , 55)) . '...' !!}</p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </section>
            @endif

        @endif

    @endif

@endsection
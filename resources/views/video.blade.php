<?php
use App\Items;
use App\Orders;
use Jenssegers\Date\Date;
use App\Shared;

?>
@extends('layouts.app')

@section('content')

    <div id="pjax-main">
@include('partials.pagelogo', [
    'title' => $title,
    'background' => '/../img/video_bg.jpg',
    'breadcrumbs' => $category
    ])
    <div id="pjax-container">
    <div id="video">

        <div class="video-content">
            <div class="container">
                <div class="row">
                    <div class="training-content">
                        <ul class="tabs">
                            <li class="tab {{ Request::route()->getName() === 'video' ? 'active' : '' }}"><a href="{{ route('video') }}">Все видео</a></li>
                            <li class="divider"></li>
                            <li class="tab {{ Request::url() === route('video/category', ['alias' => 'trenirovky']) ? 'active' : '' }}"><a href="{{ route('video/category', ['alias' => 'trenirovky']) }}">Тренировки</a></li>
                            <li class="divider"></li>
                            <li class="tab {{ Request::url() === route('video/category', ['alias' => 'pitaniye']) ? 'active' : '' }}"><a href="{{ route('video/category', ['alias' => 'pitaniye']) }}">Питание</a></li>
                            <li class="divider"></li>
                            <li class="tab {{ Request::url() === route('video/category', ['alias' => 'psikhologiya']) ? 'active' : '' }}"><a href="{{ route('video/category', ['alias' => 'psikhologiya']) }}">Психология</a></li>
                            <li class="divider"></li>
                            <li class="tab {{ Request::url() === route('video/category', ['alias' => 'zdorovie']) ? 'active' : '' }}"><a href="{{ route('video/category', ['alias' => 'zdorovie']) }}">Здоровье</a></li>
                        </ul>
                    </div>

                    @include('partials.search')
                    <div class="videos-wrapper">

                        

                    @forelse($items as $key)
                    <div class="video-item wow fadeIn clearfix box-shadow">
                        <div class="img-wrapper">
                            <div class="mask">
                                <img style="object-fit: none;" src="https://img.youtube.com/vi/{{ $key['video'] }}/0.jpg" alt="{{ $key['name'] }}">

                                @if(Items::isPrivate($key['type']))
                                    @if(Auth::guest())
                                        <img src="/img/lock.png" alt="{{ $key['name'] }} приватная" class="lock">
                                    @elseif(!Orders::payed())
                                        <img src="/img/lock.png" alt="{{ $key['name'] }} приватная" class="lock">
                                    @endif
                                @endif
                            </div>
                        </div>
                        <div class="video-item_text">
{{--                            <a href="{{ route('training/view', ['alias' => $key['category']['alias'], 'view' => $key['alias']]) }}"><img src="/img/icons/btn_play.png" alt="{{ $key['name'] }} 1" class="btn-play"></a>--}}
                            @if(Items::isPrivate($key['type']))
                                @guest
                                <a class="btn-click-video read-more" href="#read-more"><img src="/img/icons/btn_play.png" alt="{{ $key['name'] }} 2" class="btn-play"></a>
                                @else
                                    @if(Auth::user()->roleName()->first()->roleName->slug === 'superadmin' || Orders::payed())
                                    <a
                                            data-fb-span="{{ Shared::getCount('facebook', Shared::getShared($key['id'])) }}"
                                            data-tw-span="{{ Shared::getCount('twitter', Shared::getShared($key['id'])) }}"
                                            data-gg-span="{{ Shared::getCount('google', Shared::getShared($key['id'])) }}"
                                            data-tl-span="{{ Shared::getCount('telegram', Shared::getShared($key['id'])) }}"
                                            data-id="{{ $key['id'] }}"
                                            data-url-copy="{{ Request::url() . '?number=' . $key['id'] }}"
                                            data-youtube="{{ $key['video'] }}"
                                            class="popup-with-form1 btn-click-video"
                                            data-toggle="modal"
                                            data-target="#myModal-1"><img src="/img/icons/btn_play.png" alt="{{ $key['name'] }} 2" class="btn-play"></a>
                                    @else
                                    <a class="btn-click-video read-more" href="#read-more"><img src="/img/icons/btn_play.png" alt="{{ $key['name'] }} 2" class="btn-play"></a>
                                    @endif
                                @endguest

                            @else
                            <a  href="#"
                                    data-fb-span="{{ Shared::getCount('facebook', Shared::getShared($key['id'])) }}"
                                    data-tw-span="{{ Shared::getCount('twitter', Shared::getShared($key['id'])) }}"
                                    data-gg-span="{{ Shared::getCount('google', Shared::getShared($key['id'])) }}"
                                    data-tl-span="{{ Shared::getCount('telegram', Shared::getShared($key['id'])) }}"
                                    data-id="{{ $key['id'] }}"
                                    data-url-copy="{{ Request::url() . '?number=' . $key['id'] }}"
                                    data-youtube="{{ $key['video'] }}"
                                    class="popup-with-form1 btn-click-video"
                                    data-toggle="modal"
                                    data-target="#myModal-1"><img src="/img/icons/btn_play.png" alt="{{ $key['name'] }} 2" class="btn-play"></a>
                            @endif

                            <div class="title">{{ $key['name'] }}</div>
                            <div class="clearfix"></div>
                            <?php $created_at = new Date($key['created_at']); ?>
                            <div class="author"><strong>{{ $key['user']['name'] . ' ' . $key['user']['lastname']}}</strong> <span class="right">{{ $created_at->format('d.m.Y') }}</span></div>
                            <div class="cat"><strong>Уровень доступа: </strong> {{ Items::getNamePermission($key['type']) }}</div>
                            <p class="video-item-intro">{!! strip_tags(mb_substr($key['intro'], 0 , 60)) !!}</p>

                        </div>
                    </div>
                    @empty
                    
                    </div>
                    @endforelse

                    <div class="modal fade" id="myModal-1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <button target="popup" type="button" class="mfp-close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

                                    <div class="container-video">
                                        <video controls crossorigin playsinline id="js-player">
                                        <source src="" type="video/mp4" size="576">
                                        </video>
                                        {{--<div id="js-player" class="js-player" data-plyr-provider="youtube" data-plyr-embed-id=""></div>--}}
                                    </div>

                                <form action="{{ route('training/social') }}" class="social-form" method="post">
                                    {{ csrf_field() }}
                                </form>
                                <div class="articel-share-row_soc1">
                                    <ul>
                                        <li><a href="#" class="share-fb" data-id="0"><i class="fa fa-facebook" aria-hidden="true"></i></a><span class="fb-span">0</span></li>
                                        <li><a href="#" class="share-tw" data-id="0"><i class="fa fa-twitter"></i></a><span class="tw-span">0</span></li>
                                        <li><a href="#" class="share-gg" data-id="0"><i class="fa fa-google-plus"></i></a><span class="gg-span">0</span></li>
                                        <li><a href="#" class="share-tl" data-id="0"><i class="fa fa-telegram"></i></a><span class="tl-span">0</span></li>

                                        <li>
                                            <button class="share-copy" data-id="0" data-clipboard-target="#myInput">
                                                <i class="fa fa-share-alt"></i>
                                                <input type="text" value="0" id="myInput" class="none1">
                                            </button>
                                        </li>

                                    </ul>
                                    <div class="share-block-link"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{ $items->links('vendor.pagination.default') }}

                </div> 
            </div>
        </div>
        
    </div>
    </div>
</div>


    @guest
        @include('partials.moreinf', [
        'title' => 'Хотите получить доступ ко всем материалам?'
        ])
    @else

        @if( !Orders::payed() && (Auth::user()->roleName()->first()->roleName->slug !== 'superadmin'))

            @include('partials.payed', ['title' => Auth::user()->name . ', Ваша бесплатная подписка истекла'])

        @endif

    @endguest

    </div>
@endsection
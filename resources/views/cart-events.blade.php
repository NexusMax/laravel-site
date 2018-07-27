<?php
use Jenssegers\Date\Date;
?>
@extends('layouts.app')

@section('content')


    <div id="cart-events-page">

        @include('partials.pagelogo', [
            'title' => $item['name'],
            'background' => '/../../img/article-full-h.jpg',
            'breadcrumbs' => $item,
            'item' => Request::is('*events*') ? '' : $item,
        ])


        @if(strtotime($item['created_at']) > time() && !$item['without_date'])
            <section class="cart-events profile sec-even">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-4">
                            @include('event-article-content', ['name' => $item['name'], 'fulltext' => $item['fulltext']])
                        </div>
                        <div class="col-lg-8 timer">
                        <h3 class="title">До начала осталось:</h3>
                        <input type="hidden" name="startTime" value="{{ strtotime($item['created_at']) }}">
                            <div class="your-clock"></div>
                            <div class="timer-text">
                                <p>Спикеры: {{ $item['spiker']}}</p>
                                <?php $created_at = new Date($item['created_at']); ?>
                                <p>Начало: {{ $created_at->format('d.m.Y') }} в {{ $created_at->format('H:i') }}</p>
                                @if(!$payed)

                                    @guest
                                        <a href="#" data-mfp-src="#popup-check_in" class="btn popup-with-form">забронировать
                                            место за {!! $old_price !!} {{ $item['price'] }} $</a>
                                    @else

                                        @if($item['price']  < 0.01)
                                            <form action="{{ route('payment/zero') }}" method="post">
                                                {{ csrf_field() }}
                                                <input type="hidden" name="id" value="{{ $item['id'] }}">
                                                <button id="btn-payment_submit" type="submit" class="btn payment-btn">
                                                    забронировать место за {!! $old_price !!} {{ $item['price'] }} $
                                                </button>
                                            </form>
                                        @else

                                            <form action="https://secure.platononline.com/payment/auth" target="trinity"
                                                  method="post" class="text-center success-payment-form">
                                                <input type="hidden" name="payment" value="{{ $data->payment }}"/>
                                                <input type="hidden" name="key" value="{{ $data->key }}"/>
                                                <input type="hidden" name="url" value="{{ $data->url }}"/>
                                                <input type="hidden" name="data" value="{{ $data->data }}"/>
                                                <input type="hidden" name="sign" value="{{ $data->sign }}"/>
                                                <input type="hidden" name="ext1" value="{{ $data->ext1 }}"/>
                                                <button id="btn-payment_submit" type="submit" class="btn payment-btn">
                                                    забронировать место за {!! $old_price !!} {{ $item['price'] }} $
                                                </button>
                                            </form>

                                            <iframe name="trinity" id="trinity" width="1000" height="1000"
                                                    style="display: none;"></iframe>

                                        @endif


                                    @endguest

                                @else

                                    <p>Вебинар оплачено</p>

                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        @elseif($item['without_date'])
            <section class="cart-events profile sec-even">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-4">
                            @include('event-article-content', ['name' => $item['name'], 'fulltext' => $item['fulltext']])
                        </div>
                        <div class="col-lg-8 timer">
                        <h3 class="title">Скоро</h3>
                            <div class="timer-text">
                                <p>Спикеры: {{ $item['spiker']}}</p>
                                @if(!$payed)

                                    @guest
                                        <a href="#" data-mfp-src="#popup-check_in" class="btn popup-with-form">забронировать
                                            место за {!! $old_price !!} {{ $item['price'] }} $</a>
                                    @else

                                        @if($item['price']  < 0.01)
                                            <form action="{{ route('payment/zero') }}" method="post">
                                                {{ csrf_field() }}
                                                <input type="hidden" name="id" value="{{ $item['id'] }}">
                                                <button id="btn-payment_submit" type="submit" class="btn payment-btn">
                                                    забронировать место за {!! $item['price'] !!} $
                                                </button>
                                            </form>
                                        @else

                                            <form action="https://secure.platononline.com/payment/auth" target="trinity"
                                                  method="post" class="text-center success-payment-form">
                                                <input type="hidden" name="payment" value="{{ $data->payment }}"/>
                                                <input type="hidden" name="key" value="{{ $data->key }}"/>
                                                <input type="hidden" name="url" value="{{ $data->url }}"/>
                                                <input type="hidden" name="data" value="{{ $data->data }}"/>
                                                <input type="hidden" name="sign" value="{{ $data->sign }}"/>
                                                <input type="hidden" name="ext1" value="{{ $data->ext1 }}"/>
                                                <button id="btn-payment_submit" type="submit" class="btn payment-btn">
                                                    забронировать место за {!!  $old_price  !!} {!! $item['price'] !!} $
                                                </button>
                                            </form>

                                            <iframe name="trinity" id="trinity" width="1000" height="1000"
                                                    style="display: none;"></iframe>

                                        @endif


                                    @endguest

                                @else

                                    <p>Вебинар оплачено</p>

                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        @else
            <link href="{{asset('css/chat.css')}}" rel="stylesheet"/>

            <section class="cart-events profile sec-even">
                <div class="container">
                    <div class="row">
                        <h3 class="title title-end-event">Событие уже было начато</h3>
                    </div>
                    @if(
                    ($payed && strtotime($item['end_at']) > time()) ||
                    (!Auth::guest() && Auth::user()->roleName()->first()->roleName->slug === 'superadmin')
                    )
                        <div class="row">

                            @if(!empty($eventMessage))
                                <p>{{ $eventMessage }}</p>
                            @endif
                        </div>

                        <div class="chat-wrapper">
                            <div class="video-wrap">
                                <!--
                                <span class="full-size" data-toggle="modal" data-target="#modal1" id="toggle-fs">
                                    <img src="/../../img/icons/full-size.svg" alt="">
                                </span>
                                -->
                                <div class="videoWrapper" id="normal-wrapper">
                                    <div class="col-lg-12" style="padding: 93px 0 0 0;">
                                        <div id="video-id" data-id="{{ $item['vimeo'] }}"></div>
                                        <video controls crossorigin playsinline id="js-player3">
                                            <source src="" type="video/mp4" size="576">
                                        </video>
                                    </div>

                                </div>
                            </div>
                            <div class="chat-wrap">
                                <div class="chat-title">
                                    <span>Чат вебинара</span>
                                </div>

                                <div class="chat-flex">
                                    <div class="chat-body" id="chat-body">
                                        <div class="chat-info">
                                            <p><span>Спикеры:</span> {{ $item['spiker']}} </p>
                                            <?php $created_at = new Date($item['created_at']); ?>
                                            <p><span>Начало:</span> {{ $created_at->format('d.m.Y') }}
                                                в {{ $created_at->format('H:i') }}</p>
                                        </div>

                                        @foreach($history as $row)
                                            @if ($row->user_id == Auth::user()->id)
                                                <div class="chat-user-row you" data-hash="{{$row->message_id}}">
                                                    <div class="chat-message">
                                                        <p class="message">{{$row->message}}</p>
                                                    </div>
                                                </div>
                                            @else
                                                <div class="chat-user-row @if ($row->user_role == 1) admin @else users @endif"
                                                     data-hash="{{$row->message_id}}">
                                                    <div class="chat-img">
                                                        <img src="{{$row->user_avatar}}" alt="">
                                                    </div>
                                                    <div class="chat-message">
                                                        <div class="chat-heading">
                                                            <span class="user-name">{{$row->user_name}}</span>
                                                            <span class="time">{{$row->getTime()}}</span>
                                                        </div>
                                                        <p class="message">{{$row->message}}</p>

                                                        @if ($mode == 'moderator')
                                                            <span class="delete moderator-btn"
                                                                  chat="{{$row->message_id}}">удалить</span>
                                                            <span class="ban moderator-btn"
                                                                  user="{{$row->user_id}}">бан</span>
                                                        @endif

                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach

                                        @if ($isUserBanned)
                                            <div class="chat-info">
                                                <p>Модератор <span>запретил</span> вам писать в этот чат :(</p>
                                            </div>
                                        @endif

                                    </div>
                                    <div class="chat-input">
                                        <div class="emoji-wrap">
                                            <img src="/../../icons/emoji.svg" alt="">
                                        </div>
                                        <div class="input-message">
                                <textarea id="message" @if ($isUserBanned) disabled @endif class="autoExpand"
                                          style="background-color: #fcfcfc" rows="1" data-min-rows="1"
                                          placeholder="Введите сообщение..."></textarea>
                                        </div>
                                        <div class="send-wrap" id="send"
                                             @if ($isUserBanned) style="cursor:not-allowed" @endif>
                                            <img src="/../../icons/send.svg" alt="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>




                    @endif
                </div>
            </section>

            <section class="content">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            @include('event-article-content', ['name' => $item['name'], 'fulltext' => $item['fulltext']])
                        </div>
                    </div>
                </div>
            </section>
        @endif

    </div>



    <div id="modal1" class="modal chat-video-modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-heading">

                </div>
                <div class="chat-wrapper">
                    <div class="video-wrap">
                        <div class="chat-control-buttons">
								<span class="open-chat">
									<img src="/../../icons/chat.svg" alt="">
									<span class="number">99+</span>
								</span>
                            <span class="full-size modal-close" data-dismiss="modal" id="close-fs">
									<img src="/../../icons/sm-size.svg" class="svg" alt="">
								</span>
                        </div>
                        <div class="videoWrapper" id="fs-wrapper">


                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('libs/jquery/jquery-1.11.2.min.js') }}"></script>
    <link href="{{asset('libs/emoji/jquery.emojiarea.css')}}" rel="stylesheet"/>
    <script src="{{ asset('libs/emoji/jquery.emojiarea.js') }}"></script>
    <script src="{{ asset('libs/emoji/emojione.js') }}"></script>

    @if (Auth::user())
    <script src="{{asset('libs/socket.io.dev.js')}}" type="text/javascript"></script>

    <script type="text/javascript">
        let user = {{ Auth::user()->id }};
        let chatId = {{$chatId}};
    </script>

    <script src="{{ asset('js/chat.js') }}"></script>

    @if ($mode == 'moderator')
        <script src="{{ asset('js/chat-moderator.js') }}"></script>
    @endif

    <script src="{{ asset('js/chat-client.js') }}"></script>

    @endif

    @include('partials.popup-place', ['item' => $item, 'orders' => $orders])

@endsection
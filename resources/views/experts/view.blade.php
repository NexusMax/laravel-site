
@extends('layouts.app')

@section('content')

    <div class="expertsWrapper">

        @foreach($items as $key)
        <article class="expertArticle">
            <div class="container">
                <div class="row">
                    <div class="col-lg-5 col-md-6 col-sm-12">
                        <div class="expertArticle-imgWrapper">
                            <?php

                            $img = '/../../img/account-avatar.jpg';
                            if(!empty($key->user->image))
                                $img = url('/user/' . $key->user->image);
                            ?>

                            <img src="{{ $img }}" alt="{{ $key->category->name }} - {{ $key->user->name . ' ' . $key->user->lastname }}" class="expertArticle-img">
                        </div>

                         <div class="article-user-expert all-exp">
                            <ul>
                                @if(!empty($key->link_fb))
                                    <li><a target="_blank" href="{{ $key->link_fb }}"><i class="fa fa-facebook"></i></a></li>
                                @endif
                                @if(!empty($key->link_in))
                                    <li><a target="_blank" href="{{ $key->link_in }}"><i class="fa fa-instagram"></i></a></li>
                                @endif
                            </ul>
                        </div>

                    </div>
                    <div class="col-lg-7 col-md-6 col-sm-12">
                        <div class="expertArticle-descr">
                            {!! $key->body !!}
                        </div>
                    </div>
                </div>
                <div class="expertArticles">
                    <div class="row">
                        <div class="col-sm-12">
                            <h3 class="titleh3 wow fadeInUp expertArticles_title">МАТЕРИАЛЫ АВТОРА</h3>
                            <div class="owl-carousel owl-carousel2 owl-theme">
                                @include('partials.slider-item',['items' => $key->user->items])
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </article>
        @endforeach

    </div>
@endsection
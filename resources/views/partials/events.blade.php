<?php
use Jenssegers\Date\Date;
Date::setLocale('ru');
?>
<section class="upcoming-events clearfix">
    <div class="container">
        <div class="row">
            <div class="events-text col-lg-3 col-md-3">
                <h3 class="titleh3 title-events-after wow fadeInUp">Ближайшие события</h3>
                <p>Вы можете выбрать мероприятие по дате актуальности</p>
                <a href="{{ route('events') }}" class="smallHidden">Смотреть все</a>
            </div>
            <div class="slider1 col-lg-9 col-md-9">
                <div class="owl-carousel owl-carousel1 owl-theme">

                    @foreach($itemsEvents as $key)
                        <?php $created_at = new Date($key['created_at']) ?>
                        <div class="events-item">
                            <div class="mask">
                                <a href="{{ route('events/view', ['alias' => $key['alias']]) }}">
                                    @if(!empty($key['img']))
                                    <img class="events-item_img" src="/img/{{ $key['img'] }}" alt="{{ $key['name'] }}">
                                    @else
                                    <img class="events-item_img" src="/vendor/img/nophoto.jpg" alt="{{ $key['name'] }}">
                                    @endif
                                </a>
                            </div>
                            @if($key['without_date'])
                            <span class="events-date">Скоро</span>
                            @else
                            <span class="events-month">{{ $created_at->format('F') }}</span>
                            <span class="events-date">{{ $created_at->format('d') }}</span>
                            <span class="events-day">{{ $created_at->format('l') }}</span>
                            @endif
                            
                            <div class="events-shadow-wrapper">
                                <a href="{{ route('events/view', ['alias' => $key['alias']]) }}" class="events-item_title">{{ $key['name'] }}</a>
                                <p class="events-item_descr">{{ strip_tags(mb_substr($key['intro'], 0 , 40)) . '...' }}</p>
                                <div class="events-more-wrapper">
                                    <a class="events-more" href="{{ route('events/view', ['alias' => $key['alias']]) }}">подробнее<i class="fa fa-long-arrow-right" aria-hidden="true"></i></a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <a href="{{ route('events') }}" class="smallShow smallShow_seeAll">Смотреть все</a>
        </div>
    </div>
</section>
@extends('layouts.app')

@section('content')
    <div id="payment-page">

        @include('partials.pagelogo', [
        'title' => 'ЗАБРОНИРОВАТЬ МЕСТО',
        'background' => '/../img/events_bg.jpg',
        ])

        <section class="payment profile">
            <div class="container">
                <div class="row">
                    <h3 class="title">ЗАБРОНИРОВАТЬ МЕСТО</h3>
                </div>

                <div class="row">
                    <div class="col-lg-12 text-center">
                        <div class="payment-wrapper">
                        <form action="{{ route('payment/success', ['id' => $id]) }}" method="post" class="text-center success-payment-form">
                            {{ csrf_field() }}
                            <input type="hidden" name="free_count" value="{{ intval($item_event['count_people'] - count($orders)) }}">
                            <input type="hidden" name="all_count" value="{{ intval($item_event['count_people']) }}">
                            <input type="hidden" name="byed_count" value="{{ count($orders) }}">
                            <input type="hidden" name="total-price" value="{{ $item_event['price'] }}">
                            <p>Свободных мест: <span class="count-free-event">{{ intval($item_event['count_people'] - count($orders)) }}</span> из {{ intval($item_event['count_people']) }}</p>
                            <p><span class="price-event">{{ $item_event['price'] }}</span> $</p>
                            {{--<p>Пригласить пользователя <span class="plus-user">+</span></p>--}}
                            {{--<div class="insert-users">--}}

                            {{--</div>--}}

                            <button type="submit" class="btn payment-btn">Оплатить</button>
                        </form>

                        </div>
                    </div>
                </div>

            </div>
        </section>


    </div>
@endsection
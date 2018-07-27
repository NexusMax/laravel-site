@extends('layouts.app')

@section('content')
    <div id="payment-page">

        @include('partials.pagelogo', [
            'title' => 'Тарифные планы',
            'background' => '/../img/events_bg.jpg',
        ])

        <section class="payment profile">
            <div class="container">
                @if (Request::input('order'))
                    <div class="row">
                        <div class="col-lg-12">
                            <h3 class="title">Оплата не удалась</h3>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="payment-wrapper">
                                Оплата не удалась. Свяжитесь с менеджером для уточнения.
                                Номер транзакции: {{ Request::input('order') }}.
                            </div>
                        </div>
                    </div>
                @else

                <div class="row">
                    <h3 class="title">Выберите тариф</h3>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="payment-wrapper">
                            <div class="row">
                                <div class="col-lg-7">
                                    <div class="payment-left-block">
                                        @foreach($data as $d)
                                            <div class="payment-item @if ($loop->iteration == 1) active @endif" data-id="{{ $loop->iteration }}">
                                                <div class="p-item_header">
                                                    <div class="p-item_term">{{ $d->deal }}</div>
                                                </div>
                                                <div class="p-item_price">
                                                    <span class="how-much">{{ $d->sum }}</span> $
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="col-lg-5">
                                    <form action="{{ route('payment/success') }}" method="post">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="package" value="{{ $data[0]->id }}">
                                        <input type="hidden" name="total-price" value="{{ $data[0]->sum }}">
                                        <div class="payment-right-block">
                                            <div class="p-right_content">
                                                <div class="p-right_header">Стоимость тарифа: <span class="count-package">{{ $data[0]->sum }}</span> $</div>
                                                <div class="p-right_text">Хотите использовать бонусы?</div>
                                                <div class="p-right_text3 new-p-style">(Не более 50%)</div>
                                                <div class="p-right_text2" >Использовать
                                                    <div class="p-right_counter">
                                                        <span class="check-sum" data-type="minus" data-field="quant[0]">-</span>
                                                        <input  type="text" name="quant" class="input-number" value="0" min="0" max="{{ Auth::user()->balance }}">
                                                        <span class="check-sum" data-type="plus" data-field="quant[0]">+</span>
                                                    </div> из <strong>{{ Auth::user()->balance }} sc</strong>
                                                </div>
                                                <hr>

                                                <div class="p-right_text3">Оплата бонусами: <span class="total-bonus">0</span> sc</div>

                                                <div class="p-right_text total">Всего к оплате: <span class="total-price">{{ $data[0]->sum }}</span> $</div>
                                                <button type="submit" class="btn payment-btn">Оплатить</button>
                                            </div>

                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </section>


    </div>
@endsection


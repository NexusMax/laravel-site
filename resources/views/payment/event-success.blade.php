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
                            <form action="https://secure.platononline.com/pcc.php?a=auth" method="post" class="text-center success-payment-form">
                                <div class="p-right_text total">Всего к оплате: <span class="total-price">{{ $data->total }}</span> UAH</div>
                                <input type="hidden" name="payment" value="CC" />
                                <input type="hidden" name="key" value="{{ $data->key }}" />
                                <input type="hidden" name="url" value="{{ $data->url }}" />
                                <input type="hidden" name="data" value="{{ $data->data }}" />
                                <input type="hidden" name="sign" value="{{ $data->sign }}" />
                                <input type="hidden" name="token" value="{{ $data->token }}" />
                                <input type="hidden" name="pid" value="{{ $data->pid }}" />
                                <button type="submit" class="btn payment-btn">Оплатить</button>
                            </form>


                        </div>
                    </div>
                </div>

            </div>
        </section>


    </div>
@endsection
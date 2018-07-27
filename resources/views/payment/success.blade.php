@extends('layouts.app')

@section('content')
<div id="payment-page">

    @include('partials.pagelogo', [
    'title' => 'Подтверждение оплаты',
    'background' => '/../img/events_bg.jpg',
    ])
    <section class="payment profile">
        <div class="container">
            <div class="row">
                <h3 class="title">Подтверждение оплаты</h3>
            </div>

            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="payment-wrapper">
                        <form action="https://secure.platononline.com/payment/auth" target="trinity" method="post" class="text-center success-payment-form">

                            <div class="p-right_text total">Всего к оплате: <span class="total-price">{{ $data->total }}</span> USD</div>
                            <input type="hidden" name="payment" value="{{ $data->payment }}" />
                            <input type="hidden" name="key" value="{{ $data->key }}" />
                            <input type="hidden" name="url" value="{{ $data->url }}" />
                            <input type="hidden" name="data" value="{{ $data->data }}" />
                            <input type="hidden" name="sign" value="{{ $data->sign }}" />
                            <input type="hidden" name="ext1" value="{{ $data->ext1 }}" />
                            <button id="btn-payment_submit" type="submit" class="btn payment-btn">Оплатить</button>
                        </form>

                        <iframe name="trinity" id="trinity" width="1000" height="1000" style="display: none;"></iframe>
                    </div>
                </div>
            </div>

        </div>
    </section>


</div>
@endsection
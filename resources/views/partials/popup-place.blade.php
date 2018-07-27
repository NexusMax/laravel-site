<div id="popup-place" class="white-popup-block mfp-hide popup-special_propos">
    <h3>забронировать место</h3>

    <form action="{{ route('payment/success', ['id' => $item['id']]) }}" method="post" class="special_propos-form">
        {{ csrf_field() }}

        <input type="hidden" name="free_count" value="{{ intval($item['count_people'] - count($orders)) }}">
        <input type="hidden" name="all_count" value="{{ intval($item['count_people']) }}">
        <input type="hidden" name="byed_count" value="{{ count($orders) }}">
        <input type="hidden" name="total-price" value="{{ $item['price'] }}">

        <table class="table table-hover table-event">
            <tr>
                <th>Свободных мест</th>
                <th>Сумма</th>
            </tr>
            <tr>
                <td>{{ intval($item['count_people'] - count($orders)) . ' из ' .  intval($item['count_people']) }}</td>
                <td>{{ $item['price'] }} $</td>
            </tr>
        </table>

        <br>
        @guest
        <a class="popup-with-form btn specpopup-btn" data-mfp-src="#popup-check_in" href="#" rel="nofollow"><span>Оплатить</span></a>
        @else
        <button type="submit" class="btn payment-btn">Оплатить</button>
        @endguest
    </form>
    <span>Здесь действительно много интересного!</span>
</div>
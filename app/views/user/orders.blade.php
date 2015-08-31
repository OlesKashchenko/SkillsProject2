@if ($results)
    @foreach ($results as $result)
    <div class="result_item user_item" style="border-left: 0; border-right: 0;">
        <div class="result_item_body">
            <table>
                <tr>
                    <td colspan="3"><h2>№ {{ $result['identifier'] }}</h2></td>
                </tr>

                @if (isset($result['log']['status']) && $result['log']['status'])
                    <tr>
                        <td><p>СОСТОЯНИЕ ЗАКАЗА :</p></td>
                        <td><p>{{ $result['log']['status'] }}</p></td>
                    </tr>
                @endif
                @if (isset($result['log']['route']) && $result['log']['route'])
                    <tr>
                        <td><p>МАРШРУТ :</p></td>
                        <td><p>{{ str_replace('-', '&rarr;', $result['log']['route']) }}</p></td>
                    </tr>
                @endif
                @if (isset($result['log']['route_start']) && $result['log']['route_start'])
                    <tr>
                        <td><p>ПУНКТ ОТПРАВЛЕНИЯ :</p></td>
                        <td><p>{{ $result['log']['route_start'] }}</p></td>
                    </tr>
                @endif
                @if (isset($result['log']['route_end']) && $result['log']['route_end'])
                    <tr>
                        <td><p>ПУНКТ НАЗНАЧЕНИЯ :</p></td>
                        <td><p>{{ $result['log']['route_end'] }}</p></td>
                    </tr>
                @endif
                @if (isset($result['log']['phone_receiver']) && $result['log']['phone_receiver'])
                    <tr>
                        <td><p>КОНТАКТЫ ПОЛУЧАТЕЛЯ :</p></td>
                        <td><p>{{ $result['log']['phone_receiver'] }}</p></td>
                    </tr>
                @endif
                @if (isset($result['log']['name_receiver']) && $result['log']['name_receiver'])
                    <tr>
                        <td><p>ПОЛУЧАТЕЛь :</p></td>
                        <td><p>{{ $result['log']['name_receiver'] }}</p></td>
                    </tr>
                @endif
                @if (isset($result['log']['address']) && $result['log']['address'])
                    <tr>
                        <td><p>Адрес получателя :</p></td>
                        <td><p>{{ $result['log']['address'] }}</p></td>
                    </tr>
                @endif
                @if (isset($result['log']['date_leave']) && $result['log']['date_leave'])
                    <tr>
                        <td><p>ДАТА ОТПРАВЛЕНИЯ :</p></td>
                        <td><p>{{ $result['log']['date_leave'] }}</p></td>
                    </tr>
                @endif
                @if (isset($result['log']['date_arrival']) && $result['log']['date_arrival'])
                    <tr>
                        <td><p>ДАТА ПРИБЫТИЯ :</p></td>
                        <td><p>{{ $result['log']['date_arrival'] }}</p></td>
                    </tr>
                @endif
                @if (isset($result['log']['weight']) && $result['log']['weight'])
                    <tr>
                        <td><p>Вес :</p></td>
                        <td><p>{{ $result['log']['weight'] }}</p></td>
                    </tr>
                @endif
                @if (isset($result['log']['price']) && $result['log']['price'])
                    <tr>
                        <td><p>Стоимость :</p></td>
                        <td><p>{{ $result['log']['price'] }}</p></td>
                    </tr>
                @endif
                @if (isset($result['log']['documents']) && $result['log']['documents'])
                    <tr>
                        <td><p>Необходимые документы :</p></td>
                        <td><p>{{ $result['log']['documents'] }}</p></td>
                    </tr>
                @endif
                @if (isset($result['log']['payer']) && $result['log']['payer'])
                    <tr>
                        <td><p>Оплата :</p></td>
                        <td><p>{{ $result['log']['payer'] }}</p></td>
                    </tr>
                @endif
                @if (isset($result['log']['back_deliver']) && $result['log']['back_deliver'])
                    <tr>
                        <td><p>Обратная доставка :</p></td>
                        <td><p>{{ $result['log']['back_deliver'] }}</p></td>
                    </tr>
                @endif
                @if (isset($result['log']['other']) && $result['log']['other'])
                    <tr>
                        <td><p>Примечание :</p></td>
                        <td><p>{{ $result['log']['other'] }}</p></td>
                    </tr>
                @endif
            </table>
        </div>
        <div class="result_item_footer">
            <!--<div class="proghress_bar"><span style="width: 67%;" class="current"></span></div>!-->
            <img src="/images/status.png">
        </div>
    </div>
    <table class="proghress_bar_text">
        <tr>
            <td><p>ПРИНЯТ</p></td>
            <td class="text_center"><p>В ПУТИ</p></td>
            <td class="text_right active"><p>ДОСТАВЛЕН</p></td>
        </tr>
    </table>
    @endforeach
@else
    <div id="results-header" style="margin: 10px auto;width: 750px;">
        <p style="padding-left: 30px;">У Вас еще нет ни одной просмотренной перевозки.</p>
    </div>
@endif
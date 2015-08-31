@if ($result)
<div id="results-table-{{ $result['identifier'] }}" class="result_block">
    <div class="result_item">
        <div class="result_item_body">
            <table>
                @if (isset($result['service']) && $result['service'])
                    <tr>
                        <td><h2># {{ $result['identifier'] }} ({{ $result['service'] }})</h2></td>
                        <td><a class="remove" onclick="App.removeTTN('{{ $result['identifier'] }}');"></a></td>
                    </tr>
                @endif
                @if (isset($result['date_arrival']) && $result['date_arrival'])
                    <tr>
                        <td><p>{{ Util::getFieldLabel('date_arrival') }} :</p></td>
                        <td><p>{{ $result['date_arrival'] }}</p></td>
                    </tr>
                @elseif (isset($result['status']) && $result['status'])
                    <tr>
                        <td><p>{{ Util::getFieldLabel('status') }} :</p></td>
                        <td>
                            <p>{{ $result['status'] }}</p>
                        </td>
                    </tr>
                @endif
            </table>
        </div>
        <div class="result_item_footer">
            <div class="row">
                <div class="col-xs-2 colum_first">
                    <a class="button info" href="javascript:void(0);" data-label-hide="Скрыть" data-label-show="Подробнее" onclick="ShowResult.init($(this))">Подробнее</a>
                </div>
                <div class="col-xs-10 colum_last">
                    <div class="progress_bar">
                        <?php

                            $routeStatuses = explode(',', Settings::get('delivery_statuses_route'));
                            foreach ($routeStatuses as $index => $routeStatus) {
                                $routeStatuses[$index] = mb_strtolower(trim($routeStatus));
                            }

                            $deliveredStatuses = explode(',', Settings::get('delivery_statuses_delivered'));
                            foreach ($deliveredStatuses as $index => $deliveredStatus) {
                                $deliveredStatuses[$index] = mb_strtolower(trim($deliveredStatus));
                            }

                            $issuedStatuses = explode(',', Settings::get('delivery_statuses_issued'));
                            foreach ($issuedStatuses as $index => $issuedStatus) {
                                $issuedStatuses[$index] = mb_strtolower(trim($issuedStatus));
                            }

                            $statusToCheck = mb_strtolower(trim($result['status']));
                        ?>
                        
                        <span class="shapes_first act"></span>
                        @if (in_array($statusToCheck, $issuedStatuses))
                            @for($i = 0; $i < 18; $i++)
                                <span class="shapes act {{ ($i == 18) ? 'last' : '' }}"></span>
                            @endfor
                            <span class="shapes_last act"></span>
                        @elseif (in_array($statusToCheck, $deliveredStatuses))
                            @for($i = 0; $i < 18; $i++)
                                <span class="shapes {{ ($i < 14) ? 'act' : '' }} {{ ($i == 18) ? 'last' : '' }}"></span>
                            @endfor
                            <span class="shapes_last"></span>
                        @elseif (in_array($statusToCheck, $routeStatuses))
                            @for($i = 0; $i < 18; $i++)
                                <span class="shapes {{ ($i < 9) ? 'act' : '' }} {{ ($i == 18) ? 'last' : '' }}"></span>
                            @endfor
                            <span class="shapes_last"></span>
                        @else
                            @for($i = 0; $i < 18; $i++)
                                <span class="shapes {{ ($i < 4) ? 'act' : '' }} {{ ($i == 18) ? 'last' : '' }}"></span>
                            @endfor
                            <span class="shapes_last"></span>
                        @endif
                        
                        <div class="clear"></div>

                        <table class="proghress_bar_text">
                            <tr>
                                <td><p>Принят</p></td>
                                <td class="text_center"><p>В пути</p></td>
                                <td class="text_center"><p>Доставлен</p></td>
                                <td class="text_right"><p>Выдан</p></td>
                            </tr>
                        </table>
                    </div>  
                </div>
            </div>
        </div>
    </div>
    
    <div class="short_text_container">
        <div class="result_item_body">
            <table>
                @foreach ($fieldNames as $fieldName)
                    <tr>
                        <td><p>{{ Util::getFieldLabel($fieldName) }} :</p></td>
                        <td>
                            @if (array_key_exists($fieldName, $result) && $result[$fieldName])
                                <p>
                                    {{ $result[$fieldName] }}
                                    @if ($fieldName == 'weight') кг @endif
                                    @if ($fieldName == 'volume') м<sup><small>3</small></sup> @endif
                                    @if ($fieldName == 'price') грн @endif
                                </p>
                            @else
                                <p class="no-info">{{ '&lt;Информация не предоставляется&gt;' }}</p>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
        <div class="clearfix"></div>
    </div>
</div>
@endif
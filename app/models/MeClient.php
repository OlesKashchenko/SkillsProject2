<?php

/*
 * ActionId:
 * 6 - Поступление отправки на отделение
 * 41 - отправка передана курьеру
 * 11 - сортировка посылок
 * 20 - отправка сгрупирована для перемещения в сортировочный центр
 * 21 - розгрупирование отправки для сортировки
 * 10 - сортировка посылок
 * 13 - выдано курьеру
 * 15 - спланировано доставку отправки на
 * 14 - принято филией
 * 17 - отправка выдана со склада получателю
 */
class MeClient extends PostClient
{
    private $statusMessages = array(
        'ru'    => array(
            6   => 'Поступление отправления на отделение',
            41  => 'Отправление передано курьеру для перемещения',
            11  => 'Сортировка посылок',
            20  => 'Отправление было сгруппировано для перемещения на сортировочный центр',
            21  => 'Разгруппирование отправления для сортировки',
            10  => 'Сортировка посылок',
            13  => 'Выдано курьеру',
            15  => 'Запланированная доставка на',
            14  => 'Принято филиалом',
            17  => 'Выдано из склада получателю',
            777 => 'В обработке'
        )
    );

    function __construct()
    {
        $this->service = 'Meest Express';
        $this->apiUrl = 'https://t.meest-group.com/get.php?what=tracking&number=';
    }

    public function sendRequest()
    {
        $this->response = file_get_contents($this->apiUrl . '?what=tracking&number=' . $this->identifier);
    }

    public function buildRequestData($identifier)
    {
        $this->identifier = $identifier;
    }

    public function formResult()
    {
        $xmlString = simplexml_load_string($this->response);
        $xmlItems = $xmlString->result_table->items;

        if (!$xmlItems) {
            return false;
        }

        $firstItem = $xmlItems[0];
        $lastItem = $xmlItems[count($xmlItems) - 1];

        $route = strval($firstItem->City) . ' (' . strval($firstItem->Country) . ')';
        if (count($xmlItems) > 1) {
            $route = $route . ' - ' . strval($lastItem->City) . ' (' . strval($lastItem->Country) . ')';
        }

        if (isset($this->statusMessages['ru']["$lastItem->ActionId"])) {
            $status = $this->statusMessages['ru']["$lastItem->ActionId"];
        } else {
            $status = $this->statusMessages['ru'][777];
        }

        $address = strval($lastItem->City) . ' (' . strval($lastItem->Country) . ')';
        if (isset($lastItem) && $lastItem) {
            $this->result = array(
                'service'           => $this->service,
                'identifier'        => $this->identifier,
                'status'            => $status . ' ' . strval($lastItem->DetailMessages),
                'route'             => TableBuilder::translate($route, 'uk-ru'),
                'address'           => TableBuilder::translate($address, 'uk-ru'),
                'date_arrival'      => strval($lastItem->DateTimeAction)
            );

            return true;
        } else {
            return false;
        }
    }
} 
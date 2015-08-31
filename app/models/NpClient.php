<?php

use Sunra\PhpSimple\HtmlDomParser;

class NpClient extends PostClient
{
    private $orderStatuses = array(
        1  => 'Заказ в обработке',
        2  => 'Удалено',
        3  => 'Номер не найден',
        4  => 'Готовится к отправлению',
        5  => 'Отправлено',
        6  => 'Готовится к выдаче',
        7  => 'Прибыл в отделение',
        8  => 'Не определено',
        9  => 'На пути к получателю',
        10 => 'Получен',
        11 => 'Отказ',
        12 => 'Отменяется',
        13 => 'Сохранение прекращено',
        14 => 'Изменен адрес',
        15 => 'Обратная доставка',
        16 => 'Обратная доставка - денежный перевод',
        17 => 'Переадресация',
        18 => 'Возврат',
        19 => 'Начисляется оплата за сохранение',
        20 => 'Забран отправителем'
    );


    function __construct()
    {
        $this->service = 'Нова Пошта';

        $this->apiUrl = Config::get('clients.nova_poshta.api_url');
        $this->apiKey = Config::get('clients.nova_poshta.api_key');

        $this->badStatuses = array(3);
    }

    public function buildRequestData($identifier)
    {
        $this->identifier = $identifier;
        $documents = array($this->identifier);

        $this->xml = array(
            'apiKey'            => $this->apiKey,
            'modelName'         => 'InternetDocument',
            'calledMethod'      => 'documentsTracking',
            'methodProperties'  => array('Documents' => $documents)
        );
    }

    public function sendRequest()
    {
        $ch = curl_init($this->apiUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($this->xml));

        $this->response = curl_exec($ch);
        $this->response = json_decode($this->response, true);

        curl_close($ch);
    }

    public function formResult()
    {
        if (!$this->response['success'] || !isset($this->response['data'][0])) {
            return false;
        }

        $this->response = $this->response['data'][0];
        if (in_array($this->response['StateId'], $this->badStatuses)) {
            return false;
        }

        $this->result = array(
            'service'       => $this->service,
            'identifier'    => $this->identifier,
            'status'        => $this->orderStatuses[$this->response['StateId']],
            'route_start'   => $this->response['CitySenderRU'],
            'route_end'     => $this->response['CityReceiverRU'],
            'route'         => $this->response['CitySenderRU'] . ' - ' . $this->response['CityReceiverRU'],
            'address'       => $this->response['AddressRU'],
            'date_arrival'  => $this->response['DateReceived'],
            'date_received' => $this->response['DateReceived'],
            'delivery_type' => $this->response['DeliveryType'],
            'weight'        => $this->response['DocumentWeight'],
            'price'         => $this->response['Sum'],
        );

        $this->prepareData();

        return true;
    }

    private function prepareData()
    {
        foreach ($this->result as $key => $value) {
            $this->result[$key] = strip_tags($value);
        }
    }
} 
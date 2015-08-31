<?php

use Sunra\PhpSimple\HtmlDomParser;

class DeliveryClient extends PostClient
{
    function __construct()
    {
        $this->service = 'Delivery';
        $this->apiUrl = 'http://www.delivery-auto.com.ua/ru-RU/Receipts/Details';
    }

    public function buildRequestData($identifier)
    {
        $this->identifier = $identifier;

        $params = array('id' => $this->identifier);

        $this->paramsList = http_build_query($params);
    }

    public function sendRequest()
    {
        try {
            $this->response = file_get_contents($this->apiUrl . '?' . $this->paramsList);
        } catch (Exception $e) {

        }
    }

    public function formResult()
    {
        if (!$this->response) {
            return false;
        }

        $this->html = HtmlDomParser::str_get_html($this->response);

        $status = $this->html->find('.receiptsFormLogo', 0)->find('span', 0)->find('b', 0)->innertext;
        $dateLeave = $this->html->find('#SendDateStringified', 0)->value;
        $dateArrival = $this->html->find('#ReceiveDateStringified', 0)->value;
        $routeStart = $this->html->find('#SenderWarehouseName', 0)->value;
        $routeEnd = $this->html->find('#RecepientWarehouseName', 0)->value;
        $address = $this->html->find('#RecepientWarehouseAddress', 0)->value;

        $this->result = array(
            'status'        => $status,
            'date_leave'    => $dateLeave,
            'date_arrival'  => $dateArrival,
            'route_start'   => $routeStart,
            'route_end'     => $routeEnd,
            'address'       => $address,
            'service'       => $this->service,
            'identifier'    => $this->identifier
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
<?php

use Sunra\PhpSimple\HtmlDomParser;

class AutoLuxClient extends PostClient
{
    function __construct()
    {
        $this->service = 'Автолюкс';
        $this->apiUrl = 'http://www.autolux.ua/tracking/';
        $this->badStatuses = array('не найдено');
    }

    public function buildRequestData($identifier)
    {
        $this->identifier = $identifier;

        $this->xml = array(
            'ttn_search' => $identifier
        );
    }

    public function sendRequest()
    {
        $ch = curl_init($this->apiUrl);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $this->xml);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array());

        $result = curl_exec($ch);

        $this->html = HtmlDomParser::str_get_html($result);
    }

    public function formResult()
    {
        $statusCheck = 0;

        if (!is_object($this->html)) {
            return false;
        }

        $cargoInfo = $this->html->find('#cargo_info', 0);
        if (!is_object($cargoInfo)) {
            return false;
        }

        $resultHtml = $this->html->find('#cargo_info', 0)->innertext;

        if ($this->strposArray($resultHtml, $this->badStatuses)) {
            return false;
        }

        if (strpos($resultHtml, 'Багаж на складе получателя в городе')) {
            $status = 'Отправление прибыло. Багаж на складе получателя в городе.';
            $statusCheck = 2;
        } else {
            $status = 'Не получено';
        }

        // дата прибытия
        $date = '';
        $resultHtml = $this->html->find('#cargo_info', 0)->find('div', 0)->innertext;
        $datePos = strpos($resultHtml, 'Дата:');
        if ($datePos) {
            $startDatePos = $datePos + 10;
            $endDatePos = $startDatePos + 10;
            $date = trim(substr($resultHtml, $startDatePos, $endDatePos));
        }

        // адрес
        $address = '';
        $resultHtml = $this->html->find('#cargo_info', 0)->find('div', 0)->innertext;
        $startAddressPos = strpos($resultHtml, '</span>');
        $endAddressPos = strpos($resultHtml, 'Дата');
        if ($startAddressPos && $endAddressPos) {
            $address = trim(substr($resultHtml, $startAddressPos, $endAddressPos));
        }

        $this->result = array(
            'status'        => $status,
            'address'       => $address,
            'date_arrival'  => $date,
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
<?php

use Sunra\PhpSimple\HtmlDomParser;

class TntClient extends PostClient
{
    function __construct()
    {
        $this->service = 'TNT';
        $this->apiUrl = 'http://aero-express.com.ua/ru/callback';
        $this->badStatuses = array(
            'не найдено информации',
            'Неверное количество цифр.',
            'Код должен содержать только цифры.'
        );
    }

    public function buildRequestData($identifier)
    {
        $this->identifier = $identifier;

        $this->xml = array(
            'code_or_mark'  => 'is_code',
            'code'          => $identifier,
            'form_id'       => 'simple_ajax_popup_form'
        );
    }

    public function sendRequest()
    {
        $ch = curl_init($this->apiUrl);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $this->xml);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array());

        $this->response = curl_exec($ch);
    }

    public function formResult()
    {
        $decodedResponse = json_decode($this->response, 1);

        $strResult = '';
        if (!isset($decodedResponse[2]['data'])) {
            return false;
        } else {
            $strResult = $decodedResponse[2]['data'];
        }

        if (in_array(strip_tags($strResult), $this->badStatuses)) {
            return false;
        }

        $this->html = HtmlDomParser::str_get_html($strResult);

        $commonInfoTable = $this->html->find('#common_information', 0);
        $locationInfoTable = $this->html->find('#location', 0);

        if (!is_object($commonInfoTable) && !is_object($locationInfoTable)) {
            return false;
        }

        // дата отправки
        $dateLeave = $commonInfoTable->find('tr', 2)->find('td', 1)->innertext;

        // дата прибытия
        $dateArrival = $commonInfoTable->find('tr', 5)->find('td', 1)->innertext;

        // адрес получателя
        $address = $commonInfoTable->find('tr', 4)->find('td', 1)->innertext;

        // город отправки
        $routeStart = $commonInfoTable->find('tr', 3)->find('td', 1)->innertext;

        // город получения
        $routeEnd = $commonInfoTable->find('tr', 4)->find('td', 1)->innertext;

        // имя получатедя
        $receiverName = $commonInfoTable->find('tr', 6)->find('td', 1)->innertext;

        // статус
        $status = $locationInfoTable->find('tr', 2)->find('td', 3)->innertext;

        $this->result = array(
            'status' => $status,
            'route_start' => $routeStart,
            'route_end' => $routeEnd,
            'route' => $routeStart . ' - ' . $routeEnd,
            'address' => $address,
            'name_receiver' => $receiverName,
            'date_leave' => $dateLeave,
            'date_arrival' => $dateArrival,
            'service' => $this->service,
            'identifier' => $this->identifier
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
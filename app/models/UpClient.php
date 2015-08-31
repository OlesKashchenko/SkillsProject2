<?php

use Sunra\PhpSimple\HtmlDomParser;

class UpClient extends PostClient
{

    function __construct()
    {
        $this->service = 'УкрПошта';
        $this->apiUrl = 'http://services.ukrposhta.com/barcodestatistic/barcodestatistic.asmx/GetBarcodeInfo';
        $this->badStatuses = array('відсутні', 'не зареєстровані');
    }

    public function buildRequestData($identifier)
    {
        $this->identifier = $identifier;

        $params = array(
            'guid'      => 'fcc8d9e1-b6f9-438f-9ac8-b67ab44391dd',
            'culture'   => 'uk',
            'barcode'   => $this->identifier
        );

        $this->paramsList = http_build_query($params);
    }

    public function sendRequest()
    {
        $this->response = file_get_contents($this->apiUrl . '?' . $this->paramsList);
    }

    public function formResult()
    {
        $resultObject = simplexml_load_string($this->response);

        if (!$resultObject) {
            return false;
        }

        $receiverCode = substr($this->identifier, 0, 2);
        $receiverCountryName = Country::where('code', $receiverCode)->pluck('name_ru');

        $senderCode = substr($this->identifier, 11, 2);
        $senderCountryName = Country::where('code', $senderCode)->pluck('name_ru');

        $description = $resultObject->eventdescription;
        if ($this->strposArray($description, $this->badStatuses)) {
            return false;
        }

        $status = strpos($description, 'відправлене') ? 'Отправлено' : 'В обработке';
        $dateLeave = $resultObject->eventdate;
        $routeStart = $resultObject->lastoffice . ' ' . $resultObject->lastofficeindex;
        if ($senderCountryName) {
            $routeStart .= ' (' . $senderCountryName .')';
        }

        $this->result = array(
            'service'       => $this->service,
            'identifier'    => $this->identifier,
            'route_start'   => TableBuilder::translate($routeStart, 'uk-ru'),
            'route_end'     => $receiverCountryName,
            'date_leaving'  => $dateLeave,
            'status'        => $status,
            'other'         => TableBuilder::translate($description, 'uk-ru'),
        );

        return true;
    }
} 
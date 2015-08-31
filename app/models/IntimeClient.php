<?php

class IntimeClient extends PostClient
{

    private $availableFields = array(
        'Ves'                       => 'weight',
        'VidPerevozki'              => 'delivery_type',
        'Viezd'                     => 'leaving',
        'GorodOtpravitel'           => 'route_start',
        'GorodPoluchatel'           => 'route_end',
        'KolvoMest'                 => 'places_count',
        'Obem'                      => 'volume',
        'OpisanieGruza'             => 'other',
        'Oplachivaet'               => 'payer',
        'Otpravitel'                => 'name_sender',
        'Poluchatel'                => 'name_receiver',
        'Summa'                     => 'price',
        'Data'                      => 'date_leave'
    );
    

    function __construct()
    {
        $this->service = 'Интайм';
        $this->apiUrl = Config::get('clients.intime.api_url');
        $this->apiId = Config::get('clients.intime.api_id');
        $this->apiKey = Config::get('clients.intime.api_key');

        $this->xml = array();
    }

    public function sendRequest()
    {
        try {
            $testClient = file_get_contents($this->apiUrl);
        } catch (\Exception $e) {
            return;
        }

        $client = new \SoapClient($this->apiUrl);

        $this->response = $client->__soapCall('InfoTTN', $this->xml)->return;
        $this->response = $this->_toArray($this->response);
    }

    public function buildRequestData($identifier)
    {
        $this->identifier = $identifier;

        $this->xml['InfoTTN']['InfoTTNRequest']['Auth'] = array(
            'ID'    => $this->apiId,
            'KEY'   => $this->apiKey,
        );

        $this->xml['InfoTTN']['InfoTTNRequest']['Number'] = $this->identifier;

        $this->xml['InfoTTN']['InfoTTNRequest']['InformationField'][] = array('InformationName' => 'Ves');
        $this->xml['InfoTTN']['InfoTTNRequest']['InformationField'][] = array('InformationName' => 'VidPerevozki');
        $this->xml['InfoTTN']['InfoTTNRequest']['InformationField'][] = array('InformationName' => 'GorodOtpravitel');
        $this->xml['InfoTTN']['InfoTTNRequest']['InformationField'][] = array('InformationName' => 'GorodPoluchatel');
        $this->xml['InfoTTN']['InfoTTNRequest']['InformationField'][] = array('InformationName' => 'Data');
        $this->xml['InfoTTN']['InfoTTNRequest']['InformationField'][] = array('InformationName' => 'Obem');
        $this->xml['InfoTTN']['InfoTTNRequest']['InformationField'][] = array('InformationName' => 'Oplachivaet');
        //$this->xml['InfoTTN']['InfoTTNRequest']['InformationField'][] = array('InformationName' => 'Otpravitel');
        //$this->xml['InfoTTN']['InfoTTNRequest']['InformationField'][] = array('InformationName' => 'PlatelchikTreteeLico');
        //$this->xml['InfoTTN']['InfoTTNRequest']['InformationField'][] = array('InformationName' => 'Poluchatel');
        $this->xml['InfoTTN']['InfoTTNRequest']['InformationField'][] = array('InformationName' => 'Summa');
        $this->xml['InfoTTN']['InfoTTNRequest']['InformationField'][] = array('InformationName' => 'Viezd');
        $this->xml['InfoTTN']['InfoTTNRequest']['InformationField'][] = array('InformationName' => 'GorodPoluchatelPSTretelico');
        $this->xml['InfoTTN']['InfoTTNRequest']['InformationField'][] = array('InformationName' => 'Dostavka');
        $this->xml['InfoTTN']['InfoTTNRequest']['InformationField'][] = array('InformationName' => 'KolvoMest');
        //$this->xml['InfoTTN']['InfoTTNRequest']['InformationField'][] = array('InformationName' => 'OpisanieGruza');
        $this->xml['InfoTTN']['InfoTTNRequest']['InformationField'][] = array('InformationName' => 'PostService');
    }

    public function formResult()
    {
        if (!isset($this->response['InterfaceState']) || !in_array($this->response['InterfaceState'], array('OK', 'ОК'))) {
            return false;
        }

        if (!isset($this->response['TTNClient'])) {
            return false;
        }

        $this->result = array(
            'service'       => $this->service,
            'identifier'    => $this->identifier
        );

        if (isset($this->response['TTNClient']['TTNState'])) {
            $this->result['status'] = $this->response['TTNClient']['TTNState'];
        }

        if (isset($this->response['TTNClient']['DeliveryDate'])) {
            $this->result['date_arrival'] = $this->response['TTNClient']['DeliveryDate'];
        }

        $additionalInfo = $this->response['TTNClient']['AppendField'];
        foreach ($additionalInfo as $addInfo) {
            $currentFieldName = $addInfo['AppendFieldName'];
            $currentFieldValue = $addInfo['AppendFieldValue'];

            if (!isset($this->availableFields[$currentFieldName])) {
                continue;
            }

            $currentFieldCorrectName = $this->availableFields[$currentFieldName];
            $this->result[$currentFieldCorrectName] = $currentFieldValue;
        }

        if (isset($this->result['route_start']) && isset($this->result['route_end'])) {
            $this->result['route'] = $this->result['route_start'] . ' - ' . $this->result['route_end'];
        }

        return true;
    }

    private function _toArray($variable) {
        is_object($variable) AND $variable = (array)$variable;

        if (is_array($variable)) {
            foreach ($variable as $key => $value) {
                is_object($value) AND $value = (array)$value;
                $variable[$key] = $this->_toArray($value);
            }
        }

        return $variable;
    }
} 
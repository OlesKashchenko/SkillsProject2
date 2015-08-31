<?php


class NeClient extends PostClient
{
    function __construct()
    {
        $this->service = 'Ночной экспресс';
        $this->apiUrl = 'http://nexpress.com.ua/ne-track-cargo/check-cargo?code=';
    }

    public function sendRequest()
    {
        $this->response = file_get_contents($this->apiUrl . $this->identifier);
    }

    public function buildRequestData($identifier)
    {
        $this->identifier = $identifier;
    }

    public function formResult()
    {
        $result = json_decode($this->response);

        if (!is_object($result)) {
            return false;
        }

        if (isset($result->msg) && strstr($result->msg, "Груз по номеру транспортной накладной в пути")) {
            return false;
        }

        $this->result = array(
            'status'        => $result->msg,
            'service'       => $this->service,
            'identifier'    => $this->identifier
        );

        if (isset($result->town) && $result->town) {
            $this->result['route'] = $result->town;
            $this->result['address'] = $result->town;
        }

        return true;
    }
} 
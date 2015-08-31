<?php

abstract class PostClient
{
    // ключ API
    protected $apiKey;

    // url API
    protected $apiUrl;

    // запрос к API
    protected $xml;

    // результат в формате html
    protected $html;

    // ответ API
    protected $response;

    // статусы отсутствия номера накладной
    protected $badStatuses = array();

    // результат для вывода на фронт
    protected $result = array();

    // номер ТТН
    protected $identifier = '';

    // список get-параметров
    protected $paramsList = '';

    // название службы
    protected $service = '';

    /*
     * Выполнить запрос
     */
    abstract function sendRequest();


    /*
     * Сформировать запрос
     */
    abstract function buildRequestData($identifier);


    /*
     * Парсинг данных о перевозке
     * Массив результата хранит следующие поля:
     *      status - состояние заказа
     *      route - маршрут следования
     *      address - адрес получателя
     *      date_arrival - дата прибытия
     * Если функция возвращает false, номера перевозки не существует
     */
    abstract function formResult();


    /*
    * Вернуть результат
    */
    public function getResult()
    {
        return $this->result;
    }


    /*
     * Поиск значения в массиве строк
     */
    public function strposArray($haystack, $needles)
    {
        if (is_array($needles)) {
            foreach ($needles as $str) {
                if (is_array($str)) {
                    $pos = strpos_array($haystack, $str);
                } else {
                    $pos = strpos($haystack, $str);
                }
                if ($pos !== false) {
                    return $pos;
                }
            }
        } else {
            return strpos($haystack, $needles);
        }
    }
} 
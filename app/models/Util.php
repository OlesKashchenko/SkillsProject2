<?php

class Util
{

    private static $fieldNames = array(
        'date_leave',
        'route_start',
        'route_end',
        'route',
        'status',
        'phone_receiver',
        'delivery_type',
        'places_count',
        'weight',
        'volume',
        'date_arrival',
        'price',
        'payer',
        //
        //'address',
        //'leaving',
        //'back_deliver',
        //'other',
        //'name_sender',
        //'name_receiver',
        //'documents',
    );

    private static $fieldLabels = array(
        'status'        => 'Статус доставки',
        'route'         => 'Маршрут груза',
        'route_start'   => 'Пункт отправления',
        'route_end'     => 'Пункт назначения',
        'phone_receiver'=> 'Контакты',
        'address'       => 'Адрес',
        'date_leave'    => 'Дата отправления',
        'leaving'       => 'Время отправления',
        'date_arrival'  => 'Дата прибытия',
        'payer'         => 'Оплачивает',
        'back_deliver'  => 'Обратная доставка',
        'delivery_type' => 'Вид перевозки',
        'name_sender'   => 'Отправитель',
        'name_receiver' => 'Получатель',
        'weight'        => 'Вес',
        'volume'        => 'Объем',
        'places_count'  => 'Количество мест',
        'price'         => 'Сумма к оплате'
    );

    public static function getFieldLabel($fieldName)
    {
        return self::$fieldLabels[$fieldName];
    } // end getFieldLabel

    public static function getFieldNames()
    {
        return self::$fieldNames;
    } // end getFieldNames
}

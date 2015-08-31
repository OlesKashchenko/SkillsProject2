<?php

return array(
    'db' => array(
        'table' => 'users',
            'order' => array(
            'id' => 'ASC',
        ),
        'pagination' => array(
            'per_page' => 12,
            'uri' => '/admin/tb/users',
        ),
    ),
    'options' => array(
        'caption' => 'Пользователи',
        'ident' => 'users-container',
        'form_ident' => 'users-form',
        'table_ident' => 'users-table',
        'action_url' => '/admin/handle/users',
        'handler'    => 'UsersTableHandler',
        'not_found'  => 'NOT FOUND',
    ),
    
    'fields' => array(
        'id' => array(
            'caption' => '#',
            'type' => 'readonly',
            'class' => 'col-id',
            'width' => '1%',
            'hide' => true,
        ),
        'email' => array(
            'caption' => 'Email',
            'type' => 'text',
            'filter' => 'text',
            'is_sorting' => true,
            'validation' => array(
                'server' => array(
                    'rules' => 'required'
                ),
                'client' => array(
                    'rules' => array(
                        'required' => true
                    ),
                    'messages' => array(
                        'required' => 'Обязательно к заполнению'
                    )
                )
            ),
        ),
        'first_name' => array(
            'caption' => 'Имя',
            'type'    => 'text',
        ),
        'last_name' => array(
            'caption' => 'Фамилия',
            'type'    => 'text',
        ),
        'activated' => array(
            'caption' => 'Активен',
            'type' => 'checkbox',
            'filter' => 'select',
            'options' => array(
                1 => 'Активные',
                0 => 'He aктивные',
            ),
        ),
    ),
    
    'actions' => array(
        'search' => array(
            'caption' => 'Поиск',
        ),
        'insert' => array(
            'caption' => 'Добавить',
        ),
        'custom' => array(
            array(
                'caption' => 'Редактировать',
                'icon' => 'pencil',
                'link' => '/admin/tb/users/%d',
                'params' => array(
                    'id'
                )
            )
        ),
        'delete' => array(
            'caption' => 'Удалить',
        ),
    ),
);
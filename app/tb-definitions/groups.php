<?php

return array(
    'db' => array(
        'table' => 'groups',
            'order' => array(
            'id' => 'ASC',
        ),
        'pagination' => array(
            'per_page' => 12,
            'uri' => '/admin/tb/groups',
        ),
    ),
    'options' => array(
        'caption' => 'Группы пользователи',
        'ident' => 'users-container',
        'form_ident' => 'users-form',
        'table_ident' => 'users-table',
        'action_url' => '/admin/handle/groups',
        'handler'    => 'GroupsTableHandler',
        'not_found'  => 'NOT FOUND',
    ),
    
    'fields' => array(
        'id' => array(
            'caption' => '#',
            'type' => 'readonly',
            'class' => 'col-id',
            'width' => '1%',
            'hide' => true,
            'is_sorting' => true,
        ),
        'name' => array(
            'caption' => 'Название',
            'type' => 'text',
            'filter' => 'text',
            'is_sorting' => true,
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
                'link' => '/admin/tb/groups/%d',
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
<?php

return array(
    'db' => array(
        'table' => 'settings',
        'order' => array(
            'id' => 'ASC',
        ),
        'pagination' => array(
            'per_page' => 12,
            'uri' => '/admin/settings',
        ),
    ),
    'options' => array(
        'caption' => 'Настройки',
        'ident' => 'settings-container',
        'form_ident' => 'settings-form',
        'table_ident' => 'settings-table',
        //'is_form_fullscreen' => true,
        'action_url' => '/admin/handle/settings',
        'handler' => 'SettingsTableHandler',
        'not_found' => 'NOT FOUND',
    ),
    'fields' => array(
        'id' => array(
            'caption' => '#',
            'type' => 'readonly',
            'class' => 'col-id',
            'width' => '1%',
            'hide' => true,
            'is_sorting' => true
        ),
        'name' => array(
            'caption' => 'Идентификатор',
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
            )
        ),
        'value' => array(
            'caption' => 'Значение',
            'type' => 'textarea',
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
            )
        ),
        'description' => array(
            'caption' => 'Описание',
            'type' => 'text',
            'filter' => 'text'
        ),
        //'custom' => array(
        //    'caption' => 'Кастомное поле',
        //    'type' => 'custom',
        //)
    ),
    'filters' => array(
    ),
    'actions' => array(
        'search' => array(
            'caption' => 'Поиск',
        ),
        'insert' => array(
            'caption' => 'Добавить',
            'check' => function() {
                return true;
            }
        ),
        'update' => array(
            'caption' => 'Update',
            'check' => function() {
                return true;
            }
        ),
        'delete' => array(
            'caption' => 'Remove',
            'check' => function() {
                return true;
            }
        ),
    ),
);
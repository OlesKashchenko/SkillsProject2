<?php

return array(
    'db' => array(
        'table' => 'email_templates',
        'order' => array(
            'id' => 'DESC',
        ),
        'pagination' => array(
            'per_page' => 20,
            'uri' => '/admin/email-templates',
        ),
    ),
    'options' => array(
        'caption' => 'Шаблоны писем',
        'ident' => 'products-container',
        'form_ident' => 'products-form',
        'form_width' => '920px',
        'table_ident' => 'products-table',
        'action_url' => '/admin/handle/email-templates',
        'handler'   => 'EmailsTableHandler',
        'not_found' => 'NOT FOUND',
    ),

    'fields' => array(
        'id' => array(
            'caption' => 'ID',
            'type' => 'readonly',
            'class' => 'col-id',
            'width' => '1%',
            'hide' => true,
            'is_sorting' => true
        ),
        'ident' => array(
            'caption' => 'Идентификатор',
            'type' => 'text',
            'filter' => 'text',
            'width' => '5%',
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
        'description' => array(
            'caption' => 'Описание',
            'type' => 'text',
            'filter' => 'text',
        ),
        'subject' => array(
            'caption' => 'Заголовок',
            'type' => 'text',
            'filter' => 'text',
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
        'body' => array(
            'caption' => 'Тело письма',
            'type' => 'wysiwyg',
            'hide_list' => true,
        ),
    ),
    
    'filters' => array(
    ),
    
    'actions' => array(
        'search' => array(
            'caption' => 'Поиск',
        ),
        'insert' => array(
            'caption' => 'Добавить',
        ),
        'update' => array(
            'caption' => 'Изменить',
        ),
        'delete' => array(
            'caption' => 'Удалить',
        ),
    ),
);
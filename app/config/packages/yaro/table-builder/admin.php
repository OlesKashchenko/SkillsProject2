<?php

return array(

    'uri' => '/admin',

    'user_name'  => function() {
        return 'Default Username';
    },
    'user_image' => function() {
        return 'http://www.cmakers.org/Img/kitty_artwork_04.gif';
    },

    'menu' => array(
        array(
            'title' => 'Главная',
            'icon'  => 'home',
            'link'  => '/',
            'check' => function() {
                return true;
            }
        ),
        array(
            'title' => 'Настройки',
            'icon'  => 'cog',
            'link'  => '/settings',
            'check' => function() {
                return true;
            }
        ),
        array(
            'title' => 'Шаблоны писем',
            'icon'  => 'th-list',
            'link'  => '/email-templates',
            'check' => function() {
                return true;
            }
        ),
        array(
            'title' => 'Упр. пользователями',
            'icon'  => 'user',
            'submenu' => array(
                array(
                    'title' => 'Пользователи',
                    'link'  => '/tb/users',
                    'pattern' => '/tb/users/?\d*',
                    'check' => function() {
                        return true;
                    }
                ),
                array(
                    'title' => 'Группы',
                    'link'  => '/tb/groups',
                    'check' => function() {
                        return true;
                        //$readOnly = Sentry::findGroupByName('readonly');
                        //return !Sentry::getUser()->inGroup($readOnly);
                    }
                ),
            )
        ),
    ),
);

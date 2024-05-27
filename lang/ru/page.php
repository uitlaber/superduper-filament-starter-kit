<?php

return [
   
    'general_settings' => [
        'title' => 'общие настройки',
        'heading' => 'общие настройки',
        'subheading' => 'Здесь можно управлять общими настройками сайта.',
        'navigationLabel' => 'Общий',
        'sections' => [
            'site' => [
                'title' => 'Сайт',
                'description' => 'Управление базовыми настройками.',
            ],
            'theme' => [
                'title' => 'Тема',
                'description' => 'Изменить тему по умолчанию.',
            ],
        ],
        'fields' => [
            'brand_name' => 'Имя бренда',
            'site_active' => 'Статус сайта',
            'brand_logoHeight' => 'Высота логотипа бренда',
            'brand_logo' => 'Логотип бренда',
            'site_favicon' => 'Фавикон сайта',
            'primary' => 'Начальный',
            'secondary' => 'вторичный',
            'gray' => 'Серый',
            'success' => 'Успех',
            'danger' => 'Опасность',
            'info' => 'Информация',
            'warning' => 'Предупреждение',
        ],
    ],
    'mail_settings' => [
        'title' => 'Настройки почты',
        'heading' => 'Настройки почты',
        'subheading' => 'Управление конфигурацией почты.',
        'navigationLabel' => 'Почта',
        'sections' => [
            'config' => [
                'title' => 'Конфигурация',
                'description' => 'описание',
            ],
            'sender' => [
                'title' => 'От (Отправитель)',
                'description' => 'описание',
            ],
            'mail_to' => [
                'title' => 'Отправить по адресу',
                'description' => 'описание',
            ],
        ],
        'fields' => [
            'placeholder' => [
                'receiver_email' => 'Электронная почта получателя..',
            ],
            'driver' => 'Водитель',
            'host' => 'Хозяин',
            'port' => 'Порт',
            'encryption' => 'Шифрование',
            'timeout' => 'Тайм-аут',
            'username' => 'Имя пользователя',
            'password' => 'Пароль',
            'email' => 'Электронная почта',
            'name' => 'Имя',
            'mail_to' => 'Отправить по адресу',
        ],
        'actions' => [
            'send_test_mail' => 'Отправить тестовое письмо',
        ],
    ]
    ];

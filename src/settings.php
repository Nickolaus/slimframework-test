<?php
return [
    'settings' => [
        'displayErrorDetails' => true, // set to false in production
        'addContentLengthHeader' => false, // Allow the web server to send the content-length header

        // Renderer settings
        'view' => [
            'template_path' => __DIR__ . '/../templates/',
            'cache_path' => false,
//            'cache_path' => __DIR__ . '/../var/cache/',

        ],

        // Monolog settings
        'logger' => [
            'name' => 'slim-app',
            'path' => __DIR__ . '/../logs/app.log',
            'level' => \Monolog\Logger::DEBUG,
        ],
        'db' => [
            'host' => '127.0.0.1',
            'dbname' => 'slim_test',
            'user' => 'root',
            'pass' => 'root'
        ]
    ],
];

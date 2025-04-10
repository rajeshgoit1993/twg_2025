<?php

return [

    'channels' => [
        'stack' => [
            'driver' => 'stack',
            'channels' => ['daily'],
        ],

        'daily' => [
            'driver' => 'daily',
            'path' => storage_path('logs/laravel.log'),
            'level' => 'debug',
            'days' => 14,
        ],

        'custom-channel' => [
            'driver' => 'single',
            'path' => storage_path('logs/custom.log'),
            'level' => 'info',
        ],
    ],

];

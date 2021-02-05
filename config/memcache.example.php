<?php

return [
    'class' => 'yii\caching\MemCache',
    'useMemcached' => true,
    'servers' => [
        [
            'host' => 'localhost',
            'port' => 11211,
            'weight' => 100,
        ],
    ],
];

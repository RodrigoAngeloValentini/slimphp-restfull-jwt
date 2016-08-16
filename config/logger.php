<?php

$container['logger'] = function($c) {
    return new Silalahi\Slim\Logger(
        [
            'path' => '../logs/',
            'name' => 'log_',
            'name_format' => 'd-m-Y',
            'extension' => 'txt',
            'message_format' => '[%label%] %date% %message%'
        ]
    );
};

$app->add('logger');
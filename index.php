<?php
include __DIR__.'/vendor/autoload.php';

date_default_timezone_set("America/Recife");

use Slim\App;

$app = new App();
$container = $app->getContainer();

$container["secret"] = 'supersecretkeyyoushouldnotcommittogithub';

require __DIR__ . "/config/middleware.php";
require __DIR__ . "/config/logger.php";
require __DIR__ . "/config/database.php";

$app->get('/', function(){
    echo 'Web Service iView Desbravador GAS';
});

$app->get('/home', function(){
    echo 'Home - Web Service iView Desbravador GAS';
});

include __DIR__.'/routes/api.php';
include __DIR__.'/routes/token.php';

$app->run();
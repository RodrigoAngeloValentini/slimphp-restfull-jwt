<?php

use App\Token;

use Slim\Middleware\JwtAuthentication;

$container["token"] = function () {
    return new Token;
};

$container["JwtAuthentication"] = function ($container) {
    return new JwtAuthentication([
        "path" => "/api",
        "passthrough" => ["/token"],
        "secret" => $container['secret'],
        "error" => function ($request, $response, $arguments) {
            $data["status"] = false;
            $data["message"] = $arguments["message"];
            return $response
                ->withHeader("Content-Type", "application/json")
                ->write(json_encode($data, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT));
        },
        "callback" => function ($request, $response, $arguments) use ($container) {
            $container["token"]->hydrate($arguments["decoded"]);
        }
    ]);
};
$app->add("JwtAuthentication");




<?php

use Firebase\JWT\JWT;
use Tuupola\Base62;

$app->post("/token", function ($request, $response, $arguments) {

    $scopes = [

    ];

    $now = new DateTime();
    $future = new DateTime("now +2 hours");

    $jti = Base62::encode(random_bytes(16));

    $payload = [
        "iat" => $now->getTimeStamp(),
        "exp" => $future->getTimeStamp(),
        "jti" => $jti,
        "scope" => $scopes
    ];

    $secret = $this->secret;

    $token = JWT::encode($payload, $secret, "HS256");

    $data["status"] = "ok";
    $data["token"] = $token;

    return $response->withStatus(201)
        ->withHeader("Content-Type", "application/json")
        ->write(json_encode($data, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT));

});


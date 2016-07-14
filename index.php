<?php

function token(){
    $key = 'supersecretkeyyoushouldnotcommittogithub';

    $header = [
        "alg" => "HS256",
        "typ" => "JWT"
    ];

    $header = json_encode($header);
    $header = base64_encode($header);

    $payload = [
        "sub" => "123456789",
        "name" => "Rodrigo Angelo Valentini",
        "admin" => true,
        "email" => "rodrigoangelovalentini@gmail.com",
        "scope" => [
            "all"
        ]
    ];

    $payload = json_encode($payload);
    $payload = base64_encode($payload);

    $signature = hash_hmac('sha256',"$header.$payload",$key,true);
    $signature = base64_encode($signature);

    $token= "$header.$payload.$signature";

    return $token;
}

echo token();
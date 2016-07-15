<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, PUT, DELETE");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept, Authorization");

use Firebase\JWT\JWT;
use Tuupola\Base62;
use Psr\Http\Message\ServerRequestInterface as ServerRequestInterface;
use Psr\Http\Message\ResponseInterface as ResponseInterface;

$app->map(['OPTIONS'], '/[{id}]', function() {
    echo '';
});

$app->post("/auth", function (ServerRequestInterface $request, ResponseInterface $response, $arguments) use ($conn){

    $post = $request->getParsedBody();
    $usuario = $post['usuario'];
    $senha = $post['senha'];
    $senha = sha1($senha);

    $qb = $conn->createQueryBuilder();
    $result = $qb->select('email,url')
        ->from('users')
        ->where('email = ? AND senha = ?')
        ->setParameter(0,$usuario)
        ->setParameter(1,$senha)
        ->execute()
        ->fetch();

    if($result){

        $now = new DateTime();
        $future = new DateTime("now +1 hours");

        $jti = Base62::encode(random_bytes(16));

        $payload = [
            "iat" => $now->getTimeStamp(),
            "exp" => $future->getTimeStamp(),
            "jti" => $jti,
            "email" => $result['email'],
            "url" => $result['url']
        ];

        $secret = $this->secret;

        $token = JWT::encode($payload, $secret, "HS256");

        $data["status"] = true;
        $data["token"] = $token;
        $data["result"] = $result;

        return $response->withStatus(201)->withHeader("Content-Type", "application/json")->write(json_encode($data));

    }else{

        $data["status"] = false;
        $data["token"] = null;

        return $response->withStatus(200)->withHeader("Content-Type", "application/json")->write(json_encode($data));
    }

});


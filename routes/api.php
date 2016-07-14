<?php

use Psr\Http\Message\ServerRequestInterface as ServerRequestInterface;
use Psr\Http\Message\ResponseInterface as ResponseInterface;

$app->get("/teste",function(ServerRequestInterface $request, ResponseInterface $response) use($conn){

    $qb = $conn->createQueryBuilder();
    $result = $qb->select('*')
        ->from('teste')
        ->execute()
        ->fetchAll();

    $response = $response->withHeader('Content-Type', 'application/json');
    $response->getBody()->write(json_encode($result));

    return $response;
});

$app->group('/api', function() {

    $this->get('/', function(ServerRequestInterface $request, ResponseInterface $response){

        return $response->withHeader('Content-Type', 'application/json')
            ->getBody()->write(
                json_encode(array('result'=>'OK'))
            );

    });

});
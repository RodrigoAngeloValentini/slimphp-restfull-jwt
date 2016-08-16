<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, PUT, DELETE");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept, Authorization");

use Psr\Http\Message\ServerRequestInterface as ServerRequestInterface;
use Psr\Http\Message\ResponseInterface as ResponseInterface;

$app->group('/api', function() use($conn){

    $this->get('/', function(ServerRequestInterface $request, ResponseInterface $response){

        return $response->withHeader('Content-Type', 'application/json')->getBody()->write(json_encode(array('result'=>'OK')));
    });

    $this->get("/empresa",function(ServerRequestInterface $request, ResponseInterface $response) use($conn){

        $qb = $conn->createQueryBuilder();
        $result = $qb->select('name,value')
            ->from('empresas')
            ->execute()
            ->fetchAll();

        $response = $response->withHeader('Content-Type', 'application/json');
        $response->getBody()->write(json_encode($result));

        return $response;
    });

});
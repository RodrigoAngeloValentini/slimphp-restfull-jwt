<?php
use Doctrine\DBAL\Configuration;
use Doctrine\DBAL\DriverManager;

$connectionParams = [
    'dbname'=>'slim-jwt',
    'user'=>'root',
    'password'=>'root',
    'host'=>'localhost',
    'driver'=>'pdo_mysql',
    "charset" => "utf8"
];

$conn = DriverManager::getConnection($connectionParams, new Configuration);
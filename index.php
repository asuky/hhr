<?php
require 'vendor/autoload.php';
\Slim\Slim::registerAutoloader();

$app = new \Slim\Slim();

$app->get('/', function () { //as closure
    echo 'Hello World';
});

$app->get('/message/', 'messageGet');
$app->post('/praise/', 'praiseAdd');

function messageGet() {
    $respJson=sprintf('{"status": "success", "user_name": "hoge", "message": ["hoge", "fuga"]}');
    echo $respJson;
}

function praiseAdd() {
    $respJson=sprintf('{"status": "success","user_name": "hoge"}');
    echo $respJson;
}

$app->run();

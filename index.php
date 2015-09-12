<?php
require 'vendor/autoload.php';
\Slim\Slim::registerAutoloader();

$app = new \Slim\Slim();

$app->get('/', function () { //as closure
    echo 'Hello World';
});

$app->get('/message/:name', 'messageGet');
$app->post('/praise/', 'praiseAdd');

function messageGet($name) {
    $respJson=sprintf('{"status": "success", "user_name": "%s", "message": ["hoge", "fuga"]}', $name);
    echo $respJson;
}

function praiseAdd() {
    $respJson=sprintf('{"status": "success","user_name": "hoge"}');
    echo $respJson;
}

$app->run();

<?php
require 'vendor/autoload.php';
\Slim\Slim::registerAutoloader();

$app = new \Slim\Slim();

$app->get('/', function () { //as closure
    echo 'Hello World';
});

$app->get('/message/:name', 'messageGet'); //classic php style with function name

function messageGet($name) {
    $respJson=sprintf('{{user_name: %s, "message":["hoge", "fuga"]}', $name);
    echo $respJson;
}

$app->run();

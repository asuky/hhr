<?php
require 'vendor/autoload.php';
\Slim\Slim::registerAutoloader();

$app = new \Slim\Slim();

$app->get('/', function () { //as closure
    echo 'Hello World';
});

$app->get('/message', 'helloName'); //classic php style with function name

function helloName($name) {
    echo "Hello $name";
}

$app->run();

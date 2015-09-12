<?php
require 'vendor/autoload.php';
require_once 'consts.php';
\Slim\Slim::registerAutoloader();

$app = new \Slim\Slim();

$app->get('/', function () { //as closure
    echo 'Hello World';
});

$app->get('/message', 'helloName'); //classic php style with function name
$app->get('/functest', 'selectMessages');

function helloName($name) {
    echo "Hello $name";
}
$app->run();

function selectMessages()
{
    // メッセージを全部呼びこむ
    $messages = file(__DIR__ . DS . MESSAGES_FILENAME);
    
    // メッセージ数確認
    $messagesLength = count($messages);
    
    $selected = rand(0, $messagesLength-1);
    
    return $messages[$selected];
}
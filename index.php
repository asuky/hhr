<?php
require 'vendor/autoload.php';
require_once 'consts.php';
\Slim\Slim::registerAutoloader();

$app = new \Slim\Slim();

$app->get('/', function () { //as closure
    echo 'Hello World';
});

$app->get('/message/', 'messageGet');
$app->post('/praise/', 'praiseAdd');

$app->get('/functest', 'selectMessages');

function messageGet() {
    $respJson=sprintf('{"status": "success", "user_name": "hoge", "message": ["hoge", "fuga"]}');
    echo $respJson;
}

function praiseAdd() {
    $respJson=sprintf('{"status": "success","user_name": "hoge"}');
    echo $respJson;
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

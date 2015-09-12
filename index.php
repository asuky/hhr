<?php
require 'vendor/autoload.php';
require_once 'consts.php';
\Slim\Slim::registerAutoloader();

$app = new \Slim\Slim();
$app->view(new \JsonApiView());
$app->add(new \JsonApiMiddleware());

$app->get(
    '/',
    function () use ($app) {
        $app->render(
            200,
            array(
                'msg' => 'welcome to PraiseAPi!',
            )
        );
    }
);

$app->get(
    '/message/',
    function () use ($app) {
        messageGet($app);
    }
);
$app->post(
    '/praise/',
    function () use ($app) {
        praiseAdd($app);
    }
);

$app->get('/functest', 'selectMessages');

function messageGet($app)
{
    $msg = selectMessages();
    $app->render(
        200,
        array(
            'user_name' => 'hoge',
            'message' => $msg
        )
    );
}

function praiseAdd($app)
{
    $app->render(
        200,
        array(
            'user_name' => 'hoge'
        )
    );
}

$app->run();

function selectMessages()
{
    // メッセージを全部呼びこむ
    $messages = file(__DIR__ . DS . MESSAGES_FILENAME);

    // メッセージ数確認
    $messagesLength = count($messages);

    $selected = rand(0, $messagesLength - 1);

    return $messages[$selected];
}

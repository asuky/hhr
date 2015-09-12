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
        addUser($app);
    }
);

$app->get('/functest', 'selectMessages');
$app->post(
    '/users/',
    function () use ($app) {
    
        if ($app->request->post('user') !== '') {
            addUser($app);
        }
    }
);


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
    // ランダム選択
    $selected = rand(0, $messagesLength - 1);
    return $messages[$selected];
}

function addUser($app)
{
    $dbh = new PDO(USER_DSN);
    $sth = $dbh->prepare(CHECK_USER);
    $sth->execute(array(':username'=>$app->request->post('user')));
    $result = $sth->fetchAll();
    
    // 結果がない場合はユーザ追加
    if (count($result) === 0) {
        $addUserQuery = $dbh->prepare(ADD_USER);
        $addUserQuery->execute(array(':username'=>$app->request->post('user'), ':password'=>'pass'));
        $app->render(
            201,
            array(
                'user_name' => $app->request->post('user'),
            )
        );
        return;
    }
    
    $dbh = null;
    
    $app->render(
        400,
        array(
            'user_name' => $app->request->post('user'),
        )
    );
}
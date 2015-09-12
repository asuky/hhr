<?php
require 'vendor/autoload.php';
\Slim\Slim::registerAutoloader();

$app = new \Slim\Slim();
$app->view(new \JsonApiView());
$app->add(new \JsonApiMiddleware());

$app->get('/', function() use ($app) {
    $app->render(200,array(
            'msg' => 'welcome to PraiseAPi!',
        ));
});

$app->get('/message/', function() use ($app) { messageGet($app); });
$app->post('/praise/', function() use ($app){ praiseAdd($app);});

function messageGet($app) {
  $app->render(200, array(
      'user_name' => 'hoge',
      'message'   => array("hoge",  "fuga")
    )
  );
}

function praiseAdd($app) {
    $app->render(200, array(
        'user_name' => 'hoge'
      )
    );
}

$app->run();

<?php

define('DS', '/');
define('MESSAGES_FILENAME', 'messages.txt');
define('USER_DSN', 'sqlite:' . __DIR__ . '/db/hhr.db');

define('CHECK_USER', 'select * from users where username = :username');
define('ADD_USER', 'insert into users(username, password) values(:username, :password)');

define('BASE_URL', 'http://hhr.cybird.ne.jp/');
define('IMAGE_PATH', 'img/');

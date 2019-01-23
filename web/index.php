<?php
define('PATH_ROOT', dirname(__DIR__));
define('PATH_BASE', PATH_ROOT . '/src/app');
define('PATH_VENDOR', PATH_ROOT . '/vendor');

require PATH_ROOT . '/build/installer/check.php';

define('YII_ENV', 'dev');
define('YII_DEBUG', true);

$config  = require PATH_VENDOR . '/mlaxwong/paw/bootstrap/web.php';
$app = Yii::createObject(\yii\helpers\ArrayHelper::merge($config, require PATH_ROOT . '/config/config.php'));
$app->run();
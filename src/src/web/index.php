<?php
error_reporting(E_ALL & ~E_DEPRECATED);

defined('YII_ENV') or define('YII_ENV', getenv('APP_ENV') ?: 'dev');
defined('YII_DEBUG') or define('YII_DEBUG', getenv('APP_DEBUG') === 'true');

require __DIR__ . '/../../vendor/autoload.php';
require __DIR__ . '/../../vendor/yiisoft/yii2/Yii.php';

$config = require __DIR__ . '/../config/web.php';

(new yii\web\Application($config))->run();

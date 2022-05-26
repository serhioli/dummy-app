<?php

$params = require __DIR__ . '/params.php';

$config = [
    'id'                  => 'basic',
    'basePath'            => dirname(__DIR__),
    'bootstrap'           => ['log'],
    'controllerNamespace' => 'serhioli\DummyApp\controllers',
    'components'          => [
        'request'      => [
            'cookieValidationKey' => 'YmP4DDIWR9Neh9yEVPfnLA5xuzJwDwBX',
        ],
        'cache'        => [
            'class' => 'yii\caching\FileCache',
        ],
        'user'         => [
            'identityClass'   => 'app\models\User',
            'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'log'          => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets'    => [
                [
                    'class'  => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'urlManager'   => [
            'enablePrettyUrl'     => true,
            'showScriptName'      => false,
            'enableStrictParsing' => true,
            'rules'               => [
                [
                    'class'      => \yii\rest\UrlRule::class,
                    'pluralize'  => false,
                    'controller' => [
                        'site',
                        'api/data',
                    ],
                ],
            ],
        ],
    ],
    'params'              => $params,
];

return $config;

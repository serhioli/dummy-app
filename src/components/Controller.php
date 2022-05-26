<?php

namespace serhioli\DummyApp\components;

use serhioli\DummyApp\components\behaviors\SlowingBehavior;
use yii\filters\auth\CompositeAuth;
use yii\filters\ContentNegotiator;
use yii\filters\RateLimiter;
use yii\filters\VerbFilter;
use yii\web\Response;

class Controller extends \yii\rest\Controller
{
    public function behaviors()
    {
        return [
            'contentNegotiator' => [
                'class'   => ContentNegotiator::class,
                'formats' => [
                    'application/json' => Response::FORMAT_JSON,
                ],
            ],
            'verbFilter'        => [
                'class'   => VerbFilter::class,
                'actions' => $this->verbs(),
            ],
            'authenticator'     => [
                'class' => CompositeAuth::class,
            ],
            'rateLimiter'       => [
                'class' => RateLimiter::class,
            ],
            'slowing'           => [
                'class'     => SlowingBehavior::class,
                'isEnabled' => \Yii::$app->params['slowing']['enabled'],
                'minMs'     => \Yii::$app->params['slowing']['min'],
                'maxMs'     => \Yii::$app->params['slowing']['max'],
            ],
        ];
    }
}

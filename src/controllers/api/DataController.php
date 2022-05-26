<?php

namespace serhioli\DummyApp\controllers\api;

use serhioli\DummyApp\actions\DataAction;
use serhioli\DummyApp\components\Controller;
use Yii;

class DataController extends Controller
{
    public function actions()
    {
        return [
            'index' => [
                'class'     => DataAction::class,
                'formatter' => Yii::$app->formatter,
                'params'    => Yii::$app->params,
            ]
        ];
    }
}

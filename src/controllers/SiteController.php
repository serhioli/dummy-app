<?php

namespace serhioli\DummyApp\controllers;

use serhioli\DummyApp\components\Controller;

class SiteController extends Controller
{
    public function actions()
    {
        return [
            'error' => [
                'class' => \yii\web\ErrorAction::class,
            ],
        ];
    }

    public function actionIndex()
    {
        return [
            'content' => 'OK',
        ];
    }
}

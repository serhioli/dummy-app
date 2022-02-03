<?php

namespace serhioli\DummyApp\controllers\api;

use serhioli\DummyApp\components\Controller;
use serhioli\DummyApp\components\SlowingHelper;

class DataController extends Controller
{
    public function actionIndex()
    {
        SlowingHelper::processSlowing();

        return [
            'data' => [
                'random' => sprintf(
                    '%d.%d.%d.%d',
                    random_int(10000, 99999),
                    random_int(10000, 99999),
                    random_int(10000, 99999),
                    random_int(10000, 99999),
                ),
                'time' => \Yii::$app->formatter->asDatetime(new \DateTimeImmutable()),
            ],
            'config' => \Yii::$app->params,
        ];
    }

    public function actionCreate()
    {
        SlowingHelper::processSlowing();

        return [
            'created' => 'OK',
        ];
    }
}

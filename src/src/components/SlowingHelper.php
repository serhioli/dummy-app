<?php

namespace serhioli\DummyApp\components;

use Yii;

final class SlowingHelper
{
    public static function processSlowing(): void
    {
        if (self::isSlowing()) {
            usleep(self::chooseSlowing());
        }
    }

    private static function isSlowing(): bool
    {
        return Yii::$app->params['slowing']['enabled'] === true;
    }

    private static function chooseSlowing(): int
    {
        [
            'min' => $min,
            'max' => $max,
        ] = Yii::$app->params['slowing'];

        if ($min < 1 || $max <= $min) {
            return 0;
        }

        return random_int($min, $max) * 1000;
    }
}

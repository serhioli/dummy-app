<?php

namespace serhioli\DummyApp\actions;

use serhioli\DummyApp\components\attributes\Slowing;
use yii\base\Action;
use yii\i18n\Formatter;

#[Slowing]
class DataAction extends Action
{
    public Formatter $formatter;
    public array $params;

    public function run()
    {
        return [
            'data'   => [
                'random' => sprintf(
                    '%d.%d.%d.%d',
                    random_int(10000, 99999),
                    random_int(10000, 99999),
                    random_int(10000, 99999),
                    random_int(10000, 99999),
                ),
                'time'   => $this->formatter->asDatetime(new \DateTimeImmutable()),
            ],
            'config' => $this->params,
        ];
    }
}

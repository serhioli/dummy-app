<?php

namespace serhioli\DummyApp\components\behaviors;

use serhioli\DummyApp\components\attributes\Slowing;
use yii\base\ActionEvent;
use yii\base\Behavior;
use yii\base\Controller;
use yii\base\InlineAction;
use yii\base\InvalidConfigException;

class SlowingBehavior extends Behavior
{
    public bool $isEnabled = false;
    public int $minMs = 0;
    public int $maxMs = 0;

    public function events()
    {
        return [
            Controller::EVENT_BEFORE_ACTION => 'processSlowing'
        ];
    }

    public function attach($owner)
    {
        if (!$owner instanceof Controller) {
            throw new InvalidConfigException();
        }

        parent::attach($owner);
    }

    public function processSlowing(ActionEvent $event): void
    {
        if (!$this->isEnabled) {
            return;
        }

        if ($event->action instanceof InlineAction) {
            throw new InvalidConfigException('Inline actions isn\'t supported');
        }

        $reflection = new \ReflectionClass($event->action);

        foreach ($reflection->getAttributes(Slowing::class) as $attribute) {
            /** @var \serhioli\DummyApp\components\attributes\Slowing $slowing */
            $slowing = $attribute->newInstance();
            $slowing->min_ms = $slowing->min_ms ?: $this->minMs;
            $slowing->max_ms = $slowing->max_ms ?: $this->maxMs;

            $slowing->sleep();
        }
    }
}

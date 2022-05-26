<?php

namespace serhioli\DummyApp\components\attributes;

#[\Attribute]
class Slowing
{
    public function __construct(
        public int $min_ms = 0,
        public int $max_ms = 0,
    ) {
    }

    public function sleep(): void
    {
        usleep(random_int($this->min_ms, $this->max_ms) * 1000);
    }
}

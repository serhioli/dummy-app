<?php

return [
    'slowing' => [
        'enabled' => (getenv('APP_SLOWING_ENABLED') === 'true'),
        'min'     => (int) (getenv('APP_SLOWING_MIN_MICROSECONDS') ?: 0),
        'max'     => (int) (getenv('APP_SLOWING_MAX_MICROSECONDS') ?: 0),
    ],
];

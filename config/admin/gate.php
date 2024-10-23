<?php
/**
 * Configuration settings for admin gate.
 */
return [
    'controller' => [
        'index' => [
            'driver'   => 'session',
            'provider' => 'admin',
        ],
    ],
];

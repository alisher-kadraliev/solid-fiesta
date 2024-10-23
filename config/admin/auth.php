<?php
/**
 * Authentication settings for admin area.
 */
return [
    'guards'    => [
        'admin_guard' => [
            'driver'   => 'session',
            'provider' => 'admin',
        ],
    ],
    'providers' => [
        'admin' => [
            'driver' => 'eloquent',
            'model'  => \App\Models\Admin\AdminService\Auth\AuthUser::class,
        ],
    ],
    'passwords' => [
        'admin' => [
            'provider' => 'admin',
            'table'    => 'password_resets',
            'expire'   => 60,
            'throttle' => 20,
        ],
    ],
];

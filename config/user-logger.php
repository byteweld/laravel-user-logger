<?php

return [
    'user_model' => env('USER_LOGGER_MODEL', \App\Models\User::class),

    'log_request_data' => env('USER_LOGGER_LOG_REQUEST_DATA', false),

    'except' => [
        'routes' => array_filter(explode(',', env(
            'USER_LOGGER_EXCEPT_ROUTES',
            'horizon*,telescope*,admin*,sanctum*,_ignition*'
        ))),

        'fields' => array_filter(explode(',', env(
            'USER_LOGGER_EXCEPT_FIELDS',
            'password,password_confirmation,_token'
        ))),
    ],

    'prune_after_days' => env('USER_LOGGER_PRUNE_AFTER_DAYS', 30),
];
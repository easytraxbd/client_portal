<?php

return [
    'channels' => [
        'ticket_channel' => [
            'channel_id' => '-1001465516984',
            'channel_username' => 'EasytraxSelfCareTickets',
        ],
    ],

    'bots' => [
        'mybot' => [
            'username' => 'EasytraxPaymentsBot',
            'token' => env('TELEGRAM_BOT_TOKEN', '924804001:AAGRpP5ATnWbuIUci9Xy3fHBBdg3unB0vVg'),
            'certificate_path' => env('TELEGRAM_CERTIFICATE_PATH', ''),
            'webhook_url' => env('TELEGRAM_WEBHOOK_URL', ''),
            'commands' => [
            ],
        ], 'mybot2' => [
            'username' => 'EasytraxBot',
            'token' => env('TELEGRAM_BOT_TOKEN', '352379297:AAH0mGqW_c0Dw0vAoJR44D_DMoCEt_sN5p0'),
            'certificate_path' => env('TELEGRAM_CERTIFICATE_PATH', ''),
            'webhook_url' => env('TELEGRAM_WEBHOOK_URL', ''),
            'commands' => [
            ],
        ],
    ],
    /*
    |--------------------------------------------------------------------------
    | Telegram Bot API Access Token [REQUIRED]
    |--------------------------------------------------------------------------
    |
    | Your Telegram's Bot Access Token.
    | Example: 123456:ABC-DEF1234ghIkl-zyx57W2v1u123ew11
    |
    | Refer for more details:
    | https://core.telegram.org/bots#botfather
    |
    */
    'bot_token' => env('TELEGRAM_BOT_TOKEN', '908924657:AAHvHXO7JKCf0tOr1rXpUA7H54lIv0LPYlg'),

    /*
    |--------------------------------------------------------------------------
    | Asynchronous Requests [Optional]Teic
    |--------------------------------------------------------------------------
    |
    | When set to True, All the requests would be made non-blocking (Async).
    |
    | Default: false
    | Possible Values: (Boolean) "true" OR "false"
    |
    */
    'async_requests' => env('TELEGRAM_ASYNC_REQUESTS', false),

    /*
    |--------------------------------------------------------------------------
    | HTTP Client Handler [Optional]
    |--------------------------------------------------------------------------
    |
    | If you'd like to use a custom HTTP Client Handler.
    | Should be an instance of \Telegram\Bot\HttpClients\HttpClientInterface
    |
    | Default: GuzzlePHP
    |
    */
    'http_client_handler' => 'GuzzlePHP',

    /*
    |--------------------------------------------------------------------------
    | Register Telegram Commands [Optional]
    |--------------------------------------------------------------------------
    |
    | If you'd like to use the SDK's built in command handler system,
    | You can register all the commands here.
    |
    | The command class should extend the \Telegram\Bot\Commands\Command class.
    |
    | Default: The SDK registers, a help command which when a user sends /help
    | will respond with a list of available commands and description.
    |
    */
    'commands' => [
        Telegram\Bot\Commands\HelpCommand::class,
    ],
];

# laravel-matrix-logging
Allow logging from laravel to matrix

## Installation
1. Define the Custom Driver in config/logging.php
Open the config/logging.php file in your Laravel project. Here, you can define your custom logging channel by adding a new entry to the 'channels' array.
```php
'channels' => [

    // Existing channels...

    'matrix' => [
        'driver' => 'monolog',
        'level' => env('MATRIX_LOG_LEVEL', 'error'),
        'handler' => Vocphone\LaravelMatrixLogging\MatrixLogHandler::class,
        'with' => [
            'roomId' => '!someChanelID@channel.host'
        ],
    ],

],
```
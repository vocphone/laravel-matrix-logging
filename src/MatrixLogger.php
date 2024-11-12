<?php

namespace Vocphone\LaravelMatrixLogging;

use MatrixPhp\MatrixClient;
use Vocphone\LaravelMatrixSdk\MatrixClient;


class MatrixLogger
{
    public static function sendMessage(string $message, string $roomId )
    {

        if( empty($roomId))
            return;

        app(MatrixClient::class)->sendMessage($message, $roomId);

    }
}
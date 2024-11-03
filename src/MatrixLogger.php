<?php

namespace Vocphone\LaravelMatrixLogging;

class MatrixLogger
{
    public static function sendMessage(string $message, string $roomId )
    {
        $matrix = new \MatrixPhp\MatrixClient(env('MATRIX_URL'));
        $token = $matrix->login(env('MATRIX_USER'), env('MATRIX_PASSWORD'));
        $room = new \MatrixPhp\Room($matrix, $roomId);
        $result = $room->sendHtml($message);
    }
}
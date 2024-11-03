<?php

namespace Vocphone\LaravelMatrixLogging;

use Monolog\Handler\AbstractProcessingHandler;
use Monolog\Level;
use Monolog\Logger;

class MatrixLogHandler extends AbstractProcessingHandler
{
    /**
     * Instance of the MatrixRecord util class preparting data for Matrix API
     * @var MatrixRecord
     */
    private $matrixRecord;

    /**
     * The Matrix Channel to send log message to
     * @var string
     */
    private $roomId;

    public function __construct(string $roomId, string $level = Logger::DEBUG, bool $bubble = true)
    {
        $this->roomId = $roomId;

        $this->matrixRecord = new MatrixRecord(
            $roomId
        );
    }

    public function getMatrixRecord(): MatrixRecord
    {
        return $this->matrixRecord;
    }

    public function getChannel(): string
    {
        return $this->channel;
    }

    /**
     * {@inheritDoc}
     */
    protected function write(array $record): void
    {
        $message = $record['message'];
        MatrixLogger::sendMessage($message, $this->roomId);
    }
}
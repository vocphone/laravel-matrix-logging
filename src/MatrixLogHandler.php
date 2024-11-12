<?php

namespace Vocphone\LaravelMatrixLogging;

use Monolog\Handler\AbstractProcessingHandler;
use Monolog\Handler\HandlerInterface;
use Monolog\Formatter\FormatterInterface;
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
        parent::__construct($level, $bubble);

        $this->roomId = $roomId;

        $this->matrixRecord = new MatrixRecord(
            $roomId
        );
    }

    public function getMatrixRecord(): MatrixRecord
    {
        return $this->matrixRecord;
    }

    public function getRoomId(): string
    {
        return $this->roomId;
    }

    /**
     * {@inheritDoc}
     */
    protected function write(array $record): void
    {
        $message = $this->matrixRecord->getMatrixMessage($record);

        MatrixLogger::sendMessage($message, $this->roomId);
    }


    public function setFormatter(FormatterInterface $formatter): HandlerInterface
    {
        parent::setFormatter($formatter);
        $this->matrixRecord->setFormatter($formatter);

        return $this;
    }

    public function getFormatter(): FormatterInterface
    {
        $formatter = parent::getFormatter();
        $this->matrixRecord->setFormatter($formatter);

        return $formatter;
    }
}
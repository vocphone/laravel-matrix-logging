<?php

namespace Vocphone\LaravelMatrixLogging;

use Monolog\Formatter\NormalizerFormatter;
use Monolog\Formatter\FormatterInterface;

class MatrixRecord
{
    /**
     * The room id to use
     * @var string
     */
    private $roomId;

    private $formatter;

    public function __construct(string $roomId)
    {
        $this->roomId = $roomId;
    }
    public function getRoomId(): string
    {
        return $this->roomId;
    }

    public function setFormatter(?FormatterInterface $formatter = null): self
    {
        $this->formatter = $formatter;

        return $this;
    }

    /**
     * get the formatted matrix message ready to send to provider
     * @param array $record the log message array from monolog
     * @return string the string ready to send to matrix
     */
    public function getMatrixMessage( array $record ): ?string
    {
        if ( $this->formatter ) {
            /** @phpstan-ignore-next-line */
            $message = $this->formatter->format($record);
        } else {
            $message = $record['message'];
        }
        return $message;
    }

}

<?php

namespace Vocphone\LaravelMatrixLogging;

class MatrixRecord
{
    /**
     * The channel id to use
     * @var string
     */
    private $channel;

    public function __construct(string $channel)
    {
        $this->channel = $channel;
    }
    public function getChannel(): string
    {
        return $this->channel;
    }

}

<?php

namespace api\exceptions;

use JetBrains\PhpStorm\Pure;
use RuntimeException;

class MainException extends RuntimeException
{
    public string $debugMessage;

    #[Pure] public function __construct($message, string $debugMessage, $code=0)
    {
        parent::__construct($message, $code, null);
        $this->debugMessage = $debugMessage;
    }
}
<?php

namespace api\exceptions;

use JetBrains\PhpStorm\Pure;

class ForbiddenMethodException extends MainException
{
    #[Pure] public function __construct($message = "Метод не существует")
    {
        parent::__construct($message, $_SERVER['REQUEST_METHOD']);
    }
}
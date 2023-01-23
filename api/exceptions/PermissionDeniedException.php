<?php

namespace api\exceptions;

use JetBrains\PhpStorm\Pure;

class PermissionDeniedException extends MainException
{
    #[Pure] public function __construct(string $debugMessage)
    {
        parent::__construct("У вас нету прав на изменение этого ресурса", $debugMessage);
    }
}
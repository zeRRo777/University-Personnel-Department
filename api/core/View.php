<?php


namespace api\core;


use function extract;
use function ob_get_clean;
use function ob_start;
use const EXTR_OVERWRITE;

class View
{
    public static function render(array $argv, $name): string
    {
        ob_start();
        extract($argv, EXTR_OVERWRITE);
        include($_SERVER['DOCUMENT_ROOT'] . "/api/templates/$name");
        return ob_get_clean();
    }
}
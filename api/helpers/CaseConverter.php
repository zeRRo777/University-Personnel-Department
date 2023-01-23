<?php

namespace api\helpers;

final class CaseConverter
{
    public static function snakeCaseToCamelCase(string $input, string $separator = '_'): string
    {
        return lcfirst(str_replace($separator, '', ucwords($input, $separator)));
    }

    public static function camelCaseToSnakeCase(string $input): string
    {
        return strtolower(preg_replace('/(?<!^)[A-Z]/', '_$0', $input));
    }
    public static function stringArrayToSnakeCase(array $props): array
    {
        $result = [];
        foreach ($props as $key => $value) {
            $result[] = self::camelCaseToSnakeCase($key);
        }
        return $result;
    }
}
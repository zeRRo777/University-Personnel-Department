<?php

namespace api\core;

use DateTime;
use PDO;
use PDOException;

class DB
{
    private static string $host = 'localhost';
    private static string $db = 'kursach';
    private static string $user = 'root';
    private static string $pass = '';
    private static string $charset = 'utf8';
    private static PDO $pdo;

    public static function getPDO(): PDO
    {
        if (!isset(self::$pdo)) {
            $host    = self::$host;
            $dbname  = self::$db;
            $charset = self::$charset;
            $dsn     = "mysql:host=$host;dbname=$dbname;charset=$charset";
            $opt     = [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => false,
            ];
            try {
                self::$pdo = new PDO($dsn, self::$user, self::$pass, $opt);
            } catch (PDOException $e) {
                die($e->getMessage());
            }
        }
        return self::$pdo;
    }

    public static function quote(null|int|float|string|DateTime $value): null|int|float|string|DateTime
    {
        if (is_string($value)) {
            return self::getPDO()->quote($value);
        }
        if ($value instanceof DateTime){
            return self::getPDO()->quote($value->format("Y-m-d H:i:s"));
        }
        return $value;
    }
}
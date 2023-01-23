<?php

namespace api\models;

use api\core\Model;

final class LogModel extends Model
{
    protected static string $tableName = "Logs";
    public string $fio;
    public string $age;
    public float $experience;
    public float $salary;
    public int $type;
    public null|int $id_department = null;
}
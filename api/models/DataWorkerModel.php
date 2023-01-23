<?php

namespace api\models;

use api\core\Model;

final class DataWorkerModel extends Model
{
    protected static string $tableName = "Data_workers";
    public int $id_worker;
    public string $login;
    public string $password;
}
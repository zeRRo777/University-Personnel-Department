<?php

namespace api\models;

use api\core\Model;

final class GroupModel extends Model
{
    protected static string $tableName = "Groups";
    public string $name;
    public int $amount_students;
    public int $id_direction;
}
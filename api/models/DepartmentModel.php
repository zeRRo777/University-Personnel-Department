<?php

namespace api\models;

use api\core\Model;


final class DepartmentModel extends Model
{
    protected static string $tableName = "Departments";
    public string $name;
    public float $amount_teachers;
    public int|null $id_headteacher;

}


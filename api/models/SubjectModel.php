<?php

namespace api\models;

use api\core\Model;

final class SubjectModel extends Model
{
    protected static string $tableName = "Subjects";
    public string $name;

    public function isUnique():bool
    {
        $subjects = SubjectModel::getAll();
        foreach ($subjects as $subject)
        {
            if ($this->name === $subject->name)
            {
                return false;
            }
        }
        return true;
    }
}
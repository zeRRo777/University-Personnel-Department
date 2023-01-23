<?php

namespace api\models;

use api\core\Model;

final class TeacherSubjectModel extends Model
{
    protected static string $tableName="Subject_Teacher";
    public int $id_teacher;
    public int $id_subject;

    public function isUnique():bool
    {
        $teachsubs = self::getAll();
        foreach ($teachsubs as $teachsub)
        {
            if ($teachsub->id_subject === $this->id_subject && $this->id_teacher === $teachsub->id_teacher)
            {
                return false;
            }
        }
        return true;
    }
}
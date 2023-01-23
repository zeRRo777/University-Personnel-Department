<?php

namespace api\models;

use api\core\Model;
use function implode;


final class DirectionModel extends Model
{
    protected static string $tableName="Directions";
    public string $name;
    public int $id_department;

    public function isUniqueDirection():bool
    {
        return $this->where("name", $this->name)->isEmpty();
    }

    public function AllSubjects():string
    {
        $subjects = [];
        $dir_subs = DirectionSubjectModel::getAll();
        foreach ($dir_subs as $dir_sub)
        {
            if ($dir_sub->id_direction === $this->id)
            {
                $subject = SubjectModel::getById($dir_sub->id_subject);
                $subjects[] = $subject->name;
            }
        }
        return implode(',', $subjects);
    }
}
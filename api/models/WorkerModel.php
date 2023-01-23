<?php

namespace api\models;

use api\core\Model;
use function implode;


final class WorkerModel extends Model
{
    protected static string $tableName = "Workers";
    public string $fio;
    public string $age;
    public float $experience;
    public float $salary;
    public int $type;
    public null|int $id_department = null;

    public function AllSubjectTeacher():string
    {
        $subjects = [];
        $teach_subs = TeacherSubjectModel::getAll();
        foreach ($teach_subs as $teach_sub)
        {
            if ($teach_sub->id_teacher === $this->id)
            {
                $subject = SubjectModel::getById($teach_sub->id_subject);
                $subjects[] = $subject->name;
            }
        }
        return implode(',', $subjects);
    }
}


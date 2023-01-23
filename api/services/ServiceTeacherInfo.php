<?php

namespace api\services;

use api\core\DB;
use api\exceptions\MainException;
use api\models\DirectionSubjectModel;
use api\models\TeacherSubjectModel;
use PDO;

final class ServiceTeacherInfo
{
    public static function GetAllInfoTeacher($id_teacher):array
    {
        $result = [];
        $sqlquery = "SELECT Subject_Teacher.id_subject, Direction_Subject.id_direction
                    FROM Subject_Teacher
                    JOIN Direction_Subject
                    on Subject_Teacher.id_subject = Direction_Subject.id_subject
                    WHERE Subject_Teacher.id_teacher = $id_teacher";
        $sqlResponse = DB::getPDO()->query($sqlquery)->fetchAll(PDO::FETCH_CLASS, DirectionSubjectModel::class);
        foreach ($sqlResponse as $obj)
        {
            $direction = $obj->id_direction;
            $subject = $obj->id_subject;
            if (isset($result[$direction]))
            {
                $result[$direction][] = $subject;
            }
            else{
                $result[$direction] = [$subject];
            }
        }
        return $result;
    }

    public static function addSubforTeacher($id_teacher, $id_subject):TeacherSubjectModel
    {
        $TeachSub = new TeacherSubjectModel();
        $TeachSub->id_subject = $id_subject;
        $TeachSub->id_teacher = $id_teacher;
        if($TeachSub->isUnique())
        {
            $TeachSub->save();
            return $TeachSub;
        }
        else
        {
            throw new MainException("", "Такой предмет уже есть у преподавателя");
        }
    }

    public static function deleteSubTeacher($id_teacher, $id_subject):void
    {
        $TeachSub = new TeacherSubjectModel();
        $TeachSub->id_subject = $id_subject;
        $TeachSub->id_teacher = $id_teacher;
        if(!$TeachSub->isUnique())
        {
            $sql = "delete from Subject_Teacher where id_subject=$id_subject and id_teacher=$id_teacher";
            DB::getPDO()->query($sql);
        }
        else
        {
            throw new MainException("", "Такого предмета нет у преподавателя");
        }
    }
}
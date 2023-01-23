<?php

namespace api\services;

use api\core\DB;
use api\exceptions\MainException;
use api\models\DirectionModel;
use api\models\DirectionSubjectModel;
use api\models\SubjectModel;

final class DirectionService
{
    public static function newDirection($name, $id_department):DirectionModel
    {
        $direction = new DirectionModel();
        $direction->name = $name;
        $direction->id_department = $id_department;
        if ($direction->isUniqueDirection())
        {
            $direction->save();
        }
        else{
            throw new MainException("", "Такое направление уже существует");
        }
        return $direction;
    }

    public static function deleteDirection($id_direction):void
    {
        DirectionModel::getById($id_direction)->delete();
    }

    public static function addDirectionSubject($id_subject, $id_direction):void
    {
        $dirsub = new DirectionSubjectModel();
        $dirsub->id_subject = $id_subject;
        $dirsub->id_direction = $id_direction;
        if ($dirsub->isUnique())
        {
            $sql = "insert into `Direction_Subject` (id_direction, id_subject) VALUES ($id_direction, $id_subject)";
            DB::getPDO()->query($sql);
        }
        else{
            throw new MainException("", "Такое предмет уже есть у направления");
        }
    }

    public static function deleteDirSub($id_direction, $id_subject):void
    {
        $dirsub = new DirectionSubjectModel();
        $dirsub->id_subject = $id_subject;
        $dirsub->id_direction = $id_direction;
        if (!$dirsub->isUnique()) {
            $sql = "delete from `Direction_Subject` where id_subject=$id_subject and id_direction=$id_direction";
            DB::getPDO()->query($sql);
        }
        else{
            throw new MainException("", "Такого предмета нет у направления");
        }
    }



}
<?php

namespace api\services;

use api\models\GroupModel;

final class GroupService
{
    public static function createGroup($id_direction, $name, $amount_student):GroupModel
    {
        $group = new GroupModel();
        $group->name = $name;
        $group->id_direction = (int)$id_direction;
        $group->amount_students = (int)$amount_student;
        $group->save();
        return $group;
    }

    public static function deleteGroup($id_group):void
    {
        GroupModel::getById($id_group)->delete();
    }

    public static function updateAmountStudent($id_group, $amount_student):void
    {
        $group = GroupModel::getById((int)$id_group);
        $group->amount_students = (int)$amount_student;
        $group->update();
    }
}
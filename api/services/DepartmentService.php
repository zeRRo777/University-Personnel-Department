<?php

namespace api\services;

use api\models\DepartmentModel;

final class DepartmentService
{
    public static function addDepartment($name, $amount_teachers, $id_headteacher=null):DepartmentModel
    {
        $department = new DepartmentModel();
        $department->name = $name;
        $department->amount_teachers = (int)$amount_teachers;
        $department->id_headteacher = $id_headteacher;
        $department->save();
        return $department;
    }

    public static function deleteDepartment($id_department):void
    {
        DepartmentModel::getById($id_department)->delete();
    }

    public static function updateAmountTeachers($id_department, $amount_teachers):void
    {
        $department = DepartmentModel::getById((int)$id_department);
        $department->amount_teachers = (int)$amount_teachers;
        $department->update();
    }
}
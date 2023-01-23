<?php

namespace api\services;

use api\exceptions\MainException;
use api\models\DepartmentModel;
use api\models\WorkerModel;
use const ROLE_DEKAN;
use const ROLE_HEADTEACHER;
use const ROLE_TEACHER;
use const ROLE_WORKER;

final class ServiceModel
{
    public static function newWorker($fio, $age, $exp, $salary, $type, $id_department=null):WorkerModel
    {
        $newWorker = new WorkerModel();
        $newWorker->fio = $fio;
        $newWorker->age = $age;
        $newWorker->experience = (int)$exp;
        $newWorker->salary = (int)$salary;
        $newWorker->type = (int)$type;
        if ($id_department == 0)
        {
            $id_department = null;
        }
        $newWorker->id_department = $id_department;
        switch ($type)
        {
            case ROLE_TEACHER:
            case ROLE_WORKER:
                self::saveWorker($newWorker);
                break;
            case ROLE_DEKAN:
                if (!self::isActiveDekan())
                {
                   self::saveWorker($newWorker);
                    break;
                }
                throw new MainException("", "Декан уже существует");
            case ROLE_HEADTEACHER:
                if (!self::isActiveHeadTeacher($id_department))
                {
                    self::saveWorker($newWorker);
                    break;
                }
                throw new MainException("", "У кафедры уже есть зав.кафедры");
            default:
                throw new MainException("Неправильный тип работника", $type);
        }
        return $newWorker;
    }

    public static function deleteWorker($id):void
    {
        WorkerModel::getById($id)->delete();
    }

    private static function isActiveDekan():bool
    {
        $workers = WorkerModel::getAll();
        foreach ($workers as $worker)
        {
            if ($worker->type === ROLE_DEKAN)
            {
                return true;
            }
        }
        return false;
    }

    private static function isActiveHeadTeacher($id_department):bool
    {
        $department = DepartmentModel::getById($id_department);
        return $department->id_headteacher !== null;
    }

    private static function saveWorker($newWorker):void
    {
        $newWorker->save();
        $newDataWorker = ServiceDataWorker::genLoginPass($newWorker->id);
        $newDataWorker->save();
    }

    public static function my_update($id_worker,$param, $new_value):WorkerModel
    {
        $worker = WorkerModel::getById($id_worker);
        match ($param)
        {
            "fio"=>$worker->fio = $new_value,
            "salary"=>$worker->salary = (int)$new_value,
            "experience"=>$worker->experience = (int)$new_value
        };
        $worker->update();
        return $worker;
    }
}

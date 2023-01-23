<?php

namespace api\controllers;

use api\core\Controller;
use api\core\Request;
use api\core\View;
use api\models\DepartmentModel;
use api\models\WorkerModel;
use api\services\DepartmentService;
use api\services\DirectionService;
use api\services\GroupService;
use api\services\ServiceModel;
use api\services\ServiceTeacherInfo;
use api\services\SubjectService;
use function header;

final class HeadTeacherController extends Controller
{
    protected function onGet(Request $request): string
    {
        if ($_SESSION['idUser'] !== null){
            $worker = WorkerModel::getById($_SESSION['idUser']);
            return View::render(["worker"=> $worker], "HeadTeacherTemplate.php");}
        header(header: "Location:https://kursach/auth");
        return "ok";
    }

    protected function onPost(Request $request): string
    {
        $worker = WorkerModel::getById($_SESSION['idUser']);
        match ($_POST['type']) {
            "add_direction"=>DirectionService::newDirection($_POST['name'], $worker->id_department),
            "delete_direction"=>DirectionService::deleteDirection($_POST['id_direction']),
            "add_dirsub"=>DirectionService::addDirectionSubject($_POST['id_subject'], $_POST['id_direction']),
            "delete_dirsub"=>DirectionService::deleteDirSub($_POST['id_direction'], $_POST['id_subject']),
            "add_teacher_sub"=>ServiceTeacherInfo::addSubforTeacher($_POST['id_teacher'], $_POST['id_subject']),
            "delete_teacher_sub"=>ServiceTeacherInfo::deleteSubTeacher($_POST['id_teacher'], $_POST['id_subject']),
            "add_subject"=>SubjectService::NewSubject($_POST['name'])
        };
        return match ($_POST['type'])
        {
            'add_direction'=>View::render(["worker"=> $worker, "AddDirectionSuccess"=>true], "HeadTeacherTemplate.php"),
            'delete_direction'=>View::render(["worker"=> $worker, "DeleteDirectionSuccess"=>true], "HeadTeacherTemplate.php"),
            'add_dirsub'=>View::render(["worker"=> $worker, "AddDirsubSuccess"=>true], "HeadTeacherTemplate.php"),
            'delete_dirsub'=>View::render(["worker"=> $worker, "DeleteDirsubSuccess"=>true], "HeadTeacherTemplate.php"),
            'add_teacher_sub'=>View::render(["worker"=> $worker, "AddTeacherSubSuccess"=>true], "HeadTeacherTemplate.php"),
            'delete_teacher_sub'=>View::render(["worker"=> $worker, "DeleteTeacherSubSuccess"=>true], "HeadTeacherTemplate.php"),
            'add_subject'=>View::render(["worker"=> $worker, "AddSubjectSuccess"=>true], "HeadTeacherTemplate.php")
        };
    }

    protected function onPut(Request $request): string
    {
        // TODO: Implement onPut() method.
    }

    protected function onDelete(Request $request): string
    {
        // TODO: Implement onDelete() method.
    }


}

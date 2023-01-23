<?php

namespace api\controllers;

use api\core\Controller;
use api\core\Request;
use api\core\View;
use api\models\DepartmentModel;
use api\models\WorkerModel;
use api\services\DepartmentService;
use api\services\GroupService;
use api\services\ServiceModel;

final class DekanController extends Controller
{
    protected function onGet(Request $request): string
    {
        if ($_SESSION['idUser'] !== null){
            $worker = WorkerModel::getById($_SESSION['idUser']);
            return View::render(["worker"=> $worker], "DekanTemplate.php");}
        header(header: "Location:https://kursach/auth");
        return "ok";
    }

    protected function onPost(Request $request): string
    {
        match ($_POST['type'])
        {
            'add_group'=>GroupService::createGroup($_POST['id_direction'], $_POST['name'], $_POST['amount_students']),
            'delete_group'=>GroupService::deleteGroup($_POST['id_group']),
            'add_department'=>DepartmentService::addDepartment($_POST['name'], $_POST['amount_teachers']),
            'delete_department'=>DepartmentService::deleteDepartment($_POST['id_department']),
            'update_group'=>GroupService::updateAmountStudent($_POST['id_group'], $_POST['new_amount_students']),
            'update_department'=>DepartmentService::updateAmountTeachers($_POST['id_department'], $_POST['new_amount_teachers'])
        };
        $worker = WorkerModel::getById($_SESSION['idUser']);
        return match ($_POST['type'])
        {
            'add_group'=>View::render(["worker"=> $worker, "AddGroupSuccess"=>true], "DekanTemplate.php"),
            'delete_group'=>View::render(["worker"=> $worker, "DeleteGroupSuccess"=>true], "DekanTemplate.php"),
            'add_department'=>View::render(["worker"=> $worker, "AddDepartmentSuccess"=>true], "DekanTemplate.php"),
            'delete_department'=>View::render(["worker"=> $worker, "DeleteDepartmentSuccess"=>true], "DekanTemplate.php"),
            'update_group'=>View::render(["worker"=> $worker, "UpdateGroupSuccess"=>true], "DekanTemplate.php"),
            'update_department'=>View::render(["worker"=> $worker, "UpdateDepartmentSuccess"=>true], "DekanTemplate.php")
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
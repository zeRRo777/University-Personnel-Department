<?php

namespace api\controllers;
use api\core\Controller;
use api\core\Request;
use api\core\View;
use api\exceptions\ForbiddenMethodException;
use api\helpers\Auth;
use api\models\WorkerModel;
use api\services\ServiceModel;
use function header;
use const ROLE_WORKER;

final class WorkerController extends Controller
{
    protected function onGet(Request $request): string
    {
        if ($_SESSION['idUser'] !== null){
            $worker = WorkerModel::getById($_SESSION['idUser']);
            return View::render(["worker"=> $worker], "WorkerTemplate.php");}
        else{
            header(header: "Location:https://kursach/auth");
            return "ok";
        }
    }

    protected function onPost(Request $request): string
    {
        if (!isset($_POST['id_department']))
        {
            $_POST['id_department'] = null;
        }
        match ($_POST['type'])
        {
            'add'=>ServiceModel::newWorker($_POST['fio'], $_POST['age'], $_POST['exp'], $_POST['salary'], $_POST['type_worker'], $_POST['id_department']),
            'update'=>ServiceModel::my_update($_POST['id_worker'], $_POST['param'], $_POST['new_value']),
            'delete'=>ServiceModel::deleteWorker($_POST['id_worker'])
        };
        $worker = WorkerModel::getById($_SESSION['idUser']);
        return match ($_POST['type'])
        {
            'add'=>View::render(["worker"=> $worker, "addWorkerSuccess"=>true], "WorkerTemplate.php"),
            'update'=>View::render(["worker"=>$worker, "UpdateSuccess"=>true], "WorkerTemplate.php"),
            'delete'=>View::render(["worker"=>$worker, "DeleteSuccess"=>true], "WorkerTemplate.php")
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
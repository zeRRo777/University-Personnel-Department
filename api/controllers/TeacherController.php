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

final class TeacherController extends Controller
{
    protected function onGet(Request $request): string
    {
        if ($_SESSION['idUser'] !== null){
            $worker = WorkerModel::getById($_SESSION['idUser']);
            return View::render(["worker"=> $worker], "TeacherTemplate.php");}
        else{
            header(header: "Location:https://kursach/auth");
            return "ok";
        }
    }

    protected function onPost(Request $request): string
    {

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


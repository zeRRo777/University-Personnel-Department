<?php

namespace api\controllers;

use api\core\Controller;
use api\core\Request;
use api\core\View;
use api\exceptions\ForbiddenMethodException;
use api\helpers\Auth;
use api\models\WorkerModel;
use function header;
use function session_destroy;
use const ROLE_DEKAN;
use const ROLE_HEADTEACHER;
use const ROLE_TEACHER;
use const ROLE_WORKER;

final class AuthController extends Controller
{
    protected function onGet(Request $request): string
    {
        if (isset($_SESSION['idUser']))
        {
            session_destroy();
        }
        $LoginTrue = true;
        return View::render(["LoginTrue"=>$LoginTrue], "AuthTemplate.php");
    }

    protected function onPost(Request $request): string
    {
        Auth::login($_POST['login'], $_POST['password']);
        $worker = WorkerModel::getById($_SESSION['idUser']);
        $WorkerType = $worker->type;
        switch ($WorkerType)
        {
            case ROLE_WORKER:
                header("Location:https://kursach/worker");
                break;
            case ROLE_DEKAN:
                header("Location:https://kursach/dekan");
                break;
            case ROLE_TEACHER:
                header("Location:https://kursach/teacher");
                break;
            case ROLE_HEADTEACHER:
                header("Location:https://kursach/headteacher");
                break;
        }
        return "ok";
    }

    protected function onPut(Request $request): string
    {
        throw new ForbiddenMethodException();
    }

    protected function onDelete(Request $request): string
    {
        throw new ForbiddenMethodException();
    }
}
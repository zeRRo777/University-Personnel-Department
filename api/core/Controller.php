<?php

namespace api\core;

use api\exceptions\ForbiddenMethodException;
use api\exceptions\MainException;
use api\models\WorkerModel;

abstract class Controller
{
    final public function run():string
    {
        try {
            $request = new Request();
            return match ($request->type) {
                "GET" => $this->onGet($request),
                "POST" => $this->onPost($request),
                "PUT" => $this->onPut($request),
                "DELETE" => $this->onDelete($request),
                default => throw new ForbiddenMethodException("Unknown method: {$_SERVER['HTTP_X_HTTP_METHOD']}"),
            };
        } catch (MainException $error) {
            if (isset($_SESSION['idUser']))
            {
                $worker = WorkerModel::getById($_SESSION['idUser']);
            }
            return match ($error->debugMessage)
            {
                "Запись не найдена"=>View::render(["LoginTrue"=>false], "AuthTemplate.php"),
                "Декан уже существует"=>View::render(["Dekan"=>true,"worker"=>$worker], "WorkerTemplate.php"),
                "У кафедры уже есть зав.кафедры"=>View::render(["HeadTeacher"=>true, "worker"=>$worker], "WorkerTemplate.php"),
                "Такое направление уже существует"=>View::render(["AddDirectionWrong"=>true, "worker"=>$worker],"HeadTeacherTemplate.php"),
                "Такое предмет уже есть у направления"=>View::render(["AddDirsubWrong"=>true, "worker"=>$worker],"HeadTeacherTemplate.php"),
                "Такого предмета нет у направления"=>View::render(["DeleteDirsubWrong"=>true, "worker"=>$worker],"HeadTeacherTemplate.php"),
                "Такой предмет уже есть у преподавателя"=>View::render(["AddTeacherSubWrong"=>true, "worker"=>$worker],"HeadTeacherTemplate.php"),
                "Такого предмета нет у преподавателя"=>View::render(["DeleteTeacherSubWrong"=>true, "worker"=>$worker],"HeadTeacherTemplate.php"),
                "Такого предмет уже есть"=>View::render(["worker"=> $worker, "AddSubjectWrong"=>true], "HeadTeacherTemplate.php")
            };
        }

    }

    abstract protected function onGet(Request $request): string;

    abstract protected function onPost(Request $request): string;

    abstract protected function onPut(Request $request): string;

    abstract protected function onDelete(Request $request): string;
}
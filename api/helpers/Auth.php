<?php

namespace api\helpers;

use api\exceptions\NotFoundException;
use api\models\DataWorkerModel;

final class Auth
{
    public static function login($login, $password):void
    {
        $user_data = (new DataWorkerModel())->where("login",$login)->where("password", $password)->first();
        if (!$user_data)
        {
            throw new NotFoundException("", "Запись не найдена");
        }
        $_SESSION['idUser'] = $user_data->id_worker;
    }
}
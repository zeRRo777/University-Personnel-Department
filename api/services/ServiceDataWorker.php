<?php

namespace api\services;

use api\models\DataWorkerModel;
use JetBrains\PhpStorm\Pure;
use function str_shuffle;
use function substr;


final class ServiceDataWorker
{
    #[Pure] public static function genLoginPass($id, $length = 6):DataWorkerModel
    {
        $data = new DataWorkerModel();
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        $data->id_worker = $id;
        $data->login = substr(str_shuffle($chars), 0, $length);
        $data->password = substr(str_shuffle($chars), 0, $length);
        return $data;
    }
}
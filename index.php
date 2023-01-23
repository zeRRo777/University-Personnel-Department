<?php

use api\controllers\AuthController;
use api\controllers\DekanController;
use api\controllers\HeadTeacherController;
use api\controllers\TeacherController;
use api\controllers\WorkerController;


require_once $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';

session_start();
    header('Access-Control-Allow-Origin: http://localhost:8080');
    header('Access-Control-Allow-Methods: POST, GET, DELETE, PUT, PATCH, OPTIONS');
    header('Access-Control-Allow-Headers: token, Content-Type');
    header('Access-Control-Max-Age: 1728000');
    header('Access-Control-Allow-Credentials: true');

$path = basename(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
$controller = match ($path)
{
    "worker"=> new WorkerController(),
    "auth"=> new AuthController(),
    "dekan"=> new DekanController(),
    "headteacher"=> new HeadTeacherController(),
    "teacher"=> new TeacherController()
};

echo $controller->run();
















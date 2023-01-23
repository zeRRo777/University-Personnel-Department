<?php

namespace api\core;

use api\exceptions\MainException;

final class Request
{
    private array $params = [];
    public string $type;



    public function __construct()
    {

        switch ($_SERVER['REQUEST_METHOD']) {
            case "GET": $this->loadGetParams(); break;
            case "POST": $this->loadPostParams(); break;
            case "PUT": $this->loadPutParams(); break;
            case "DELETE": $this->loadDeleteParams(); break;
            default: throw new MainException("Неизвестный запрос", "Unknown method: ".$_SERVER['REQUEST_METHOD']);
        }
    }

    public function getParam(string $paramName) : string
    {
        return $this->params[$paramName];
    }

    private function loadGetParams(): void
    {
        $this->type = "GET";
        $this->params = $_GET;
    }

    private function loadPostParams(): void
    {
        $this->type = "POST";
        $this->params = $_POST;
    }

    private function loadPutParams(): void
    {
        $this->type = "PUT";
        parse_str(file_get_contents("php://input"), $this->params);
    }


    private function loadDeleteParams(): void
    {
        $this->type = "DELETE";
        $json = file_get_contents("php://input");
        $this->params = json_decode($json, true, 512, JSON_THROW_ON_ERROR);
    }
}
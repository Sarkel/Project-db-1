<?php
/**
 * Created by PhpStorm.
 * User: sebas
 * Date: 29.12.2015
 * Time: 23:08
 */

namespace App\Models;


use App\Exceptions\CustomException;

class ApiModel
{
    private $routes;
    private $requestMethod;
    private $endPoint;

    public function __construct(){
        $this->setRequestURI();
        $this->setRequestMethod();
        echo $this->endPoint;
    }

    private function setRequestMethod(){
        $this->requestMethod = $_SERVER['REQUEST_METHOD'];
        if ($this->requestMethod == 'POST' && array_key_exists('HTTP_X_HTTP_METHOD', $_SERVER)) {
            if ($_SERVER['HTTP_X_HTTP_METHOD'] == 'DELETE') {
                $this->requestMethod = 'DELETE';
            } else if ($_SERVER['HTTP_X_HTTP_METHOD'] == 'PUT') {
                $this->requestMethod = 'PUT';
            } else {
                throw new CustomException("Unexpected Header");
            }
        }
    }

    private function setRequestURI(){
        $requestURI = $_SERVER['REQUEST_URI'];
        $this->endPoint = explode('api.php', $requestURI)[1];
    }
}

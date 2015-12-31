<?php
/**
 * Created by PhpStorm.
 * User: sebas
 * Date: 29.12.2015
 * Time: 23:08
 */

namespace App\Models;


use App\Exceptions\CustomException;
use App\Wrappers\ResponseWrapper;

class ApiModel
{
    private $requestMethod;
    private $endPoint;

    public function __construct(){
        $this->setRequestURI();
        $this->setRequestMethod();
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

    private function compareEndpoints(){
        $content = file_get_contents('./Mocks/ServerRoutes.json');
        foreach(json_decode($content, true) as $value){
            $params = explode('/', $value['endpoint']);
            $currentParams = explode('/', $this->endPoint);
            $isCorrect = true;
            for($i=0; $i<count($currentParams); $i++){
                $beg = strpos($params[$i], '{');
                $end = strpos($params[$i], '}');
                if(!($beg && $end) && $params[$i] !== $currentParams[$i]){
                    $isCorrect = false;
                    break;
                }
            }

            if($isCorrect){
                return $value;
            } else {
                continue;
            }
        }
        return null;
    }
    public function run(){
        $toRun = $this->compareEndpoints();

        if($toRun){
            $class = $toRun['namespace'] . '\\' . $toRun['class'];
            $method = $toRun['method'];
            $response = $class::$method();
        } else{
            $response = new ResponseWrapper(false, 'No method match.');
        }

        $this->createResponse($response);
    }

    private function createResponse(ResponseWrapper $response){
        header('Content-Type: application/json; charset=utf-8');
        echo $response->toJson();
    }
}

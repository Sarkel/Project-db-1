<?php
/**
 * Created by PhpStorm.
 * User: sebas
 * Date: 29.12.2015
 * Time: 23:08
 */

namespace App\Models;


use App\Exceptions\CustomException;
use App\Wrappers\EndpointComparerResponseWrapper;
use App\Wrappers\ResponseWrapper;

class ApiModel
{
    private $requestMethod;
    private $endPoint;
    private $bodyParams;

    public function __construct(){
        $this->setRequestURI();
        $this->setRequestMethod();
        $this->getBodyParams();
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
        $this->endPoint = explode('/', explode('api.php', $requestURI)[1]);
    }

    private function getBodyParams(){
        $this->bodyParams = json_decode(file_get_contents('php://input'));
    }

    private function compareEndpoints(){
        $content = file_get_contents('./Mocks/ServerRoutes.json');
        if(count($this->endPoint) === 1) return null;
        foreach(json_decode($content, true) as $value){
            $params = explode('/', $value['endpoint']);
            $currentParams = $this->endPoint;
            if(count($params) !== count($currentParams)) continue;
            $isCorrect = true;
            $queryValues = [];
            for($i=0; $i<count($currentParams); $i++){
                $beg = is_numeric(strpos($params[$i], '{'));
                $end = is_numeric(strpos($params[$i], '}'));
                if($beg && $end){
                    array_push($queryValues, $currentParams[$i]);
                } elseif($params[$i] !== $currentParams[$i]){
                    $isCorrect = false;
                    break;
                }
            }

            if($isCorrect && $value['httpMethod'] === $this->requestMethod){
                return new EndpointComparerResponseWrapper($value, $queryValues);
            } else {
                continue;
            }
        }
        return null;
    }
    public function run(){
        if(!AuthorizationModel::checkSession()){
            $response = new ResponseWrapper(false, 'Session Expired');
        } else {
            $comparedValues = $this->compareEndpoints();
            if($comparedValues){
                $toRun = $comparedValues->endpointDescription;
                $class = $toRun['namespace'] . '\\' . $toRun['class'];
                $method = $toRun['method'];
                $hasParams = $toRun['hasParams'];
                $httpMethod = $toRun['httpMethod'];
                $params = [];
                if($hasParams) $params['UriParams'] = $comparedValues->params;
                if($httpMethod === 'POST' || $httpMethod === 'PUT') $params['BodyParams'] = $this->bodyParams;
                if(count($params) === 0){
                    $response = $class::$method();
                } else {
                    $response = $class::$method($params);
                }
            } else{
                $response = new ResponseWrapper(false, 'No method match.');
            }
        }

        $this->createResponse($response);
    }

    private function createResponse(ResponseWrapper $response){
        header('Content-Type: application/json; charset=utf-8');
        echo $response->toJson();
    }
}

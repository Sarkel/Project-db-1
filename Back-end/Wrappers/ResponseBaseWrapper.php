<?php

/**
 * Created by PhpStorm.
 * User: sebas
 * Date: 21.12.2015
 * Time: 23:44
 */
abstract class ResponseBaseWrapper
{
    public $status;

    public $msg;

    protected function __construct($_status, $_msg){
        $this -> status = $_status;
        $this -> msg = $_msg;
    }

    public function toJson(){
        return json_encode($this);
    }
}
<?php

/**
 * Created by PhpStorm.
 * User: sebas
 * Date: 21.12.2015
 * Time: 23:44
 */
abstract class ResponseWrapper
{
    public $success;
    public $msg;
    public $data;

    public function __construct($success, $msg, $data = null){
        $this -> status = $success;
        $this -> msg = $msg;
        $this -> data = $data;
    }

    public function toJson(){
        return json_encode($this);
    }
}
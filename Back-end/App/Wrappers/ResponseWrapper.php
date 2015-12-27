<?php

/**
 * Created by PhpStorm.
 * User: sebas
 * Date: 21.12.2015
 * Time: 23:44
 */

namespace App\Wrappers;
class ResponseWrapper
{
    public function __construct($success, $msg, $data = null){
        $this->success = $success;
        $this->msg = $msg;
        if(!is_null($data)) $this->data = $data;
    }

    public function toJson(){
        return json_encode($this);
    }
}
<?php

/**
 * Created by PhpStorm.
 * User: Sebastian Kubalski
 * Date: 21.12.2015
 * Time: 23:44
 */

namespace App\Wrappers;
class ResponseWrapper
{
    /**
     * @param $success
     * @param null $msg
     * @param null $data
     * @description konstruktor obiektu wrappujπcego odpowiedü serwera
     */
    public function __construct($success, $msg=null, $data = null){
        $this->success = $success;
        $this->msg = $msg;
        if(!is_null($data)) $this->data = $data;
    }

    /**
     * @return string
     * @description metoda serializuje odpowiedü do formatu JSON
     */
    public function toJson(){
        return json_encode($this);
    }
}
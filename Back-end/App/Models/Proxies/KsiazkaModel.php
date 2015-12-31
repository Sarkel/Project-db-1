<?php
/**
 * Created by PhpStorm.
 * User: sebas
 * Date: 30.12.2015
 * Time: 23:39
 */

namespace App\Models\Proxies;


use App\Wrappers\ResponseWrapper;

class KsiazkaModel
{
    public static function getAllBooks($param){
        return new ResponseWrapper(true, 'dziala', $param);
    }
}
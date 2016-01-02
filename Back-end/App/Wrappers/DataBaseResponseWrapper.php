<?php
/**
 * Created by PhpStorm.
 * User: sebas
 * Date: 27.12.2015
 * Time: 18:52
 */

namespace App\Wrappers;


class DataBaseResponseWrapper
{
    public function setProperty($fieldName, $fieldValue){
        $this->{$fieldName} = $fieldValue;
    }
}
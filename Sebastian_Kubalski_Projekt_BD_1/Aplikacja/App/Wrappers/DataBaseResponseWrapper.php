<?php
/**
 * Created by PhpStorm.
 * User: Sebastian Kubalski
 * Date: 27.12.2015
 * Time: 18:52
 */

namespace App\Wrappers;


class DataBaseResponseWrapper
{
    /**
     * @param $fieldName
     * @param $fieldValue
     * @description mapuje nazw� pola w tabeli z warto�ci� zwracan� z procedury sk�adowanej
     */
    public function setProperty($fieldName, $fieldValue){
        $this->{$fieldName} = $fieldValue;
    }
}
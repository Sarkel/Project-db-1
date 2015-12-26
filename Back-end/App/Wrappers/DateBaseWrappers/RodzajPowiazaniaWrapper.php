<?php

/**
 * Created by PhpStorm.
 * User: sebas
 * Date: 22.12.2015
 * Time: 23:33
 */

namespace App\Wrappers\DateBaseWrappers;
class RodzajPowiazaniaWrapper
{
    public $id;
    public $nazwa;

    public function __construct($id, $nazwa) {
        $this -> id = $id;
        $this -> nazwa = $nazwa;
    }
}
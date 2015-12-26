<?php

/**
 * Created by PhpStorm.
 * User: sebas
 * Date: 22.12.2015
 * Time: 23:06
 */

namespace App\Wrappers\DateBaseWrappers;
class RodzajUzytkownikaWrapper
{
    public $id;
    public $nazwa;

    public function __construct($id, $nazwa) {
        $this -> id = $id;
        $this -> nazwa = $nazwa;
    }
}
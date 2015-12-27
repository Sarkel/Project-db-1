<?php

/**
 * Created by PhpStorm.
 * User: sebas
 * Date: 22.12.2015
 * Time: 23:29
 */

namespace App\Wrappers\DateBaseWrappers;
class WydawnictwoWrapper
{
    public function __construct($id, $nazwa = null, $krajPochodzenia = null) {
        $this->id = $id;
        if(!is_null($nazwa)) $this->nazwa = $nazwa;
        if(!is_null($krajPochodzenia)) $this->krajPochodzenia = $krajPochodzenia;
    }
}
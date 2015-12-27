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
    public function __construct($id, $nazwa = null) {
        $this->id = $id;
        if(!is_null($nazwa)) $this->nazwa = $nazwa;
    }
}
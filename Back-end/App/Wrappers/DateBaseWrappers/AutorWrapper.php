<?php

/**
 * Created by PhpStorm.
 * User: sebas
 * Date: 22.12.2015
 * Time: 23:31
 */

namespace App\Wrappers\DateBaseWrappers;
class AutorWrapper
{
    public function __construct($id, $imie = null, $nazwisko = null, $krajPochodzenia = null) {
        $this->id = $id;
        if(!is_null($imie)) $this->imie = $imie;
        if(!is_null($nazwisko)) $this->nazwisko = $nazwisko;
        if(!is_null($krajPochodzenia)) $this->krajPochodzenia = $krajPochodzenia;
    }
}
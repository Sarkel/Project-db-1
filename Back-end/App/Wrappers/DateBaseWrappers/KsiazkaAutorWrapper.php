<?php

/**
 * Created by PhpStorm.
 * User: sebas
 * Date: 22.12.2015
 * Time: 23:27
 */

namespace App\Wrappers\DateBaseWrappers;
class KsiazkaAutorWrapper
{
    public function __construct($ksiazka, $autor, $rodzajPowiazania = null) {
        $this->ksiazka = $ksiazka;
        $this->autor = $autor;
        if(!is_null($rodzajPowiazania)) $this->rodzajPowiazania = $rodzajPowiazania;
    }
}
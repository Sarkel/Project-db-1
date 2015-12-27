<?php

/**
 * Created by PhpStorm.
 * User: sebas
 * Date: 22.12.2015
 * Time: 23:20
 */

namespace App\Wrappers\DateBaseWrappers;
class WypozyczonaKsiazkaWrapper
{
    public function __construct($uzytkownik, $ksiazka, $dataWypozyczenia = null, $dataOddania = null) {
        $this->uzytkownik = $uzytkownik;
        $this->ksiazka = $ksiazka;
        if(!is_null($dataWypozyczenia)) $this->dataWypozyczenia = $dataWypozyczenia;
        if(!is_null($dataOddania)) $this->dataOddania = $dataOddania;
    }
}
<?php

/**
 * Created by PhpStorm.
 * User: sebas
 * Date: 22.12.2015
 * Time: 23:08
 */

namespace App\Wrappers\DateBaseWrappers;
class NaleznoscWrapper
{
    public function __construct($id, $uzytkownik = null, $opis = null, $wartosc = null,
                                $uzytkownikWypKsiaz = null, $ksiazkaWypKsiaz = null) {
        $this->id = $id;
        if(!is_null($uzytkownik)) $this->uzytkownik = $uzytkownik;
        if(!is_null($opis)) $this->opis = $opis;
        if(!is_null($wartosc)) $this->wartosc = $wartosc;
        if(!is_null($uzytkownikWypKsiaz)) $this->uzytkownikWypKsiaz = $uzytkownikWypKsiaz;
        if(!is_null($ksiazkaWypKsiaz)) $this->ksiazkaWypKsiaz = $ksiazkaWypKsiaz;
    }
}
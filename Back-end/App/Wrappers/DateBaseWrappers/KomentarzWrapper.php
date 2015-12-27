<?php

/**
 * Created by PhpStorm.
 * User: sebas
 * Date: 22.12.2015
 * Time: 23:14
 */

namespace App\Wrappers\DateBaseWrappers;
class KomentarzWrapper
{
    public function __construct($id, $uzytkownik = null, $ksiazka = null,
                                $data = null, $iloscGwizdek = null, $tekst = null) {
        $this->id = $id;
        if(!is_null($uzytkownik)) $this->uzytkownik = $uzytkownik;
        if(!is_null($ksiazka)) $this->ksiazka = $ksiazka;
        if(!is_null($tekst)) $this->tekst = $tekst;
        if(!is_null($data)) $this->data = $data;
        if(!is_null($iloscGwizdek)) $this->iloscGwizdek = $iloscGwizdek;
    }
}
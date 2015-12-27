<?php

/**
 * Created by PhpStorm.
 * User: sebas
 * Date: 22.12.2015
 * Time: 00:08
 */

namespace App\Wrappers\DateBaseWrappers;
class UzytkownikWrapper
{
    public function __construct($id, $email = null, $nazwisko = null, $imie = null, $aktywny = null,
                                $adres = null, $typ = null, $komorka = null, $stacjonarny = null, $avatar = null){

        $this->id = $id;
        if(!is_null($email)) $this->email = $email;
        if(!is_null($nazwisko)) $this->nazwisko = $nazwisko;
        if(!is_null($imie)) $this->imie = $imie;
        if(!is_null($avatar)) $this->avatar = $avatar;
        if(!is_null($adres)) $this->adres = $adres;
        if(!is_null($typ)) $this->typ = $typ;
        if(!is_null($komorka)) $this->komorka = $komorka;
        if(!is_null($stacjonarny)) $this->stacjonarny = $stacjonarny;
        if(!is_null($aktywny)) $this->aktywny = $aktywny;
    }
}
<?php

/**
 * Created by PhpStorm.
 * User: sebas
 * Date: 22.12.2015
 * Time: 00:08
 */
class UzytkownikWrapper
{
    public $id;
    public $email;
    public $nazwisko;
    public $imie;
    public $avatar;
    public $adres;
    public $typ;
    public $komorka;
    public $stacjonarny;
    public $aktywny;

    public function __construct($id, $email, $nazwisko, $imie, $aktywny, $adres, $typ,
                                $komorka = null, $stacjonarny = null, $avatar = null){
        $this -> email = $email;
        $this -> nazwisko = $nazwisko;
        $this -> imie = $imie;
        $this -> avatar = $avatar;
        $this -> adres = $adres;
        $this -> typ = $typ;
        $this -> komorka = $komorka;
        $this -> stacjonarny = $stacjonarny;
        $this -> aktywny = $aktywny;
    }
}
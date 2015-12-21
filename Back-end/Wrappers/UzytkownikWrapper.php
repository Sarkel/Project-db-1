<?php

/**
 * Created by PhpStorm.
 * User: sebas
 * Date: 22.12.2015
 * Time: 00:08
 */
class UzytkownikWrapper extends ResponseBaseWrapper
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

    public function __construct($_status, $_msg, $_id = null, $_email = null, $_nazwisko = null, $_imie = null,
                                $_avatar = null, $_adres = null, $_typ = null, $_komorka = null, $_stacjonarny = null,
                                $_aktywny = null){
        parent::__construct($_status, $_msg);
        $this -> msg = $_msg;
        $this -> status = $_status;
        $this -> email = $_email;
        $this -> nazwisko = $_nazwisko;
        $this -> imie = $_imie;
        $this -> avatar = $_avatar;
        $this -> adres = $_adres;
        $this -> typ = $_typ;
        $this -> komorka = $_komorka;
        $this -> stacjonarny = $_stacjonarny;
        $this -> aktywny = $_aktywny;
    }
}
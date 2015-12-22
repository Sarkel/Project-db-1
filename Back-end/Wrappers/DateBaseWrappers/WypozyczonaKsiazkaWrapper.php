<?php

/**
 * Created by PhpStorm.
 * User: sebas
 * Date: 22.12.2015
 * Time: 23:20
 */
class WypozyczonaKsiazkaWrapper
{
    public $uzytkownik;
    public $ksiazka;
    public $dataWypozyczenia;
    public $dataOddania;

    public function __construct($uzytkownik, $ksiazka, $dataWypozyczenia, $dataOddania) {
        $this -> uzytkownik = $uzytkownik;
        $this -> ksiazka = $ksiazka;
        $this -> dataWypozyczenia = $dataWypozyczenia;
        $this -> dataOddania = $dataOddania;
    }
}
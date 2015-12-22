<?php

/**
 * Created by PhpStorm.
 * User: sebas
 * Date: 22.12.2015
 * Time: 23:14
 */
class KomentarzWrapper
{
    public $id;
    public $uzytkownik;
    public $ksiazka;
    public $tekst;
    public $data;
    public $iloscGwizdek;

    public function __construct($id, $uzytkownik, $ksiazka, $data, $iloscGwizdek, $tekst = null) {
        $this -> id = $id;
        $this -> uzytkownik = $uzytkownik;
        $this -> ksiazka = $ksiazka;
        $this -> tekst = $tekst;
        $this -> data = $data;
        $this -> iloscGwizdek = $iloscGwizdek;
    }
}
<?php

/**
 * Created by PhpStorm.
 * User: sebas
 * Date: 22.12.2015
 * Time: 23:08
 */
class NaleznoscWrapper
{
    public $id;
    public $uzytkownikWypKsiaz;
    public $ksiazkaWypKsiaz;
    public $uzytkownik;
    public $opis;
    public $wartosc;

    public function __construct($id, $uzytkownik, $opis, $wartosc, $uzytkownikWypKsiaz = null, $ksiazkaWypKsiaz = null) {
        $this -> id = $id;
        $this -> uzytkownik = $uzytkownik;
        $this -> opis = $opis;
        $this -> wartosc = $wartosc;
        $this -> uzytkownikWypKsiaz = $uzytkownikWypKsiaz;
        $this -> ksiazkaWypKsiaz = $ksiazkaWypKsiaz;
    }
}
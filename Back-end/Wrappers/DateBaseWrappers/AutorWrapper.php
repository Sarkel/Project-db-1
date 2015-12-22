<?php

/**
 * Created by PhpStorm.
 * User: sebas
 * Date: 22.12.2015
 * Time: 23:31
 */
class AutorWrapper
{
    public $id;
    public $imie;
    public $nazwisko;
    public $krajPochodzenia;

    public function __construct($id, $imie, $nazwisko, $krajPochodzenia = null) {
        $this -> id = $id;
        $this -> imie = $imie;
        $this -> nazwisko = $nazwisko;
        $this -> krajPochodzenia = $krajPochodzenia;
    }
}
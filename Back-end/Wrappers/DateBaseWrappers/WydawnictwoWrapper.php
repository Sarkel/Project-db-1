<?php

/**
 * Created by PhpStorm.
 * User: sebas
 * Date: 22.12.2015
 * Time: 23:29
 */
class WydawnictwoWrapper
{
    public $id;
    public $nazwa;
    public $krajPochodzenia;

    public function __construct($id, $nazwa, $krajPochodzenia = null) {
        $this -> id = $id;
        $this -> nazwa = $nazwa;
        $this -> krajPochodzenia = $krajPochodzenia;
    }
}
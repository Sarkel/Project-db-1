<?php

/**
 * Created by PhpStorm.
 * User: sebas
 * Date: 22.12.2015
 * Time: 23:27
 */

namespace App\Wrappers\DateBaseWrappers;
class KsiazkaAutorWrapper
{
    public $ksiazka;
    public $autor;
    public $rodzajPowiazania;

    public function __construct($ksiazka, $autor, $rodzajPowiazania) {
        $this -> ksiazka = $ksiazka;
        $this -> autor = $autor;
        $this -> rodzajPowiazania = $rodzajPowiazania;
    }
}
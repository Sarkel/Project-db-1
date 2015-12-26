<?php

/**
 * Created by PhpStorm.
 * User: sebas
 * Date: 22.12.2015
 * Time: 23:02
 */

namespace App\Wrappers\DateBaseWrappers;
class WiadomoscWrapper
{
    public $id;
    public $adresat;
    public $odbiorca;
    public $tekst;
    public $data;

    public function __construct($id, $adresat, $odbiorca, $tekst, $data) {
        $this -> id = $id;
        $this -> adresat = $adresat;
        $this -> odbiorca = $odbiorca;
        $this -> tekst = $tekst;
        $this -> data = $data;
    }
}
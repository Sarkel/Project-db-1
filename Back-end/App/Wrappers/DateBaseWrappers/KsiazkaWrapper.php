<?php

/**
 * Created by PhpStorm.
 * User: sebas
 * Date: 22.12.2015
 * Time: 23:23
 */

namespace App\Wrappers\DateBaseWrappers;
class KsiazkaWrapper
{
    public $id;
    public $tytul;
    public $rokWydania;
    public $isbn;
    public $avatar;
    public $wydawnictwo;
    public $wypozyczona;

    public function __construct($id, $tytul, $rokWydania, $avatar, $wydawnictwo, $wypozyczona, $isbn = null) {
        $this -> id = $id;
        $this -> tytul = $tytul;
        $this -> rokWydania = $rokWydania;
        $this -> isbn = $isbn;
        $this -> avatar = $avatar;
        $this -> wydawnictwo = $wydawnictwo;
        $this -> wypozyczona = $wypozyczona;
    }
}
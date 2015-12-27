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
    public function __construct($id, $tytul = null, $rokWydania = null, $avatar = null,
                                $wydawnictwo = null, $wypozyczona = null, $isbn = null) {
        $this->id = $id;
        if(!is_null($tytul)) $this->tytul = $tytul;
        if(!is_null($rokWydania)) $this->rokWydania = $rokWydania;
        if(!is_null($isbn)) $this->isbn = $isbn;
        if(!is_null($avatar)) $this->avatar = $avatar;
        if(!is_null($wydawnictwo)) $this->wydawnictwo = $wydawnictwo;
        if(!is_null($wypozyczona)) $this->wypozyczona = $wypozyczona;
    }
}
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
    public function __construct($id, $adresat = null, $odbiorca = null, $tekst = null, $data = null) {
        $this->id = $id;
        if(!is_null($adresat)) $this->adresat = $adresat;
        if(!is_null($odbiorca)) $this->odbiorca = $odbiorca;
        if(!is_null($tekst)) $this->tekst = $tekst;
        if(!is_null($data)) $this->data = $data;
    }
}
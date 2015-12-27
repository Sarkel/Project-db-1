<?php

/**
 * Created by PhpStorm.
 * User: sebas
 * Date: 22.12.2015
 * Time: 22:53
 */

namespace App\Wrappers\DateBaseWrappers;
class PocztaWrapper
{
    public function __construct($id, $kodPocztowy = null, $miejscowosc = null, $kraj = null){
        $this->id = $id;
        if(!is_null($kodPocztowy)) $this->kodPocztowy = $kodPocztowy;
        if(!is_null($miejscowosc)) $this->miejscowosc = $miejscowosc;
        if(!is_null($kraj)) $this->kraj = $kraj;
    }
}
<?php

/**
 * Created by PhpStorm.
 * User: sebas
 * Date: 22.12.2015
 * Time: 00:20
 */

namespace App\Wrappers\DateBaseWrappers;
class AdresWrapper
{
    public function __construct($id, $kodPocztowy = null, $numerDomu = null, $numerMieszkania = null, $ulica = null){
        $this->id = $id;
        if(!is_null($kodPocztowy)) $this->kodPocztowy = $kodPocztowy;
        if(!is_null($ulica)) $this->ulica = $ulica;
        if(!is_null($numerDomu)) $this->numerDomu = $numerDomu;
        if(!is_null($numerMieszkania)) $this->numerMieszkania = $numerMieszkania;
    }
}
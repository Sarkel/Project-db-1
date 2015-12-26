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
    public $id;
    public $kodPocztowy;
    public $ulica;
    public $numerDomu;
    public $numerMieszkania;

    public function __construct($id, $kodPocztowy, $numerDomu, $numerMieszkania = null, $ulica = null){
        $this -> id = $id;
        $this -> kodPocztowy = $kodPocztowy;
        $this -> ulica = $ulica;
        $this -> numerDomu = $numerDomu;
        $this -> numerMieszkania = $numerMieszkania;
    }
}
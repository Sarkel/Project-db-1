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
    public $id;
    public $kodPocztowy;
    public $miejscowosc;
    public $kraj;

    public function __construct($id, $kodPocztowy, $miejscowosc, $kraj){
        $this -> id = $id;
        $this -> kodPocztowy = $kodPocztowy;
        $this -> miejscowosc = $miejscowosc;
        $this -> kraj = $kraj;
    }
}
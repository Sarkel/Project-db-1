<?php

/**
 * Created by PhpStorm.
 * User: sebas
 * Date: 22.12.2015
 * Time: 00:20
 */
class AdresWrapper extends ResponseBaseWrapper
{
    public $id;

    public $kodPocztowy;

    public $ulica;

    public $numerDomu;

    public $numerMieszkania;

    public function __construct($_status, $_msg, $_id = null, $_kodPocztowy = null, $_ulica = null,
                                $_numerDomu = null, $_numerMieszkania = null){
        parent::__construct($_status, $_msg);
        $this -> id = $_id;
        $this -> kodPocztowy = $_kodPocztowy;
        $this -> ulica = $_ulica;
        $this -> numerDomu = $_numerDomu;
        $this -> numerMieszkania = $_numerMieszkania;
    }
}
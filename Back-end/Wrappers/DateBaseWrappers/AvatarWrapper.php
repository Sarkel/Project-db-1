<?php

/**
 * Created by PhpStorm.
 * User: sebas
 * Date: 22.12.2015
 * Time: 23:18
 */
class AvatarWrapper
{
    public $id;
    public $uri;
    public $opis;

    public function __construct($id, $uri, $opis = null) {
        $this -> id = $id;
        $this -> uri = $uri;
        $this -> opis = $opis;
    }
}
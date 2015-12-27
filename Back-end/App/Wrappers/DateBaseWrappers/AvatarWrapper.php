<?php

/**
 * Created by PhpStorm.
 * User: sebas
 * Date: 22.12.2015
 * Time: 23:18
 */

namespace App\Wrappers\DateBaseWrappers;
class AvatarWrapper
{
    public function __construct($id, $uri = null, $opis = null) {
        $this->id = $id;
        if(!is_null($uri)) $this->uri = $uri;
        if(!is_null($opis)) $this->opis = $opis;
    }
}
<?php

/**
 * Created by PhpStorm.
 * User: sebas
 * Date: 30.12.2015
 * Time: 00:02
 */


namespace App\Vendor;

class RandomLib
{
    public static function addRandomLibrary(){
        $libraryRoot = dirname(__FILE__);
        require_once "$libraryRoot/RandomLib/random.php";
        require_once "$libraryRoot/RandomLib/cast_to_int.php";
        require_once "$libraryRoot/RandomLib/random_int.php";
    }
}

<?php
/**
 * Created by PhpStorm.
 * User: sebas
 * Date: 21.12.2015
 * Time: 23:22
 */

namespace App\Wrappers;
class DataBaseSettingsWrapper
{
    function __construct($_settings){
        $this->dbName = $_settings['dateBaseName'];
        $this->dbUser = $_settings['user'];
        $this->dbPwd = $_settings['password'];
        $this->host = $_settings['host'];
    }
}
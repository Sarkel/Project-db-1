<?php
/**
 * Created by PhpStorm.
 * User: Sebastian Kubalski
 * Date: 21.12.2015
 * Time: 23:22
 */

namespace App\Wrappers;
class DataBaseSettingsWrapper
{
    /**
     * @param $_settings
     * @description obiekt pobiera i wrappuje ustawienia bazy danych
     */
    function __construct($_settings){
        $this->dbName = $_settings['dateBaseName'];
        $this->dbUser = $_settings['user'];
        $this->dbPwd = $_settings['password'];
        $this->host = $_settings['host'];
    }
}
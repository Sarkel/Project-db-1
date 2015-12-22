<?php
/**
 * Created by PhpStorm.
 * User: sebas
 * Date: 21.12.2015
 * Time: 23:22
 */

class DateBaseSettingsWrapper
{
    public $dbName;
    public $host;
    public $dbUser;
    public $dbPwd;

    function __construct($_settings){
        $this -> dbName = $_settings['dateBaseName'];
        $this -> dbUser = $_settings['user'];
        $this -> dbPwd = $_settings['password'];
        $this -> host = $_settings['host'];
    }
}
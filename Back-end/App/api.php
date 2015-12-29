<?php
/**
 * Created by PhpStorm.
 * User: sebas
 * Date: 29.12.2015
 * Time: 22:43
 */

//require_once 'App/Vendor/autoloader.php';
define('__ROOT__', dirname(dirname(__FILE__)));
function __autoload($className) {
    $ds = '\\';
    $file = __ROOT__ . $ds . str_replace('\\', $ds, $className) . '.php';
    if(is_readable($file)) require_once $file;
}